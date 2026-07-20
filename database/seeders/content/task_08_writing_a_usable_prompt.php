<?php

/*
 * QUALITY BAR — every wrong option must satisfy all five:
 *  1. Plausible: a real beginner could genuinely pick it.
 *  2. Distinctly wrong: fails for a DIFFERENT reason than the other wrongs.
 *  3. Diagnostic is ONE defensible sentence a working VA would agree with.
 *  4. Exactly one is_correct === true per beat.
 *  5. Lesson teaches the principle, not the answer; fits one screen.
 */

return [
    'slug' => 'writing-a-usable-prompt',
    'order' => 8,
    'title' => 'Getting AI to do it right',
    'client_persona' => 'Dennis — runs a small online gadget shop',
    'scenario_intro' => 'Dennis sells phone accessories online and just asked you to draft a promo email for his weekend sale. He wants something he can send to customers, not a rough sketch he has to fix.',
    'xp_reward' => 125,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'ai',
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Hey! Can you whip up an email about our weekend sale? 20% off all cases and chargers, code WEEKEND20, ends Sunday midnight. Send it to me and I'll blast it to the customer list. Slammed today, thanks!!",
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Type a quick prompt — "write an email about our weekend sale" — then copy whatever the AI gives back and send that straight to Dennis.',
                    'is_correct' => false,
                    'diagnostic' => 'A one-line prompt with no context gives you a generic email that could be for any shop, and shipping it raw makes that the client\'s problem.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-context-is-the-work',
                        'title' => 'The context you give is the work',
                        'body' => "AI can only be as specific as your prompt. Ask it to \"write an email about our sale\" and it has no idea who the shop is, who's reading, or what makes this sale worth opening — so it fills the gaps with bland filler that sounds like every other email.\n\nThe useful facts already live in the client's message: the products, the discount, the code, the deadline. Feeding those in isn't extra effort, it *is* the job. A thin prompt just moves the real work — adding the specifics — onto the client after they read the flat result.\n\nWhoever supplies the context gets output worth sending. Skip it and you've handed AI a blank page and hoped.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => 'Write one huge prompt cramming in everything — make it formal but also playful, long but keep it short, list every product in the shop, offer five backup discount codes, three subject lines, maybe a little poem — and use whatever comes out.',
                    'is_correct' => false,
                    'diagnostic' => 'Piling in contradictory instructions like "formal but playful" and "long but short" pulls the output in every direction, so it lands as a muddled mess.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-clarity-beats-volume',
                        'title' => 'More instructions is not a clearer instruction',
                        'body' => "Beginners often think a better prompt means a bigger one, so they stuff in every idea at once. But when you ask for opposite things — formal and playful, detailed and short — the AI can't satisfy both, so it splits the difference and satisfies neither.\n\nGood direction is specific, not maximal. Pick one tone, one goal, one clear format, and the few facts that matter. Everything you add beyond that either repeats itself or fights something else you said.\n\nAim your prompt at a single clear target. A focused ask produces a focused draft; a crowded ask produces confusion you then have to untangle by hand.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Write a specific prompt: \"You're writing a short promo email for Dennis's Gadget Hub, a small online shop, to past customers. Announce a weekend sale: 20% off all cases and chargers with code WEEKEND20, ends Sunday midnight. Friendly and upbeat, under 120 words, with a subject line and one clear call-to-action.\" Then review what it produces before sending to Dennis.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => 'Skip the AI — it never sounds right anyway — and write the whole email yourself from scratch, even if it eats up your afternoon.',
                    'is_correct' => false,
                    'diagnostic' => 'You spent hours doing by hand what a well-aimed prompt would have drafted in a minute, so the client waited longer for no extra quality.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-use-the-tool-you-have',
                        'title' => 'Don\'t grind out what a good prompt would nail',
                        'body' => "AI \"never sounds right\" is usually a story people tell after feeding it a lazy prompt and getting a lazy result. The tool wasn't the problem; the direction was. Give it real context and it drafts in seconds what would take you an afternoon.\n\nYour value isn't proving you can do everything unassisted — it's turning the client's request around quickly and well. A task where AI clearly helps is exactly where you should reach for it, then spend your time reviewing and refining rather than typing from zero.\n\nWork slowly by hand when the tool genuinely can't help. Don't do it to avoid learning the tool.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => 'Close! But it reads a bit stiff and corporate — my customers know me, it should feel warmer. Also you left out that orders over ₱1,000 ship free, which is honestly the biggest draw. Can you fix?',
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Update the prompt with the exact fixes — "Make the tone warmer and casual, like a message to a regular customer, and include that orders over ₱1,000 ship free" — keep everything else the same, and re-run it.',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => 'Leave the prompt as it is and just hit generate a few more times, hoping one of the versions happens to come out warmer and mentions the free shipping.',
                    'is_correct' => false,
                    'diagnostic' => 'Re-rolling the same prompt only shuffles the wording — it can\'t add a fact you never gave it or reliably shift a tone you never asked for.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-refine-dont-reroll',
                        'title' => 'Fix the instruction, not the dice',
                        'body' => "When output is off, the tempting move is to regenerate and hope the next one is better. But the AI is answering the same prompt each time, so you're just spinning a wheel — it can't invent the free-shipping fact you never mentioned, no matter how many tries.\n\nTreat a wrong result as feedback about your prompt. The client told you exactly what's missing: warmer tone, and the shipping line. Feed those specific corrections back in and the next version fixes both on purpose, not by luck.\n\nRe-rolling is gambling. Refining is steering. One wastes attempts; the other closes the gap deliberately.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Leave the prompt alone and just rewrite the AI's output yourself by hand — warm up the wording and paste in the shipping line manually.",
                    'is_correct' => false,
                    'diagnostic' => 'Hand-patching this one output leaves your prompt still broken, so the next time you need a similar email you\'re back to fixing it manually all over again.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-fix-the-source',
                        'title' => 'Fix the prompt so the fix sticks',
                        'body' => "Manually editing the output solves today's email and nothing else. The prompt that produced the stiff, shipping-less draft is unchanged, so every future run repeats the same mistakes and you keep doing the same cleanup by hand.\n\nWhen a correction is about *what* the output should contain or how it should sound, it usually belongs in the prompt, not in a one-off edit. Fix it at the source and the improvement carries forward to every version you generate after.\n\nHand-editing is for the last 5% of polish. Don't use it to paper over a prompt you could just improve.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Decide it's basically fine — send Dennis the current stiff version and just mention the free-shipping detail to him in a separate note.",
                    'is_correct' => false,
                    'diagnostic' => 'You shipped a draft you already know misses the tone and the single most important selling point, leaving the client to fix what he just asked you to fix.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-close-enough-isnt-done',
                        'title' => '"Close enough" is still not what was asked',
                        'body' => "Once something is nearly right, there's a strong pull to call it done and move on. But the client named two specific problems, and \"close enough\" means handing back work that still has both — with the biggest selling point sitting in a side note instead of in the email that goes to customers.\n\nThe gap between close and correct is where your value lives. Anyone can produce a rough draft; the VA who's worth keeping delivers the version that's actually ready to use, especially when the fixes are small and clearly known.\n\nIf you already know what's wrong, that's not the moment to ship — it's the moment to fix.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "That's perfect now, love the tone 🙌 Just send it out to the whole customer list for me!",
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Great — schedule it to the entire list right away, exactly as the AI wrote it.',
                    'is_correct' => false,
                    'diagnostic' => 'Blasting AI-written copy to real customers without a read-through risks a wrong code, price, or date going out to everyone at once.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-you-own-the-output',
                        'title' => 'AI drafts it; you own it',
                        'body' => "AI can state a discount code, a price, or a deadline with total confidence and still get it wrong. Once that email reaches customers, the mistake is out in the world under the client's name — and \"the AI wrote it\" is no defence.\n\nAnything AI produces is a draft you're responsible for, not a finished product you can forward untouched. The moment before it goes to real people is exactly when a human has to check that the facts are actually correct.\n\nThe tool does the typing. You do the vouching. Never let its confidence stand in for your review.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Hold it back and keep re-running the prompt for an even nicer version before anyone sees it, just to be sure it's the best possible email.",
                    'is_correct' => false,
                    'diagnostic' => 'The client already approved this version, so chasing a marginally better one only delays a time-sensitive sale email for no real gain.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-approved-means-ship',
                        'title' => 'Approved is the finish line',
                        'body' => "When something is good and signed off, more tinkering isn't diligence — it's delay. This is a weekend sale; every hour the email sits unsent is an hour of the promotion wasted, and the client already said it's perfect.\n\nPerfectionism after approval quietly overrides the client's decision. They judged it ready; re-running the prompt for a version they didn't ask for substitutes your taste for their go-ahead and costs them time on a deadline.\n\nKnow when to stop. Once the client approves, your job is to ship it cleanly, not to keep polishing past the point of value.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'Send it, but add a line at the bottom telling customers this email was generated by AI, just to be transparent.',
                    'is_correct' => false,
                    'diagnostic' => 'Announcing that the client\'s customer email was AI-generated undercuts its warmth and wasn\'t something the client asked you to disclose.',
                    'lesson' => [
                        'slug' => 'writing-a-usable-prompt-tool-stays-behind-the-scenes',
                        'title' => 'The tool is yours to use, not to advertise',
                        'body' => "How you produced the work is your business as the VA; what reaches the customer is the client's brand voice. Stamping \"written by AI\" on a friendly promo email breaks the personal tone the client specifically wanted and raises a question no customer was asking.\n\nUsing AI well is like using any tool — a good calculator or a spellchecker doesn't get a credit line. What matters is that the output is accurate and sounds like the client. Deciding whether to mention AI at all is the client's call, not a footnote you add on your own.\n\nDeliver clean, correct work in the client's voice. Keep the machinery behind the scenes unless they ask otherwise.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Read it through once as a customer would — check the code, the discount, the deadline, and the free-shipping figure are all correct against Dennis's numbers — then send. Note to Dennis that you double-checked the details before it went out.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
    ],
];
