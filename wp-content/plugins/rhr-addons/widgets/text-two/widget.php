<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Text_Two extends CREST_BASE{

    public function get_name(){
        return 'rhr-text-two';
    }

    public function get_title(){
        return esc_html__( 'RHR Text Second', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-text';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'sidebar-text', 'sidebar', 'text', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_sts_preset',
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
            '_rhr_sts_content_section',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_st_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Privacy Policy', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_st_text',
            [
                'label' => __( 'Text', 'rhr' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'For more than 75 years, RHR International LLP (“RHR”) has been building relationships with our clients based on respect and integrity. We appreciate the trust and confidence you place in us when you visit our website and when you do business with us.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );

        $this->__open_wrap();
        ?>
            <div class="pages-content pc-noPadidng rhr_section__fix">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-10">
                          <div class="pc-initial-legals">
                            <?php if( !empty($settings['_rhr_st_title']) ) : ?>
                                <h1 class="title">
                                    <?php echo $this->parse_text_editor($settings['_rhr_st_title']); ?>
                                </h1>
                            <?php endif; ?>
                            <div class="pc-inner">
                                <?php if( !empty($settings['_rhr_st_text']) ) : ?>
                                    <div class="paragraph p-gray">
                                        <?php echo html_entity_decode($settings['_rhr_st_text']); ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        <?php
        $this->__close_wrap();
    }

}
