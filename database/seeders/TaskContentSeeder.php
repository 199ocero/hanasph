<?php

namespace Database\Seeders;

use App\Models\Beat;
use App\Models\Lesson;
use App\Models\Option;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeds all task content from the per-task array files under content/.
 *
 * Each file returns one task's full definition (task -> beats -> options ->
 * lessons). Seeding is idempotent: tasks upsert by slug, beats by
 * (task, order), options by (beat, order), lessons by slug — so re-running
 * after a content edit updates in place rather than duplicating.
 */
class TaskContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = glob(database_path('seeders/content/*.php'));
        sort($files);

        DB::transaction(function () use ($files) {
            foreach ($files as $file) {
                $this->seedTask(require $file);
            }
        });
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function seedTask(array $data): void
    {
        $task = Task::updateOrCreate(
            ['slug' => $data['slug']],
            [
                'order' => $data['order'],
                'title' => $data['title'],
                'client_persona' => $data['client_persona'],
                'scenario_intro' => $data['scenario_intro'],
                'xp_reward' => $data['xp_reward'] ?? 100,
                'is_gentle_opener' => $data['is_gentle_opener'] ?? false,
                'onboarding_entry_key' => $data['onboarding_entry_key'] ?? null,
                'category' => $data['category'],
                'ai_grading_enabled' => $data['ai_grading_enabled'] ?? false,
            ],
        );

        foreach ($data['beats'] as $beatData) {
            $beat = Beat::updateOrCreate(
                ['task_id' => $task->id, 'order' => $beatData['order']],
                [
                    'client_message' => $beatData['client_message'],
                    'scaffold_hint' => $beatData['scaffold_hint'] ?? null,
                ],
            );

            foreach ($beatData['options'] as $optionData) {
                $lessonId = null;

                if (! empty($optionData['lesson'])) {
                    $lesson = Lesson::updateOrCreate(
                        ['slug' => $optionData['lesson']['slug']],
                        [
                            'title' => $optionData['lesson']['title'],
                            'body' => $optionData['lesson']['body'],
                        ],
                    );

                    $lessonId = $lesson->id;
                }

                Option::updateOrCreate(
                    ['beat_id' => $beat->id, 'order' => $optionData['order']],
                    [
                        'body' => $optionData['body'],
                        'is_correct' => $optionData['is_correct'],
                        'diagnostic' => $optionData['diagnostic'] ?? null,
                        'lesson_id' => $lessonId,
                    ],
                );
            }
        }
    }
}
