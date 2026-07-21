<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Task;
use App\Models\TaskAttempt;
use App\Models\UserTaskProgress;
use App\Services\Tasks\ProgressionService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * Render the task player at the user's current beat.
     */
    public function show(Request $request, Task $task, ProgressionService $progression): Response
    {
        abort_unless($request->user()->can('open', $task), 403);

        $user = $request->user();
        $progress = $progression->progressFor($user, $task);

        $task->load('beats.options');

        $lastBeatOrder = (int) $task->beats->max('order');
        $isPassed = $progress->status === UserTaskProgress::STATUS_PASSED;

        // Only a passed task can have its earlier beats browsed; an
        // in-progress task always shows the current progression frontier so
        // users can't peek ahead.
        $requestedBeatOrder = $request->integer('beat');
        $beatOrder = $isPassed && $requestedBeatOrder > 0
            ? min($requestedBeatOrder, $lastBeatOrder)
            : min($progress->current_beat_order, $lastBeatOrder);

        $beat = $task->beats->firstWhere('order', $beatOrder) ?? $task->beats->first();

        $attempt = TaskAttempt::query()
            ->where('user_id', $user->id)
            ->where('beat_id', $beat->id)
            ->latest('id')
            ->first();

        return Inertia::render('tasks/Player', [
            'task' => [
                'slug' => $task->slug,
                'title' => $task->title,
                'clientPersona' => $task->client_persona,
                'scenarioIntro' => $task->scenario_intro,
                'category' => $task->category,
                'beatCount' => $task->beats->count(),
                'aiGradingEnabled' => $task->ai_grading_enabled,
            ],
            'beat' => [
                'id' => $beat->id,
                'order' => $beat->order,
                'clientMessage' => $beat->client_message,
                'scaffoldHint' => $user->needs_scaffolding ? $beat->scaffold_hint : null,
                // Shown to everyone (unlike scaffoldHint), so Filipino trainees
                // always get a native-language nudge on each beat.
                'tagalogTip' => $beat->tagalog_tip,
                // Never leak is_correct / diagnostic / lesson to the client.
                'options' => $beat->options->map(fn ($option) => [
                    'id' => $option->id,
                    'order' => $option->order,
                    'body' => $option->body,
                ])->values(),
            ],
            'currentBeatIndex' => $beat->order,
            'isPassed' => $isPassed,
            'showOptionsDefault' => (bool) $user->needs_scaffolding,
            'feedback' => $request->session()->get('feedback'),
            'previousAttempt' => $attempt === null ? null : $this->previousAttemptFeedback($attempt),
            'previousReplyText' => $attempt?->reply_text,
        ]);
    }

    /**
     * Reconstruct the McFeedback/AiFeedback shape from a previously stored
     * attempt, so a beat revisited later shows what was submitted before.
     *
     * @return array<string, mixed>
     */
    private function previousAttemptFeedback(TaskAttempt $attempt): array
    {
        if ($attempt->mode === TaskAttempt::MODE_FREE_TEXT) {
            [$diagnostic, $lesson] = $this->failureLesson($attempt->matched_option_id);

            return [
                'mode' => 'free_text',
                'correct' => (bool) $attempt->is_correct,
                'score' => (int) $attempt->ai_score,
                'feedback' => $attempt->ai_feedback,
                'suggestedReply' => $attempt->ai_suggested_reply,
                'diagnostic' => $diagnostic,
                'lesson' => $lesson,
                'graderUnavailable' => false,
                'rejected' => false,
            ];
        }

        [$diagnostic, $lesson] = $attempt->is_correct
            ? [null, null]
            : $this->failureLesson($attempt->option_id);

        return [
            'correct' => (bool) $attempt->is_correct,
            'selectedOptionId' => $attempt->option_id,
            'diagnostic' => $diagnostic,
            'lesson' => $lesson,
        ];
    }

    /**
     * @return array{0: ?string, 1: ?array{title: string, body: string}}
     */
    private function failureLesson(?int $optionId): array
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
}
