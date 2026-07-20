<?php

/*
 * QUALITY BAR: every wrong option must satisfy all five:
 *  1. Plausible: a real beginner could genuinely pick it.
 *  2. Distinctly wrong: fails for a DIFFERENT reason than the other wrongs.
 *  3. Diagnostic is ONE defensible sentence a working VA would agree with.
 *  4. Exactly one is_correct === true per beat.
 *  5. Lesson teaches the principle, not the answer; fits one screen.
 *
 * INTRO TASK: the mentor covers the practical requirements and mindset to begin.
 * Orientation, not a live client reply, keep it grounded and myth-busting.
 */

return [
    'slug' => 'getting-started-as-a-va',
    'order' => 3,
    'title' => 'What you need to start',
    'client_persona' => 'Kuya Ben, a Filipino VA mentor who started from zero himself',
    'scenario_intro' => "You're almost ready. Kuya Ben wants to clear up what you actually need to begin, because beginners often worry about the wrong things and miss the ones that matter.",
    'xp_reward' => 50,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'is_intro' => true,
    'category' => 'intro',
    'ai_grading_enabled' => false,
    'beats' => [
        [
            'order' => 1,
            'client_message' => 'First, the setup. People ask me "Kuya, ano bang kailangan kong bilhin?" What do you actually need in place to start doing VA work well? 💻',
            'scaffold_hint' => 'The essentials are practical: a working computer, a stable internet connection, and a quiet-enough space to focus. Not a fancy degree, not expensive gear. Pick the realistic list.',
            'tagalog_tip' => 'Ang kailangan ay praktikal lang: gumaganang computer, matatag na internet, at tahimik na lugar para makapag-focus. Hindi mamahaling gamit o diploma ang unang kailangan.',
            'options' => [
                [
                    'order' => 2,
                    'body' => 'A reliable computer, a stable internet connection, and a quiet enough space to focus, plus the free communication tools clients use.',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => 'A college degree or a formal diploma in something, otherwise no client will take me seriously.',
                    'is_correct' => false,
                    'diagnostic' => 'Most VA clients never ask for a degree, they care about whether you can do the work reliably.',
                    'lesson' => [
                        'slug' => 'getting-started-no-degree-needed',
                        'title' => 'A degree is not a requirement',
                        'body' => "Plenty of successful Filipino VAs have no college degree, and most clients never ask. This isn't a field gated by diplomas, it's gated by whether you can actually help.\n\nWhat a client wants to see is that you're reliable, you communicate clearly, and you can do the tasks. A simple portfolio with a few sample tasks proves that far better than a certificate on a wall.\n\nIf you have a degree, great, it doesn't hurt. But not having one is not a barrier. Don't let \"I'm not qualified enough\" stop you before you've even shown what you can do.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => 'An expensive high-end computer and a paid subscription to every premium software before I can take any client.',
                    'is_correct' => false,
                    'diagnostic' => 'A modest working computer is enough to start, and clients usually provide or pay for the paid tools they need.',
                    'lesson' => [
                        'slug' => 'getting-started-no-expensive-gear',
                        'title' => 'You don\'t need to buy it all first',
                        'body' => "It's easy to believe you must spend big before you can earn, a top-tier laptop, every premium app. You don't. A modest computer that runs a browser smoothly is enough for most VA work.\n\nAs for paid software, clients typically provide access to the tools their business uses, or pay for them, because those are the client's tools, not yours. Buying expensive subscriptions on spec, before you even have a client, is usually wasted money.\n\nStart with what you have. Upgrade later from money you've actually earned. The barrier to entry here is far lower than beginners fear.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => 'Nothing special at all, even a flaky phone-only connection that drops constantly is totally fine for client work.',
                    'is_correct' => false,
                    'diagnostic' => 'You don\'t need fancy gear, but an unreliable connection will fail you on deadlines and calls, so stability genuinely matters.',
                    'lesson' => [
                        'slug' => 'getting-started-stable-connection-matters',
                        'title' => 'Cheap is fine, unreliable is not',
                        'body' => "The gear doesn't need to be fancy, but it does need to be dependable, and that's where a flaky, constantly-dropping connection becomes a real problem.\n\nIf your internet dies in the middle of a client call, or you miss a deadline because you couldn't get online, the client feels it. Reliability is the whole product you're selling, and a shaky connection quietly undermines it.\n\nSo aim for \"stable enough to work and get on a call without dropping,\" even if it's modest. You don't need premium, you need dependable. That distinction is worth taking seriously before you take on paid work.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Now the skill side. Beyond the gear, what's the one ability that opens the most doors with foreign clients, especially at the start? 🗣️",
            'scaffold_hint' => "Being able to communicate clearly in English, in writing especially, is what lets you work smoothly with clients abroad. It doesn't have to be perfect, just clear and understandable.",
            'tagalog_tip' => 'Ang kakayahang makipag-ususing nang malinaw sa English, lalo na sa pagsulat, ang nagbubukas ng maraming pinto. Hindi kailangang perpekto, basta malinaw at maiintindihan.',
            'options' => [
                [
                    'order' => 3,
                    'body' => 'Clear enough English, especially in writing, so I can understand instructions and reply to clients abroad without confusion.',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "A perfect, accent-free American voice, if I don't sound like a native speaker, I shouldn't even try.",
                    'is_correct' => false,
                    'diagnostic' => 'Clients want to be understood, not impressed by an accent, so accent-free perfection is never the requirement.',
                    'lesson' => [
                        'slug' => 'getting-started-accent-not-required',
                        'title' => 'Clear, not accent-free',
                        'body' => "A lot of beginners freeze because they think they need a flawless American accent. They don't. Clients care that they can understand you and that you understand them, not how \"native\" you sound.\n\nFilipinos are among the strongest English speakers in the world, and much of VA communication is written anyway, chat, email, task notes, where accent is irrelevant. Clear, correct, friendly writing carries you a long way.\n\nDon't let accent anxiety stop you. Aim to be understood, not to sound like someone you're not. Understandable beats \"perfect\" every time.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => "Fluency in several foreign languages like Spanish and Mandarin, or I can't compete for international clients.",
                    'is_correct' => false,
                    'diagnostic' => 'The vast majority of VA clients work in English alone, so extra languages are a bonus, never a starting requirement.',
                    'lesson' => [
                        'slug' => 'getting-started-english-is-enough',
                        'title' => 'English alone opens the doors',
                        'body' => "It's a myth that you need a handful of languages to land international clients. The overwhelming majority of VA work, US, UK, Australian clients, happens entirely in English.\n\nExtra languages can be a nice bonus for specific niches, but they are never a requirement to begin. Treating them as a prerequisite just invents a barrier that isn't there.\n\nThe English you likely already have is the key that fits most doors. Focus on making it clear and professional rather than worrying about languages you don't need.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Nothing, communication doesn't really matter as long as I can technically complete the tasks somehow.",
                    'is_correct' => false,
                    'diagnostic' => 'Even flawless task work fails if the client can\'t understand your updates, communication is core to the job, not optional.',
                    'lesson' => [
                        'slug' => 'getting-started-communication-is-core',
                        'title' => 'Communication is the job, not a side skill',
                        'body' => "Thinking \"I'll just do the tasks, talking doesn't matter\" underrates the biggest part of remote work. You and the client never share a room, so words are the entire relationship.\n\nIf they can't understand your update, your question, or your \"this is done,\" then even perfect task work feels unreliable to them. Miscommunication creates rework, confusion, and doubt, the opposite of what they hired you for.\n\nClear communication isn't a bonus on top of the work. It's woven through every task, and it's often what clients remember most about a good VA.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Last one, promise. You've got no client yet and maybe zero experience. What's the right mindset to actually get started from here? 🌱",
            'scaffold_hint' => "Everyone starts at zero. The move is to start where you are: practice, build a small proof of your skills, and take the first opportunity, rather than waiting to feel 'ready enough'.",
            'tagalog_tip' => 'Lahat nagsimula sa wala. Ang tama ay magsimula kung nasaan ka na: mag-practice, gumawa ng maliit na patunay ng skills mo, at kunin ang unang pagkakataon, wag hintaying maging "handa na handa".',
            'options' => [
                [
                    'order' => 4,
                    'body' => "Start where I am: practice the skills, put together a small sample of my work as proof, and apply for that first opportunity even while I'm still learning.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 1,
                    'body' => 'Wait until I feel 100% ready and fearless before I apply for anything, no point starting while I still have doubts.',
                    'is_correct' => false,
                    'diagnostic' => 'The \"fully ready\" feeling rarely arrives, waiting for it usually just means never starting at all.',
                    'lesson' => [
                        'slug' => 'getting-started-dont-wait-for-ready',
                        'title' => 'Ready enough beats perfectly ready',
                        'body' => "Almost every VA who's ever started felt unready. If you wait for the day you feel 100% confident and fearless, that day tends not to come, and months slip by with nothing to show.\n\nConfidence is mostly built by doing, not before it. You take a small step, it goes okay, and you feel a bit more capable for the next one. Waiting on the sidelines skips the very thing that would make you ready.\n\n\"Ready enough to try, willing to learn on the way\" is how real careers start. Don't let the search for perfect readiness quietly become an excuse to never begin.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => 'Apply to hundreds of jobs today with a blank profile and no samples, since volume alone will surely land something.',
                    'is_correct' => false,
                    'diagnostic' => 'Mass-applying with nothing to show gets ignored, a little proof of your skills matters more than raw application count.',
                    'lesson' => [
                        'slug' => 'getting-started-proof-over-volume',
                        'title' => 'A little proof beats blind volume',
                        'body' => "Firing off a hundred applications with an empty profile feels productive, but clients skim right past someone with nothing to show. Volume without proof mostly buys silence.\n\nA small amount of evidence changes everything: one clean sample task, a simple portfolio, a clear \"here's what I can do.\" Even a mock inbox cleanup or a sample scheduling sheet gives a client a reason to say yes.\n\nSpend some of that energy building a little proof first, then apply. A few strong, evidenced applications beat a hundred blank ones nearly every time.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'Pretend I already have years of experience and lie about fake past clients to look more impressive.',
                    'is_correct' => false,
                    'diagnostic' => 'Lying about experience unravels fast on the actual work and destroys trust, honesty about being new works better.',
                    'lesson' => [
                        'slug' => 'getting-started-dont-fake-experience',
                        'title' => 'Being new honestly beats faking it',
                        'body' => "It's tempting to invent past clients and years of experience to look competitive. But fake experience collapses the moment you're on the actual work and can't do what you claimed, and clients can usually sense the gaps quickly.\n\nHonesty is more powerful than beginners expect. \"I'm newer, but here's a sample of my work, I'm reliable and I learn fast\" is credible and refreshing. Plenty of clients happily hire eager beginners at fair rates.\n\nBuild your reputation on things that are true. A real, modest track record grows into a strong one, a fabricated one only waits to fall apart.",
                    ],
                ],
            ],
        ],
    ],
];
