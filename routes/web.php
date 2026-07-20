<?php

use App\Http\Controllers\AttemptController;
use App\Http\Controllers\FreeTextAttemptController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\SkillCourseController;
use App\Http\Controllers\SkillLessonController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('onboarding', [OnboardingController::class, 'show'])->name('onboarding.show');
    Route::post('onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');

    Route::middleware('onboarded')->group(function () {
        Route::get('dashboard', [TrackController::class, 'index'])->name('dashboard');
        Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::post('tasks/{task}/beats/{beat}/attempt', [AttemptController::class, 'store'])
            ->scopeBindings()
            ->name('tasks.beats.attempt');
        Route::post('tasks/{task}/beats/{beat}/reply', [FreeTextAttemptController::class, 'store'])
            ->scopeBindings()
            ->middleware('throttle:20,1')
            ->name('tasks.beats.reply');

        Route::prefix('skills')->name('skills.')->group(function () {
            Route::get('/', [SkillCourseController::class, 'index'])->name('index');
            Route::get('submissions/{submission}/file', [SubmissionController::class, 'file'])
                ->name('submissions.file');
            Route::get('{course}', [SkillCourseController::class, 'show'])->name('courses.show');
            Route::get('{course}/lessons/{lesson}', [SkillLessonController::class, 'show'])
                ->scopeBindings()
                ->name('lessons.show');
            Route::post('{course}/lessons/{lesson}/submissions', [SubmissionController::class, 'store'])
                ->scopeBindings()
                ->middleware('throttle:20,1')
                ->name('submissions.store');
        });
    });
});

require __DIR__.'/settings.php';
