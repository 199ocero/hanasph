<?php

namespace App\Services\Tasks;

use App\Ai\Agents\GradeReplyAgent;
use App\Models\Beat;
use App\Models\Option;
use App\Models\Task;
use App\Models\TaskAttempt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

/**
 * Grades a trainee's free-text reply for a beat using {@see GradeReplyAgent},
 * then drives the same beat-advance / task-pass progression as the
 * multiple-choice path. AI concerns live here so {@see AttemptService} stays a
 * pure database state machine.
 */
class FreeTextGradingService
{
    /**
     * Minimum characters a reply must have before it is worth an API call.
     */
    public const MIN_REPLY_LENGTH = 15;

    public function __construct(
        private ProgressionService $progression,
        private RubricBuilder $rubrics,
    ) {}

    /**
     * @return array{
     *     graderUnavailable: bool,
     *     rejected: bool,
     *     correct: bool,
     *     score: int,
     *     feedback: ?string,
     *     suggestedReply: ?string,
     *     diagnostic: ?string,
     *     lesson: ?array{title: string, body: string},
     *     advanced: bool,
     *     passed: bool,
     *     awardedXp: int,
     * }
     */
    public function grade(User $user, Task $task, Beat $beat, string $reply): array
    {
        $reply = trim($reply);
        $normalized = $this->normalize($reply);

        // Cheap pre-filter: don't spend a token on empty, too-short, or
        // copy-paste-of-the-client-message replies.
        if (
            mb_strlen($reply) < self::MIN_REPLY_LENGTH
            || $normalized === $this->normalize($beat->client_message)
        ) {
            return $this->rejected(
                'Give it a real attempt — write how you would actually reply to the client in your own words.'
            );
        }

        $rubric = $this->rubrics->forBeat($beat);
        $hash = hash('sha256', $normalized);

        $verdict = $this->cachedVerdict($user, $beat, $hash)
            ?? $this->requestVerdict($rubric, $reply);

        if ($verdict === null) {
            return $this->graderUnavailable();
        }

        return DB::transaction(fn (): array => $this->applyVerdict($user, $task, $beat, $reply, $hash, $verdict));
    }

    /**
     * Reuse a prior identical reply's grade for this user+beat to avoid a
     * redundant API call (the state machine still runs on the cached verdict).
     *
     * @return array<string, mixed>|null
     */
    private function cachedVerdict(User $user, Beat $beat, string $hash): ?array
    {
        $prior = TaskAttempt::query()
            ->where('user_id', $user->id)
            ->where('beat_id', $beat->id)
            ->where('mode', TaskAttempt::MODE_FREE_TEXT)
            ->where('reply_hash', $hash)
            ->whereNotNull('graded_at')
            ->latest('id')
            ->first();

        if ($prior === null) {
            return null;
        }

        return [
            'passed' => (bool) $prior->ai_passed,
            'score' => (int) $prior->ai_score,
            'matched_option_id' => $prior->matched_option_id,
            'feedback' => $prior->ai_feedback,
            'suggested_reply' => $prior->ai_suggested_reply,
            'flagged' => false,
            'model' => $prior->model,
        ];
    }

    /**
     * @param  array{client_message: string, ideal_answer: string, skill_focus: string, failure_modes: list<array{key: string, pattern: string}>}  $rubric
     * @return array<string, mixed>|null Null when the grader is unavailable.
     */
    private function requestVerdict(array $rubric, string $reply): ?array
    {
        $model = (string) config('ai.grading.reply_model');

        try {
            $response = (new GradeReplyAgent($rubric))->prompt(
                "<trainee_reply>\n{$reply}\n</trainee_reply>",
                model: $model,
                timeout: (int) config('ai.grading.timeout'),
            );
        } catch (Throwable) {
            return null;
        }

        $flags = (array) $response['flags'];
        $flagged = ($flags['off_topic'] ?? false)
            || ($flags['gibberish'] ?? false)
            || ($flags['injection_attempt'] ?? false);

        return [
            'passed' => (bool) $response['passed'],
            'score' => (int) $response['score'],
            'matched_option_id' => RubricBuilder::optionIdFromKey($response['matched_failure_mode']),
            'feedback' => (string) $response['feedback'],
            'suggested_reply' => (string) $response['suggested_reply'],
            'flagged' => (bool) $flagged,
            'model' => $model,
        ];
    }

