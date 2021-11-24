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
		'id'         => 'news',
		'title'      => __( 'News Options', 'rhr' ),
		'post_type'  => 'rhr_news',
		'context'    => 'normal',
		'priority'   => 'low',
		'tabs' 		 => true,
	),
	'fields'     => array(

		array(
			'title' => esc_html__('News Feature', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id' => $rhr_prefix . 'featured_news',
			'title' => esc_html__('Is It Featured News', 'rhr'),
			'description' => esc_html__('Do you want to display as featured news (or) Leave it empty to apply theme default.', 'rhr'),
			'std'	=> 'no',
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
				),
			'type' => 'switch',
		),
		array(
			'id'          => $rhr_prefix.'news_from',
			'title'       => esc_html__( 'News Date', 'rhr' ),
			'description' => esc_html__( 'Choose news date (or) Leave it empty to hide.', 'rhr' ),
			'placeholder' => '',
			'std'         => '',
			'type'        => 'date_picker_from_to',
		),
		array(
			'id' => $rhr_prefix . 'show_box',
			'title' => esc_html__('Show/Hide Box', 'rhr'),
			'description' => esc_html__('Do you want to show the sidebar box (or) Leave it empty to apply theme default.', 'rhr'),
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
			'placeholder' => 'Media Coverage',
			'type'        => 'text',
		),
		
		array(
			'id'          => $rhr_prefix.'btn',
			'title'       => esc_html__( 'Button Text', 'rhr' ),
			'description' => esc_html__( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
			'std' => '',
			'placeholder' => 'Read Article',
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
			'id'          => $rhr_prefix . 'profile_auth_m_n',
			'title'       => esc_html__('Select Author', 'rhr'),
			'description' => esc_html__('Select author for this post', 'rhr'),
			'std'         => [],
			'options'     => $team_profiles,
			'type' 	      => 'multi_select'
		),
	),
);

$news_metabox = new Metabox( $news_metabox );