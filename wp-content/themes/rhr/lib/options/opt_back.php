<?php
// Header Section
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Back Button', 'rhr' ),
    'id'               => 'rhr_back_sec',
    'customizer_width' => '400px',
    'icon'             => 'eicon-chevron-left',
));


// Logo
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Back Button', 'rhr' ),
    'id'               => 'rhr_back_page',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Show/Hide Blog Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show blog inner back button (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_blog_back',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'rhr_blog_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter back button url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_blog_back', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Client Breadcrumbs', 'rhr' ),
            'subtitle'  => __('Choose this option to show client cases inner breadcrumbs (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_client_cases_stories_back',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'rhr_client_cases_stories_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter client stories url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_client_cases_stories_back', '=', true)
        ),
        array(
            'id'    => 'rhr_client_cases_stories_last_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter client stories last url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_client_cases_stories_back', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Events Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show events inner back button (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_events_back',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'rhr_events_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter back button url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_events_back', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide eBooks Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show eBooks inner back button (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_ebooks_back',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'rhr_ebooks_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter back button url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_ebooks_back', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide News Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show news inner back button (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_news_back',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'rhr_news_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter back button url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_news_back', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Research Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show research inner back button (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_research_back',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'rhr_research_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter back button url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_research_back', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Team Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show team inner back button (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_team_back',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'rhr_team_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter back button url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_team_back', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Webinar Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show webinar inner back button (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_webinar_back',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'rhr_webinar_back',
            'type'  => 'text',
            'title' => esc_html__( 'URL', 'rhr' ),
            'subtitle' => esc_html__('Enter back button url', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_webinar_back', '=', true)
        ),
    )
) );
