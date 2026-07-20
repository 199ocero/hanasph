<?php

namespace Database\Factories;

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SkillLesson>
 */
class SkillLessonFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'skill_course_id' => SkillCourse::factory(),
            'order' => 1,
            'title' => fake()->sentence(3),
            'brief' => fake()->paragraph(),
            'rubric' => [
                ['criterion' => 'Clarity', 'weight' => 40, 'what_good_looks_like' => 'The deliverable is easy to follow.'],
                ['criterion' => 'Completeness', 'weight' => 30, 'what_good_looks_like' => 'Every part of the brief is addressed.'],
                ['criterion' => 'Professionalism', 'weight' => 30, 'what_good_looks_like' => 'Tone and formatting are client-ready.'],
            ],
            'reference_notes' => 'A strong submission covers the three criteria above.',
            'accepted_formats' => ['text'],
            'difficulty' => 'easy',
            'xp_reward' => 100,
            'published_at' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'published_at' => now(),
        ]);
    }
}
