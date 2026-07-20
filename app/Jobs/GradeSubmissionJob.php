<?php

namespace App\Jobs;

use App\Models\SkillSubmission;
use App\Services\Skills\SubmissionGradingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

/**
 * Grades an uploaded skill-lesson submission off the request cycle, since
 * multimodal grading is a slow, heavy round-trip.
 */
class GradeSubmissionJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public SkillSubmission $submission) {}

    public function handle(SubmissionGradingService $grading): void
    {
        $grading->grade($this->submission);
    }

    /**
     * Mark the submission failed if the job exhausts its retries.
     */
    public function failed(): void
    {
        $this->submission->update(['status' => SkillSubmission::STATUS_FAILED]);
    }
}
