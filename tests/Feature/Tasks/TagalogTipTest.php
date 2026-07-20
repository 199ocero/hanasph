<?php

use App\Models\User;
use App\Models\UserTaskProgress;
use Inertia\Testing\AssertableInertia as Assert;

it('always sends the tagalog tip in the beat payload, even without scaffolding', function () {
    $user = User::factory()->onboarded()->create(['needs_scaffolding' => false]);
    $task = makeTask(order: 1, beats: 1);

    beat($task, 1)->update([
        'scaffold_hint' => 'A scaffolding hint only some users see.',
        'tagalog_tip' => 'Isipin mo muna kung ano talaga ang kailangan bago sumagot.',
    ]);

    UserTaskProgress::factory()->unlocked()->create([
        'user_id' => $user->id,
        'task_id' => $task->id,
    ]);

    $this->actingAs($user)
        ->get(route('tasks.show', $task))
        ->assertInertia(fn (Assert $page) => $page
            ->component('tasks/Player')
            // Scaffolding stays gated off for this user...
            ->where('beat.scaffoldHint', null)
            // ...but the Taglish tip is shown to everyone.
            ->where('beat.tagalogTip', 'Isipin mo muna kung ano talaga ang kailangan bago sumagot.')
        );
});
