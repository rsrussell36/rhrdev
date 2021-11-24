<?php
// Header Section
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Header', 'rhr' ),
    'id'               => 'rhr_header_sec',
    'customizer_width' => '400px',
    'icon'             => 'eicon-header',
));


// Logo
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Header', 'rhr' ),
    'id'               => 'rhr_logo_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Show/Hide Header Popup', 'rhr' ),
            'subtitle'  => __('Choose this option to show the header popup (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_h_popup_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Logo', 'rhr' ),
            'subtitle'  => __('Choose this option to show the header logo (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_h_logo_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'h_logo_url',
            'type'  => 'text',
            'title' => esc_html__( 'Logo URL', 'rhr' ),
            'subtitle' => esc_html__('This url will be shown at the main header logo.', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_h_logo_show', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Fav Icon', 'rhr' ),
            'subtitle'  => esc_html__( 'Upload a 16px x 16px Png/Gif image that will represent your website favicon.', 'rhr' ),
            'id'        => 'rhr_fav_icon',
            'type'      => 'media',
        ),
        array(
            'title'     => esc_html__( 'Apple Touch Icon', 'rhr' ),
            'subtitle'  => esc_html__( 'Size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for iPhone4 retina display (IMHO, just go ahead and use the biggest one). Transparency is not recommended (iOS will put a black BG behind the icon)            ', 'rhr' ),
            'id'        => 'rhr_apple_touch_icon',
            'type'      => 'media',
        ),
        array(
            'title'     => esc_html__( 'Dashboard Fav Icon', 'rhr' ),
            'subtitle'  => esc_html__( 'Upload a 16px x 16px Png/Gif image that will represent your dashboard favicon.', 'rhr' ),
            'id'        => 'rhr_d_fav_icon',
            'type'      => 'media',
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show the header button (Get In Touch) (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_h_btn_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'h_btn_text',
            'type'  => 'text',
            'title' => esc_html__( 'Button Text', 'rhr' ),
            'subtitle' => esc_html__('This content will be shown at the main header.', 'rhr'),
            'default'    => 'Get In Touch',
            'required'    => array('is_h_btn_show', '=', true)
        ),
        
        array(
            'id'    => 'h_btn_url',
            'type'  => 'text',
            'title' => esc_html__( 'Button URL', 'rhr' ),
            'subtitle' => esc_html__('This url will be shown at the main header button.', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_h_btn_show', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Login', 'rhr' ),
            'subtitle'  => __('Choose this option to show the header login user (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_h_login_btn_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'h_login_btn_url',
            'type'  => 'text',
            'title' => esc_html__( 'Login URL', 'rhr' ),
            'subtitle' => esc_html__('This url will be shown at the main header button.', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_h_login_btn_show', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Search', 'rhr' ),
            'subtitle'  => __('Choose this option to show the header search (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_h_search_btn_show',
            'type'      => 'switch',
            'default'  => true,
        ),
    )
) );
