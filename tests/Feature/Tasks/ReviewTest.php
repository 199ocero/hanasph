<?php

use App\Models\User;
use App\Models\UserTaskProgress;
use Inertia\Testing\AssertableInertia as Assert;

it('shows the previously submitted answer when revisiting a passed beat', function () {
    $user = User::factory()->onboarded()->create();
    $task = makeTask(order: 1, beats: 2);

    UserTaskProgress::factory()->unlocked()->create([
        'user_id' => $user->id,
        'task_id' => $task->id,
    ]);

    $beat1 = beat($task, 1);
    $wrong = optionOf($beat1, 2);
    $correct = optionOf($beat1, 1);

    // Wrong, then correct, on beat 1 -> advances to beat 2.
    $this->actingAs($user)->post(
        route('tasks.beats.attempt', ['task' => $task, 'beat' => $beat1]),
        ['option_id' => $wrong->id],
    );
    $this->actingAs($user)->post(
        route('tasks.beats.attempt', ['task' => $task, 'beat' => $beat1]),
        ['option_id' => $correct->id],
    );

    // Correct on beat 2 -> passes the task.
    $this->actingAs($user)->post(
        route('tasks.beats.attempt', ['task' => $task, 'beat' => beat($task, 2)]),
        ['option_id' => optionOf(beat($task, 2), 1)->id],
    )->assertRedirect(route('dashboard'));

    // Revisit the passed task at beat 1 and see the latest (correct) attempt.
    $this->actingAs($user)
        ->get(route('tasks.show', $task).'?beat=1')
        ->assertInertia(fn (Assert $page) => $page
            ->component('tasks/Player')
            ->where('isPassed', true)
            ->where('beat.order', 1)
            ->where('previousAttempt.correct', true)
            ->where('previousAttempt.selectedOptionId', $correct->id)
        );
});

it('ignores the beat query param for a task that is not yet passed', function () {
    $user = User::factory()->onboarded()->create();
    $task = makeTask(order: 1, beats: 2);

    UserTaskProgress::factory()->unlocked()->create([
        'user_id' => $user->id,
        'task_id' => $task->id,
    ]);

    $this->actingAs($user)
        ->get(route('tasks.show', $task).'?beat=2')
        ->assertInertia(fn (Assert $page) => $page
            ->component('tasks/Player')
            ->where('beat.order', 1)
        );
});
