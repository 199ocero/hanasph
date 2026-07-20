<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
        $beatOrder = min($progress->current_beat_order, $lastBeatOrder);
        $beat = $task->beats->firstWhere('order', $beatOrder) ?? $task->beats->first();

        $isPassed = $progress->status === UserTaskProgress::STATUS_PASSED;

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
        ]);
    }
}
