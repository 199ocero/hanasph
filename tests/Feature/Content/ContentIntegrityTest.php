<?php

use App\Models\Beat;
use App\Models\Task;
use Database\Seeders\TaskContentSeeder;

beforeEach(function () {
    $this->seed(TaskContentSeeder::class);
});

it('seeds 20 tasks with unique contiguous orders', function () {
    $orders = Task::orderBy('order')->pluck('order');

    expect($orders->count())->toBe(20)
        ->and($orders->toArray())->toBe(range(1, 20));
});

it('has exactly one correct option and 4 options per beat', function () {
    Beat::with('options')->get()->each(function (Beat $beat) {
        expect($beat->options)->toHaveCount(4)
            ->and($beat->options->where('is_correct', true)->count())->toBe(1);
    });
});

it('gives every wrong option a diagnostic and every correct option none', function () {
    Beat::with('options')->get()->each(function (Beat $beat) {
        foreach ($beat->options as $option) {
            if ($option->is_correct) {
                expect($option->diagnostic)->toBeNull();
            } else {
                expect($option->diagnostic)->not->toBeNull()
                    ->and(trim($option->diagnostic))->not->toBe('');
            }
        }
    });
});

it('defines the three challenge entry tasks', function () {
    expect(Task::whereNotNull('onboarding_entry_key')->pluck('onboarding_entry_key')->sort()->values()->toArray())
        ->toBe(['ai', 'clients', 'overwhelm']);
});
