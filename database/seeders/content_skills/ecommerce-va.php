<?php

/*
 * Authored skill course: lessons for the "ecommerce-va" niche.
 * Course meta (title, subtitle, icon, order) comes from config/skills.php.
 * Each lesson: order, title, brief, rubric (weights sum to 100),
 * reference_notes (grader-only), accepted_formats, difficulty, xp_reward,
 * tip (learner-facing coaching), ai_leverage (approach + copyable starter prompt).
 */

return [
    [
        'order' => 1,
        'title' => 'Write a product listing that sells',
        'brief' => 'You support Kumot & Co., a small Shopee and Lazada store based in Cebu that sells cotton bedsheets. The owner, Marites, just added a new item: a queen-size 4-piece bedsheet set in sage green, 100% cotton, fitted sheet plus two pillowcases, machine washable, priced at 899 pesos. She hands you the raw specs and asks you to write the full listing. Submit a title, a short description, and a bulleted list of key features that a shopper can skim on their phone.',
        'rubric' => [
            ['criterion' => 'Complete and accurate listing', 'weight' => 40, 'what_good_looks_like' => 'Includes a searchable title, a description, and feature bullets that all match the specs given without inventing details.'],
            ['criterion' => 'Shopper-friendly and scannable', 'weight' => 35, 'what_good_looks_like' => 'Bullets are short and lead with the benefit, and the copy reads well on a small screen instead of being one dense paragraph.'],
            ['criterion' => 'Clean writing and formatting', 'weight' => 25, 'what_good_looks_like' => 'No spelling or grammar errors, consistent capitalization, and the price is stated clearly.'],
        ],
        'reference_notes' => 'A pass shows the trainee can turn dry specs into copy a real shopper would understand and act on. Fail if they invent specs not provided (fake thread count, wrong material), dump everything into one paragraph with no scannable bullets, or leave out any of the three required parts. Slightly clunky phrasing is fine at this level as long as the facts are right and the listing is usable as-is.',
        'accepted_formats' => ['text'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Put the words shoppers actually search, like queen size and cotton, right in the title. Keep bullets short and benefit-first, and only use the specs Marites gave you, because a fake thread count breaks trust.',
        'ai_leverage' => [
            'approach' => 'Feed AI the exact specs and ask for a title, description, and bullets, then check every line matches the specs so it did not invent a material or number.',
            'prompt' => "Write a marketplace product listing for {product} sold by {store_name}.\nUse only these specs: {specs}. Price: {price}.\nGive me a searchable title, a short description, and 4 to 6 short benefit-first bullets a shopper can skim on a phone.\nDo not invent any spec I did not provide.",
        ],
    ],
    [
        'order' => 2,
        'title' => 'Send an order confirmation message',
        'brief' => 'You handle customer messages for Baguio Brew, an online coffee store that sells roasted beans through Instagram and a simple order form. A customer named Joana Reyes just placed order #10432: two 250g bags of medium roast at 380 pesos each, for pickup at their Session Road branch this Saturday. Write the confirmation message you would send her so she knows the order went through and what happens next.',
        'rubric' => [
            ['criterion' => 'Confirms the key order details', 'weight' => 40, 'what_good_looks_like' => 'Restates the items, quantity, total, order number, and the pickup arrangement so the customer can double-check everything.'],
            ['criterion' => 'Clear next step', 'weight' => 30, 'what_good_looks_like' => 'Tells Joana exactly what to do next, such as when and where to pick up and what to bring or reply with.'],
            ['criterion' => 'Warm, professional tone', 'weight' => 30, 'what_good_looks_like' => 'Sounds like a friendly brand rep, not a robot, and stays polite and easy to read.'],
        ],
        'reference_notes' => 'A pass confirms the order clearly and leaves the customer with no unanswered questions about pickup. Check that the math is right (two bags at 380 = 760) and that the order number appears. Fail if details are missing or wrong, if there is no clear next step, or if the tone is cold or riddled with errors. It is fine if they add a small friendly touch as long as it stays professional.',
        'accepted_formats' => ['text'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Restate the order back to her so she can catch any mistake, and double-check the math yourself: two bags at 380 is 760. Then say plainly when and where to pick up.',
        'ai_leverage' => [
            'approach' => 'Let AI draft a warm confirmation from the order details, then verify the total and the pickup facts by hand, because a confident AI can still add the numbers wrong.',
            'prompt' => "Write a warm order confirmation message for {store_name}.\nOrder details: {order_details}. Total: {total}. Order number: {order_number}. Pickup or delivery: {fulfilment_details}.\nRestate the key details so the customer can double-check, give a clear next step, and keep a friendly, professional tone.",
        ],
    ],
    [
        'order' => 3,
        'title' => 'Handle a wrong-item order issue',
        'brief' => 'You do customer support for Tindahan Tech, a gadget accessories store on Shopee. A buyer, Marco Dela Cruz, messages upset: he ordered a black USB-C charging cable but received a white one. The correct black cable is in stock, and store policy lets you ship a free replacement once the customer sends a photo of what they got. Write the reply that calms Marco down, explains the fix, and keeps things moving without admitting fault in a way that hurts the store.',
        'rubric' => [
            ['criterion' => 'Acknowledges and empathizes', 'weight' => 30, 'what_good_looks_like' => 'Opens by recognizing the mistake and the customer\'s frustration before jumping to logistics.'],
            ['criterion' => 'Applies the policy correctly', 'weight' => 40, 'what_good_looks_like' => 'Offers the free replacement, asks for the required photo, and does not promise anything outside store policy.'],
            ['criterion' => 'De-escalates and stays professional', 'weight' => 30, 'what_good_looks_like' => 'Tone stays calm and reassuring, and the message leaves Marco feeling the problem will be handled.'],
        ],
        'reference_notes' => 'A pass balances empathy with correct policy: the trainee must both soothe the customer and ask for the photo before shipping the replacement. Fail if they skip the photo requirement, over-promise (refund plus replacement, express shipping the store never offered), get defensive, or ignore the emotional side entirely. Watch for trainees who are so apologetic they invent compensation the store never authorized.',
        'accepted_formats' => ['text'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'Empathise first, then apply the policy exactly: you still need that photo before shipping the replacement. Being extra sorry does not mean promising a refund or express shipping the store never offered.',
        'ai_leverage' => [
            'approach' => 'Give AI the store policy so the fix it writes stays inside the rules, and make sure it keeps the photo requirement instead of over-promising to smooth things over.',
            'prompt' => "Act as a support VA for {store_name} on Shopee.\nA customer received the wrong item: {issue}.\nStore policy: {policy}.\nWrite a reply that empathises first, then explains the fix per policy, and asks for {required_step} before we ship the replacement. Stay calm and do not promise anything outside the policy.",
        ],
    ],
    [
        'order' => 4,
        'title' => 'Write a shipping delay update',
        'brief' => "You manage order updates for Lola\'s Pantry, an online store selling homemade bottled sauces across Metro Manila. A batch of orders is delayed two days because the courier, J&T, had a backlog after a long weekend. One affected customer is Ella Santos, order #2087, who paid for her ube jam last Tuesday and expected it by today. Write the proactive update you would send her before she has to chase you, explaining the delay and the new timeline.",
        'rubric' => [
            ['criterion' => 'Explains the delay honestly', 'weight' => 35, 'what_good_looks_like' => 'States the reason for the delay plainly and gives a realistic new delivery window instead of a vague promise.'],
            ['criterion' => 'Proactive and reassuring', 'weight' => 35, 'what_good_looks_like' => 'Reaches out before the customer complains, and reassures her the order is on its way and being tracked.'],
            ['criterion' => 'Professional accountability', 'weight' => 30, 'what_good_looks_like' => 'Takes ownership on behalf of the store without over-apologizing or blaming the customer, and offers a way to follow up.'],
        ],
        'reference_notes' => 'A pass shows the trainee can deliver bad news early and clearly while keeping the customer\'s trust. Look for a specific new timeline (two more days, so by a named date) rather than "soon." Fail if the message is vague about the new date, throws the courier under the bus in an unprofessional way, or reads as reactive rather than proactive. A small goodwill gesture is acceptable but not required.',
        'accepted_formats' => ['text'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'Reach out before Ella has to chase you, and give a real new date, not "soon". Own it on behalf of the store without dumping all the blame on the courier.',
        'ai_leverage' => [
            'approach' => 'Ask AI to strike a reassuring, accountable tone, then plug in the real courier reason and the exact new delivery window yourself so the promise is honest.',
            'prompt' => "Write a proactive shipping delay update for {store_name}.\nCustomer {customer_name}, order {order_number}. Reason for delay: {reason}. New delivery window: {new_window}.\nReach out before they complain, explain the delay honestly, give the specific new date, and reassure them it is on the way. Take ownership without over-apologising or blaming the customer.",
        ],
    ],
    [
        'order' => 5,
        'title' => 'Build a clean inventory tracker',
        'brief' => 'You are the new VA for Sari-Sari Finds, a Lazada store selling home organizers, and the owner Ronnie hands you a messy list of 12 products scribbled in a chat: names, current stock counts, cost price, and selling price, with some entries missing a reorder point. Build a proper inventory spreadsheet from scratch that Ronnie can actually maintain. Include columns for SKU, product name, stock on hand, reorder point, cost, selling price, and a low-stock flag that shows when stock has dropped to or below the reorder point. Submit the spreadsheet file (xlsx or csv).',
        'rubric' => [
            ['criterion' => 'Complete and well-structured columns', 'weight' => 30, 'what_good_looks_like' => 'All required columns are present, clearly labeled, and each of the 12 products has its own row with data in the right place.'],
            ['criterion' => 'Working low-stock logic', 'weight' => 35, 'what_good_looks_like' => 'The low-stock flag uses a real formula comparing stock to reorder point, not values typed in by hand, and it flags the correct rows.'],
            ['criterion' => 'Data accuracy and consistency', 'weight' => 20, 'what_good_looks_like' => 'Numbers match the source list, SKUs follow one consistent format, and prices use a consistent number style.'],
            ['criterion' => 'Usable and maintainable', 'weight' => 15, 'what_good_looks_like' => 'A non-technical owner could add a new product or update a stock count without breaking the sheet, and missing reorder points are handled sensibly.'],
        ],
        'reference_notes' => 'This is the hard capstone and should be graded strictly. A pass requires a genuine spreadsheet file with a live formula driving the low-stock flag (IF comparing stock on hand to reorder point). Fail if the flag is manually typed, if columns are missing, if numbers do not match the source, or if SKUs are inconsistent or absent. Reward trainees who made a sensible call on the missing reorder points (a reasonable default plus a note) rather than leaving blanks. A plain CSV with correct structure can still pass even without a live formula only if the logic is clearly and correctly represented, but a formula-driven xlsx is the stronger deliverable.',
        'accepted_formats' => ['file', 'image'],
        'difficulty' => 'hard',
        'xp_reward' => 200,
        'tip' => 'Make the low-stock flag a real IF formula comparing stock on hand to the reorder point, never typed in by hand. For the missing reorder points, pick a sensible default and leave a note rather than a blank.',
        'ai_leverage' => [
            'approach' => 'Ask AI for the exact low-stock formula and a clean column layout, then build the sheet and confirm the flag fires on the right rows. AI writes the formula, you prove it works on the real data.',
            'prompt' => "Help me build an inventory tracker in a spreadsheet for {store_name}.\nColumns: SKU, product name, stock on hand, reorder point, cost, selling price, and a low-stock flag.\nGive me the exact formula for a low-stock flag that shows when stock on hand is at or below the reorder point, and tell me how to set up SKUs consistently.\nI have {count} products and some are missing a reorder point, suggest how to handle those sensibly.",
        ],
    ],
];
