<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use App\Models\UserTaskProgress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserTaskProgress>
 */
class UserTaskProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'task_id' => Task::factory(),
            'status' => UserTaskProgress::STATUS_LOCKED,
            'current_beat_order' => 1,
            'attempts_count' => 0,
            'had_wrong_attempt' => false,
            'passed_at' => null,
            'skipped' => false,
        ];
    }

    public function unlocked(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => UserTaskProgress::STATUS_UNLOCKED,
        ]);
    }

    public function passed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => UserTaskProgress::STATUS_PASSED,
            'passed_at' => now(),
        ]);
    }
}
