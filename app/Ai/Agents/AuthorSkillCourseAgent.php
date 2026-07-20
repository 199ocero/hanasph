<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Promptable;

/**
 * Authors a full easy->hard course of upload-and-grade lessons for a VA niche.
 * Output is validated and human-reviewed before publishing — this agent drafts,
 * it does not ship.
 */
#[Provider(Lab::Anthropic)]
class AuthorSkillCourseAgent implements Agent, HasStructuredOutput
{
    use Promptable;

    /**
     * @param  string  $niche  Human label, e.g. "Social Media VA".
     * @param  string  $focus  What the niche covers, e.g. "captions, community, content calendars".
     */
    public function __construct(private string $niche, private string $focus) {}

    public function instructions(): string
    {
        return <<<PROMPT
        You design practical micro-courses for Filipino virtual assistant trainees.
        Author a course for the "{$this->niche}" niche, covering {$this->focus}.

        Produce 5 to 7 lessons that climb from easy to hard. Each lesson asks the
        trainee to produce a REAL deliverable they would hand a client, which is
        then graded. Follow this quality bar:

        - brief: a concrete, client-flavoured task in 2-4 sentences. Give a
          realistic client and scenario. Make it obvious what to submit.
        - rubric: 3-4 criteria, each with a weight (the weights sum to 100) and a
          one-sentence "what good looks like". Criteria must be things a reviewer
          can actually judge from the deliverable.
        - reference_notes: private guidance for the grader on what separates a pass
          from a fail. Never addressed to the trainee.
        - accepted_formats: which of "text", "image", "file" the trainee may submit.
          Use "text" for writing tasks; add "image"/"file" when the deliverable is a
          designed asset, spreadsheet, or document.
        - difficulty: "easy", "medium", or "hard". Difficulty must not decrease as
          the order increases.
        - xp_reward: 100 for easy, 150 for medium, 200 for hard.

        Keep it grounded, warm, and specific to real VA work — no fluff.
        PROMPT;
    }

    /**
     * @return array<string, mixed>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'lessons' => $schema->array()->items(
                $schema->object(fn (JsonSchema $schema): array => [
                    'order' => $schema->integer()->min(1)->required(),
                    'title' => $schema->string()->required(),
                    'brief' => $schema->string()->required(),
                    'rubric' => $schema->array()->items(
                        $schema->object(fn (JsonSchema $schema): array => [
                            'criterion' => $schema->string()->required(),
                            'weight' => $schema->integer()->min(1)->max(100)->required(),
                            'what_good_looks_like' => $schema->string()->required(),
                        ])
                    )->required(),
                    'reference_notes' => $schema->string()->required(),
                    'accepted_formats' => $schema->array()->items(
                        $schema->string()->enum(['text', 'image', 'file'])
                    )->required(),
                    'difficulty' => $schema->string()->enum(['easy', 'medium', 'hard'])->required(),
                    'xp_reward' => $schema->integer()->min(1)->required(),
                ])
            )->required(),
        ];
    }
}
