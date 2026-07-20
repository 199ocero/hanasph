<?php

namespace App\Services\Skills;

use App\Ai\Agents\GradeSubmissionAgent;
use App\Models\SkillLesson;
use App\Models\SkillSubmission;
use App\Models\UserSkillProgress;
use App\Services\Tasks\ProgressionService;
use Illuminate\Support\Facades\DB;
use Laravel\Ai\Files\Document;
use Laravel\Ai\Files\Image;
use Throwable;

/**
 * Grades an uploaded skill-lesson submission with {@see GradeSubmissionAgent},
 * persists the peer-review critique, and advances the learner's course progress
 * (awarding XP) when the lesson is passed. Invoked from a queued job because
 * multimodal grading is a slow, heavy round-trip.
 */
class SubmissionGradingService
{
    public function __construct(private ProgressionService $progression) {}

    public function grade(SkillSubmission $submission): void
    {
        $submission->loadMissing('lesson');
        $lesson = $submission->lesson;

        $verdict = $this->cachedVerdict($submission)
            ?? $this->requestVerdict($submission, $lesson);

        if ($verdict === null) {
            $submission->update(['status' => SkillSubmission::STATUS_FAILED]);

            return;
        }

        $threshold = (int) config('ai.grading.pass_threshold');
        $passed = $verdict['passed'] && $verdict['score'] >= $threshold && ! $verdict['flagged'];

        DB::transaction(function () use ($submission, $lesson, $verdict, $passed): void {
            $submission->update([
                'status' => SkillSubmission::STATUS_GRADED,
                'ai_score' => $verdict['score'],
                'ai_passed' => $passed,
                'ai_strengths' => $verdict['strengths'],
                'ai_fixes' => $verdict['fixes'],
                'ai_next_step' => $verdict['next_step'],
                'model' => $verdict['model'],
                'graded_at' => now(),
            ]);

            if ($passed) {
                $this->advanceCourse($submission->user_id, $lesson);
            }
        });
    }

    /**
     * Reuse an identical prior submission's grade for this user+lesson.
     *
     * @return array<string, mixed>|null
     */
    private function cachedVerdict(SkillSubmission $submission): ?array
    {
        if ($submission->submission_hash === null) {
            return null;
        }

        $prior = SkillSubmission::query()
            ->where('user_id', $submission->user_id)
            ->where('skill_lesson_id', $submission->skill_lesson_id)
            ->where('submission_hash', $submission->submission_hash)
            ->where('status', SkillSubmission::STATUS_GRADED)
            ->whereKeyNot($submission->id)
            ->latest('id')
            ->first();

        if ($prior === null) {
            return null;
        }

        return [
            'passed' => (bool) $prior->ai_passed,
            'score' => (int) $prior->ai_score,
            'strengths' => $prior->ai_strengths ?? [],
            'fixes' => $prior->ai_fixes ?? [],
            'next_step' => $prior->ai_next_step ?? '',
            'flagged' => false,
            'model' => $prior->model,
        ];
    }

    /**
     * @return array<string, mixed>|null Null when the grader is unavailable.
     */
    private function requestVerdict(SkillSubmission $submission, SkillLesson $lesson): ?array
    {
        $model = (string) config('ai.grading.submission_model');

        $agent = new GradeSubmissionAgent([
            'brief' => $lesson->brief,
            'rubric' => $lesson->rubric,
            'reference_notes' => $lesson->reference_notes,
        ]);

        [$prompt, $attachments] = $this->buildPrompt($submission);

        try {
            $response = $agent->prompt(
                $prompt,
                attachments: $attachments,
                model: $model,
                timeout: (int) config('ai.grading.timeout'),
            );
        } catch (Throwable) {
            return null;
        }

        $flags = (array) $response['flags'];
        $flagged = ($flags['off_topic'] ?? false)
            || ($flags['gibberish'] ?? false)
            || ($flags['injection_attempt'] ?? false)
            || ($flags['wrong_format'] ?? false);

        return [
            'passed' => (bool) $response['passed'],
            'score' => (int) $response['score'],
            'strengths' => (array) $response['strengths'],
            'fixes' => (array) $response['fixes'],
            'next_step' => (string) $response['next_step'],
            'flagged' => (bool) $flagged,
            'model' => $model,
        ];
    }

    /**
     * Build the prompt text and any file/image attachment for the submission.
     *
     * @return array{0: string, 1: array<int, object>}
     */
    private function buildPrompt(SkillSubmission $submission): array
    {
        return match ($submission->format) {
            SkillSubmission::FORMAT_IMAGE => [
                'The submission is the attached image. Review it against the brief and rubric.',
                [Image::fromStorage($submission->file_path, 'local')],
            ],
            SkillSubmission::FORMAT_FILE => [
                'The submission is the attached file. Review it against the brief and rubric.',
                [Document::fromStorage($submission->file_path, 'local')],
            ],
            default => [
                "The trainee submitted the following work.\n<submission>\n{$submission->body_text}\n</submission>",
                [],
            ],
        };
    }

    /**
     * Advance the learner past the lesson they just passed, awarding its XP and
     * completing the course when the final lesson is cleared. Idempotent: only
     * the current frontier lesson advances progress and awards XP.
     */
    private function advanceCourse(int $userId, SkillLesson $lesson): void
    {
        $progress = UserSkillProgress::firstOrCreate(
            ['user_id' => $userId, 'skill_course_id' => $lesson->skill_course_id],
            ['current_lesson_order' => 1],
        );

        // Only reward the first pass of the learner's current frontier lesson.
        if ($lesson->order !== $progress->current_lesson_order) {
            return;
        }

        $lastOrder = (int) SkillLesson::query()
            ->where('skill_course_id', $lesson->skill_course_id)
            ->whereNotNull('published_at')
            ->max('order');

        if ($lesson->order >= $lastOrder) {
            $progress->update([
                'current_lesson_order' => $lastOrder,
                'status' => UserSkillProgress::STATUS_COMPLETED,
                'completed_at' => now(),
            ]);
        } else {
            $progress->update(['current_lesson_order' => $lesson->order + 1]);
        }

        $user = $progress->user()->first();

        if ($user !== null) {
            $this->progression->awardXp($user, $lesson->xp_reward);
            $this->progression->updateStreak($user);
        }
    }
}
