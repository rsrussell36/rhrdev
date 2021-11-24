<?php

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Mailchimp', 'rhr' ),
    'id'        => 'rhr_mailchimp',
    'icon'      => 'dashicons dashicons-buddicons-pm',
));

Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Mailchimp', 'rhr' ),
    'id'               => 'rhr_mailchimp_api',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'id'    => 'global_mailchimp_api',
            'type'  => 'text',
            'title' => esc_html__( 'Global', 'rhr' ),
            'subtitle' => esc_html__('Enter global mailchimp api (or) Leave it empty to hide.', 'rhr'),
            'default'    => '',
        ),
        array(
            'id'    => 'ue_mailchimp_api',
            'type'  => 'text',
            'title' => esc_html__( 'EU', 'rhr' ),
            'subtitle' => esc_html__('Enter EU mailchimp api (or) Leave it empty to hide.', 'rhr'),
            'default'    => '',
        ),
        array(
            'id'    => 'uk_mailchimp_api',
            'type'  => 'text',
            'title' => esc_html__( 'UK', 'rhr' ),
            'subtitle' => esc_html__('Enter Uk mailchimp api (or) Leave it empty to hide.', 'rhr'),
            'default'    => '',
        ),
    )
) );