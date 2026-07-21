<?php

use App\Models\SkillCourse;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('redirects a guest to login', function () {
    $this->get(route('admin.index'))->assertRedirect(route('login'));
});

it('returns 403 for a non-admin authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get(route('admin.index'))->assertForbidden();
});

it('renders the admin dashboard for an admin user', function () {
    $admin = User::factory()->admin()->create();
    $task = makeTask(order: 1, beats: 2);
    $course = SkillCourse::factory()->create(['title' => 'Executive Admin VA']);

    $this->actingAs($admin)
        ->get(route('admin.index'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/Dashboard')
            ->where('tasks.0.slug', $task->slug)
            ->where('tasks.0.beatsCount', 2)
            ->where('courses.0.skillKey', $course->skill_key)
        );
});
