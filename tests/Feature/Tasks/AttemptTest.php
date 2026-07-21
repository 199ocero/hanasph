<?php

use App\Models\TaskAttempt;
use App\Models\User;
use App\Models\UserTaskProgress;

beforeEach(function () {
    $this->user = User::factory()->onboarded()->create();
    $this->task = makeTask(order: 1, beats: 2);
    $this->next = makeTask(order: 2, beats: 1);

    UserTaskProgress::factory()->unlocked()->create([
        'user_id' => $this->user->id,
        'task_id' => $this->task->id,
    ]);
    UserTaskProgress::factory()->create([
        'user_id' => $this->user->id,
        'task_id' => $this->next->id,
    ]); // locked
});

it('records a wrong answer with a diagnostic and does not pass', function () {
    $beat = beat($this->task, 1);
    $wrong = optionOf($beat, 2);

    $this->actingAs($this->user)
        ->post(route('tasks.beats.attempt', ['task' => $this->task, 'beat' => $beat]), [
            'option_id' => $wrong->id,
        ])
        ->assertRedirect(route('tasks.show', $this->task))
        ->assertSessionHas('feedback');

    expect(TaskAttempt::where('option_id', $wrong->id)->where('is_correct', false)->exists())->toBeTrue();

    $progress = UserTaskProgress::where('user_id', $this->user->id)->where('task_id', $this->task->id)->first();
    expect($progress->status)->toBe(UserTaskProgress::STATUS_UNLOCKED)
        ->and($progress->had_wrong_attempt)->toBeTrue()
        ->and($progress->attempts_count)->toBe(1);
});

it('advances to the next beat on a correct non-final answer', function () {
    $beat = beat($this->task, 1);
    $correct = optionOf($beat, 1);

    $this->actingAs($this->user)
        ->post(route('tasks.beats.attempt', ['task' => $this->task, 'beat' => $beat]), [
            'option_id' => $correct->id,
        ])
        ->assertRedirect(route('tasks.show', $this->task));

    $progress = UserTaskProgress::where('user_id', $this->user->id)->where('task_id', $this->task->id)->first();
    expect($progress->current_beat_order)->toBe(2)
        ->and($progress->status)->toBe(UserTaskProgress::STATUS_UNLOCKED);
});

it('passes the task, awards xp, and unlocks the next task on the final beat', function () {
    // Beat 1 correct -> advance.
    $this->actingAs($this->user)->post(
        route('tasks.beats.attempt', ['task' => $this->task, 'beat' => beat($this->task, 1)]),
        ['option_id' => optionOf(beat($this->task, 1), 1)->id],
    );

    // Beat 2 correct -> pass.
    $this->actingAs($this->user)->post(
        route('tasks.beats.attempt', ['task' => $this->task, 'beat' => beat($this->task, 2)]),
        ['option_id' => optionOf(beat($this->task, 2), 1)->id],
    )->assertRedirect(route('dashboard'))->assertSessionHas('celebration', fn ($celebration) => $celebration['taskSlug'] === $this->task->slug
        && $celebration['reflectionPrompt'] !== null);

    $progress = UserTaskProgress::where('user_id', $this->user->id)->where('task_id', $this->task->id)->first();
    expect($progress->status)->toBe(UserTaskProgress::STATUS_PASSED)
        ->and($progress->passed_at)->not->toBeNull();

    // First-try pass on a 100-xp task = 100 + 50 bonus.
    expect($this->user->refresh()->xp)->toBe(150);

    // Next task unlocked.
    $nextStatus = UserTaskProgress::where('user_id', $this->user->id)->where('task_id', $this->next->id)->value('status');
    expect($nextStatus)->toBe(UserTaskProgress::STATUS_UNLOCKED);
});

it('withholds the first-try bonus after a wrong attempt', function () {
    $beat1 = beat($this->task, 1);

    // Wrong then correct on beat 1.
    $this->actingAs($this->user)->post(
        route('tasks.beats.attempt', ['task' => $this->task, 'beat' => $beat1]),
        ['option_id' => optionOf($beat1, 3)->id],
    );
    $this->actingAs($this->user)->post(
        route('tasks.beats.attempt', ['task' => $this->task, 'beat' => $beat1]),
        ['option_id' => optionOf($beat1, 1)->id],
    );
    // Correct on beat 2 -> pass.
    $this->actingAs($this->user)->post(
        route('tasks.beats.attempt', ['task' => $this->task, 'beat' => beat($this->task, 2)]),
        ['option_id' => optionOf(beat($this->task, 2), 1)->id],
    );

    // No bonus: base 100 only.
    expect($this->user->refresh()->xp)->toBe(100);
});

it('forbids opening a locked task', function () {
    $this->actingAs($this->user)->get(route('tasks.show', $this->next))->assertForbidden();
});

it('omits the reflection prompt when passing an intro task', function () {
    $intro = makeTask(order: 3, beats: 1, attributes: ['is_intro' => true]);

    UserTaskProgress::factory()->unlocked()->create([
        'user_id' => $this->user->id,
        'task_id' => $intro->id,
    ]);

    $this->actingAs($this->user)->post(
        route('tasks.beats.attempt', ['task' => $intro, 'beat' => beat($intro, 1)]),
        ['option_id' => optionOf(beat($intro, 1), 1)->id],
    )->assertSessionHas('celebration', fn ($celebration) => $celebration['reflectionPrompt'] === null);
});
