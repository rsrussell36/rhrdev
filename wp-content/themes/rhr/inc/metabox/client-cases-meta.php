<?php

if(!defined('ABSPATH') || !defined('WPINC')) { exit; }

$rhr_prefix = '_rhr_';

$research_metabox = array(
	'metabox'	=> array(
		'id'         => 'client_cases',
		'title'      => __( 'Client Cases Options', 'rhr' ),
		'post_type'  => 'rhr_client_cases',
		'context'    => 'normal',
		'priority'   => 'low',
		'tabs' 		 => true,
	),
	'fields'     => array(
		array(
			'title' => esc_html__('General', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'           => $rhr_prefix.'s_logo',
			'title'        => esc_html__('Logo', 'rhr'),
			'description'  => esc_html__('Upload logo (or) Leave it empty to apply default.', 'rhr'),
			'option'       => 'image', // image, audio, video
			'multi_select' => false, // true, false
			'type'         => 'media_manager',
		),
		array(
			'title' => esc_html__('Challenge', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'          => $rhr_prefix.'c_title',
			'title'       => esc_html__( 'Enter Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Objectively identifying, then preparing and supporting future leaders.',
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'          => $rhr_prefix.'c__sub_title',
			'title'       => esc_html__( 'Enter Sub Title', 'rhr' ),
			'description' => esc_html__( 'Enter sub title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => '',
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'          => $rhr_prefix.'c_description',
			'title'       => esc_html__( 'Description', 'rhr' ),
			'description' => esc_html__( 'Enter description text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Description here...', 'rhr'),
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'title' => esc_html__('Solution', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'          => $rhr_prefix.'s_title',
			'title'       => esc_html__( 'Enter Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Objectively identifying, then preparing and supporting future leaders.',
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'          => $rhr_prefix.'s_description',
			'title'       => esc_html__( 'Description', 'rhr' ),
			'description' => esc_html__( 'Enter description text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Description here...', 'rhr'),
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'          => $rhr_prefix.'s_re_title_one',
			'title'       => esc_html__( 'Title', 'rhr' ),
			'description' => esc_html__( 'Enter title (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Assessment',
			'type'        => 'text',
		),

		array(
			'id'          => $rhr_prefix.'s_re_desc_one',
			'title'       => esc_html__( 'Text', 'rhr' ),
			'description' => esc_html__( 'Enter text here (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Text Here...', 'rhr'),
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'           => $rhr_prefix.'s_re_icon_one',
			'title'        => esc_html__('Icon', 'rhr'),
			'description'  => esc_html__('Upload icon (or) Leave it empty to apply default.', 'rhr'),
			'option'       => 'image', // image, audio, video
			'multi_select' => false, // true, false
			'type'         => 'media_manager',
		),
		array(
			'id'          => $rhr_prefix.'s_re_title_two',
			'title'       => esc_html__( 'Title', 'rhr' ),
			'description' => esc_html__( 'Enter title (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Insightful Data',
			'type'        => 'text',
		),

		array(
			'id'          => $rhr_prefix.'s_re_desc_two',
			'title'       => esc_html__( 'Text', 'rhr' ),
			'description' => esc_html__( 'Enter text here (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Text Here...', 'rhr'),
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'           => $rhr_prefix.'s_re_icon_two',
			'title'        => esc_html__('Icon', 'rhr'),
			'description'  => esc_html__('Upload icon (or) Leave it empty to apply default.', 'rhr'),
			'option'       => 'image', // image, audio, video
			'multi_select' => false, // true, false
			'type'         => 'media_manager',
		),
		array(
			'id'          => $rhr_prefix.'s_re_title_three',
			'title'       => esc_html__( 'Title', 'rhr' ),
			'description' => esc_html__( 'Enter title (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Feedback and Development',
			'type'        => 'text',
		),

		array(
			'id'          => $rhr_prefix.'s_re_desc_three',
			'title'       => esc_html__( 'Text', 'rhr' ),
			'description' => esc_html__( 'Enter text here (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Text Here...', 'rhr'),
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'           => $rhr_prefix.'s_re_icon_three',
			'title'        => esc_html__('Icon', 'rhr'),
			'description'  => esc_html__('Upload icon (or) Leave it empty to apply default.', 'rhr'),
			'option'       => 'image', // image, audio, video
			'multi_select' => false, // true, false
			'type'         => 'media_manager',
		),
		array(
			'title' => esc_html__('Results', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),

		array(
			'id'          => $rhr_prefix.'r_title',
			'title'       => esc_html__( 'Enter Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Title here...', 'rhr'),
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'          => $rhr_prefix.'r_number_one',
			'title'       => esc_html__( 'Enter Number', 'rhr' ),
			'description' => esc_html__( 'Enter number (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => '+35',
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'r_number_title_one',
			'title'       => esc_html__( 'Number Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Increased intent to stay', 'rhr'),
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'r_number_two',
			'title'       => esc_html__( 'Enter Number', 'rhr' ),
			'description' => esc_html__( 'Enter number (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => '+104',
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'r_number_title_two',
			'title'       => esc_html__( 'Number Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Improved sense of belonging', 'rhr'),
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'r_number_three',
			'title'       => esc_html__( 'Enter Number', 'rhr' ),
			'description' => esc_html__( 'Enter number (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => '+150',
			'type'        => 'text',
		),

		array(
			'id'          => $rhr_prefix.'r_number_title_three',
			'title'       => esc_html__( 'Number Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Peak performance reached', 'rhr'),
			'type'        => 'text',
		),
		array(
			'id'          => $rhr_prefix.'r_text',
			'title'       => esc_html__( 'Descriptions', 'rhr' ),
			'description' => esc_html__( 'Enter descriptions text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Description here...', 'rhr'),
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'          => $rhr_prefix.'r_bx_title',
			'title'       => esc_html__( 'Box Title', 'rhr' ),
			'description' => esc_html__( 'Enter title text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => esc_html__( 'Read more about this Case Study', 'rhr' ),
			'type'        => 'textarea',
			'rows'		  => 2,
			'cols'		  => 50
		),
		array(
			'id'          => $rhr_prefix.'r_btn',
			'title'       => esc_html__( 'Button Text', 'rhr' ),
			'description' => esc_html__( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
			'std' => '',
			'placeholder' => 'Download PDF',
			'type'        => 'text',
			'desc_tip' => esc_html__('If this field is empty the button won\'t display', 'rhr'),
		),
		array(
			'id'           => $rhr_prefix.'r_download_file',
			'title'        => esc_html__('Download File', 'rhr'),
			'description'  => esc_html__('Choose download file (or) Leave it empty to apply default.', 'rhr'),
			'option'       => 'image', // image, audio, video
			'multi_select' => false, // true, false
			'type'         => 'media_manager',
		),
		array(
			'id' => $rhr_prefix.'r_new_tab',
			'title' => esc_html__('Open New', 'rhr'),
			'description' => esc_html__('Do you want to open new tab (or) Leave it empty to apply theme default.', 'rhr'),
			'std'	=> 'yes',
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
				),
			'type' => 'switch',
		),
		array(
			'title' => esc_html__('Home Slider Text', 'rhr'),
			'icon'  => 'icon-name',
			'type'  => 'heading',
		),
		array(
			'id'          => $rhr_prefix.'h_s_text',
			'title'       => esc_html__( 'Enter Text', 'rhr' ),
			'description' => esc_html__( 'Enter text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Building high-performing teams in Private Equity.',
			'type'        => 'textarea',
			'rows'		  => 5,
			'cols'		  => 50
		),
		array(
			'id'          => $rhr_prefix.'h_s_btntext',
			'title'       => esc_html__( 'Enter Button Text', 'rhr' ),
			'description' => esc_html__( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
			'std' 		  => '',
			'placeholder' => 'Read Full Story',
			'type'        => 'text',
		),
	),
);

$research_metabox = new Metabox( $research_metabox );
