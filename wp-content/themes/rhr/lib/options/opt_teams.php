<?php

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Profiles', 'rhr' ),
    'id'        => 'rhr_teams',
    'icon'      => 'dashicons dashicons-businessperson',
));

Redux::set_section('rhr', array(
    'title'     => esc_html__( 'Single', 'rhr' ),
    'id'        => 'rhr_single_teams',
    'icon'      => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Show/Hide Featured Image', 'rhr' ),
            'subtitle'  => __('Do you want to display featured Image (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_featured_show_team',
            'type'      => 'switch',
            'default'  => true,
        ),
        array(
            'title'     => esc_html__( 'Show/Hide Designation Meta', 'rhr' ),
            'subtitle'  => __('Do you want to display designation meta (or) Leave it to apply theme default.', 'rhr'),
            'id'        => 'is_desig_show_team',
            'type'      => 'switch',
            'default'  => true,
        ),
    )
));
