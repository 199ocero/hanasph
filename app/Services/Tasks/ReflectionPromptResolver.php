<?php

namespace App\Services\Tasks;

use App\Models\Task;

/**
 * Resolves the short reflection question shown right after a trainee passes a
 * task, keyed off the task's category so every task gets a fitting prompt
 * without hand-authoring one per task (mirrors {@see RubricBuilder::skillFocus()}).
 */
class ReflectionPromptResolver
{
    /**
     * @var array<string, string>
     */
    private const PROMPTS = [
        'comms' => "What's the one detail you made sure to check or confirm before replying?",
        'ai' => "What did you double-check in the AI's output before using it?",
        'prioritization' => 'What made you decide what to tackle first?',
        'admin' => 'What would you do differently to make this easier next time?',
    ];

    private const DEFAULT_PROMPT = "What's the one thing you'll take from this into your next task?";

    public function for(Task $task): string
    {
        return self::PROMPTS[$task->category] ?? self::DEFAULT_PROMPT;
    }
}
