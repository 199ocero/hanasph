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
    'slug' => 'proactive-updates',
    'order' => 15,
    'title' => 'Don’t go dark',
    'client_persona' => 'Priya, launching a course over the next four days',
    'scenario_intro' => "Priya hired you to build her course landing page by Friday. It's Tuesday, and the only thing blocking you is a designer who still hasn't sent the header image she promised.",
    'xp_reward' => 175,
    'onboarding_entry_key' => null,
    'category' => 'comms',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => 'Hey! Excited to see this come together. How are we looking on the landing page? 😊',
            'scaffold_hint' => null,
            'tagalog_tip' => 'Nagtatanong si Priya kung kumusta na. May hinihintay kang designer bago mo matapos, kaya isipin mo kung gaano ka dapat ka-honest sa update mo nang hindi mo rin siya inaabala sa maliliit na bagay.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Going well! Everything's on track for Friday, no issues at all. 🎉",
                    'is_correct' => false,
                    'diagnostic' => 'You gave a blanket “on track” while you’re actually stuck waiting on the designer, hiding a real risk behind reassurance.',
                    'lesson' => [
                        'slug' => 'proactive-updates-dont-fake-calm',
                        'title' => 'Don’t buy calm now with a surprise later',
                        'body' => "\"All on track!\" is the easiest thing to type and the most tempting when you don't want to worry the client. But you know something she doesn't: a piece you depend on hasn't arrived. Saying everything's fine spends her trust to buy yourself a comfortable morning.\n\nFalse reassurance always comes due. If the image is late and Friday slips, she'll remember you told her it was fine, and every future \"on track\" from you will mean less.\n\nAn honest status with a small caveat costs you a slightly less shiny message today. It's cheap insurance against a much worse conversation on Friday.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Coming along! The page structure and copy are done. I'm just waiting on the header image from the designer, then I'll drop it in. I've nudged her and still have plenty of runway for Friday. Will keep you posted.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Nothing finished yet so not much to show. I'll message you once the whole page is done and ready.",
                    'is_correct' => false,
                    'diagnostic' => 'You treated “no finished product” as “nothing to report,” choosing silence when a quick status was exactly what she asked for.',
                    'lesson' => [
                        'slug' => 'proactive-updates-progress-is-reportable',
                        'title' => '“Not finished” is not “nothing to say”',
                        'body' => "Beginners often stay quiet until there's a finished thing to hand over, reasoning that progress-in-motion isn't worth a message. But the client isn't asking for the deliverable. She's asking whether to worry, and silence answers that with \"maybe.\"\n\nStatus is information even when nothing's done: what's finished, what's in progress, what you're waiting on, and whether the deadline still holds. That picture lets her relax without seeing a single finished pixel.\n\nGoing dark until completion leaves the client guessing during the exact window when a two-line update would cost you almost nothing.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => 'Working on it! 💪 Just opened the file. About to start on the header section now. Will ping you again in a bit with the next step, and again after that!',
                    'is_correct' => false,
                    'diagnostic' => 'You promised a stream of tiny play-by-play pings that carry no real status and will train her to tune you out.',
                    'lesson' => [
                        'slug' => 'proactive-updates-signal-not-noise',
                        'title' => 'Updates are signal, not a live feed',
                        'body' => "Over-correcting from silence, some VAs narrate every move: opened the file, starting now, still going. It feels attentive, but a message that says nothing about status or risk is just noise. A client buried in noise stops reading, so your one important update gets missed too.\n\nA good update is worth the interruption: it changes what the client knows or needs to do. \"Waiting on the image, still fine for Friday\" earns its ping. \"About to start\" does not.\n\nAim for few messages that each carry weight, not many that each carry none. Respecting the client's attention is part of the job.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => 'Great, thanks for the clear update! 🙌',
            'scaffold_hint' => null,
            'tagalog_tip' => 'Nagbago na yung sitwasyon dahil na-move sa Thursday yung designer, kahit masaya pa si Priya sa huli mong update. Isipin mo kung ano yung tamang gawin ngayong may bagong info ka na hindi pa niya alam.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Quick heads up, Priya: the designer now says the image won't come till Thursday, later than I'd hoped. I've built everything else so it's a 20-min drop-in once it lands, which still clears Friday. If it slips past Thursday I'll flag it and we'll use a placeholder. Keeping on it.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => '(You notice the designer has now pushed the image to Thursday. Since Priya just thanked you and seemed happy, you decide not to worry her and wait to see if it still works out.)',
                    'is_correct' => false,
                    'diagnostic' => 'The risk got worse and you went silent to preserve a good mood, letting her happiness rest on information you know has changed.',
                    'lesson' => [
                        'slug' => 'proactive-updates-update-when-it-changes',
                        'title' => 'When the facts move, so does the update',
                        'body' => "You gave a good update an hour ago, so it's tempting to think the job's done, especially when the client just thanked you and you don't want to spoil it. But an update describes a moment, and the moment just changed. The picture she's happy about is now out of date.\n\nProactive communication isn't a single message; it's keeping her mental model matching reality as reality shifts. A slip she hears about early is a manageable heads-up. The same slip she discovers herself is a broken promise.\n\nDon't let a client's good mood, built on old facts, buy your silence. The kinder move is the current truth, delivered before she has to ask again.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Ugh, the designer just pushed the image to Thursday and honestly it's a mess. I'm not sure we'll make Friday now. I'll let you know if it falls apart.",
                    'is_correct' => false,
                    'diagnostic' => 'You reported the slip but dumped the raw panic with no plan, handing her the worry instead of a way through it.',
                    'lesson' => [
                        'slug' => 'proactive-updates-carry-a-plan',
                        'title' => 'Report the problem holding the solution',
                        'body' => "Honesty about a slip is right, but honesty alone, delivered as alarm, just transfers your stress to the client. \"It's a mess, might not make it, I'll let you know\" tells her there's a fire and leaves her holding it, with nothing to do but worry.\n\nThe same facts land completely differently with a plan attached: what you've already done to absorb the slip, whether the deadline still holds, and the fallback if it doesn't. That's the difference between raising an alarm and managing a situation.\n\nBring the client the problem and your handle on it together. A calm, planned update keeps her confident in you precisely when things wobble.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "No problem! Everything's still totally fine and on schedule for Friday. 😄",
                    'is_correct' => false,
                    'diagnostic' => 'You knew the image had slipped to Thursday yet repeated “on schedule,” doubling down on reassurance that’s no longer true.',
                    'lesson' => [
                        'slug' => 'proactive-updates-dont-double-down',
                        'title' => 'A cheerful lie twice is still a lie',
                        'body' => "When the news gets worse, the pull toward \"still totally fine!\" gets stronger, and nobody wants to walk back a rosy picture. But you now know the dependency slipped. Repeating \"on schedule\" isn't optimism. It's a second false reassurance stacked on the first.\n\nThe risk here is a spiral: each cheerful update makes the next honest one harder, until you're managing the client's feelings instead of the project. And the reckoning only grows.\n\nWhen reality moves against you, the brave and professional move is to update the story to match, even if it means a less happy message than the one before. Consistency with the truth beats consistency with your last message.",
                    ],
                ],
            ],
        ],
    ],
];
