<?php

namespace Database\Factories;

use App\Models\SkillCourse;
use App\Models\User;
use App\Models\UserSkillProgress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserSkillProgress>
 */
class UserSkillProgressFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'skill_course_id' => SkillCourse::factory(),
            'current_lesson_order' => 1,
            'status' => UserSkillProgress::STATUS_IN_PROGRESS,
            'completed_at' => null,
        ];
    }
}
