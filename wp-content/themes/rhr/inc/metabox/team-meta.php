<?php

if(!defined('ABSPATH') || !defined('WPINC')) { exit; }

$rhr_prefix = '_rhr_';

$teams_metabox = array(
	'metabox'	=> array(
		'id'         => 'teams',
		'title'      => __( 'Team Options', 'rhr' ),
		'post_type'  => 'rhr_teams',
		'context'    => 'normal',
		'priority'   => 'low',
		'tabs' 		 => true,
	),
	'fields'     => array(

		array(
			'title' => esc_html__('Teams Feature', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),

		array(
			'id'          => $rhr_prefix.'desig',
			'title'       => esc_html__( 'Enter Designation One', 'rhr' ),
			'description' => esc_html__( 'Enter Designation here (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Senior Partner,',
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'desig2',
			'title'       => esc_html__( 'Enter Designation Two', 'rhr' ),
			'description' => esc_html__( 'Enter Designation here (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Business Development & Marketing',
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'bio',
			'title'       => esc_html__( 'Enter Bio', 'rhr' ),
			'description' => esc_html__( 'Enter bio (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Enter Bio',
			'type'        => 'textarea',
		),
		array(
			'id'          => $rhr_prefix.'code',
			'title'       => esc_html__( 'Enter Inner Bio', 'rhr' ),
			'description' => esc_html__( 'Enter inner bio text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Enter Inner Bio',
			'type'        => 'textarea',
		),
	),
);

$teams_metabox = new Metabox( $teams_metabox );
