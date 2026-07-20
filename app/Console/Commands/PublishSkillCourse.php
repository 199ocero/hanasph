<?php

namespace App\Console\Commands;

use App\Models\SkillCourse;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('skills:publish {skill? : The catalog skill key} {--all : Publish every drafted course}')]
#[Description('Publish reviewed skill courses so learners can start them.')]
class PublishSkillCourse extends Command
{
    public function handle(): int
    {
        $keys = $this->option('all')
            ? SkillCourse::query()->pluck('skill_key')->all()
            : array_filter([$this->argument('skill')]);

        if ($keys === []) {
            $this->error('Provide a skill key or pass --all.');

            return self::FAILURE;
        }

        foreach ($keys as $key) {
            $course = SkillCourse::where('skill_key', $key)->first();

            if ($course === null) {
                $this->error("  ✗ {$key}: not found.");

                continue;
            }

            if ($course->lessons()->count() === 0) {
                $this->error("  ✗ {$key}: has no lessons to publish.");

                continue;
            }

            $now = now();
            $course->update(['published_at' => $now]);
            $course->lessons()->update(['published_at' => $now]);

            $this->line("  <info>✓</info> published {$key}.");
        }

        return self::SUCCESS;
    }
}
