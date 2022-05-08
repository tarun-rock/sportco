<?php
$retrun = [
    'feeds' => [
        'main' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => ['App\Model\Posts@getFeedItems',0],

            /*
             * The feed will be available on this url.
             */
            'url' => '/feed',

            'title' => 'My feed',
            'description' => 'The description of the feed.',
            'language' => 'en-US',

            /*
             * The view that will render the feed.
             */
            'view' => 'feed::atom',

            /*
             * The type to be used in the <link> tag
             */
            'type' => 'application/atom+xml',
        ]
    ],
];

foreach (returnConfig("rss") as $key => $rss)
{
    $retrun['feeds'][$key] = [
        /*
         * Here you can specify which class and method will return
         * the items that should appear in the feed. For example:
         * 'App\Model@getAllFeedItems'
         *
         * You can also pass an argument to that method:
         * ['App\Model@getAllFeedItems', 'argument']
         */
        'items' => ['App\Model\Posts@getFeedItems',$rss],

        /*
         * The feed will be available on this url.
         */
        'url' => "/feed/".strtolower($key),

        'title' => 'My feed',
        'description' => 'The description of the feed.',
        'language' => 'en-US',

        /*
         * The view that will render the feed.
         */
        'view' => 'feed::atom',

        /*
         * The type to be used in the <link> tag
         */
        'type' => 'application/atom+xml',
    ];

}


return $retrun;