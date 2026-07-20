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
    'slug' => 'two-urgent-requests',
    'order' => 7,
    'title' => "Everything's on fire",
    'client_persona' => 'Denise, founder of a fast-growing skincare startup',
    'scenario_intro' => "Denise runs a skincare brand that's scaling fast and she moves at a hundred miles an hour. Mid-morning, two things land on you at once, both flagged urgent.",
    'xp_reward' => 100,
    'onboarding_entry_key' => 'overwhelm',
    'is_gentle_opener' => false,
    'category' => 'prioritization',
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Two urgent things 🔥 (1) chase the packaging supplier, they've gone quiet and it's driving me crazy, and (2) update the Q3 numbers in the investor one-pager, I need to send it out today. Both ASAP, I'm slammed!!",
            'scaffold_hint' => "Both say \"urgent,\" but only one has a hard deadline attached (\"send it out today\"). Judge which is truly time-critical, then tell her your order and rough ETAs. Don't freeze and don't just go top-to-bottom.",
            'tagalog_tip' => 'Pareho silang sinabing urgent, pero tingnan mo kung alin talaga ang may hard deadline. Wag ka basta susunod sa pagkakasunod-sunod na binanggit niya, isipin mo kung alin ang mas time-critical.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Got it! I'll start with the supplier since you listed it first, then move on to the one-pager after 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You worked in the order she typed them rather than the order the real deadlines demand.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-order-typed-isnt-order-due',
                        'title' => 'The order things arrive isn\'t the order they\'re due',
                        'body' => "When two tasks come in one message, it's natural to just work top to bottom. But the sequence a rushed founder types has nothing to do with which is actually time-critical. She's just braindumping in whatever order they popped into her head.\n\nHere, item two carries a hard deadline: the one-pager has to go out today. The supplier is genuinely annoying but has no stated deadline. Doing the supplier first because it was mentioned first risks the one thing with a real clock on it.\n\nBefore you start, re-sort the list yourself by real deadline and impact. First-come-first-served is easy, but it's the absence of triage dressed up as action.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => 'Both sound really urgent! 😅 Which one do you want me to do first?',
                    'is_correct' => false,
                    'diagnostic' => 'You bounced the ranking back to her when the deadlines already told you which comes first.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-dont-punt-the-ranking',
                        'title' => 'Don\'t hand back a call you can make',
                        'body' => "Asking \"which first?\" feels safe, but she hired you partly to take this exact decision off her plate. And she already gave you what you need to decide: one task must go out today, the other has no deadline. The answer is in her own message.\n\nPunting the ranking back adds a round-trip to her already overloaded day and signals you can't prioritize without hand-holding. It's the prioritization equivalent of asking a question you could answer by reading one line more carefully.\n\nSave your questions for genuine ambiguity, like when two tasks really are equally time-critical and only she knows the tiebreaker. When the deadlines already rank themselves, just rank them.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "On it. I'll do the one-pager first since it has to go out today. Q3 numbers updated and back to you for review in ~30 min. Then I'll chase the supplier right after (~15 min). Shout if the supplier's actually more time-sensitive than I'm assuming.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "No problem, I'll tackle both at the same time so they're both moving forward together! 🔥",
                    'is_correct' => false,
                    'diagnostic' => 'You split your focus across both, which risks two half-finished tasks instead of one truly done.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-dont-do-both-at-once',
                        'title' => 'Two things half-done helps no one',
                        'body' => "Doing both at once feels maximally responsive, like everything's moving! But attention doesn't really split; you end up toggling, both tasks crawl, and at the deadline you have two things at 60% and nothing she can actually use.\n\nThe one-pager has to go out today. \"Almost done\" doesn't send. Far better to finish the time-critical task completely, hand it over, then give the second your full focus. One clean deliverable beats two stalled ones.\n\nWhen everything's urgent, the fastest path to relief is to do them one at a time. Fully finish the thing with the clock on it first, then move to the next.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Oh wait, update: my co-founder just told me the investor meeting got pushed to next Tuesday, so the one-pager isn't needed till Monday. BUT the packaging supplier, turns out that shipment is for our launch photoshoot TOMORROW morning. 😬",
            'scaffold_hint' => "New facts just flipped the picture: the one-pager's deadline moved out, the supplier's just became tomorrow. Don't cling to your old plan, and don't throw the re-ranking back at her. Adjust and re-propose.",
            'tagalog_tip' => 'Nagbago yung sitwasyon, kaya wag kang kumapit sa dating plano. Isipin mo ulit kung alin na ngayon ang mas urgent base sa bagong deadlines, tapos i-propose mo yung bagong order sa kanya.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Ah, that changes the order. Supplier goes first now. The photoshoot's tomorrow AM, so I'll message and call them right away to confirm shipping and get a tracking update (~15 min). The one-pager I'll do this afternoon so it's ready well before Monday. Good with that?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "Sounds good! I'll still finish the one-pager first like we planned, then get onto the supplier after 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You stuck to the old plan even though the new information reversed which task is urgent.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-re-triage-on-new-info',
                        'title' => 'New information means run the triage again',
                        'body' => "You made a good call a minute ago, so it's tempting to defend it. But priorities aren't set once. They're only as good as the facts behind them, and those just changed. The one-pager's deadline slid to Monday; the supplier's became tomorrow morning.\n\nSticking to the old order because it was right five minutes ago means working a stale plan. The photoshoot can't happen without that packaging, and it's tomorrow. That's now the real fire.\n\nWhen fresh information lands, run the triage again with the new facts. Good prioritizers update fast when the picture moves; they don't get attached to a plan that the situation has already outgrown.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'Okay that shakes things up! So which should I prioritize now, the supplier or the one-pager?',
                    'is_correct' => false,
                    'diagnostic' => 'A change that made the priority obvious still ended with you asking her to rank it for you.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-new-facts-dont-need-a-vote',
                        'title' => 'Obvious re-rankings don\'t need her vote',
                        'body' => "When the situation shifts, asking \"so what now?\" can feel appropriately humble. But she just handed you the two facts that settle it: the one-pager isn't needed till Monday, and the supplier feeds a photoshoot tomorrow morning. The re-ranking does itself.\n\nKicking that back to her makes her do the reasoning twice: once to tell you the new facts, then again to draw the obvious conclusion. On a slammed day, that's friction she can feel.\n\nUse the new information to update your plan, then show her the updated plan for a quick yes. \"This flips the order, supplier first, here's why\" proves you're tracking. \"What now?\" proves only that you noticed something changed.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Understood, dropping everything for the supplier! 🔥 I'll get to the one-pager whenever I have a spare moment.",
                    'is_correct' => false,
                    'diagnostic' => 'You swung so hard toward the supplier that the still-due one-pager lost its slot and any ETA.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-reprioritize-without-dropping',
                        'title' => 'Re-rank the list, don\'t abandon half of it',
                        'body' => "Reacting to the new fire, it's easy to over-correct: supplier becomes everything, and the one-pager gets a vague \"whenever.\" But re-prioritizing means changing the order of the list, not deleting items from it. The one-pager still has a real Monday deadline.\n\n\"Whenever I have a spare moment\" isn't a plan. It's how a genuinely-due task quietly slips until it's suddenly late too. You'd be trading one missed deadline for another.\n\nMove the supplier to first, yes, but keep the one-pager on the board with its own slot and ETA (\"this afternoon, ready before Monday\"). Good triage reorders everything and still lands everything.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Yes! Supplier first, that's a relief 🙏 go go go",
            'scaffold_hint' => "You reach the supplier and they confirm the shipment. Close the loop: report the real outcome, and don't leave the still-pending one-pager or overreach into things she never asked for.",
            'tagalog_tip' => 'Nakumpirma na ng supplier, pero isipin mo kung ano talaga ang totoong nangyari bago mo sabihin na ayos na. Wag ding kalimutan yung one-pager, at wag gagawa ng bagay na hindi naman hiningi.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Supplier's all sorted, don't worry about it! 😊 One less thing on your plate.",
                    'is_correct' => false,
                    'diagnostic' => 'You called it "sorted" when you\'ve only left a message and have no confirmation the packaging actually ships in time.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-confirmed-not-just-contacted',
                        'title' => '"Sorted" means you actually have confirmation',
                        'body' => "Reaching out to the supplier feels like the job is done, so \"all sorted\" slips out. But on a task where the photoshoot is tomorrow, what matters isn't that you contacted them. It's whether the packaging is confirmed to arrive in time. Those are very different states.\n\nIf all you've done is leave a message, the outcome is still open, and telling her \"don't worry\" invites her to stop tracking something that could still fail overnight. That's a false sense of safety, which is worse than none.\n\nReport the actual status: \"left a message, chasing a confirmation\" versus \"confirmed, ships tonight, arrives 8am.\" Only the second earns the word sorted. Close the loop on the outcome, not just the effort.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Supplier confirmed: packaging ships tonight, arrives 8am tomorrow, tracking's in your inbox. ✅",
                    'is_correct' => false,
                    'diagnostic' => 'You nailed the supplier but never mentioned the one-pager, so she\'s left unsure whether Monday\'s deadline is covered.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-close-both-loops',
                        'title' => 'Close every loop you were juggling',
                        'body' => "The supplier update is excellent, specific and confirmed. But the two of you were juggling two tasks, and this report accounts for only one. She's now left wondering: is the one-pager handled, or did it fall off the table when the priority flipped?\n\nWhen you've been triaging multiple items, the closing update has to speak to all of them, even the one you deliberately parked. A single line like \"one-pager queued for this afternoon, ready before Monday\" tells her nothing slipped through.\n\nThe whole point of triage is that everything lands. Your final update should prove it by touching each item, so she doesn't have to hold the second one in her own head.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Done! Supplier confirms packaging ships tonight and arrives 8am tomorrow, tracking's in your inbox. The one-pager Q3 update is queued for this afternoon so it's ready well before Monday. Anything else on fire? 🙌",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "Supplier's shipping ✅ and since I had a bit of time, I emailed the investor directly to reschedule and rewrote the one-pager's intro to sound punchier while I was at it!",
                    'is_correct' => false,
                    'diagnostic' => 'You reached past your task into emailing the investor and rewriting content she never asked you to change.',
                    'lesson' => [
                        'slug' => 'two-urgent-requests-dont-overreach-with-spare-time',
                        'title' => 'Spare time isn\'t a licence to overreach',
                        'body' => "Having a spare moment and using it to do more feels proactive. But emailing the investor is founder-level communication that's hers to own, and rewriting the one-pager's copy changes her message without her say-so. Both are well past what she asked for.\n\nInitiative is valuable when it stays inside the task and the bounds of your role. It becomes a liability the moment it touches high-stakes relationships or rewrites the client's own words. Now she has to check, and possibly undo, work she never requested.\n\nIf you spot something worth doing with spare time, offer it: \"Want me to draft a reschedule note to the investor for your ok?\" That's proactive and safe. Doing it unilaterally is a risk she didn't sign up for.",
                    ],
                ],
            ],
        ],
    ],
];
