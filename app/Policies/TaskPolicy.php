<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Models\UserTaskProgress;

class TaskPolicy
{
    /**
     * A user may open a task only once it is unlocked or already passed —
     * never while it is still locked.
     */
    public function open(User $user, Task $task): bool
    {
        $status = $user->taskProgress()
            ->where('task_id', $task->id)
            ->value('status');

        return in_array($status, [
            UserTaskProgress::STATUS_UNLOCKED,
            UserTaskProgress::STATUS_PASSED,
        ], true);
    }
}
