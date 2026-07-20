<?php

namespace App\Services\Tasks;

use App\Models\Beat;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTaskProgress;
use Illuminate\Support\Facades\DB;

/**
 * Mutations to a user's progress: passing a task, awarding XP, updating the
 * streak, and unlocking the next task. All money-in-the-bank writes live here
 * so the rules exist in exactly one place.
 */
class ProgressionService
{
    /**
     * Bonus XP for clearing a task with no wrong attempt.
     */
    public const FIRST_TRY_BONUS = 50;

    /**
     * Ensure a progress row exists for the user/task, creating a locked one if
     * not.
     */
    public function progressFor(User $user, Task $task): UserTaskProgress
    {
        return UserTaskProgress::firstOrCreate(
            ['user_id' => $user->id, 'task_id' => $task->id],
            ['status' => UserTaskProgress::STATUS_LOCKED],
        );
    }

    /**
     * Mark a task passed for the user: award XP, update the streak, and unlock
     * the next task. Idempotent — a task already passed awards nothing again.
     *
     * @return array{awardedXp: int, leveledUp: bool, unlockedTask: ?Task}
     */
    public function passTask(User $user, Task $task): array
    {
        return DB::transaction(function () use ($user, $task) {
            $progress = $this->progressFor($user, $task);

            if ($progress->status === UserTaskProgress::STATUS_PASSED) {
                return ['awardedXp' => 0, 'leveledUp' => false, 'unlockedTask' => null];
            }

            $award = $task->xp_reward + ($progress->had_wrong_attempt ? 0 : self::FIRST_TRY_BONUS);

            $progress->forceFill([
                'status' => UserTaskProgress::STATUS_PASSED,
                'passed_at' => now(),
            ])->save();

            $this->awardXp($user, $award);
            $this->updateStreak($user);

            return [
                'awardedXp' => $award,
                'leveledUp' => false,
                'unlockedTask' => $this->unlockNext($user, $task),
            ];
        });
    }

    /**
     * Resolve a correct answer on a beat: either advance to the next beat, or
     * pass the task when the final beat is cleared. Shared by the multiple-choice
     * and free-text grading paths so the progression rules live in one place.
     *
     * @return array{advanced: bool, passed: bool, awardedXp: int}
     */
    public function advanceOrPass(User $user, Task $task, Beat $beat): array
    {
        $lastBeatOrder = (int) $task->beats()->max('order');

        if ($beat->order < $lastBeatOrder) {
            $this->progressFor($user, $task)->update([
                'current_beat_order' => $beat->order + 1,
            ]);

            return ['advanced' => true, 'passed' => false, 'awardedXp' => 0];
        }

        $result = $this->passTask($user, $task);

        return ['advanced' => false, 'passed' => true, 'awardedXp' => $result['awardedXp']];
    }

    /**
     * Add XP to the user.
     */
    public function awardXp(User $user, int $amount): void
    {
        $user->forceFill(['xp' => (int) ($user->xp ?? 0) + $amount])->save();
    }

    /**
     * Advance the streak based on the last day the user passed a task.
     */
    public function updateStreak(User $user): void
    {
        $today = today();
        $last = $user->last_pass_on;

        if ($last !== null && $last->isSameDay($today)) {
            return;
        }

        if ($last !== null && $last->isSameDay($today->copy()->subDay())) {
            $user->current_streak = (int) ($user->current_streak ?? 0) + 1;
        } else {
            $user->current_streak = 1;
        }

        $user->longest_streak = max((int) ($user->longest_streak ?? 0), $user->current_streak);
        $user->last_pass_on = $today;
        $user->save();
    }

    /**
     * Unlock the next still-locked task in order, if any.
     */
    public function unlockNext(User $user, Task $task): ?Task
    {
        $next = $task->nextTask();

        if ($next === null) {
            return null;
        }

        $progress = $this->progressFor($user, $next);

        if ($progress->status === UserTaskProgress::STATUS_LOCKED) {
            $progress->update(['status' => UserTaskProgress::STATUS_UNLOCKED]);

            return $next;
        }

        return null;
    }
}
