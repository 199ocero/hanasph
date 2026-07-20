<?php

use App\Ai\Agents\AuthorSkillCourseAgent;
use App\Models\SkillCourse;
use App\Models\SkillLesson;
use App\Services\Skills\CourseGenerator;

/**
 * @param  array<int, array<string, mixed>>  $lessonOverrides
 * @return array<string, mixed>
 */
function authoredCourse(?array $lessonOverrides = null): array
{
    $lessons = $lessonOverrides ?? [
        makeLesson(1, 'easy'),
        makeLesson(2, 'medium'),
        makeLesson(3, 'hard'),
    ];

    return ['lessons' => $lessons];
}

/**
 * @return array<string, mixed>
 */
function makeLesson(int $order, string $difficulty): array
{
    return [
        'order' => $order,
        'title' => "Lesson {$order}",
        'brief' => "Do the thing for lesson {$order} for a realistic client.",
        'rubric' => [
            ['criterion' => 'Clarity', 'weight' => 34, 'what_good_looks_like' => 'Easy to follow.'],
            ['criterion' => 'Completeness', 'weight' => 33, 'what_good_looks_like' => 'Covers the brief.'],
            ['criterion' => 'Tone', 'weight' => 33, 'what_good_looks_like' => 'Client-ready voice.'],
        ],
        'reference_notes' => 'Pass if it meets the three criteria.',
        'accepted_formats' => ['text'],
        'difficulty' => $difficulty,
        'xp_reward' => 100,
    ];
}

it('generates a draft course that is unpublished pending review', function () {
    AuthorSkillCourseAgent::fake([authoredCourse()]);

    $course = app(CourseGenerator::class)->generate('admin-va');

    expect($course->skill_key)->toBe('admin-va')
        ->and($course->source)->toBe('ai')
        ->and($course->published_at)->toBeNull()
        ->and($course->lessons()->count())->toBe(3);

    expect(SkillLesson::whereNotNull('published_at')->count())->toBe(0);
});

it('rejects a course whose lesson has too few rubric criteria', function () {
    $bad = [makeLesson(1, 'easy'), makeLesson(2, 'medium'), makeLesson(3, 'hard')];
    $bad[1]['rubric'] = [['criterion' => 'Only one', 'weight' => 100, 'what_good_looks_like' => 'x']];
    AuthorSkillCourseAgent::fake([authoredCourse($bad)]);

    expect(fn () => app(CourseGenerator::class)->generate('admin-va'))
        ->toThrow(InvalidArgumentException::class);

    expect(SkillCourse::count())->toBe(0);
});

it('rejects a course whose difficulty decreases', function () {
    $bad = [makeLesson(1, 'hard'), makeLesson(2, 'easy'), makeLesson(3, 'hard')];
    AuthorSkillCourseAgent::fake([authoredCourse($bad)]);

    expect(fn () => app(CourseGenerator::class)->generate('admin-va'))
        ->toThrow(InvalidArgumentException::class);

    expect(SkillCourse::count())->toBe(0);
});

it('rejects an unknown niche key', function () {
    AuthorSkillCourseAgent::fake([authoredCourse()]);

    expect(fn () => app(CourseGenerator::class)->generate('not-a-real-niche'))
        ->toThrow(InvalidArgumentException::class);
});

it('generates via the artisan command', function () {
    AuthorSkillCourseAgent::fake([authoredCourse()]);

    $this->artisan('skills:generate', ['skill' => 'admin-va'])->assertSuccessful();

    expect(SkillCourse::where('skill_key', 'admin-va')->whereNull('published_at')->exists())->toBeTrue();
});

it('publishes a drafted course and its lessons', function () {
    $course = SkillCourse::factory()->create(['skill_key' => 'admin-va', 'published_at' => null]);
    SkillLesson::factory()->create(['skill_course_id' => $course->id, 'order' => 1, 'published_at' => null]);

    $this->artisan('skills:publish', ['skill' => 'admin-va'])->assertSuccessful();

    expect($course->refresh()->published_at)->not->toBeNull()
        ->and($course->lessons()->whereNull('published_at')->count())->toBe(0);
});
