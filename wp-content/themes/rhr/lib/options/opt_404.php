<?php
// Header Section
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Error Pages', 'rhr' ),
    'id'               => 'rhr_404_sec',
    'customizer_width' => '400px',
    'icon'             => 'eicon-error-404',
));


// 404
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Error Pages', 'rhr' ),
    'id'               => 'rhr_error_page',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Show/Hide 404', 'rhr' ),
            'subtitle'  => __('Do you want to display the 404 image?', 'rhr'),
            'id'        => 'is_404_show',
            'type'      => 'switch',
            'default'  => true,
        ),

        array(
            'id'    => 'rhr_404_error_text',
            'title' => esc_html__( '404 Error Text', 'rhr' ),
            'subtitle' => esc_html__('Enter the 404 error text here', 'rhr'),
            'type'  => 'textarea',
            'default'    => esc_html__('Sorry, but the page you were looking for cannot be found. Please inform us about this error.', 'rhr'),
        ),
        array(
            'id'    => 'rhr_404_btn_text',
            'title' => esc_html__( '404 Button Text', 'rhr' ),
            'subtitle' => esc_html__('Enter the 404 button text (or) Leave it to aply theme default.', 'rhr'),
            'type'  => 'text',
            'default'    => esc_html__('Back to home', 'rhr'),
        ),
        array(
            'id'    => 'rhr_404_url',
            'type'  => 'text',
            'title' => esc_html__( 'Button URL', 'rhr' ),
            'subtitle' => esc_html__('Enter the 404 button url (or) Leave it to aply theme default.', 'rhr'),
            'default'    => home_url( '/' ),
            'required'    => array('rhr_404_btn_text', '!=', '')
        ),
    )
) );
