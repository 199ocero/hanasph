<?php

/*
 * QUALITY BAR, every wrong option must satisfy all five:
 *  1. Plausible: a real beginner could genuinely pick it.
 *  2. Distinctly wrong: fails for a DIFFERENT reason than the other wrongs.
 *  3. Diagnostic is ONE defensible sentence a working VA would agree with.
 *  4. Exactly one is_correct === true per beat.
 *  5. Lesson teaches the principle, not the answer; fits one screen.
 */

return [
    'slug' => 'travel-booking',
    'order' => 18,
    'title' => 'Book the trip',
    'client_persona' => 'Ken, a consultant travelling for work',
    'scenario_intro' => 'Ken has an important client meeting in Cebu and asks you to book his flights. He gives you his constraints in one quick message before jumping into a call.',
    'xp_reward' => 150,
    'onboarding_entry_key' => null,
    'category' => 'admin',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Need to be in Cebu for a 2pm meeting on the 15th. Fly out from Manila. I want to land with time to get to the venue and freshen up, not cutting it fine. Budget's around ₱4,000 each way. Can you find flights?",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Bago ka mag-book, balikan mo kung ano talaga yung goal ni Ken, hindi lang yung pinakamurang flight. Ikaw yung mag-fi-filter ng options para hindi na siya mahirapan.',
            'options' => [
                [
                    'order' => 4,
                    'body' => "Found three good options within budget. The 8:40am arrives 10:05am, comfortable buffer before your 2pm, ₱3,850. There's also a cheaper 11:30am flight (₱3,200) but it lands 12:55pm, which is tight for getting to the venue and freshening up. I'd go with the 8:40am. Want me to book it?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "Booked! Grabbed the cheapest one at ₱2,900, it's the 12:55pm arrival, gets you in the same day well before evening. Confirmation's in your inbox 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You optimised for the lowest price and silently broke his stated need for a comfortable buffer before the 2pm meeting.',
                    'lesson' => [
                        'slug' => 'travel-booking-honour-the-real-goal',
                        'title' => 'Cheapest is only best if it meets the goal',
                        'body' => "Beginners often treat \"book flights\" as \"find the lowest price.\" But the client didn't ask for the cheapest seat. He asked to arrive with room to spare before a meeting that's the whole reason for the trip.\n\nEvery booking has a real goal behind it. A ₱600 saving means nothing if he's sprinting from the airport, sweaty and stressed, into a client pitch. The price is a constraint, not the objective.\n\nBefore you optimise for money, be sure you're still hitting the thing that actually matters. Read the request for the outcome the client cares about, and let price compete only among options that already clear that bar.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Perfect timing on the 8:40am, lands 10:05am with a nice buffer, ₱3,850. I've gone ahead and booked it on your card so you're all set. Confirmation attached!",
                    'is_correct' => false,
                    'diagnostic' => 'You picked the right flight but spent his money before he confirmed, committing him to a non-refundable purchase on your own judgment.',
                    'lesson' => [
                        'slug' => 'travel-booking-confirm-before-you-spend',
                        'title' => 'Confirm before you spend their money',
                        'body' => "You may have chosen exactly the flight the client would have picked. That's not the point. Booking a flight means charging his card for something usually non-refundable, an irreversible action taken in his name.\n\nUntil a client explicitly tells you \"just book travel without checking,\" the rule is: propose the specific option, then get a quick yes before you pay. A flight has a date, a fare, and a name on it, small details you'd rather catch before the money's gone, not after.\n\nThe ten minutes you wait for approval costs nothing. Unwinding a wrong booking costs a rebooking fee and the client wondering what else you'll spend on without asking.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => "Sure! I pulled up the flights for the 15th: there's an 8:40am, a 9:15am, an 11:30am, a 12:55pm, a 1:40pm, plus a few with layovers. Prices range from ₱2,900 to ₱5,600. Which one would you like me to book?",
                    'is_correct' => false,
                    'diagnostic' => 'You handed him the full list to sort through instead of doing the filtering he hired you to do.',
                    'lesson' => [
                        'slug' => 'travel-booking-do-the-filtering',
                        'title' => 'Narrow it down, that\'s the job',
                        'body' => "Dumping every flight on the client feels thorough and safe, since you're not deciding for him, just \"giving options.\" But he gave you clear constraints precisely so he wouldn't have to read timetables. Handing them all back is punting the work.\n\nYour value is turning a long list into a short, reasoned recommendation. Filter out everything that breaks his constraints, then present one clear pick (and maybe one alternative) with the reasoning.\n\nOptions are useful in small, curated numbers when there's a genuine tradeoff to decide. A wall of choices isn't a service. It just hands the raw work back to him.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Good call on the 8:40. Oh wait, for the return I need to be back in Manila that same night, the 15th. Last-minute dinner I can't miss. Can you sort the return too?",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Pansinin mo na nag-aaway yung budget at yung timing ng dinner niya. Isipin mo kung paano mo ipapaalam ang conflict nang malinaw imbes na basta ka na lang pumili para sa kanya.',
            'options' => [
                [
                    'order' => 2,
                    'body' => "On it, booked the ₱3,600 return since that's within your budget. It lands 9:45pm, so you'll be back the same night as asked 👍",
                    'is_correct' => false,
                    'diagnostic' => 'Two constraints collided and you quietly picked budget over the dinner, booking a flight that lands too late for the thing he said he can\'t miss.',
                    'lesson' => [
                        'slug' => 'travel-booking-surface-the-conflict',
                        'title' => "When constraints collide, don't pick a winner silently",
                        'body' => "Sometimes the client's requirements can't all be met at once. Here, \"under ₱4,000\" and \"home in time for dinner\" pull against each other, and the beginner instinct is to quietly honour whichever one is easier and hope it's fine.\n\nBut you don't actually know which constraint matters more. Only the client does. Choosing for him, silently, means he discovers the tradeoff when it's too late to change.\n\nWhen constraints conflict, that's exactly the moment to bring the client in. Name the clash plainly and let them make the call. Surfacing a tradeoff isn't failing to solve it. You're solving the part only they can.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => "Quick heads up on the return: the flights that get you home in time for an evening dinner are pricier than your ₱4,000. The 6:30pm lands Manila 8:00pm at ₱5,400, over budget, but it's the realistic option for a dinner that night. There's a ₱3,600 flight, but it's 9:45pm arrival, too late. Happy to book the 6:30pm. Okay to go a bit over budget for the return?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Ah, there's a problem, none of the return flights fit both your budget and your timing. The cheap ones are too late and the on-time ones are over ₱4,000. How do you want to handle this?",
                    'is_correct' => false,
                    'diagnostic' => 'You correctly spotted the conflict but bounced it back wide open instead of framing one clear decision with a recommendation.',
                    'lesson' => [
                        'slug' => 'travel-booking-frame-the-decision',
                        'title' => 'Surface the tradeoff as one crisp choice',
                        'body' => "Noticing the conflict is half the job. But \"how do you want to handle this?\" makes the client do all the thinking, figuring out the options, weighing them, and deciding, when you've already done the research and could hand him a clean decision.\n\nFrame it tightly: here's the tradeoff, here's my recommendation, here's the one thing I need from you. \"The on-time flight is ₱1,400 over budget. Okay to book it, or would you rather stay under budget and shift the dinner?\" That's a yes/no, not a homework assignment.\n\nMake the decision small and specific. The client should be able to answer in five seconds from his phone between meetings.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "No problem, I'll book the 6:30pm return that gets you home by 8pm. It's ₱5,400, a bit over your budget, but timing matters more for the dinner so I went ahead and confirmed it.",
                    'is_correct' => false,
                    'diagnostic' => 'You reasoned well about the tradeoff but then broke his stated budget on his card without asking first.',
                    'lesson' => [
                        'slug' => 'travel-booking-dont-override-a-stated-limit',
                        'title' => "Don't quietly overspend a limit they set",
                        'body' => "Your judgment might be right, since timing probably does beat budget for an unmissable dinner. But the client set a specific number, and going past it without a word means spending more of his money than he authorised, on your assumption about his priorities.\n\nA budget is a boundary the client drew on purpose. Crossing it might be the correct call, but it's his call to make, not yours to make for him. The fix is one quick question, not a silent override.\n\nGood reasoning plus a fast confirmation is the whole move: \"timing matters more here, but it's ₱1,400 over, okay?\" You keep the smart recommendation and still respect the limit he set.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Yeah the dinner's a big deal, go ahead and book the 6:30pm even though it's over. Thanks for flagging it.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Approved na ni Ken kaya i-close mo na nang maayos yung booking. Isipin mo kung anong detalye ang kailangan niyang makita para panatag siya, at wag ka nang gagawa ng bagay na hindi niya hiniling.',
            'options' => [
                [
                    'order' => 2,
                    'body' => "Done, you're all booked. Outbound: 8:40am Manila–Cebu, lands 10:05am (₱3,850). Return: 6:30pm Cebu–Manila, lands 8:00pm (₱5,400). Confirmations are in your inbox. Have a great trip!",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => 'Great, booking it now!',
                    'is_correct' => false,
                    'diagnostic' => 'You confirmed you\'re booking but never closed the loop with the final details, leaving him unsure what was actually purchased.',
                    'lesson' => [
                        'slug' => 'travel-booking-close-with-the-details',
                        'title' => 'End with the confirmed details, not just "done"',
                        'body' => "Once the client approves, it's tempting to fire back a quick \"on it!\" and move on. But he's now trusting that the right flights, at the right times, on the right date, actually got booked, and he has no way to check unless you tell him.\n\nA proper close restates what was booked: both legs, times, dates, and where the confirmation lives. It takes thirty seconds and it lets him verify at a glance and stop thinking about it.\n\nFor anything involving money and dates, the final confirmation is part of the task, not a nicety. \"Done\" is only true once the client can see exactly what \"done\" means.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => "All booked! Both flights confirmed and in your inbox. By the way, since you travel to Cebu a lot, I also went ahead and signed you up for the airline's loyalty program and added your card to their app so it's faster next time.",
                    'is_correct' => false,
                    'diagnostic' => 'You did extra account setup he never asked for, putting his card into a new place without permission.',
                    'lesson' => [
                        'slug' => 'travel-booking-stay-in-scope',
                        'title' => 'Book the trip, not everything around it',
                        'body' => "Finishing the booking well builds momentum, and momentum tempts you into bonus \"helpful\" moves: loyalty sign-ups, saving cards, tweaking preferences. It feels like going the extra mile.\n\nBut the client only authorised this trip. Enrolling him in programs and storing his card somewhere new are decisions about his money and data that he didn't make. Even good ideas need a yes first, especially when they touch payment details.\n\nDeliver exactly what was asked, cleanly. If you spot a genuine improvement, ask about it: \"you fly Cebu often, want me to set up a loyalty account to save on future trips?\" Suggesting is helpful; doing it unasked crosses a line.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Perfect, done! Both flights are booked. Just so you know, I really wasn't comfortable going over the budget you set. I hope that's okay and that you're happy with it.",
                    'is_correct' => false,
                    'diagnostic' => 'He already made the decision himself, so reopening your discomfort about it just adds anxiety to a settled call.',
                    'lesson' => [
                        'slug' => 'travel-booking-let-a-decision-rest',
                        'title' => 'Once they decide, let it rest',
                        'body' => "You flagged the budget tradeoff, the client weighed it and chose. That's the system working perfectly. Circling back to voice your lingering unease reopens a question he already closed, and makes him wonder if he got it wrong.\n\nWhen a client makes an informed decision, your job flips to executing it confidently. Second-guessing it out loud, even framed as honesty, undercuts the very decision you helped him make well.\n\nRaise concerns before the choice, clearly. After the choice, book it and move on. Confidence in execution is part of what makes a client comfortable delegating the next decision to you.",
                    ],
                ],
            ],
        ],
    ],
];
