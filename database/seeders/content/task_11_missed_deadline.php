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
    'slug' => 'missed-deadline',
    'order' => 11,
    'title' => "When you're going to be late",
    'client_persona' => 'Deepa — runs a small online course business',
    'scenario_intro' => "Deepa asked you to have the new lesson workbook formatted and back to her by end of day Wednesday. It's Tuesday afternoon and you can already tell it won't be ready in time.",
    'xp_reward' => 150,
    'onboarding_entry_key' => null,
    'category' => 'comms',
    'beats' => [
        [
            'order' => 1,
            'client_message' => 'Hi! Just checking in — still good for the workbook by end of day tomorrow? I want to send it to the students Thursday morning.',
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Yep, all good — working on it now!',
                    'is_correct' => false,
                    'diagnostic' => 'You already knew it would be late and confirmed the old deadline anyway, which just moves the bad news to a worse moment.',
                    'lesson' => [
                        'slug' => 'missed-deadline-dont-hide-it',
                        'title' => "Bad news doesn't improve with age",
                        'body' => "When you sense a deadline slipping, the tempting move is to stay quiet and hope you can still pull it off. It feels like buying time. What you're really doing is taking away the client's time.\n\nA client who knows on Tuesday can adjust — push the send, warn the students, help you cut scope. A client who finds out Wednesday night has no room left to do any of that. The same delay costs them far more the later they hear it.\n\nTell them the moment you're reasonably sure, not the moment it's undeniable. Early honesty is a gift you can only give while there's still time to use it.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Hi Deepa — heads up early: the workbook is running behind and won't be ready by end of day tomorrow. The formatting is taking longer than the sample did. I can have it fully done by Thursday lunchtime. If it helps, I can send you the first 3 lessons tomorrow so you can start reviewing while I finish the rest.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Deepa, I am SO sorry — I feel terrible but I don't think I'll make tomorrow. I've been so stressed about this and I really didn't want to let you down, I hate that I'm even sending this message. I promise this isn't like me and I'll make it up to you, I'm really sorry again 😞",
                    'is_correct' => false,
                    'diagnostic' => 'The message is all apology and emotion with no revised date or plan, so it hands the client your feelings instead of a solution.',
                    'lesson' => [
                        'slug' => 'missed-deadline-apology-is-not-a-plan',
                        'title' => 'A revised plan beats a big apology',
                        'body' => "When you let someone down, guilt makes you want to apologise hard so they know you care. But a wall of apology puts the client in the awkward spot of having to comfort you — about a problem that's affecting them.\n\nWhat they actually need is information: when will it be done, and what happens in the meantime? One short, genuine \"sorry this is late\" is plenty. Everything after that should be the new date and how you'll limit the damage.\n\nKeep the feelings brief and the plan clear. Owning the miss is shown by fixing it well, not by how bad you say you feel.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Hi Deepa — it's going to be late, but honestly it's because you sent the raw content two days later than we agreed, so the timeline shifted. Not much I could do on my end.",
                    'is_correct' => false,
                    'diagnostic' => 'Even if the late input is a real factor, opening with blame makes the client defensive and dodges your responsibility for the outcome.',
                    'lesson' => [
                        'slug' => 'missed-deadline-own-it-dont-blame',
                        'title' => 'Own the outcome, even when a cause is real',
                        'body' => "Sometimes the delay genuinely isn't all your fault — the client was late, a tool broke, someone else dropped the ball. It's tempting to lead with that so you don't look bad.\n\nThe problem is that blame, even accurate blame, changes the subject from \"how do we fix this\" to \"whose fault is it.\" The client hears an excuse and stops trusting you to just handle things.\n\nOwn the outcome first: here's the new plan. If a genuine timeline issue needs flagging for next time, raise it later, calmly, as a process fix — \"to protect the deadline, could we lock content two days earlier?\" That protects the schedule without pointing fingers in the heat of a miss.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Ugh, okay. That's cutting it close — I really wanted a buffer before Thursday morning. Are you SURE it'll be done by Thursday lunch? I can't have this slip again.",
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => "Yes — Thursday lunchtime, that's locked. To make the buffer work: I'll send lessons 1–3 to you first thing tomorrow so you can start reviewing, and the full workbook by 12pm Thursday. That still leaves you Thursday afternoon before the morning send. I'll message you the moment each part is ready.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "You know what, forget Thursday lunch — I'll push hard tonight and get the whole thing to you by tomorrow morning instead. I'll make it happen, promise!",
                    'is_correct' => false,
                    'diagnostic' => 'To calm a stressed client you promised an even tighter deadline than the one you just said you would miss.',
                    'lesson' => [
                        'slug' => 'missed-deadline-dont-over-promise',
                        'title' => "Don't fix a slip by promising the impossible",
                        'body' => "When a client is anxious, the urge is to make the anxiety disappear by promising something bigger and faster. It works for about a day — until you miss the new, tighter deadline too, and now you've broken your word twice.\n\nThe way to rebuild trust after a slip is a realistic commitment you actually hit, not a heroic one you probably won't. Reliability is believed when it's demonstrated, not when it's promised loudly.\n\nHold the honest date you gave. Meeting a slightly later deadline exactly rebuilds more trust than missing an earlier one you grabbed to look good.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "I'm so sorry again for the stress, I really am. I understand if you're frustrated with me and I completely get it if you want to find someone more reliable. I feel awful.",
                    'is_correct' => false,
                    'diagnostic' => 'The client asked for reassurance about the plan and instead got more grovelling that offers them your job back mid-crisis.',
                    'lesson' => [
                        'slug' => 'missed-deadline-stay-steady',
                        'title' => 'Under pressure, be the calm one',
                        'body' => "A stressed client is looking to you to steady the situation. If you match their stress with more apology and self-doubt, you make the room more anxious, not less — and offering to quit turns their small worry into a big one.\n\nWhat reassures a nervous client is competence, not contrition. Restate the plan plainly, confirm the date, and tell them exactly when they'll hear from you next. That calm, specific tone is what makes them believe it's under control.\n\nYou've already apologised once. Now your job is to be the most composed person in the conversation.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "It should be fine! I'll do my best to have it done around Thursday, maybe lunchtime-ish, hopefully no later.",
                    'is_correct' => false,
                    'diagnostic' => 'After a slip the client needed a firm commitment, but the hedging words leave the new deadline just as uncertain as the last one.',
                    'lesson' => [
                        'slug' => 'missed-deadline-be-concrete',
                        'title' => 'A second chance needs a firm number',
                        'body' => "\"Should be fine,\" \"around Thursday,\" \"hopefully\" — soft language feels safer because it doesn't box you in. But right after a missed deadline, vagueness reads as \"this might slip again too,\" which is exactly the fear you need to kill.\n\nGive one concrete commitment: a specific time, and what they'll receive. Certainty is what lets a rattled client relax and plan around you.\n\nIf you're genuinely unsure of the time, do the thinking until you can name one you'll actually hit — then say it plainly. A clear promise you keep is how trust comes back.",
                    ],
                ],
            ],
        ],
    ],
];
