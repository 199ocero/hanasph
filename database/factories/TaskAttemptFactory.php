<?php

namespace Database\Factories;

use App\Models\Beat;
use App\Models\Option;
use App\Models\Task;
use App\Models\TaskAttempt;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaskAttempt>
 */
class TaskAttemptFactory extends Factory
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
            'beat_id' => Beat::factory(),
            'option_id' => Option::factory(),
            'is_correct' => false,
        ];
    }
}
