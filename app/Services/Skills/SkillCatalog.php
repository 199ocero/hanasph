<?php

namespace App\Services\Skills;

use App\Models\SkillCourse;
use App\Models\User;
use App\Models\UserSkillProgress;

/**
 * Reads the published course catalog and decorates it with per-user
 * recommendation and progress information for the sidebar and catalog pages.
 * Recommendations are a nudge only — every published course is startable.
 */
class SkillCatalog
{
    /**
     * The skill_keys recommended for a user based on their onboarding skills.
     *
     * @return list<string>
     */
    public function recommendedKeys(User $user): array
    {
        $map = (array) config('skills.recommendations', []);

        return collect((array) ($user->va_skills ?? []))
            ->flatMap(fn (string $skill): array => $map[$skill] ?? [])
            ->unique()
            ->values()
            ->all();
    }

    /**
     * The compact catalog shared to the sidebar on every authed page.
     *
     * @return list<array{skillKey: string, title: string, icon: ?string, recommended: bool}>
     */
    public function forNav(User $user): array
    {
        $recommended = $this->recommendedKeys($user);

        return SkillCourse::query()
            ->published()
            ->orderBy('order')
            ->get()
            ->map(fn (SkillCourse $course): array => [
                'skillKey' => $course->skill_key,
                'title' => $course->title,
                'icon' => $course->icon,
                'recommended' => in_array($course->skill_key, $recommended, true),
            ])
            ->sortByDesc('recommended')
            ->values()
            ->all();
    }

    /**
     * The richer catalog for the catalog index page, with lesson counts and
     * the user's progress status per course.
     *
     * @return list<array<string, mixed>>
     */
    public function forIndex(User $user): array
    {
        $recommended = $this->recommendedKeys($user);

        $progress = UserSkillProgress::query()
            ->where('user_id', $user->id)
            ->get()
            ->keyBy('skill_course_id');

        return SkillCourse::query()
            ->published()
            ->withCount(['lessons' => fn ($query) => $query->whereNotNull('published_at')])
            ->orderBy('order')
            ->get()
            ->map(function (SkillCourse $course) use ($recommended, $progress): array {
                $userProgress = $progress->get($course->id);

                return [
                    'skillKey' => $course->skill_key,
                    'title' => $course->title,
                    'subtitle' => $course->subtitle,
                    'icon' => $course->icon,
                    'lessonCount' => (int) $course->lessons_count,
                    'recommended' => in_array($course->skill_key, $recommended, true),
                    'started' => $userProgress !== null,
                    'completed' => $userProgress?->status === UserSkillProgress::STATUS_COMPLETED,
                ];
            })
            ->sortByDesc('recommended')
            ->values()
            ->all();
    }
}
