<?php

use App\Models\User;
use App\Services\Onboarding\OnboardingService;
use Database\Seeders\TaskContentSeeder;

it('redirects guests to login', function () {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

it('redirects authenticated but not-onboarded users to onboarding', function () {
    $user = User::factory()->create(); // no onboarded_at

    $this->actingAs($user)->get(route('dashboard'))
        ->assertRedirect(route('onboarding.show'));
});

it('shows the track with node statuses for an onboarded user', function () {
    $this->seed(TaskContentSeeder::class);

    $user = User::factory()->create();
    app(OnboardingService::class)->complete($user, [
        'va_skills' => ['admin'],
        'va_motivation' => 'earn_more',
        'va_challenge' => 'talking_to_clients',
    ]);

    $this->actingAs($user)->get(route('dashboard'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page
            ->component('Dashboard')
            ->has('nodes', 20)
            ->where('stats.total', 20)
            ->where('stats.passed', 0)
        );
});
