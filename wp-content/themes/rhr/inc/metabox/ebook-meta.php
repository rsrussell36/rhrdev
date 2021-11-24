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

$ebook_metabox = array(
	'metabox'	=> array( 
		'id'         => 'ebooks',
		'title'      => __( 'eBooks Options', 'rhr' ),
		'post_type'  => 'rhr_ebooks',
		'context'    => 'normal',
		'priority'   => 'low',
		'tabs' 		 => true,
	),
	'fields'     => array(

		array(
			'title' => esc_html__('Single', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'          => $rhr_prefix.'title',
			'title'       => esc_html__( 'Enter Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Buy this Book at Amazon.com',
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'btn',
			'title'       => esc_html__( 'Button Text', 'rhr' ),
			'description' => esc_html__( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
			'std' => '',
			'placeholder' => 'Buy Book',
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
		array(
			'title' => esc_html__('Select Author', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'          => $rhr_prefix . 'profile_auth_m_eb',
			'title'       => esc_html__('Select Author', 'rhr'),
			'description' => esc_html__('Select author for this post', 'rhr'),
			'std'         => [],
			'options'     => $team_profiles,
			'type' 	      => 'multi_select'
		),
	),
);

$ebook_metabox = new Metabox( $ebook_metabox );