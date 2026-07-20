<?php

namespace Database\Factories;

use App\Models\SkillCourse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<SkillCourse>
 */
class SkillCourseFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->jobTitle().' VA';

        return [
            'skill_key' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 100000),
            'title' => $title,
            'subtitle' => fake()->sentence(),
            'icon' => 'Sparkles',
            'order' => fake()->numberBetween(0, 20),
            'source' => 'ai',
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
