<?php

/*
 * QUALITY BAR - every wrong option must satisfy all five:
 *  1. Plausible: a real beginner could genuinely pick it.
 *  2. Distinctly wrong: fails for a DIFFERENT reason than the other wrongs.
 *  3. Diagnostic is ONE defensible sentence a working VA would agree with.
 *  4. Exactly one is_correct === true per beat.
 *  5. Lesson teaches the principle, not the answer; fits one screen.
 */

return [
    'slug' => 'scope-creep',
    'order' => 17,
    'title' => 'Just one more thing',
    'client_persona' => 'Dan, runs an online supplements store',
    'scenario_intro' => "You told Dan the product descriptions he needs would be ready by 3pm today, and he's counting on them for a sale launch. Mid-morning, he messages.",
    'xp_reward' => 175,
    'onboarding_entry_key' => null,
    'category' => 'comms',
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Morning! Quick one while you're in there, can you also redo all the product photos' background to white? The current ones look messy. Oh and fix the descriptions like we said. Thanks a million 🙏",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Nagdagdag si Dan ng bagong request pero may pinangako ka nang tapusin by 3pm para sa launch niya. Isipin mo paano mo matutulungan si client nang hindi nasasakripisyo yung deadline na inaasahan niya.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Sorry Dan, editing photo backgrounds isn't really what I was brought on to do. I handle the writing side. You'd need a photo editor for that.",
                    'is_correct' => false,
                    'diagnostic' => 'You refused flatly and pushed him elsewhere instead of trying to help within your committed work.',
                    'lesson' => [
                        'slug' => 'scope-creep-dont-refuse-flatly',
                        'title' => 'Helpful first, boundaries second',
                        'body' => "When an extra ask lands, the rigid reaction is to draw a line: \"that's not my job.\" It protects you, but it lands on the client as unhelpful. It's rarely true anyway, since most VAs can attempt more than their narrow title.\n\nThe goal isn't to guard your job description. It's to keep the client's real priority safe. A photo tweak isn't off-limits because of what it is; it only matters if it threatens the thing you already promised.\n\nStart from \"how can I help?\" rather than \"that's not mine.\" You can still protect your deadline. Just do it by naming the tradeoff instead of refusing the person.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "On it! I'll get the photo backgrounds cleaned up and the descriptions done. 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You silently took on a big extra that will eat the hours you needed for the 3pm descriptions he is launching on.',
                    'lesson' => [
                        'slug' => 'scope-creep-dont-silently-overcommit',
                        'title' => 'A silent yes can break a promise',
                        'body' => "Saying yes to everything feels like great service. But you already made a commitment, descriptions by 3pm for a launch, and the new task will quietly consume the same hours. Something has to give, and if you don't say so, it'll be the thing he's actually counting on.\n\nThe danger of scope creep isn't the extra work itself. It's that the extra work displaces a promise the client doesn't know is now at risk. He thinks both are handled when only one can be.\n\nBefore you absorb something that threatens a committed deadline, the client has to know it's a tradeoff, so he can choose instead of finding out at 3pm.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Happy to sort the photo backgrounds too! Just a heads up, that's a bigger job, so if I do it today the descriptions would land tomorrow morning instead of 3pm. Or I keep 3pm for the descriptions and do photos after. Which works for your launch?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "Sure thing! I'll start on the photo backgrounds now so they look great, then get to the descriptions after.",
                    'is_correct' => false,
                    'diagnostic' => 'You quietly reordered the work to do the new ask first, pushing back the descriptions he needs at 3pm without telling him.',
                    'lesson' => [
                        'slug' => 'scope-creep-dont-quietly-deprioritize',
                        'title' => 'Don’t rob the committed task to pay the new one',
                        'body' => "A newer request often feels more urgent just because it arrived last. So it's tempting to slide the original task down the list and start on the shiny new thing. But the original had a promised time and a real reason, a launch, and the client never agreed to it slipping.\n\nQuietly re-sequencing is a hidden decision made on the client's behalf. It might even be the right order, but that's his call, because he knows which one the sale depends on.\n\nWhen a new ask competes with a committed one, surface the collision and let the client set the priority. Don't resolve it in silence.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Let's keep 3pm for the descriptions, do photos after 👍 Actually, one more thing! Can you also write a launch email to the whole list? Would love it to go out with everything today.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Pangatlong request na to sa iisang araw lang. Tingnan mo kung ano talaga yung kaya sa natitirang oras, tapos hayaan mo si client na pumili kung alin yung mauuna.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Got it! Descriptions at 3pm, then photos, then I'll write the launch email, all out today. 🙌",
                    'is_correct' => false,
                    'diagnostic' => 'You agreed to a third same-day task on top of two others, quietly promising a day’s worth of work that can’t all fit.',
                    'lesson' => [
                        'slug' => 'scope-creep-dont-become-a-yes-machine',
                        'title' => 'Every extra “yes” spends the same day',
                        'body' => "You handled the first add-on well, so the second one feels easy to wave through. But the tradeoffs stack. Descriptions, photos, and now a full launch email are three real jobs pointed at one afternoon, and \"all out today\" is a promise the clock can't keep.\n\nManaging scope isn't a one-time gate you pass through. Each new ask has to be weighed against what's already committed, every time. The second and third requests deserve the same honesty as the first.\n\nStaying gracious doesn't mean the tradeoff talk stops after round one. It means you keep making the math visible, so the pile never grows past what the day can hold.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Love that idea! Realistically all three today is tight. I'd suggest: descriptions live by 3pm, launch email drafted for your approval by end of day so it goes out tonight, and photos first thing tomorrow. Does that ordering work?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "I can do the email, but that means the photos won't happen at all. I'll just quietly park those since the email's more important for a launch.",
                    'is_correct' => false,
                    'diagnostic' => 'You dropped a task he already agreed to and decided its fate for him instead of letting him choose what gives.',
                    'lesson' => [
                        'slug' => 'scope-creep-let-the-client-choose-what-gives',
                        'title' => 'You name the tradeoff; the client makes the cut',
                        'body' => "When the plate is full and something has to fall off, your job is to show what the options are, not to unilaterally decide which task dies. \"I'll just park the photos\" swaps a silent overcommit for a silent drop, and both hide a decision from the person it affects.\n\nYou already renegotiated the photos onto the schedule with him. Quietly cutting them now, even for a sensible reason, undoes an agreement without his say.\n\nLay out what fits and what slips, then let him make the call. He owns the priorities; you own making them visible and easy to decide.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Honestly Dan, that's a lot of extra on top of what we agreed. Let's stick to just the descriptions for today like we originally planned.",
                    'is_correct' => false,
                    'diagnostic' => 'You shut down a reasonable request that could have been fit in with a small schedule tweak, defaulting to rigid instead of flexible.',
                    'lesson' => [
                        'slug' => 'scope-creep-flex-before-you-fence',
                        'title' => 'Reach for the reschedule before the “no”',
                        'body' => "After absorbing a couple of extras, it's tempting to slam the door on the next one: \"we agreed to just descriptions.\" But firmness isn't the same as helpfulness. A launch email is a normal thing to want, and it may well fit with a small adjustment.\n\nThe skill is holding the line on your committed priority while staying open to the rest. Instead of a flat \"no,\" try \"here's how it could fit, and here's what moves if we do it.\"\n\nDefault to solving the client's whole problem within a realistic plan. Save the firm no for when there's genuinely no version that protects the commitment, not for the moment your patience runs thin.",
                    ],
                ],
            ],
        ],
    ],
];
