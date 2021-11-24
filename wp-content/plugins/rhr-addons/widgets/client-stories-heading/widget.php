<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Client_Stories_Heading extends CREST_BASE{
    
    public function get_name(){
        return 'rhr-client-stories-heading';
    }

    public function get_title(){
        return esc_html__( 'Client Stories Heading', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-heading';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Client Stories Heading', 'page heading', 'heading', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_csh_preset',
            [
                'label' => __( 'Preset', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_design_section',
            [
                'label' => esc_html__( 'Design Format', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'default' => 'Select',
                ],
                'default' => 'default',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_csh_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_csh_heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Our work in action.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter heading', 'rhr' ),
                'description' => __( 'Enter heading text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
			'_rhr_csh_contents',
			[
				'label' => __( 'Content', 'rhr' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'High-performance leadership.', 'rhr' ),
				'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
			]
		);
        $this->add_control(
			'_rhr_csh_img',
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
				'default' => 'large',
				'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
			]
		);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $csh_image = wp_get_attachment_image_url( $settings['_rhr_csh_img']['id'], $settings['thumbnail_size'] );
        $this->__open_wrap();
        ?>
            <div class="pages-content pc-noPadidng">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-10">
                            <?php if (isset($settings['_rhr_csh_heading']) && !empty($settings['_rhr_csh_heading'])): ?>
                                <h1 class="title t-medium">
                                    <?php echo $this->parse_text_editor($settings['_rhr_csh_heading']); ?>
                                </h1>
                            <?php endif; ?>
                            <?php if (isset($settings['_rhr_csh_contents']) && !empty($settings['_rhr_csh_contents'])): ?>
                            <div class="subtitle">
                                <?php echo $this->parse_text_editor($settings['_rhr_csh_contents']); ?> 
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if( isset($csh_image) && !empty($csh_image) ) : ?>
                <div class="pages-content pc-paddingTop no-padding">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col col-12">
                                <div class="image i-clients">
                                    <img src="<?php echo esc_url($csh_image); ?>" alt="<?php echo get_post_meta($settings['_rhr_csh_img']['id'], '_wp_attachment_image_alt', true); ?>">
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
