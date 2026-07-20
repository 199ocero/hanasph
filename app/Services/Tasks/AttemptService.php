<?php

namespace App\Services\Tasks;

use App\Models\Beat;
use App\Models\Option;
use App\Models\Task;
use App\Models\TaskAttempt;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * The task engine's state machine: records an option submission, decides
 * correct vs wrong, advances the beat, and passes the task on the final beat.
 */
class AttemptService
{
    public function __construct(private ProgressionService $progression) {}

    /**
     * Submit an option for the current beat of a task.
     *
     * @return array{
     *     correct: bool,
     *     diagnostic: ?string,
     *     lesson: ?array{title: string, body: string},
     *     advanced: bool,
     *     passed: bool,
     *     awardedXp: int,
     * }
     */
    public function submit(User $user, Task $task, Beat $beat, Option $option): array
    {
        return DB::transaction(function () use ($user, $task, $beat, $option) {
            $progress = $this->progression->progressFor($user, $task);

            TaskAttempt::create([
                'user_id' => $user->id,
                'task_id' => $task->id,
                'beat_id' => $beat->id,
                'option_id' => $option->id,
                'is_correct' => $option->is_correct,
            ]);

            $progress->increment('attempts_count');

            if (! $option->is_correct) {
                $progress->update(['had_wrong_attempt' => true]);

                $option->loadMissing('lesson');

                return [
                    'correct' => false,
                    'diagnostic' => $option->diagnostic,
                    'lesson' => $option->lesson === null ? null : [
                        'title' => $option->lesson->title,
                        'body' => $option->lesson->body,
                    ],
                    'advanced' => false,
                    'passed' => false,
                    'awardedXp' => 0,
                ];
            }

            $outcome = $this->progression->advanceOrPass($user, $task, $beat);

            return [
                'correct' => true,
                'diagnostic' => null,
                'lesson' => null,
                'advanced' => $outcome['advanced'],
                'passed' => $outcome['passed'],
                'awardedXp' => $outcome['awardedXp'],
            ];
        });
    }
}
