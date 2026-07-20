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
    'slug' => 'understand-the-request',
    'order' => 4,
    'title' => 'Do you actually get it?',
    'client_persona' => 'Aling Nena, owner of a home-baking business, Nena\'s Kitchen',
    'scenario_intro' => "Aling Nena bakes cakes to order and just brought you on to help with admin. It's your first real task. She fires off a quick text between batches.",
    'xp_reward' => 75,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => true,
    'category' => 'comms',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Hi! When you have time, can you tidy up the client list spreadsheet? It's gotten really messy 😅 Salamat! Baking rn so I'll check later",
            'scaffold_hint' => "\"Tidy up\" can mean five different things. Show her you understood the gist, then lock down the one detail that would change how you do it. Don't quiz her on everything.",
            'tagalog_tip' => 'Yung "tidy up" kasi pwede iba-iba ang ibig sabihin, kaya wag ka mag-assume agad. Isipin mo kung anong isang detalye lang talaga ang kailangan mong linawin bago ka magsimula.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "On it! 🙌 I'll make it look perfect for you, don't worry. Leave it with me!",
                    'is_correct' => false,
                    'diagnostic' => 'You sounded eager but never checked what "tidy" means to her, so you\'re about to work off a guess.',
                    'lesson' => [
                        'slug' => 'understand-the-request-eager-guessing',
                        'title' => 'Eager isn\'t the same as understood',
                        'body' => "When a first task lands, the urge is to look keen and say yes fast. But \"I'll make it perfect\" is a promise built on a guess. You don't yet know what \"tidy\" means in her head.\n\nHer version might be \"remove duplicates.\" Yours might be \"delete old clients.\" If those don't match, you'll hand back confident work that's quietly wrong, and now she has to catch it and walk you through the task a second time.\n\nEnthusiasm is good. Pair it with a ten-second playback so your energy is pointed at the right target.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => 'Sure! Before I start: what font and colors do you want? Should names be Last, First or First Last? What column order? Do you want borders? Should I add a header row? Freeze the top row? Any filters?',
                    'is_correct' => false,
                    'diagnostic' => 'You buried a simple task under questions about things you could reasonably decide yourself.',
                    'lesson' => [
                        'slug' => 'understand-the-request-over-asking',
                        'title' => 'Don\'t make the client do your thinking',
                        'body' => "A long list of questions feels thorough, but to a busy client it lands as work. Now she has to stop baking and make eight tiny decisions she was paying you to make.\n\nMost of those have a sensible default. Names can go alphabetical with a clean header and no wild colors, and you can adjust later if she minds. Save your questions for the one or two things where guessing wrong would actually cost her.\n\nA good VA absorbs small decisions and only surfaces the ones that genuinely need the client. That's the difference between reducing her load and adding to it.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Got it! So I'll clean up the client list: remove duplicates, fix the formatting, and sort names A–Z. One quick check: keep the inactive/old clients in the list, or move them to a separate tab? Then I'll get going 👍",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "Hi Nena! Just to be 100% sure I understand: you want me to take the client list spreadsheet, which I believe is the one tracking your customers, and 'tidy' it, by which I assume you might mean formatting, or possibly the data itself, or both, so could you walk me through exactly what the current problems are, what the end result should look like, and how you'd define 'messy' vs 'tidy' for each column?",
                    'is_correct' => false,
                    'diagnostic' => 'You restated everything back in a wall of text that forces her to re-explain the whole task from scratch.',
                    'lesson' => [
                        'slug' => 'understand-the-request-wall-of-text',
                        'title' => 'Play it back short and specific',
                        'body' => "Repeating the request back is a great instinct. It proves you listened. But when the playback becomes a paragraph of \"I think you might mean… or possibly…,\" it stops being a confirmation and becomes a demand that she re-explain from zero.\n\nThe goal of a playback is to let her tap \"yes\" in five seconds. That means one crisp sentence of what you'll do, plus the single detail you actually need. If you find yourself listing every possible interpretation, you haven't understood enough yet to narrow it.\n\nShort and specific reassures her. Long and hedged makes her wonder if handing you the task saved her any time at all.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Keep them please, might reorder someday 😊 Oh wait, I just realized there are two tabs in there. One says 'Clients' and one says 'Customers 2023'. Go ahead!",
            'scaffold_hint' => 'Last beat you learned not to over-ask. This is the opposite case: which tab is the real list genuinely changes the whole job, and guessing wrong wastes everything. This is the question worth asking.',
            'tagalog_tip' => 'Dito naman, may isang bagay na si Aling Nena lang ang nakakaalam at hindi mo mahuhulaan. Timbangin mo kung gaano kamahal kapag mali ang hulaan mo bago ka magdesisyon.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Thanks! Quick one before I dive in: which tab is your current, active list, 'Clients' or 'Customers 2023'? I'll tidy that one (and leave the other as-is unless you want both). 🙏",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "Perfect, starting now! 'Clients' sounds like the main one so I'll tidy that tab.",
                    'is_correct' => false,
                    'diagnostic' => 'You guessed which tab was current based on the name alone, when a wrong guess means redoing everything.',
                    'lesson' => [
                        'slug' => 'understand-the-request-guessing-on-forks',
                        'title' => 'Ask when guessing wrong is expensive',
                        'body' => "Last beat, over-asking was the mistake because any reasonable guess was fine. This is the mirror image: two tabs, and picking the wrong one means every minute of work lands on the wrong data.\n\nThe test isn't \"could I make a guess?\" You almost always can. It's \"if my guess is wrong, how costly is it?\" When wrong is cheap, decide and move. When wrong means redoing the whole task or corrupting the real list, that's exactly when a one-line question earns its keep.\n\n'Customers 2023' could easily be the live one and 'Clients' an old draft. The name isn't proof. One quick check beats an hour spent on the wrong sheet.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "No problem! To be safe I'll just tidy both tabs so everything's clean.",
                    'is_correct' => false,
                    'diagnostic' => 'Doing both to avoid asking risks polishing an old archive she wanted left alone, and doubles the work.',
                    'lesson' => [
                        'slug' => 'understand-the-request-doing-both-to-be-safe',
                        'title' => '"Do both" is a guess in disguise',
                        'body' => "Tidying both tabs feels like the cautious, cover-all-bases move. But it's really just avoiding a question, and it can do real harm. 'Customers 2023' might be a frozen archive she keeps on purpose, and reformatting it could destroy a record she needs.\n\n\"To be safe\" should mean the safest outcome for her, not the option that lets you skip a slightly awkward message. Sometimes doing extra work is riskier than asking.\n\nWhen two paths genuinely diverge and you can't tell which she wants, the safe move is the ten-second question rather than doubling your effort on a hunch.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Oh no, two tabs is confusing 😥 Can you send me a screenshot of both and explain what's different between them and which columns are in each so I know what I'm looking at?",
                    'is_correct' => false,
                    'diagnostic' => 'You asked her to describe her own spreadsheet that you can simply open and read yourself.',
                    'lesson' => [
                        'slug' => 'understand-the-request-ask-only-what-you-cant-see',
                        'title' => 'Only ask for what you can\'t find out yourself',
                        'body' => "There's a right question here and a wrong one. The right one is what only she knows: which tab is current. The wrong one is asking her to describe columns and differences you can see the instant you open the file.\n\nBefore you ask a client anything, sort it into two piles: things you can find out yourself (open the sheet, look), and things only they can answer (their intent, their preference). Do the first pile silently. Only the second pile earns a message.\n\nAsking her to explain what's already in front of you signals you haven't looked yet, which is the opposite of taking work off her plate.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Ha, 'Clients' is the real one. 'Customers 2023' is old, ignore it. Go for it! 🙏",
            'scaffold_hint' => 'You did the work. Now close in a way that lets her confirm you understood, without re-opening the whole task or second-guessing yourself.',
            'tagalog_tip' => 'Tapos na yung trabaho, pero isipin mo kung paano mo ipapaalam kay Aling Nena na tama ang naintindihan mo. Yung magandang closing message, madali niyang ma-check kahit busy pa siya.',
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Done! ✅',
                    'is_correct' => false,
                    'diagnostic' => 'You marked it complete but gave her nothing to check it against, so she can\'t tell if you understood the task.',
                    'lesson' => [
                        'slug' => 'understand-the-request-done-with-no-summary',
                        'title' => 'Close with something she can verify',
                        'body' => "\"Done ✅\" is satisfying to send, but it leaves her with a question: done how? On a task that started ambiguous, the whole point is showing that your understanding matched hers, and a bare \"done\" shows nothing.\n\nA one-line summary of what you actually did lets her confirm in seconds without reopening the file. \"Removed 12 duplicates, standardized the names, sorted A–Z, kept inactive clients.\" She reads it and knows instantly whether you got it right.\n\nThe first task with a new client is where trust is built. A checkable summary says \"I understood you,\" which is worth far more than the tick mark alone.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "All done! On the 'Clients' tab I removed 12 duplicate rows, made the names one consistent format, and sorted them A–Z. Inactive clients are still in there like you asked, and I left 'Customers 2023' untouched. Have a look and tell me if that matches what you pictured 👍",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Done! Since it was messy I also went ahead and deleted everyone who hasn't ordered in over a year to really clean it up.",
                    'is_correct' => false,
                    'diagnostic' => 'You took "tidy" as license to delete client records she never asked you to remove.',
                    'lesson' => [
                        'slug' => 'understand-the-request-dont-over-interpret',
                        'title' => 'A vague word isn\'t permission to do more',
                        'body' => "\"Tidy\" is fuzzy, and it's tempting to fill the gap with your own bigger idea of what would help, like purging old clients. But deleting data is destructive and irreversible, and she never asked for it. She might have been about to re-market to exactly those people.\n\nWhen a request is vague, resolve it toward the smallest, safest reading rather than the most dramatic one. Formatting and sorting are reversible and clearly \"tidy.\" Deleting records is a different, weightier action that needs its own explicit yes.\n\nIf you think trimming old clients is a good idea, that's worth raising as a suggestion she approves, never as something you already did.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Okay I think I finished it? I wasn't totally sure what you meant by tidy so I sort of guessed. You should probably double-check the whole thing to make sure it's what you wanted, sorry if it's wrong! 😅",
                    'is_correct' => false,
                    'diagnostic' => 'You handed back anxious hedging that makes her re-verify everything from scratch, undoing the point of delegating.',
                    'lesson' => [
                        'slug' => 'understand-the-request-dont-hand-back-doubt',
                        'title' => 'Deliver with quiet confidence',
                        'body' => "Under-claiming can hurt as much as over-claiming. \"I guessed, please check everything, sorry\" tells her the work might be wrong and dumps full verification back on her. She now has to redo in her head what she paid you to do.\n\nIf you were unsure what \"tidy\" meant, the moment to resolve it was before you started, not at the handoff. By the closing message, you should be presenting a clear result rather than confessing doubt.\n\nConfidence here isn't arrogance. It just means giving her a crisp summary and inviting a glance, so the ball is genuinely in a resting place. \"Here's what I did, tell me if you'd change anything\" lets her relax; \"I'm not sure, check it all\" does not.",
                    ],
                ],
            ],
        ],
    ],
];
