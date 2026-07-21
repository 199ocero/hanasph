<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('shows is_correct, diagnostic, and lesson to an admin', function () {
    $admin = User::factory()->admin()->create();
    $task = makeTask(order: 1, beats: 1);
    $beat = beat($task, 1);
    $correct = optionOf($beat, 1);
    $wrong = optionOf($beat, 2);

    $this->actingAs($admin)
        ->get(route('admin.tasks.show', $task))
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/TaskShow')
            ->where('beats.0.options.0.id', $correct->id)
            ->where('beats.0.options.0.isCorrect', true)
            ->where('beats.0.options.1.id', $wrong->id)
            ->where('beats.0.options.1.isCorrect', false)
            ->where('beats.0.options.1.diagnostic', $wrong->diagnostic)
        );
});

it('returns 403 for a non-admin', function () {
    $user = User::factory()->create();
    $task = makeTask();

    $this->actingAs($user)->get(route('admin.tasks.show', $task))->assertForbidden();
});

it('redirects a guest to login', function () {
    $task = makeTask();

    $this->get(route('admin.tasks.show', $task))->assertRedirect(route('login'));
});

it('404s for an unknown task slug', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->get('/admin/tasks/not-a-real-task')->assertNotFound();
});
