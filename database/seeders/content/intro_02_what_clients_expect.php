<?php

/*
 * QUALITY BAR: every wrong option must satisfy all five:
 *  1. Plausible: a real beginner could genuinely pick it.
 *  2. Distinctly wrong: fails for a DIFFERENT reason than the other wrongs.
 *  3. Diagnostic is ONE defensible sentence a working VA would agree with.
 *  4. Exactly one is_correct === true per beat.
 *  5. Lesson teaches the principle, not the answer; fits one screen.
 *
 * INTRO TASK: the mentor explains what clients actually value in a VA.
 * Orientation, not a live client reply, keep it about mindset and expectations.
 */

return [
    'slug' => 'what-clients-expect',
    'order' => 2,
    'title' => 'What clients actually want',
    'client_persona' => 'Kuya Ben, a Filipino VA mentor who has worked with dozens of foreign clients',
    'scenario_intro' => 'Beginners often think clients want a genius. Kuya Ben has hired and been hired plenty of times, and he wants to tell you what actually makes a client keep a VA around.',
    'xp_reward' => 50,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'is_intro' => true,
    'category' => 'intro',
    'ai_grading_enabled' => false,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Real talk: when a client decides whether to keep a VA, what do you think matters most to them? Skills? Talent? Something else? What's your gut say? 🤔",
            'scaffold_hint' => "Clients can teach skills. What they can't easily fix is someone unreliable. Reliability and clear communication usually beat raw talent. Pick the answer that reflects that.",
            'tagalog_tip' => 'Kaya turuan ng client ang skills. Ang hirap palitan ay ang taong hindi maaasahan. Kadalasan, mas mahalaga ang pagiging reliable at malinaw kaysa sa sobrang talino.',
            'options' => [
                [
                    'order' => 4,
                    'body' => 'Being reliable and easy to communicate with, someone who does what they said they would, on time, and keeps the client in the loop.',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Being the most talented person they could find, if I'm not naturally gifted, there's no point competing.",
                    'is_correct' => false,
                    'diagnostic' => 'Clients rarely need a genius, they need someone dependable, so raw talent is not the deciding factor.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-not-raw-talent',
                        'title' => 'Reliable beats brilliant',
                        'body' => "It's a comforting myth that clients are hunting for the most gifted person alive. In reality, most VA tasks don't need brilliance, they need someone who reliably gets them done.\n\nA dazzling VA who goes quiet for two days, misses a deadline, or has to be chased is exhausting to work with. A steady VA who says \"done, here it is\" every time is a client's dream, even if they're not a prodigy.\n\nThis is great news for a beginner: you don't have to be exceptional to win. You have to be dependable. That's a choice, not a talent.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => 'Charging the absolute lowest price, being cheaper than everyone else is the only way a client will ever pick me.',
                    'is_correct' => false,
                    'diagnostic' => 'Racing to the lowest price attracts the worst clients and undercuts you, dependability is what earns and retains work.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-not-cheapest',
                        'title' => 'Cheapest is not the goal',
                        'body' => "Beginners often think the winning move is to be the cheapest option on the list. But rock-bottom pricing signals \"low value\" and tends to attract clients who are demanding and disloyal, the moment someone cheaper appears, you're gone.\n\nWhat actually keeps a client is trust: you do good, dependable work, so they'd rather keep paying you than gamble on a stranger. That's worth far more than being a few dollars cheaper.\n\nStart at a fair beginner rate, then let reliability raise your value. Competing only on price is a race you don't want to win.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => 'Never bothering them with anything, a good VA figures out everything alone and never asks a single question.',
                    'is_correct' => false,
                    'diagnostic' => 'Total silence isn\'t reliability, clients value the right questions and updates, not a VA who guesses in the dark.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-communication-not-silence',
                        'title' => 'Communication is part of reliable',
                        'body' => "It sounds professional to say \"I'll never disturb the client, I'll handle it all myself.\" But taken too far, silence is its own problem. A VA who never asks and never updates leaves the client anxious and guessing.\n\nReliability includes communication: a quick question when guessing would be costly, a short status update so they know things are moving, a heads-up when something's blocked. That's not bothering them, that's the reassurance they're paying for.\n\nThe goal isn't zero messages. It's the right messages, so the client always feels informed and never has to chase you.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Okay, here's a common beginner trap. A client gives you clear instructions for a task, but you think you know a 'better' way to do it. What's the right move? 📋",
            'scaffold_hint' => "Follow the instruction first, that's what builds trust early. If you have a better idea, offer it as a suggestion, don't silently override what they asked for.",
            'tagalog_tip' => 'Sundin muna ang instruction, doon nabubuo ang tiwala. Kung may mas magandang ideya ka, imungkahi mo, wag mong basta palitan ang gusto nila nang hindi nagpapaalam.',
            'options' => [
                [
                    'order' => 2,
                    'body' => "Do it their way as instructed, then mention my idea afterward: \"Done as you asked, here's it. One thought, we could also try X next time, want me to?\"",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "Quietly do it my 'better' way instead, since my method is smarter and the result is what counts.",
                    'is_correct' => false,
                    'diagnostic' => 'Silently overriding instructions breaks trust, the client asked for a specific thing and got something else without warning.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-dont-silently-override',
                        'title' => 'Don\'t quietly override instructions',
                        'body' => "When you're new, secretly doing it \"your better way\" feels like initiative. To a client, it lands as \"this person doesn't do what I ask.\" Even if your result is good, they now wonder what else you've changed without telling them.\n\nEarly on, following instructions precisely is how you earn trust. The client may have a reason for their method you can't see, a downstream tool, a boss's preference, a past mistake they're avoiding.\n\nOnce you've shown you can follow directions reliably, your suggestions carry weight. Trust first, ideas second.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => "Refuse and lecture them on why their method is wrong before I'll agree to start the task.",
                    'is_correct' => false,
                    'diagnostic' => 'Lecturing a client before doing the work is presumptuous and off-putting, especially from a brand-new VA.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-dont-lecture',
                        'title' => 'Don\'t lecture the person paying you',
                        'body' => "Being sure you know better and saying so at length is a fast way to irritate a client. Nobody hires a VA to be corrected before the task even starts.\n\nThere's a big difference between \"here's a gentle suggestion once I've done what you asked\" and \"let me explain why you're wrong.\" The first is helpful; the second is exhausting and a little arrogant, especially before you've proven anything.\n\nRespect that it's their business and their call. Do the work, then offer ideas lightly. Your good judgment will speak louder than any lecture.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Freeze and do nothing until I've convinced myself which way is truly best, even if that takes all day.",
                    'is_correct' => false,
                    'diagnostic' => 'Stalling on a clear instruction just delays their work, the client already told you what they want done.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-dont-freeze',
                        'title' => 'A clear instruction is not a debate',
                        'body' => "When the client has already given clear instructions, there's nothing to agonize over. Sitting frozen, weighing your way against theirs, just delays the work they're waiting on.\n\nDoubt is only worth surfacing when following the instruction would genuinely cause harm, and even then you ask quickly rather than stall silently. For an ordinary task done a specific way, the move is simple: do it as asked.\n\nOverthinking a settled instruction turns a ten-minute job into a lost afternoon. Trust the direction you were given and get moving.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Last thing, and it's a big one: TRUST. Clients hand VAs access to their inbox, passwords, sometimes money stuff. What makes a VA someone they can trust with all that? 🔑",
            'scaffold_hint' => 'Trust is built by being careful and honest: guard their access, admit mistakes early, and never go outside what you were asked to touch. Pick the answer that shows that.',
            'tagalog_tip' => 'Nabubuo ang tiwala sa pagiging maingat at tapat: ingatan mo ang access nila, aminin agad ang pagkakamali, at wag lumabas sa pinapagawa sa\'yo.',
            'options' => [
                [
                    'order' => 3,
                    'body' => 'Guarding their access carefully, staying within exactly what I was asked to do, and owning up quickly and honestly if I make a mistake.',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 1,
                    'body' => "Hiding any mistake I make so the client never finds out and keeps thinking I'm perfect.",
                    'is_correct' => false,
                    'diagnostic' => 'Hidden mistakes almost always surface later and destroy trust, honesty early is what protects the relationship.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-own-mistakes',
                        'title' => 'Own mistakes, don\'t hide them',
                        'body' => "The instinct to hide a slip-up is human, you don't want to look bad. But hidden mistakes rarely stay hidden. A wrong email goes out, a booking is double-made, and when the client discovers you knew and said nothing, the trust is gone.\n\nA VA who says \"I made a mistake here's what happened and how I'm fixing it\" is far more trustworthy than one who seems flawless. Clients know everyone errs; what they're really testing is whether you're honest when it happens.\n\nOwning a mistake early, with a fix in hand, often builds more trust than never making one at all.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => 'Poking around in their accounts and files beyond my task, just to understand the whole business better.',
                    'is_correct' => false,
                    'diagnostic' => 'Wandering outside your assigned access feels helpful but reads as snooping, and it breaks the boundary you were trusted with.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-stay-in-scope',
                        'title' => 'Stay inside what you were given',
                        'body' => "Curiosity feels harmless, you just want to \"understand the business.\" But when a client gives you access to one inbox or one folder, that's the boundary, and exploring beyond it is a serious breach of trust.\n\nClients hand over sensitive things: emails, passwords, sometimes financial tools. The VAs they keep are the ones who touch only what the task requires and leave everything else alone. Poking around uninvited, even with good intentions, is exactly what makes a client nervous.\n\nRespecting the edges of your access is a quiet way of saying \"you can trust me with the keys.\" That reputation is worth guarding carefully.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Being careless with their passwords, like reusing them or sending them over unsecured chats, since it's faster.",
                    'is_correct' => false,
                    'diagnostic' => 'Sloppy handling of a client\'s credentials risks a real security breach, which is one of the fastest ways to lose a client.',
                    'lesson' => [
                        'slug' => 'what-clients-expect-guard-credentials',
                        'title' => 'Treat their access like it\'s fragile',
                        'body' => "Handling a client's passwords loosely, reusing them, pasting them into random chats, leaving them in plain sight, might save a few seconds, but it puts their whole business at risk.\n\nA single leaked credential can mean a hacked account, stolen data, or lost money, and it will be traced straight back to the VA who was careless. That's often an instant, permanent end to the relationship.\n\nTreat every login they share as fragile and valuable. Use secure methods, don't reuse or expose them, and the client will feel safe handing you more responsibility, which is how a VA grows.",
                    ],
                ],
            ],
        ],
    ],
];
