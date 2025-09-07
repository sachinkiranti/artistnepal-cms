<?php

/**
 * Components & Widgets Configurations
 * @version 0.1.0
 */

return [

    /*
    |-------------------------------------------------------------------------------
    | Design configurations
    |
    | Component :
    | wrapper contains the html design to wrap around the component . Every
    | Component will be wrapped with wrapper where prefix and suffix will be added.
    |
    | Widget :
    | widget will be wrapped with prefix and suffix.
    |-------------------------------------------------------------------------------
    */
    'design' => [

        'component' => [

            'wrapper' => [
                'prefix' => '<div class="wrapper col-sm-%s">',
                'suffix' => '</div>',
            ],

        ],

        'widget'    => [

            'prefix' => '<div class="widget-prefix col-sm-%s">',
            'suffix' => '</div>',

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | component as a keys and values as in the view path
    |--------------------------------------------------------------------------
    */
    'components' => [

        'backend' => [
            'dashboard'   => 'widgets.components.dashboard',
            'section_one' => 'widgets.components.section_one',
            'section_two' => 'widgets.components.section_two',
        ],

        /* Frontend Index Components */
        'frontend' => [

            'breaking-news-component'         => 'pages.widgets.components.breaking-news-component',
            'left-section-component'          => 'pages.widgets.components.left-section-component',
            'middle-section-component'        => 'pages.widgets.components.middle-section-component',
            'right-section-component'         => 'pages.widgets.components.right-section-component',
            'video-section-component'         => 'pages.widgets.components.video-section-component',
            'eight-by-four-section-component' => 'pages.widgets.components.eight-by-four-section-component',
            'featured-news-component'         => 'pages.widgets.components.featured-news-component',
            'footer-top-section-component'    => 'pages.widgets.components.footer-top-section-component',
            'page-sidebar-component'          => 'pages.widgets.components.page-sidebar-component',
            'eight-section-component'         => 'pages.widgets.components.eight-section-component',
            'four-section-component'          => 'pages.widgets.components.four-section-component',
            'footer-eight-section-component'  => 'pages.widgets.components.footer-eight-section-component',
            'footer-four-section-component'   => 'pages.widgets.components.footer-four-section-component',

            'literature-right-section-component' => 'pages.widgets.components.literature-right-section-component',
            'literature-left-section-component'  => 'pages.widgets.components.literature-left-section-component',

            // Footer
            'footer-right-section-component'  => 'pages.widgets.components.footer-right-section-component',
            'footer-left-section-component'   => 'pages.widgets.components.footer-left-section-component',
            'footer-middle-section-component' => 'pages.widgets.components.footer-middle-section-component',
            'footer-full-section-component'   => 'pages.widgets.components.footer-full-section-component',

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | widget as a keys and values as in the view path
    |--------------------------------------------------------------------------
    */
    'widgets'    => [
        'recent'        => 'widgets.recent',
        'count'         => 'widgets.count',
        'aggregate'     => 'widgets.aggregate',
        'category-wise' => 'widgets.category-wise',
        'html'          => 'widgets.html',
        'about'         => 'widgets.about',
        'team'          => 'widgets.team',
        'menu'          => 'widgets.menu',
        'ad'            => 'widgets.ad',
    ],

    'widget-type' => [
        'backend'  => [ 'recent', 'count', 'aggregate', ],
        'frontend' => [
            'category-wise', 'html', 'about', 'team', 'menu', 'ad',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixes for the components and widgets
    |--------------------------------------------------------------------------
    */
    'prefixes' => [

        'component' => 'component-',
        'widget'    => 'widget-',

    ],

    /*
    |--------------------------------------------------------------------------
    | Data for the components and widgets
    |
    | Entity :
    |
    | Todo
    | according to multiple posts, according to counts
    |--------------------------------------------------------------------------
    */
    'data' => [

        'entity' => [

            'users'      => 'Users',
            'posts'      => 'Posts',
            'categories' => 'Categories',
            'tags'       => 'Tags',

        ],

        /*
        |--------------------------------------------------------------------------
        | Views : means trending one
        |--------------------------------------------------------------------------
        */
        'entity_items' => [

            'users'      => [

                'according_to_last_login'     => 'According to the last login',
                'according_to_role'           => 'According to the role',
                'according_to_posts_count'    => 'According to the post count', // the one who posted the most

            ],

            'posts'      => [

                'according_to_the_views'      => 'According to the views',
                'according_to_the_category'   => 'According to the category',
                'according_to_the_categories' => 'According to the Categories', // multiple categories
                'according_to_the_users'      => 'According to the users', // multiple users
                'according_to_the_user'       => 'According to the user',

            ],

            'categories' => [

                'according_to_the_views'      => 'According to the views',
                'according_to_the_user'       => 'According to the user',

            ],

            'tags'       => [

                'according_to_the_views'      => 'According to the views',
                'according_to_the_user'       => 'According to the user'

            ],

        ],

        'aggregates' => [

            'sum'   => 'Sum',
            'count' => 'Count',

        ],

        'templates'  => [
            'breaking-news'                      => 'Breaking News / Trending News / Flash News',
            'bises-news'                         => 'Bises News',
            'pramukh-news'                       => 'Pramukh News',
            'eight-column-side-full-width'       => 'Eight column with full width side news',
            'eight-column-top-full-width'        => 'Eight column with full top width side news',
            'featured-news'                      => 'Featured News',
            'list-with-circle-image'             => 'News List with circle image',
            'list-with-image'                    => 'News List with image',
            'list-with-rectangle-image'          => 'News list with rectangle image',
            'list-with-left-side-image'          => 'News List with left side image',
            'list-without-image'                 => 'News List without image',
            'party-board'                        => 'Board party news',
            'trending-news'                      => 'Trending News',
            'list-with-one-full-image'           => 'List with one full image and other Normal',
            'literature-list'                    => 'Literature List',
            'literature-grid'                    => 'Literature Grid List',
            'sochai'                             => 'Sochai Widget template',
            'gallery'                            => 'Gallery Template',
            'video'                              => 'Video',
            'ad'                                 => 'Advertisement',
            'card-list'                          => 'Card List',
            'nrn-news'                           => 'NRN News List',
        ],

        'widget-without-category' => [
            'gallery', 'breaking-news', 'trending-news',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | custom-widget-design
    | Path : design
    | Widgets list with it's title, description, and view_path
    |--------------------------------------------------------------------------
    */
    'custom-widget-design' => [

        'path' => [

            'base' => 'front.widgets'

        ],

        'widgets' => [

            [
                'title' => 'widget-1',
                'description' => 'Widget first',
                'view_path'   => 'designs.widget-1',
                'screenshot'  => '',
            ],

            [
                'title' => 'widget-2',
                'description' => 'Widget second',
                'view_path'   => 'designs.widget-2',
                'screenshot'  => '',
            ],

        ],

    ],

    /* Widget template path */
    'template-path' => [
        'breaking-news'                      => 'pages.widgets.breaking-news',
        'bises-news'                         => 'pages.widgets.bises-news',
        'pramukh-news'                       => 'pages.widgets.pramukh-news',
        'eight-column-side-full-width'       => 'pages.widgets.eight-column-side-full-width',
        'eight-column-top-full-width'        => 'pages.widgets.eight-column-top-full-width',
        'featured-news'                      => 'pages.widgets.featured-news',
        'list-with-circle-image'             => 'pages.widgets.list-with-circle-image',
        'list-with-image'                    => 'pages.widgets.list-with-image',
        'list-with-rectangle-image'          => 'pages.widgets.list-with-rectangle-image',
        'list-with-left-side-image'          => 'pages.widgets.list-with-left-side-image',
        'list-without-image'                 => 'pages.widgets.list-without-image',
        'party-board'                        => 'pages.widgets.party-board',
        'trending-news'                      => 'pages.widgets.trending-news',
        'list-with-one-full-image'           => 'pages.widgets.list-with-one-full-image',
        'literature-list'                    => 'pages.widgets.literature-list',
        'literature-grid'                    => 'pages.widgets.literature-grid',
        'sochai'                             => 'pages.widgets.sochai',
        'gallery'                            => 'pages.widgets.gallery',
        'video'                              => 'pages.widgets.video',
        'ad'                                 => 'pages.widgets.ad',
        'card-list'                          => 'pages.widgets.card-list',
        'nrn-news'                           => 'pages.widgets.nrn-news',
    ],

    'simple-widget'                          => [
        'html'                               => 'pages.widgets.html',
        'about'                              => 'pages.widgets.footer.about-us',
        'team'                               => 'pages.widgets.footer.team',
        'menu'                               => 'pages.widgets.footer.menu',
        'ad'                                 => 'pages.widgets.ad',
    ],

    'page-wise-components'                   => [
        'home'                               => [
            'breaking-news-component',
            'left-section-component',
            'middle-section-component',
            'right-section-component',
            'video-section-component',
            'eight-section-component',
            'four-section-component',
            'featured-news-component',
            'literature-right-section-component',
            'literature-left-section-component',
            'footer-eight-section-component',
            'footer-four-section-component',
            'footer-full-section-component',
            'footer-right-section-component',
            'footer-left-section-component',
            'footer-middle-section-component',

            'en-breaking-news-component',
            'en-left-section-component',
            'en-middle-section-component',
            'en-right-section-component',
            'en-video-section-component',
            'en-eight-section-component',
            'en-four-section-component',
            'en-featured-news-component',
            'en-literature-right-section-component',
            'en-literature-left-section-component',
            'en-footer-eight-section-component',
            'en-footer-four-section-component',
            'en-footer-full-section-component',
            'en-footer-right-section-component',
            'en-footer-left-section-component',
            'en-footer-middle-section-component',
        ],
        'single'                             => [
            'page-sidebar-component',
            'footer-right-section-component',
            'footer-left-section-component',
            'footer-middle-section-component',
        ],
        'author'                             => [
            'page-sidebar-component',
            'footer-right-section-component',
            'footer-left-section-component',
            'footer-middle-section-component',
        ],
        'archive'                            => [
            'page-sidebar-component',
            'footer-right-section-component',
            'footer-left-section-component',
            'footer-middle-section-component',
        ],
    ],

    'widget-preview'                         => [
        'breaking-news'                      => 'images/widget-images/breaking-news.png',
        'eight-column-side-full-width'       => 'images/widget-images/eight-column-side-full-width.png',
        'eight-column-top-full-width'        => 'images/widget-images/eight-column-top-full-width.png',
        'featured-news'                      => 'images/widget-images/featured.png',
        'list-with-circle-image'             => 'images/widget-images/breaking-news.png',
        'list-with-image'                    => 'images/widget-images/breaking-news.png',
        'list-with-rectangle-image'          => 'images/widget-images/list-with-rectangle-image.png',
        'list-with-left-side-image'          => 'images/widgets-images/list-with-left-side-image',
        'list-without-image'                 => 'images/widget-images/breaking-news.png',
        'party-board'                        => 'images/widget-images/party-board.png',
        'trending-news'                      => 'images/widget-images/trending-news.png',
        'list-with-one-full-image'           => 'images/widget-images/list-with-one-full-image.png',
        'literature-list'                    => 'images/widget-images/litreture-list.png',
        'literature-grid'                    => 'images/widget-images/litreture-grid.png',
        'sochai'                             => 'images/widget-images/sochai.png',
        'gallery'                            => 'images/widget-images/gallery.png',
        'video'                              => 'images/widget-images/video.png',
        'ad'                                 => 'images/widget-images/video.png',
    ],

];
