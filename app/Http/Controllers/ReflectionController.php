<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\UserTaskProgress;
use App\Services\Tasks\ProgressionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReflectionController extends Controller
{
    /**
     * List every reflection note the trainee has written, most recent first.
     */
    public function index(Request $request): Response
    {
        $reflections = UserTaskProgress::query()
            ->where('user_id', $request->user()->id)
            ->whereNotNull('reflection_note')
            ->with('task')
            ->latest('reflected_at')
            ->get()
            ->map(fn (UserTaskProgress $progress) => [
                'taskTitle' => $progress->task->title,
                'category' => $progress->task->category,
                'note' => $progress->reflection_note,
                'reflectedAt' => $progress->reflected_at?->toIso8601String(),
            ]);

        return Inertia::render('Reflections', [
            'reflections' => $reflections,
        ]);
    }

    /**
     * Record a trainee's reflection on a task they've just passed. Skipping
     * the prompt simply means this endpoint is never called.
     */
    public function store(Request $request, Task $task, ProgressionService $progression): RedirectResponse
    {
        abort_unless($request->user()->can('open', $task), 403);

        $validated = $request->validate([
            'note' => ['required', 'string', 'max:1000'],
        ]);

        $progressRecord = $progression->progressFor($request->user(), $task);

        abort_unless($progressRecord->status === UserTaskProgress::STATUS_PASSED, 422);

        $progressRecord->update([
            'reflection_note' => $validated['note'],
            'reflected_at' => now(),
        ]);

        return redirect()->route('dashboard');
    }
}
