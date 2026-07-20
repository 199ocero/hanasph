<?php

use App\Models\User;
use App\Models\UserTaskProgress;
use Database\Seeders\TaskContentSeeder;

beforeEach(function () {
    $this->seed(TaskContentSeeder::class);
});

it('persists answers and marks the user onboarded', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin', 'writing'],
        'va_motivation' => 'work_from_home',
        'va_challenge' => 'talking_to_clients',
    ])->assertRedirect(route('tasks.show', 'calendar-conflict'));

    $user->refresh();

    expect($user->onboarded_at)->not->toBeNull()
        ->and($user->va_skills)->toBe(['admin', 'writing'])
        ->and($user->va_motivation)->toBe('work_from_home')
        ->and($user->needs_scaffolding)->toBeFalse();
});

it('flags scaffolding when the user is starting from zero', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['none_yet'],
        'va_motivation' => 'new_career',
        'va_challenge' => 'using_ai',
    ]);

    expect($user->refresh()->needs_scaffolding)->toBeTrue();
});

it('opens the user on the task matching their challenge', function (string $challenge, string $slug) {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin'],
        'va_motivation' => 'earn_more',
        'va_challenge' => $challenge,
    ])->assertRedirect(route('tasks.show', $slug));
})->with([
    'clients' => ['talking_to_clients', 'calendar-conflict'],
    'expectations' => ['knowing_expectations', 'calendar-conflict'],
    'overwhelm' => ['too_many_things', 'two-urgent-requests'],
    'ai' => ['using_ai', 'catch-ai-mistakes'],
]);

it('pre-unlocks the prefix up to the entry task', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin'],
        'va_motivation' => 'earn_more',
        'va_challenge' => 'using_ai', // entry task order 5
    ]);

    $statuses = $user->taskProgress()
        ->join('tasks', 'tasks.id', '=', 'user_task_progress.task_id')
        ->pluck('user_task_progress.status', 'tasks.order');

    // Orders 1..5 unlocked, 6+ locked.
    expect($statuses[1])->toBe(UserTaskProgress::STATUS_UNLOCKED)
        ->and($statuses[5])->toBe(UserTaskProgress::STATUS_UNLOCKED)
        ->and($statuses[6])->toBe(UserTaskProgress::STATUS_LOCKED);
});

it('skips the gentle openers for an existing VA', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin'],
        'va_motivation' => 'already_va',
        'va_challenge' => 'talking_to_clients', // entry task order 3
    ]);

    $rows = $user->taskProgress()
        ->join('tasks', 'tasks.id', '=', 'user_task_progress.task_id')
        ->get(['tasks.order', 'user_task_progress.status', 'user_task_progress.skipped'])
        ->keyBy('order');

    expect($rows[1]->status)->toBe(UserTaskProgress::STATUS_PASSED)
        ->and((bool) $rows[1]->skipped)->toBeTrue()
        ->and($rows[2]->status)->toBe(UserTaskProgress::STATUS_PASSED)
        ->and($rows[3]->status)->toBe(UserTaskProgress::STATUS_UNLOCKED);
});

it('bounces an already-onboarded user away from onboarding', function () {
    $user = User::factory()->onboarded()->create();

    $this->actingAs($user)->get(route('onboarding.show'))
        ->assertRedirect(route('dashboard'));
});