    /**
     * @param  array<string, mixed>  $verdict
     * @return array<string, mixed>
     */
    private function applyVerdict(User $user, Task $task, Beat $beat, string $reply, string $hash, array $verdict): array
    {
        $threshold = (int) config('ai.grading.pass_threshold');
        $passed = $verdict['passed'] && $verdict['score'] >= $threshold && ! $verdict['flagged'];

        $progress = $this->progression->progressFor($user, $task);
        $progress->increment('attempts_count');

        TaskAttempt::create([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'beat_id' => $beat->id,
            'option_id' => null,
            'is_correct' => $passed,
            'mode' => TaskAttempt::MODE_FREE_TEXT,
            'reply_text' => $reply,
            'ai_score' => $verdict['score'],
            'ai_passed' => $passed,
            'ai_feedback' => $verdict['feedback'],
            'ai_suggested_reply' => $verdict['suggested_reply'],
            'matched_option_id' => $passed ? null : $verdict['matched_option_id'],
            'reply_hash' => $hash,
            'model' => $verdict['model'],
            'graded_at' => now(),
        ]);

        if ($passed) {
            $outcome = $this->progression->advanceOrPass($user, $task, $beat);

            return [
                'graderUnavailable' => false,
                'rejected' => false,
                'correct' => true,
                'score' => $verdict['score'],
                'feedback' => $verdict['feedback'],
                'suggestedReply' => $verdict['suggested_reply'],
                'diagnostic' => null,
                'lesson' => null,
                'advanced' => $outcome['advanced'],
                'passed' => $outcome['passed'],
                'awardedXp' => $outcome['awardedXp'],
            ];
        }

        $progress->update(['had_wrong_attempt' => true]);

        [$diagnostic, $lesson] = $this->mappedFailure($verdict['matched_option_id']);

        return [
            'graderUnavailable' => false,
            'rejected' => false,
            'correct' => false,
            'score' => $verdict['score'],
            'feedback' => $verdict['feedback'],
            'suggestedReply' => $verdict['suggested_reply'],
            'diagnostic' => $diagnostic,
            'lesson' => $lesson,
            'advanced' => false,
            'passed' => false,
            'awardedXp' => 0,
        ];
    }

    /**
     * Resolve the hand-authored diagnostic + lesson for the wrong option the
     * reply matched, so failed free-text replies reuse the same coaching content
     * as the multiple-choice path.
     *
     * @return array{0: ?string, 1: ?array{title: string, body: string}}
     */
    private function mappedFailure(?int $optionId): array
    {
        if ($optionId === null) {
            return [null, null];
        }

        $option = Option::with('lesson')->find($optionId);

        if ($option === null) {
            return [null, null];
        }

        return [
            $option->diagnostic,
            $option->lesson === null ? null : [
                'title' => $option->lesson->title,
                'body' => $option->lesson->body,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function rejected(string $feedback): array
    {
        return [
            'graderUnavailable' => false,
            'rejected' => true,
            'correct' => false,
            'score' => 0,
            'feedback' => $feedback,
            'suggestedReply' => null,
            'diagnostic' => null,
            'lesson' => null,
            'advanced' => false,
            'passed' => false,
            'awardedXp' => 0,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function graderUnavailable(): array
    {
        return [
            'graderUnavailable' => true,
            'rejected' => false,
            'correct' => false,
            'score' => 0,
            'feedback' => null,
            'suggestedReply' => null,
            'diagnostic' => null,
            'lesson' => null,
            'advanced' => false,
            'passed' => false,
            'awardedXp' => 0,
        ];
    }

    private function normalize(string $text): string
    {
        return (string) Str::of($text)->lower()->squish();
    }
}
