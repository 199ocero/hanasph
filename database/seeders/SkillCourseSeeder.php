<?php

namespace Database\Seeders;

use App\Models\SkillCourse;
use App\Models\SkillLesson;
use Illuminate\Database\Seeder;

/**
 * Seeds a hand-written demo course so the upload-and-grade flow can be used and
 * verified before the AI-generated catalog (Phase 4) exists. Idempotent.
 */
class SkillCourseSeeder extends Seeder
{
    public function run(): void
    {
        $course = SkillCourse::updateOrCreate(
            ['skill_key' => 'social-media-va'],
            [
                'title' => 'Social Media VA',
                'subtitle' => 'Captions, community, and content that clients love.',
                'icon' => 'Megaphone',
                'order' => 1,
                'source' => 'authored',
                'published_at' => now(),
            ],
        );

        foreach ($this->lessons() as $lesson) {
            SkillLesson::updateOrCreate(
                ['skill_course_id' => $course->id, 'order' => $lesson['order']],
                [...$lesson, 'published_at' => now()],
            );
        }
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function lessons(): array
    {
        return [
            [
                'order' => 1,
                'title' => 'Write a caption that stops the scroll',
                'brief' => "A client runs a small home-baking business, Nena's Kitchen. They just launched a new ube cheese pandesal and want an Instagram caption to announce it. Write the caption you'd post — include a hook, the key detail, and a clear call to action. Keep it warm and on-brand for a cosy local bakery.",
                'rubric' => [
                    ['criterion' => 'Hook', 'weight' => 35, 'what_good_looks_like' => 'Opens with a line that earns a stop — not "We are excited to announce".'],
                    ['criterion' => 'Clarity', 'weight' => 30, 'what_good_looks_like' => 'The product and what makes it special are unmistakable in one read.'],
                    ['criterion' => 'Call to action', 'weight' => 35, 'what_good_looks_like' => 'A specific next step (order, DM, visit) — not a vague "check it out".'],
                ],
                'reference_notes' => 'A strong caption feels human, mentions ube + cheese pandesal clearly, and ends with an orderable CTA. Reject generic corporate phrasing.',
                'accepted_formats' => ['text'],
                'difficulty' => 'easy',
                'xp_reward' => 100,
            ],
            [
                'order' => 2,
                'title' => 'Handle an unhappy comment',
                'brief' => "A follower comments publicly: \"Ordered last week and my cake arrived late and melted. So disappointed.\" Write the public reply you'd post as the brand. Aim to de-escalate, take responsibility, and move the conversation to a private channel — without being defensive or over-promising.",
                'rubric' => [
                    ['criterion' => 'Empathy', 'weight' => 35, 'what_good_looks_like' => 'Acknowledges the specific problem and how it felt, first.'],
                    ['criterion' => 'Ownership', 'weight' => 30, 'what_good_looks_like' => 'Takes responsibility without excuses or blame.'],
                    ['criterion' => 'Resolution', 'weight' => 35, 'what_good_looks_like' => 'Moves to DM/private and offers a concrete next step.'],
                ],
                'reference_notes' => 'Public, calm, human. No defensiveness, no legalese, no over-promising refunds publicly. Should invite a DM.',
                'accepted_formats' => ['text'],
                'difficulty' => 'medium',
                'xp_reward' => 150,
            ],
            [
                'order' => 3,
                'title' => 'Ship a promo graphic',
                'brief' => "Create a simple promo graphic announcing 20% off this weekend for Nena's Kitchen, and upload it (an image export, or a PDF/screenshot of your design). It should read clearly at a glance: the offer, the dates, and how to order. Keep the hierarchy clean and the text legible on a phone screen.",
                'rubric' => [
                    ['criterion' => 'Hierarchy', 'weight' => 35, 'what_good_looks_like' => 'The offer is the biggest thing; supporting details are clearly secondary.'],
                    ['criterion' => 'Legibility', 'weight' => 35, 'what_good_looks_like' => 'Text is readable at phone size with enough contrast and spacing.'],
                    ['criterion' => 'Completeness', 'weight' => 30, 'what_good_looks_like' => 'Offer, dates, and how-to-order are all present and unambiguous.'],
                ],
                'reference_notes' => 'Judge visual hierarchy, contrast, and whether all three facts (offer, dates, order method) are present and legible. A plain block of text is the wrong format.',
                'accepted_formats' => ['image', 'file'],
                'difficulty' => 'hard',
                'xp_reward' => 200,
            ],
        ];
    }
}
