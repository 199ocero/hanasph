<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkillCourse;
use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * List every Foundation task and skill course for the admin QA panel.
     */
    public function index(): Response
    {
        $tasks = Task::withCount('beats')->orderBy('order')->get()
            ->map(fn (Task $task): array => [
                'slug' => $task->slug,
                'order' => $task->order,
                'title' => $task->title,
                'category' => $task->category,
                'aiGradingEnabled' => $task->ai_grading_enabled,
                'beatsCount' => $task->beats_count,
            ])->values();

        $courses = SkillCourse::withCount('lessons')->orderBy('order')->get()
            ->map(fn (SkillCourse $course): array => [
                'skillKey' => $course->skill_key,
                'title' => $course->title,
                'subtitle' => $course->subtitle,
                'isPublished' => $course->isPublished(),
                'lessonsCount' => $course->lessons_count,
            ])->values();

        return Inertia::render('admin/Dashboard', [
            'tasks' => $tasks,
            'courses' => $courses,
        ]);
    }
}
