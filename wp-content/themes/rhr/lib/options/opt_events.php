<?php

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Events', 'rhr' ),
    'id'        => 'rhr_events',
    'icon'      => 'dashicons dashicons-calendar-alt',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Single', 'rhr' ),
    'id'        => 'rhr_single_social_events',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide Share', 'rhr' ),
            'subtitle'  => __('Choose this option to show social share  (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_share_event',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Facebook', 'rhr' ),
            'id'        => 'share_facebook_event',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_event', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Twitter', 'rhr' ),
            'id'        => 'share_twitter_event',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_event', '=', true)
        ),
        array(
            'title'     => esc_html__( 'LinkedIn', 'rhr' ),
            'id'        => 'share_linkedin_event',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_event', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Google Plus', 'rhr' ),
            'id'        => 'share_gplus_event',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_event', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Featured Image', 'rhr' ),
            'subtitle'  => __('Do you want to display featured Image (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_featured_show_event',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Tag Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display tags (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_tag_show_event',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Related Event Section', 'rhr' ),
            'subtitle'  => __('Do you want to display related events section (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_rel_show_event',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Date Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display related events date section (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_rel_date_show_event',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_rel_show_event', '=', true)
        ),
        array(
            'id'    => 'single_rel_title_event',
            'type'  => 'text',
            'title' => esc_html__( 'Related Event Title', 'rhr' ),
            'subtitle' => esc_html__('Type the related event section title here (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'Upcoming Events',
            'required'    => array('is_rel_show_event', '=', true)
        ),
        array(
            'id'    => 'single_rel_title_limit_event',
            'type'  => 'text',
            'title' => esc_html__( 'Title Limit', 'rhr' ),
            'subtitle' => esc_html__('Type the numerical value for the post title (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '30',
            'required'    => array('is_rel_show_event', '=', true)
        ),
        array(
            'id'    => 'single_rel_limit_event',
            'type'  => 'text',
            'title' => esc_html__( 'Number of Related Event', 'rhr' ),
            'subtitle' => esc_html__('Enter the integer value to display related post (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '6',
            'required'    => array('is_rel_show_event', '=', true)
        ),
        array(
            'id'    => 'single_rel_date_event',
            'type'  => 'select',
            'title' => esc_html__( 'Sorting by Date', 'rhr' ),
            'subtitle' => esc_html__('Choose the sorting date (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'anytime',
            'options'  => array(
                'anytime' => __('All', 'rhr' ),
                'today' => __('Past Day/Today', 'rhr' ),
                'week' => __('Past Week', 'rhr' ),
                'month' => __('Past Month', 'rhr' ),
                'quarter' => __('Past Quarter', 'rhr' ),
                'year' => __('Past Year', 'rhr' ),
                'exact' => __('Custom', 'rhr' ),
            ),
            'required'    => array('is_rel_show_event', '=', true)
        ),

        array (
            'id'            => 'before_date',
            'type'          => 'date',
            'title'         => 'Before',
            'compiler' => true,
            'subtitle'      => 'Setting a ‘Before’ date will show all the posts published until the chosen date (inclusive).',
            'required'    => array('single_rel_date_event', '=', 'exact')
        ),

        array (
            'id'            => 'after_date',
            'type'          => 'date',
            'title'         => 'After',
            'subtitle'      => 'Setting an ‘After’ date will show all the posts published since the chosen date (inclusive).',
            'required'    => array('single_rel_date_event', '=', 'exact')
        ),
        array(
            'id'    => 'single_rel_orderby_event',
            'type'  => 'select',
            'title' => esc_html__( 'Order By', 'rhr' ),
            'subtitle' => esc_html__('Choose the order by selection (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'meta_value_num',
            'options'  => array(
                'meta_value_num' => 'Meta Value',
                'date' => 'Date',
                'title' => 'Title',
                'rand' => 'Random',
            ),
            'required'    => array('is_rel_show_event', '=', true)
        ),
        array(
            'id'    => 'single_rel_sortingorder_event',
            'type'  => 'select',
            'title' => esc_html__( 'Sorting Order', 'rhr' ),
            'subtitle' => esc_html__('Choose the sorting order (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'desc',
            'options'  => array(
                'asc' => 'Ascending',
                'desc' => 'Descending',
            ),
            'required'    => array('is_rel_show_event', '=', true)
        ),
    )
));
