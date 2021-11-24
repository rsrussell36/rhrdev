<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Home_Content extends CREST_BASE{

    public function get_name(){
        return 'rhr-home-content';
    }

    public function get_title(){
        return esc_html__( 'Home Content', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-text';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'content', 'text', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_hc_preset',
            [
                'label' => __( 'Preset', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_design_type',
            [
                'label' => esc_html__( 'Design Format', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'design-1' => 'Design 1',
                    'design-2' => 'Design 2',
                ],
                'default' => 'design-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_hc_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_hc_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Today’s Feature: Working With RHR', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_hc_sub_title',
            [
                'label' => 'Sub Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'SPOTLIGHT', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter sub title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
			'_rhr_hc_contents',
			[
				'label' => __( 'Content', 'rhr' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'As a HR executive working with RHR, you will discover how to build a high-performing team..', 'rhr' ),
				'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
			]
		);
        $this->add_control(
            '_rhr_hc_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Discover More', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Discover More', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
                'condition' => [
                    '_rhr_design_type' => ['design-2']
                ]
            ]
        );
        $this->add_control(
            '_rhr_hc_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_design_type' => ['design-2'],
                    '_rhr_hc_btn!' => '',
                ],
            ]
        );
        $this->add_control(
			'_rhr_hc_img',
			[
				'label' => __( 'Image', 'rhr' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
                ],
                'description' => __( 'Choose image (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_design_type' => ['design-2']
                ]
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_home_style_section',
            [
                'label' => __('Style', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_rhr_home_color',
            [
                'label' => esc_html__('Title Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-home-content .pc-home-hightlight .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_home_subtitle_color',
            [
                'label' => esc_html__('Sub Title Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-home-content .pc-home-hightlight .caption span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_home_content_color',
            [
                'label' => esc_html__('Text Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-home-content .pc-home-hightlight .paragraph' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_home_btn_color',
            [
                'label' => esc_html__('Button Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-home-content .pc-home-hightlight .link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $wrap_class = $settings['_rhr_design_type'] == 'design-2' ? 'pc-home-hightlight' : 'pc-home-spotlight';
        $sub_class = $settings['_rhr_design_type'] == 'design-2' ? ' c-white' : '';
        $title_class = $settings['_rhr_design_type'] == 'design-2' ? 't-white' : '';
        $content_class = $settings['_rhr_design_type'] == 'design-2' ? 'p-white' : 'p-gray';
        $this->__open_wrap();
        ?>
        <div class="pages-content pc-gray <?php echo esc_attr($wrap_class);?>">
            <?php if( $settings['_rhr_design_type'] == 'design-2' && !empty($settings['_rhr_hc_img']) ) :
                $_image = wp_get_attachment_image_url( $settings['_rhr_hc_img']['id'], 'large' );
                ?>
                <div class="image i-full" style="background-image: url(<?php echo esc_url($_image); ?>);"></div>
            <?php endif; ?>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-5">
                        <?php if (isset($settings['_rhr_hc_sub_title']) && !empty($settings['_rhr_hc_sub_title'])): ?>
                            <div class="caption <?php echo esc_attr($sub_class);?>">
                                <span><?php echo $this->parse_text_editor($settings['_rhr_hc_sub_title']); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($settings['_rhr_hc_title']) && !empty($settings['_rhr_hc_title'])): ?>
                            <h2 class="title t-medium <?php echo esc_attr($title_class);?>">
                                <?php echo $this->parse_text_editor($settings['_rhr_hc_title']); ?>
                            </h2>
                        <?php endif; ?>
                    </div>

                    <div class="col col-5">
                        <?php if (isset($settings['_rhr_hc_contents']) && !empty($settings['_rhr_hc_contents'])): ?>
                            <div class="paragraph <?php echo esc_attr($content_class);?>"><?php echo $this->parse_text_editor($settings['_rhr_hc_contents']); ?></div>
                        <?php endif; ?>
                        <?php if( $settings['_rhr_design_type'] == 'design-2' ) : ?>
                            <?php if (isset($settings['_rhr_hc_btn']) && !empty($settings['_rhr_hc_btn'])): ?>
                                <a <?php echo rhr__link($settings['_rhr_hc_link']); ?> class="link l-white" data-cursor="scale">
                                    <?php echo $this->parse_text_editor($settings['_rhr_hc_btn']); ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $this->__close_wrap();
    }
}
