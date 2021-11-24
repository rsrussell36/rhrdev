<?php

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'News', 'rhr' ),
    'id'        => 'rhr_news',
    'icon'      => 'dashicons dashicons-media-spreadsheet',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Single', 'rhr' ),
    'id'        => 'rhr_single_social_news',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide Share', 'rhr' ),
            'subtitle'  => __('Choose this option to show social share  (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_share_news',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Facebook', 'rhr' ),
            'id'        => 'share_facebook_news',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_news', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Twitter', 'rhr' ),
            'id'        => 'share_twitter_news',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_news', '=', true)
        ),
        array(
            'title'     => esc_html__( 'LinkedIn', 'rhr' ),
            'id'        => 'share_linkedin_news',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_news', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Google Plus', 'rhr' ),
            'id'        => 'share_gplus_news',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_news', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Featured Image', 'rhr' ),
            'subtitle'  => __('Do you want to display featured image (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_featured_show_news',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Tag Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display tags (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_tag_show_news',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Author Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display author name (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_author_media_show_news',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Related News Section', 'rhr' ),
            'subtitle'  => __('Do you want to display related news section (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_rel_show_news',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Date Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display related news date section (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_rel_date_show_news',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_rel_show_news', '=', true)
        ),
        array(
            'id'    => 'single_rel_title_news',
            'type'  => 'text',
            'title' => esc_html__( 'Related News Title', 'rhr' ),
            'subtitle' => esc_html__('Type the related news section title here (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'Upcoming News',
            'required'    => array('is_rel_show_news', '=', true)
        ),
        array(
            'id'    => 'single_rel_title_limit_news',
            'type'  => 'text',
            'title' => esc_html__( 'Title Limit', 'rhr' ),
            'subtitle' => esc_html__('Type the numerical value for the post title (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '30',
            'required'    => array('is_rel_show_news', '=', true)
        ),
        array(
            'id'    => 'single_rel_limit_news',
            'type'  => 'text',
            'title' => esc_html__( 'Number of Related news', 'rhr' ),
            'subtitle' => esc_html__('Enter the integer value to display related post (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '6',
            'required'    => array('is_rel_show_news', '=', true)
        ),
        array(
            'id'    => 'single_rel_orderby_news',
            'type'  => 'select',
            'title' => esc_html__( 'Order By', 'rhr' ),
            'subtitle' => esc_html__('Choose the order by selection (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'date',
            'options'  => array(
                'date' => 'Date',
                'title' => 'Title',
                'rand' => 'Random',
            ),
            'required'    => array('is_rel_show_news', '=', true)
        ),
        array(
            'id'    => 'single_rel_sortingorder_news',
            'type'  => 'select',
            'title' => esc_html__( 'Sorting Order', 'rhr' ),
            'subtitle' => esc_html__('Choose the sorting order (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'desc',
            'options'  => array(
                'asc' => 'Ascending',
                'desc' => 'Descending',
            ),
            'required'    => array('is_rel_show_news', '=', true)
        ),
    )
));
