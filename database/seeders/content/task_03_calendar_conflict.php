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
    'slug' => 'calendar-conflict',
    'order' => 6,
    'title' => 'The double-booked afternoon',
    'client_persona' => 'Marge, owner of a small boutique',
    'scenario_intro' => "Marge runs a clothing boutique and just hired you to manage her calendar. It's your third day. She messages you in a hurry between customers.",
    'xp_reward' => 100,
    'onboarding_entry_key' => 'clients',
    'category' => 'comms',
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Hey! Just noticed my Thursday is a mess 😩 I've got the fabric supplier call AND the product photoshoot both at 2pm. I completely forgot. Can you look at this? I'm with a customer, ttyl",
            'scaffold_hint' => "Marge hired you to take work off her plate. She doesn't want to be handed the problem back. She wants to come back to a plan she can approve in one tap.",
            'tagalog_tip' => 'Si Marge, gusto niya pagbalik niya may plano na siyang aaprubahan, hindi yung tanong pa rin. Isipin mo kung paano mo mababawasan ang trabaho niya sa halip na madagdagan.',
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Hi Marge! I see the clash: supplier call and photoshoot both at 2pm Thu. Which one do you want me to keep at 2pm?',
                    'is_correct' => false,
                    'diagnostic' => 'You spotted the conflict but handed the decision straight back to her instead of doing the thinking first.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-propose-dont-punt',
                        'title' => 'Propose, don’t punt',
                        'body' => "When you find a problem, your first instinct as a beginner is to report it and ask what to do. That feels safe, but to the client it's just more work landing back on them, the exact thing they hired you to prevent.\n\nThe move is to do the thinking first, then bring back a recommendation they can approve or tweak. So instead of \"which one do you want to keep?\", try \"here's what I suggest, okay to go ahead?\"\n\nAsking a question is fine when you genuinely can't decide without their input. It's not fine when it's really you avoiding the decision.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Hi Marge! Photoshoots are hard to reschedule, so I've asked the supplier to move the call to 10am Thursday (they had it free) and kept the shoot at 2pm. Okay to confirm?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "No worries Marge! I've moved the supplier call to 10am and confirmed it with them. All sorted, enjoy your day!",
                    'is_correct' => false,
                    'diagnostic' => 'You changed a booking and told the supplier before Marge had a chance to approve it.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-confirm-before-acting',
                        'title' => 'Decide, then confirm before you commit',
                        'body' => "Doing the thinking for the client is good. Acting on the outside world before they've approved it is a different thing, whether that's moving a meeting or emailing a supplier.\n\nUntil you know a client's preferences well, propose the change and get a quick yes first. The cost of waiting ten minutes for approval is tiny. The cost of unwinding a change you made to someone else's calendar, and explaining why, is not.\n\nAs trust builds, clients will tell you which decisions you can just make. Early on, propose then confirm.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Got it Marge, I see the double-booking! I'll sort it out for you. 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You promised to handle it but gave her no plan and nothing to approve, so she still has to wonder what will happen.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-vague-reassurance',
                        'title' => '“I’ll sort it out” isn’t a plan',
                        'body' => "\"I'll handle it\" sounds helpful, but it leaves the client with an open loop: handle it how? Moving which meeting? By when? She can't relax because she doesn't know what you're about to do in her name.\n\nA good update names the specific action and invites a quick yes: \"I'll move X to Y, okay?\" That closes the loop. She reads one line, taps approve, and it's genuinely off her plate.\n\nReassurance without specifics is just asking the client to trust and wait. Specifics let them actually let go.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Oh no, I just remembered the supplier said last week they can ONLY do afternoons, they're at the mill every morning. So 10am won't work for them. What now? 😬",
            'scaffold_hint' => "The easy path is to bounce it back to her. Instead: what's the next-best concrete option? The photoshoot involves a hired photographer and models; the supplier call is just a call.",
            'tagalog_tip' => 'May bagong info na pumasok, pero wag mo agad ibalik sa kanya ang buong problema. Isipin mo kung alin ang mas madaling i-move base sa kung sino-sino ang apektado.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Ah, good catch. Since the shoot has a photographer and models booked, I'd keep it at 2pm and ask the supplier for 4pm Thursday instead, still their afternoon. Want me to propose 4pm to them?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "Hmm, that's tricky. What would you like to do, keep the shoot or the call?",
                    'is_correct' => false,
                    'diagnostic' => 'A new constraint appeared and you immediately handed the whole problem back instead of adjusting your proposal.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-adapt-dont-surrender',
                        'title' => 'When a new fact lands, adjust the plan',
                        'body' => "When a plan hits a snag, it's tempting to throw it back to the client: \"okay, you decide.\" But a snag rarely changes the whole picture. It usually just rules out one option.\n\nYou already know the useful facts here: the shoot has other people booked around it, the call is just a call, and the supplier needs an afternoon. That's enough to form a new suggestion. Adjust the proposal and bring that back instead.\n\nClients notice the VA who rolls with a complication versus the one who freezes and asks them to solve it.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "No problem, I'll just move the photoshoot to Friday so the supplier can have 2pm Thursday.",
                    'is_correct' => false,
                    'diagnostic' => 'You solved it by moving the harder, multi-person booking, which creates more disruption than moving the single call.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-move-the-cheaper-thing',
                        'title' => 'Move the thing that’s cheapest to move',
                        'body' => "When two things clash, ask which one costs more to move, counting people and knock-on effects rather than money.\n\nA supplier call is one person and one reschedule. A photoshoot is a hired photographer, models, maybe a location, all coordinated for one time. Moving the shoot means re-coordinating everyone and possibly paying for it.\n\nDefault to moving the booking with the fewest moving parts. It causes the least disruption and the fewest new problems for you to chase.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Okay, I'll tell the supplier they need to make the morning work this one time since you're busy in the afternoon.",
                    'is_correct' => false,
                    'diagnostic' => 'You tried to push a firm external constraint onto the supplier, which risks the relationship over a problem you can solve another way.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-respect-others-constraints',
                        'title' => 'Don’t spend the client’s goodwill to save yourself a step',
                        'body' => "The supplier told you plainly: mornings don't work, they're at the mill. Leaning on them to \"make it work this once\" spends Marge's goodwill with a partner she depends on, just to avoid the small effort of finding another slot.\n\nWhen someone gives you a real constraint, treat it as fixed and route around it. There's almost always another afternoon slot. Protect the client's outside relationships as carefully as you'd protect your own.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => '4pm works, they just confirmed with me directly. Thank you!! You saved my Thursday 🙌',
            'scaffold_hint' => "It's resolved, but 'done' includes making the calendar match reality so this doesn't resurface. Keep the closing note short.",
            'tagalog_tip' => 'Ayos na, pero tandaan na hindi pa talaga tapos hangga\'t hindi tumutugma ang calendar sa totoong nangyari. Isipin mo kung ano ang dapat ma-update para hindi na ito maulit.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "So glad! I've updated your calendar: photoshoot 2pm, supplier call 4pm Thursday. You're all set 🎉",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "You're welcome! 😊",
                    'is_correct' => false,
                    'diagnostic' => 'You closed warmly but never updated the calendar, so the same clash is still sitting there waiting to happen again.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-close-the-loop-in-the-system',
                        'title' => 'The job isn’t done until the system says so',
                        'body' => "It feels finished once the client says thanks. But the calendar still shows both events at 2pm. If you don't update it, the wrong version is what everyone sees next week, and the problem comes back with your name on it.\n\n\"Done\" for a VA means the underlying system reflects reality, not just that the conversation ended nicely. Update whatever holds the source of truth, like the calendar or the tracker, before you sign off.\n\nThen a one-line confirmation of what you changed closes the loop for the client.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'Happy to help! By the way, to avoid this in future I think you should really block your calendar more carefully and always check with me before booking anything yourself. Just some feedback! 🙂',
                    'is_correct' => false,
                    'diagnostic' => 'You turned a win into unsolicited criticism of the client on day three, which reads as lecturing rather than helping.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-dont-lecture-the-client',
                        'title' => 'Win the moment; don’t lecture',
                        'body' => "You may have spotted a habit that causes these clashes. That's valuable, but a thank-you message is the wrong moment to hand the client a to-do list about their own behaviour, especially early on.\n\nIf a process would genuinely help, offer to own it: \"Want me to keep your calendar so double-bookings can't happen? I can check anything before it's added.\" That's you taking work away, not assigning it.\n\nSame insight, opposite feel: one makes you the person who fixes things, the other makes you the person who scolds.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "No problem! I've updated the calendar and also went ahead and moved your Friday morning meetings to the afternoon so your mornings are always free now.",
                    'is_correct' => false,
                    'diagnostic' => 'You made extra changes she never asked for, so now she has to check and possibly undo work you did on your own initiative.',
                    'lesson' => [
                        'slug' => 'calendar-conflict-stay-in-scope',
                        'title' => 'Stick to what was actually asked',
                        'body' => "Momentum is dangerous. You solved the 2pm clash well, so rearranging her whole Friday feels like more helpfulness. To the client it's the opposite: changes she didn't request, to meetings that may have been deliberate, that she now has to review.\n\nStay inside the task you were given. If you spot something else worth doing, name it and ask rather than just doing it. Unrequested changes create work and erode trust, even when your intentions are good.",
                    ],
                ],
            ],
        ],
    ],
];
