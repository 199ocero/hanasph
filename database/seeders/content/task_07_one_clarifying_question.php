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
    'slug' => 'one-clarifying-question',
    'order' => 7,
    'title' => 'The one question worth asking',
    'client_persona' => 'Marco — runs a small coffee shop and fires off requests in a hurry',
    'scenario_intro' => 'Marco owns a busy coffee shop and messages between orders, so his asks arrive short and vague. Guess wrong and you build the wrong thing; ask too much and you become one more chore on his day. The skill is knowing the single question worth his time.',
    'xp_reward' => 125,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'comms',
    'beats' => [
        [
            'order' => 1,
            'client_message' => 'Hey can you put together a report for my meeting Thursday? Would help a lot. Thanks!',
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => "On it! I'll pull together a full 10-page financial report with all our sales data, charts, and projections, and have it ready as a printed handout for Thursday.",
                    'is_correct' => false,
                    'diagnostic' => 'You guessed the format, length, and audience from almost nothing and committed to building the whole thing on that guess.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-dont-build-on-a-guess',
                        'title' => 'A confident guess still builds the wrong thing',
                        'body' => "\"A report\" could be a one-page summary for the bank, a slide for two partners, or a quick numbers email — wildly different things. Picking one silently and building it feels decisive, but if you guessed wrong you've spent hours producing something Marco can't use.\n\nInitiative isn't guessing; it's knowing which unknown actually changes the outcome and clearing it before you invest the work. Filling a real gap with an assumption isn't confidence — it's a gamble with your own time.\n\nWhen a genuinely ambiguous detail decides what you build, resolve it first. Effort spent on the wrong target isn't effort the client values.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => 'Sure! Quick questions: What format — PDF, slides, or printed? How many pages? What date range of data? Should I include charts? What font and colours? Do you want a cover page? Portrait or landscape?',
                    'is_correct' => false,
                    'diagnostic' => 'You buried Marco in eight questions, several of which you could reasonably decide yourself, turning your ask into a chore.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-dont-bury-them',
                        'title' => 'Every question you ask is a task you assign',
                        'body' => "A long list of questions feels thorough, but to a busy client it's a to-do list you just handed back. Half of those — fonts, cover page, portrait vs. landscape — are things a competent VA simply decides. Asking them signals you can't move without hand-holding.\n\nReserve questions for what genuinely blocks you and what only the client can answer. Everything you can reasonably choose yourself, choose — and mention your choice, don't request permission for it.\n\nThe goal is the fewest questions that unblock you, not the most complete questionnaire. One sharp question respects the client's time; eight scattered ones spend it.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Happy to help! What exactly do you mean by a report though? Can you explain what you're looking for?",
                    'is_correct' => false,
                    'diagnostic' => 'You threw the whole ambiguity back with a vague “what do you mean,” making Marco do all the thinking you were hired to do.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-do-the-thinking-first',
                        'title' => 'Ask a sharp question, not an open one',
                        'body' => "\"What exactly do you mean?\" dumps the entire problem back on the client. It shows you haven't sorted out what's actually unclear, so now they have to structure the whole request from scratch — the thinking they were paying you to do.\n\nA sharp question proves you've already narrowed things down: \"Who's the meeting with, so I pitch it at the right level?\" That's easy to answer in a word and shows you're most of the way there. A vague one says you haven't started.\n\nDo the analysis first, isolate the one thing you truly can't infer, and ask that. The quality of your question tells the client how much thinking you've already done.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Happy to! One thing so I aim it right: who's the meeting with and what's it deciding — the bank, your business partners, staff? Meanwhile I'll draft it as a one-page summary of last month's numbers, which I can expand if you need more.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Good q! It's for my two business partners — we're deciding whether to open a second branch. So make it convincing.",
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Got it! Before I start — should I use 6 or 12 months of data? PDF or slides? Include charts or just tables? Portrait or landscape?',
                    'is_correct' => false,
                    'diagnostic' => 'Now that you’re unblocked on the thing that mattered, you stalled again over small details you could reasonably decide yourself.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-once-unblocked-move',
                        'title' => 'Once the key question’s answered, go',
                        'body' => "You asked the one question that mattered and got your answer: a decision doc for the partners about a second branch. That's enough to start. Circling back with a fresh list of small choices undoes the good the first question did.\n\nWhichever data range and layout best serve a branch decision — you can judge that. Pick sensibly, note it in a line, and proceed. Re-opening the questions makes you look like you can't act without permission at every step.\n\nThe pattern is: one sharp question to unblock, then momentum. Don't trade the crisp first question for a slow trickle of follow-ups on things you're equipped to decide.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Perfect — a decision doc for the three of you on the second branch. I'll cover the last 6 months of sales and foot-traffic trends since that's what's relevant, and include a short costs-vs-upside section so it actually helps you decide. Draft to you tomorrow morning.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Love it — I'll build the whole report around the new mall location you're eyeing, with the rent and footfall for that specific spot front and centre.",
                    'is_correct' => false,
                    'diagnostic' => 'Marco never named a location, so you filled a genuine, decision-critical gap with an invented specific and built around it.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-know-what-to-assume',
                        'title' => 'Assume the small stuff, never the deciding stuff',
                        'body' => "There's a line between sensible defaults and reckless guesses. Layout and data range are safe to assume — get them slightly off and it's a quick tweak. Which location they're considering is not: it's central to the whole decision, and you invented it.\n\nThe test is: if I'm wrong about this, is it a two-minute fix or a rebuild? Two-minute-fix details you assume and note. Rebuild-if-wrong details you confirm before building on them.\n\nHaving asked one good question doesn't license guessing on the next big unknown. Assume freely on the trivial; verify anything that would sink the work if you got it wrong.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Great — to make sure nothing's missing, I'll pack in every metric we have: full sales history, all supplier costs, staff schedules, customer reviews, inventory logs, the lot. Better to give them everything.",
                    'is_correct' => false,
                    'diagnostic' => 'You dumped every available metric instead of the few that bear on a branch decision, pushing the sifting work onto the partners.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-tailor-to-the-decision',
                        'title' => 'A decision doc includes what decides, not everything',
                        'body' => "\"Give them everything so nothing's missing\" sounds safe but produces a document nobody can use. A report meant to inform a decision should carry the handful of numbers that bear on that decision — not the entire data warehouse for the reader to sift.\n\nYou already know the decision: open a second branch or not. That tells you what's relevant — demand, capacity, the money — and what's noise for this purpose. Curating to the decision is the work; dumping everything is skipping it.\n\nMore data isn't more helpful. The partners are paying, in attention, for you to have separated signal from noise. Include what moves the decision and leave the rest out.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => 'Sounds spot on. You know what, for this and going forward — just make these however you think is best, I trust your judgement 🙌',
            'scaffold_hint' => null,
            'options' => [
                [
                    'order' => 1,
                    'body' => "Amazing, thank you! I'll take it from here and surprise you with the finished report on Thursday. 🙌",
                    'is_correct' => false,
                    'diagnostic' => 'You turned “I trust you” into total silence, so Marco can’t catch a wrong turn until it’s too late to fix before the meeting.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-trust-isnt-silence',
                        'title' => 'Being trusted means fewer questions, not no signposting',
                        'body' => "\"I trust your judgement\" is permission to decide, not permission to go dark. \"Surprise you Thursday\" leaves an open loop right before a meeting that matters — if your read of 'best' differs from his, he finds out with no time to adjust.\n\nAutonomy and visibility aren't opposites. You can make the calls and still surface the one or two that shape the result, so he can nod or nudge in ten seconds. That's not asking permission; it's keeping him oriented.\n\nEarned trust is spent well by making fewer, sharper check-ins — not by disappearing until the deadline and hoping your guess of 'best' matches his.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "I appreciate that, but I really can't start without a proper brief — can you write up exactly what you want in the report, section by section, so I get it right?",
                    'is_correct' => false,
                    'diagnostic' => 'The client just handed you reasonable autonomy and you refused it, demanding a full brief you have enough to proceed without.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-accept-the-autonomy',
                        'title' => 'When trust is offered, take it',
                        'body' => "A client saying \"use your judgement\" is a gift — it means fewer round-trips and a smoother working relationship. Insisting on a detailed brief anyway rejects that gift and signals you can't operate without being told every move.\n\nYou already have what you need: it's a decision doc for the partners on a second branch. That's enough to produce a strong first draft. Demanding a section-by-section spec is the opposite of the initiative the client is inviting.\n\nAccept reasonable autonomy, make sensible calls, and show your work in the draft. If something genuinely blocks you later, ask then — but don't answer offered trust with a request for more instructions.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Thanks, I'll run with it. To keep us aligned: I'll deliver a one-page summary plus a clear recommendation on the branch. If you'd rather have the full underlying numbers attached too, just say the word — otherwise you'll have it Wednesday for a look before Thursday.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "Thanks for trusting me! Since I've got a free hand, I'll go big — a full 20-slide deck with five-year financial projections, a marketing plan for the new branch, and hiring recommendations too.",
                    'is_correct' => false,
                    'diagnostic' => 'You read “I trust you” as licence to balloon a one-page decision doc into a huge deliverable nobody asked for.',
                    'lesson' => [
                        'slug' => 'one-clarifying-question-trust-isnt-scope-creep',
                        'title' => 'Freedom in how, not licence to expand what',
                        'body' => "\"Do it however you think best\" is discretion over the how — format, structure, judgement calls. It isn't an invitation to triple the scope with projections, marketing plans, and hiring advice nobody requested.\n\nGold-plating an ask, even with good intentions, creates work the client must now review, and often drags the deadline. A tight, on-target one-pager beats a sprawling deck that buries the decision it was meant to support.\n\nUse the freedom to make the agreed deliverable excellent, not to quietly grow it into a bigger project. Match the effort to the job you were actually given.",
                    ],
                ],
            ],
        ],
    ],
];
