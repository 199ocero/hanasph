<?php

namespace App\Services\Tasks;

use App\Models\Beat;
use App\Models\Option;

/**
 * Assembles the server-only grading rubric for a beat from its hand-authored
 * options: the correct option's body is the ideal answer, and each wrong
 * option's diagnostic is a labelled failure mode keyed by "opt_{id}". This
 * rubric is fed to the grading agent and never serialized to the client.
 */
class RubricBuilder
{
    /**
     * @return array{
     *     client_message: string,
     *     ideal_answer: string,
     *     skill_focus: string,
     *     failure_modes: list<array{key: string, pattern: string}>,
     * }
     */
    public function forBeat(Beat $beat): array
    {
        $beat->loadMissing('options', 'task');

        $correct = $beat->options->firstWhere('is_correct', true);

        $failureModes = $beat->options
            ->where('is_correct', false)
            ->map(fn (Option $option): array => [
                'key' => self::keyFor($option),
                'pattern' => $option->diagnostic ?? 'This reply misses what the client needs.',
            ])
            ->values()
            ->all();

        return [
            'client_message' => $beat->client_message,
            'ideal_answer' => $correct?->body ?? '',
            'skill_focus' => $this->skillFocus($beat),
            'failure_modes' => $failureModes,
        ];
    }

    /**
     * The stable rubric key for a wrong option (also the grading enum value).
     */
    public static function keyFor(Option $option): string
    {
        return "opt_{$option->id}";
    }

    /**
     * The option id encoded in a rubric key, or null if it isn't one.
     */
    public static function optionIdFromKey(?string $key): ?int
    {
        if ($key === null || ! str_starts_with($key, 'opt_')) {
            return null;
        }

        $id = substr($key, 4);

        return ctype_digit($id) ? (int) $id : null;
    }

    private function skillFocus(Beat $beat): string
    {
        $category = str_replace('_', ' ', $beat->task->category);

        return $beat->scaffold_hint !== null
            ? "{$category} — {$beat->scaffold_hint}"
            : $category;
    }
}
