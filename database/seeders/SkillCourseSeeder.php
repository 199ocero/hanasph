<?php

namespace Database\Seeders;

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use Illuminate\Database\Seeder;
use RuntimeException;

/**
 * Seeds the hand-authored skill-course catalog from the per-niche lesson files
 * under content_skills/. Course meta (title, subtitle, icon, order) is read
 * from config/skills.php by matching the file name to a catalog key. Idempotent:
 * courses upsert by skill_key and lessons by (course, order).
 */
class SkillCourseSeeder extends Seeder
{
    public function run(): void
    {
        $files = glob(database_path('seeders/content_skills/*.php'));
        sort($files);

        foreach ($files as $file) {
            $skillKey = basename($file, '.php');
            $meta = (array) config("skills.catalog.{$skillKey}");

            if ($meta === []) {
                throw new RuntimeException("Skill course [{$skillKey}] has no catalog entry in config/skills.php.");
            }

            $course = SkillCourse::updateOrCreate(
                ['skill_key' => $skillKey],
                [
                    'title' => $meta['title'],
                    'subtitle' => $meta['subtitle'] ?? null,
                    'icon' => $meta['icon'] ?? null,
                    'order' => $meta['order'] ?? 0,
                    'source' => 'authored',
                    'published_at' => now(),
                ],
            );

            foreach (require $file as $lesson) {
                SkillLesson::updateOrCreate(
                    ['skill_course_id' => $course->id, 'order' => $lesson['order']],
                    [...$lesson, 'published_at' => now()],
                );
            }
        }
    }
}
