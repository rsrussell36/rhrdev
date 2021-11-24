<?php

Redux::set_section('rhr', array(
	'title'     => esc_html__( 'Credential', 'rhr' ),
	'id'        => 'rhr_credential',
	'icon'      => 'eicon-settings',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Credential', 'rhr' ),
    'id'        => 'rhr_credential_info',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'id'    => 'credential_login',
            'type'  => 'text',
            'title' => esc_html__( 'Login Slug', 'rhr' ),
            'subtitle' => esc_html__('Type login page slug (or) leave it empty to aply theme default(login).', 'rhr'),
            'default'    => 'login',
        ),
        array(
            'id'    => 'credential_forgot',
            'type'  => 'text',
            'title' => esc_html__( 'Forgot Slug', 'rhr' ),
            'subtitle' => esc_html__('Type forgot page slug (or) leave it empty to aply theme default(forgot).', 'rhr'),
            'default'    => 'forgot',
        ),
        array(
            'id'    => 'credential_reset',
            'type'  => 'text',
            'title' => esc_html__( 'Reset Slug', 'rhr' ),
            'subtitle' => esc_html__('Type reset page slug (or) leave it empty to aply theme default(reset).', 'rhr'),
            'default'    => 'reset',
        ),
    )
));
