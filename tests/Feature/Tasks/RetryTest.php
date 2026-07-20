<?php

use App\Models\User;
use App\Models\UserTaskProgress;

it('lets the user retry the same beat and pass after a wrong answer', function () {
    $user = User::factory()->onboarded()->create();
    $task = makeTask(order: 1, beats: 1);

    UserTaskProgress::factory()->unlocked()->create([
        'user_id' => $user->id,
        'task_id' => $task->id,
    ]);

    $beat = $task->beats->first();
    $wrong = $beat->options->firstWhere('order', 2);
    $correct = $beat->options->firstWhere('order', 1);

    // Wrong first.
    $this->actingAs($user)->post(
        route('tasks.beats.attempt', ['task' => $task, 'beat' => $beat]),
        ['option_id' => $wrong->id],
    )->assertSessionHas('feedback');

    // Retry the same beat with the correct answer -> pass.
    $this->actingAs($user)->post(
        route('tasks.beats.attempt', ['task' => $task, 'beat' => $beat]),
        ['option_id' => $correct->id],
    )->assertRedirect(route('dashboard'));

    expect(
        UserTaskProgress::where('user_id', $user->id)->where('task_id', $task->id)->value('status')
    )->toBe(UserTaskProgress::STATUS_PASSED);
});
