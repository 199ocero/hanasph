<?php

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use Database\Seeders\SkillCourseSeeder;

beforeEach(function () {
    $this->seed(SkillCourseSeeder::class);
});

it('publishes every niche in the catalog', function () {
    $keys = array_keys((array) config('skills.catalog'));

    expect(SkillCourse::published()->count())->toBe(count($keys));

    foreach ($keys as $key) {
        $course = SkillCourse::where('skill_key', $key)->first();
        expect($course)->not->toBeNull()
            ->and($course->isPublished())->toBeTrue()
            ->and($course->source)->toBe('authored');
    }
});

it('gives every course at least three published lessons', function () {
    SkillCourse::with('lessons')->get()->each(function (SkillCourse $course) {
        expect($course->lessons->count())->toBeGreaterThanOrEqual(3)
            ->and($course->lessons->every(fn (SkillLesson $l) => $l->published_at !== null))->toBeTrue();
    });
});

it('gives every lesson a learner-facing tip and AI-leverage guidance', function () {
    SkillLesson::all()->each(function (SkillLesson $lesson) {
        expect(trim((string) $lesson->tip))->not->toBe('')
            ->and($lesson->ai_leverage)->toBeArray()
            ->and(trim((string) ($lesson->ai_leverage['approach'] ?? '')))->not->toBe('')
            ->and(trim((string) ($lesson->ai_leverage['prompt'] ?? '')))->not->toBe('');
    });
});

it('has valid rubrics, contiguous orders, and a non-decreasing difficulty ladder', function () {
    $rank = ['easy' => 1, 'medium' => 2, 'hard' => 3];

    SkillCourse::with('lessons')->get()->each(function (SkillCourse $course) use ($rank) {
        $lessons = $course->lessons->sortBy('order')->values();

        // Orders are contiguous from 1.
        expect($lessons->pluck('order')->all())->toBe(range(1, $lessons->count()));

        $previous = 0;
        foreach ($lessons as $lesson) {
            // Rubric weights sum to exactly 100.
            expect(collect($lesson->rubric)->sum('weight'))->toBe(100);

            // Difficulty never decreases as order climbs.
            $current = $rank[$lesson->difficulty] ?? 0;
            expect($current)->toBeGreaterThanOrEqual($previous);
            $previous = $current;
        }
    });
});
