<?php

namespace App\Http\Controllers;

use App\Services\Onboarding\OnboardingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class OnboardingController extends Controller
{
    /**
     * Answer option keys accepted from the onboarding form.
     */
    private const SKILLS = [
        'admin', 'social_media', 'design', 'customer_support',
        'tech', 'writing', 'data_entry', 'project_management', 'none_yet',
    ];

    private const MOTIVATIONS = ['earn_more', 'work_from_home', 'new_career', 'already_va'];

    private const CHALLENGES = ['knowing_expectations', 'talking_to_clients', 'too_many_things', 'using_ai'];

    /**
     * Show the onboarding flow (or bounce onboarded users to the track).
     */
    public function show(Request $request): Response|RedirectResponse
    {
        if ($request->user()->hasOnboarded()) {
            return redirect()->route('dashboard');
        }

        return Inertia::render('Onboarding');
    }

    /**
     * Persist the three answers, build the starting progress, and open the
     * user on their challenge-matched entry task.
     */
    public function store(Request $request, OnboardingService $service): RedirectResponse
    {
        if ($request->user()->hasOnboarded()) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'va_skills' => ['required', 'array', 'min:1'],
            'va_skills.*' => ['string', Rule::in(self::SKILLS)],
            'va_motivation' => ['required', 'string', Rule::in(self::MOTIVATIONS)],
            'va_challenge' => ['required', 'string', Rule::in(self::CHALLENGES)],
        ]);

        $entryTask = $service->complete($request->user(), $validated);

        return redirect()->route('tasks.show', $entryTask);
    }
}
