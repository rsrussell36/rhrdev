<?php

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Form', 'rhr' ),
    'id'        => 'rhr_form',
    'icon'      => 'dashicons dashicons-buddicons-pm',
));

Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Contact Form', 'rhr' ),
    'id'               => 'rhr_contact_mail',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'id'    => 'contact_to_email',
            'type'  => 'text',
            'title' => esc_html__( 'To Email', 'rhr' ),
            'subtitle' => esc_html__('Enter to email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'email@rhrinternational.com',
        ),
        array(
            'id'    => 'contact_to_from',
            'type'  => 'text',
            'title' => esc_html__( 'From Email', 'rhr' ),
            'subtitle' => esc_html__('Enter from email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'wordpress@rhrinternational.com',
        ),
        array(
            'id'    => 'contact_success_msg',
            'type'  => 'text',
            'title' => esc_html__( 'Success Message', 'rhr' ),
            'subtitle' => esc_html__('Enter success message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Thank you! Form submitted successfully.',
        ),
        array(
            'id'    => 'contact_error_msg',
            'type'  => 'text',
            'title' => esc_html__( 'Error Message', 'rhr' ),
            'subtitle' => esc_html__('Enter error message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Oops! Something wrong, try again!',
        ),
        array(
            'id'    => 'contact_subject',
            'type'  => 'text',
            'title' => esc_html__( 'Subject', 'rhr' ),
            'subtitle' => esc_html__('Enter email subject (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Get In Touch',
        ),
        array(
            'id'    => 'contact_sub_form_class',
            'type'  => 'text',
            'title' => esc_html__( 'Submit Class', 'rhr' ),
            'subtitle' => esc_html__('Enter submit class name (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'submit-class',
        ),
        array(
            'id'    => 'contact_sub_form_id',
            'type'  => 'text',
            'title' => esc_html__( 'Submit Id', 'rhr' ),
            'subtitle' => esc_html__('Enter submit id name (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'submit-id',
        ),
    )
) );
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Popup Form', 'rhr' ),
    'id'               => 'rhr_popup_mail',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
      array(
            'title'     => esc_html__( 'On/Off Welcome Message', 'rhr' ),
            'subtitle'  => __('Choose this option to on/off welcome message to client (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_popup_wc',
            'type'      => 'switch',
            'default'  => false,
        ),
        array(
            'id'    => 'to_email_global',
            'type'  => 'text',
            'title' => esc_html__( 'To Email', 'rhr' ),
            'subtitle' => esc_html__('Enter to email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'email@rhrinternational.com',
        ),
        array(
            'id'    => 'from_email_global',
            'type'  => 'text',
            'title' => esc_html__( 'From Email', 'rhr' ),
            'subtitle' => esc_html__('Enter from email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'wordpress@rhrinternational.com',
        ),
        array(
            'id'    => 'subject_global',
            'type'  => 'text',
            'title' => esc_html__( 'Subject', 'rhr' ),
            'subtitle' => esc_html__('Enter email subject (or) Leave it empty to hide.', 'rhr'),
            'default'    => '',
        ),
    )
) );
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Captcha', 'rhr' ),
    'id'               => 'rhr_contact_captcha',
    'subsection'       => true,
    'icon'             => '',
    'desc'             => __( 'Register the domain of your website at Google ', 'rhr' ) . '<a href="https://www.google.com/recaptcha/admin" target="_blank">reCAPTCHA Admin console</a>',
    'fields'           => array(
        array(
            'id'    => 'contact_captcha_sitekey',
            'type'  => 'text',
            'title' => esc_html__( 'Site Key', 'rhr' ),
            'subtitle' => esc_html__('Enter reCAPTCHA site key', 'rhr'),
            'default'    => '6LdHmAAdAAAAAHvcuBXp3WtdfVe9ylQhLwIoFoz2',
        ),
        array(
            'id'    => 'contact_captcha_secretkey',
            'type'  => 'text',
            'title' => esc_html__( 'Secret Key', 'rhr' ),
            'subtitle' => esc_html__('Enter reCAPTCHA secret key', 'rhr'),
            'default'    => '6LdHmAAdAAAAAA5NqUMdHGUvzECQkh05pd-BsU1H',
        ),
    )
) );
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Admin', 'rhr' ),
    'id'               => 'rhr_reset_password',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'id'    => 'rhr_reset_from_email',
            'type'  => 'text',
            'title' => esc_html__( 'From Email', 'rhr' ),
            'subtitle' => esc_html__('Enter admin reset email (or) Leave empty to aply default.', 'rhr'),
            'default'    => '',
        ),
    )
) );
