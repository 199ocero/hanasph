<?php

use App\Models\Task;
use App\Models\User;
use App\Models\UserTaskProgress;
use App\Services\Tasks\ProgressionService;
use Database\Seeders\TaskContentSeeder;

beforeEach(function () {
    $this->seed(TaskContentSeeder::class);
});

it('persists answers and marks the user onboarded', function () {
    $user = User::factory()->create();

    // Beginners open on the first intro task, whatever their challenge.
    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin', 'writing'],
        'va_motivation' => 'work_from_home',
        'va_challenge' => 'talking_to_clients',
    ])->assertRedirect(route('tasks.show', 'what-is-va-work'));

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

it('opens every beginner on the first intro task regardless of challenge', function (string $challenge) {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin'],
        'va_motivation' => 'earn_more',
        'va_challenge' => $challenge,
    ])->assertRedirect(route('tasks.show', 'what-is-va-work'));
})->with([
    'clients' => ['talking_to_clients'],
    'expectations' => ['knowing_expectations'],
    'overwhelm' => ['too_many_things'],
    'ai' => ['using_ai'],
]);

it('gates the whole track behind the intro for a beginner', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin'],
        'va_motivation' => 'earn_more',
        'va_challenge' => 'using_ai',
    ]);

    $statuses = $user->taskProgress()
        ->join('tasks', 'tasks.id', '=', 'user_task_progress.task_id')
        ->pluck('user_task_progress.status', 'tasks.order');

    // All three intro tasks start unlocked (doable in any order); every real
    // Foundation task stays locked until the intros are cleared.
    expect($statuses[1])->toBe(UserTaskProgress::STATUS_UNLOCKED)
        ->and($statuses[2])->toBe(UserTaskProgress::STATUS_UNLOCKED)
        ->and($statuses[3])->toBe(UserTaskProgress::STATUS_UNLOCKED)
        ->and($statuses[4])->toBe(UserTaskProgress::STATUS_LOCKED)
        ->and($statuses[8])->toBe(UserTaskProgress::STATUS_LOCKED);
});

it('unlocks the first real task only after all three intros are passed', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin'],
        'va_motivation' => 'earn_more',
        'va_challenge' => 'using_ai',
    ]);

    $progression = app(ProgressionService::class);
    $orderOf = fn (int $order) => $user->taskProgress()
        ->join('tasks', 'tasks.id', '=', 'user_task_progress.task_id')
        ->where('tasks.order', $order)
        ->value('user_task_progress.status');

    // Pass two of the three intros (out of order): task 4 stays locked.
    $progression->passTask($user, Task::where('order', 3)->firstOrFail());
    $progression->passTask($user, Task::where('order', 1)->firstOrFail());
    expect($orderOf(4))->toBe(UserTaskProgress::STATUS_LOCKED);

    // Clearing the final intro opens the first real Foundation task.
    $progression->passTask($user, Task::where('order', 2)->firstOrFail());
    expect($orderOf(4))->toBe(UserTaskProgress::STATUS_UNLOCKED)
        ->and($orderOf(5))->toBe(UserTaskProgress::STATUS_LOCKED);
});

it('skips the intro and gentle openers for an existing VA', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('onboarding.store'), [
        'va_skills' => ['admin'],
        'va_motivation' => 'already_va',
        'va_challenge' => 'talking_to_clients', // entry task calendar-conflict, now order 6
    ])->assertRedirect(route('tasks.show', 'calendar-conflict'));

    $rows = $user->taskProgress()
        ->join('tasks', 'tasks.id', '=', 'user_task_progress.task_id')
        ->get(['tasks.order', 'user_task_progress.status', 'user_task_progress.skipped'])
        ->keyBy('order');

    // Intros (1-3) skipped, gentle openers (4-5) skipped, challenge entry (6) unlocked.
    expect($rows[1]->status)->toBe(UserTaskProgress::STATUS_PASSED)
        ->and((bool) $rows[1]->skipped)->toBeTrue()
        ->and($rows[3]->status)->toBe(UserTaskProgress::STATUS_PASSED)
        ->and($rows[4]->status)->toBe(UserTaskProgress::STATUS_PASSED)
        ->and($rows[5]->status)->toBe(UserTaskProgress::STATUS_PASSED)
        ->and($rows[6]->status)->toBe(UserTaskProgress::STATUS_UNLOCKED);
});

it('bounces an already-onboarded user away from onboarding', function () {
    $user = User::factory()->onboarded()->create();

    $this->actingAs($user)->get(route('onboarding.show'))
        ->assertRedirect(route('dashboard'));
});
