<?php

if(!defined('ABSPATH') || !defined('WPINC')) { exit; }
$args = array(
	'post_type' => 'rhr_teams',
	'posts_per_page' => -1
  );
$teams = $teams = new WP_Query( $args );
$team_profiles = array();
$team_profiles[] = 'Select Author';
$query = new WP_Query( $args );
if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

$team_profiles[get_the_ID()] = get_the_title();

endwhile; endif;
wp_reset_query();
$rhr_prefix = '_rhr_';

$research_metabox = array(
	'metabox'	=> array(
		'id'         => 'webinar',
		'title'      => __( 'Webinar Options', 'rhr' ),
		'post_type'  => 'rhr_webinar',
		'context'    => 'normal',
		'priority'   => 'low',
		'tabs' 		 => true,
	),
	'fields'     => array(

		array(
			'title' => esc_html__('Set Webinar', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id' => $rhr_prefix . 'show_box',
			'title' => esc_html__('Show/Hide Box Content', 'rhr'),
			'description' => esc_html__('Do you want to show the sidebar box content (or) Leave it empty to apply theme default.', 'rhr'),
			'std'	=> 'yes',
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
				),
			'type' => 'switch',
		),
		array(
			'id'          => $rhr_prefix.'title',
			'title'       => esc_html__( 'Enter Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Watch this Webinar on Youtube',
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'btn',
			'title'       => esc_html__( 'Button Text', 'rhr' ),
			'description' => esc_html__( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
			'std' => '',
			'placeholder' => 'Watch Now',
			'type'        => 'text',
			'desc_tip' => esc_html__('If this field is empty the button won\'t display', 'rhr'),
		),
		array(
			'id'           => $rhr_prefix . 'url',
			'title'        => esc_html__('Video Url', 'rhr'),
			'placeholder' => 'Enter video url',
			'description'  => esc_html__('Enter video url (or) Leave it empty to apply default.', 'rhr'),
			'type'         => 'text',
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
		array(
			'title' => esc_html__('Select Author', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'          => $rhr_prefix . 'profile_auth_m_w',
			'title'       => esc_html__('Select Author', 'rhr'),
			'description' => esc_html__('Select author for this post', 'rhr'),
			'std'         => [],
			'options'     => $team_profiles,
			'type' 	      => 'multi_select'
		),
	),
);

$research_metabox = new Metabox( $research_metabox );
