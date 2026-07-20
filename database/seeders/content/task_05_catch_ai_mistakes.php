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
    'slug' => 'catch-ai-mistakes',
    'order' => 5,
    'title' => 'Before you hit send',
    'client_persona' => 'Deo — runs a small online sportswear shop and loves that you use AI',
    'scenario_intro' => "Deo sells sportswear online and is thrilled you draft customer replies with AI — you're faster than he ever was. But a draft that reads perfectly can still be confidently wrong, and it's your name on what goes out.",
    'xp_reward' => 100,
    'onboarding_entry_key' => 'ai',
    'is_gentle_opener' => false,
    'category' => 'ai',
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Hey! A customer just asked about our returns — can you reply for them? Use your AI thing, you're way faster at this than me 🙌 (reminder: our policy is 7-day returns, exchange or store credit only, no cash refunds). Gotta run, thanks!",
            'scaffold_hint' => "Your AI draft reads great — warm and professional — and it promises a '30-day money-back guarantee with a full cash refund.' Deo just told you the real policy. Read the draft against what you actually know before it leaves.",
            'options' => [
                [
                    'order' => 1,
                    'body' => 'The draft reads so clean and professional — I sent it straight to the customer as-is.',
                    'is_correct' => false,
                    'diagnostic' => 'You sent the AI draft because it sounded polished, so an invented 30-day refund policy is now a promise to a real customer.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-professional-isnt-correct',
                        'title' => 'Sounding right isn’t being right',
                        'body' => "AI is very good at producing text that reads confident, warm, and professional. That fluency is exactly the trap: it makes wrong details feel trustworthy, because nothing in the tone signals a mistake.\n\nBefore anything goes out under your name, check the draft against what you actually know to be true — the client's real policy, the real numbers, the real situation. Read for facts, not for polish.\n\nA smooth sentence promising something the client doesn't offer is worse than a clumsy one that's accurate. The customer only ever sees the promise, not how nice it sounded when you sent it.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Here's the reply — I used AI so maybe double-check the returns part before it goes out 😅",
                    'is_correct' => false,
                    'diagnostic' => 'You sensed something might be off but handed the checking back to Deo instead of just verifying and fixing it yourself.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-dont-outsource-the-check',
                        'title' => 'A hedge is not a check',
                        'body' => "\"The AI wrote this, so please double-check it\" feels honest, but it quietly passes your job back to the person who hired you to take it off their plate. If you already suspect a detail is wrong, you have everything you need to confirm it yourself.\n\nThe whole value of a VA using AI is that a human verifies before it ships. Skipping that and flagging your own doubt out loud just relocates the work — and erodes trust, because the client learns your drafts can't be sent without them re-checking.\n\nIf something feels off, that feeling is the signal to check, not to warn. Verify, fix, then send with confidence.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'Spotted it — the draft had invented a 30-day money-back guarantee. I swapped in your actual policy (7-day returns, exchange or store credit) and sent the reply. All set!',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "I didn't trust the AI draft, so I deleted it and wrote the whole reply from scratch by hand — took me about an hour but it's safe now.",
                    'is_correct' => false,
                    'diagnostic' => 'You threw away a near-perfect draft over one wrong line and spent an hour rewriting what a 30-second edit would have fixed.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-fix-dont-nuke',
                        'title' => 'Fix the one wrong thing, keep the rest',
                        'body' => "When you catch an AI error, the panic reaction is to distrust the whole draft and start over by hand. But usually only one detail is wrong — the structure, tone, and 95% of the content are fine.\n\nThe skill is a surgical fix: find the specific false claim, correct just that, and keep everything the AI got right. That's the speed advantage the client is paying for. Rewriting from zero every time throws that advantage away.\n\nOne wrong fact doesn't make a draft worthless. Treat AI output like a solid first draft from a fast junior: check it, correct the slips, and ship — don't rebuild it from nothing.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => 'Another one 😅 customer wants to know where their order is. Our courier dashboard says: still at our warehouse, gets picked up and shipped TOMORROW morning, then 2-3 days transit. Can you let them know? Thanks!!',
            'scaffold_hint' => "This AI draft sounds reassuring: 'Good news — your order is already on its way and should reach you in 2-3 days!' Nothing in it looks wrong at a glance. Read it against the courier status Deo just gave you.",
            'options' => [
                [
                    'order' => 1,
                    'body' => "Caught it — the draft said the order was 'already on its way,' but it ships tomorrow. I fixed it to: packed and shipping tomorrow morning, then 2-3 days in transit. Sent!",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "The draft's really reassuring and the customer will be happy to hear it's on its way — I sent it as-is.",
                    'is_correct' => false,
                    'diagnostic' => 'You let a nice-sounding message override the facts, so the customer will expect a package that hasn’t even shipped yet.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-reassuring-vs-true',
                        'title' => 'Reassuring and wrong is the worst combination',
                        'body' => "A message that makes the customer happy right now but turns out false doesn't buy goodwill — it borrows it, then charges interest. When the package doesn't arrive as promised, the customer feels misled, and that's far worse than a plainer, accurate update.\n\nThe subtle errors are the dangerous ones. \"Already on its way\" reads fine until you hold it against the source: the order hasn't shipped. AI reaches for the upbeat phrasing; your job is to make sure the upbeat phrasing is actually true.\n\nAccurate beats pleasant every time. You can be warm and honest at once — \"packed and shipping tomorrow\" is friendly and correct.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "To make the draft true, I messaged the warehouse to rush this one out today so it really is 'on its way' like the reply says.",
                    'is_correct' => false,
                    'diagnostic' => 'You changed the business’s operations to fit the AI’s wording instead of fixing the wording to fit reality.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-dont-bend-reality',
                        'title' => 'Fix the draft, not the world',
                        'body' => "When a draft and reality disagree, reality wins. Reorganizing the warehouse's day, pulling staff, or overriding a shipping schedule so an AI sentence becomes true is the tail wagging the dog — and it's a call that isn't yours to make.\n\nAn error in a draft costs one edit. Bending real operations to match a draft costs money, disrupts other orders, and commits the client to something they never approved. The fix is always cheaper on the page than in the world.\n\nCorrect the words to describe what's actually happening. Never rearrange what's actually happening to rescue the words.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => 'Quick check before I reply, Deo — is this order shipping today or tomorrow? Want to get the timing right for the customer.',
                    'is_correct' => false,
                    'diagnostic' => 'You asked Deo for the shipping date he had literally just given you in the same message.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-read-what-you-were-given',
                        'title' => 'The answer was already in front of you',
                        'body' => "Before asking the client for information, check whether they already provided it. Here the courier status — ships tomorrow, 2-3 days transit — was right there in Deo's message. Asking again reads as if you didn't read what he sent.\n\nCatching an AI error doesn't mean you're stuck; often the correct facts are already in the brief, waiting to be pasted over the wrong ones. The check is: does the draft match the info I was given? Not: let me ask for the info again.\n\nQuestions are for genuine gaps. When the answer is in the message you're replying to, using it — not re-requesting it — is what makes you low-maintenance to work with.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Honestly you've caught two mix-ups this week I'd never have spotted 🙏 let's just let the AI reply to customers directly from now on — no need for you to check every one, save yourself the time!",
            'scaffold_hint' => "Deo wants to remove the exact step that caught this week's errors. What kept him safe wasn't the AI — it was a human eye before send. Protect that without lecturing him.",
            'options' => [
                [
                    'order' => 1,
                    'body' => "Sure thing! I'll set the AI to reply to customers automatically so you don't have to think about it. 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You agreed to remove the human check that just caught two confident errors — automating away the very thing keeping his customers safe.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-keep-the-human-in-the-loop',
                        'title' => 'Don’t automate away the check that’s working',
                        'body' => "A client impressed by AI's speed may want to cut the human step entirely. But the reason it's going well is that step — you caught two errors this week precisely because a person looked before send. Remove the check and those errors ship straight to customers.\n\nSaying yes to something you know will backfire isn't being agreeable; it's setting the client up to get burned. Part of your value is knowing where the guardrail belongs and keeping it there.\n\nThe durable principle: AI drafts fast, a human verifies before it's public. That quick check is cheap and catches the expensive mistakes. Don't trade it away for a little more speed.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Honestly, AI just isn't reliable enough — I think I should go back to writing every customer reply by hand from now on to be safe.",
                    'is_correct' => false,
                    'diagnostic' => 'You swung to throwing out a tool that’s saving hours over mistakes a 30-second check already catches — and ignored that Deo loves the speed.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-dont-overcorrect',
                        'title' => 'Two caught errors isn’t a reason to quit the tool',
                        'body' => "Finding mistakes in AI output can tip you the other way — into deciding the tool can't be trusted at all. But the errors were caught and fixed in seconds, and the client is delighted with how fast replies go out now. That's a system working, not failing.\n\nAbandoning AI to do everything by hand throws away real hours to avoid errors a quick review already handles. It also ignores what the client actually wants: AI-powered help, done carefully.\n\nThe answer to imperfect AI is a verifying human, not a return to slow manual work. Keep the speed; keep the check. Don't overcorrect a working setup into a slow one.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "I have to warn you about how risky this is — AI 'hallucinates,' meaning it invents facts that sound true, and there are real cases of businesses getting into trouble over auto-sent AI messages, so before we even consider this you should understand the full risks...",
                    'is_correct' => false,
                    'diagnostic' => 'You buried a simple recommendation in a lecture on AI’s dangers when Deo just wanted a quick, confident answer.',
                    'lesson' => [
                        'slug' => 'catch-ai-mistakes-answer-dont-lecture',
                        'title' => 'Give the recommendation, not the seminar',
                        'body' => "You may know exactly why full auto-send is risky. That doesn't mean the client needs a lecture on AI hallucinations to hear your answer. A wall of warnings makes you sound anxious and hard to work with, even when you're right.\n\nLead with the practical recommendation and a one-line reason. The client can always ask for more; most just want to know what you suggest and why, in a sentence they can act on.\n\nExpertise shows up as a clear, short answer — not as everything you know about the topic, delivered whether they asked for it or not.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Love that it's paying off! Here's the sweet spot: I'll keep letting AI do the heavy lifting and just give each reply a 30-second check before it goes out — that quick look is exactly what caught this week's two. You keep all the speed, none of the risk. Good?",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
    ],
];
