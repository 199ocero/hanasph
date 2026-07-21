<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beat;
use App\Models\Option;
use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;

class AdminTaskController extends Controller
{
    /**
     * Show a task's full beat/option answer key. Admin-only QA view:
     * is_correct/diagnostic/lesson are intentionally included here, unlike
     * TaskController::show which strips them from the player-facing payload.
     */
    public function show(Task $task): Response
    {
        $task->load('beats.options.lesson');

        return Inertia::render('admin/TaskShow', [
            'task' => [
                'slug' => $task->slug,
                'title' => $task->title,
                'clientPersona' => $task->client_persona,
                'scenarioIntro' => $task->scenario_intro,
                'category' => $task->category,
                'aiGradingEnabled' => $task->ai_grading_enabled,
                'xpReward' => $task->xp_reward,
            ],
            'beats' => $task->beats->map(fn (Beat $beat): array => [
                'id' => $beat->id,
                'order' => $beat->order,
                'clientMessage' => $beat->client_message,
                'scaffoldHint' => $beat->scaffold_hint,
                'tagalogTip' => $beat->tagalog_tip,
                'options' => $beat->options->map(fn (Option $option): array => [
                    'id' => $option->id,
                    'order' => $option->order,
                    'body' => $option->body,
                    'isCorrect' => $option->is_correct,
                    'diagnostic' => $option->diagnostic,
                    'lesson' => $option->lesson === null ? null : [
                        'slug' => $option->lesson->slug,
                        'title' => $option->lesson->title,
                        'body' => $option->lesson->body,
                    ],
                ])->values(),
            ])->values(),
        ]);
    }
}
