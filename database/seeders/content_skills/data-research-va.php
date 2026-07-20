<?php

/*
 * Authored skill course: lessons for the "data-research-va" niche.
 * Course meta (title, subtitle, icon, order) comes from config/skills.php.
 * Each lesson: order, title, brief, rubric (weights sum to 100),
 * reference_notes (grader-only), accepted_formats, difficulty, xp_reward,
 * tip (learner-facing coaching), ai_leverage (approach + copyable starter prompt).
 */

return [
    [
        'order' => 1,
        'title' => 'Enter orders into a clean tracking sheet',
        'brief' => 'A client named Marco runs an online shop, Cebu Craft Supplies, and hands you a batch of 15 recent orders as loose notes: customer name, item, quantity, order date, and amount paid. Build a single spreadsheet that captures all 15 orders in a tidy, one-row-per-order layout with clear column headers. Upload the finished file (Excel, CSV, or a Google Sheets export) so it is ready to hand back to Marco.',
        'rubric' => [
            ['criterion' => 'Structure', 'weight' => 40, 'what_good_looks_like' => 'One row per order, one field per column, with labelled headers and no merged or stray cells.'],
            ['criterion' => 'Completeness', 'weight' => 30, 'what_good_looks_like' => 'All 15 orders are present and every column has a value where the source note provided one.'],
            ['criterion' => 'Consistency', 'weight' => 30, 'what_good_looks_like' => 'Dates, amounts, and quantities follow one consistent format down each column.'],
        ],
        'reference_notes' => 'Pass if the sheet is genuinely usable: real column headers, one order per row, and consistent formatting within each column. Fail a wall of text, orders crammed into one cell, or missing rows. Minor typos are fine; a broken structure is not.',
        'accepted_formats' => ['file'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Decide your columns before you type a single order: one field per column, one order per row. Pick one date format and one money format and hold them all the way down.',
        'ai_leverage' => [
            'approach' => 'Paste the loose notes into AI and ask it to structure them into rows and columns, then paste the result into your sheet and eyeball every row against the original before you send it.',
            'prompt' => "I have {count} orders written as loose notes. Turn them into a clean table I can paste into a spreadsheet.\nColumns: {columns}.\nOne row per order, one value per cell. Use a consistent date format ({date_format}) and a consistent number format for amounts. Leave a cell blank if a note does not mention it. Here are the notes:\n{paste_notes_here}",
        ],
    ],
    [
        'order' => 2,
        'title' => 'Clean up a messy contact list',
        'brief' => 'A client, Ates Rina, forwards you a contact list she inherited from a former assistant. It is a mess: names in ALL CAPS or lowercase, phone numbers written five different ways, trailing spaces, and a few obvious duplicates. Clean it into one consistent, deduplicated sheet she can actually use. Upload the cleaned file and keep the same columns she started with.',
        'rubric' => [
            ['criterion' => 'Consistent formatting', 'weight' => 40, 'what_good_looks_like' => 'Names use consistent casing and phone numbers follow one clear format throughout.'],
            ['criterion' => 'Duplicates removed', 'weight' => 30, 'what_good_looks_like' => 'Obvious duplicate contacts are merged or removed without dropping unique people.'],
            ['criterion' => 'Data preserved', 'weight' => 30, 'what_good_looks_like' => 'No real contact or detail is lost or scrambled during the cleanup.'],
        ],
        'reference_notes' => 'Pass if the result is visibly cleaner and safe to use: uniform casing, one phone format, duplicates gone, and nothing important deleted. Fail if the cleanup lost data, missed the duplicates, or left the formatting as inconsistent as before.',
        'accepted_formats' => ['file'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Keep a copy of the original before you touch anything, so you can prove nothing real was lost. Fix one thing at a time: casing first, then phone format, then duplicates.',
        'ai_leverage' => [
            'approach' => 'AI can spot the duplicate and formatting patterns fast, but you make the final call on which duplicate to keep. Never let it silently delete a contact you have not checked.',
            'prompt' => "Help me clean a contact list. Do not drop any unique person.\nStandardise names to {name_casing} and phone numbers to this format: {phone_format}.\nFlag likely duplicates and tell me which rows they are so I can confirm before merging.\nKeep these columns unchanged: {columns}. Here is the list:\n{paste_list_here}",
        ],
    ],
    [
        'order' => 3,
        'title' => 'Build a lead list for outreach',
        'brief' => 'A client named Daniel sells bookkeeping services to small cafes and wants to start cold outreach in Metro Manila. Build him a lead list of 20 real cafes with the columns he needs to actually contact them: business name, city or area, contact name if you can find one, email or contact form, phone, and website or social page. Upload the spreadsheet. Only include leads you could verify, and leave a cell blank rather than guessing.',
        'rubric' => [
            ['criterion' => 'Right columns', 'weight' => 30, 'what_good_looks_like' => 'The sheet has the fields outreach actually needs and one lead per row.'],
            ['criterion' => 'Data quality', 'weight' => 40, 'what_good_looks_like' => 'Leads are real, fit the target (Metro Manila cafes), and details look verified rather than invented.'],
            ['criterion' => 'Coverage', 'weight' => 30, 'what_good_looks_like' => 'Close to 20 usable leads with enough contact detail to reach most of them.'],
        ],
        'reference_notes' => 'Pass if the leads look real and on-target with contactable details, blanks used honestly instead of fabricated emails. Fail obvious padding, off-target businesses, or made-up contact info. Spot-check a couple of entries for plausibility.',
        'accepted_formats' => ['file'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'A blank cell is honest, a made-up email is a fireable mistake. Verify each contact detail on the real website or page, and leave it empty when you cannot confirm it.',
        'ai_leverage' => [
            'approach' => 'Use AI to plan where to look and to structure the sheet, but do the finding on the real sites yourself. AI will happily invent plausible emails, so treat anything it hands you as unverified until you check it.',
            'prompt' => "I am building a cold-outreach lead list of {count} {target_businesses} in {location}.\nColumns I need: {columns}.\nSuggest where I should look to find and verify these leads, and give me a blank table with those column headers to fill in.\nRemind me not to include any contact detail I cannot verify on the real website or page.",
        ],
    ],
    [
        'order' => 4,
        'title' => 'Turn raw sales data into a summary tab',
        'brief' => 'A client, Ms. Aquino, runs a small milk tea shop and sends you three months of daily sales as a long raw list. She does not want to read 90 rows. Build a spreadsheet with the raw data on one tab and a summary tab that answers her real questions: total sales per month, best and worst selling days, and the top few products. Upload the file so the summary is easy to read at a glance.',
        'rubric' => [
            ['criterion' => 'Accurate calculations', 'weight' => 40, 'what_good_looks_like' => 'Totals and rankings are computed correctly from the raw data with no arithmetic errors.'],
            ['criterion' => 'Useful summary', 'weight' => 35, 'what_good_looks_like' => 'The summary answers what Ms. Aquino asked and surfaces the numbers she would care about.'],
            ['criterion' => 'Readable layout', 'weight' => 25, 'what_good_looks_like' => 'The summary tab is clear at a glance with labelled figures, separate from the raw data.'],
        ],
        'reference_notes' => 'Pass if the numbers are correct and the summary genuinely saves the client from reading the raw rows. Verify a total or two against the source. Fail wrong math, a summary that just restates raw data, or figures with no labels.',
        'accepted_formats' => ['file'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'Use real formulas like SUMIF so the totals stay correct if the data changes, and check one month by hand to prove the math. The summary should answer her questions, not just repeat the rows in a different place.',
        'ai_leverage' => [
            'approach' => 'Ask AI which spreadsheet formulas to use for each summary figure, then build and verify the numbers yourself. It is a formula tutor here, not the source of the totals.',
            'prompt' => "I have {months} of daily sales data in a spreadsheet with these columns: {columns}.\nI need a summary tab showing total sales per month, best and worst selling days, and the top products.\nTell me the exact spreadsheet formulas to use for each of those, step by step, so the summary updates if the raw data changes. I will build and double-check the numbers myself.",
        ],
    ],
    [
        'order' => 5,
        'title' => 'Write a research summary with sources',
        'brief' => 'A client named Joyce is deciding whether to add an online booking tool to her salon and asks you to research her options. Compare three booking tools that suit a small salon and write a concise summary she can read in a few minutes. Cover pricing, key features, and one clear recommendation with your reasoning, and cite where each fact came from so she can check it. Submit your summary as text with the sources included.',
        'rubric' => [
            ['criterion' => 'Accurate, sourced facts', 'weight' => 35, 'what_good_looks_like' => 'Claims about pricing and features are correct and each is tied to a named source Joyce can check.'],
            ['criterion' => 'Clear recommendation', 'weight' => 30, 'what_good_looks_like' => 'One tool is recommended with reasoning that connects to a small salon like Joyce\'s.'],
            ['criterion' => 'Conciseness', 'weight' => 20, 'what_good_looks_like' => 'The summary is tight and skimmable, a few minutes of reading, not a data dump.'],
            ['criterion' => 'Organisation', 'weight' => 15, 'what_good_looks_like' => 'The three tools are laid out so they are easy to compare side by side.'],
        ],
        'reference_notes' => 'Pass if the summary is decision-ready: correct sourced facts, a reasoned recommendation, and a length a busy owner would actually read. Fail unsourced claims, no clear pick, or a padded write-up. Sources can be links or named products and pages; the point is verifiability.',
        'accepted_formats' => ['text'],
        'difficulty' => 'hard',
        'xp_reward' => 200,
        'tip' => 'Pricing pages change often, so open each tool\'s real site and confirm the numbers yourself, then cite that page. End with one clear pick and a reason that fits a small salon, because Joyce wants a decision, not a menu.',
        'ai_leverage' => [
            'approach' => 'AI is a strong research starting point, but its pricing and features can be out of date or wrong. Use it to shortlist tools and shape the structure, then verify every fact on the official source before you cite it.',
            'prompt' => "I am researching {tool_category} for a {business_type}.\nSuggest three well-known options that suit a small business, and for each list what to check: pricing tiers, key features, and best-fit use case.\nGive me a side-by-side comparison layout I can fill in.\nRemind me to confirm every price and feature on the official website before I cite it, because your info may be outdated.",
        ],
    ],
];
