<?php

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'General', 'rhr' ),
    'id'        => 'rhr_general',
    'icon'      => 'dashicons dashicons-admin-generic',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Social Media', 'rhr' ),
    'id'        => 'rhr_general_social',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide', 'rhr' ),
            'subtitle'  => __('Choose this option to show at header and footer (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_social',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide On Header', 'rhr' ),
            'subtitle'  => __('Choose this option to show at header (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_social_h',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide On Footer', 'rhr' ),
            'subtitle'  => __('Choose this option to show at Footer (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_social_f',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_facebook',
            'type'  => 'text',
            'title' => esc_html__( 'Facebook', 'rhr' ),
            'default'    => '#',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_twitter',
            'type'  => 'text',
            'title' => esc_html__( 'Twitter', 'rhr' ),
            'default'     => '#',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_instagram',
            'type'  => 'text',
            'title' => esc_html__( 'Instagram', 'rhr' ),
            'default'     => '#',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_linkedin',
            'type'  => 'text',
            'title' => esc_html__( 'LinkedIn', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_youtube',
            'type'  => 'text',
            'title' => esc_html__( 'Youtube', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_gplus',
            'type'  => 'text',
            'title' => esc_html__( 'Google Plus', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_dribbble',
            'type'  => 'text',
            'title' => esc_html__( 'Dribbble', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_flickr',
            'type'  => 'text',
            'title' => esc_html__( 'Flickr', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_pinterest',
            'type'  => 'text',
            'title' => esc_html__( 'Pinterest', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_tumblr',
            'type'  => 'text',
            'title' => esc_html__( 'Tumblr', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_vimeo',
            'type'  => 'text',
            'title' => esc_html__( 'Vimeo', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_blogger',
            'type'  => 'text',
            'title' => esc_html__( 'Blogger', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_rss',
            'type'  => 'text',
            'title' => esc_html__( 'RSS', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
        array(
            'id'    => 'general_github',
            'type'  => 'text',
            'title' => esc_html__( 'GitHub', 'rhr' ),
            'default'     => '',
            'required'    => array('is_show_social', '=', true)
        ),
    )
));
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Custom Code', 'rhr' ),
    'id'               => 'rhr_custom_css_js',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'id'       => 'rhr_custom_css',
            'type'     => 'ace_editor',
            'title'    => __('Header CSS Code', 'rhr'),
            'subtitle' => __('Paste or write your CSS code here. (or) Leave it empty to aply theme defauls.', 'rhr'),
            'mode'     => 'css',
            'theme'    => 'monokai',
            'default'  => ""
        ),
        array(
            'id'       => 'rhr_custom_js',
            'type'     => 'ace_editor',
            'title'    => __('Header JS Code', 'rhr'),
            'subtitle' => __('Paste or write your JS code here. (or) Leave it empty to aply theme defauls.', 'rhr'),
            'mode'     => 'javascript',
            'theme'    => 'monokai',
            'default'  => ""
        ),
        array(
            'id'       => 'f_custom_js',
            'type'     => 'ace_editor',
            'title'    => __('Footer JS Code', 'rhr'),
            'subtitle' => __('Paste or write your JS code here. (or) Leave it empty to aply theme defauls.', 'rhr'),
            'mode'     => 'javascript',
            'theme'    => 'monokai',
            'default'  => ""
        ),
        array(
            'id'       => 'rhr_google_analytics_g',
            'type'     => 'ace_editor',
            'title'    => __('Google Analytics Global', 'rhr'),
            'subtitle' => __('Paste or write your JS code here. (or) Leave it empty to aply theme defauls.', 'rhr'),
            'mode'     => 'javascript',
            'theme'    => 'monokai',
            'default'  => ""
        ),
        array(
            'id'       => 'rhr_google_analytics_eu',
            'type'     => 'ace_editor',
            'title'    => __('Google Analytics EU', 'rhr'),
            'subtitle' => __('Paste or write your JS code here. (or) Leave it empty to aply theme defauls.', 'rhr'),
            'mode'     => 'javascript',
            'theme'    => 'monokai',
            'default'  => ""
        ),
        array(
            'id'       => 'rhr_google_analytics_uk',
            'type'     => 'ace_editor',
            'title'    => __('Google Analytics UK', 'rhr'),
            'subtitle' => __('Paste or write your JS code here. (or) Leave it empty to aply theme defauls.', 'rhr'),
            'mode'     => 'javascript',
            'theme'    => 'monokai',
            'default'  => ""
        ),
    )
) );

Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Default Options', 'rhr' ),
    'id'               => 'rhr_default_feature',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Show/Hide Default Thumbnail', 'rhr' ),
            'subtitle'  => __('Do you want to display the default thumbnail?', 'rhr'),
            'id'        => 'is_default_thumb',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Upload Featured Image', 'rhr' ),
            'subtitle'  => esc_html__( 'Upload a custom featured image.', 'rhr' ),
            'id'        => 'rhr_default_thumb',
            'type'      => 'media',
            'default'  => array(
                'url' => RHR_IMAGES.'/default_thumbnail.png',
            ),
            'url'      => false,
            'required'    => array('is_default_thumb', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Upload Profile Image', 'rhr' ),
            'subtitle'  => esc_html__( 'Upload a custom profile featured image.', 'rhr' ),
            'id'        => 'rhr_profile_default_thumb',
            'type'      => 'media',
            'default'  => array(
                'url' => RHR_IMAGES.'/default_thumbnail.png',
            ),
            'url'      => false,
            'required'    => array('is_default_thumb', '=', true)
        ),
    )
) );
