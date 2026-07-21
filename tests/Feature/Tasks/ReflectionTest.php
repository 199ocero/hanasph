<?php

use App\Models\User;
use App\Models\UserTaskProgress;

beforeEach(function () {
    $this->user = User::factory()->onboarded()->create();
    $this->task = makeTask(order: 1, beats: 1);
});

it('records a reflection note on a passed task', function () {
    UserTaskProgress::factory()->passed()->create([
        'user_id' => $this->user->id,
        'task_id' => $this->task->id,
    ]);

    $this->actingAs($this->user)
        ->post(route('tasks.reflection', $this->task), [
            'note' => 'I checked which tab was the live one before touching anything.',
        ])
        ->assertRedirect(route('dashboard'));

    $progress = UserTaskProgress::where('user_id', $this->user->id)->where('task_id', $this->task->id)->first();

    expect($progress->reflection_note)->toBe('I checked which tab was the live one before touching anything.')
        ->and($progress->reflected_at)->not->toBeNull();
});

it('rejects a reflection for a task that has not been passed', function () {
    UserTaskProgress::factory()->unlocked()->create([
        'user_id' => $this->user->id,
        'task_id' => $this->task->id,
    ]);

    $this->actingAs($this->user)
        ->post(route('tasks.reflection', $this->task), [
            'note' => 'Trying to reflect early.',
        ])
        ->assertStatus(422);
});

it('requires a non-empty note', function () {
    UserTaskProgress::factory()->passed()->create([
        'user_id' => $this->user->id,
        'task_id' => $this->task->id,
    ]);

    $this->actingAs($this->user)
        ->post(route('tasks.reflection', $this->task), ['note' => ''])
        ->assertSessionHasErrors('note');
});

it('lists past reflections newest first', function () {
    $older = makeTask(order: 2, beats: 1);

    UserTaskProgress::factory()->passed()->create([
        'user_id' => $this->user->id,
        'task_id' => $this->task->id,
        'reflection_note' => 'Newer note',
        'reflected_at' => now(),
    ]);
    UserTaskProgress::factory()->passed()->create([
        'user_id' => $this->user->id,
        'task_id' => $older->id,
        'reflection_note' => 'Older note',
        'reflected_at' => now()->subDay(),
    ]);

    $response = $this->actingAs($this->user)->get(route('reflections.index'));

    $response->assertInertia(fn ($page) => $page
        ->component('Reflections')
        ->has('reflections', 2)
        ->where('reflections.0.note', 'Newer note')
        ->where('reflections.1.note', 'Older note'));
});
