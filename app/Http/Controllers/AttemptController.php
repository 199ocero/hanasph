<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Option;
use App\Models\Task;
use App\Models\UserTaskProgress;
use App\Services\Tasks\AttemptService;
use App\Services\Tasks\ProgressionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttemptController extends Controller
{
    /**
     * Submit an option for the current beat of a task.
     *
     * Wrong  -> back to the player with a flashed diagnostic + lesson.
     * Advance -> back to the player showing the next beat.
     * Pass   -> to the track with a celebration flash.
     */
    public function store(
        Request $request,
        Task $task,
        Beat $beat,
        AttemptService $attempts,
        ProgressionService $progression,
    ): RedirectResponse {
        abort_unless($request->user()->can('open', $task), 403);
        abort_unless($beat->task_id === $task->id, 404);

        $validated = $request->validate([
            'option_id' => [
                'required',
                Rule::exists('options', 'id')->where('beat_id', $beat->id),
            ],
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

        $option = Option::findOrFail($validated['option_id']);

        $result = $attempts->submit($user, $task, $beat, $option);

        if ($result['passed']) {
            return redirect()->route('dashboard')->with('celebration', [
                'title' => $task->title,
                'xp' => $result['awardedXp'],
            ]);
        }

        if ($result['advanced']) {
            return redirect()->route('tasks.show', $task);
        }

        return redirect()->route('tasks.show', $task)->with('feedback', [
            'correct' => false,
            'selectedOptionId' => $option->id,
            'diagnostic' => $result['diagnostic'],
            'lesson' => $result['lesson'],
        ]);
    }
}
