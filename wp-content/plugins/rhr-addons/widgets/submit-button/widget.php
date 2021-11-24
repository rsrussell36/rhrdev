<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Submit_Button extends CREST_BASE{

    public function get_name(){
        return 'rhr-submit-button';
    }

    public function get_title(){
        return esc_html__( 'Submit Button', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-button';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'submit button', 'button', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_submitbtn_preset',
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
            '_rhr_submitbtn_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_submitbtn_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Send Message', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Send Message', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $_submitbtn_class = isset($settings['_rhr_submitbtn_class']) && !empty($settings['_rhr_submitbtn_class']) ? $settings['_rhr_submitbtn_class'] : '';
        $this->__open_wrap();
        ?>
        <?php if (isset($settings['_rhr_design_section']) && !empty($settings['_rhr_design_section']) && $settings['_rhr_design_section'] == 'style_one'): ?>
            <?php if (isset($settings['_rhr_submitbtn_btn']) && !empty($settings['_rhr_submitbtn_btn'])): ?>
            <button type="submit" class="button" data-cursor="scale">
                <span><?php echo $this->parse_text_editor($settings['_rhr_submitbtn_btn']); ?></span>
                <div class="arrow svg"></div>
            </button>
            <?php endif; ?>
            <?php else: ?>
            <div class="button b-white" data-cursor="scale">
                <button class="arrow svg svg-inline" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 9 20" enable-background="new 0 0 9 20" xml:space="preserve">
<path d="M8.7,9.6L0.8,0.7L0,1.4l7.4,8.3l0.2,0.2L0,18.4l0.8,0.7l7.9-8.9c0.1-0.1,0.1-0.2,0.1-0.4S8.7,9.7,8.7,9.6z"></path>
</svg>
                </button>
            </div>
        <?php endif; ?>
        <?php
        $this->__close_wrap();
    }

}
