<?php

namespace App\Http\Controllers;

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use App\Models\SkillSubmission;
use App\Models\UserSkillProgress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SkillLessonController extends Controller
{
    /**
     * A single lesson: the brief, the uploader, and the latest submission's
     * grade (if any). Grading criteria are never sent to the client.
     */
    public function show(Request $request, SkillCourse $course, SkillLesson $lesson): Response|RedirectResponse
    {
        abort_unless($course->isPublished() && $lesson->published_at !== null, 404);

        $user = $request->user();

        // Skill courses stay locked until the whole Foundation is finished.
        if (! $user->hasCompletedFoundation()) {
            return redirect()->route('skills.index');
        }

        $progress = UserSkillProgress::firstOrCreate(
            ['user_id' => $user->id, 'skill_course_id' => $course->id],
            ['current_lesson_order' => 1],
        );

        // Lessons unlock in order — can't jump ahead of the current frontier.
        abort_unless($lesson->order <= $progress->current_lesson_order, 403);

        $submission = SkillSubmission::query()
            ->where('user_id', $user->id)
            ->where('skill_lesson_id', $lesson->id)
            ->latest('id')
            ->first();

        return Inertia::render('skills/Lesson', [
            'course' => [
                'skillKey' => $course->skill_key,
                'title' => $course->title,
            ],
            'lesson' => [
                'id' => $lesson->id,
                'order' => $lesson->order,
                'title' => $lesson->title,
                'brief' => $lesson->brief,
                'acceptedFormats' => $lesson->accepted_formats,
                'difficulty' => $lesson->difficulty,
                'xpReward' => $lesson->xp_reward,
                'tip' => $lesson->tip,
                'aiLeverage' => $lesson->ai_leverage,
            ],
            'passed' => $lesson->order < $progress->current_lesson_order,
            'submission' => $submission === null ? null : $this->submissionPayload($submission),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function submissionPayload(SkillSubmission $submission): array
    {
        return [
            'id' => $submission->id,
            'status' => $submission->status,
            'format' => $submission->format,
            'bodyText' => $submission->body_text,
            'linkUrl' => $submission->link_url,
            'fileUrl' => $submission->file_path === null
                ? null
                : route('skills.submissions.file', $submission),
            'score' => $submission->ai_score,
            'passed' => $submission->ai_passed,
            'strengths' => $submission->ai_strengths,
            'fixes' => $submission->ai_fixes,
            'nextStep' => $submission->ai_next_step,
        ];
    }
}
