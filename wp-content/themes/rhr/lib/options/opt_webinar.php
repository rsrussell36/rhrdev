<?php

Redux::set_section('rhr', array(
	'title'     => esc_html__( 'Webinar', 'rhr' ),
	'id'        => 'rhr_webinars',
	'icon'      => 'dashicons dashicons-money',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Single', 'rhr' ),
    'id'        => 'rhr_single_social_webinars',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide Share', 'rhr' ),
            'subtitle'  => __('Choose this option to show social share  (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_share_webinar',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Facebook', 'rhr' ),
            'id'        => 'share_facebook_webinar',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_webinar', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Twitter', 'rhr' ),
            'id'        => 'share_twitter_webinar',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_webinar', '=', true)
        ),
        array(
            'title'     => esc_html__( 'LinkedIn', 'rhr' ),
            'id'        => 'share_linkedin_webinar',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_webinar', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Google Plus', 'rhr' ),
            'id'        => 'share_gplus_webinar',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_webinar', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Featured Image', 'rhr' ),
            'subtitle'  => __('Do you want to display featured Image (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_featured_show_webinar',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Date Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display date meta (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_date_show_webinar',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Author Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display bottom author media (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_author_media_show_webinar',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Tag Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display tags (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_tag_show_webinar',
            'type'      => 'switch',
            'default'  => true,
        ),
    )
));
