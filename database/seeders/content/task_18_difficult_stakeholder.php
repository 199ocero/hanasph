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
    'slug' => 'difficult-stakeholder',
    'order' => 17,
    'title' => 'The blunt reply',
    'client_persona' => "Dana, events coordinator at a restaurant (not your client; someone you're dealing with on Priya's behalf)",
    'scenario_intro' => 'Your client Priya is hosting a dinner for eight of her best customers and asked you to book a private room at a well-regarded restaurant. You emailed to enquire, and Dana, the events coordinator, is all business.',
    'xp_reward' => 200,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'comms',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "We don't hold private rooms on a 'maybe'. It's a \$200 deposit to reserve, non-negotiable, and I need a firm headcount by Friday, not 'around 8'. If that doesn't work there are plenty of places that'll take a vague booking. - Dana",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Halatang blunt at parang matalas si Dana, pero wag mo yun i-take personally. Isipin mo kung ano talaga yung goal dito para sa client mo, tapos doon ka mag-focus.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Understood. No need for the sharp tone though, it was a straightforward question. The deposit's fine, I'll get you a firm number by Friday.",
                    'is_correct' => false,
                    'diagnostic' => "You landed the substance but couldn't resist a jab at her tone, which turns a working relationship into a standoff.",
                    'lesson' => [
                        'slug' => 'difficult-stakeholder-dont-return-fire',
                        'title' => 'Don\'t return fire',
                        'body' => "When someone's curt with you, meeting it feels like standing your ground, even if you stay mild, even while you're the one in the right. But you're not here to win a tone contest. You're here to get your client a private room, and a stakeholder you've just corrected is a stakeholder who now finds reasons to be unhelpful.\n\nA rude tone is almost never about you. It's the person's default, or their bad morning, or the third annoying booking of the day. Reacting to it makes it about you, and drags your client's business into a petty exchange.\n\nThe professional move is to let the tone pass straight through you and answer only the substance, warmly. Not because they earned warmth, but because your client's result depends on this person cooperating. Absorbing tone isn't weakness. It keeps you pointed at the goal while they're pointed at their mood.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "I am so sorry, you're completely right and I didn't mean to waste your time at all. I feel terrible for any confusion. Please forgive me. I'll sort the deposit and the numbers straight away. So sorry again!",
                    'is_correct' => false,
                    'diagnostic' => "You apologised profusely for something that wasn't a wrongdoing, shrinking yourself and reading as unprofessional.",
                    'lesson' => [
                        'slug' => 'difficult-stakeholder-dont-grovel',
                        'title' => 'Bluntness isn\'t an accusation',
                        'body' => "A curt message can feel like being told off, and the instinct is to smooth it over with apology. But you didn't do anything wrong. You asked a normal question and got a blunt answer. Apologising for that treats her rudeness as if it were your fault.\n\nOver-apologising also quietly costs you standing. To the stakeholder, someone who grovels over nothing reads as someone unsure of themselves, which is exactly the impression that invites more brusqueness, not less. You represent your client; shrinking makes them look small too.\n\nSave real apologies for real mistakes, where they matter. When someone is simply blunt, don't apologise and don't bristle. Just be pleasant and get on with the substance. Calm and unbothered is the posture that earns respect from difficult people.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Hi Priya, quick heads up, the restaurant's events coordinator is being pretty rude to me over the booking. Could you maybe reach out to her directly? I'm not totally sure how to handle her tone.",
                    'is_correct' => false,
                    'diagnostic' => 'You bumped a routine, handleable request up to your client just because the other person was blunt.',
                    'lesson' => [
                        'slug' => 'difficult-stakeholder-handle-it-yourself',
                        'title' => 'Handle what you were hired to handle',
                        'body' => "Priya delegated this booking so it would leave her plate. It shouldn't bounce back the moment someone is short with you. A blunt coordinator asking for a deposit and a headcount is an ordinary hurdle, not a crisis that needs the client's personal attention.\n\nEscalating over tone quietly tells your client the opposite of what you want them to believe. Instead of 'I can shield you from the annoying parts,' it says 'the annoying parts still land on you.' That's the whole reason to hire a VA, undone.\n\nEscalate when there's a real decision only the client can make, or genuine abuse. A stakeholder simply being terse is squarely within your job to absorb. Solve it, and let Priya hear about it, if at all, as 'booked, deposit paid, done.'",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Thanks Dana, that all works. Happy to place the \$200 deposit today to hold the private room; just point me to the best way to pay it. I'll have the firm headcount to you by Friday. Anything else you need from me to lock it in?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Deposit link's on the confirmation I'll send. Look, I'm blunt because I've eaten the cost of three no-show 'private room' bookings this quarter. Get me the deposit and a firm eight and the room's yours. Anything less and you're in the main dining room with everyone else.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Sinabi na ni Dana kung ano exactly yung kailangan niya para ma-secure yung room. Isipin mo kung anong konkretong hakbang ang tutugon dun, hindi lang yung basta assurance na maaasahan kayo.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "That makes total sense. No-shows are a real cost and thanks for being straight with me. I'll send the \$200 the moment your confirmation lands and lock it at a firm eight. The private room's exactly what we want, so consider it committed.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "Oh please don't worry about us, we're completely reliable and would never no-show; you have my word we'll be there. There's honestly no need for a deposit in our case, we're good for it.",
                    'is_correct' => false,
                    'diagnostic' => 'She told you exactly what would secure the room, the deposit, and you offered reassurance instead of the one concrete thing she asked for.',
                    'lesson' => [
                        'slug' => 'difficult-stakeholder-give-the-thing-asked-for',
                        'title' => 'Give the concrete thing she asked for',
                        'body' => "When a difficult person finally explains themselves, like 'I've been burned by no-shows,' it's tempting to answer the feeling: reassure them you're different, promise you're trustworthy. But she didn't ask for reassurance. She named the exact thing that fixes her problem: a deposit and a firm number.\n\nWords are the cheapest possible currency, and to someone who's heard 'we'll definitely show up' three times before eating the loss, they mean nothing. Asking her to waive the deposit because you're 'good for it' asks her to take on the very risk she just told you she won't.\n\nWhen someone tells you what they need, give them exactly that instead of a substitute you find more comfortable. Reading past a prickly tone means hearing the concrete requirement underneath it, then simply meeting it.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "No problem, the main dining room is fine for us then. We'll just take the regular seating to keep things simple.",
                    'is_correct' => false,
                    'diagnostic' => 'You gave up the private room your client actually wanted the moment there was mild friction, instead of meeting an easy condition.',
                    'lesson' => [
                        'slug' => 'difficult-stakeholder-dont-surrender-the-goal',
                        'title' => 'Don\'t trade away the goal to dodge friction',
                        'body' => "A brusque stakeholder makes the easy path look like the smooth path: just take the regular seating, avoid the hassle, keep things pleasant. But 'pleasant for you' quietly sacrifices what your client actually asked for: a private room for eight important guests.\n\nThe condition here is trivial to meet: a deposit and a confirmed count, both of which you can supply. Surrendering the private room to sidestep a slightly uncomfortable exchange trades your client's goal for your own comfort. That's a bad trade you're not authorised to make.\n\nFriction with a stakeholder is not a reason to lower the bar. When the ask is reachable and the client wanted it, meet the condition and keep the goal. Absorb the tone; don't let it cost the outcome.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Let me check with my client and I'll circle back to you on the deposit. I'll confirm with her whether we want to go ahead and get back to you.",
                    'is_correct' => false,
                    'diagnostic' => 'Booking the room was already the task you were given, so stalling to re-confirm risks losing it over a decision that was yours to make.',
                    'lesson' => [
                        'slug' => 'difficult-stakeholder-dont-stall-when-you-can-act',
                        'title' => 'Don\'t hide behind "let me check"',
                        'body' => "'Let me check with my client' sounds diligent, and sometimes it's exactly right. But here Priya already gave you the task, which was to book the private room, and the deposit is simply the mechanism for doing it. Going back to her adds a delay that risks the very room you were told to secure, while the coordinator waits and other bookings compete for it.\n\nWatch for using 'I'll check' as a place to hide when a stakeholder is intimidating. It feels safer than committing, but it stalls the outcome and signals that you can't move without hand-holding, the opposite of the reliability you're building.\n\nKnow the edges of your mandate. When an action clearly serves the task you were handed and the cost is small and expected, act. Reserve 'let me check' for genuinely new decisions the client hasn't already made.",
                    ],
                ],
            ],
        ],
    ],
];
