<?php

/*
 * QUALITY BAR: every wrong option must satisfy all five:
 *  1. Plausible: a real beginner could genuinely pick it.
 *  2. Distinctly wrong: fails for a DIFFERENT reason than the other wrongs.
 *  3. Diagnostic is ONE defensible sentence a working VA would agree with.
 *  4. Exactly one is_correct === true per beat.
 *  5. Lesson teaches the principle, not the answer; fits one screen.
 */

return [
    'slug' => 'clear-status-update',
    'order' => 5,
    'title' => 'Where do things stand?',
    'client_persona' => 'Marlon, runs a small online gadget store',
    'scenario_intro' => "Marlon sells phone accessories online and handed you a batch of tasks first thing this morning before disappearing into back-to-back calls. You're a couple hours in.",
    'xp_reward' => 75,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => true,
    'category' => 'comms',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Morning! Two things today: upload the 8 new product listings, and draft the reply to that returns complaint. I'm in meetings all day so just run with it, talk later 🙏",
            'scaffold_hint' => "He's not going to check in, that's the point of hiring you. A couple hours in, send an update he can read in five seconds: what's done, what's next, when.",
            'tagalog_tip' => 'Wala siyang balita galing sayo buong umaga, kaya isipin mo kung anong klaseng update ang mababasa niya agad kahit busy sa meetings. Wag masyadong mahaba, pero dapat may laman.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Got it! I'll get everything finished and send it all over in one go once it's 100% done so I don't interrupt your meetings 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You chose to stay silent until the very end, leaving him with zero visibility for hours.',
                    'lesson' => [
                        'slug' => 'clear-status-update-dont-go-dark',
                        'title' => 'Silence isn\'t the same as being considerate',
                        'body' => "Going quiet until everything is finished feels polite. You're not \"bothering\" him. But from his side, hours of silence is indistinguishable from you having forgotten or gotten stuck. He can't plan, and the not-knowing is its own small stress.\n\nA short progress note isn't an interruption. It's what lets him stop wondering and stay focused on his calls. He reads it in five seconds and moves on, reassured.\n\nThe job isn't only to do the work. It's also to make him feel the work is handled. Visibility is part of the deliverable itself.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Hi Marlon! So I started with listing number one, added the title and the price, then I noticed the photo needed cropping so I did that, then moved to listing two which had a longer description so that took a bit, then three had a variant issue I worked around, and I'm now partway into four, after which I'll continue to five, six, seven, eight and then start on the returns reply which I'll get to once the listings are wrapped up...",
                    'is_correct' => false,
                    'diagnostic' => 'You sent a play-by-play with no headline, so he can\'t tell at a glance whether things are on track.',
                    'lesson' => [
                        'slug' => 'clear-status-update-lead-with-the-headline',
                        'title' => 'Give the headline first, skip the diary',
                        'body' => "A wall of every step you took feels transparent, but a busy client doesn't want your diary. He wants the verdict. Buried in that paragraph is the actual answer (\"about half done, on track\"), and he has to mine for it.\n\nStructure a status so the headline hits first: what's done, what's next, and an ETA. Details can follow for anyone who wants them, but the top line should answer \"are we okay?\" instantly.\n\nWrite updates for a reader who's mid-meeting glancing at their phone. If they can't get the gist in one glance, the update isn't doing its job, no matter how complete it is.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'Hey! Making good progress here, all going smoothly 😊 will keep at it!',
                    'is_correct' => false,
                    'diagnostic' => 'You sent reassurance with no actual information: no counts, no next step, no ETA.',
                    'lesson' => [
                        'slug' => 'clear-status-update-substance-over-vibes',
                        'title' => 'A good vibe isn\'t a status',
                        'body' => "\"Making good progress 😊\" sounds nice and takes the pressure off you, but it tells him nothing he can act on. How many of the eight are done? Will they be ready before his 4pm? Is the returns reply even started? He still knows nothing.\n\nVague positivity can actually raise suspicion. Clients learn that \"all going great!\" with no specifics sometimes hides that little has happened. Numbers and a time build far more trust than cheerfulness.\n\nA real update has substance: a count, the next thing, and a when. \"5 of 8 done, rest by 4pm\" reassures precisely because it's checkable.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Quick update 👇 ✅ 5 of the 8 listings are live. Next: the last 3 listings, then the returns reply. ETA around 4pm, and I'll send the returns draft here for your ok before anything goes to the customer. Carry on with your calls!",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => 'This is exactly what I needed, love it 🙌 keep going!',
            'scaffold_hint' => "As you finish the listings you hit a snag: the photos for the last 3 aren't in the shared Drive folder. Don't hide it, don't just dump the problem, and don't burn your ETA quietly wrestling with it.",
            'tagalog_tip' => 'May problema: kulang yung photos para sa huling tatlong listings. Isipin mo kung paano mo sasabihin kay Marlon na may issue nang hindi mo siya iniiwan na siya na bahala mag-isip ng solusyon.',
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Update: 5 of 8 listings live and looking great, moving right along! 🎉',
                    'is_correct' => false,
                    'diagnostic' => 'You quietly dropped the 3 blocked listings from the update to keep it looking positive.',
                    'lesson' => [
                        'slug' => 'clear-status-update-dont-hide-the-problem',
                        'title' => 'A hidden problem grows teeth',
                        'body' => "When something goes wrong, the tempting move is to report only the good part and hope the snag resolves itself before anyone notices. But a hidden blocker doesn't disappear. It surfaces later, bigger, and now with a second problem attached: you knew and didn't say.\n\nClients can forgive a missing file; it's not your fault the photos aren't there. What they can't forgive is finding out at 4pm that you'd been sitting on it since noon. The concealment costs more trust than the blocker ever could.\n\nSurface problems early, while there's still time to solve them together. Early is a heads-up; late is a nasty surprise.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Heads up: the last 3 listings need photos but they're not in the Drive folder (only 5 sets are there). Two options: drop the 3 photo sets in and I'll finish them today, or I publish the 5 now and add the last 3 the moment the photos land. Which do you prefer? Rest still on track.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Problem!! 😩 The photos for the last 3 are missing and I can't do them. I'm stuck, not sure what to do now.",
                    'is_correct' => false,
                    'diagnostic' => 'You surfaced the blocker but handed him a naked problem with no proposed way forward.',
                    'lesson' => [
                        'slug' => 'clear-status-update-bring-a-path-not-just-a-problem',
                        'title' => 'Flag the blocker with a way out attached',
                        'body' => "Raising the blocker fast is right, but \"I'm stuck, help\" makes the problem entirely his to solve, which is the load you were hired to lift. It also reads as panic, which makes him worry more rather than less.\n\nDo a beat of thinking first: what are the one or two realistic ways forward? Then present the blocker with those options attached. \"Photos are missing. Either you add them and I finish today, or I publish 5 now and the rest when they arrive.\" Now he just picks.\n\nSurfacing a problem and proposing a path aren't opposites. The best updates do both. You stay honest about the snag while still carrying the thinking.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "(Say nothing yet. Keep digging through other folders and old emails to find the photos yourself so you don't have to bother him, even if it eats up the afternoon.)",
                    'is_correct' => false,
                    'diagnostic' => 'You let your ETA quietly slip while struggling alone instead of surfacing a blocker only he can clear.',
                    'lesson' => [
                        'slug' => 'clear-status-update-dont-struggle-silently',
                        'title' => 'Don\'t burn the clock in silence',
                        'body' => "Trying hard to solve it yourself before \"bothering\" him seems conscientious. But the photos are his to provide. No amount of digging on your end can conjure files that were never uploaded. Every silent minute just eats the ETA you promised.\n\nEffort is only worth it when it can actually reach the answer. When a blocker sits on the client's side of the fence, like a missing file or a decision only they can make, the fastest fix is to tell them now rather than grind against it alone.\n\nA quick \"I need X to continue\" protects the deadline. Silent struggling protects your pride and quietly blows the timeline you gave him.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => 'Ah my bad! Just dropped the 3 photo sets into the folder now 🙏 finish them off',
            'scaffold_hint' => "Wrap up with a closing update. Be accurate about what's truly finished versus what still needs his sign-off. Don't over-claim, don't overstep, and don't leave anything unmentioned.",
            'tagalog_tip' => 'Malapit na matapos, pero mag-ingat sa closing update mo. Isipin mo kung alin ang totoong tapos na at alin pa ang naghihintay ng approval niya, para hindi ka mag-claim ng hindi pa naman tapos.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "All done and dusted, everything's finished! ✅ Have a good rest of your day 🙌",
                    'is_correct' => false,
                    'diagnostic' => 'You declared everything finished when the returns reply still needs his approval before it can go out.',
                    'lesson' => [
                        'slug' => 'clear-status-update-dont-overclaim-done',
                        'title' => '"Done" has to be actually true',
                        'body' => "Saying \"everything's finished\" feels like a clean, satisfying close. But the returns reply is drafted, not sent. It's waiting on his ok. Calling that \"done\" quietly closes a loop that's still open, and he'll assume the customer has been handled when they haven't.\n\nA status update is only useful if it's precise about state. \"Drafted, awaiting your ok\" is a different status from \"sent,\" and collapsing the two sets up a nasty gap: a customer left hanging because everyone thought someone else had replied.\n\nBe exact about what's complete versus what's pending on someone else. Accurate-but-modest beats tidy-but-wrong every time.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Got them! All 8 listings are now live ✅. I also went ahead and sent the returns reply straight to the customer so it's fully wrapped up. 🎉",
                    'is_correct' => false,
                    'diagnostic' => 'You sent a customer-facing reply without his sign-off, closing a decision that was his to make.',
                    'lesson' => [
                        'slug' => 'clear-status-update-dont-overstep-approval',
                        'title' => 'Finishing fast isn\'t worth overstepping',
                        'body' => "It's tempting to send the returns reply yourself and report a clean, fully-closed task. But he asked you to draft it, and a reply to a complaint is his brand talking to his customer. That's his call, not yours to make unilaterally.\n\nThe drive to report \"100% done\" can quietly push you past your authority. A finished-looking update isn't worth sending something in his name that he'd have worded differently, or that commits the business to a refund he didn't approve.\n\nWhen a step is customer-facing or commits the business, the correct status is \"ready for your ok,\" not \"sent.\" Let him keep the last click.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Perfect, all 8 listings are now live ✅. Last thing: I've drafted the returns reply and I'm dropping it here for your ok before it goes to the customer. Once you give the word I'll send it. Nothing else outstanding on my end 👍",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => 'Done! All 8 listings are live ✅',
                    'is_correct' => false,
                    'diagnostic' => 'You reported the listings but never mentioned the returns reply, leaving him to remember and chase the second task himself.',
                    'lesson' => [
                        'slug' => 'clear-status-update-account-for-every-item',
                        'title' => 'A closing update covers everything he handed you',
                        'body' => "The listings are the visible win, so it's easy to report those and feel finished. But he gave you two tasks this morning, and a closing update that mentions only one leaves him wondering about the other. Did you forget the returns reply? Is it done? Now he has to ask.\n\nWhen you wrap up, run back over the original handoff and account for every item, including the ones still in progress. \"Listings live; returns reply drafted and awaiting your ok\" closes both loops, even though only one is fully finished.\n\nAn update that silently drops an item forces the client to keep his own mental checklist, exactly the tracking you were hired to take over.",
                    ],
                ],
            ],
        ],
    ],
];
