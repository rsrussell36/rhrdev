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
		'id'         => 'research',
		'title'      => __( 'Research Options', 'rhr' ),
		'post_type'  => 'rhr_research',
		'context'    => 'normal',
		'priority'   => 'low',
		'tabs' 		 => true,
	),
	'fields'     => array(

		array(
			'title' => esc_html__('Set Research', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'          => $rhr_prefix.'title',
			'title'       => esc_html__( 'Enter Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Get this full Research Study for free',
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'btn',
			'title'       => esc_html__( 'Button Text', 'rhr' ),
			'description' => esc_html__( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
			'std' => '',
			'placeholder' => 'Download PDF',
			'type'        => 'text',
			'desc_tip' => esc_html__('If this field is empty the button won\'t display', 'rhr'),
		),
		array(
			'id'           => $rhr_prefix . 'download_file',
			'title'        => esc_html__('Download File', 'rhr'),
			'description'  => esc_html__('Choose download file (or) Leave it empty to apply default.', 'rhr'),
			'option'       => 'image', // image, audio, video
			'multi_select' => false, // true, false
			'type'         => 'media_manager',
		),
		array(
			'id' => $rhr_prefix . 'featured_image',
			'title' => esc_html__('Show/Hide Featured Image', 'rhr'),
			'description' => esc_html__('Do you want to show feature image (or) Leave it empty to apply theme default.', 'rhr'),
			'std'	=> 'show',
			'options' => array(
				'show' => 'Show',
				'hide' => 'Hide'
				),
			'type' => 'switch',
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
			'id'          => $rhr_prefix . 'profile_auth_m_r',
			'title'       => esc_html__('Select Author', 'rhr'),
			'description' => esc_html__('Select author for this post', 'rhr'),
			'std'         => [],
			'options'     => $team_profiles,
			'type' 	      => 'multi_select'
		),
	),
);

$research_metabox = new Metabox( $research_metabox );