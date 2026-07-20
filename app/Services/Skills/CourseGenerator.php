<?php

namespace App\Services\Skills;

use App\Ai\Agents\AuthorSkillCourseAgent;
use App\Models\SkillCourse;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;
use Throwable;

/**
 * Generates a draft course for a VA niche with {@see AuthorSkillCourseAgent},
 * validates it against the quality bar, and persists it unpublished for human
 * review. Invalid output is rejected outright — nothing partial is saved.
 */
class CourseGenerator
{
    private const ALLOWED_FORMATS = ['text', 'image', 'file'];

    private const DIFFICULTY_RANK = ['easy' => 1, 'medium' => 2, 'hard' => 3];

    /**
     * Generate and persist a draft course for a catalog niche key.
     */
    public function generate(string $skillKey): SkillCourse
    {
        $definition = config("skills.catalog.{$skillKey}");

        if ($definition === null) {
            throw new InvalidArgumentException("Unknown skill niche [{$skillKey}].");
        }

        try {
            $response = (new AuthorSkillCourseAgent($definition['title'], $definition['focus']))->prompt(
                "Author the {$definition['title']} course now.",
                model: (string) config('ai.grading.author_model'),
                timeout: 120,
            );
        } catch (Throwable $e) {
            throw new RuntimeException("Authoring agent failed for [{$skillKey}]: {$e->getMessage()}", previous: $e);
        }

        $lessons = $this->normalizeLessons((array) $response['lessons']);
        $this->validate($lessons);

        return DB::transaction(function () use ($skillKey, $definition, $lessons): SkillCourse {
            $course = SkillCourse::updateOrCreate(
                ['skill_key' => $skillKey],
                [
                    'title' => $definition['title'],
                    'subtitle' => $definition['subtitle'] ?? null,
                    'icon' => $definition['icon'] ?? null,
                    'order' => $definition['order'] ?? 0,
                    'source' => 'ai',
                    'published_at' => null,
                ],
            );

            // Replace any prior draft lessons so regeneration is clean.
            $course->lessons()->delete();

            foreach ($lessons as $lesson) {
                $course->lessons()->create([...$lesson, 'published_at' => null]);
            }

            return $course;
        });
    }

    /**
     * Coerce the agent's structured output into plain lesson arrays.
     *
     * @param  array<int, mixed>  $raw
     * @return list<array<string, mixed>>
     */
    private function normalizeLessons(array $raw): array
    {
        return collect($raw)
            ->map(fn ($lesson): array => [
                'order' => (int) ($lesson['order'] ?? 0),
                'title' => (string) ($lesson['title'] ?? ''),
                'brief' => (string) ($lesson['brief'] ?? ''),
                'rubric' => array_map(fn ($c): array => [
                    'criterion' => (string) ($c['criterion'] ?? ''),
                    'weight' => (int) ($c['weight'] ?? 0),
                    'what_good_looks_like' => (string) ($c['what_good_looks_like'] ?? ''),
                ], (array) ($lesson['rubric'] ?? [])),
                'reference_notes' => (string) ($lesson['reference_notes'] ?? ''),
                'accepted_formats' => array_values(array_unique((array) ($lesson['accepted_formats'] ?? []))),
                'difficulty' => (string) ($lesson['difficulty'] ?? ''),
                'xp_reward' => (int) ($lesson['xp_reward'] ?? 0),
                'tip' => (string) ($lesson['tip'] ?? ''),
                'ai_leverage' => [
                    'approach' => (string) ($lesson['ai_leverage']['approach'] ?? ''),
                    'prompt' => (string) ($lesson['ai_leverage']['prompt'] ?? ''),
                ],
            ])
            ->sortBy('order')
            ->values()
            ->all();
    }

    /**
     * Enforce the quality bar. Throws with all problems if any lesson is invalid.
     *
     * @param  list<array<string, mixed>>  $lessons
     */
    private function validate(array $lessons): void
    {
        $errors = [];

        if (count($lessons) < 3) {
            $errors[] = 'A course needs at least 3 lessons.';
        }

        $previousRank = 0;

        foreach ($lessons as $index => $lesson) {
            $position = $index + 1;
            $label = "Lesson {$position}";

            if ($lesson['order'] !== $position) {
                $errors[] = "{$label}: orders must be contiguous starting at 1.";
            }

            if (trim($lesson['title']) === '' || trim($lesson['brief']) === '') {
                $errors[] = "{$label}: title and brief are required.";
            }

            if (count($lesson['rubric']) < 3) {
                $errors[] = "{$label}: needs at least 3 rubric criteria.";
            }

            foreach ($lesson['rubric'] as $criterion) {
                if (trim($criterion['criterion']) === '' || trim($criterion['what_good_looks_like']) === '') {
                    $errors[] = "{$label}: every rubric criterion needs a name and a 'what good looks like'.";

                    break;
                }
            }

            $formats = $lesson['accepted_formats'];
            if ($formats === [] || array_diff($formats, self::ALLOWED_FORMATS) !== []) {
                $errors[] = "{$label}: accepted_formats must be a non-empty subset of ".implode(', ', self::ALLOWED_FORMATS).'.';
            }

            $rank = self::DIFFICULTY_RANK[$lesson['difficulty']] ?? 0;
            if ($rank === 0) {
                $errors[] = "{$label}: difficulty must be easy, medium, or hard.";
            } elseif ($rank < $previousRank) {
                $errors[] = "{$label}: difficulty must not decrease.";
            } else {
                $previousRank = $rank;
            }

            if ($lesson['xp_reward'] < 1) {
                $errors[] = "{$label}: xp_reward must be positive.";
            }

            if (trim($lesson['tip']) === '') {
                $errors[] = "{$label}: a learner-facing tip is required.";
            }

            if (trim($lesson['ai_leverage']['approach']) === '' || trim($lesson['ai_leverage']['prompt']) === '') {
                $errors[] = "{$label}: ai_leverage needs both an approach and a starter prompt.";
            }
        }

        if ($errors !== []) {
            throw new InvalidArgumentException("Generated course failed the quality bar:\n- ".implode("\n- ", $errors));
        }
    }
}
