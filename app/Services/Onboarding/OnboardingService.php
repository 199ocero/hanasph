<?php

namespace App\Services\Onboarding;

use App\Models\Task;
use App\Models\User;
use App\Models\UserTaskProgress;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Turns the three onboarding answers into a personalised starting state:
 * which tasks are unlocked, which gentle openers an existing VA skips, whether
 * the beginner gets extra scaffolding, and which task they open on.
 */
class OnboardingService
{
    /**
     * Challenge answer -> the task's onboarding_entry_key.
     *
     * @var array<string, string>
     */
    protected array $challengeToEntry = [
        'knowing_expectations' => 'clients',
        'talking_to_clients' => 'clients',
        'too_many_things' => 'overwhelm',
        'using_ai' => 'ai',
    ];

    /**
     * Persist answers and build the user's starting progress. Returns the task
     * the user should open on.
     *
     * @param  array{va_skills: array<int, string>, va_motivation: string, va_challenge: string}  $answers
     */
    public function complete(User $user, array $answers): Task
    {
        return DB::transaction(function () use ($user, $answers) {
            $user->forceFill([
                'va_skills' => $answers['va_skills'],
                'va_motivation' => $answers['va_motivation'],
                'va_challenge' => $answers['va_challenge'],
                'needs_scaffolding' => in_array('none_yet', $answers['va_skills'], true),
                'onboarded_at' => now(),
            ])->save();

            $tasks = Task::query()->orderBy('order')->get();

            $isExistingVa = $answers['va_motivation'] === 'already_va';

            // Existing VAs skip the beginner intro tasks; beginners start on them.
            $introCount = $tasks->where('is_intro', true)->count();
            $startOrder = $isExistingVa ? $introCount + 1 : 1;

            // The challenge answer decides how far an existing VA's path is
            // pre-unlocked, and which scenario they open on.
            $entryTask = $this->resolveEntryTask($tasks, $answers['va_challenge'], $startOrder);
            $entryOrder = $entryTask->order;

            // Beginners are gated behind the intro tasks: all three intros start
            // unlocked (doable in any order), while every real Foundation task
            // stays locked until the intros are cleared (ProgressionService opens
            // the first real task once all intros are passed). Existing VAs get
            // their personalised span pre-unlocked as before.
            $unlockCeiling = $isExistingVa ? $entryOrder : $introCount;

            foreach ($tasks as $task) {
                $status = UserTaskProgress::STATUS_LOCKED;
                $skipped = false;

                if ($isExistingVa && ($task->is_intro || $task->is_gentle_opener)) {
                    $status = UserTaskProgress::STATUS_PASSED;
                    $skipped = true;
                } elseif ($task->order >= $startOrder && $task->order <= $unlockCeiling) {
                    $status = UserTaskProgress::STATUS_UNLOCKED;
                }

                UserTaskProgress::updateOrCreate(
                    ['user_id' => $user->id, 'task_id' => $task->id],
                    [
                        'status' => $status,
                        'skipped' => $skipped,
                        'passed_at' => $skipped ? now() : null,
                    ],
                );
            }

            // Beginners open on the first intro task; existing VAs open on the
            // scenario their challenge answer routed them to.
            return $isExistingVa
                ? $entryTask
                : ($tasks->firstWhere('order', 1) ?? $entryTask);
        });
    }

    /**
     * Find the task the challenge answer routes to, falling back to the first
     * task at or after the start order.
     *
     * @param  Collection<int, Task>  $tasks
     */
    protected function resolveEntryTask($tasks, string $challenge, int $startOrder): Task
    {
        $key = $this->challengeToEntry[$challenge] ?? null;

        $entry = $key === null
            ? null
            : $tasks->firstWhere('onboarding_entry_key', $key);

        if ($entry !== null && $entry->order >= $startOrder) {
            return $entry;
        }

        return $tasks->firstWhere('order', '>=', $startOrder) ?? $tasks->first();
    }
}
