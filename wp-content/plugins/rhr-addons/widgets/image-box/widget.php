<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Image_Box extends CREST_BASE{

    public function get_name(){
        return 'rhr-image-box';
    }

    public function get_title(){
        return esc_html__( 'Image Box', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-image-box';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'image box', 'box', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_imgbx_section',
            [
                'label' => __( 'Preset', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_design_imgbx_section',
            [
                'label' => esc_html__( 'Design Format', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'style_one' => 'Style One',
                    'style_two' => 'Style Two',
                    'style_three' => 'Style Three',
                ],
                'default' => 'style_one',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_imgbx_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );

        $this->add_control(
			'_rhr_imgbx_img',
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
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
			]
		);
        $this->add_control(
            '_rhr_imgbx_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Venture Capital', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_design_imgbx_section' => ['style_two']
                ]
            ]
        );
        $this->add_control(
			'_rhr_imgbx_contents',
			[
				'label' => __( 'Content', 'rhr' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'Young, fast-growing companies face high levels of execution risk. Helping Founders and teams evolve as leaders increases the odds of success.', 'rhr' ),
				'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_design_imgbx_section' => ['style_two']
                ]
			]
		);
        $this->add_control(
            '_rhr_imgbx_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Read More', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Read More', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
                'condition' => [
                    '_rhr_design_imgbx_section' => ['style_two']
                ]
            ]
        );
        $this->add_control(
            '_rhr_imgbx_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_design_imgbx_section' => ['style_two'],
                    '_rhr_imgbx_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_reverse_layout',
            [
                'label' => __('Reverse Layout', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => __( 'Enable this to reverse (or) Leave it empty to apply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_design_imgbx_section' => ['style_two'],
                ],
            ]
        );
        $this->add_control(
            'show_triangle',
            [
                'label' => __('Enable Tringle', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'rhr' ),
                'label_off' => __('Hide', 'rhr' ),
                'default' => 'yes',
                'description' => __( 'Enable tringle (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_design_imgbx_section' => ['style_one', 'style_three']
                ]
            ]
        );
        $this->add_control(
            'rhr_triangle_color',
            [
                'label' => 'Triangle Color',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'blue', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Triangle color name', 'rhr' ),
                'description' => __( 'Enter triangle color name like (blue, orange, red) (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    'show_triangle' => 'yes',
                    '_rhr_design_imgbx_section' => ['style_one']
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $imgbx_image = wp_get_attachment_image_url( $settings['_rhr_imgbx_img']['id'], $settings['thumbnail_size'] );
        $tringle_color = !empty($settings['rhr_triangle_color']) ? $settings['rhr_triangle_color'] : '';
        $_rhr_reverse_layout = 'yes' === $settings['_rhr_reverse_layout'] ? 'image-reverse' : '';
        $this->__open_wrap();
        ?>
        <?php if( isset($settings['_rhr_design_imgbx_section']) && $settings['_rhr_design_imgbx_section'] == 'style_one' ) : ?>
            <?php if( isset($settings['_rhr_imgbx_img']) && !empty($settings['_rhr_imgbx_img']) ) : ?>
            <div class="pages-content pc-paddingTop pc-solutions-inner">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-10">
                        <?php if( isset($imgbx_image) && !empty($imgbx_image) ) : ?>
                            <div class="image i-solutions">
                                <img src="<?php echo esc_url($imgbx_image); ?>" alt="<?php echo get_post_meta($settings['_rhr_imgbx_img']['id'], '_wp_attachment_image_alt', true); ?>">
                            </div>
                        <?php endif; ?>
                        <?php if (isset($settings['show_triangle']) && !empty($settings['show_triangle']) && 'yes' === $settings['show_triangle']): ?>
                            <div class="triangle-solutions svg" data-color="<?php echo esc_attr($tringle_color); ?>"></div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php elseif(isset($settings['_rhr_design_imgbx_section']) && $settings['_rhr_design_imgbx_section'] == 'style_three' ): ?>
            <?php if( isset($settings['_rhr_imgbx_img']) && !empty($settings['_rhr_imgbx_img']) ) : ?>
                <div class="pages-content pc-landingM">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col col-10">
                            <?php if( isset($imgbx_image) && !empty($imgbx_image) ) : ?>
                                <div class="image">
                                    <img src="<?php echo esc_url($imgbx_image); ?>" alt="<?php echo get_post_meta($settings['_rhr_imgbx_img']['id'], '_wp_attachment_image_alt', true); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if (isset($settings['show_triangle']) && !empty($settings['show_triangle']) && 'yes' === $settings['show_triangle']): ?>
                                <div class="triangle-solutions svg" data-color="<?php echo esc_attr($tringle_color); ?>"></div>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="pages-content pc-landing">
                <div class="container-fluid">
                    <div class="row justify-content-center <?php echo esc_attr($_rhr_reverse_layout);?>">
                        <?php if( isset($settings['_rhr_imgbx_img']) && !empty($settings['_rhr_imgbx_img']) ) : ?>
                            <?php if( isset($imgbx_image) && !empty($imgbx_image) ) : ?>
                                <div class="col col-6">
                                <a <?php echo rhr__link($settings['_rhr_imgbx_link']); ?> data-cursor="scale">
                                    <img class="image" src="<?php echo esc_url($imgbx_image); ?>" alt="<?php echo get_post_meta($settings['_rhr_imgbx_img']['id'], '_wp_attachment_image_alt', true); ?>">
                            </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="col col-4">
                            <div class="landing-wrapper">
                                <?php if (isset($settings['_rhr_imgbx_title']) && !empty($settings['_rhr_imgbx_title'])): ?>
                                    <h1 class="title t-small">
                                    <a <?php echo rhr__link($settings['_rhr_imgbx_link']); ?> data-cursor="scale"><?php echo $this->parse_text_editor($settings['_rhr_imgbx_title']); ?></a>
                                    </h1>
                                <?php endif; ?>
                                <?php if (isset($settings['_rhr_imgbx_contents']) && !empty($settings['_rhr_imgbx_contents'])): ?>
                                    <div class="paragraph p-gray"><?php echo $this->parse_text_editor($settings['_rhr_imgbx_contents']); ?></div>
                                <?php endif; ?>
                                <?php if (isset($settings['_rhr_imgbx_btn']) && !empty($settings['_rhr_imgbx_btn'])): ?>
                                    <a <?php echo rhr__link($settings['_rhr_imgbx_link']); ?> class="button" data-cursor="scale">
                                        <span><?php echo $this->parse_text_editor($settings['_rhr_imgbx_btn']); ?></span>
                                        <div class="arrow svg"></div>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php
        $this->__close_wrap();
    }

}
