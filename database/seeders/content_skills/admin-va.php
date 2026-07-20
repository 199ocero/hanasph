<?php

/*
 * Authored skill course: lessons for the "admin-va" niche.
 * Course meta (title, subtitle, icon, order) comes from config/skills.php.
 * Each lesson: order, title, brief, rubric (weights sum to 100),
 * reference_notes (grader-only), accepted_formats, difficulty, xp_reward,
 * tip (learner-facing coaching), ai_leverage (approach + copyable starter prompt).
 */

return [
    [
        'order' => 1,
        'title' => 'Write a Professional Client Follow-Up Email',
        'brief' => 'Your client, Marites Cruz, runs a small events styling business in Quezon City. Two weeks ago she sent a quote to a wedding couple and has not heard back. She asks you to write a warm follow-up email that nudges the couple without sounding pushy, and confirms whether they still want the June date held. Submit the full email as plain text, including the subject line and sign-off.',
        'rubric' => [
            ['criterion' => 'Clear, specific subject line', 'weight' => 20, 'what_good_looks_like' => 'Subject names the purpose and the wedding date so the couple knows the email at a glance.'],
            ['criterion' => 'Warm, non-pushy tone', 'weight' => 40, 'what_good_looks_like' => 'The message is friendly and gives the couple an easy way out, without guilt-tripping or chasing.'],
            ['criterion' => 'Clear call to action', 'weight' => 25, 'what_good_looks_like' => 'Asks one specific question about holding the June date and makes replying simple.'],
            ['criterion' => 'Correct grammar and formatting', 'weight' => 15, 'what_good_looks_like' => 'No spelling or grammar errors, with a proper greeting, short paragraphs, and a professional sign-off.'],
        ],
        'reference_notes' => 'A pass reads like something you could send a real couple today: one clear ask, a genuine tone, and a graceful exit if they have moved on. Fail it if the email demands a reply, piles on multiple questions, uses a vague subject like "Following up", or contains obvious grammar slips. Length should be short, roughly four to eight sentences in the body.',
        'accepted_formats' => ['text'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Give the couple an easy way out and they are more likely to reply. Ask one clear question about the June date, and skip the vague "just following up" subject line for one that names the date.',
        'ai_leverage' => [
            'approach' => 'Let AI draft the warm nudge so you avoid sounding pushy, then adjust the details and tone so it sounds like Marites and not a template.',
            'prompt' => "Act as an admin VA for {business_name}, a {business_type}.\nWrite a warm follow-up email to a client who has not replied to a quote sent {time_since}.\nGoal: gently check if they still want to proceed and confirm {specific_detail}.\nInclude a specific subject line and a professional sign-off. Give them an easy way to say no. Keep the body to 4 to 8 sentences.",
        ],
    ],
    [
        'order' => 2,
        'title' => 'Turn a Messy Meeting into Clean Minutes',
        'brief' => 'You sat in on a 30-minute team call for Kape Barako, a growing coffee cart franchise. The owner, Rico Delgado, wants tidy minutes he can forward to three staff who missed it. Using the rough scenario below, write meeting minutes that capture the decisions and who owns each next step. Scenario: the team agreed to add a new ube latte for August, Rico will approve the supplier by Friday, Jenny handles the menu redesign, and they postponed the Cavite branch opening to September. Submit the minutes as plain text.',
        'rubric' => [
            ['criterion' => 'Captures key decisions', 'weight' => 35, 'what_good_looks_like' => 'Every decision from the scenario appears, including the new latte and the postponed branch opening.'],
            ['criterion' => 'Clear action items with owners', 'weight' => 35, 'what_good_looks_like' => 'Each task lists who owns it and any deadline, so a reader knows exactly what happens next.'],
            ['criterion' => 'Scannable structure', 'weight' => 30, 'what_good_looks_like' => 'Uses headings or bullets, a date, and attendee context so someone who missed the call catches up fast.'],
        ],
        'reference_notes' => 'The test is whether one of the three absent staff could read this cold and know what was decided and what they must do. A pass separates decisions from action items and never drops the postponed Cavite opening. Fail it if it reads as a wall of prose, invents details not in the scenario, or leaves action items without an owner.',
        'accepted_formats' => ['text'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Split decisions from action items into two clear sections, and pin a name to every action. Imagine one of the absent staff reading it cold: could they tell what they personally need to do?',
        'ai_leverage' => [
            'approach' => 'This is where AI shines: paste your rough notes and ask it to sort them into decisions and owner-tagged action items. You then check nothing was dropped or invented.',
            'prompt' => "Turn these rough meeting notes into clean, scannable minutes for {business_name}.\nUse two sections: Decisions, and Action Items with an owner and deadline for each.\nAdd a date and a short attendees line. Only use what is in my notes, do not invent anything. Here are the notes:\n{paste_rough_notes}",
        ],
    ],
    [
        'order' => 3,
        'title' => 'Resolve a Double-Booked Calendar Conflict',
        'brief' => 'You manage the calendar for Atty. Lorna Bautista, a busy solo lawyer in Makati. You discover she is double-booked next Tuesday at 2 PM: a client consultation with a returning client, Mr. Tan, and an internal review with a junior associate. Write two things and submit both as plain text: first, a short heads-up message to Atty. Bautista laying out the conflict and your recommended fix, and second, the rescheduling email you would send to whichever party gets moved.',
        'rubric' => [
            ['criterion' => 'Correctly frames the conflict and a recommendation', 'weight' => 35, 'what_good_looks_like' => 'The heads-up states both bookings clearly and recommends one specific fix rather than just flagging the problem.'],
            ['criterion' => 'Sound prioritisation judgment', 'weight' => 30, 'what_good_looks_like' => 'The choice of who to move is defensible, for example protecting the paying client and moving the internal review.'],
            ['criterion' => 'Professional reschedule email', 'weight' => 25, 'what_good_looks_like' => 'The reschedule note apologises briefly, offers concrete new time options, and stays courteous.'],
            ['criterion' => 'Clarity and no ambiguity', 'weight' => 10, 'what_good_looks_like' => 'Times, dates, and names are exact so nobody is left guessing what moved and when.'],
        ],
        'reference_notes' => 'This lesson tests judgment as much as writing. A pass moves the lower-stakes internal review rather than the returning client, and offers real alternative times instead of a vague "let me know when you are free". Fail it if the trainee moves the paying client without reason, offers no new time options, or writes the reschedule email so vaguely that the recipient cannot act.',
        'accepted_formats' => ['text'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'Do not just flag the clash, recommend a fix. Protect the paying client and move the internal review, and always offer two concrete new time slots instead of "let me know when you are free".',
        'ai_leverage' => [
            'approach' => 'You make the prioritisation call yourself, since that is judgment AI should not own. Use AI only to polish the reschedule email once you have decided who moves.',
            'prompt' => "I decided to move {who_gets_moved} to resolve a calendar clash for {person_name}.\nWrite a short, courteous rescheduling email that briefly apologises and offers two concrete new time options: {option_one} and {option_two}.\nKeep it professional and make it easy for them to pick a slot.",
        ],
    ],
    [
        'order' => 4,
        'title' => 'Draft a Firm but Polite Overdue Payment Email',
        'brief' => 'Your client, Nina Reyes, owns a boutique digital agency in Cebu. One of her clients, Sunrise Dental, is 45 days past due on a 25,000 peso invoice after two soft reminders were ignored. Nina wants a firmer email that protects the relationship but makes clear payment is now overdue and needs a date. Write the full email as plain text, including subject line, and reference the invoice number INV-2041 and the original due date.',
        'rubric' => [
            ['criterion' => 'Firm without burning the relationship', 'weight' => 35, 'what_good_looks_like' => 'Tone is direct about the overdue status yet stays respectful and leaves room to keep working together.'],
            ['criterion' => 'Concrete details and next step', 'weight' => 30, 'what_good_looks_like' => 'Names the invoice number, amount, days overdue, and asks for a specific payment date or plan.'],
            ['criterion' => 'Structure and readability', 'weight' => 20, 'what_good_looks_like' => 'Short paragraphs, a clear subject line, and an easy-to-find summary of what is owed.'],
            ['criterion' => 'Correct grammar and professionalism', 'weight' => 15, 'what_good_looks_like' => 'Clean grammar and a courteous close with no threatening or emotional language.'],
        ],
        'reference_notes' => 'The hard part is tone calibration: firmer than a gentle nudge but not a legal threat. A pass states the facts plainly, asks for a committed date, and keeps a professional close. Fail it if the email is passive to the point of being ignorable again, turns hostile, omits the invoice number or amount, or lacks a clear deadline ask.',
        'accepted_formats' => ['text'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'Two soft reminders were already ignored, so this one has to ask for a committed date, not another gentle nudge. State the invoice, amount, and days overdue plainly, and stay firm without a hint of threat.',
        'ai_leverage' => [
            'approach' => 'Ask AI to hit the exact tone between a friendly nudge and a legal threat, then feed it the real invoice facts so nothing is vague or wrong.',
            'prompt' => "Write a firm but polite overdue payment email for {business_name}.\nFacts: invoice {invoice_number} for {amount}, now {days_overdue} days past due, after two soft reminders were ignored.\nInclude a clear subject line, state the facts plainly, and ask for a specific payment date. Stay respectful and keep the relationship intact. No threats, no emotional language.",
        ],
    ],
    [
        'order' => 5,
        'title' => 'Clean Up a Messy Client Contact Spreadsheet',
        'brief' => 'Your client, Paolo Mendoza, runs a real estate brokerage in Davao and hands you a chaotic contact list to fix before a mail-merge campaign. The raw data has inconsistent name capitalisation, phone numbers in mixed formats, duplicate rows, blank cells, and a single column that jams full name, email, and phone together. Clean it into a tidy, merge-ready sheet and submit the finished file (CSV or Excel). Include a short notes tab or note explaining what you changed. Sample rows: "juan dela cruz, 09171234567 juan@email.com"; "MARIA santos | maria@email.com | 0917-222-3333"; "Juan Dela Cruz 0917 123 4567 juan@email.com".',
        'rubric' => [
            ['criterion' => 'Data split into clean, consistent columns', 'weight' => 35, 'what_good_looks_like' => 'Name, email, and phone live in separate columns with consistent capitalisation and one standard phone format.'],
            ['criterion' => 'Duplicates and blanks handled', 'weight' => 30, 'what_good_looks_like' => 'Duplicate contacts are merged or removed and empty cells are addressed rather than left silently broken.'],
            ['criterion' => 'Merge-ready and documented', 'weight' => 25, 'what_good_looks_like' => 'The sheet has clear headers, no stray formatting, and a short note listing what was changed.'],
            ['criterion' => 'Accuracy of the cleaned data', 'weight' => 10, 'what_good_looks_like' => 'No real contact detail is lost or garbled during the clean-up, checked against the sample rows.'],
        ],
        'reference_notes' => 'This is the capstone and should be graded strictly. A pass produces a sheet you could drop straight into a mail merge: proper column headers, one row per unique contact, uniform phone formatting, and a change note. The three sample rows for Juan should collapse to a single clean record. Fail it if data stays jammed in one column, duplicates survive, phone formats remain mixed, or a contact detail is dropped. Grade the actual uploaded file, not a description of it.',
        'accepted_formats' => ['file', 'image'],
        'difficulty' => 'hard',
        'xp_reward' => 200,
        'tip' => 'The three Juan rows are one person, so your cleaned sheet should show him once. Split name, email, and phone into their own columns, pick one phone format, and add a short note listing what you changed.',
        'ai_leverage' => [
            'approach' => 'AI can split the jammed column and spot duplicates quickly, but you verify every merged record against the original so no real contact detail is lost. Keep the untouched raw file as your safety net.',
            'prompt' => "Help me clean a contact list for a mail merge. The raw data jams full name, email, and phone into one column, with mixed capitalisation, mixed phone formats, blanks, and duplicate rows.\nSplit it into separate Name, Email, and Phone columns. Standardise names to title case and phones to {phone_format}. Flag duplicate people so I can confirm before merging.\nDo not lose any real detail. Here is the raw data:\n{paste_raw_rows}",
        ],
    ],
];
