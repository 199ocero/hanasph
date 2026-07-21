<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Task;
use App\Models\UserTaskProgress;
use App\Services\Tasks\FreeTextGradingService;
use App\Services\Tasks\ProgressionService;
use App\Services\Tasks\ReflectionPromptResolver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FreeTextAttemptController extends Controller
{
    /**
     * Grade a trainee's free-text reply for the current beat of a task.
     *
     * Pass (task cleared) -> the track with a celebration flash.
     * Pass (mid-task)     -> back to the player showing the next beat.
     * Fail / unavailable  -> back to the player with AI feedback flashed.
     */
    public function store(
        Request $request,
        Task $task,
        Beat $beat,
        FreeTextGradingService $grading,
        ProgressionService $progression,
    ): RedirectResponse {
        abort_unless($request->user()->can('open', $task), 403);
        abort_unless($beat->task_id === $task->id, 404);
        abort_unless($task->ai_grading_enabled, 404);

        $validated = $request->validate([
            'reply_text' => ['required', 'string', 'max:2000'],
        ]);

        $user = $request->user();
        $progress = $progression->progressFor($user, $task);

        // Reject submissions for a beat the user isn't currently on (stale or
        // skipped-ahead), unless they're replaying an already-passed task.
        abort_unless(
            $beat->order === $progress->current_beat_order
                || $progress->status === UserTaskProgress::STATUS_PASSED,
            422,
        );

        $result = $grading->grade($user, $task, $beat, $validated['reply_text']);

        if ($result['passed']) {
            return redirect()->route('dashboard')->with('celebration', [
                'title' => $task->title,
                'xp' => $result['awardedXp'],
                'taskSlug' => $task->slug,
                'reflectionPrompt' => $task->is_intro ? null : (new ReflectionPromptResolver)->for($task),
            ]);
        }

        if ($result['advanced']) {
            return redirect()->route('tasks.show', $task);
        }

        return redirect()->route('tasks.show', $task)->with('feedback', [
            'mode' => 'free_text',
            'correct' => $result['correct'],
            'score' => $result['score'],
            'feedback' => $result['feedback'],
            'suggestedReply' => $result['suggestedReply'],
            'diagnostic' => $result['diagnostic'],
            'lesson' => $result['lesson'],
            'graderUnavailable' => $result['graderUnavailable'],
            'rejected' => $result['rejected'],
        ]);
    }
}
