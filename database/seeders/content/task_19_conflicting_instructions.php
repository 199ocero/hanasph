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
    'slug' => 'conflicting-instructions',
    'order' => 19,
    'title' => 'Two bosses, two answers',
    'client_persona' => 'Elena and Rob, the two partners who own Bloom & Co',
    'scenario_intro' => 'You run social media for Bloom & Co, a small online plant shop with two owners. Yesterday Elena told you to publish the Black Friday sale post Monday at 9am, and you scheduled it. This morning, a different message lands.',
    'xp_reward' => 200,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'comms',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Morning, do NOT publish anything about the Black Friday sale yet. Legal still hasn't cleared the discount wording and if the percentages are off we're exposed. Hold all sale posts until I give the all-clear. Cheers, Rob",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Dalawang owners na magkaiba ng utos, so hindi sa iyo yung desisyon kung sino ang susundin. Isipin mo paano mo maipapaalam sa kanila nang neutral yung conflict para sila mismo ang magdesisyon.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Got it Rob, I've pulled Monday's sale post from the schedule and I'll hold everything sale-related until you give the all-clear. 👍",
                    'is_correct' => false,
                    'diagnostic' => "You quietly overrode Elena's instruction on Rob's say-so without telling her, so the person who set the plan has no idea it changed.",
                    'lesson' => [
                        'slug' => 'conflicting-instructions-dont-silently-pick-a-side',
                        'title' => 'Don\'t silently pick a side',
                        'body' => "When two people who both direct you disagree, the fastest way out is to just obey the most recent, or the loudest, or the most senior, and quietly do it. It feels decisive. But you've now made a call that wasn't yours, and you've hidden it from the person you overrode.\n\nThe damage isn't only the wrong action. It's the silence. Elena set that post deliberately. She finds out it vanished when she goes looking for it, with no idea why or who moved it, and now she can't trust that her instructions stick.\n\nYou are not the person who resolves a conflict between two owners by choosing a winner. Your job is to make the conflict visible to them, quickly and neutrally, so the right person decides. Picking a side silently just swaps their disagreement for a mess with your name on it.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Thanks for the flag, Rob. Quick heads-up to you both: Elena had this scheduled for Monday 9am, and Rob's now asked to hold it until legal clears the wording. Since publishing uncleared numbers is the hard-to-undo one, my plan is to pause the Monday post and keep it queued so it's ready to fire the moment it's cleared. Shout if either of you wants it handled differently.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Oh, that's a tricky one. Elena told me to post it and now you're saying hold. I don't think I can do anything until you two are on the same page, so I'll sit tight and wait to hear.",
                    'is_correct' => false,
                    'diagnostic' => 'You stopped everything and waited instead of proposing a safe path, leaving a scheduled post to fend for itself.',
                    'lesson' => [
                        'slug' => 'conflicting-instructions-dont-freeze',
                        'title' => 'Surfacing the conflict isn\'t the same as freezing',
                        'body' => "Faced with two contradicting bosses, doing nothing feels like the responsible neutral choice. You're not picking a side, you're waiting for clarity. But 'I'll sit tight' isn't neutral. There's a live post scheduled to auto-publish, and passivity has quietly chosen that it publishes.\n\nFlagging a conflict is only half the job. The other half is proposing a sensible interim path so nothing bad happens while the humans sort it out. Freezing skips that half and leaves a landmine armed.\n\nGood VAs pair the flag with a default: 'here's what I'll do unless you tell me otherwise.' That keeps things moving and safe without overstepping. Waiting with no plan just moves the risk from 'I chose wrong' to 'I chose nothing,' which, when a clock is running, is still a choice.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Replying to Rob: 'Elena specifically told me to post this Monday though.' And messaging Elena separately: 'FYI Rob just told me NOT to publish your Black Friday post, you two might want to sort that out.'",
                    'is_correct' => false,
                    'diagnostic' => 'You relayed each partner\'s position back at the other as a contradiction, dropping yourself into the middle of a fight instead of neutrally surfacing a decision.',
                    'lesson' => [
                        'slug' => 'conflicting-instructions-dont-play-messenger',
                        'title' => 'Surface the decision, don\'t stoke the fight',
                        'body' => "There's a thin but crucial line between surfacing a conflict and stirring one. Telling Rob 'but Elena said' and telling Elena 'Rob says don't,' each in a separate channel, frames it as a clash of people. Now you're the messenger carrying accusations between two partners, and the tension lands on you.\n\nThe neutral version puts the facts in one place, without blame, aimed at a decision: 'I've got two different instructions on the same post, here's my suggested default, which way do you want it?' No one is quoted against the other; there's just a fork that needs picking.\n\nHow you frame the conflict shapes whether it resolves calmly or becomes drama. Keep it about the task and the choice, never about who's right. You want to be the person who made the decision easy, not the one who turned a wording delay into an argument.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "[It's Sunday evening. Elena still hasn't replied to the thread. The post is set to auto-publish at 9am Monday.] Rob: Still nothing from legal and I'm offline till tomorrow afternoon. Did Elena see this? Just make sure that post does not go out.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Malapit na yung 9am deadline at tahimik pa rin si Elena. Isipin mo kung aling aksyon yung pwede mo pang bawiin kung sakaling mali, kaysa yung hindi na maiuurong pag nangyari na.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Elena's the one who scheduled it and she hasn't said to stop, so I'll let it publish at 9am as planned. Better to follow the original instruction than second-guess it.",
                    'is_correct' => false,
                    'diagnostic' => 'Under deadline pressure you gambled on the irreversible option, publishing legally-uncleared wording on a guess.',
                    'lesson' => [
                        'slug' => 'conflicting-instructions-default-to-reversible',
                        'title' => 'When unsure, default to what you can undo',
                        'body' => "With the clock running and the decision-owner silent, you have to fall back on a default. The wrong instinct is to default to whichever action is already in motion, like 'it's scheduled, so let it ride.' Momentum is not the same as a decision.\n\nThe better test is reversibility. Holding a post is completely undoable; you publish it an hour later and lose nothing. Publishing legally-uncleared wording to a 4,000-person list cannot be taken back. When one path is reversible and the other isn't, and you're genuinely unsure, the reversible one is almost always the safer default.\n\nThis isn't picking a side in the disagreement. It's choosing the option that keeps every option open. You can always publish later once someone confirms. You can't unsend.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "I'll just soften the discount wording myself so it isn't making any specific legal claims, then let it publish on time, so it still goes out but avoids the risk Rob's worried about.",
                    'is_correct' => false,
                    'diagnostic' => "You made a legal judgment call that wasn't yours to make, turning a hold into a decision well outside your lane.",
                    'lesson' => [
                        'slug' => 'conflicting-instructions-stay-in-your-lane',
                        'title' => 'Solving it yourself can be overstepping',
                        'body' => "When you're stuck between two instructions, inventing a third can feel like the resourceful move, a clever compromise you author yourself. But rewriting the discount wording to dodge a legal concern means you've quietly appointed yourself the legal reviewer. That's a call no one delegated to you, on exactly the risk Rob raised.\n\nInitiative is a virtue right up to the edge of your competence and authority. Past that edge, 'I fixed it myself' becomes 'I made an unqualified decision about something that could expose the business.' The concern here is precisely the kind you route to the right person, not around them.\n\nA safe default keeps things as they are until the owner decides. It doesn't quietly manufacture a new version of the thing that's in dispute. Hold, flag, and let the people with the authority and the legal review make the actual call.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "I've messaged Elena again and I'll keep trying her tonight. Until one of them confirms I don't want to touch the schedule, so I'll keep waiting and hope she replies before 9am.",
                    'is_correct' => false,
                    'diagnostic' => 'You left the auto-publish armed and pinned the outcome on a reply that might not come, letting the deadline make the risky decision for you.',
                    'lesson' => [
                        'slug' => 'conflicting-instructions-act-on-the-safe-default',
                        'title' => 'A soft deadline still forces a call',
                        'body' => "Chasing the silent decision-owner feels productive. You're being proactive, you're trying. But if your whole plan is 'keep nudging and hope,' you've handed the decision to the clock. When 9am arrives with no reply, the post publishes, and inaction chose the irreversible outcome you were worried about.\n\nWhen a deadline is about to overtake a decision that isn't coming, the move is to act on the reasonable default you already flagged, which here is holding the post, safe and undoable, while keeping the question open. Both owners had effectively pointed the same way (Rob asked twice to hold; Elena went quiet), so the default is clear.\n\nProceeding on a stated, sensible default is not the same as guessing wildly. It's the disciplined middle path between freezing and gambling: do the safe thing now, leave the door open, and let them confirm when they surface.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Done. I've paused the Monday post so it won't auto-publish, since holding is the easily-reversible call and Rob's now asked twice to wait. It stays queued, and I've left a note pinned at the top of the thread for Elena: it's ready to go live the second she gives the word. Nothing's lost either way.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
    ],
];
