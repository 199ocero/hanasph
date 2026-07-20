<?php

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use App\Models\User;
use App\Models\UserSkillProgress;
use Inertia\Testing\AssertableInertia as Assert;

it('sends the tip and ai_leverage to the lesson page but never the grading criteria', function () {
    $user = User::factory()->onboarded()->create();

    $course = SkillCourse::factory()->published()->create(['skill_key' => 'admin-va']);
    $lesson = SkillLesson::factory()->published()->create([
        'skill_course_id' => $course->id,
        'order' => 1,
        'tip' => 'Lead with the June date so they can reply in one tap.',
        'ai_leverage' => [
            'approach' => 'Draft the nudge with AI, then make it sound like the client.',
            'prompt' => 'Write a warm follow-up email to {client} about {topic}.',
        ],
    ]);

    UserSkillProgress::create([
        'user_id' => $user->id,
        'skill_course_id' => $course->id,
        'current_lesson_order' => 1,
    ]);

    completeFoundation($user);

    $this->actingAs($user)
        ->get(route('skills.lessons.show', ['course' => $course->skill_key, 'lesson' => $lesson->id]))
        ->assertInertia(fn (Assert $page) => $page
            ->component('skills/Lesson')
            ->where('lesson.tip', 'Lead with the June date so they can reply in one tap.')
            ->where('lesson.aiLeverage.approach', 'Draft the nudge with AI, then make it sound like the client.')
            ->where('lesson.aiLeverage.prompt', 'Write a warm follow-up email to {client} about {topic}.')
            // Grading criteria must never reach the client.
            ->missing('lesson.rubric')
            ->missing('lesson.referenceNotes')
            ->missing('lesson.reference_notes')
        );
});
