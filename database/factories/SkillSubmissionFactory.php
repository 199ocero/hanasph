<?php

namespace Database\Factories;

use App\Models\SkillLesson;
use App\Models\SkillSubmission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SkillSubmission>
 */
class SkillSubmissionFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'skill_lesson_id' => SkillLesson::factory(),
            'format' => SkillSubmission::FORMAT_TEXT,
            'body_text' => fake()->paragraph(),
            'file_path' => null,
            'link_url' => null,
            'submission_hash' => hash('sha256', fake()->sentence()),
            'status' => SkillSubmission::STATUS_QUEUED,
        ];
    }

    public function graded(bool $passed = true): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => SkillSubmission::STATUS_GRADED,
            'ai_score' => $passed ? 85 : 45,
            'ai_passed' => $passed,
            'ai_strengths' => ['Clear structure'],
            'ai_fixes' => $passed ? [] : ['Tighten the intro'],
            'ai_next_step' => 'Keep the same tone next time.',
            'model' => 'claude-sonnet-5',
            'graded_at' => now(),
        ]);
    }
}
