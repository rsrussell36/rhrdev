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

$news_metabox = array(
	'metabox'	=> array( 
		'id'         => 'post',
		'title'      => __( 'Post Options', 'rhr' ),
		'post_type'  => 'post',
		'context'    => 'normal',
		'priority'   => 'low',
		'tabs' 		 => true,
	),
	'fields'     => array(

		array(
			'title' => esc_html__('Post Feature', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'          => $rhr_prefix . 'profile_auth_m',
			'title'       => esc_html__('Select Author', 'rhr'),
			'description' => esc_html__('Select author for this post', 'rhr'),
			'std'         => [],
			'options'     => $team_profiles,
			'type' 	      => 'multi_select'
		),
	),
);

$news_metabox = new Metabox( $news_metabox );