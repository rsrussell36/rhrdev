<?php
namespace KC_GLOBAL;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Controls_Stack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Parallax{

	private static $instance;

	public static function dir_url(){
        $path = trailingslashit(plugin_dir_url( CREST_FILE )). 'components/control/parallax/';
		return $path;
	}

	public function init() {
		add_action( 'wp_enqueue_scripts', [$this, 'register_frontend_scripts'] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [$this, 'rhr_editor_scripts'], 99 );
		add_action( 'elementor/element/section/section_layout/after_section_end', [$this, 'register_controls' ], 10 );
	}
	public function register_frontend_scripts() {
		wp_enqueue_style( 'rhr-parallax-aos', self::dir_url() . 'assets/css/aos.css' , null, rhr__version() );
		wp_enqueue_style( 'rhr-parallax-style', self::dir_url() . 'assets/css/style.css' , null, rhr__version() );
		wp_enqueue_script( 'rhr-parallax-jarallax', self::dir_url() . 'assets/js/jarallax.js', array('jquery'), rhr__version(), false );
        wp_enqueue_script( 'rhr-parallax-wow', self::dir_url() . 'assets/js/wow.min.js', array('jquery'), rhr__version(), false );
		wp_enqueue_script( 'rhr-parallax-tweenmax', self::dir_url() . 'assets/js/TweenMax.min.js', array('jquery'), rhr__version(), true );
        wp_enqueue_script( 'rhr-parallax-jquery-easing', self::dir_url() . 'assets/js/jquery.easing.1.3.js', array('jquery'), rhr__version(), true );
		wp_enqueue_script( 'rhr-parallax-tilt', self::dir_url() . 'assets/js/tilt.jquery.min.js', array('jquery'), rhr__version(), true );
        wp_enqueue_script( 'anime-js', self::dir_url() . 'assets/js/anime.js', array('jquery'), rhr__version(), true );
		wp_enqueue_script( 'rhr-parallax-magician', self::dir_url() . 'assets/js/magician.js', array('jquery'), rhr__version(), true );
		//wp_enqueue_script( 'rhr-parallax-aos', self::dir_url() . 'assets/js/aos.js', array('jquery'), rhr__version(), true );
	}

	public function rhr_editor_scripts(){
		wp_enqueue_script( 'rhr-parallax-script', self::dir_url() . 'assets/js/scripts.js', array( 'jquery', 'elementor-frontend' ), rhr__version(), true );
	}

