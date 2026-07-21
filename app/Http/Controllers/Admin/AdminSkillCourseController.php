<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkillCourse;
use App\Models\SkillLesson;
use Inertia\Inertia;
use Inertia\Response;

class AdminSkillCourseController extends Controller
{
    /**
     * Show a skill course's full lesson answer key, including unpublished
     * lessons. Admin-only QA view: rubric/reference_notes are intentionally
     * included here even though they are $hidden on SkillLesson by default.
     */
    public function show(SkillCourse $course): Response
    {
        $lessons = $course->lessons()->get();

        return Inertia::render('admin/SkillCourseShow', [
            'course' => [
                'skillKey' => $course->skill_key,
                'title' => $course->title,
                'subtitle' => $course->subtitle,
                'source' => $course->source,
                'isPublished' => $course->isPublished(),
            ],
            'lessons' => $lessons->map(fn (SkillLesson $lesson): array => [
                'id' => $lesson->id,
                'order' => $lesson->order,
                'title' => $lesson->title,
                'brief' => $lesson->brief,
                'difficulty' => $lesson->difficulty,
                'xpReward' => $lesson->xp_reward,
                'acceptedFormats' => $lesson->accepted_formats,
                'tip' => $lesson->tip,
                'aiLeverage' => $lesson->ai_leverage,
                'isPublished' => $lesson->published_at !== null,
                'rubric' => $lesson->rubric,
                'referenceNotes' => $lesson->reference_notes,
            ])->values(),
        ]);
    }
}
