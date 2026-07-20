<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\Gamification\GamificationService;
use App\Services\Skills\SkillCatalog;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $user,
            ],
            'progression' => $user === null ? null : $this->progressionFor($user),
            'catalog' => $user === null || $user->onboarded_at === null
                ? []
                : app(SkillCatalog::class)->forNav($user),
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
        ];
    }

    /**
     * The player's gamification header data, shared on every authed page.
     *
     * @return array{level: int, xpIntoLevel: int, xpForNextLevel: int, xp: int, streak: int}
     */
    protected function progressionFor(User $user): array
    {
        $xp = (int) ($user->xp ?? 0);
        $progression = app(GamificationService::class)->progression($xp);

        return [
            ...$progression,
            'xp' => $xp,
            'streak' => (int) ($user->current_streak ?? 0),
        ];
    }
}