	public function register_controls($el)
    {
        $el->start_controls_section(
            'rhr_section_parallax',
            [
                'label' => __( 'Parallax', 'rhr' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $el->add_control(
            'rhr_background_parallax',
            [
                'label' => esc_html__('Background Parallax', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rhr' ),
                'label_off' => esc_html__('Hide', 'rhr' ),
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );
        $el->add_control(
            'rhr_background_parallax_speed', [
                'label' => esc_html__('Speed', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'max' => .9,
                'frontend_available' => true,
                'min' => .1,
                'step' => .1,
                'default' => 0.5,
                'condition' => [
                    'rhr_background_parallax' => 'yes',
                ]
            ]
        );
        $el->add_control(
			'rhr_section_parallax_multi',
			[
				'label'       => __( 'Type', 'rhr' ),
				'type'        => Controls_Manager::SELECT,
                'frontend_available' => true,
				'options'     => [
					''          => __( 'Select', 'rhr' ),
                    'multi'          => __( 'Multi Layer', 'rhr' ),
                ],
				'label_block' => 'true',
				
			]
		);
       
        $repeater = new Repeater();
        $repeater->add_control(
	        'parallax_style',
	        [   
	            'label' => esc_html__('Type', 'rhr' ),
	            'type' => Controls_Manager::CHOOSE,
	            'label_block' => false,
	            'options' => [
	                'mousemove' => [
	                    'title' => esc_html__('Mouse Track', 'rhr' ),
	                    'icon' => 'eicon-cursor-move',
	                ],
	                'onscroll' => [
	                    'title' => esc_html__('On Scroll', 'rhr' ),
	                    'icon' => 'eicon-scroll',
	                ],
	                'tilt' => [
	                    'title' => esc_html__('Tilt Effect', 'rhr' ),
	                    'icon' => 'eicon-parallax',
	                ],
	                'none' => [
	                    'title' => esc_html__('None Effect', 'rhr' ),
	                    'icon' => 'eicon-parallax',
	                ],
	            ],
	            'default' => 'mousemove',
	        ]
	    );
        $repeater->add_control(
            'item_source',
            [
                'label' => esc_html__( 'Item source', 'rhr'  ),
                'type' => Controls_Manager::HIDDEN,
                'label_block' => false,
                'toggle' => false,
                'default' => 'image',
                'classes' => 'elementor-control-start-end',
                'render_type' => 'ui',

            ]
        );
        $repeater->add_control(
            'image',[
                'label' => esc_html__('Choose Image', 'rhr' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'item_source' => 'image',
                ],
            ]
        );

        $repeater->add_control(
			'width_type',
			[
				'label'       => __( 'Image Width', 'rhr' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on' => __( 'Custom', 'rhr' ),
				'label_off' => __( 'Auto', 'rhr' ),
				'return_value' => 'custom',
				'default' => '',
			]
		);
        $repeater->add_responsive_control(
            'custom_width',
            [
                'label' => esc_html__( 'Custom Width', 'rhr'  ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'width_type' => 'custom',
                ],
                'size_units' => [ 'px', '%', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'custom_height',
            [
                'label' => esc_html__( 'Custom Height', 'rhr'  ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'width_type' => 'custom',
                ],
                'size_units' => [ 'px', '%', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'source_rotate', [
                'label' => esc_html__('Rotate', 'rhr' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic" => 'transform: rotate({{SIZE}}{{UNIT}})',
                ],

            ]
        );

        $repeater->add_responsive_control(
			'parallax_blur_effect',
			[
				'label' => esc_html__( 'Blur', 'rhr' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => .5,
					],
					'rem' => [
						'min' => 0,
                        'max' => 2,
                        'step' => .1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic' => 'filter: blur({{SIZE}}{{UNIT}});',
                ],
			]
        );
        $repeater->add_control(
            'pos_x_y',
            [
                'label'       => __( 'Position', 'rhr' ),
                'type'        => Controls_Manager::SWITCHER,
                'label_on' => __( 'Left', 'rhr' ),
                'label_off' => __( 'Right', 'rhr' ),
                'return_value' => 'left',
                'default' => 'left',
            ]
        );
        $repeater->add_responsive_control(
            'pos_x', [
                'label' => esc_html__('Horizontal', 'rhr' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -10000,
                        'max' => 10000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'condition' => [
                    'pos_x_y' => 'left',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.rhr-section-parallax-layer" => 'left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'pos_r', [
                'label' => esc_html__('Horizontal Position Right', 'rhr' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -10000,
                        'max' => 10000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'condition' => [
                    'pos_x_y' => '',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.rhr-section-parallax-layer" => 'right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'pos_y',[
                'label' => esc_html__('Vertical Position', 'rhr' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                    'px' => [
                        'min' => -10000,
                        'max' => 10000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.rhr-section-parallax-layer" => 'top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $repeater->add_control(
            'item_opacity',
            [
                'label' => esc_html__( 'Opacity', 'rhr'  ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'min' => 0,
                'step' => 1,
                'render_type' => 'none',
                'frontend_available' => true,
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'opacity:{{UNIT}}'
                ],
            ]
        );
        $repeater->add_control(
            '_mousemove_scroll_enable',
            [
                'label'       => __( 'Parallax Scroll', 'rhr' ),
                'type'        => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'rhr' ),
                'label_off' => __( 'No', 'rhr' ),
                'return_value' => 'yes',
                'default' => '',
                'frontend_available' => true,
                'render_type' => 'ui',
                'separator' => 'before',
                'condition' => [
                    'parallax_style' => 'mousemove'
                ],
            ]
        );
        $repeater->add_control(
            '_mousemove_parallax_transform', [
                'label' => esc_html__( 'Parallax Style', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'translateX' => esc_html__( 'X axis', 'rhr' ),
                    'translateY' => esc_html__( 'Y axis', 'rhr' ),
                    'rotate' => esc_html__( 'rotate', 'rhr' ),
                    'rotateX' => esc_html__( 'rotateX', 'rhr' ),
                    'rotateY' => esc_html__( 'rotateY', 'rhr' ),
                    'scale' => esc_html__( 'scale', 'rhr' ),
                    'scaleX' => esc_html__( 'scaleX', 'rhr' ),
                    'scaleY' => esc_html__( 'scaleY', 'rhr' ),
                ],
                'condition' => [
                    '_mousemove_scroll_enable' => 'yes',
                    'parallax_style' => 'mousemove'
                ],
            ]
        );
        $repeater->add_control(
            '_mousemove_parallax_transform_value', [
                'label' => esc_html__( 'Parallax Transition ', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '300',
                'condition' => [
                '_mousemove_scroll_enable' => 'yes',
                    'parallax_style' => 'mousemove'
                ]
            ]
        );
        $repeater->add_control(
            '_mousemove_smoothness', [
                'label' => esc_html__( 'Speed', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '500',
                'min' => 0,
                'max' => 1000,
                'step' => 100,
                'condition' => [
                    '_mousemove_scroll_enable' => 'yes',
                    'parallax_style' => 'mousemove'
                ]
            ]
        );
        $repeater->add_control(
            '_mousemove_offsettop',[
                'label' => esc_html__( 'Offset Top', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                '_mousemove_scroll_enable' => 'yes',
                    'parallax_style' => 'mousemove'
                ]
            ]
        );
        $repeater->add_control(
            '_mousemove_offsetbottom', [
                'label' => esc_html__( 'Offset Bottom', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'separator' => 'after',
                'condition' => [
                '_mousemove_scroll_enable' => 'yes',
                    'parallax_style' => 'mousemove'
                ]
            ]
        );
        $repeater->add_control(
            'parallax_speed', [
                'label' => esc_html__('Speed', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 50,
                'min' => 10,
                'max' => 150,
                'condition' => [
                    'parallax_style' => 'mousemove',
                ]
            ]
        );

        $repeater->add_control(
            'parallax_transform', [
                'label' => esc_html__( 'Parallax Style', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'translateY',
                'options' => [
                    'translateX' => esc_html__( 'X axis', 'rhr' ),
                    'translateY' => esc_html__( 'Y axis', 'rhr' ),
                    'rotate' => esc_html__( 'rotate', 'rhr' ),
                    'rotateX' => esc_html__( 'rotateX', 'rhr' ),
                    'rotateY' => esc_html__( 'rotateY', 'rhr' ),
                    'scale' => esc_html__( 'scale', 'rhr' ),
                    'scaleX' => esc_html__( 'scaleX', 'rhr' ),
                    'scaleY' => esc_html__( 'scaleY', 'rhr' ),
                ],
                'condition' => [
                    'parallax_style' => 'onscroll'
                ],
            ]
        );
        $repeater->add_control(
            'parallax_transform_value', [
                'label' => esc_html__( 'Parallax Transition ', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '300',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'smoothness', [
                'label' => esc_html__( 'Speed', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '500',
                'min' => 0,
                'max' => 1000,
                'step' => 100,
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'offsettop',[
                'label' => esc_html__( 'Offset Top', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'offsetbottom', [
                'label' => esc_html__( 'Offset Bottom', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'maxtilt',[
                'label' => esc_html__( 'MaxTilt', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '20',
                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'scale',[
                'label' => esc_html__( 'Image Scale', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'disableaxis', [
                'label' => esc_html__( 'Disable Axis', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'rhr' ),
                    'x' => esc_html__( 'X axis', 'rhr' ),
                    'y' => esc_html__( 'Y axis', 'rhr' ),
                ],

                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'wow_enable',
            [
                'label'       => __( 'Enable Wow', 'rhr' ),
                'type'        => Controls_Manager::SWITCHER,
                // 'frontend_available' => true,
                // 'render_type' => 'ui',
                'label_on' => __( 'Yes', 'rhr' ),
                'label_off' => __( 'No', 'rhr' ),
                'return_value' => 'enable',
                'default' => '',
            ]
        );
        $repeater->add_control(
            'wow_animation',
            [
                'label' => esc_html__( 'Wow Animation', 'rhr' ),
                'type' => Controls_Manager::ANIMATION,
                'frontend_available' => true,
                'render_type' => 'ui',
                'default' => 'fadeIn',
                'condition' => [
                    'wow_enable' => 'enable',
                ]  
            ]
         );
   
        $repeater->add_control(
            'wow_delay',
            [
                'label' => esc_html__( 'Wow Delay', 'rhr' ) . ' (ms)',
                'type' => Controls_Manager::NUMBER,
                // 'frontend_available' => true,
                // 'render_type' => 'ui',
                'default' => '',
                'min' => 1,
                'step' => 100,
                'condition' => [
                    'wow_enable' => 'enable',
                    'wow_animation!' => '',
                ],
            ]
        );
        $repeater->add_control(
            'wow_mobile',
            [
                'label'       => __( 'Wow Mobile', 'rhr' ),
                'type'        => Controls_Manager::SWITCHER,
                // 'frontend_available' => true,
                // 'render_type' => 'ui',
                'label_on' => __( 'Yes', 'rhr' ),
                'label_off' => __( 'No', 'rhr' ),
                'return_value' => 'yes',
                'default' => 'yes',
                 'condition' => [
                    'wow_enable' => 'enable',
                ],
            ]
        );
        $repeater->add_control(
            '_anim_enable',
            [
                'label'       => __( 'Enable Animation', 'rhr' ),
                'type'        => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'rhr' ),
                'label_off' => __( 'No', 'rhr' ),
                'return_value' => 'yes',
                'default' => '',
                'frontend_available' => true,
                'render_type' => 'ui',
            ]
        );
         $repeater->add_control(
            '_parallax_animation',
            [
                'label' => esc_html__( 'Animation', 'rhr' ),
                'type' => Controls_Manager::ANIMATION,
                'frontend_available' => true,
                'render_type' => 'ui',
                'default' => '',
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic" => '-webkit-animation-name:{{UNIT}}',
                    "{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic" => 'animation-name:{{UNIT}}',
                ],
                'condition' => [
                    '_anim_enable' => 'yes'
                ],
            ]
         );
         $repeater->add_control(
            'animation_speed',
            [
                'label' => esc_html__( 'Animation speed', 'rhr' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'frontend_available' => true,
                'default' => '0.3',
                'min' => 0.1,
                'step' => 100,
                'render_type' => 'ui',
                'frontend_available' => true,
                'condition' => [
                    '_anim_enable' => 'yes',
                    '_parallax_animation!' => '',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic" => '-webkit-animation-duration:{{UNIT}}s',
                    "{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic" => 'animation-duration:{{UNIT}}s'
                ],
            ]
        );
        $repeater->add_control(
            'animation_iteration_count',
            [
                'label' => esc_html__( 'Animation Iteration Count', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'frontend_available' => true,
                'default' => 'infinite',
                'options' => [
                    'infinite' => esc_html__( 'Infinite', 'rhr' ),
                    'unset' => esc_html__( 'Unset', 'rhr' ),
                ],
                'condition' => [
                    '_anim_enable' => 'yes',
                    '_parallax_animation!' => '',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .rhr-parallax-graphic" => 'animation-iteration-count:{{UNIT}}'
                ],
            ]
        );
        $repeater->add_control(
            'zindex',   [
                'label' => esc_html__('z-index', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('5', 'rhr' ),
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'z-index: {{UNIT}}',
                ],
            ]
        );
        $el->add_control(
            'rhr_parallax_multi_items',
            [
                'label' => esc_html__( 'Parallax', 'rhr' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'frontend_available' => true,
                'title_field' => '{{{ parallax_style }}}',
                'condition' => [
                    'rhr_section_parallax_multi' => 'multi',
                ],

            ]
        );
        
        $el->add_control(
            'rhr_section_parallax_overflow',
            [
                'label' => esc_html__('Section Overflow', 'rhr' ),
                'type' => Controls_Manager::CHOOSE,
				'default' => 'visible',
                'options' => [
                    'visible' => [
                        'title' => esc_html__('Visible', 'rhr' ),
                        'icon' => 'eicon-preview-medium',
                    ],
                    'hidden' => [
                        'title' => esc_html__('Hidden', 'rhr' ),
                        'icon' => 'eicon-help-o',
                    ],
                ], 
                'selectors' => [
                    "{{WRAPPER}}" => 'overflow: {{VALUE}} !important'
                ]
            ]
        );

        $el->end_controls_section();
    }

	public static function get_instance(){
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
