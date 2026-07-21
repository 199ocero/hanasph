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
    'slug' => 'choosing-ai-tools',
    'order' => 10,
    'title' => 'Which tools do I actually need?',
    'client_persona' => 'Rina runs a home-based bakery and is figuring out what to pay for',
    'scenario_intro' => "Rina bakes from home and sells through her social pages. She's heard AI can help but feels lost about what to actually subscribe to, and her budget is tight. She's trusting you to point her to what she really needs, without upselling her the whole store.",
    'xp_reward' => 125,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'ai',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "There are SO many AI tools out there and everyone's pushing a different one 😅 what do I actually need to pay for? Honestly I mostly just need help writing my customer emails and making simple graphics for my posts. Small budget, so I don't want to waste money.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Maliit lang ang budget ni Rina at dalawa lang naman talaga ang kailangan niya: emails at simpleng graphics. Wag mo siyang dagdagan ng tools na hindi naman niya gagamitin, isipin mo kung ano yung talagang bagay sa need niya.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Okay! To do this properly you'll want a writing AI, a separate email-marketing platform, a design suite, a social scheduler, an SEO tool, and an analytics dashboard. I'll send you the sign-up links for all six.",
                    'is_correct' => false,
                    'diagnostic' => 'You listed six paid subscriptions for a two-line need, which overwhelms Rina and burns a budget she told you was tight.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-match-the-need-not-the-catalog',
                        'title' => 'Solve the need in front of you, not the whole industry',
                        'body' => "When a client asks what to buy, it's tempting to prove your expertise by naming every tool a 'real' operation might use. To a small client with a tight budget, that isn't expertise. It's just overwhelm and wasted money on things they won't touch.\n\nStart from what they actually said: emails and simple graphics. Recommend the fewest tools that cover exactly that, and stop there. You're spending their money for them, so spend it like it's your own.\n\nMore tools isn't more value. The right recommendation is the smallest one that does the job, with room to add later.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Good news, you don't need much. One solid general-purpose AI assistant will handle drafting your customer emails (and plenty more later), and one beginner-friendly design tool covers the simple graphics. That's it for now. If a specific new need pops up down the line, we add one tool for it then.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Honestly, don't pay for any AI. Just send me the emails and post ideas and I'll write them and make the graphics by hand myself. Simpler that way.",
                    'is_correct' => false,
                    'diagnostic' => 'You steered her away from the AI-powered help she specifically asked for, quietly turning her request into more manual work.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-dont-refuse-the-tool',
                        'title' => 'Don’t talk the client out of what they asked for',
                        'body' => "Some VAs, unsure of tools, default to \"I'll just do it by hand.\" That can feel safe, but here the client explicitly wants AI-powered help. Quietly routing around that isn't serving her. It's just substituting your comfort zone for her actual request.\n\nDoing everything manually also doesn't scale. It makes you the bottleneck and gives her none of the speed she was hoping for. The point of the tools is that the work gets faster and she isn't paying for hours you could avoid.\n\nMeet the stated need. If a simple tool does the job well, recommend it. Don't decline the tool just because doing it by hand is more familiar to you.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Perfect! I'd get you an AI video-generation subscription. It's the most powerful AI out right now and everyone's using it, so it's the best value for your money.",
                    'is_correct' => false,
                    'diagnostic' => 'You recommended a video tool for a client whose stated jobs are writing emails and making simple graphics, which is the wrong category entirely.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-right-tool-for-the-job',
                        'title' => 'Match the tool to the job, not to the hype',
                        'body' => "\"Most powerful\" and \"everyone's using it\" are not the same as \"right for this job.\" A video generator is impressive and completely useless for drafting emails and simple post graphics. Popularity is a poor substitute for fit.\n\nWork backwards from the task. Writing needs a writing or assistant tool. Simple graphics need a basic design tool. The job names the category, and you pick the tool inside that category rather than the flashiest tool from a different one.\n\nA client can't always tell whether a recommendation fits, and that's exactly why they asked you. Recommending an ill-fitting tool wastes their money and quietly spends the trust they placed in your judgment.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Okay that's a relief! Quick follow-up: the writing tool has a ₱1,500/month Pro plan with all the fancy features. Should I just get that one to be safe? I don't want to pick the cheap one and regret it.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Takot lang mag-regret si Rina kaya gusto niya agad yung Pro plan. Isipin mo kung gaano niya kadalas gagamitin ito, tapos i-match yung plan doon sa totoong usage niya, hindi sa takot.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Yes, go for the Pro plan. More features is always better and you'll grow into it eventually. Best to future-proof now.",
                    'is_correct' => false,
                    'diagnostic' => 'You pushed the priciest plan on a light user by promising she’ll "grow into" features she has no use for today.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-pay-for-use-not-someday',
                        'title' => '“You’ll grow into it” is how budgets leak',
                        'body' => "\"More features is always better\" sounds safe but it's how small businesses quietly overspend. Features you don't use aren't insurance. They're just a monthly charge for nothing. And \"you'll grow into it\" often means paying for a year before you touch a single Pro feature, if ever.\n\nMatch the plan to her actual usage right now. For drafting a handful of emails, the free or entry tier is almost always plenty. Upgrading later takes about two minutes the day a real limit actually bites.\n\nProtect the client's money like it's your own. The right plan is the smallest one that comfortably covers what she's doing now.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Never pay for these, free plans only, always. Paying for AI is a waste, there's a free version of everything if you look hard enough.",
                    'is_correct' => false,
                    'diagnostic' => 'You made "free only" an absolute rule instead of weighing whether a small paid tier would actually serve her better.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-no-blanket-rules',
                        'title' => 'Cheapest-always is just as lazy as priciest-always',
                        'body' => "Reflexively refusing to ever pay feels frugal, but it's the same mistake as always buying the top plan. Both are a blanket rule standing in for actual judgment. Sometimes a small paid tier genuinely removes a real limit and is worth every peso.\n\nThe honest answer isn't \"never pay\" or \"always pay.\" It's \"here's what your usage needs, and here's the cheapest plan that meets it.\" That might be free today and a low tier next month.\n\nDecide from her real usage rather than from a slogan. Being trusted with a client's money means weighing each call, not applying one rule to everything.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Leave it with me. I'll pick the plan and just put it on your card so it's all sorted and you don't have to deal with it.",
                    'is_correct' => false,
                    'diagnostic' => 'You moved to charge a recurring subscription to her card without getting her okay on the plan or the spend first.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-get-approval-before-spending',
                        'title' => 'Recommend the spend; let the client approve it',
                        'body' => "Taking work off a client's plate is good. Committing their money without a clear yes is a different thing. Signing them up for a recurring charge, even a small and sensible one, is a decision that belongs to them until they've said otherwise.\n\nThe move is to recommend clearly and let them approve. Something like: \"The free tier covers you for now. Want me to set it up, or would you rather do the sign-up yourself?\" That's fast, respectful, and no surprise line lands on their statement.\n\nEarly on especially, propose the spend and then confirm anything involving their card. The few seconds it takes to get a yes protects the trust the whole relationship runs on.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "For how you'll use it, just a few emails a week, the free tier is genuinely plenty, so skip the Pro plan for now. The moment you hit a limit that actually slows you down, we upgrade in two minutes. No point paying ₱1,500 for features you won't touch yet.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "That makes sense, thank you! One more thing: my cousin's business uses this pricey all-in-one AI suite and she swears I'm losing customers by not having it 😩 should I just switch everything over to that?",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Na-FOMO lang si Rina dahil sa cousin niya, pero gumagana naman yung current setup niya. Isipin mo kung talagang may kulang ba sa need niya, o presyur lang ba ito ng comparison sa iba.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "The two simple tools already cover exactly what you do today, which is emails and graphics, and switching to the all-in-one just adds cost and a learning curve for the same result. If a specific new need shows up later (say you start doing videos), we add one tool for that then. You're not falling behind.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "She's probably right, you don't want to fall behind. Let's switch everything over to the all-in-one suite so you've got what the bigger businesses have.",
                    'is_correct' => false,
                    'diagnostic' => 'You let a relative’s comparison push Rina into dumping a working, affordable setup for an expensive one that does the same job.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-need-over-fomo',
                        'title' => 'Someone else’s setup isn’t your client’s need',
                        'body' => "\"Everyone else has it\" and \"you're falling behind\" are feelings rather than requirements. A cousin's bigger business has different jobs to do, so copying her tools doesn't serve Rina. It just costs more to accomplish what she's already accomplishing.\n\nAnchor the decision to the client's actual work. If the current setup does that work well, switching tools adds cost, a learning curve, and disruption for no new outcome. That isn't falling behind. That's paying to stand still.\n\nYour job is to keep the client's spending tied to their real needs, even when someone in their life is nudging them toward more. Reassure her first, then bring the conversation back to the actual job.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'Ignore your cousin. Those expensive all-in-one suites are basically a scam and anyone who buys them is getting ripped off.',
                    'is_correct' => false,
                    'diagnostic' => 'You dismissed the other tool as a "scam" outright, which is both untrue and closes off ever reassessing if her needs change.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-dont-trash-alternatives',
                        'title' => 'Say “not for you yet,” not “that’s a scam”',
                        'body' => "The all-in-one suite isn't a scam. It's a real tool that fits bigger operations with more to manage. Calling it worthless is inaccurate, and it paints you as someone who trashes anything you're not recommending, which makes your advice harder to trust.\n\nThe measured line is \"it's a fine tool, just more than your work needs right now.\" That leaves the door open. If her business grows into those needs, revisiting it becomes a sensible next step rather than a reversal of something you swore was a rip-off.\n\nRecommend based on fit. Knocking the alternatives only makes you look biased, while the measured approach keeps your judgment credible and your options open.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Tell you what, let's keep your two current tools AND add the all-in-one suite, just to be safe and make sure nothing's missing.",
                    'is_correct' => false,
                    'diagnostic' => 'You stacked a second overlapping subscription on top of a setup that already did the whole job, doubling her spend for nothing.',
                    'lesson' => [
                        'slug' => 'choosing-ai-tools-dont-double-up',
                        'title' => 'Two tools for one job is one tool too many',
                        'body' => "\"To be safe\" often becomes \"pay twice for the same thing.\" If the two simple tools already cover emails and graphics, bolting on an all-in-one suite that also does emails and graphics is pure overlap. You double the cost and now have two places to learn and maintain.\n\nRedundancy isn't safety here. It's just waste and confusion. The safe move is one tool per job, not a spare tool duplicating what the first one already handles.\n\nWhen a setup already meets the need, adding more doesn't reduce risk. It just spends money to feel thorough. Keep it lean and let the results prove it's working, not the size of the stack.",
                    ],
                ],
            ],
        ],
    ],
];
