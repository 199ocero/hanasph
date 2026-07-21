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
    'slug' => 'vague-multi-part-request',
    'order' => 20,
    'title' => 'The everything message',
    'client_persona' => 'Nadia, owner of a busy online skincare shop',
    'scenario_intro' => 'Nadia hired you last week and is on her way into an all-day workshop. She fires off one long, half-thinking-out-loud message before she loses signal.',
    'xp_reward' => 200,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'prioritization',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Morning!! Running into a workshop all day so let me braindump before I lose signal 🙈 So the big product launch email needs to go out this week, can you start me a draft? I'll send you the actual launch date and the founder-story bit tonight. Also the reviews page still has that 1-star from the lady who returned her whole order and then admitted she never opened it, can you pull that one down. Oh and the homepage banner STILL says 'Summer Glow Sale' and it's nearly October, plus a customer messaged that checkout froze on her phone right at the payment step. Can you poke at that on mobile and see if it's real? Anyway that's the lot I think, gotta run, you're a star ☕✨",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Ang haba at magulo ng message, so wag kang mag-focus agad sa unang task lang. Basahin mo muna hanggang dulo para makita mo lahat ng hiling niya bago ka sumagot.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "On it! I'll get started on the product launch email draft right away and have something for you to look at soon. 🚀",
                    'is_correct' => false,
                    'diagnostic' => 'You grabbed the first task and replied as if it were the whole message, leaving three other requests unacknowledged.',
                    'lesson' => [
                        'slug' => 'vague-multi-part-request-read-the-whole-message',
                        'title' => 'The first ask is rarely the only ask',
                        'body' => "A long message triggers a reflex: latch onto the first clear task and start moving. It feels responsive. But a braindump usually carries several separate asks, and by answering only the first you've silently signed up to miss the rest.\n\nBefore you reply to a rambling message, read it to the end and count the distinct requests. Treat every 'also', 'oh and', and 'plus' as a flag that another task just started. A message like this one holds four.\n\nSpeed on one task is worthless if it means three others quietly fall through. Slow down for ten seconds to see the whole thing first. That is the actual job.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Got it! Here's what I've picked up: 1) start the launch email draft, 2) remove the returned-customer's 1-star review, 3) update the homepage banner off the Summer sale. I'll get moving on these. Shout if I missed anything!",
                    'is_correct' => false,
                    'diagnostic' => 'You built a clear checklist but dropped the mobile-checkout request that was tucked mid-paragraph, so a real revenue problem goes unlogged.',
                    'lesson' => [
                        'slug' => 'vague-multi-part-request-catch-the-buried-ask',
                        'title' => 'The buried ask is the one that bites',
                        'body' => "Clients don't hand you a tidy list. They tuck a fourth task into the middle of a sentence about a third one, like 'the banner still says Summer, plus a customer said checkout froze.' The eye slides right past it because it's riding on the back of another thought.\n\nThe fix is mechanical: read the message a second time hunting only for verbs the client is asking you to do, like pull, update, check, poke. Each one is a task, wherever it's hiding.\n\nThe buried ask is often the most important, because it's usually the one costing money or trust right now. A frozen checkout is lost sales. Missing it because it wasn't on its own line is what separates a good VA from a reliable one.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Got it all, playing it back so we're aligned: 1) draft the product launch email (I'll start the structure now, but I'll need tonight's launch date + founder story before it's finished), 2) take down the returned-customer's 1-star review, 3) swap the homepage banner off 'Summer Glow Sale', 4) test checkout on mobile at the payment step and report back. That the full list? I'll start on 2, 3 and 4 today. Enjoy the workshop! ✨",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "Hi Nadia! That was a lot in one go and I want to make sure I don't miss anything. When you get a sec, could you send me each task as a separate line so I have it clear? Don't want to get it wrong 🙏",
                    'is_correct' => false,
                    'diagnostic' => 'You handed the sorting work back to the client, which is exactly the mental load she paid you to take off her.',
                    'lesson' => [
                        'slug' => 'vague-multi-part-request-you-do-the-sorting',
                        'title' => 'Do the sorting yourself',
                        'body' => "Asking the client to re-send her message as a clean list feels careful, like you're just making sure you get it right. But look at it from her seat: she braindumped precisely because she's busy, and you've now bounced that work straight back with interest. She has to stop, re-read her own message, and format it for you.\n\nUntangling a messy request is the skill. Your value is turning her scattered thoughts into a structured list, then showing her that list to confirm. That's the opposite of asking her to write it for you.\n\nThere's a real difference between 'help me understand what you need' and 'here's what I understood, did I get it right?' The first offloads work onto the client. The second proves you already did it.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Yep that's everything, you nailed it 🙌 One thing though, the review takedown is the urgent one, she's now leaving comments about it on our Instagram too so it's going a bit public. Launch date + story I'll still send tonight like I said. Thank youuu",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Pansinin mo, may bagong priority na binigay ang client kasi urgent na yung isa. Isipin mo paano mo iaadjust yung plano mo pero hindi mo binibitawan yung ibang tasks na na-commit mo na.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Perfect! I'll work through the list in order, kicking off with the launch email draft structure now and getting to the rest through the day.",
                    'is_correct' => false,
                    'diagnostic' => 'She just told you the review is the urgent, public one, and you kept your original order anyway.',
                    'lesson' => [
                        'slug' => 'vague-multi-part-request-let-priority-reorder-the-list',
                        'title' => 'New priority means new order',
                        'body' => "You confirmed a clean list, and that felt like the hard part was done. So when the client adds 'the review is urgent, it's going public,' it's tempting to keep working your tidy list top-to-bottom and get to the review when you reach it.\n\nBut a checklist isn't sacred. New information about urgency should immediately re-sort it. A public complaint spreading on Instagram is time-sensitive in a way a launch-email draft simply is not, especially one you can't even finish until tonight.\n\nListen for the client quietly ranking things for you: 'that one's urgent,' 'no rush on the last bit,' 'this is the important one.' When they hand you a priority, act on it visibly. Working the old order after being told the new one tells the client you heard the words but missed what they meant.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Understood, bumping the review takedown to first since it's going public. I'm on that now and will confirm the moment it's down. Then the banner and the mobile-checkout check today. Launch email I'll build once tonight's date + story land. Sound right?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Oh no, on it. Removing that review right now, that's my whole focus until it's gone. 🙏",
                    'is_correct' => false,
                    'diagnostic' => 'You let the one urgent item swallow the rest, quietly dropping the three tasks you already committed to.',
                    'lesson' => [
                        'slug' => 'vague-multi-part-request-urgent-isnt-only',
                        'title' => 'Urgent doesn\'t mean only',
                        'body' => "When something becomes urgent, the natural move is to drop everything and pour all your focus onto it. That's great for the urgent thing and quietly terrible for the other three, which now vanish from the conversation with no acknowledgement that they still exist.\n\n'Urgent' re-orders your list. It doesn't delete it. The right response moves the hot item to the front while still naming the rest and when you'll do them, so the client can see nothing was dropped.\n\nThe client's trust comes from knowing every ask is held somewhere safe. If your reply makes it sound like the other tasks evaporated the second one became a priority, she now has to remember them for you, which is the job you were hired to remove.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => 'Got it! Before I start, could you quickly rank the other three for me too? Which of the banner, checkout, and launch email should come next after the review? Want to get the order exactly right.',
                    'is_correct' => false,
                    'diagnostic' => 'She gave you the one priority that mattered; asking her to rank the rest sends easy judgment calls back to her.',
                    'lesson' => [
                        'slug' => 'vague-multi-part-request-dont-over-ask',
                        'title' => 'Don\'t ask what you can reasonably decide',
                        'body' => "Confirming is good. But there's a point where 'just making sure' tips into offloading decisions the client expects you to make yourself. She told you the one thing that was genuinely ambiguous, which is that the review is urgent. The order of the remaining three is not a puzzle only she can solve.\n\nYou can reason it out: the banner and checkout are quick and live on the site now, the launch email is blocked until tonight anyway, so it naturally goes last. That's a judgment call well within your reach, so make it, and state it as your plan she can correct.\n\nEvery unnecessary question costs the client a moment of attention and chips at the sense that you've got this. Reserve your questions for the genuine forks where you truly can't proceed without her. Everything else, propose.",
                    ],
                ],
            ],
        ],
    ],
];
