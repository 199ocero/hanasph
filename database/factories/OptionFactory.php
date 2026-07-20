<?php

namespace Database\Factories;

use App\Models\Beat;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'beat_id' => Beat::factory(),
            'order' => 1,
            'body' => fake()->sentence(),
            'is_correct' => false,
            'diagnostic' => fake()->sentence(),
            'lesson_id' => null,
        ];
    }

    public function correct(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_correct' => true,
            'diagnostic' => null,
        ]);
    }
}
