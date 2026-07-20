<?php

/*
 * Authored skill course: lessons for the "content-writing-va" niche.
 * Course meta (title, subtitle, icon, order) comes from config/skills.php.
 * Each lesson: order, title, brief, rubric (weights sum to 100),
 * reference_notes (grader-only), accepted_formats, difficulty, xp_reward,
 * tip (learner-facing coaching), ai_leverage (approach + copyable starter prompt).
 */

return [
    [
        'order' => 1,
        'title' => 'Write a Product Description That Sells',
        'brief' => 'Camille runs Aruga Skincare, a small Cebu-based shop selling a calamansi brightening face serum. She sends you the raw specs: 30ml bottle, made with local calamansi extract and niacinamide, targets dull and uneven skin, priced at 450 pesos. Write a single product description for her Shopify listing that would make a first-time shopper add it to cart. Submit the finished description as text.',
        'rubric' => [
            ['criterion' => 'Leads with a benefit, not just features', 'weight' => 40, 'what_good_looks_like' => 'The opening lines tell the shopper what changes for their skin before listing ingredients or specs.'],
            ['criterion' => 'Accurate to the brief', 'weight' => 30, 'what_good_looks_like' => 'Every fact stated (size, ingredients, price, use case) matches what Camille provided, with nothing invented.'],
            ['criterion' => 'Clean, scannable, and on-brand', 'weight' => 30, 'what_good_looks_like' => 'The text reads smoothly for a skincare buyer, uses short paragraphs or bullets, and has no spelling or grammar errors.'],
        ],
        'reference_notes' => 'A pass opens with a customer outcome (brighter, more even skin) and weaves the calamansi and niacinamide in as proof rather than dumping a spec sheet. A fail is a flat list of attributes, invents claims Camille never gave (like "dermatologist tested"), or contradicts the brief on price or size. Watch for medical overclaims; brightening is fine, "cures" is not.',
        'accepted_formats' => ['text'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Open with what changes for the shopper\'s skin, then bring in calamansi and niacinamide as proof. Stick to the specs Camille gave you, because inventing claims like "dermatologist tested" is how listings get pulled.',
        'ai_leverage' => [
            'approach' => 'Give AI the exact specs and ask it to lead with benefits, then fact-check every line against the brief so it did not invent a claim or change the price.',
            'prompt' => "Write a Shopify product description for {product} from {brand}.\nSpecs I gave you, use only these: {specs}.\nOpen with the benefit to the shopper, then support it with the ingredients. Keep it scannable with short lines. Do not invent any claim I did not provide, and avoid medical overclaims like \"cures\".",
        ],
    ],
    [
        'order' => 2,
        'title' => 'Hook a Reader With a Blog Intro',
        'brief' => 'Ledgerly is a bookkeeping app for freelancers. The content lead, Marco, assigns you the intro for a post titled "5 Tax Mistakes Freelancers Make (and How to Avoid Them)." He wants the first 100 to 150 words only: enough to pull a stressed freelancer past the first scroll and into the article. Submit just the intro as text.',
        'rubric' => [
            ['criterion' => 'Opens with a hook that earns attention', 'weight' => 40, 'what_good_looks_like' => 'The first sentence names a real pain or moment a freelancer recognizes, instead of a generic definition of taxes.'],
            ['criterion' => 'Sets up the payoff of the article', 'weight' => 30, 'what_good_looks_like' => 'By the end of the intro the reader knows what they will gain and why reading on is worth their time.'],
            ['criterion' => 'Tight and correctly scoped', 'weight' => 30, 'what_good_looks_like' => 'Stays within roughly 100 to 150 words, keeps sentences readable, and does not drift into the body content or bullet the five mistakes.'],
        ],
        'reference_notes' => 'A pass grabs the reader emotionally in line one, for example the dread of tax season or a surprise bill, then promises a concrete fix. A fail opens with a dictionary-style definition, buries the hook under throat-clearing, blows past the word count, or already starts listing the mistakes the body is meant to cover. Reward a clear voice over clever wordplay that says nothing.',
        'accepted_formats' => ['text'],
        'difficulty' => 'easy',
        'xp_reward' => 100,
        'tip' => 'Start on a moment the reader dreads, like a surprise tax bill, not a definition of taxes. Promise the payoff, then stop, because the intro only has to earn the next scroll and stay under 150 words.',
        'ai_leverage' => [
            'approach' => 'Have AI generate a few different hook angles, since the first line is the hardest part, then pick the one that feels most real and tighten it to the word count yourself.',
            'prompt' => "Write 3 different opening hooks for a blog intro titled \"{article_title}\" for {audience}.\nEach hook should start on a real pain or moment the reader recognises, then set up the payoff of the article.\nKeep the full intro option to 100 to 150 words. Do not list the article's main points, that is for the body.",
        ],
    ],
    [
        'order' => 3,
        'title' => 'Write a Promotional Email That Gets Clicks',
        'brief' => 'Kape Kalye is a Manila specialty coffee roaster running a 3-day flash sale: 20 percent off all beans with the code KALYE20. The owner, Bea, wants one promotional email to her subscriber list announcing it. Write the full email including a subject line and a clear call to action to the shop. Submit the subject line and body together as text.',
        'rubric' => [
            ['criterion' => 'Subject line that earns the open', 'weight' => 25, 'what_good_looks_like' => 'The subject is specific and tempting, hints at the offer or urgency, and avoids spammy all-caps or empty hype.'],
            ['criterion' => 'Body drives to one clear action', 'weight' => 35, 'what_good_looks_like' => 'The email builds a reason to buy now, states the offer and code plainly, and points to a single obvious call to action.'],
            ['criterion' => 'Honest urgency around the 3-day window', 'weight' => 20, 'what_good_looks_like' => 'The deadline is communicated so it motivates without false scarcity or misleading the reader.'],
            ['criterion' => 'Voice and polish fit a coffee brand', 'weight' => 20, 'what_good_looks_like' => 'The tone feels warm and human for Kape Kalye, and the copy is free of typos and awkward phrasing.'],
        ],
        'reference_notes' => 'A pass has a subject worth opening, a body that gives one strong reason to act, the correct code and discount, and a single dominant call to action rather than five competing links. A fail buries the offer, forgets the code or deadline, stuffs the email with multiple unrelated asks, or writes a subject line that reads like generic marketing noise. Fabricated details (wrong discount, invented products) should cap the score.',
        'accepted_formats' => ['text'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'Pick one action and point the whole email at it. Get the code KALYE20 and the 3-day window right, and use the deadline for honest urgency rather than five competing links.',
        'ai_leverage' => [
            'approach' => 'Draft subject-line options with AI to test what earns the open, then write or tighten the body so the offer, code, and deadline are exactly right, since those are facts AI can get wrong.',
            'prompt' => "Write a promotional email for {business_name}, a {business_type}.\nOffer: {offer} using code {promo_code}, running for {time_window}.\nGive me 3 subject line options, then one email body that builds a reason to buy now, states the offer and code plainly, and drives to a single call to action ({call_to_action}).\nWarm, human tone. Use honest urgency around the deadline, no fake scarcity.",
        ],
    ],
    [
        'order' => 4,
        'title' => 'Draft a Short Blog Post That Ranks and Reads',
        'brief' => 'Tahanan Pet Supplies, a PH online store shipping nationwide, wants a short blog post titled "How to Transition Your Dog to a New Food Without the Upset Stomach." The marketing manager, Ivan, asks for a complete piece of roughly 350 to 450 words with an intro, two or three clear sections with subheadings, and a soft mention of their dog food range at the end. Submit the full post as text.',
        'rubric' => [
            ['criterion' => 'Genuinely useful and accurate advice', 'weight' => 35, 'what_good_looks_like' => 'The steps for transitioning a dog to new food are sensible and safe, and a real dog owner could follow them.'],
            ['criterion' => 'Clear structure with working subheadings', 'weight' => 30, 'what_good_looks_like' => 'The post has an intro, two or three logically ordered sections with descriptive subheadings, and a natural close.'],
            ['criterion' => 'Soft, non-pushy product mention', 'weight' => 20, 'what_good_looks_like' => 'The Tahanan range is mentioned once at the end in a way that helps the reader rather than hijacking the article.'],
            ['criterion' => 'Length and polish on target', 'weight' => 15, 'what_good_looks_like' => 'The piece lands near 350 to 450 words and is clean, readable, and free of obvious errors.'],
        ],
        'reference_notes' => 'A pass reads like a helpful article first and a store second: solid transition advice (gradual mixing over about a week, watching for signs of upset), organized under real subheadings, with the product folded in gently at the close. A fail gives thin or unsafe advice, reads as one undivided block, pitches the store from the first line, or ignores the word range badly. Judge helpfulness above keyword density; do not reward keyword stuffing.',
        'accepted_formats' => ['text'],
        'difficulty' => 'medium',
        'xp_reward' => 150,
        'tip' => 'Be a helpful article first and a store second. Give real transition advice, like mixing in the new food gradually over about a week, and save the one soft product mention for the very end.',
        'ai_leverage' => [
            'approach' => 'AI can draft the structure and first pass fast, but pet-food advice must be safe, so verify the steps against a reputable source before you submit. You own the accuracy, AI just speeds the writing.',
            'prompt' => "Write a helpful blog post titled \"{article_title}\" for {business_name}.\nRoughly {word_range} words: an intro, two or three sections with descriptive subheadings, and a natural close.\nMake the advice genuinely useful and safe for a real owner to follow. Mention {product_range} softly once at the end, not before. Helpful first, promotional second.",
        ],
    ],
    [
        'order' => 5,
        'title' => 'Write the Hero Section of a Landing Page',
        'brief' => 'Rosa is launching Umpisa, a 4-week online course that teaches aspiring Filipino virtual assistants how to land their first client. She needs the hero section of the sales landing page written for total beginners who feel unsure they can do it. Write a headline, a supporting subheadline, three to four benefit-focused bullet points, a primary call-to-action button label, and a one or two sentence trust line that eases doubt. Submit all of it as text, clearly labeled by part.',
        'rubric' => [
            ['criterion' => 'Headline promises a clear, specific outcome', 'weight' => 30, 'what_good_looks_like' => 'The headline speaks to the beginner and makes the payoff of the course concrete instead of vague or clever for its own sake.'],
            ['criterion' => 'Subheadline and bullets sell benefits', 'weight' => 30, 'what_good_looks_like' => 'The subheadline supports the headline and each bullet expresses a reader benefit rather than a dry feature or module name.'],
            ['criterion' => 'CTA and trust line reduce hesitation', 'weight' => 25, 'what_good_looks_like' => 'The button label is action-oriented and specific, and the trust line addresses a real doubt a nervous beginner would have.'],
            ['criterion' => 'Cohesive, complete, and polished', 'weight' => 15, 'what_good_looks_like' => 'All requested parts are present and labeled, the voice stays consistent, and the copy is error-free.'],
        ],
        'reference_notes' => 'A pass delivers every requested element, labeled, with a headline aimed squarely at an anxious beginner and a promise they can picture (landing a first client). Bullets translate features into outcomes, the CTA reads like an action such as "Enroll and start week one" rather than a bland "Submit," and the trust line disarms a genuine fear (no experience, fear of failing). A fail omits parts, writes a headline that could belong to any course, lists features instead of benefits, uses a weak generic button, or invents unverifiable claims like fake student counts. Coherence across the whole section matters as much as any single line.',
        'accepted_formats' => ['text'],
        'difficulty' => 'hard',
        'xp_reward' => 200,
        'tip' => 'Write the whole hero to one nervous beginner who doubts they can do it. Turn every feature into an outcome they can picture, like landing a first client, and let the trust line answer their real fear head on.',
        'ai_leverage' => [
            'approach' => 'Ask AI for several headline and bullet variations so you have options to choose from, then assemble the strongest hero yourself and cut anything vague or any claim you cannot back up.',
            'prompt' => "Write hero-section copy for a landing page for {product}, aimed at {audience} who feel unsure they can do it.\nGive me: 3 headline options, a supporting subheadline, 3 to 4 benefit-focused bullets, a specific call-to-action button label, and a one to two sentence trust line that eases a real beginner fear.\nLabel each part. Turn features into outcomes. Do not invent proof like student counts.",
        ],
    ],
];
