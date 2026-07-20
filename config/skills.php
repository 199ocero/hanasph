<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Course Recommendations
    |--------------------------------------------------------------------------
    |
    | Maps the skills a user selects during onboarding (users.va_skills) to the
    | skill_key of one or more courses that should be badged "Recommended for
    | you" in the sidebar catalog. Every course remains startable regardless —
    | this only drives recommendations, never access.
    |
    */

    'recommendations' => [
        'social_media' => ['social-media-va'],
        'design' => ['social-media-va'],
        'admin' => ['admin-va'],
        'project_management' => ['admin-va'],
        'data_entry' => ['admin-va'],
        'customer_support' => ['customer-support-va'],
        'writing' => ['content-writing-va'],
        'tech' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Niche Catalog
    |--------------------------------------------------------------------------
    |
    | The VA niches the catalog covers. `skills:generate {key}` uses `focus` to
    | author a draft course; `title`, `subtitle`, `icon`, and `order` describe
    | the course itself. All niches can be generated at once with `--all`.
    |
    */

    'catalog' => [
        'social-media-va' => [
            'title' => 'Social Media VA',
            'subtitle' => 'Captions, community, and content that clients love.',
            'icon' => 'Megaphone',
            'order' => 1,
            'focus' => 'social media management — captions, comment replies, and content calendars',
        ],
        'admin-va' => [
            'title' => 'Admin / Executive VA',
            'subtitle' => 'Inboxes, calendars, docs, and clean spreadsheets.',
            'icon' => 'ClipboardList',
            'order' => 2,
            'focus' => 'executive admin — professional emails, meeting notes, scheduling, and spreadsheet clean-up',
        ],
        'customer-support-va' => [
            'title' => 'Customer Support VA',
            'subtitle' => 'Calm, clear replies that keep customers happy.',
            'icon' => 'Headset',
            'order' => 3,
            'focus' => 'customer support — ticket replies, refunds, de-escalation, and macros',
        ],
        'content-writing-va' => [
            'title' => 'Content Writing VA',
            'subtitle' => 'Emails, blogs, and product copy that convert.',
            'icon' => 'PenLine',
            'order' => 4,
            'focus' => 'content writing — marketing emails, blog intros, and product descriptions',
        ],
        'ecommerce-va' => [
            'title' => 'E-commerce VA',
            'subtitle' => 'Listings, inventory, and order operations.',
            'icon' => 'ShoppingCart',
            'order' => 5,
            'focus' => 'e-commerce support — product listings, inventory sheets, and order handling',
        ],
        'data-research-va' => [
            'title' => 'Data & Research VA',
            'subtitle' => 'Clean data and useful research, fast.',
            'icon' => 'Table',
            'order' => 6,
            'focus' => 'data entry and research — structured spreadsheets, lead lists, and research summaries',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    */

    'uploads' => [
        'disk' => 'local',
        'directory' => 'submissions',
        'max_image_kb' => 5120,
        'max_file_kb' => 10240,
    ],

];
