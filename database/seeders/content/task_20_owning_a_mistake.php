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
    'slug' => 'owning-a-mistake',
    'order' => 23,
    'title' => 'You messed up. Now what?',
    'client_persona' => 'Bea, your main client, owner of an online boutique',
    'scenario_intro' => 'Bea trusts you with her weekly promo email. This week you had AI draft it, scheduled it to her full 4,000-person list, and it went out this morning. You never proofread the discount code.',
    'xp_reward' => 250,
    'onboarding_entry_key' => null,
    'is_gentle_opener' => false,
    'category' => 'comms',
    'beats' => [
        [
            'order' => 1,
            'client_message' => "Morning! Great open rate on the promo already 😊 Small thing, a couple of customers just messaged that the code SPRINGVP isn't working at checkout? Can you check the discount's actually switched on? Might just be a settings thing 🤞",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Alam mo na sa sarili mo kung ano talaga yung nangyari dito, hindi lang ito settings issue. Isipin mo kung paano mo sasabihin nang totoo at diretso, na may kasama nang aksyon.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "That's on me, Bea. The settings are fine, but the email went out with 'SPRINGVP' when the real code is 'SPRINGVIP'. I scheduled that AI-drafted copy without catching the typo. Fixing it right now: I'm creating 'SPRINGVP' as a duplicate of your 20% code so every code in the email works instantly. No customer loses out. I'll confirm the second it's live.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 2,
                    'body' => "Let me take a look at the discount settings and get it sorted. I'll have those customers taken care of shortly, probably just needs a quick toggle on my end. 👍",
                    'is_correct' => false,
                    'diagnostic' => 'You let her keep believing it was a settings glitch and moved to quietly patch your own error out of sight.',
                    'lesson' => [
                        'slug' => 'owning-a-mistake-dont-hide-it',
                        'title' => 'Hiding it is the second mistake',
                        'body' => "The moment you realise the error is yours, there's a powerful pull to fix it silently and let the client keep her wrong, gentler theory that it 'must be a settings thing.' If you patch it fast enough, maybe she never needs to know. It feels like you're sparing her worry.\n\nYou're not. You're taking a recoverable mistake and adding a cover-up to it. Clients almost always find out. A teammate mentions it, the numbers don't line up, a customer says 'the email had the wrong code.' And discovering you knew and stayed quiet does far more damage than the original typo ever could.\n\nTransparency is what makes a client able to keep trusting you with things. Owning it plainly and immediately says 'when something goes wrong on my watch, you'll hear it from me first.' That reliability is worth more than a clean record, and it's the only version that survives contact with the truth.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "Oh no. Bea, I am so, so sorry. This is entirely my fault and I feel absolutely sick about it. I can't believe I let this go out to the whole list. I'll completely understand if you've lost trust in me, I've really let you down and I'm just gutted. 😔",
                    'is_correct' => false,
                    'diagnostic' => 'You buried the actual fix under a wave of guilt, leaving her to comfort you instead of hearing what you\'re doing about it.',
                    'lesson' => [
                        'slug' => 'owning-a-mistake-dont-make-them-manage-your-feelings',
                        'title' => 'Own it, don\'t offload the guilt',
                        'body' => "There's a version of 'taking responsibility' that's really about relieving your own discomfort: the flood of I-feel-terrible, I'm-gutted, I-can't-believe-I-did-this. It reads as heartfelt, but notice who's now doing the work: the client, who has to stop worrying about her customers to reassure you that it's okay.\n\nIn the first minutes after a mistake, the client needs exactly two things: a clear statement that you own it, and evidence the fix is already moving. She does not need to know how bad you feel. Your feelings are real, but they're yours to manage, not hers.\n\nPlain accountability is calmer and stronger than dramatic apology: 'That's on me. Here's what I'm doing about it.' Save the emotion. The professional you're becoming absorbs the hit quietly and points all the energy at the fix.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Ah, I see what happened. The AI tool I used to draft the email generated the code wrong, must have dropped a letter. These tools aren't always reliable unfortunately. I'll get it flagged and look into fixing it.",
                    'is_correct' => false,
                    'diagnostic' => "You pinned the error on the tool you chose and didn't check, which reads as dodging rather than owning the outcome.",
                    'lesson' => [
                        'slug' => 'owning-a-mistake-own-the-outcome-not-the-tool',
                        'title' => 'The tool didn\'t send it, you did',
                        'body' => "When AI is involved, there's a ready-made scapegoat: 'the tool generated it wrong.' It even sounds true. But the client didn't hire the tool. She hired you, and you're the one who scheduled unreviewed output to her whole list. The AI drafted it; you published it.\n\nBlaming the tool tells the client something worrying about how you work: that when you use AI, no human is actually accountable for what goes out. That makes every future AI-assisted task feel like a gamble to her. Owning the outcome, regardless of how the error was produced, is what makes it safe for her to let you use these tools at all.\n\nThis is the heart of using AI responsibly. The tool is your assistant. It doesn't take the blame for you. Whatever it helps you make, you check, and you stand behind. 'That's on me, I didn't catch it' keeps you the reliable human in the loop, which is the entire reason you have the job.",
                    ],
                ],
            ],
        ],
        [
            'order' => 2,
            'client_message' => "Hang on, so the email itself had the wrong code? That went to all 4,000 people. That's not a settings thing, that's… not great, honestly. Now it looks like our codes don't even work. 😕",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Nagulat at medyo naiinis na si Bea, at may karapatan siya dun. Isipin mo paano ka mananatiling kalmado at nakatutok sa solusyon, imbes na mag-defensive o sobrang mag-sorry.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "I hear you, though to be fair, the open rate was actually really strong, and most people probably didn't even get as far as trying the code. It's likely a much smaller number than it feels like right now.",
                    'is_correct' => false,
                    'diagnostic' => "You reached for reasons it wasn't that bad, which reads as defending yourself instead of taking the hit.",
                    'lesson' => [
                        'slug' => 'owning-a-mistake-dont-get-defensive',
                        'title' => 'Don\'t argue the mistake down',
                        'body' => "When a client voices how bad the mistake feels, the reflex is to shrink it: it's fewer people than it looks, the open rate was great, probably no real harm. Each point may even be true. But stacked together in that moment, they land as 'it's not as bad as you think,' with you defending yourself while she's still absorbing the hit.\n\nMinimising, however gently, undercuts the ownership you just showed. It tells the client you're more focused on protecting your record than on how this affected her business. That's the moment goodwill leaks away.\n\nLet the mistake be as big as she feels it is. Agree with the impact, something like 'you're right, it went to everyone and that's not okay,' and move straight to the fix. Absorbing the discomfort without bargaining it down is what accountability actually feels like from the outside.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "You're completely right, and I'm so sorry. I've genuinely been beating myself up over this all morning. I hate that I've done this to you. I'd honestly understand if you'd rather not keep working with me after this.",
                    'is_correct' => false,
                    'diagnostic' => 'You spiralled back into apology and floated quitting, which forces her to reassure you in the middle of a live problem.',
                    'lesson' => [
                        'slug' => 'owning-a-mistake-stay-steady',
                        'title' => 'Steady is what she needs now',
                        'body' => "When a client is visibly annoyed, an over-apology, complete with 'I'd understand if you fired me,' can feel like the humble, honourable response. But offering your own head shifts the whole conversation onto your job security, and now the client has to stop dealing with her customers to manage your wobble.\n\nAn annoyed client is not asking whether you should quit. She's asking whether this is under control and whether you can be trusted to handle the fallout. Groveling answers a question she didn't ask and quietly signals that you fall apart under pressure, the opposite of what earns a second chance.\n\nThe steadying move is to acknowledge her frustration once, briefly, and stay locked on the fix. Calm competence in the hard moment is more reassuring than any amount of contrition. Show her the mistake rattled the work for an hour, not the person handling it.",
                    ],
                ],
                [
                    'order' => 3,
                    'body' => "You're right, it went to the full list and I own that. Here's where it stands: 'SPRINGVP' is now live as a duplicate of your 20% code, so every customer who typed the emailed code is getting the discount as we speak. I'm also drafting a short, upbeat follow-up ('good news, your code works, and here's an extra 48 hours') for your approval. Aim is that customers end up feeling looked after rather than let down.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 4,
                    'body' => "You're right, this is on me. What would you like me to do to fix it? I can send a correction email, or set up a new code, or whatever you'd prefer, just let me know how you want to handle it.",
                    'is_correct' => false,
                    'diagnostic' => 'You owned the error but handed the whole fix back to her, when the point of owning it is to arrive with the solution already moving.',
                    'lesson' => [
                        'slug' => 'owning-a-mistake-arrive-with-the-fix',
                        'title' => 'Owning it means bringing the fix',
                        'body' => "Saying 'this is on me, what would you like me to do?' feels like the deferential, respectful thing. But you've cleaned up half the job and left her the harder half: figuring out how to repair your mistake. That's more work landing on the client, at the worst possible moment, because of an error you made.\n\nReal ownership carries the solution with it. By now you know enough to act: make the emailed code valid, prepare a goodwill follow-up. Bring those as a plan she can approve or adjust in one line, rather than a blank question that puts the whole repair back in her lap.\n\nThink back to every task in this track: the client hired you to remove decisions, not add them. That's truest right after a mistake. Come with the fix already in motion, like 'here's what I'm doing, okay to proceed?', so owning it lightens her load instead of adding to it.",
                    ],
                ],
            ],
        ],
        [
            'order' => 3,
            'client_message' => "Okay, the duplicate code was a smart move, thank you for jumping on it. Send the follow-up, I like it. Let's just make sure something like this can't slip through again.",
            'scaffold_hint' => null,
            'tagalog_tip' => 'Gusto ni Bea ng kasiguraduhan na hindi na mauulit ito. Isipin mo kung anong konkretong sistema o hakbang ang talagang sasagip dito, hindi lang basta pangako na mag-iingat ka.',
            'options' => [
                [
                    'order' => 1,
                    'body' => "Absolutely, I promise I'll be much more careful from here on. This won't happen again, you have my word. 🙏",
                    'is_correct' => false,
                    'diagnostic' => "You offered a promise to 'be careful' with no actual mechanism, which is exactly what people say right before it happens again.",
                    'lesson' => [
                        'slug' => 'owning-a-mistake-a-promise-isnt-a-safeguard',
                        'title' => 'A promise isn\'t a safeguard',
                        'body' => "'I'll be more careful' is the most natural thing to say and the least useful. Carefulness isn't a system. It's a mood that fades by next Tuesday when you're busy and the email is scheduled and you're sure it's fine. The last version of you was trying to be careful too.\n\nWhat actually prevents a repeat is a concrete, repeatable step wired into the work: a specific check, at a specific point, that catches this exact class of error whether or not you're having a sharp day. 'I'll try harder' relies on willpower. A safeguard doesn't.\n\nWhen a client says 'make sure this can't happen again,' she's asking what will change in how you work, not how you feel about it. Give her a mechanism she can picture, and she can believe it. Give her a vow, and she just has to hope.",
                    ],
                ],
                [
                    'order' => 2,
                    'body' => "Follow-up's scheduled. Here's the guardrail: anything AI helped me draft, I now check every code, link and date against your source doc before it's cleared. I never treat AI output as ready to send. And for anything going to the full list, I'll send you a test preview for a quick thumbs-up before it goes live. That's the exact gap that let this through, closed.",
                    'is_correct' => true,
                    'diagnostic' => null,
                    'lesson' => null,
                ],
                [
                    'order' => 3,
                    'body' => "Lesson learned. I'm going to stop using AI for your emails completely and write every single one by hand from now on, and triple-check each one three times before it goes out. Never again.",
                    'is_correct' => false,
                    'diagnostic' => 'You threw out a useful tool and promised an unsustainable ritual, overcorrecting instead of fixing the one step that actually failed.',
                    'lesson' => [
                        'slug' => 'owning-a-mistake-fix-the-gap-not-everything',
                        'title' => 'Fix the gap, not the whole toolbox',
                        'body' => "After a mistake, a dramatic overcorrection feels like proof you're serious: swear off AI entirely, promise to check everything three times forever. It signals remorse. But it also throws away a genuinely useful tool over a failure that wasn't the tool's fault. The real cause was the missing review step. And 'triple-check everything three times' is a ritual no busy person actually sustains, so it quietly lapses and leaves you unprotected again.\n\nThe skill is diagnosing precisely which step failed and reinforcing just that step. Here the problem wasn't 'used AI.' It was 'shipped AI output without verifying the details.' The targeted fix is a verification pass, not abandoning the assistant that saves you hours.\n\nUsing AI responsibly is the whole lesson of this track: keep the leverage, add the human check that makes it safe. Precise fixes hold because they're proportionate and doable. Overcorrections collapse under their own weight, and then the next mistake finds the same open gap.",
                    ],
                ],
                [
                    'order' => 4,
                    'body' => "Sounds good, going forward, could you read and approve every promo email before I schedule it? That way you'll always catch anything I miss before it goes out.",
                    'is_correct' => false,
                    'diagnostic' => 'You turned your safeguard into her workload, handing the client the checking job she pays you to do.',
                    'lesson' => [
                        'slug' => 'owning-a-mistake-dont-outsource-the-safeguard',
                        'title' => 'Don\'t make your safeguard her job',
                        'body' => "Asking the client to review every email before it goes out sounds collaborative, and it does add a safety net. But look at where the net hangs: over her desk. You've responded to your mistake by giving the client a recurring task, proofreading your work, which is precisely the load she hired you to carry.\n\nThere's a real distinction between a light client checkpoint you offer for high-stakes sends and offloading the routine catching of your own errors onto her. The first is you owning the process and inviting a final glance; the second is you outsourcing your quality control upward. One builds trust, the other spends it.\n\nYour safeguards should sit with you. Verify against the source, preview before full-list sends, catch your own slips. Offer the client a final thumbs-up on the big ones if you like, but the checking is yours. That's the difference between someone who takes work off the plate and someone who quietly hands it back.",
                    ],
                ],
            ],
        ],
    ],
];
