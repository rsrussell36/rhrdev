<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Content_Button extends CREST_BASE{

    public function get_name(){
        return 'rhr-content-button';
    }

    public function get_title(){
        return esc_html__( 'Content + Button', 'rhr' );
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
            '_rhr_cb_preset',
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
                    'style_one' => 'Style One',
                    'style_two' => 'Style Two',
                ],
                'default' => 'style_one',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_cb_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
			'_rhr_cb_contents',
			[
				'label' => __( 'Content', 'rhr' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'Leadership is a noble endeavor. Done well, it is a force for good in the world. We exist to unlock the potential in all leaders.', 'rhr' ),
				'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
			]
		);
        $this->add_control(
            '_rhr_cb_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Get Started', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Get Started', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_cb_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_cb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_cb_class',
            [
                'label' => __( 'Extra Class', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __( 'Enter section class', 'rhr' ),
                'description' => __( 'Enter section class name like(pc-home-phrase, pc-landing pc-gray) (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $_cb_class = isset($settings['_rhr_cb_class']) && !empty($settings['_rhr_cb_class']) ? $settings['_rhr_cb_class'] : '';
        $this->__open_wrap();
        ?>
        <?php if( isset($settings['_rhr_design_section']) && $settings['_rhr_design_section'] == 'style_one' ) : ?>
            <div class="pages-content pc-home-phrase <?php echo esc_attr($_cb_class); ?>">
                <div class="container-fluid">
                    <div class="row justify-content-center content-button">
                        <div class="col col-10">
                            <div class="content-button-wrap">
                              <?php if (isset($settings['_rhr_cb_contents']) && !empty($settings['_rhr_cb_contents'])): ?>
                                  <h2 class="title t-small t-smalls">
                                      <?php echo $this->parse_text_editor($settings['_rhr_cb_contents']); ?>
                                  </h2>
                              <?php endif; ?>
                              <?php if (isset($settings['_rhr_cb_btn']) && !empty($settings['_rhr_cb_btn'])): ?>
                                  <a <?php echo rhr__link($settings['_rhr_cb_link']); ?> class="button" data-cursor="scale">
                                      <span><?php echo $this->parse_text_editor($settings['_rhr_cb_btn']); ?></span>
                                      <div class="arrow svg"></div>
                                  </a>
                              <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <div class="pages-content pc-landing pc-gray <?php echo esc_attr($_cb_class); ?>">
                <div class="container-fluid">
                    <div class="row justify-content-center content-button">
                        <div class="col col-7">
                            <?php if (isset($settings['_rhr_cb_contents']) && !empty($settings['_rhr_cb_contents'])): ?>
                                <div class="paragraph p-bigger p-gray">
                                    <?php echo $this->parse_text_editor($settings['_rhr_cb_contents']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($settings['_rhr_cb_btn']) && !empty($settings['_rhr_cb_btn'])): ?>
                                <a <?php echo rhr__link($settings['_rhr_cb_link']); ?> class="button" data-cursor="scale">
                                    <span><?php echo $this->parse_text_editor($settings['_rhr_cb_btn']); ?></span>
                                    <div class="arrow svg"></div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php
        $this->__close_wrap();
    }

}
