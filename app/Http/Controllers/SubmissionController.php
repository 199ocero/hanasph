<?php

namespace App\Http\Controllers;

use App\Jobs\GradeSubmissionJob;
use App\Models\SkillCourse;
use App\Models\SkillLesson;
use App\Models\SkillSubmission;
use App\Models\UserSkillProgress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubmissionController extends Controller
{
    /**
     * Accept a deliverable for a lesson, store it privately, and queue grading.
     */
    public function store(Request $request, SkillCourse $course, SkillLesson $lesson): RedirectResponse
    {
        abort_unless($course->isPublished() && $lesson->published_at !== null, 404);

        $user = $request->user();
        $progress = UserSkillProgress::firstOrCreate(
            ['user_id' => $user->id, 'skill_course_id' => $course->id],
            ['current_lesson_order' => 1],
        );
        abort_unless($lesson->order <= $progress->current_lesson_order, 403);

        $validated = $request->validate([
            'format' => ['required', 'string', Rule::in($lesson->accepted_formats)],
            'body_text' => ['required_if:format,text', 'nullable', 'string', 'max:10000'],
            'file' => [
                'required_if:format,image,file',
                'nullable',
                'file',
                Rule::when($request->input('format') === SkillSubmission::FORMAT_IMAGE,
                    ['image', 'max:'.(int) config('skills.uploads.max_image_kb')],
                    ['mimes:pdf,txt,csv,md,doc,docx,xls,xlsx', 'max:'.(int) config('skills.uploads.max_file_kb')],
                ),
            ],
        ]);

        $format = $validated['format'];
        $filePath = null;
        $bodyText = null;

        if ($format === SkillSubmission::FORMAT_TEXT) {
            $bodyText = $validated['body_text'];
            $hash = hash('sha256', (string) Str::of($bodyText)->lower()->squish());
        } else {
            $filePath = $request->file('file')->store(
                config('skills.uploads.directory').'/'.$user->id,
                config('skills.uploads.disk'),
            );
            $hash = hash_file('sha256', Storage::disk(config('skills.uploads.disk'))->path($filePath));
        }

        $submission = SkillSubmission::create([
            'user_id' => $user->id,
            'skill_lesson_id' => $lesson->id,
            'format' => $format,
            'body_text' => $bodyText,
            'file_path' => $filePath,
            'submission_hash' => $hash,
            'status' => SkillSubmission::STATUS_QUEUED,
        ]);

        GradeSubmissionJob::dispatch($submission);

        return redirect()->route('skills.lessons.show', ['course' => $course, 'lesson' => $lesson]);
    }

    /**
     * Stream a submission's uploaded file to its owner only.
     */
    public function file(Request $request, SkillSubmission $submission): StreamedResponse
    {
        abort_unless($submission->user_id === $request->user()->id, 403);
        abort_if($submission->file_path === null, 404);

        $disk = Storage::disk(config('skills.uploads.disk'));
        abort_unless($disk->exists($submission->file_path), 404);

        return $disk->response($submission->file_path);
    }
}
