<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Page_Heading extends CREST_BASE{

    public function get_name(){
        return 'rhr-page-heading';
    }

    public function get_title(){
        return esc_html__( 'Page Heading', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-heading';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'page heading', 'heading', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_ph_preset',
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
            '_rhr_ph_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_ph_heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Blog', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter heading', 'rhr' ),
                'description' => __( 'Enter heading text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_ph_contents',
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
            '_rhr_ph_class',
            [
                'label' => __( 'Extra Class', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __( 'Enter section class', 'rhr' ),
                'description' => __( 'Enter section class name like(pages-content pc-landing-webdoor pc-landing-highlights) (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_ph_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'See More', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter button text ', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_ph_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_ph_enable_popup',
            [
                'label' => __('Download Form', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'rhr' ),
				'label_off' => __( 'Hide', 'rhr' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'description' => __( 'Enable this to show popup download form (or) Leave it empty to apply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_srb_email_h',
            [
                'label' => 'To Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'email@email.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'email@email.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );

        $this->add_control(
            '_rhr_srb_email_reply_h',
            [
                'label' => 'From Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'wordPress@rhr.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'wordPress@rhr.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_subject_h',
            [
                'label' => 'Subject',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter email subject', 'rhr' ),
                'description' => __( 'Enter email subjec (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_reply_msgprefix_h',
            [
                'label' => 'Message Greatings',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Hello', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Message Greatings', 'rhr' ),
                'description' => __( 'Enter Message Greatings (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_reply_msg_h',
            [
                'label' => 'Reply Message',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Thanks for downloading.', 'rhr' ),
                'placeholder' => __( 'Enter reply message here.', 'rhr' ),
                'description' => __( 'Enter reply here (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_form_class_h',
            [
                'label' => 'Form Class',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'demo-class', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'demo-class', 'rhr' ),
                'description' => __( 'Enter form class name (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_form_bgclass_h',
            [
                'label' => 'BG Color Class',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'purple', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'purple', 'rhr' ),
                'description' => __( 'Enter form background class name (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_form_btn_h',
            [
                'label' => 'Button Class',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'form-button', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'form-button', 'rhr' ),
                'description' => __( 'Enter form button class name (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_form__info_h',
            [
                'label' => __( 'Manage Option', 'rhr' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_success_h',
            [
                'label' => 'Success Message',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Thanks for downloading.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Success Message', 'rhr' ),
                'description' => __( 'Enter success message (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_empty_h',
            [
                'label' => 'Empty Submit Message',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Oops! file not found!', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Submit Message', 'rhr' ),
                'description' => __( 'Enter Submit message (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_error_h',
            [
                'label' => 'Error Message',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Oops! Something wrong, try again!', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Error Message', 'rhr' ),
                'description' => __( 'Enter Error message (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_name_empty_h',
            [
                'label' => 'Name Required Message',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Field must not be blank.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Name Required Message', 'rhr' ),
                'description' => __( 'Enter Name Required message (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_email_empty_h',
            [
                'label' => 'Emai l Required Message',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Field must not be blank.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Email Required Message', 'rhr' ),
                'description' => __( 'Enter Email Required message (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_email_invalid_h',
            [
                'label' => 'Invalid Email Message',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Please Enter Valid Email Address.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Invalid Email Message', 'rhr' ),
                'description' => __( 'Enter Invalid Email Message (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_company_empty_h',
            [
                'label' => 'Company Required Message',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Field must not be blank.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Company Required Message', 'rhr' ),
                'description' => __( 'Enter Company Required message (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_ph_style_section',
            [
                'label' => __('Page Heading', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_rhr_ph_title_color',
            [
                'label' => esc_html__('Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-page-heading .title' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            '_rhr_ph_text_color',
            [
                'label' => esc_html__('Text Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-page-heading .page-texts' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_ph_btn_color',
            [
                'label' => esc_html__('Button Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-page-heading .page-btns span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-rhr-page-heading .page-btns .arrow::before' => 'background: {{VALUE}};',
                ],
                'condition' =>[
                    '_rhr_ph_btn!' => '',
                    '_rhr_ph_enable_popup' => ['yes']
                ],
            ]
        );
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $_ph_class = isset($settings['_rhr_ph_class']) && !empty($settings['_rhr_ph_class']) ? $settings['_rhr_ph_class'] : '';
        $this->__open_wrap();
        ?>
            <div class="heading-content <?php echo esc_attr($_ph_class); ?>">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-5">
                            <?php if (isset($settings['_rhr_ph_heading']) && !empty($settings['_rhr_ph_heading'])): ?>
                                <h1 class="title t-medium page-titles">
                                <?php echo $this->parse_text_editor($settings['_rhr_ph_heading']); ?>
                                </h1>
                            <?php endif; ?>
                        </div>
                        <div class="col col-5">
                            <?php if (isset($settings['_rhr_ph_contents']) && !empty($settings['_rhr_ph_contents'])): ?>
                                <div class="paragraph p-gray page-texts">
                                    <?php echo $this->parse_text_editor($settings['_rhr_ph_contents']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($settings['_rhr_ph_btn']) && !empty($settings['_rhr_ph_btn'])): ?>
                                <?php if (isset($settings['_rhr_ph_enable_popup']) && !empty($settings['_rhr_ph_enable_popup']) && $settings['_rhr_ph_enable_popup'] == 'yes'): ?>
                                    <div class="download-popup gh-download">
                                        <div class="button page-btns b-download" data-cursor="scale">
                                            <span><?php echo $this->parse_text_editor($settings['_rhr_ph_btn']); ?></span>
                                            <div class="arrow svg"></div>
                                        </div>
                                        <?php
                                            $current_email = '';
                                            $current_from_email = '';
                                            $current_subject = '';
                                            if(!empty($settings['_rhr_srb_email_h'])){
                                                $current_email = $settings['_rhr_srb_email_h'];
                                            }else{
                                                $current_email = rhr_popup_email();
                                            }
                                            if(!empty($settings['_rhr_srb_email_reply_h'])){
                                                $current_from_email = $settings['_rhr_srb_email_reply_h'];
                                            }else{
                                                $current_from_email = rhr_popup_from_email();
                                            }
                                            if(!empty($settings['_rhr_srb_subject_h'])){
                                                $current_subject = $settings['_rhr_srb_subject_h'];
                                            }else{
                                                $current_subject = rhr_popup_subject();
                                            }
                                        ?>
                                        <?php echo do_shortcode('[rhr_download_form form_class="'.$settings['_rhr_srb_form_class_h'].'" button_class="'.$settings['_rhr_srb_form_btn_h'].'" data_color="'.$settings['_rhr_srb_form_bgclass_h'].'" data-to="'.$current_email.'" data-subject="'.$current_subject.'" data-reply="'.$current_from_email.'" data-msg="'.$this->parse_text_editor($settings['_rhr_srb_reply_msg_h']).'" data-msgprefix="'.$this->parse_text_editor($settings['_rhr_srb_reply_msgprefix_h']).'" data-success="'.$settings['_rhr_srb_success_h'].'" data-empty="'.$settings['_rhr_srb_empty_h'].'" data-error="'.$settings['_rhr_srb_error_h'].'" name_empty="'.$settings['_rhr_srb_name_empty_h'].'" email_empty="'.$settings['_rhr_srb_email_empty_h'].'" invalid_email="'.$settings['_rhr_srb_email_invalid_h'].'" company_empty="'.$settings['_rhr_srb_company_empty_h'].'" file="'.$settings['_rhr_ph_link']['url'].'"]'); ?>
                                    </div>
                                <?php else: ?>
                                    <a <?php echo rhr__link($settings['_rhr_ph_link']); ?> class="button page-btns b-download" data-cursor="scale">
                                        <span><?php echo $this->parse_text_editor($settings['_rhr_ph_btn']); ?></span>
                                        <div class="arrow svg"></div>
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
