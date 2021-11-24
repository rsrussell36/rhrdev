<?php

Redux::set_section('rhr', array(
	'title'     => esc_html__( 'Footer', 'rhr' ),
	'id'        => 'rhr_page',
	'icon'      => 'eicon-footer',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Footer Content', 'rhr' ),
    'id'        => 'rhr_footer_content',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide Logo', 'rhr' ),
            'subtitle'  => __('Choose this option to show the footer logo (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_f_logo_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'f_logo_url',
            'type'  => 'text',
            'title' => esc_html__( 'Logo URL', 'rhr' ),
            'subtitle' => esc_html__('This url will be shown at the main footer logo.', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_f_logo_show', '=', true)
        ),
         array(
            'title'     => esc_html__( 'Show/Hide Copyright', 'rhr' ),
            'subtitle'  => __('Choose this option to show the copyright (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_footer_copy_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__('Copyright Text', 'rhr'),
            'subtitle' => esc_html__('This content will be shown at the footer bottom.', 'rhr'),
            'id'        => 'footer_copy',
            'type'      => 'editor',
            'default'   => '© 2021 RHR International LLP.',
            'required'    => array('is_footer_copy_show', '=', true),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'teeny'         => false,
            ),
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Description', 'rhr' ),
            'subtitle'  => __('Choose this option to show the description (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_footer_des_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__('Description', 'rhr'),
            'subtitle' => esc_html__('This content will be shown at the bottom of subscriber form.', 'rhr'),
            'id'        => 'footer_desc',
            'type'      => 'editor',
            'default'   => 'RHR, RHR International, The Winning Formula, Executive Bench, Readiness for Scale, and Scaling for Growth are service marks owned and/or registered by RHR International LLP. All logos and client trademarks are the property of their respective trademark owners.',
            'required'    => array('is_footer_des_show', '=', true),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'teeny'         => false,
            ),
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Button', 'rhr' ),
            'subtitle'  => __('Choose this option to show the footer button (Get In Touch) (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_f_btn_show',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'id'    => 'f_btn_text',
            'type'  => 'text',
            'title' => esc_html__( 'Button Text', 'rhr' ),
            'subtitle' => esc_html__('This content will be shown at the main footer.', 'rhr'),
            'default'    => 'Get In Touch',
            'required'    => array('is_f_btn_show', '=', true)
        ),
        
        array(
            'id'    => 'f_btn_url',
            'type'  => 'text',
            'title' => esc_html__( 'Button URL', 'rhr' ),
            'subtitle' => esc_html__('This url will be shown at the main footer button.', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('is_f_btn_show', '=', true)
        ),
        
    )
));