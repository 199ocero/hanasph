<?php

use App\Models\User;
use App\Services\Gamification\GamificationService;
use App\Services\Tasks\ProgressionService;
use Illuminate\Support\Carbon;

it('maps xp to the right level and progress', function (int $xp, int $level, int $into, int $forNext) {
    $result = app(GamificationService::class)->progression($xp);

    expect($result['level'])->toBe($level)
        ->and($result['xpIntoLevel'])->toBe($into)
        ->and($result['xpForNextLevel'])->toBe($forNext);
})->with([
    'zero' => [0, 1, 0, 200],
    'mid level 1' => [100, 1, 100, 200],
    'exactly level 2' => [200, 2, 0, 400],
    'mid level 2' => [250, 2, 50, 400],
    'level 3 boundary' => [600, 3, 0, 600],
]);

it('increments the streak on consecutive days and resets after a gap', function () {
    $service = app(ProgressionService::class);
    $user = User::factory()->create();

    Carbon::setTestNow('2026-07-20 09:00:00');
    $service->updateStreak($user);
    expect($user->refresh()->current_streak)->toBe(1);

    // Same day again — no change.
    $service->updateStreak($user);
    expect($user->refresh()->current_streak)->toBe(1);

    // Next day — increments.
    Carbon::setTestNow('2026-07-21 09:00:00');
    $service->updateStreak($user);
    expect($user->refresh()->current_streak)->toBe(2);

    // Skip a day — resets to 1, longest retained.
    Carbon::setTestNow('2026-07-23 09:00:00');
    $service->updateStreak($user);
    $user->refresh();
    expect($user->current_streak)->toBe(1)
        ->and($user->longest_streak)->toBe(2);

    Carbon::setTestNow();
});

it('does not award xp twice for an already-passed task', function () {
    $user = User::factory()->create();
    $task = makeTask(order: 1, beats: 1);

    $service = app(ProgressionService::class);
    $service->passTask($user, $task);
    $firstXp = $user->refresh()->xp;

    $service->passTask($user, $task);
    expect($user->refresh()->xp)->toBe($firstXp);
});
