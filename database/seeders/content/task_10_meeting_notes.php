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
    'slug' => 'meeting-notes',
    'order' => 12,
    'title' => 'Notes that actually help',
    'client_persona' => 'Sofia, founder of an early-stage startup',
    'scenario_intro' => 'Sofia just wrapped a 45-minute team planning call and asked you to write it up and send it round. You sat in and took notes the whole time.',
    'xp_reward' => 150,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'admin',
    'ai_grading_enabled' => true,
    'beats' => [
        [
            'order' => 1,
            'client_message' => 'That was a big one 😅 Can you write up the notes and send them to the team? There was a lot in there, a few things we decided, some stuff people are picking up. Thank you!!',
            'scaffold_hint' => null,
            'tagalog_tip' => 'Marami mang napag-usapan, hindi ibig sabihin lahat ilalagay mo sa notes. Isipin mo kung ano talaga yung kailangan malaman ng team para makapag-move sila pagkatapos ng meeting.',
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Type up everything that was said, close to word-for-word, so nothing gets lost, the full back-and-forth across all 45 minutes.',
                    'is_correct' => false,
                    'diagnostic' => 'A near-verbatim transcript buries the few decisions and tasks under 45 minutes of chatter that nobody will read to find them.',
                    'lesson' => [
                        'slug' => 'meeting-notes-notes-are-not-a-transcript',
                        'title' => 'Notes distil the meeting',
                        'body' => "It feels safe to capture every word, since surely more detail can't hurt. But a wall of back-and-forth forces every reader to re-live the whole meeting to extract what actually matters, so in practice no one reads it and the decisions get lost in the noise.\n\nThe value of notes is the sifting you do: pulling out the handful of decisions and tasks and leaving the rest behind. If you hand over everything, you've done none of that work. You've just moved the meeting from audio into text.\n\nGood notes are shorter than the meeting on purpose. Your job is to decide what's worth keeping, not to preserve all of it.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Write a short, friendly paragraph: the team had a great, productive discussion about marketing and the new hire, and everyone's aligned and excited to move forward.",
                    'is_correct' => false,
                    'diagnostic' => 'A warm summary with no decisions, owners, or dates reads nicely but tells nobody what they actually need to do next.',
                    'lesson' => [
                        'slug' => 'meeting-notes-vague-summary-helps-no-one',
                        'title' => 'Pleasant and useless is still useless',
                        'body' => "A tidy paragraph about a \"productive discussion\" feels professional, but a week later it answers none of the questions people actually have: what did we decide, who's doing what, and by when? \"Everyone's aligned\" isn't something anyone can act on.\n\nUseful notes are concrete. They name the specific decisions the meeting reached and turn talk into tasks with an owner and a date attached. Vague warmth is the opposite of that. It summarises the vibe and drops the substance.\n\nIf your notes could describe almost any meeting, they're too vague. Aim for the details that make this meeting's outcomes clear and trackable.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Write it up and, since the pricing debate didn't quite land, record that the team decided to raise prices to ₱499, since that's clearly the direction it was heading anyway.",
                    'is_correct' => false,
                    'diagnostic' => 'Writing down a decision the team never actually made puts words in their mouths and can send everyone acting on something untrue.',
                    'lesson' => [
                        'slug' => 'meeting-notes-record-only-what-happened',
                        'title' => 'Notes report what the room actually decided',
                        'body' => "When a discussion trails off unresolved, it's tempting to \"help\" by writing down where it seemed to be going. But notes are a record of what the meeting actually decided, and inventing a conclusion, even a likely one, turns your guess into official fact.\n\nPeople act on notes. If they say prices are now ₱499, someone updates the website, and suddenly your assumption is live because it looked like a decision on paper. A debate that didn't land is an open item, not a decision.\n\nCapture what was genuinely settled. When something wasn't, say so plainly rather than smoothing it into a conclusion nobody reached.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => 'Write crisp notes: a short list of the decisions the team actually made, then an action-items section where each task has a named owner and a due date. Leave out the small talk.',
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => 'This is looking great. Oh, remember when Marco said "we should really look into TikTok ads at some point"? Where did you end up putting that in the notes?',
            'scaffold_hint' => null,
            'tagalog_tip' => 'Yung sinabi ni Marco ay idea lang, hindi pa desisyon ng team. Isipin mo kung paano mo ito maitatala nang hindi ka nag-iimbento ng owner o deadline na walang nag-agree.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "I assigned it to Marco as an action item due next Friday, since he's the one who raised it, that way it doesn't get forgotten.",
                    'is_correct' => false,
                    'diagnostic' => 'Nobody agreed Marco owned this or that it was due Friday, so you\'ve manufactured a commitment out of a passing comment.',
                    'lesson' => [
                        'slug' => 'meeting-notes-dont-invent-ownership',
                        'title' => 'Raising an idea is not agreeing to own it',
                        'body' => "Turning \"we should look into that\" into \"Marco, due Friday\" feels tidy, since every item gets an owner and a date. But the meeting never assigned it, and mentioning something is very different from volunteering to run it. Now Marco has a task he never accepted, with a deadline invented by you.\n\nOwners and dates on your notes carry weight; people plan around them. Fabricating them creates false accountability and quiet resentment when someone's name appears against work they didn't take on.\n\nWhen a task has a real owner and date, record them. When it doesn't yet, don't assign one to make the list look complete.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "I logged it under \"Open items to confirm\" as \"Explore TikTok ads (raised by Marco; no owner or date agreed yet)\", so it's captured and we can decide next time who takes it.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "I left it out, it was just a passing comment, not a real decision, so it didn't belong in the notes.",
                    'is_correct' => false,
                    'diagnostic' => 'Dropping a live idea entirely means a thread the team clearly cares about vanishes with no way to pick it back up.',
                    'lesson' => [
                        'slug' => 'meeting-notes-capture-the-loose-threads',
                        'title' => 'An unresolved idea still deserves a home',
                        'body' => "It's true that a stray comment isn't a decision, but that doesn't make it worthless. Sofia remembered it and asked where it went, which tells you it mattered. Leaving it out entirely means the only record of it was the meeting itself, and now it's gone.\n\nNotes have room for more than decisions and tasks. An \"open items\" or \"parking lot\" section holds the ideas that were raised but not resolved, so they can be picked up deliberately instead of quietly forgotten.\n\nDon't force a loose thread into a fake decision, but don't cut it either. Park it where the team can find it again.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => 'I wrote it up as a recommendation that the team should launch TikTok ads next month with a ₱10,000 budget, since that seems like the smart move for them.',
                    'is_correct' => false,
                    'diagnostic' => 'Inserting your own budget and timeline as a recommendation slips your opinion into a record that\'s supposed to reflect only the team\'s decisions.',
                    'lesson' => [
                        'slug' => 'meeting-notes-keep-your-opinions-out',
                        'title' => 'Record what the room decided, keep your advice separate',
                        'body' => "Adding a concrete plan (next month, ₱10,000) might feel like initiative, but nobody in the meeting proposed those numbers. You've inserted your own strategy into a document that people trust to reflect what *they* decided, where it can easily be mistaken for a team choice.\n\nMeeting notes are a neutral record. The moment your preferences appear in them, readers can no longer tell what the team actually agreed from what the note-taker thinks they should do.\n\nIf you have a genuinely useful idea, that's fine. Offer it separately as your own suggestion, and keep it out of the record of what happened.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Perfect, that's exactly what I needed. Can you send it round to the team today? I want everyone on the same page.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Gusto ng client na maipadala agad habang sariwa pa ang meeting. Isipin mo kung paano mo panatilihing visible yung open item na wala pang owner nang hindi mo ito tinatago para lang mukhang malinis.',
            'options' => [
                [
                    'order' => 1,
                    'body' => 'Send the notes, and attach the full audio recording and my raw typed notes as well, so the team has absolutely everything to refer back to.',
                    'is_correct' => false,
                    'diagnostic' => 'Bundling the recording and raw notes alongside the clean version buries the summary you worked to distil.',
                    'lesson' => [
                        'slug' => 'meeting-notes-dont-undo-the-distillation',
                        'title' => 'Don\'t re-bury what you just distilled',
                        'body' => "Attaching the recording and raw notes \"for completeness\" throws away the whole point of the summary. The team now faces the same wall of material you filtered out, and the crisp version competes for attention with 45 minutes of audio.\n\nYou did the hard work of pulling out what matters. Sending everything alongside it signals you don't trust your own summary and invites people to ignore it and re-do the sifting themselves.\n\nSend the clean notes as the thing people act on. Keep the raw material available if someone asks, but don't push it into everyone's inbox and drown the version that helps.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Hold off sending until I've filled in the missing owner and date on the TikTok item myself, so the notes look fully complete before the team sees them.",
                    'is_correct' => false,
                    'diagnostic' => 'Delaying the notes to guess-fill an item nobody assigned trades timely, accurate notes for late, invented ones.',
                    'lesson' => [
                        'slug' => 'meeting-notes-timely-beats-falsely-complete',
                        'title' => 'Fresh and honest beats late and made-up',
                        'body' => "Waiting so the notes \"look complete\" sounds diligent, but the only way to complete that open item is to invent an owner and date the meeting never set, the exact mistake you just avoided. And every day the notes sit unsent, memories fade and they matter less.\n\nAn open item marked clearly as unresolved is still an accurate note. Notes are most useful right after the meeting, while everyone still remembers the context. Timeliness is part of their value.\n\nSend honest notes today, open items and all. Don't hold accurate work hostage to a tidiness that would only be achieved by making things up.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Send the notes now while they're fresh, with the decisions and action items up top, and the one open TikTok item flagged clearly so it isn't lost, plus a line asking the team to confirm who owns it.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => 'Send just the confirmed decisions and assigned action items, and leave the open TikTok item out so the notes look clean and buttoned-up.',
                    'is_correct' => false,
                    'diagnostic' => 'Trimming the unresolved item for a tidier look drops the one thing that still needs following up.',
                    'lesson' => [
                        'slug' => 'meeting-notes-dont-hide-the-unfinished',
                        'title' => 'A clean look isn\'t worth a dropped follow-up',
                        'body' => "Cutting the open item makes the notes look neat, but neatness isn't the goal. Nothing falling through the cracks is the goal. The unresolved TikTok question is precisely the kind of thing that gets forgotten unless it's written down where people will see it.\n\nOpen items belong in good notes. Surfacing what's unfinished is how a team remembers to close it, and hiding it to look polished quietly guarantees it disappears.\n\nShow the loose ends, clearly marked. Good notes make the unfinished business visible, not invisible.",
                    ],
                ],
            ],
        ],
    ],
];
