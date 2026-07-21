<?php

/*
 * QUALITY BAR: every wrong option must satisfy all five:
 *  1. Plausible: a real beginner could genuinely pick it.
 *  2. Distinctly wrong: fails for a DIFFERENT reason than the other wrongs.
 *  3. Diagnostic is ONE defensible sentence a working VA would agree with.
 *  4. Exactly one is_correct === true per beat.
 *  5. Lesson teaches the principle, not the answer; fits one screen.
 *
 * INTRO TASK: a friendly VA mentor orients a total beginner. The "client_message"
 * is the mentor talking, and the options are how the learner thinks about VA work.
 * Goal is orientation, not client-reply skill, so keep it warm and myth-busting.
 */

return [
    'slug' => 'what-is-va-work',
    'order' => 1,
    'title' => 'So, what is VA work?',
    'client_persona' => 'Kuya Ben, a Filipino VA who has been doing this for 6 years and now mentors newbies',
    'scenario_intro' => "Before your first real client task, Kuya Ben wants to make sure you actually get what this work is. He messages you to talk it through, no pressure, just checking how you're thinking about it.",
    'xp_reward' => 50,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'is_intro' => true,
    'category' => 'intro',
    'ai_grading_enabled' => false,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Kumusta! Before anything else, let me ask you: in your own head, what do you think a virtual assistant actually does? No wrong feelings here, I just want to see where you're starting from. 😊",
            'scaffold_hint' => "A VA does real, ordinary work for a business owner, just remotely. It's not one magic skill and it's not answering phones on a headset. Pick the view that's closest to the truth.",
            'tagalog_tip' => 'Ang VA ay parang katuwang ng isang negosyante, ginagawa mo online yung mga gawaing wala siyang oras gawin. Hindi ito iisang skill lang, at hindi rin ito basta call center.',
            'options' => [
                [
                    'order' => 3,
                    'body' => 'A VA helps a business owner with everyday work, like email, scheduling, admin, or social media, done remotely so the owner can focus on bigger things.',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => 'A VA is basically a call center agent, you sit on the phone all day answering customer calls with a headset.',
                    'is_correct' => false,
                    'diagnostic' => 'That describes a BPO call center seat, but most VA work is behind-the-scenes support for one client, not phone queues.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-not-a-call-center',
                        'title' => 'A VA is not a call center agent',
                        'body' => "It's an easy mix-up because both are remote and both serve foreign clients. But a call center agent usually works for a big company, on phones, in shifts, handling a queue of strangers.\n\nA virtual assistant usually works directly for one business owner or a small team, doing the everyday tasks that keep the business moving: sorting the inbox, booking meetings, updating spreadsheets, scheduling posts. Some VA roles include calls, but the heart of the job is trusted support, not call volume.\n\nSeeing the difference matters because it changes what you practice. You're training to be someone's reliable right hand, not a voice on a hotline.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "A VA is an expert who already knows how to do everything, so you should only start once you've mastered every tool a client might use.",
                    'is_correct' => false,
                    'diagnostic' => 'That sets an impossible bar, VAs learn most tools on the job, and no one masters everything before starting.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-not-an-expert-first',
                        'title' => 'You don\'t need to know everything first',
                        'body' => "If VA work meant mastering every app before day one, nobody would ever begin. That's not how it works.\n\nClients don't hire a VA to be a walking encyclopedia. They hire someone reliable who can figure things out, follow instructions, and pick up a new tool when the task needs it. Most working VAs learn Trello, Canva, or a client's booking system by using it, not by studying it for months first.\n\nStarting from \"I can learn this\" is the real entry point. The skill that matters most isn't knowing every tool, it's being dependable while you learn the ones in front of you.",
                    ],
                ],
                [
                    'order' => 1,
                    'body' => 'A VA does one single specialized task forever, like only designing logos, and never touches anything else.',
                    'is_correct' => false,
                    'diagnostic' => 'That describes a narrow freelancer, but most VAs handle a mix of everyday support tasks, not one locked specialty.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-not-one-narrow-task',
                        'title' => 'VA work is a mix, not one locked task',
                        'body' => "A logo designer or a pure copywriter sells one narrow deliverable. A VA is broader than that on purpose.\n\nOn a normal week a VA might clear an inbox, schedule three meetings, tidy a spreadsheet, draft a couple of replies, and queue some social posts. The value is being a flexible extra pair of hands, someone the owner can hand a range of everyday things to.\n\nYou can absolutely grow a specialty later (many VAs do, and it pays more). But at the start, being useful across ordinary tasks is exactly what makes you hireable.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Good, you've got the shape of it. Next thing people get confused about: WHERE does a VA work, and who do they work for? How would you describe the setup? 🌏",
            'scaffold_hint' => "The whole point of \"virtual\" is remote, you work from home for a client who's often in another country and timezone. Pick the description that matches that reality.",
            'tagalog_tip' => 'Ang trabaho ay remote, galing sa bahay mo, para sa isang client na kadalasan nasa ibang bansa at ibang oras. Yan yung ibig sabihin ng "virtual".',
            'options' => [
                [
                    'order' => 1,
                    'body' => 'I work from home online, usually for a client abroad (US, Australia, UK), and part of the job is matching some of my hours to their timezone.',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "I'd need to relocate abroad or physically go to the client's office at some point for it to count as a real job.",
                    'is_correct' => false,
                    'diagnostic' => 'The entire point of virtual work is that you stay home, no relocation or office visit is required.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-stay-home',
                        'title' => 'Virtual means you stay right here',
                        'body' => "Some beginners assume a \"real\" remote job eventually pulls you abroad. It doesn't. Filipino VAs work for clients in the US, Australia, the UK and beyond without ever leaving their own homes.\n\nYour office is your laptop and a stable connection. The client might be twelve timezones away and you'll likely never meet in person. That's not a downgrade, it's the whole design, and it's why this path is open to people all over the Philippines, not just in the big cities.\n\nSo don't wait to 'go somewhere' to begin. The job comes to your desk.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Timezones don't matter at all, I can work whatever random hours I want and the client will never need any overlap with me.",
                    'is_correct' => false,
                    'diagnostic' => 'Many tasks are flexible, but clients usually need some overlap with their hours, so timezone isn\'t irrelevant.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-timezone-overlap',
                        'title' => 'Some timezone overlap usually matters',
                        'body' => "It's true a lot of VA work is asynchronous, you finish tasks on your own schedule and the client reads them later. That flexibility is real and it's one of the perks.\n\nBut most clients still want a few overlapping hours so they can hand off work, answer a quick question, or hop on a short call. For a US client that often means some evening or early-morning hours on your side. It doesn't have to be their full workday, just a dependable window.\n\nKnowing this upfront helps you set honest expectations. \"I can overlap X hours with your timezone\" is a normal, professional thing to agree on.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "\"Virtual\" just means I use a computer, but I'd still be working for a local Filipino employer in a normal office setup.",
                    'is_correct' => false,
                    'diagnostic' => 'Using a computer isn\'t what makes it VA work, the defining trait is working remotely, typically for a client elsewhere.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-remote-defines-it',
                        'title' => 'Remote is the defining trait',
                        'body' => "Almost every modern job uses a computer, so that alone can't be what \"virtual\" means. The defining feature of VA work is that it's done remotely, you and the client are not in the same room, often not even the same country.\n\nThat's what unlocks the opportunity: instead of competing only for local salaries, you can earn from clients in higher-paying markets while living at home. The remote setup isn't a small detail, it's the entire reason this work exists and why it can pay what it does.\n\nHold onto that mental model: remote-first, client-elsewhere. Everything else about the job flows from it.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Last one, and this is about US, this program. How do you think you'll actually get good at this here? I want to set your expectations right before you dive in. 💪",
            'scaffold_hint' => "This program teaches by putting you in realistic client situations and letting you decide, then learn from the feedback. It's practice, not lectures, and getting things wrong is part of it.",
            'tagalog_tip' => 'Dito, matututo ka sa paggawa, hindi sa panonood lang. Ilalagay ka sa totoong sitwasyon, pipili ka, at matututo ka sa feedback. Normal lang ang magkamali habang nag-aaral.',
            'options' => [
                [
                    'order' => 2,
                    'body' => "By practicing on realistic client scenarios, making a call, and learning from the feedback when I'm wrong, so the thinking becomes second nature before real clients.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 1,
                    'body' => "By watching and reading everything first, then only trying a decision once I'm completely sure I'll never get one wrong.",
                    'is_correct' => false,
                    'diagnostic' => 'Waiting until you can\'t fail means never practicing, the wrong answers here are where the learning actually happens.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-learn-by-doing',
                        'title' => 'Getting it wrong here is the point',
                        'body' => "Reading and watching feel safe, but they don't build judgment. You can watch a hundred videos about handling a messy request and still freeze when a real one lands.\n\nThis program is built the opposite way. It drops you into a situation, asks you to choose, and then shows you why a choice worked or didn't. The mistakes are free here, no client is upset, no income is lost, so this is exactly the place to make them.\n\nAim to engage, not to be perfect. Every wrong pick with a clear explanation is worth more than another hour of passive watching.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "By collecting as many certificates and badges as possible, since clients only care about how many courses I've finished.",
                    'is_correct' => false,
                    'diagnostic' => 'Clients hire for demonstrated judgment and reliability, not a stack of certificates, so chasing badges misses the point.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-not-certificate-chasing',
                        'title' => 'Clients hire proof, not badge counts',
                        'body' => "It's tempting to think the path is to rack up certificates until someone has to hire you. But most clients barely glance at a list of courses.\n\nWhat convinces a client is evidence you can actually do the work: a clear sample, a confident answer to \"how would you handle this,\" a track record of being reliable. That's why this program focuses on how you think and decide, not on printing certificates.\n\nUse the practice to build real judgment you can show. That's the thing that turns into an actual client, a badge on its own rarely does.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => 'By rushing through as fast as possible to finish everything today, since speed is the only thing that matters.',
                    'is_correct' => false,
                    'diagnostic' => 'Blazing through without absorbing the feedback skips the whole point, understanding beats a fast finish here.',
                    'lesson' => [
                        'slug' => 'what-is-va-work-dont-rush',
                        'title' => 'Understanding beats speed-running',
                        'body' => "There's no prize for finishing the program in a day. If you tap through answers without reading why they're right or wrong, you arrive at the end having learned almost nothing.\n\nThe value is in the pause after each choice, the moment you go \"ah, that's why.\" That reflection is what sticks when a real client hands you a real mess months from now.\n\nGo at a pace where the lessons actually land. Steady and absorbed will make you a better VA than fast and empty every single time.",
                    ],
                ],
            ],
        ],
    ],
];
