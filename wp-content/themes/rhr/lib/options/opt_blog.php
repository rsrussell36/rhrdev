<?php

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Blog', 'rhr' ),
    'id'        => 'rhr_blog',
    'icon'      => 'dashicons dashicons-welcome-write-blog',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Single', 'rhr' ),
    'id'        => 'rhr_single_social',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide Share', 'rhr' ),
            'subtitle'  => __('Choose this option to show social share  (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_share',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Facebook', 'rhr' ),
            'id'        => 'share_facebook',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Twitter', 'rhr' ),
            'id'        => 'share_twitter',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share', '=', true)
        ),
        array(
            'title'     => esc_html__( 'LinkedIn', 'rhr' ),
            'id'        => 'share_linkedin',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Google Plus', 'rhr' ),
            'id'        => 'share_gplus',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Featured Image', 'rhr' ),
            'subtitle'  => __('Do you want to display featured Image (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_featured_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Date Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display date meta (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_date_show',
            'type'      => 'switch',
            'default'  => true,
        ),

        array(
            'title'     => esc_html__( 'Show/Hide Author Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display author name (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_author_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Author Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display bottom author media (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_author_media_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Category/Tag Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display category/tag (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_tag_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'is_tag_show_cat_tag',
            'type'  => 'select',
            'title' => esc_html__( 'Select Type', 'rhr' ),
            'subtitle' => esc_html__('Choose category or tag by selection (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'category',
            'options'  => array(
                'category' => 'Category',
                'tag' => 'Tags',
            ),
            'required'    => array('is_tag_show', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Related Posts Section', 'rhr' ),
            'subtitle'  => __('Do you want to display related post section (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_rel_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'single_rel_title',
            'type'  => 'text',
            'title' => esc_html__( 'Related Post Title', 'rhr' ),
            'subtitle' => esc_html__('Type the related post section title here (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'RELATED POSTS',
            'required'    => array('is_rel_show', '=', true)
        ),
        array(
            'id'    => 'single_rel_title_limit',
            'type'  => 'text',
            'title' => esc_html__( 'Title Limit', 'rhr' ),
            'subtitle' => esc_html__('Type the numerical value for the post title (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '30',
            'required'    => array('is_rel_show', '=', true)
        ),
        array(
            'id'    => 'single_rel_limit',
            'type'  => 'text',
            'title' => esc_html__( 'Number of Related Post', 'rhr' ),
            'subtitle' => esc_html__('Enter the integer value to display related post (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '6',
            'required'    => array('is_rel_show', '=', true)
        ),
        array(
            'id'    => 'single_rel_orderby',
            'type'  => 'select',
            'title' => esc_html__( 'Order By', 'rhr' ),
            'subtitle' => esc_html__('Choose the order by selection (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'date',
            'options'  => array(
                'date' => 'Date',
                'title' => 'Title',
                'rand' => 'Random',
            ),
            'required'    => array('is_rel_show', '=', true)
        ),
        array(
            'id'    => 'single_rel_sortingorder',
            'type'  => 'select',
            'title' => esc_html__( 'Sorting Order', 'rhr' ),
            'subtitle' => esc_html__('Choose the sorting order (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'desc',
            'options'  => array(
                'asc' => 'Ascending',
                'desc' => 'Descending',
            ),
            'required'    => array('is_rel_show', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Author Posts Section', 'rhr' ),
            'subtitle'  => __('Do you want to display author post section (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_auth_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'single_auth_title',
            'type'  => 'text',
            'title' => esc_html__( 'Author Post Title', 'rhr' ),
            'subtitle' => esc_html__('Type the relatted post section title here (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'MORE BY THIS AUTHOR',
            'required'    => array('is_auth_show', '=', true)
        ),
        array(
            'id'    => 'single_auth_title_limit',
            'type'  => 'text',
            'title' => esc_html__( 'Title Limit', 'rhr' ),
            'subtitle' => esc_html__('Type the numerical value for the post title (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '30',
            'required'    => array('is_auth_show', '=', true)
        ),
        array(
            'id'    => 'single_auth_limit',
            'type'  => 'text',
            'title' => esc_html__( 'Number of Author Post', 'rhr' ),
            'subtitle' => esc_html__('Enter the integer value to display author post (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '6',
            'required'    => array('is_auth_show', '=', true)
        ),
        array(
            'id'    => 'single_auth_orderby',
            'type'  => 'select',
            'title' => esc_html__( 'Order By', 'rhr' ),
            'subtitle' => esc_html__('Choose the order by selection (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'date',
            'options'  => array(
                'date' => 'Date',
                'title' => 'Title',
                'rand' => 'Random',
            ),
            'required'    => array('is_auth_show', '=', true)
        ),
        array(
            'id'    => 'single_auth_sortingorder',
            'type'  => 'select',
            'title' => esc_html__( 'Sorting Order', 'rhr' ),
            'subtitle' => esc_html__('Choose the sorting order (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'desc',
            'options'  => array(
                'asc' => 'Ascending',
                'desc' => 'Descending',
            ),
            'required'    => array('is_auth_show', '=', true)
        ),
    )
));
