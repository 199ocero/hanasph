<?php

use App\Ai\Agents\GradeSubmissionAgent;
use App\Jobs\GradeSubmissionJob;
use App\Models\SkillCourse;
use App\Models\SkillLesson;
use App\Models\SkillSubmission;
use App\Models\User;
use App\Models\UserSkillProgress;
use App\Services\Skills\SubmissionGradingService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;

/**
 * A structured review matching GradeSubmissionAgent's schema.
 *
 * @param  array<string, mixed>  $overrides
 * @return array<string, mixed>
 */
function review(array $overrides = []): array
{
    return [
        'passed' => true,
        'score' => 85,
        'strengths' => ['Strong hook', 'Clear CTA'],
        'fixes' => [],
        'next_step' => 'Try varying the hook next time.',
        'flags' => [
            'off_topic' => false,
            'gibberish' => false,
            'injection_attempt' => false,
            'wrong_format' => false,
        ],
        ...$overrides,
    ];
}

beforeEach(function () {
    $this->user = User::factory()->onboarded()->create(['xp' => 0]);
    $this->course = SkillCourse::factory()->published()->create(['skill_key' => 'demo-va', 'order' => 1]);
    $this->l1 = SkillLesson::factory()->published()->create([
        'skill_course_id' => $this->course->id, 'order' => 1, 'accepted_formats' => ['text'], 'xp_reward' => 100,
    ]);
    $this->l2 = SkillLesson::factory()->published()->create([
        'skill_course_id' => $this->course->id, 'order' => 2, 'accepted_formats' => ['image', 'file'], 'xp_reward' => 150,
    ]);
});

function submitText($user, $course, $lesson, string $text = 'Here is my caption: warm, clear, with a call to order today.')
{
    return test()->actingAs($user)->post(
        route('skills.submissions.store', ['course' => $course, 'lesson' => $lesson]),
        ['format' => 'text', 'body_text' => $text],
    );
}

it('stores a queued text submission and dispatches grading', function () {
    Bus::fake();

    submitText($this->user, $this->course, $this->l1)
        ->assertRedirect(route('skills.lessons.show', ['course' => $this->course, 'lesson' => $this->l1]));

    $submission = SkillSubmission::sole();
    expect($submission->status)->toBe(SkillSubmission::STATUS_QUEUED)
        ->and($submission->format)->toBe('text')
        ->and($submission->submission_hash)->not->toBeNull();

    Bus::assertDispatched(GradeSubmissionJob::class);
});

it('stores an uploaded image on the private disk', function () {
    Storage::fake('local');
    Bus::fake();

    UserSkillProgress::factory()->create([
        'user_id' => $this->user->id, 'skill_course_id' => $this->course->id, 'current_lesson_order' => 2,
    ]);

    $this->actingAs($this->user)->post(
        route('skills.submissions.store', ['course' => $this->course, 'lesson' => $this->l2]),
        ['format' => 'image', 'file' => UploadedFile::fake()->image('promo.png')],
    )->assertRedirect();

    $submission = SkillSubmission::sole();
    expect($submission->format)->toBe('image')
        ->and($submission->file_path)->not->toBeNull();
    Storage::disk('local')->assertExists($submission->file_path);
});

it('grades a passing submission, advances the course, and awards xp', function () {
    GradeSubmissionAgent::fake([review()]);

    $submission = SkillSubmission::factory()->create([
        'user_id' => $this->user->id, 'skill_lesson_id' => $this->l1->id, 'format' => 'text',
    ]);

    app(SubmissionGradingService::class)->grade($submission);

    expect($submission->refresh()->status)->toBe(SkillSubmission::STATUS_GRADED)
        ->and($submission->ai_passed)->toBeTrue()
        ->and($submission->ai_score)->toBe(85);

    $progress = UserSkillProgress::where('user_id', $this->user->id)->where('skill_course_id', $this->course->id)->first();
    expect($progress->current_lesson_order)->toBe(2);
    expect($this->user->refresh()->xp)->toBe(100);
});

it('completes the course when the final lesson passes', function () {
    UserSkillProgress::factory()->create([
        'user_id' => $this->user->id, 'skill_course_id' => $this->course->id, 'current_lesson_order' => 2,
    ]);
    GradeSubmissionAgent::fake([review()]);

    $submission = SkillSubmission::factory()->create([
        'user_id' => $this->user->id, 'skill_lesson_id' => $this->l2->id, 'format' => 'text',
    ]);
    app(SubmissionGradingService::class)->grade($submission);

    $progress = UserSkillProgress::where('user_id', $this->user->id)->where('skill_course_id', $this->course->id)->first();
    expect($progress->status)->toBe(UserSkillProgress::STATUS_COMPLETED)
        ->and($progress->completed_at)->not->toBeNull();
});

