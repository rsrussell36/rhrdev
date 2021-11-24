<?php

Redux::set_section('rhr', array(
	'title'     => esc_html__( 'Research', 'rhr' ),
	'id'        => 'rhr_research',
	'icon'      => 'dashicons dashicons-code-standards',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Single', 'rhr' ),
    'id'        => 'rhr_single_social_research',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide Share', 'rhr' ),
            'subtitle'  => __('Choose this option to show social share  (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_show_share_research',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Facebook', 'rhr' ),
            'id'        => 'share_facebook_research',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_research', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Twitter', 'rhr' ),
            'id'        => 'share_twitter_research',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_research', '=', true)
        ),
        array(
            'title'     => esc_html__( 'LinkedIn', 'rhr' ),
            'id'        => 'share_linkedin_research',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_research', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Google Plus', 'rhr' ),
            'id'        => 'share_gplus_research',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_show_share_research', '=', true)
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Featured Image', 'rhr' ),
            'subtitle'  => __('Do you want to display featured Image (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_featured_show_research',
            'type'      => 'switch',
            'default'  => true,
        ),
				array(
            'title'     => esc_html__( 'Show/Hide Author Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display bottom author media (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_author_media_show_re',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Tag Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display tags (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_tag_show_research',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Related research Section', 'rhr' ),
            'subtitle'  => __('Do you want to display related research section (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_rel_show_research',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Date Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display related research date section (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_rel_date_show_research',
            'type'      => 'switch',
            'default'  => true,
            'required'    => array('is_rel_show_research', '=', true)
        ),
        array(
            'id'    => 'single_rel_title_research',
            'type'  => 'text',
            'title' => esc_html__( 'Related research Title', 'rhr' ),
            'subtitle' => esc_html__('Type the related research section title here (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'Related Research Study',
            'required'    => array('is_rel_show_research', '=', true)
        ),
        array(
            'id'    => 'single_rel_title_limit_research',
            'type'  => 'text',
            'title' => esc_html__( 'Title Limit', 'rhr' ),
            'subtitle' => esc_html__('Type the numerical value for the post title (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '30',
            'required'    => array('is_rel_show_research', '=', true)
        ),
        array(
            'id'    => 'single_rel_limit_research',
            'type'  => 'text',
            'title' => esc_html__( 'Number of Related research', 'rhr' ),
            'subtitle' => esc_html__('Enter the integer value to display related post (or) Leave it to apply theme default.', 'rhr'),
            'default'    => '6',
            'required'    => array('is_rel_show_research', '=', true)
        ),
        array(
            'id'    => 'single_rel_orderby_research',
            'type'  => 'select',
            'title' => esc_html__( 'Order By', 'rhr' ),
            'subtitle' => esc_html__('Choose the order by selection (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'date',
            'options'  => array(
                'date' => 'Date',
                'title' => 'Title',
                'rand' => 'Random',
            ),
            'required'    => array('is_rel_show_research', '=', true)
        ),
        array(
            'id'    => 'single_rel_sortingorder_research',
            'type'  => 'select',
            'title' => esc_html__( 'Sorting Order', 'rhr' ),
            'subtitle' => esc_html__('Choose the sorting order (or) Leave it to apply theme default.', 'rhr'),
            'default'    => 'desc',
            'options'  => array(
                'asc' => 'Ascending',
                'desc' => 'Descending',
            ),
            'required'    => array('is_rel_show_research', '=', true)
        ),
    )
));
Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Download Information', 'rhr' ),
    'id'        => 'rhr_single_research_download',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'id'    => 'to_email_r',
            'type'  => 'text',
            'title' => esc_html__( 'To Email', 'rhr' ),
            'subtitle' => esc_html__('Enter form to email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'email@rhrinternational.com',
        ),
        array(
            'id'    => 'from_email_r',
            'type'  => 'text',
            'title' => esc_html__( 'From Email', 'rhr' ),
            'subtitle' => esc_html__('Enter form to email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'wordpress@rhrinternational.com',
        ),
				array(
            'id'    => 'subject_r',
            'type'  => 'text',
            'title' => esc_html__( 'Subject', 'rhr' ),
            'subtitle' => esc_html__('Enter form to email (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'RHR | Research',
        ),
        array(
            'id'    => 'reply_msgprefix_r',
            'type'  => 'text',
            'title' => esc_html__( 'Message Greatings', 'rhr' ),
            'subtitle' => esc_html__('Enter Message Greatings (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Hello',
        ),
        array(
            'id'    => 'reply_msg_r',
            'type'  => 'textarea',
            'title' => esc_html__( 'Reply Message', 'rhr' ),
            'subtitle' => esc_html__('Enter Message Greatings (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Thanks for downloading.',
        ),
        array(
            'id'    => 'form_class_r',
            'type'  => 'text',
            'title' => esc_html__( 'Form Class', 'rhr' ),
            'subtitle' => esc_html__('Enter form class (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'demo-class',
        ),
        array(
            'id'    => 'form_bgclass_r',
            'type'  => 'text',
            'title' => esc_html__( 'BG Color Class', 'rhr' ),
            'subtitle' => esc_html__('Enter form background color class name (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'purple',
        ),
        array(
            'id'    => 'form_btn_r',
            'type'  => 'text',
            'title' => esc_html__( 'Button Class', 'rhr' ),
            'subtitle' => esc_html__('Enter form button class (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'form-button',
        ),
        array(
            'id'    => 'success_r',
            'type'  => 'text',
            'title' => esc_html__( 'Success Message', 'rhr' ),
            'subtitle' => esc_html__('Enter success message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Thanks for downloading.',
        ),
        array(
            'id'    => 'empty_r',
            'type'  => 'text',
            'title' => esc_html__( 'Empty Submit Message', 'rhr' ),
            'subtitle' => esc_html__('Enter empty submit message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Oops! file not found!',
        ),
        array(
            'id'    => 'error_r',
            'type'  => 'text',
            'title' => esc_html__( 'Error Message', 'rhr' ),
            'subtitle' => esc_html__('Enter error message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Oops! Something wrong, try again!',
        ),
        array(
            'id'    => 'name_empty_r',
            'type'  => 'text',
            'title' => esc_html__( 'Name Required Message', 'rhr' ),
            'subtitle' => esc_html__('Enter name required message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Field must not be blank.',
        ),
        array(
            'id'    => 'email_empty_r',
            'type'  => 'text',
            'title' => esc_html__( 'Email Required Message', 'rhr' ),
            'subtitle' => esc_html__('Enter email required message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Field must not be blank.',
        ),
        array(
            'id'    => 'email_invalid_r',
            'type'  => 'text',
            'title' => esc_html__( 'Invalid Email Message', 'rhr' ),
            'subtitle' => esc_html__('Enter invalid email message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Please Enter Valid Email Address.',
        ),
        array(
            'id'    => 'company_empty_r',
            'type'  => 'text',
            'title' => esc_html__( 'Company Required Message', 'rhr' ),
            'subtitle' => esc_html__('Enter company required email message (or) Leave it empty to hide.', 'rhr'),
            'default'    => 'Field must not be blank.',
        ),
    )
));
