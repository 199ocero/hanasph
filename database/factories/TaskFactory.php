<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);

        return [
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 100000),
            'order' => fake()->unique()->numberBetween(1, 250),
            'title' => rtrim($title, '.'),
            'client_persona' => fake()->name().' — '.fake()->jobTitle(),
            'scenario_intro' => fake()->paragraph(),
            'xp_reward' => 100,
            'is_gentle_opener' => false,
            'onboarding_entry_key' => null,
            'category' => 'comms',
        ];
    }

    public function gentleOpener(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_gentle_opener' => true,
        ]);
    }

    public function entry(string $key): static
    {
        return $this->state(fn (array $attributes) => [
            'onboarding_entry_key' => $key,
        ]);
    }
}
