<?php

namespace Database\Factories;

use App\Models\Beat;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Beat>
 */
class BeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'order' => 1,
            'client_message' => fake()->paragraph(),
            'scaffold_hint' => null,
        ];
    }
}
