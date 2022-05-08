<?php

return [

    "featured_post" => 1,
    "sportsgram" => 1,
    "videos" => 2 ,
    "editors_choice" =>2,
    "default" => 1,
    "fan" => 2,
    "editor desk" => 5,
    "sponsored" => 3,
    "orderBy" => 12,
    "type" => 1, # 1 = article,
    "sportsgramtype" => 2, # 2 = sportsgramm
    "fanscorner_sectionid" => 3, # section table
    "orderByViews" => 11,
    "orderByLatest" => 10,


    "user" => 1,
    "admin" => 2,
    "pending_post" => 0,
    "accepted_post" => 1,
    "rejected_post" => 2,
    'draft' => 99,

    "article_approve_token" => 1,
    "img_approve_token" => 2,
    "video_approve_token" => 3,

    "editor_choice_article_token" => 4,
    "editor_choice_img_token" => 5,
    "editor_choice_video_token" => 6,
    "bonus_percentage_token" => 7,
    "sportsgram_approve_token" => 13,

    "active" => 1,
    "column_separator" => "!--!",

    "tokenRedeem" => 8,
    "modeReward" => 9,


    "inner_join" => "INNER",
    "left_join" => "LEFT",
    "right_join" => "RIGHT",


    "Sportco_token_usd" => 1,
    "transaction_fee_ETH" => 2,
    "min_trasaction_amount" => 3,
    "ETH_in_usd" => 4,
    "admin_email" => 5,

    "isprod" =>env("ISPROD", 0),

    "RCB_post" => 1, #commnunties table
    "RCB_section" => 4, # section id
    "arsenal_Id" => 5, # section id
    "onetime_play_tokens" => 14,   // Master Rewards token value
    "publish_first_post_loaded" => 1, // Master event Meta table token value
    "community" => [
        "rcb" => 1,
        "arsenal" => 2,

    ],


    "rss" =>[
        "arsenal" => 1,
        "chelsea" => 2,
        "liverpool" => 3,
        "manchester-united" => 4,
        "manchester-city" => 5,
        "tottenham" => 6,
        "real-madrid" => 7,
        "barcelona" => 8,
        "juventus" => 9,
        "indian-football" => 10,
        "transfer-news" => 11
    ],
    "referred_token_master_value" => 6,   // Site Meta table token value
    "referred_token" => 11,   // Master Rewards table token value
    "first_post_tokens" => 12,   // Master Rewards table token value


     "wordpress_consumer_key" => env("WORDPRESS_CONSUMER_KEY"),
     "wordpress_consumer_secret" => env("WORDPRESS_CONSUMER_SECRET")
];
