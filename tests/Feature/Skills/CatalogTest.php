<?php

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('lists only published courses and flags the ones recommended by the user skills', function () {
    // config('skills.recommendations') maps 'social_media' => ['social-media-va'].
    $user = User::factory()->onboarded()->create(['va_skills' => ['social_media']]);

    SkillCourse::factory()->published()->create(['skill_key' => 'social-media-va', 'order' => 1]);
    SkillCourse::factory()->published()->create(['skill_key' => 'admin-va', 'order' => 2]);
    SkillCourse::factory()->create(['skill_key' => 'draft-va', 'order' => 3]); // unpublished

    $this->actingAs($user)
        ->get(route('skills.index'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('skills/Index')
            // The unpublished draft is excluded.
            ->has('courses', 2)
            // Recommended courses sort first and carry the flag.
            ->where('courses.0.skillKey', 'social-media-va')
            ->where('courses.0.recommended', true)
            ->where('courses.1.skillKey', 'admin-va')
            ->where('courses.1.recommended', false)
        );
});

it('flags the catalog as locked until the foundation is complete', function () {
    $user = User::factory()->onboarded()->create();
    SkillCourse::factory()->published()->create(['skill_key' => 'admin-va', 'order' => 1]);

    // Foundation not finished yet.
    $this->actingAs($user)
        ->get(route('skills.index'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('skills/Index')
            ->where('foundationComplete', false)
        );

    // Once every Foundation task is passed, the catalog unlocks.
    completeFoundation($user);

    $this->actingAs($user)
        ->get(route('skills.index'))
        ->assertInertia(fn (Assert $page) => $page->where('foundationComplete', true));
});

it('blocks entering a course until the foundation is complete', function () {
    $user = User::factory()->onboarded()->create();
    $course = SkillCourse::factory()->published()->create(['skill_key' => 'admin-va', 'order' => 1]);
    $lesson = SkillLesson::factory()->published()->create(['skill_course_id' => $course->id, 'order' => 1]);

    // Locked: entering the course or a lesson bounces back to the catalog.
    $this->actingAs($user)->get(route('skills.courses.show', ['course' => $course]))
        ->assertRedirect(route('skills.index'));
    $this->actingAs($user)->get(route('skills.lessons.show', ['course' => $course, 'lesson' => $lesson]))
        ->assertRedirect(route('skills.index'));

    // Unlocked after finishing the foundation.
    completeFoundation($user);

    $this->actingAs($user)->get(route('skills.courses.show', ['course' => $course]))
        ->assertOk();
});
