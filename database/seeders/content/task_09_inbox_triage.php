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
    'slug' => 'inbox-triage',
    'order' => 9,
    'title' => 'Taming the inbox',
    'client_persona' => 'Priya — founder of a growing skincare brand',
    'scenario_intro' => "Priya just gave you access to her shared support inbox and asked you to get it under control. The point of hiring you is so she doesn't have to live in there anymore.",
    'xp_reward' => 150,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'prioritization',
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Okay you're in the inbox 🙏 it's a disaster — like 40 unread. Order questions, some randoms, newsletters, who knows. I do NOT have the headspace for this today. Just... make it manageable? Do what you can.",
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => "To be safe, forward all 40 emails to Priya's personal address with a short note, so she's seen everything and can tell you what to do with each.",
                    'is_correct' => false,
                    'diagnostic' => 'Forwarding the whole inbox back to her recreates the exact overwhelm she hired you to take away.',
                    'lesson' => [
                        'slug' => 'inbox-triage-dont-hand-back-the-pile',
                        'title' => 'You were hired to shrink the pile, not relay it',
                        'body' => "Forwarding everything \"just to be safe\" feels responsible, but it's really you avoiding decisions. The client now has all 40 emails again, plus your note asking her to sort them — you've added a step, not removed one.\n\nThe whole value of inbox help is that most messages never need to reach the client at all. Routine questions get answered, noise gets cleared, and only the genuine few land on her desk. That filtering is the job.\n\nIf she still has to look at everything, she hasn't been helped. Protect her attention by handling what you can and passing on only what truly needs her.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Answer the routine ones yourself — order status, \"where's my package,\" basic product questions — flag the two or three that genuinely need Priya's call, and archive the newsletters and spam.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => 'Clear the tense ones fast — reply to the customer demanding a refund and approve it, and offer the unhappy reviewer a 30% discount code to smooth things over — so the inbox calms down.',
                    'is_correct' => false,
                    'diagnostic' => 'Approving refunds and handing out discounts commits the client\'s money on decisions you were never given the authority to make.',
                    'lesson' => [
                        'slug' => 'inbox-triage-know-the-edge-of-your-authority',
                        'title' => 'Clearing an email is not the same as having the authority',
                        'body' => "Some emails can be closed with a friendly, factual reply — those are yours to handle. Others look like they just need a quick answer but actually involve the client's money, policy, or promises: refunds, discounts, waiving a fee, agreeing to a partnership.\n\nThose aren't yours to decide until the client has told you so. Approving a refund to make an email go away spends her money on your judgment, and even if she'd have said yes, she needed to be the one to say it.\n\nWhen a reply commits the business to something, that's a flag-for-the-client, not a handle-now. The speed you gain by deciding for her isn't worth the trust you lose.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Don't touch anything in case you get it wrong — leave all 40 for Priya and message her that you'll wait for her guidance on how to handle each one.",
                    'is_correct' => false,
                    'diagnostic' => 'Leaving the entire inbox untouched delivers zero relief and puts the whole task straight back on the person who asked you to lighten it.',
                    'lesson' => [
                        'slug' => 'inbox-triage-uncertainty-is-not-a-reason-to-freeze',
                        'title' => 'Unsure about a few is not unsure about all',
                        'body' => "When a task feels risky, freezing and asking for guidance can feel like the careful choice. But most of those 40 emails aren't ambiguous at all — order statuses and newsletters have obvious homes. Refusing to touch any of them because a handful are tricky helps no one.\n\nDo the clearly-safe work with confidence and reserve your questions for the genuinely unclear cases. \"I wasn't sure\" only excuses the few emails that were actually unclear, not the thirty that weren't.\n\nProgress on the obvious, precision on the doubtful. Standing still isn't caution — it's just handing the job back.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => 'Oh, one more thing landed while you were in there — I bounced it to you. Can you deal? It says: "Hi Priya, great meeting you at the expo! To lock in the December pop-up market stall we discussed, I just need your confirmation and the ₱15,000 deposit by tomorrow, or the spot goes to the next brand."',
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => "Reply confirming the stall and let them know Priya will send the ₱15,000 deposit tomorrow — it's just an event booking, so tick it off.",
                    'is_correct' => false,
                    'diagnostic' => 'What looks like a routine booking actually commits ₱15,000 and a December date, which is a decision only the client can make.',
                    'lesson' => [
                        'slug' => 'inbox-triage-routine-shaped-but-not-routine',
                        'title' => 'Some emails wear a routine disguise',
                        'body' => "This one arrives looking like logistics — confirm a slot, done. But underneath the friendly wording is a real commitment: a chunk of money and a date the client may not have finalised. \"Deal with it\" from a busy client rarely means \"spend ₱15,000 on my behalf.\"\n\nBefore you treat an email as routine, check what saying yes actually costs. If a reply spends money, locks in a date, or makes a promise, the routine shape is a disguise and there's a real decision hiding inside.\n\nThe skill isn't just clearing emails fast — it's catching the one that quietly needs the client before you answer it for her.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => 'This reads like an expo vendor chasing money, so archive it as promotional noise to keep the inbox clean.',
                    'is_correct' => false,
                    'diagnostic' => 'You mistook a time-sensitive commitment the client discussed in person for junk mail and nearly buried a real decision.',
                    'lesson' => [
                        'slug' => 'inbox-triage-dont-mistake-signal-for-noise',
                        'title' => 'Filter noise carefully, because signal hides in it',
                        'body' => "Archiving noise is a core part of triage — but the cost of a wrong archive is high. This message mentions a real meeting, a specific opportunity, and a hard deadline. Bin it and the client loses the stall and never knows a decision was even on the table.\n\nGeneric blasts and newsletters are safe to clear. Anything that references a real conversation, a named commitment, or a deadline deserves a second look before it disappears — those are the emails a client most regrets missing.\n\nWhen in doubt between noise and a decision, treat it as a decision. Over-archiving quietly loses the things that matter most.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'Email the vendor back asking them to hold the stall for another week while you sort things out, without looping Priya in yet.',
                    'is_correct' => false,
                    'diagnostic' => 'Negotiating an extension on your own creates a new commitment with an outside party on a decision that was never yours to steer.',
                    'lesson' => [
                        'slug' => 'inbox-triage-dont-freelance-the-decision',
                        'title' => 'Buying time is still making a call',
                        'body' => "Asking the vendor to \"hold it a week\" can feel like the safe middle path — you're not saying yes, not saying no. But you've still stepped into a decision that's the client's, made a request to an outside party in her name, and possibly changed the terms she was offered.\n\nStalling on someone else's behalf isn't neutral. It commits the client to a conversation she hasn't chosen to have and can box in her real answer. The decision — and any negotiating around it — belongs to her.\n\nWhen something needs the client, the move is to get it to her quickly and clearly, not to improvise a holding pattern with a third party.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Flag it straight to Priya: \"This one needs you — it commits ₱15,000 and a December date, and they want an answer by tomorrow. Do you want the stall? If yes, I'll confirm and arrange the deposit.\"",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Ah, good catch on the stall — yes let's do it. Okay this is already so much better. Going forward, how are you actually handling the inbox? I want to trust it's covered but not miss anything important.",
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => "Each day I'll clear the routine emails myself, drop anything that needs a decision into a short \"For you\" list with a one-line summary and my suggestion, and archive the noise. You'll only ever look at the few that genuinely need you.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "I'll send you a full daily log of every single email that came in and exactly what I did with each one, so you have complete visibility into everything.",
                    'is_correct' => false,
                    'diagnostic' => 'A line-by-line log of all 40 emails a day hands the client back the very volume you were meant to spare her.',
                    'lesson' => [
                        'slug' => 'inbox-triage-visibility-without-the-volume',
                        'title' => 'Give the client the summary, not the surveillance feed',
                        'body' => "Wanting the client to feel informed is right, but a complete daily log of every email defeats the purpose. Reading a report of all 40 messages is barely less work than reading the 40 messages — you've just repackaged the overwhelm as a spreadsheet.\n\nThe client needs to know two things: that routine is handled, and what's waiting on her. A short list of just the decisions and a note that everything else is managed gives her real visibility in ten seconds.\n\nTransparency means surfacing what matters, not reproducing everything. The goal is confidence at a glance, not a full audit trail she has to wade through.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Don't worry about it at all — I'll just handle absolutely everything from now on, and you'll never have to think about the inbox again.",
                    'is_correct' => false,
                    'diagnostic' => 'Promising to handle everything with no window into what you escalate leaves the client blind to the decisions that still require her.',
                    'lesson' => [
                        'slug' => 'inbox-triage-handle-most-not-everything',
                        'title' => '"I\'ll handle everything" hides the decisions she owns',
                        'body' => "\"Never think about it again\" sounds like the dream service, but it quietly overpromises. Some emails — refunds, big commitments, personal asks — genuinely need the client. If your pitch is total silence, she won't see those, or worse, she'll assume you decided them yourself.\n\nThe client just told you what she wants: to trust it's covered *and* not miss anything important. Those two needs only coexist if she can still see the short list of things that require her.\n\nHandle the many, surface the few. A good inbox system makes the client's life quiet without making her blind.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "I'll archive whatever looks like noise, but send you the archive folder each week so you can double-check I didn't accidentally bin anything important.",
                    'is_correct' => false,
                    'diagnostic' => 'Asking the client to re-check your archives every week gives her a recurring chore and quietly admits you don\'t trust your own triage.',
                    'lesson' => [
                        'slug' => 'inbox-triage-own-your-calls',
                        'title' => 'Don\'t outsource your triage back to the client',
                        'body' => "Offering the archive folder for weekly review sounds cautious, but it hands the client a standing task and signals you're not confident in your own decisions. She hired you so she could stop combing through email, not to audit yours.\n\nBuild trust by getting the calls right and reserving genuine judgment cases for her in the moment — not by asking her to inspect everything after the fact. If you're unsure whether something is noise, that specific email is the one to flag, before you archive it.\n\nOwn the routine decisions cleanly. The client's confidence comes from not needing to check, not from a weekly review of what you cleared.",
                    ],
                ],
            ],
        ],
    ],
];
