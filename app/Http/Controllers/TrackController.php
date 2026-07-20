<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\UserTaskProgress;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TrackController extends Controller
{
    /**
     * The Track map: every task with its per-user status, the current focus
     * task, and headline stats.
     */
    public function index(Request $request): Response
    {
        $user = $request->user();

        $statuses = $user->taskProgress()->pluck('status', 'task_id');

        $tasks = Task::query()->orderBy('order')->get();

        $currentTaskId = $tasks
            ->first(fn (Task $task) => ($statuses[$task->id] ?? UserTaskProgress::STATUS_LOCKED) === UserTaskProgress::STATUS_UNLOCKED)
            ?->id;

        $nodes = $tasks->map(fn (Task $task) => [
            'order' => $task->order,
            'slug' => $task->slug,
            'title' => $task->title,
            'category' => $task->category,
            'clientPersona' => $task->client_persona,
            'status' => $statuses[$task->id] ?? UserTaskProgress::STATUS_LOCKED,
            'isCurrent' => $task->id === $currentTaskId,
        ]);

        $passedCount = $statuses->filter(fn (string $s) => $s === UserTaskProgress::STATUS_PASSED)->count();

        return Inertia::render('Dashboard', [
            'nodes' => $nodes,
            'stats' => [
                'total' => $tasks->count(),
                'passed' => $passedCount,
            ],
            'celebration' => $request->session()->get('celebration'),
        ]);
    }
}
