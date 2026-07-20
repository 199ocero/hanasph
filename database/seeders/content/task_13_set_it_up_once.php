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
    'slug' => 'set-it-up-once',
    'order' => 16,
    'title' => 'Stop doing it twice',
    'client_persona' => 'Rhea, runs a small online skincare shop',
    'scenario_intro' => "Every Friday Rhea asks you to pull the week's numbers from a few places and turn them into a tidy summary she can post to her team. You've done it by hand for a month now.",
    'xp_reward' => 175,
    'onboarding_entry_key' => null,
    'category' => 'ai',
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Happy Friday! Same as always, can you pull this week's sales, top 3 products, and total orders into the little summary and drop it in the team chat? 🙏",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Every Friday pareho lang yung ginagawa mo dito. Bago ka mag-reply, isipin mo kung paano mo mapapadali to sa susunod na linggo na hindi ka masyadong mag-o-overkill sa solution.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "On it! Quick idea while I'm at it: since this is the same shape every Friday, want me to set up a reusable template where I just paste in the week's numbers and it produces the summary in your exact format? Same result, but a few minutes instead of half an hour each week. I'll build it and show you this Friday's using it.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "You got it! Pulling the numbers now and I'll rebuild the summary from scratch like always, will have it in the team chat shortly 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You noticed nothing repeatable in a task you\'ve now done four Fridays in a row and signed up to keep redoing it by hand forever.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-spot-the-repetition',
                        'title' => 'When you do it twice, notice it',
                        'body' => "It feels productive to just knock out the task again. You know the steps, you're fast, the client's happy. But redoing the same shaped work every week by hand quietly burns hours you could spend on things only you can do.\n\nThe skill that separates a good VA from a great one is noticing the pattern: \"I've built this same summary four times now.\" That's the signal to stop and ask whether it can be set up once and reused, instead of rebuilt from zero each time.\n\nYou don't have to be technical. \"This repeats, can I make a template for it?\" is the whole instinct. Catch the repetition, and the time savings compound every week after.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Great news! I'm going to build you a full automated system that connects your sales tool, your orders, and the team chat by API so the summary generates and posts itself with zero input from either of us. Might take me a couple of weeks to wire up, but then it's totally hands-off!",
                    'is_correct' => false,
                    'diagnostic' => 'You reached for a heavy multi-week build to save a task that takes minutes, so the setup costs far more than it will ever return.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-right-size-the-fix',
                        'title' => 'Match the effort to the problem',
                        'body' => "Once you catch the automation bug, the temptation flips the other way: build something big and clever. A fully wired, self-posting pipeline sounds impressive. But it can take weeks to build and maintain, all to replace a task that takes twenty minutes a week.\n\nThe right-sized fix is usually the smallest one that removes most of the pain. A simple reusable template or checklist you fill in often captures ninety percent of the saving for one percent of the effort.\n\nAsk what the lightest thing is that would make this easy next time. Save the heavy machinery for work that's both frequent and genuinely time-consuming, not for shaving minutes off an already-small job.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Love it! I'll set up a template that builds the summary automatically from your sales data, and once it's running I'll just let it post itself each Friday so you never have to think about it again.",
                    'is_correct' => false,
                    'diagnostic' => 'You committed to letting it run untouched every week without ever planning to check that its output is actually correct.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-trust-but-verify',
                        'title' => "Automating doesn't mean not looking",
                        'body' => "The appeal of a template or automation is that you stop having to think about the task. But \"set it and forget it\" hides a trap. If the setup has a small error, it now produces that same wrong result every single week, automatically, at scale, and nobody's watching.\n\nA manual mistake is one bad summary. An unchecked automated mistake keeps shipping a bad summary every Friday until someone notices, often after it's caused real confusion.\n\nAutomation changes what you check. It doesn't remove the need to check. Glance at each output, or at least spot-check regularly, to confirm it still matches reality. The time saved should go into a quick sanity check, not into never looking again.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Ooh yes please, a template would be amazing. One thing though, the date range shifts every week, and lately I've been adding a different 'featured product' line at the top depending on what we're promoting. So it's not identical each time.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Sinasabi ni client na may nagbabago every week tulad ng dates at featured product. Isipin mo kung paano mo kakayanin yung mga nagbabagong parts na to nang hindi sinasayang yung benefit ng gagawin mong setup.',
            'options' => [
                [
                    'order' => 3,
                    'body' => "Perfect! I'll build the template so the parts that change each week are just fields I fill in: the date range and the featured product go in at the top, and everything else stays fixed. So it flexes for whatever you're promoting without me rebuilding it. Sound right?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "No problem! I'll build it around this week's setup, so it'll have this week's dates and the current featured product baked right in. Nice and locked so it's consistent!",
                    'is_correct' => false,
                    'diagnostic' => 'You hard-coded the parts you were just told will change, so the template breaks the very next week and needs rebuilding anyway.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-inputs-not-hardcoding',
                        'title' => 'The parts that change should be inputs',
                        'body' => "When you build something reusable, the instinct is to freeze everything exactly as it is today. It feels tidy and consistent. But baking in the values that vary means the template only works once, and you're back to rebuilding it each week.\n\nThe core of a good reusable setup is separating what stays the same from what changes. The stable structure gets built in. The changing pieces, like a date, a name, or a featured item, become simple slots you drop new values into.\n\nBefore you build, ask: \"what's different each time this runs?\" Those are your inputs. Everything else is the template. Get that split right and the thing keeps working no matter what changes week to week.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => "Got it. Since it varies, honestly a template might be more trouble than it's worth. I'll just keep building it by hand each week so I can adjust the dates and featured product however you need.",
                    'is_correct' => false,
                    'diagnostic' => 'A little bit of week-to-week variation made you abandon the reusable approach entirely and fall back to redoing it manually.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-variation-isnt-a-dealbreaker',
                        'title' => 'A little variation is normal, so design for it',
                        'body' => "Almost nothing repeats in a perfectly identical way. There's usually a date that moves, a name that changes, or a number that's new. Beginners often take that as proof the task \"can't really be templated\" and give up on the idea.\n\nBut variation doesn't kill reuse. It's exactly what you design the template around. A good template expects certain parts to change and makes them easy to swap. The structure holds and the details flow in.\n\nDon't let the changing 10% scare you off automating the stable 90%. Build the reusable shell, leave clean slots for what varies, and you keep the time savings without losing the flexibility.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Easy fix! I'll make the template super generic with no dates or product names in it at all, just blank sections, and I'll write in all the specifics fresh each week.",
                    'is_correct' => false,
                    'diagnostic' => 'You stripped out so much that the "template" is now an empty shell you refill from scratch, which saves almost nothing.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-keep-the-work-it-saves',
                        'title' => "An empty shell isn't a time-saver",
                        'body' => "Overcorrecting for variation, you can end up making the template so bare that it does none of the work. If every section is blank and you rewrite all the content each week, you've just recreated the manual task with extra steps.\n\nA reusable setup earns its keep by keeping the parts that don't change: the layout, the fixed labels, the standard phrasing, the calculations. Only the genuinely varying values should need your input.\n\nThe test is simple: next week, how much is already done for you before you start typing? If the answer is \"almost everything except a couple of fields,\" it's a real template. If it's \"nothing,\" you've built an empty form, not a shortcut.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Amazing, that's exactly it. Okay, first Friday running on the new template. Go ahead and use it for today's summary!",
            'scaffold_hint' => null,
            'tagalog_tip' => 'First time to gagamitin yung bagong template. Bago mo i-post agad sa team chat, isipin mo kung ano yung dapat mong siguraduhin muna kasi bago pa lang to at hindi pa napapatunayan.',
            'options' => [
                [
                    'order' => 2,
                    'body' => "Will do! I'll run this week's numbers through it, give the output a quick once-over against the raw figures to make sure the template's picking everything up right, and then post it to the team chat. I'll flag anything that looks off before it goes out.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 1,
                    'body' => "Done and posted! Ran it through the template and dropped it straight into the team chat. Didn't even need to look, that's the whole point of automating it 🎉",
                    'is_correct' => false,
                    'diagnostic' => 'It was the template\'s very first real run and you posted the output publicly without once checking it was correct.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-check-the-first-run',
                        'title' => 'Watch the first run most closely',
                        'body' => "A brand-new template is at its most likely to be wrong the very first time it runs: a slot mislabelled, a total pulled from the wrong place, a formatting quirk. That's exactly the moment you skipped the check and posted it in front of the whole team.\n\nEarly on, every output deserves a careful look against the source it came from. You're not just producing this week's summary. You're also confirming the machine you built actually works before you start relying on it.\n\nOnce it's proven itself over a few runs, you can loosen to quick spot-checks. But the first outputs are how you catch a setup mistake before it becomes a habit that quietly ships wrong numbers.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Sure! Although to be safe on the first run, I'll also rebuild the whole summary by hand separately and compare the two line by line every week from now on, just so we always know the template's right.",
                    'is_correct' => false,
                    'diagnostic' => 'Doing the manual version in full every week alongside the template throws away the entire time saving you built it for.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-verify-without-redoing',
                        'title' => 'Verify without redoing the whole job',
                        'body' => "Wanting to be sure the template is right is a good instinct. But fully rebuilding the task by hand every week to double-check it defeats the purpose. You're now doing the work twice, forever, which is worse than before you automated.\n\nVerification should be lighter than the work itself. A quick spot-check of the key numbers against the source, on the first few runs, catches almost every error for a fraction of the effort. As confidence grows, you check less often.\n\nThe goal is a proportionate safety net rather than a permanent duplicate job. Trust that builds over time, backed by light checks, is what lets automation actually save you time.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "On it! And while I'm in there, I'll also redesign the summary's whole layout with some new charts and sections I think would look better, then post that version to the team today.",
                    'is_correct' => false,
                    'diagnostic' => 'On the template\'s first live run you bolted on an unrequested redesign, changing the format the client already approved.',
                    'lesson' => [
                        'slug' => 'set-it-up-once-dont-redesign-uninvited',
                        'title' => 'Ship what was agreed before improving it',
                        'body' => "You've been living in this task, so ideas for making it \"better\" come naturally, like new charts or a fresh layout. But the client approved a specific format, and the first live run is the worst moment to quietly swap it for your own redesign.\n\nGet the agreed version working and trusted first. Changing the output and the underlying setup at the same time also makes it impossible to tell which change caused a problem if something looks off.\n\nIf you genuinely think a new layout would help, finish the agreed task, then offer the idea as a suggestion: \"want to see a version with a chart?\" Improvements are welcome as a proposal after delivery. They shouldn't be a surprise swapped in on run one.",
                    ],
                ],
            ],
        ],
    ],
];
