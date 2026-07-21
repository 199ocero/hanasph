<?php

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('shows rubric and reference_notes to an admin despite the model hiding them by default', function () {
    $admin = User::factory()->admin()->create();
    $course = SkillCourse::factory()->create();
    $lesson = SkillLesson::factory()->create([
        'skill_course_id' => $course->id,
        'reference_notes' => 'A strong submission leads with the outcome, not the process.',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.skills.show', $course))
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/SkillCourseShow')
            ->where('lessons.0.id', $lesson->id)
            ->where('lessons.0.rubric', $lesson->rubric)
            ->where('lessons.0.referenceNotes', 'A strong submission leads with the outcome, not the process.')
        );
});

it('shows unpublished courses and lessons too', function () {
    $admin = User::factory()->admin()->create();
    $course = SkillCourse::factory()->create(['published_at' => null]);
    $lesson = SkillLesson::factory()->create(['skill_course_id' => $course->id, 'published_at' => null]);

    $this->actingAs($admin)
        ->get(route('admin.skills.show', $course))
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/SkillCourseShow')
            ->where('course.isPublished', false)
            ->where('lessons.0.id', $lesson->id)
            ->where('lessons.0.isPublished', false)
        );
});

it('returns 403 for a non-admin', function () {
    $user = User::factory()->create();
    $course = SkillCourse::factory()->create();

    $this->actingAs($user)->get(route('admin.skills.show', $course))->assertForbidden();
});

it('redirects a guest to login', function () {
    $course = SkillCourse::factory()->create();

    $this->get(route('admin.skills.show', $course))->assertRedirect(route('login'));
});
