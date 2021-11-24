<?php 

if(!defined('ABSPATH') || !defined('WPINC')) { exit; }

$rhr_prefix = '_rhr_';

$events_metabox = array(
	'metabox'	=> array( 
		'id'         => 'events',
		'title'      => __( 'Events Options', 'rhr' ),
		'post_type'  => 'rhr_events',
		'context'    => 'normal',
		'priority'   => 'low',
		'tabs' 		 => true,
	),
	'fields'     => array(

		array(
			'title' => esc_html__('Set Event', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id' => $rhr_prefix . 'next_events',
			'title' => esc_html__('Is It Next Event', 'rhr'),
			'description' => esc_html__('Do you want to display as next events (or) Leave it empty to apply theme default.', 'rhr'),
			'std'	=> 'no',
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
				),
			'type' => 'switch',
		),
		
		array(
			'id'          => $rhr_prefix.'start_from',
			'title'       => esc_html__( 'Start Date', 'rhr' ),
			'description' => esc_html__( 'Choose event start date (or) Leave it empty to hide.', 'rhr' ),
			'placeholder' => '',
			'std'         => '',
			'type'        => 'date_picker',
		),
		array(
			'id'          => $rhr_prefix.'end_from',
			'title'       => esc_html__( 'End Date', 'rhr' ),
			'description' => esc_html__( 'Choose event end date (or) Leave it empty to hide.', 'rhr' ),
			'placeholder' => '',
			'std'         => '',
			'type'        => 'date_picker',
		),
		array(
			'id'          => $rhr_prefix.'btn',
			'title'       => esc_html__( 'Button Text', 'rhr' ),
			'description' => esc_html__( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
			'std' => '',
			'placeholder' => 'Add To Calender',
			'type'        => 'text',
			'folds'		  => 1
		),
		array(
			'id'          => $rhr_prefix.'url',
			'title'       => esc_html__( 'Link', 'rhr' ),
			'description' => esc_html__( 'Enter button url like (or) Leave it empty to apply theme default.', 'rhr' ),
			'placeholder' => 'https://www.your-link.com/',
			'type'        => 'text',
		),
		array(
			'id' => $rhr_prefix . 'new_tab',
			'title' => esc_html__('Open New', 'rhr'),
			'description' => esc_html__('Do you want to open new tab (or) Leave it empty to apply theme default.', 'rhr'),
			'std'	=> 'no',
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
				),
			'type' => 'switch',
		),
	),
);

$events_metabox = new Metabox( $events_metabox );