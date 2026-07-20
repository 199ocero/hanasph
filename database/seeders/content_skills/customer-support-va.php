<?php

/*
 * Authored skill course: lessons for the "customer-support-va" niche.
 * Course meta (title, subtitle, icon, order) comes from config/skills.php.
 * Each lesson: order, title, brief, rubric (weights sum to 100),
 * reference_notes (grader-only), accepted_formats, difficulty, xp_reward,
 * tip (learner-facing coaching), ai_leverage (approach + copyable starter prompt).
 */

return [
    [
        'order' => 1,
        'title' => 'Answer a simple where-is-my-order ticket',
        'brief' => "You support a small online plant shop. A customer named Grace emails: \"Hi, I ordered a monstera 5 days ago (order #4821) and I still haven't gotten a shipping update. Can you check?\" Tracking shows the package left the warehouse yesterday and is due in 2 days. Write the full reply you would send her.",
        'rubric' => [
            ['criterion' => 'Direct answer', 'weight' => 40, 'what_good_looks_like' => 'States clearly that the order shipped yesterday and gives the expected arrival, near the top.'],
            ['criterion' => 'Warm tone', 'weight' => 30, 'what_good_looks_like' => 'Sounds like a helpful person, greets Grace by name, and thanks her for reaching out.'],
            ['criterion' => 'Next step', 'weight' => 30, 'what_good_looks_like' => 'Tells her where to track it or invites her to reply if it does not arrive on time.'],
        ],
        'reference_notes' => 'Pass: leads with the actual status instead of burying it under apologies, uses the order number, and closes with a clear next step. Fail: vague ("we are looking into it"), no arrival window, or robotic phrasing that ignores her name.',
        'accepted_formats' => ['text'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Answer her actual question in the first two lines: it shipped yesterday and lands in about two days. Everything after that is warmth and next steps, so do not bury the good news under apologies.',
        'ai_leverage' => [
            'approach' => 'Feed AI the ticket and the real tracking facts and let it draft a warm reply, then check that every detail it wrote matches what tracking actually says before you send.',
            'prompt' => "Act as a friendly customer support VA for {business_name}.\nA customer named {customer_name} asked where their order is.\nFacts I can share: order {order_number} shipped {ship_status}, expected arrival {arrival_window}.\nWrite a short, warm reply that leads with the status, greets them by name, and ends with a clear next step (how to track it or when to reply back).",
        ],
    ],
    [
        'order' => 2,
        'title' => 'Reply to an in-policy refund request',
        'brief' => 'You support a subscription meal-kit company. The refund policy: full refund within 14 days of the charge, no questions asked, back to the original card in 5 to 7 business days. A customer, Daniel, writes: "I got charged $59 three days ago but I meant to cancel. Can I get my money back?" He qualifies. Write the reply that approves his refund and sets expectations.',
        'rubric' => [
            ['criterion' => 'Approves clearly', 'weight' => 40, 'what_good_looks_like' => 'Confirms the refund is approved without making Daniel ask twice or justify himself.'],
            ['criterion' => 'Follows policy', 'weight' => 30, 'what_good_looks_like' => 'States the correct amount, the card it returns to, and the 5 to 7 business day window.'],
            ['criterion' => 'Kind and calm', 'weight' => 30, 'what_good_looks_like' => 'Reassuring rather than grudging, and does not guilt-trip or upsell him.'],
        ],
        'reference_notes' => 'Pass: says yes plainly, quotes the refund amount and timeframe from policy, and stays friendly. Fail: adds friction (asks for a reason to process an in-policy refund), gets the timeframe wrong, or slips in a hard retention pitch that reads as pushy.',
        'accepted_formats' => ['text'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'He qualifies, so say yes in the first sentence. Then state the exact amount, the card, and the 5 to 7 day window. Do not make him justify himself or slip in an upsell.',
        'ai_leverage' => [
            'approach' => 'Give AI the refund policy word for word so the amount and timeframe it writes are correct, then make sure it does not add friction the policy never asked for.',
            'prompt' => "Act as a calm, kind support VA for {business_name}.\nRefund policy: {refund_policy}.\nCustomer {customer_name} qualifies and wants their money back for a charge of {amount}.\nWrite a reply that approves the refund in the first line, states the amount, the card it returns to, and the timeframe from the policy, and stays warm. Do not ask them to justify it and do not upsell.",
        ],
    ],
    [
        'order' => 3,
        'title' => 'De-escalate a furious customer',
        'brief' => 'You support a software tool that had an outage this morning. A customer, Meredith, writes in all caps: "THIRD TIME THIS MONTH YOUR APP IS DOWN. I run my whole business on this and I just lost a client because of you. Absolutely unacceptable." The outage was real and is now fixed. Write the reply that calms her down and rebuilds trust.',
        'rubric' => [
            ['criterion' => 'Acknowledges the anger', 'weight' => 35, 'what_good_looks_like' => 'Names the impact she described (lost client, repeated outages) before offering any fix.'],
            ['criterion' => 'Owns it honestly', 'weight' => 35, 'what_good_looks_like' => 'Takes real responsibility for the outage without excuses, and does not hide behind jargon.'],
            ['criterion' => 'Concrete follow-up', 'weight' => 30, 'what_good_looks_like' => 'Offers a specific action such as an update on the fix, a credit, or a direct point of contact.'],
        ],
        'reference_notes' => 'Pass: matches the emotional weight, validates that the frustration is fair, avoids defensive language, and gives something concrete. Fail: opens with policy or a canned "we apologize for any inconvenience", argues with her, or over-promises that it will never happen again.',
        'accepted_formats' => ['text'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'Name what this actually cost her, the lost client and the repeated downtime, before you mention any fix. A canned "we apologize for any inconvenience" will make her angrier.',
        'ai_leverage' => [
            'approach' => 'When your own draft sounds defensive, ask AI to rewrite it with more genuine empathy and no corporate hedging. You still decide what the company can honestly promise.',
            'prompt' => "I am a support VA replying to a furious customer of {business_name}.\nThey wrote: \"{their_message}\".\nContext: {what_happened_and_status}.\nWrite a reply that first names the real impact on them, owns the problem honestly with no jargon or excuses, and offers one concrete follow-up ({concrete_action}).\nAvoid canned apology phrases and do not promise it will never happen again.",
        ],
    ],
    [
        'order' => 4,
        'title' => 'Handle a refund request that falls outside policy',
        'brief' => 'Same meal-kit company as before. The refund window is 14 days. A customer, Kenji, writes 22 days after his charge asking for a full refund because he forgot to cancel and barely used it. He is past the window, so a full refund is not automatic, but he is polite and clearly a long-time subscriber. Write the reply that holds the policy while keeping him as a happy customer.',
        'rubric' => [
            ['criterion' => 'Says no with care', 'weight' => 35, 'what_good_looks_like' => 'Declines the automatic full refund clearly and kindly, without hiding behind the rules coldly.'],
            ['criterion' => 'Explains the why', 'weight' => 25, 'what_good_looks_like' => 'Gives the reason (the 14-day window) in plain language so it feels fair, not arbitrary.'],
            ['criterion' => 'Offers a middle path', 'weight' => 25, 'what_good_looks_like' => 'Proposes something real such as a partial credit, a pause, or a discount on the next box.'],
            ['criterion' => 'Keeps the door open', 'weight' => 15, 'what_good_looks_like' => 'Ends warmly so Kenji still feels valued and likely to stay.'],
        ],
        'reference_notes' => 'Pass: firm on the policy but human about it, explains the boundary, and offers a good-faith alternative instead of a flat rejection. Fail: caves and grants a full refund against policy, or refuses bluntly with a copy-pasted rule and no alternative.',
        'accepted_formats' => ['text'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'A flat "sorry, policy" loses a loyal customer, and caving trains everyone to ignore the window. Hold the line, explain the 14-day reason plainly, then offer a real middle path like a partial credit.',
        'ai_leverage' => [
            'approach' => 'Ask AI to brainstorm fair middle-ground offers you could propose, then choose one you know the client actually allows before you put it in writing.',
            'prompt' => "Act as a warm support VA for {business_name}.\nPolicy: {refund_policy}. The customer {customer_name} is outside the window ({situation}) but is polite and loyal.\nWrite a reply that kindly declines the automatic full refund, explains the reason in plain language, and offers a fair middle path ({possible_alternative}). End warmly so they still feel valued.",
        ],
    ],
    [
        'order' => 5,
        'title' => 'Build a reusable macro set for the support inbox',
        'brief' => 'The plant shop wants to speed up its inbox. Write a set of 5 reusable macros (canned responses) the team can drop into tickets and lightly edit. Cover these situations: order status, damaged item on arrival, in-policy refund, out-of-stock item, and a general thank-you-for-your-patience holding reply. For each macro, give it a short name and include placeholders like [Customer Name] and [Order #] where details get filled in.',
        'rubric' => [
            ['criterion' => 'Coverage', 'weight' => 30, 'what_good_looks_like' => 'All 5 requested situations are present and each macro fits its situation.'],
            ['criterion' => 'Reusable structure', 'weight' => 30, 'what_good_looks_like' => 'Each has a clear name and uses placeholders so an agent can adapt it in seconds.'],
            ['criterion' => 'Consistent voice', 'weight' => 25, 'what_good_looks_like' => 'All 5 sound like the same warm, plain-spoken brand rather than 5 different writers.'],
            ['criterion' => 'Ready to send', 'weight' => 15, 'what_good_looks_like' => 'Each macro is complete enough to send after filling placeholders, with a greeting and a close.'],
        ],
        'reference_notes' => 'Pass: 5 distinct, well-named macros with sensible placeholders, a shared tone, and no situation left generic or missing. Fail: fewer than 5, macros that overlap or blur together, no placeholders, or wildly inconsistent voice across them.',
        'accepted_formats' => ['text'],
        'difficulty' => 'hard',
        'xp_reward' => 200,
        'tip' => 'Write all 5 in one sitting so they share a voice, and put placeholders like [Customer Name] and [Order #] exactly where a rushing agent would forget to personalise. Consistency is what makes a macro set feel like one brand.',
        'ai_leverage' => [
            'approach' => 'This is a perfect AI task: draft all five macros at once so the tone stays consistent, then tighten each one and confirm the placeholders match what your ticket system uses.',
            'prompt' => "Act as a support lead for {business_name}, a {business_type}.\nWrite 5 reusable support macros the team can drop into tickets and lightly edit.\nCover: order status, damaged item on arrival, in-policy refund, out-of-stock item, and a general thank-you-for-your-patience holding reply.\nGive each macro a short name, keep one warm consistent brand voice across all 5, and use placeholders like [Customer Name] and [Order #] where details get filled in.",
        ],
    ],
];
