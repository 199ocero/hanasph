<?php

namespace App\Http\Controllers;

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use App\Models\SkillSubmission;
use App\Models\UserSkillProgress;
use App\Services\Skills\SkillCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SkillCourseController extends Controller
{
    /**
     * The catalog of published courses.
     */
    public function index(Request $request, SkillCatalog $catalog): Response
    {
        return Inertia::render('skills/Index', [
            'courses' => $catalog->forIndex($request->user()),
            'foundationComplete' => $request->user()->hasCompletedFoundation(),
        ]);
    }

    /**
     * A course's lesson ladder with the user's progress.
     */
    public function show(Request $request, SkillCourse $course): Response|RedirectResponse
    {
        abort_unless($course->isPublished(), 404);

        $user = $request->user();

        // Skill courses stay locked until the whole Foundation is finished.
        if (! $user->hasCompletedFoundation()) {
            return redirect()->route('skills.index');
        }

        $progress = UserSkillProgress::firstOrCreate(
            ['user_id' => $user->id, 'skill_course_id' => $course->id],
            ['current_lesson_order' => 1],
        );

        $passedLessonIds = SkillSubmission::query()
            ->where('user_id', $user->id)
            ->where('ai_passed', true)
            ->pluck('skill_lesson_id')
            ->unique();

        $lessons = $course->lessons()
            ->whereNotNull('published_at')
            ->get()
            ->map(fn (SkillLesson $lesson): array => [
                'id' => $lesson->id,
                'order' => $lesson->order,
                'title' => $lesson->title,
                'difficulty' => $lesson->difficulty,
                'xpReward' => $lesson->xp_reward,
                'state' => $this->lessonState($lesson, $progress, $passedLessonIds->contains($lesson->id)),
            ])
            ->values();

        return Inertia::render('skills/Course', [
            'course' => [
                'skillKey' => $course->skill_key,
                'title' => $course->title,
                'subtitle' => $course->subtitle,
                'icon' => $course->icon,
            ],
            'lessons' => $lessons,
            'progress' => [
                'currentLessonOrder' => $progress->current_lesson_order,
                'completed' => $progress->status === UserSkillProgress::STATUS_COMPLETED,
            ],
        ]);
    }

    /**
     * The ladder state of a lesson: passed, current (unlocked), or locked.
     */
    private function lessonState(SkillLesson $lesson, UserSkillProgress $progress, bool $passed): string
    {
        if ($passed || $lesson->order < $progress->current_lesson_order) {
            return 'passed';
        }

        return $lesson->order === $progress->current_lesson_order ? 'current' : 'locked';
    }
}
