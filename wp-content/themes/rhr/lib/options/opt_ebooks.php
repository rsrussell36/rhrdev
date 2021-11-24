<?php

Redux::set_section('rhr', array(
	'title'     => esc_html__( 'eBooks', 'rhr' ),
	'id'        => 'rhr_ebooks',
	'icon'      => 'dashicons dashicons-pdf',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Single', 'rhr' ),
    'id'        => 'rhr_single_social_ebooks',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide Share', 'rhr' ),
            'subtitle'  => __('Choose this option to show social share  (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_share_ebook',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Facebook', 'rhr' ),
            'id'        => 'share_facebook_ebook',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_ebook', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Twitter', 'rhr' ),
            'id'        => 'share_twitter_ebook',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_ebook', '=', true)
        ),
        array(
            'title'     => esc_html__( 'LinkedIn', 'rhr' ),
            'id'        => 'share_linkedin_ebook',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_ebook', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Google Plus', 'rhr' ),
            'id'        => 'share_gplus_ebook',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_ebook', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Featured Image', 'rhr' ),
            'subtitle'  => __('Do you want to display featured Image (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_featured_show_ebook',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Date Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display date meta (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_date_show_ebook',
            'type'      => 'switch',
            'default'  => true,
        ),

        array(
            'title'     => esc_html__( 'Show/Hide Author Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display author name (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_author_show_ebook',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Author Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display bottom author media (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_author_media_show_ebook',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Tag Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display tags (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_tag_show_ebook',
            'type'      => 'switch',
            'default'  => true,
        ),
    )
));
Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Download Information', 'rhr' ),
    'id'        => 'rhr_single_ebooks_download',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'id'    => 'to_email_e',
            'type'  => 'text',
            'title' => esc_html__( 'To Email', 'rhr' ),
            'subtitle' => esc_html__('Enter form to email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'email@rhrinternational.com',
        ),
        array(
            'id'    => 'from_email_e',
            'type'  => 'text',
            'title' => esc_html__( 'From Email', 'rhr' ),
            'subtitle' => esc_html__('Enter form to email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'wordpress@rhrinternational.com',
        ),
				array(
            'id'    => 'subject_e',
            'type'  => 'text',
            'title' => esc_html__( 'Subject', 'rhr' ),
            'subtitle' => esc_html__('Enter form to email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'RHR | Research',
        ),
        array(
            'id'    => 'reply_msgprefix_e',
            'type'  => 'text',
            'title' => esc_html__( 'Message Greatings', 'rhr' ),
            'subtitle' => esc_html__('Enter Message Greatings (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Hello',
        ),
        array(
            'id'    => 'reply_msg_e',
            'type'  => 'textarea',
            'title' => esc_html__( 'Reply Message', 'rhr' ),
            'subtitle' => esc_html__('Enter Message Greatings (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Thanks for downloading.',
        ),
        array(
            'id'    => 'form_class_e',
            'type'  => 'text',
            'title' => esc_html__( 'Form Class', 'rhr' ),
            'subtitle' => esc_html__('Enter form class (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'demo-class',
        ),
        array(
            'id'    => 'form_bgclass_e',
            'type'  => 'text',
            'title' => esc_html__( 'BG Color Class', 'rhr' ),
            'subtitle' => esc_html__('Enter form background color class name (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'purple',
        ),
        array(
            'id'    => 'form_btn_e',
            'type'  => 'text',
            'title' => esc_html__( 'Button Class', 'rhr' ),
            'subtitle' => esc_html__('Enter form button class (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'form-button',
        ),
        array(
            'id'    => 'success_e',
            'type'  => 'text',
            'title' => esc_html__( 'Success Message', 'rhr' ),
            'subtitle' => esc_html__('Enter success message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Thanks for downloading.',
        ),
        array(
            'id'    => 'empty_e',
            'type'  => 'text',
            'title' => esc_html__( 'Empty Submit Message', 'rhr' ),
            'subtitle' => esc_html__('Enter empty submit message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Oops! file not found!',
        ),
        array(
            'id'    => 'error_e',
            'type'  => 'text',
            'title' => esc_html__( 'Error Message', 'rhr' ),
            'subtitle' => esc_html__('Enter error message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Oops! Something wrong, try again!',
        ),
        array(
            'id'    => 'name_empty_e',
            'type'  => 'text',
            'title' => esc_html__( 'Name Required Message', 'rhr' ),
            'subtitle' => esc_html__('Enter name required message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Field must not be blank.',
        ),
        array(
            'id'    => 'email_empty_e',
            'type'  => 'text',
            'title' => esc_html__( 'Email Required Message', 'rhr' ),
            'subtitle' => esc_html__('Enter email required message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Field must not be blank.',
        ),
        array(
            'id'    => 'email_invalid_e',
            'type'  => 'text',
            'title' => esc_html__( 'Invalid Email Message', 'rhr' ),
            'subtitle' => esc_html__('Enter invalid email message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Please Enter Valid Email Address.',
        ),
        array(
            'id'    => 'company_empty_e',
            'type'  => 'text',
            'title' => esc_html__( 'Company Required Message', 'rhr' ),
            'subtitle' => esc_html__('Enter company required email message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Field must not be blank.',
        ),
    )
));