it('does not advance on a failing grade', function () {
    GradeSubmissionAgent::fake([review(['passed' => false, 'score' => 40, 'fixes' => ['Add a clear CTA']])]);

    $submission = SkillSubmission::factory()->create([
        'user_id' => $this->user->id, 'skill_lesson_id' => $this->l1->id, 'format' => 'text',
    ]);
    app(SubmissionGradingService::class)->grade($submission);

    expect($submission->refresh()->ai_passed)->toBeFalse();
    $progress = UserSkillProgress::where('user_id', $this->user->id)->first();
    expect($progress?->current_lesson_order ?? 1)->toBe(1);
    expect($this->user->refresh()->xp)->toBe(0);
});

it('forces a fail on an anti-gaming flag and below-threshold score', function () {
    GradeSubmissionAgent::fake([
        review(['passed' => true, 'score' => 99, 'flags' => ['off_topic' => false, 'gibberish' => false, 'injection_attempt' => true, 'wrong_format' => false]]),
    ]);

    $submission = SkillSubmission::factory()->create([
        'user_id' => $this->user->id, 'skill_lesson_id' => $this->l1->id, 'format' => 'text',
    ]);
    app(SubmissionGradingService::class)->grade($submission);

    expect($submission->refresh()->ai_passed)->toBeFalse();
});

it('marks the submission failed when the grader errors', function () {
    GradeSubmissionAgent::fake(function () {
        throw new RuntimeException('vision grader down');
    });

    $submission = SkillSubmission::factory()->create([
        'user_id' => $this->user->id, 'skill_lesson_id' => $this->l1->id, 'format' => 'text',
    ]);
    app(SubmissionGradingService::class)->grade($submission);

    expect($submission->refresh()->status)->toBe(SkillSubmission::STATUS_FAILED)
        ->and($submission->ai_passed)->toBeNull();
});

it('reuses the grade for an identical resubmission', function () {
    $calls = 0;
    GradeSubmissionAgent::fake(function () use (&$calls) {
        $calls++;

        return review(['passed' => false, 'score' => 50]);
    });

    $hash = hash('sha256', 'same content');
    foreach (range(1, 2) as $ignored) {
        $submission = SkillSubmission::factory()->create([
            'user_id' => $this->user->id, 'skill_lesson_id' => $this->l1->id, 'format' => 'text', 'submission_hash' => $hash,
        ]);
        app(SubmissionGradingService::class)->grade($submission);
    }

    expect($calls)->toBe(1);
});

it('forbids submitting to a locked lesson', function () {
    Bus::fake();

    $this->actingAs($this->user)->post(
        route('skills.submissions.store', ['course' => $this->course, 'lesson' => $this->l2]),
        ['format' => 'image', 'file' => UploadedFile::fake()->image('x.png')],
    )->assertForbidden();
});

it('serves an uploaded file only to its owner', function () {
    Storage::fake('local');
    $path = UploadedFile::fake()->image('p.png')->store('submissions/'.$this->user->id, 'local');
    $submission = SkillSubmission::factory()->create([
        'user_id' => $this->user->id, 'skill_lesson_id' => $this->l2->id, 'format' => 'image', 'file_path' => $path,
    ]);

    $this->actingAs($this->user)->get(route('skills.submissions.file', $submission))->assertOk();

    $other = User::factory()->onboarded()->create();
    $this->actingAs($other)->get(route('skills.submissions.file', $submission))->assertForbidden();
});

it('never leaks the rubric or reference notes to the lesson page', function () {
    $this->actingAs($this->user)
        ->get(route('skills.lessons.show', ['course' => $this->course, 'lesson' => $this->l1]))
        ->assertOk()
        ->assertInertia(fn ($page) => $page
            ->component('skills/Lesson')
            ->where('lesson.brief', $this->l1->brief)
            ->missing('lesson.rubric')
            ->missing('lesson.referenceNotes')
            ->missing('lesson.reference_notes')
        );
});

it('shows only published courses in the shared catalog with recommendations', function () {
    SkillCourse::factory()->create(['skill_key' => 'draft-va']); // unpublished
    $user = User::factory()->onboarded()->create(['va_skills' => ['social_media']]);
    SkillCourse::factory()->published()->create(['skill_key' => 'social-media-va', 'order' => 0]);

    $this->actingAs($user)->get(route('skills.index'))
        ->assertInertia(fn ($page) => $page
            ->component('skills/Index')
            ->where('courses', fn ($courses) => collect($courses)->doesntContain('skillKey', 'draft-va')
                && collect($courses)->firstWhere('skillKey', 'social-media-va')['recommended'] === true
            )
        );
});
