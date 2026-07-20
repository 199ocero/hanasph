<?php

namespace App\Console\Commands;

use App\Services\Skills\CourseGenerator;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Throwable;

#[Signature('skills:generate {skill? : The catalog skill key} {--all : Generate every catalog niche}')]
#[Description('Author draft skill courses with AI (unpublished, pending review).')]
class GenerateSkillCourse extends Command
{
    public function handle(CourseGenerator $generator): int
    {
        $keys = $this->option('all')
            ? array_keys((array) config('skills.catalog', []))
            : array_filter([$this->argument('skill')]);

        if ($keys === []) {
            $this->error('Provide a skill key or pass --all.');

            return self::FAILURE;
        }

        $failed = 0;

        foreach ($keys as $key) {
            $this->info("Generating {$key}…");

            try {
                $course = $generator->generate($key);
                $count = $course->lessons()->count();
                $this->line("  <info>✓</info> {$count} lessons drafted (unpublished). Review, then: php artisan skills:publish {$key}");
            } catch (Throwable $e) {
                $failed++;
                $this->error("  ✗ {$e->getMessage()}");
            }
        }

        return $failed === 0 ? self::SUCCESS : self::FAILURE;
    }
}
