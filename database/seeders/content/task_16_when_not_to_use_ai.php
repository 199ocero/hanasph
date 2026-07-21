<?php

/*
 * QUALITY BAR - every wrong option must satisfy all five:
 *  1. Plausible: a real beginner could genuinely pick it.
 *  2. Distinctly wrong: fails for a DIFFERENT reason than the other wrongs.
 *  3. Diagnostic is ONE defensible sentence a working VA would agree with.
 *  4. Exactly one is_correct === true per beat.
 *  5. Lesson teaches the principle, not the answer; fits one screen.
 */

return [
    'slug' => 'when-not-to-use-ai',
    'order' => 23,
    'title' => 'Put the AI down',
    'client_persona' => 'Ramon, runs a small accounting firm and trusts your judgment',
    'scenario_intro' => "You've been using AI to speed up Ramon's work all week and he loves it. Now he forwards you an email from Mrs. Santos, a long-time client whose husband just passed away.",
    'xp_reward' => 175,
    'onboarding_entry_key' => null,
    'category' => 'ai',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "So sorry to send this while I'm buried in tax season. Can you reply to Mrs. Santos for me? She's asking us to gently confirm the balance on her and her late husband's joint account and to reassure her. Her email has all their account details in it. I trust you to handle it with care 🙏",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Sensitive na sitwasyon to dahil may grieving client, may private account details, at may figures na dapat eksakto. Isipin mo kung saan talaga makakatulong ang AI at kung anong parte ang hindi dapat isali dito.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "I'll paste her email into my AI tool to draft the reply quickly. It's much faster than typing it all out, and I'll skim it before sending.",
                    'is_correct' => false,
                    'diagnostic' => 'You fed a client’s private financial and personal details into a third-party AI tool to save a few minutes.',
                    'lesson' => [
                        'slug' => 'when-not-to-use-ai-guard-confidential-data',
                        'title' => 'Some things never go into the box',
                        'body' => "AI tools are fast, and the instinct is to paste whatever you're working on straight in. But when the material is confidential, like account numbers, personal details, or anything a client shared in trust, pasting it into an outside service hands it somewhere you don't control.\n\nThe client didn't consent to their private data leaving your hands, and \"it was quicker\" is no defense if it leaks. Speed never justifies exposing information that isn't yours to share.\n\nBefore anything goes into an AI tool, ask: would the client be comfortable knowing this specific data went there? If it's sensitive, the answer is do it yourself, in the tools you're trusted with.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "I'll have my AI tool write a warm, heartfelt condolence message so it sounds really compassionate and polished, then send that to her.",
                    'is_correct' => false,
                    'diagnostic' => 'You outsourced genuine human sympathy to a machine, producing sincerity that isn’t real for a grieving person.',
                    'lesson' => [
                        'slug' => 'when-not-to-use-ai-real-sincerity',
                        'title' => 'AI can’t feel it for you',
                        'body' => "AI writes fluent, moving-sounding condolences on demand, which is exactly the trap. A grieving person doesn't need polished. They need real. A message that performs compassion without anyone actually feeling it is hollow, and people can often tell.\n\nThe value of a personal note is that a human paused, thought of them, and meant it. Automating that removes the one thing that made it worth sending. Two clumsy sincere sentences beat a flawless generated paragraph.\n\nWhen a message carries genuine human emotion like grief, apology, or gratitude, write it yourself. The imperfection is the proof it's real.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "This needs a human touch. I'll write Mrs. Santos a short, sincere note myself, offer condolences simply, and confirm the balance only after I've checked it against your records. Nothing of hers goes near an AI tool.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "I'll ask my AI tool to work out the exact outstanding balance and any fees owed on the account so the reply has the full figures, then send it to her.",
                    'is_correct' => false,
                    'diagnostic' => 'You let AI invent high-stakes financial figures instead of pulling them from the actual records.',
                    'lesson' => [
                        'slug' => 'when-not-to-use-ai-verify-high-stakes-facts',
                        'title' => 'AI guesses; records know',
                        'body' => "AI produces numbers that look authoritative whether or not they're true. For a high-stakes fact like a balance owed, a legal figure, or a medical detail, confident and correct are not the same thing, and the gap can do real harm.\n\nA wrong figure sent to a grieving client about her late husband's account isn't a small slip; it's the kind of error that destroys trust in the whole firm. The source of a real number is the actual record, never a model's best guess.\n\nUse AI to draft and phrase, but any fact that matters must come from, and be checked against, the true source before it leaves your hands.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "That was handled beautifully, thank you 🙏 Totally different thing now that I've got a second: can you put together a first draft of our monthly client newsletter? Just general tax-season tips, nothing sensitive. Whatever's fastest is fine.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Ibang usapan na to, casual newsletter lang at walang sensitive data. Isipin mo kung paano mo magagamit nang tama ang AI dito, pero wag mong kalimutan kung anong parte ang dapat mong personal na i-check bago ipasa.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "After the Mrs. Santos situation I don't think we should be using AI for our client communications at all. I'll write the whole newsletter from scratch by hand to be safe. It'll take longer but it's the responsible call.",
                    'is_correct' => false,
                    'diagnostic' => 'You turned one good judgment call into a blanket ban, refusing AI even for a low-stakes task it’s perfect for.',
                    'lesson' => [
                        'slug' => 'when-not-to-use-ai-not-a-blanket-ban',
                        'title' => 'The lesson is judgment, not abstinence',
                        'body' => "Learning when to put AI down can tip into swearing off it entirely: \"AI is risky, so I'll avoid it.\" That over-corrects. A general newsletter with no private data and no life-or-death facts is exactly the kind of drafting AI does well and fast.\n\nThe skill this task teaches isn't \"don't use AI.\" It's telling the sensitive, high-stakes, human moments (handle yourself) from the routine ones (let AI help). Refusing everywhere wastes the tool and the client's time.\n\nMatch the tool to the situation. The same judgment that says \"not for Mrs. Santos\" should say \"yes, for the newsletter.\"",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Perfect job for AI. I'll have it draft the newsletter, then I'll read it through, fact-check any tax figures against a real source, and tidy the tone before it goes to you for final sign-off.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "On it! I'll have my AI tool write the newsletter and send it straight out to your list so it's off both our plates fast.",
                    'is_correct' => false,
                    'diagnostic' => 'You let AI’s output go to real clients unread, handing your judgment over entirely instead of owning the final version.',
                    'lesson' => [
                        'slug' => 'when-not-to-use-ai-own-the-final',
                        'title' => 'AI drafts; you sign',
                        'body' => "Using AI well for a routine task doesn't mean stepping back completely. A first draft is a starting point, not a finished product. The moment it goes to real people under the firm's name, a human has to have read it and stood behind it.\n\nModels get tone wrong, invent a detail, or miss the client's voice. Sending unread output isn't delegating to AI; it's abdicating the judgment you're actually paid for.\n\nLet AI do the heavy first pass, then always be the human who reviews, corrects, and chooses to send. The tool drafts; you own what goes out.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Great! I'll have AI draft it with some specific stats and deadlines to make it feel authoritative, then pass it straight to you to approve.",
                    'is_correct' => false,
                    'diagnostic' => 'You planned to keep AI-generated stats and dates without verifying them, letting confident-sounding facts slip into client-facing content.',
                    'lesson' => [
                        'slug' => 'when-not-to-use-ai-check-facts-even-in-drafts',
                        'title' => 'Low stakes still needs true facts',
                        'body' => "Because a newsletter feels casual, it's easy to wave through the numbers AI produces, like a filing deadline, a percentage, or a threshold. But those are still facts going to real clients, and a wrong tax date in a friendly email is still wrong.\n\nHanding an unverified draft to Ramon just moves the problem: either he catches the error (and wonders why you didn't) or he doesn't (and the firm publishes it). \"Feels authoritative\" is the opposite of \"is accurate.\"\n\nAny specific claim AI generates, even in low-stakes content, gets checked against a real source before it moves forward. Verifying facts is your job in every draft, not just the important-looking ones.",
                    ],
                ],
            ],
        ],
    ],
];
