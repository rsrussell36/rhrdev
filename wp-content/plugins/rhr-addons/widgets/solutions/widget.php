<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Solutions extends CREST_BASE{

    public function get_name(){
        return 'rhr-solutions';
    }

    public function get_title(){
        return esc_html__( 'Solutions', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-editor-list-ol';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'solutions', 'deversity', 'assessment', 'development', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_slda_preset',
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
            '_rhr_slda_content_section',
            [
                'label' => __( 'Tab', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_slda_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Overview', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater->add_control(
            '_rhr_slda_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fun_fact',
                'options' => [
                    'fun_fact' => __('Fun Fact', 'rhr' ),
                    'left_heading' => __('Left Right Content', 'rhr' ),
                    'left_heading_none' => __('Left Right Content 2', 'rhr' ),
                    'content_image' => __('Content Image', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );

        $this->add_control(
            '_rhr_slda_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_slda_tab_title' => __( 'Overview', 'rhr' ),
                        '_rhr_slda_type' => 'fun_fact',
                    ],
                    [
                        '_rhr_slda_tab_title' => __( 'Services', 'rhr' ),
                        '_rhr_slda_type' => 'left_heading',
                    ],
                    [
                        '_rhr_slda_tab_title' => __( 'Deep Dive', 'rhr' ),
                        '_rhr_slda_type' => 'content_image',
                    ],
                ],
                'title_field' => '{{ _rhr_slda_tab_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_sfun_content',
            [
                'label' => __( 'Fun Fact', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_sfun_text',
            [
                'label' => __( 'Title', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __( 'Create a culture of belonging using our deep expertise and a humble, non-judgmental approach', 'rhr' ),
                'placeholder' => __( 'Type your title here', 'rhr' ),
                'description' => __( 'Enter title (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2 = new Repeater();
        $repeater2->add_control(
            '_rhr_sfun_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Increased intent to stay', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2->add_control(
            '_rhr_sfun_number',
            [
                'label' => 'Number',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '35', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter number..', 'rhr' ),
                'description' => __( 'Enter number (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2->add_control(
            '_rhr_sfun_prefix',
            [
                'label' => 'Prefix',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '+', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter prefix..', 'rhr' ),
                'description' => __( 'Enter prefix (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2->add_control(
            '_rhr_sfun_sufix',
            [
                'label' => 'Sufix',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '%', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter sufix..', 'rhr' ),
                'description' => __( 'Enter sufix text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_funfact_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater2->get_controls(),
                'default' => [
                    [
                        '_rhr_sfun_title' => __( 'Increased intent to stay', 'rhr' ),
                        '_rhr_sfun_number' => 35,
                        '_rhr_sfun_prefix' => '+',
                        '_rhr_sfun_sufix' => '%',
                    ],
                    [
                        '_rhr_sfun_title' => __( 'Improved sense of belonging', 'rhr' ),
                        '_rhr_sfun_number' => 104,
                        '_rhr_sfun_prefix' => '+',
                        '_rhr_sfun_sufix' => '%',
                    ],
                    [
                        '_rhr_sfun_title' => __( 'Peak performance reached', 'rhr' ),
                        '_rhr_sfun_number' => 150,
                        '_rhr_sfun_prefix' => '+',
                        '_rhr_sfun_sufix' => '%',
                    ],
                ],
                'title_field' => '{{ _rhr_sfun_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_services_content',
            [
                'label' => __( 'Left Right Content', 'rhr' ),
            ]
        );

        $repeater3 = new Repeater();
        $repeater3->add_control(
            '_rhr_services_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Inclusive Leadership', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater3->add_control(
            '_rhr_services_type',
            [
                'label' => __('Inner Left Right Content', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater3->add_control(
            '_rhr_services_editor',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Invest in group learning experiences to accelerate the readiness of your next generation diverse talent and build a support network.', 'rhr' ),
                'placeholder' => __( 'Enter description here', 'rhr' ),
                'description' => __( 'Enter description here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater3->add_control(
            '_rhr_services_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Download PDF', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Download PDF', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater3->add_control(
            '_rhr_services_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Choose file link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_email_d',
            [
                'label' => 'To Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'email@rhrinternational.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'email@rhrinternational.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_email_reply_d',
            [
                'label' => 'From Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'wordpress@rhrinternational.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'wordpress@rhrinternational.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_subject_d',
            [
                'label' => 'Subject',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter Email Subject', 'rhr' ),
                'description' => __( 'Enter email subject (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_reply_msgprefix_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_reply_msg_d',
            [
                'label' => 'Reply Message',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Thanks for downloading.', 'rhr' ),
                'placeholder' => __( 'Enter reply message here.', 'rhr' ),
                'description' => __( 'Enter reply here (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_form_class_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_form_bgclass_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_form_btn_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_form__info_d',
            [
                'label' => __( 'Manage Option', 'rhr' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>[
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_success_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_empty_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_error_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_name_empty_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_email_empty_d',
            [
                'label' => 'Email Required Message',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_email_invalid_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_srb_company_empty_d',
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
                    '_rhr_services_btn!' => '',
                ],
            ]
        );
        $repeater3->add_control(
            '_rhr_services_class',
            [
                'label' => 'Class Name',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter class name..', 'rhr' ),
                'description' => __( 'Enter class name here (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_services_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater3->get_controls(),
                'default' => [
                    [
                        '_rhr_services_title' => __( 'Inclusive Leadership', 'rhr' ),
                        '_rhr_services_type' => 'no',
                        '_rhr_services_editor' => __( 'Invest in group learning experiences to accelerate the readiness of your next generation diverse talent and build a support network.', 'rhr' ),
                        '_rhr_services_btn' => __( 'Download PDF', 'rhr' ),
                        '_rhr_services_link' => [
                             'url' => '#',
                        ],
                    ],
                    [
                        '_rhr_services_title' => __( 'Build Diverse Leadership Team', 'rhr' ),
                        '_rhr_services_type' => 'no',
                        '_rhr_services_editor' => __( 'Invest in group learning experiences to accelerate the readiness of your next generation diverse talent and build a support network.', 'rhr' ),
                        '_rhr_services_btn' => __( 'Download PDF', 'rhr' ),
                        '_rhr_services_link' => [
                             'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{ _rhr_services_title }}',
            ]
        );
        $this->add_control(
            '_rhr_srb_contents',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __( 'Learn more about our diversity, inclusion & belonging solutions', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_srb_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Download PDF', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Download PDF', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_srb_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Choose file link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_email',
            [
                'label' => 'To Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'email@rhrinternational.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'email@rhrinternational.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_email_reply',
            [
                'label' => 'From Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'wordpress@rhrinternational.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'wordpress@rhrinternational.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_subject',
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
                'description' => __( 'Enter email subject (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_reply_msgprefix',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_reply_msg',
            [
                'label' => 'Reply Message',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Thanks for downloading.', 'rhr' ),
                'placeholder' => __( 'Enter reply message here.', 'rhr' ),
                'description' => __( 'Enter reply here (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_form_class',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_form_bgclass',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_form_btn',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_form__info',
            [
                'label' => __( 'Manage Option', 'rhr' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>[
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_success',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_empty',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_error',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_name_empty',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_email_empty',
            [
                'label' => 'Email Required Message',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_email_invalid',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srb_company_empty',
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
                    '_rhr_srb_btn!' => '',
                ],
            ]
        );
        $this->end_controls_section();




        $this->start_controls_section(
            '_rhr_services_content_none',
            [
                'label' => __( 'Left Right Content 2', 'rhr' ),
            ]
        );

        $repeater_none = new Repeater();
        $repeater_none->add_control(
            '_rhr_services_title_none',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Inclusive Leadership', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_none->add_control(
            '_rhr_services_editor_none',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Invest in group learning experiences to accelerate the readiness of your next generation diverse talent and build a support network.', 'rhr' ),
                'placeholder' => __( 'Enter description here', 'rhr' ),
                'description' => __( 'Enter description here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_none->add_control(
            '_rhr_services_btn_none',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Download PDF', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Download PDF', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_none->add_control(
            '_rhr_services_link_none',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Choose file link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_email_d_none',
            [
                'label' => 'To Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'email@rhrinternational.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'email@rhrinternational.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_email_reply_d_none',
            [
                'label' => 'From Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'wordpress@rhrinternational.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'wordpress@rhrinternational.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_subject_d_none',
            [
                'label' => 'Subject',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter ', 'rhr' ),
                'description' => __( 'Enter email subject (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_reply_msgprefix_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_reply_msg_d_none',
            [
                'label' => 'Reply Message',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Thanks for downloading.', 'rhr' ),
                'placeholder' => __( 'Enter reply message here.', 'rhr' ),
                'description' => __( 'Enter reply here (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_form_class_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_form_bgclass_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_form_btn_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_form__info_d_none',
            [
                'label' => __( 'Manage Option', 'rhr' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>[
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_success_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_empty_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_error_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_name_empty_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_email_empty_d_none',
            [
                'label' => 'Email Required Message',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_email_invalid_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_srbn_company_empty_d_none',
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
                    '_rhr_services_btn_none!' => '',
                ],
            ]
        );
        $repeater_none->add_control(
            '_rhr_services_class_none',
            [
                'label' => 'Class Name',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter class name..', 'rhr' ),
                'description' => __( 'Enter class name here (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_services_lists_none',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_none->get_controls(),
                'default' => [
                    [
                        '_rhr_services_title_none' => __( 'Inclusive Leadership', 'rhr' ),
                        '_rhr_services_editor_none' => __( 'Invest in group learning experiences to accelerate the readiness of your next generation diverse talent and build a support network.', 'rhr' ),
                        '_rhr_services_btn_none' => __( 'Download PDF', 'rhr' ),
                        '_rhr_services_link_none' => [
                             'url' => '#',
                        ],
                    ],
                    [
                        '_rhr_services_title_none' => __( 'Build Diverse Leadership Team', 'rhr' ),
                        '_rhr_services_editor_none' => __( 'Invest in group learning experiences to accelerate the readiness of your next generation diverse talent and build a support network.', 'rhr' ),
                        '_rhr_services_btn_none' => __( 'Download PDF', 'rhr' ),
                        '_rhr_services_link_none' => [
                             'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{ _rhr_services_title_none }}',
            ]
        );
        $this->add_control(
            '_rhr_srbn_contents',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __( 'Learn more about our diversity, inclusion & belonging solutions', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_srbn_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Download PDF', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Download PDF', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_srbn_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Choose file link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_email',
            [
                'label' => 'To Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'email@rhrinternational.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'email@rhrinternational.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_email_reply',
            [
                'label' => 'From Email',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'wordpress@rhrinternational.com', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'wordpress@rhrinternational.com', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_subject',
            [
                'label' => 'Subject',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter ', 'rhr' ),
                'description' => __( 'Enter email subject (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_reply_msgprefix',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_reply_msg',
            [
                'label' => 'Reply Message',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Thanks for downloading.', 'rhr' ),
                'placeholder' => __( 'Enter reply message here.', 'rhr' ),
                'description' => __( 'Enter reply here (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_form_class',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_form_bgclass',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_form_btn',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_form__info',
            [
                'label' => __( 'Manage Option', 'rhr' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>[
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_success',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_empty',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_error',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_name_empty',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_email_empty',
            [
                'label' => 'Email Required Message',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_email_invalid',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_srbn_company_empty',
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
                    '_rhr_srbn_btn!' => '',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_services_inner_content',
            [
                'label' => __( 'Inner Left Right Content', 'rhr' ),
            ]
        );

        $repeater_inner = new Repeater();
        $repeater_inner->add_control(
            '_rhr_services_inner_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Succession Insights: Data Analytics', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater_inner->add_control(
            '_rhr_services_inner_editor',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Invest in group learning experiences to accelerate the readiness of your next generation diverse talent and build a support network.', 'rhr' ),
                'placeholder' => __( 'Enter description here', 'rhr' ),
                'description' => __( 'Enter description here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_services_inner_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_inner->get_controls(),
                'title_field' => '{{ _rhr_services_inner_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_cm_content',
            [
                'label' => __( 'Content Image', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_cm_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Building Inclusive Cultures', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_cm_contents',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Creating an organizational culture where all leaders have the opportunity to perform, grow, and belong requires hard work and candid insight. We begin with a deep dive on the current state with focus groups, inclusive leadership 360s, and an organizational culture assessment. These insights define the path forward, closely aligned with and defined by your D&I strategy. Our approach focuses on the responsibility of your most senior leaders to lead and role-model the inclusive culture you need.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_cm_img',
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

        $this->start_controls_section(
            '_rhr_slda_style_section',
            [
                'label' => __('Style', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_rhr_sfun_color',
            [
                'label' => __('Fun Factor Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .numbers span' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            '_rhr_sbar_color',
            [
                'label' => __('Bar Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ef4050',
                'selectors' => [
                    '{{WRAPPER}} .pages-content .bar' => 'background: {{VALUE}}!important;',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );

        $this->__open_wrap();
        ?>
            <div class="pages-content pc-paddingTop">
                <div class="container-fluid">
                    <div class="row justify-content-center align-top">
                        <div class="col col-2 sidenav-wrap">
                            <?php if ( !empty( $settings['_rhr_slda_lists'] ) ) : ?>
                                <div class="menu-navigate">
                                    <div class="items">
                                        <?php
                                            $i = 1;
                                                foreach ( $settings['_rhr_slda_lists'] as $index => $tab_item ) :
                                                    $tab_count = $index + 1;
                                                    $active_class = $i == 1 ? 'active' : '';
                                        ?>
                                        <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($tab_item['_rhr_slda_tab_title']); ?></a>
                                        <?php $i++; endforeach; ?>
                                    </div>

                                </div>
                                <div class="line">
                                    <div class="l-bar"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col col-8">
                                <?php
                                    if ( !empty( $settings['_rhr_slda_lists'] ) ) :
                                        $i = 1;
                                        foreach ( $settings['_rhr_slda_lists'] as $index => $item ) :
                                            $tab_count = $index + 1;
                                ?>
                            <?php if( $item['_rhr_slda_type'] == 'fun_fact' ) : ?>
                            <div class="pc-initial-solutions pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <?php if (isset($settings['_rhr_sfun_text']) && !empty($settings['_rhr_sfun_text'])): ?>
                                    <div class="paragraph p-bigger p-white">
                                        <?php echo $this->parse_text_editor($settings['_rhr_sfun_text']); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="chart c-intern c-white" data-color="red">
                                    <?php
                                        if ( !empty( $settings['_rhr_funfact_lists'] ) ) :
                                            $count = 1;
                                            foreach ( $settings['_rhr_funfact_lists'] as $fun_item ) :
                                                $prefix = !empty($fun_item['_rhr_sfun_prefix']) ? $fun_item['_rhr_sfun_prefix'] : '';
                                                $sufix = !empty($fun_item['_rhr_sfun_sufix']) ? '<span>'.$fun_item['_rhr_sfun_sufix'].'</span>' : '';
                                        ?>
                                            <div class="numbers" data-count="<?php echo esc_attr($fun_item['_rhr_sfun_number']); ?>">
                                                <?php if (isset($fun_item['_rhr_sfun_number']) && !empty($fun_item['_rhr_sfun_number'])): ?>
                                                    <span class="number"><?php echo $prefix . $this->parse_text_editor($fun_item['_rhr_sfun_number']); ?></span><?php echo $sufix; ?>
                                                    <?php endif ?>
                                                    <?php if (isset($fun_item['_rhr_sfun_title']) && !empty($fun_item['_rhr_sfun_title'])): ?>
                                                        <div class="label"><?php echo $this->parse_text_editor($fun_item['_rhr_sfun_title']); ?></div>
                                                <?php endif ?>
                                            </div>
                                        <?php endforeach; endif; ?>
                                </div>
                            </div>
                            <?php elseif($item['_rhr_slda_type'] == 'left_heading'): ?>
                            <div class="pc-wrapper pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <?php
                                    if ( !empty( $settings['_rhr_services_lists'] ) ) :
                                        $count = 1;
                                        foreach ( $settings['_rhr_services_lists'] as $s_item ) :
                                            $cls_name = isset($s_item['_rhr_services_class']) && !empty($s_item['_rhr_services_class']) ? $s_item['_rhr_services_class'] : '';
                                    ?>
                                <div class="pc-inner <?php echo esc_attr($cls_name); ?>">
                                    <div class="pc-left">
                                        <?php if( !empty($s_item['_rhr_services_title']) ) : ?>
                                            <div class="caption c-light">
                                                <span><?php echo $this->parse_text_editor($s_item['_rhr_services_title']); ?></span>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="pc-right">
                                        <?php
                                            if (isset($s_item['_rhr_services_editor']) && !empty($s_item['_rhr_services_editor'])):
                                                echo $this->parse_text_editor($s_item['_rhr_services_editor']);
                                            endif;
                                        ?>
                                            <?php if (isset($s_item['_rhr_services_btn']) && !empty($s_item['_rhr_services_btn'])): ?>
                                                <div class="download-popup gf-download">
                                                    <div class="button b-download b-border" data-cursor="scale">
                                                        <span><?php echo $this->parse_text_editor($s_item['_rhr_services_btn']); ?></span>
                                                        <div class="arrow svg"></div>
                                                    </div>
                                                    <?php
                                                        $current_email_d = '';
                                                        $current_from_email_d = '';
                                                        $current_subject_d = '';
                                                        if(!empty($s_item['_rhr_srb_email_d'])){
                                                            $current_email_d = $s_item['_rhr_srb_email_d'];
                                                        }else{
                                                            $current_email_d = rhr_popup_email();
                                                        }
                                                        if(!empty($s_item['_rhr_srb_email_reply_d'])){
                                                            $current_from_email_d = $s_item['_rhr_srb_email_reply_d'];
                                                        }else{
                                                            $current_from_email_d = rhr_popup_from_email();
                                                        }
                                                        if(!empty($s_item['_rhr_srb_subject_d'])){
                                                            $current_subject_d = $s_item['_rhr_srb_subject_d'];
                                                        }else{
                                                            $current_subject_d = rhr_popup_subject();
                                                        }
                                                    ?>
                                                <?php echo do_shortcode('[rhr_download_form form_class="'.$s_item['_rhr_srb_form_class_d'].'" button_class="'.$s_item['_rhr_srb_form_btn_d'].'" data_color="'.$s_item['_rhr_srb_form_bgclass_d'].'" data-to="'.$current_email_d.'" data-subject="'.$current_subject_d.'" data-reply="'.$current_from_email_d.'" data-msg="'.$this->parse_text_editor($s_item['_rhr_srb_reply_msg_d']).'" data-msgprefix="'.$this->parse_text_editor($s_item['_rhr_srb_reply_msgprefix_d']).'" data-success="'.$s_item['_rhr_srb_success_d'].'" data-empty="'.$s_item['_rhr_srb_empty_d'].'" data-error="'.$s_item['_rhr_srb_error_d'].'" name_empty="'.$s_item['_rhr_srb_name_empty_d'].'" email_empty="'.$s_item['_rhr_srb_email_empty_d'].'" invalid_email="'.$s_item['_rhr_srb_email_invalid_d'].'" company_empty="'.$s_item['_rhr_srb_company_empty_d'].'" file="'.$s_item['_rhr_services_link']['url'].'"]'); ?>
                                            </div>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <!-- Inner Left Rigt -->
                                <?php if( $s_item['_rhr_services_type'] == 'yes' ) : ?>
                                    <?php
                                    if ( !empty( $settings['_rhr_services_inner_lists'] ) ) :
                                        $count = 1;
                                        foreach ( $settings['_rhr_services_inner_lists'] as $s_inner_item ) :

                                    ?>
                                    <div class="pc-inner left-right-inner">
                                        <div class="pc-left">
                                            <?php if( !empty($s_inner_item['_rhr_services_inner_title']) ) : ?>
                                                <div class="caption c-light">
                                                    <span><?php echo $this->parse_text_editor($s_inner_item['_rhr_services_inner_title']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="pc-right">
                                            <?php
                                                if (isset($s_inner_item['_rhr_services_inner_editor']) && !empty($s_inner_item['_rhr_services_inner_editor'])):
                                                    echo $this->parse_text_editor($s_inner_item['_rhr_services_inner_editor']);
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                <?php endforeach; endif; ?>
                                <?php endif; ?>
                                 <!-- Inner Left Rigt -->
                                <?php endforeach; endif; ?>
                                <?php if (isset($settings['_rhr_srb_contents']) && !empty($settings['_rhr_srb_contents'])): ?>
                                <div class="pc-inner">
                                    <div class="group-black gb-solutions gb-download black-download black-download-pc">
                                        <div class="rhr-download-message"></div>
                                        <?php if( !empty($settings['_rhr_srb_contents']) ) : ?>
                                            <div class="title t-white t-tinny">
                                                <?php echo $this->parse_text_editor($settings['_rhr_srb_contents']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="bar" data-color="purple"></div>
                                        <?php if (isset($settings['_rhr_srb_btn']) && !empty($settings['_rhr_srb_btn'])): ?>
                                            <div class="button b-white b-download" data-cursor="scale">
                                                <span><?php echo $this->parse_text_editor($settings['_rhr_srb_btn']); ?></span>
                                                <div class="arrow svg"></div>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                            $current_email = '';
                                            $current_from_email = '';
                                            $current_subject = '';
                                            if(!empty($settings['_rhr_srb_email'])){
                                                $current_email = $settings['_rhr_srb_email'];
                                            }else{
                                                $current_email = rhr_popup_email();
                                            }
                                            if(!empty($settings['_rhr_srb_email_reply'])){
                                                $current_from_email = $settings['_rhr_srb_email_reply'];
                                            }else{
                                                $current_from_email = rhr_popup_from_email();
                                            }
                                            if(!empty($settings['_rhr_srb_subject'])){
                                                $current_subject = $settings['_rhr_srb_subject'];
                                            }else{
                                                $current_subject = rhr_popup_subject();
                                            }

                                            ?>
                                        <?php echo do_shortcode('[rhr_download_form form_class="'.$settings['_rhr_srb_form_class'].'" button_class="'.$settings['_rhr_srb_form_btn'].'" data_color="'.$settings['_rhr_srb_form_bgclass'].'" data-to="'.$current_email.'" data-subject="'.$current_subject.'" data-reply="'.$current_from_email.'" data-msg="'.$this->parse_text_editor($settings['_rhr_srb_reply_msg']).'" data-msgprefix="'.$this->parse_text_editor($settings['_rhr_srb_reply_msgprefix']).'" data-success="'.$settings['_rhr_srb_success'].'" data-empty="'.$settings['_rhr_srb_empty'].'" data-error="'.$settings['_rhr_srb_error'].'" name_empty="'.$settings['_rhr_srb_name_empty'].'" email_empty="'.$settings['_rhr_srb_email_empty'].'" invalid_email="'.$settings['_rhr_srb_email_invalid'].'" company_empty="'.$settings['_rhr_srb_company_empty'].'" file="'.$settings['_rhr_srb_link']['url'].'"]'); ?>
                                    </div>

                                    <div class="download-popup black-download-modal-mobile">
                                        <div class="rhr-bdownload-message"></div>
                                        <?php if( !empty($settings['_rhr_srb_contents']) ) : ?>
                                            <div class="title t-white t-tinny">
                                                <?php echo $this->parse_text_editor($settings['_rhr_srb_contents']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="bar" data-color="purple"></div>
                                        <?php if (isset($settings['_rhr_srb_btn']) && !empty($settings['_rhr_srb_btn'])): ?>
                                            <div class="button b-white b-download" data-cursor="scale">
                                                <span><?php echo $this->parse_text_editor($settings['_rhr_srb_btn']); ?></span>
                                                <div class="arrow svg"></div>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                            $current_email = '';
                                            $current_from_email = '';
                                            $current_subject = '';
                                            if(!empty($settings['_rhr_srb_email'])){
                                                $current_email = $settings['_rhr_srb_email'];
                                            }else{
                                                $current_email = rhr_popup_email();
                                            }
                                            if(!empty($settings['_rhr_srb_email_reply'])){
                                                $current_from_email = $settings['_rhr_srb_email_reply'];
                                            }else{
                                                $current_from_email = rhr_popup_from_email();
                                            }
                                            if(!empty($settings['_rhr_srb_subject'])){
                                                $current_subject = $settings['_rhr_srb_subject'];
                                            }else{
                                                $current_subject = rhr_popup_subject();
                                            }

                                            ?>
                                        <?php echo do_shortcode('[rhr_download_form form_class="'.$settings['_rhr_srb_form_class'].'" button_class="'.$settings['_rhr_srb_form_btn'].'" data_color="'.$settings['_rhr_srb_form_bgclass'].'" data-to="'.$current_email.'" data-subject="'.$current_subject.'" data-reply="'.$current_from_email.'" data-msg="'.$this->parse_text_editor($settings['_rhr_srb_reply_msg']).'" data-msgprefix="'.$this->parse_text_editor($settings['_rhr_srb_reply_msgprefix']).'" data-success="'.$settings['_rhr_srb_success'].'" data-empty="'.$settings['_rhr_srb_empty'].'" data-error="'.$settings['_rhr_srb_error'].'" name_empty="'.$settings['_rhr_srb_name_empty'].'" email_empty="'.$settings['_rhr_srb_email_empty'].'" invalid_email="'.$settings['_rhr_srb_email_invalid'].'" company_empty="'.$settings['_rhr_srb_company_empty'].'" file="'.$settings['_rhr_srb_link']['url'].'"]'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            </div>

                            <?php elseif($item['_rhr_slda_type'] == 'left_heading_none'): ?>
                            <div class="pc-wrapper pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <?php
                                    if ( !empty( $settings['_rhr_services_lists_none'] ) ) :
                                        $count = 1;
                                        foreach ( $settings['_rhr_services_lists_none'] as $sn_item ) :
                                            $cls_name = isset($sn_item['_rhr_services_class_none']) && !empty($sn_item['_rhr_services_class_none']) ? $sn_item['_rhr_services_class_none'] : '';
                                    ?>
                                <div class="pc-inner <?php echo esc_attr($cls_name); ?>">
                                    <div class="pc-left">
                                        <?php if( !empty($sn_item['_rhr_services_title_none']) ) : ?>
                                            <div class="caption c-light">
                                                <span><?php echo $this->parse_text_editor($sn_item['_rhr_services_title_none']); ?></span>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="pc-right">
                                        <?php
                                            if (isset($sn_item['_rhr_services_editor_none']) && !empty($sn_item['_rhr_services_editor_none'])):
                                                echo $this->parse_text_editor($sn_item['_rhr_services_editor_none']);
                                            endif;
                                        ?>
                                            <?php if (isset($sn_item['_rhr_services_btn_none']) && !empty($sn_item['_rhr_services_btn_none'])): ?>
                                                <div class="download-popup gf-download">
                                                    <div class="button b-download b-border" data-cursor="scale">
                                                        <span><?php echo $this->parse_text_editor($sn_item['_rhr_services_btn_none']); ?></span>
                                                        <div class="arrow svg"></div>
                                                    </div>
                                                    <?php
                                                        $current_email_none = '';
                                                        $current_from_email_none = '';
                                                        $current_subject_none = '';
                                                        if(!empty($sn_item['_rhr_srbn_email_d_none'])){
                                                            $current_email_none = $sn_item['_rhr_srbn_email_d_none'];
                                                        }else{
                                                            $current_email_none = rhr_popup_email();
                                                        }
                                                        if(!empty($sn_item['_rhr_srbn_email_reply_d_none'])){
                                                            $current_from_email_none = $sn_item['_rhr_srbn_email_reply_d_none'];
                                                        }else{
                                                            $current_from_email_none = rhr_popup_from_email();
                                                        }
                                                        if(!empty($sn_item['_rhr_srbn_subject_d_none'])){
                                                            $current_subject_none = $sn_item['_rhr_srbn_subject_d_none'];
                                                        }else{
                                                            $current_subject_none = rhr_popup_subject();
                                                        }
                                                    ?>
                                                <?php echo do_shortcode('[rhr_download_form form_class="'.$sn_item['_rhr_srbn_form_class_d_none'].'" button_class="'.$sn_item['_rhr_srbn_form_btn_d_none'].'" data_color="'.$sn_item['_rhr_srbn_form_bgclass_d_none'].'" data-to="'.$current_email_none.'" data-subject="'.$current_subject_none.'" data-reply="'.$current_from_email_none.'" data-msg="'.$this->parse_text_editor($sn_item['_rhr_srbn_reply_msg_d_none']).'" data-msgprefix="'.$this->parse_text_editor($sn_item['_rhr_srbn_reply_msgprefix_d_none']).'" data-success="'.$sn_item['_rhr_srbn_success_d_none'].'" data-empty="'.$sn_item['_rhr_srbn_empty_d_none'].'" data-error="'.$sn_item['_rhr_srbn_error_d_none'].'" name_empty="'.$sn_item['_rhr_srbn_name_empty_d_none'].'" email_empty="'.$sn_item['_rhr_srbn_email_empty_d_none'].'" invalid_email="'.$sn_item['_rhr_srbn_email_invalid_d_none'].'" company_empty="'.$sn_item['_rhr_srbn_company_empty_d_none'].'" file="'.$sn_item['_rhr_services_link_none']['url'].'"]'); ?>
                                            </div>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                                <?php if (isset($settings['_rhr_srbn_contents']) && !empty($settings['_rhr_srbn_contents'])): ?>
                                <div class="pc-inner">
                                    <div class="group-black gb-solutions gb-download black-download">
                                        <div class="rhr-download-message"></div>
                                        <?php if( !empty($settings['_rhr_srbn_contents']) ) : ?>
                                            <div class="title t-white t-tinny">
                                                <?php echo $this->parse_text_editor($settings['_rhr_srbn_contents']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="bar" data-color="purple"></div>
                                        <?php if (isset($settings['_rhr_srbn_btn']) && !empty($settings['_rhr_srbn_btn'])): ?>
                                            <div class="button b-white b-download" data-cursor="scale">
                                                <span><?php echo $this->parse_text_editor($settings['_rhr_srbn_btn']); ?></span>
                                                <div class="arrow svg"></div>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                            $current_email_srbn = '';
                                            $current_from_email_srbn = '';
                                            $current_subject_srbn = '';
                                            if(!empty($settings['_rhr_srbn_email'])){
                                                $current_email_srbn = $settings['_rhr_srbn_email'];
                                            }else{
                                                $current_email_srbn = rhr_popup_email();
                                            }
                                            if(!empty($settings['_rhr_srbn_email_reply'])){
                                                $current_from_email_srbn = $settings['_rhr_srbn_email_reply'];
                                            }else{
                                                $current_from_email_srbn = rhr_popup_from_email();
                                            }
                                            if(!empty($settings['_rhr_srbn_subject'])){
                                                $current_subject_srbn = $settings['_rhr_srbn_subject'];
                                            }else{
                                                $current_subject_srbn = rhr_popup_subject();
                                            }
                                        ?>
                                        <?php echo do_shortcode('[rhr_download_form form_class="'.$settings['_rhr_srbn_form_class'].'" button_class="'.$settings['_rhr_srbn_form_btn'].'" data_color="'.$settings['_rhr_srbn_form_bgclass'].'" data-to="'.$current_email_srbn.'" data-subject="'.$current_subject_srbn.'" data-reply="'.$current_from_email_srbn.'" data-msg="'.$this->parse_text_editor($settings['_rhr_srbn_reply_msg']).'" data-msgprefix="'.$this->parse_text_editor($settings['_rhr_srbn_reply_msgprefix']).'" data-success="'.$settings['_rhr_srbn_success'].'" data-empty="'.$settings['_rhr_srbn_empty'].'" data-error="'.$settings['_rhr_srbn_error'].'" name_empty="'.$settings['_rhr_srbn_name_empty'].'" email_empty="'.$settings['_rhr_srbn_email_empty'].'" invalid_email="'.$settings['_rhr_srbn_email_invalid'].'" company_empty="'.$settings['_rhr_srbn_company_empty'].'" file="'.$settings['_rhr_srbn_link']['url'].'"]'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            </div>

                            <?php elseif($item['_rhr_slda_type'] == 'content_image'): ?>
                            <div class="pc-inner pc-ended pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <div class="pc-left">
                                    <?php if( !empty($item['_rhr_slda_tab_title']) ) : ?>
                                        <div class="caption c-light">
                                            <span><?php echo $this->parse_text_editor($item['_rhr_slda_tab_title']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( !empty($settings['_rhr_cm_title']) ) : ?>
                                        <div class="title t-small t-margin"><?php echo $this->parse_text_editor($settings['_rhr_cm_title']); ?></div>
                                    <?php endif; ?>
                                    <?php if( !empty($settings['_rhr_cm_contents']) ) : ?>
                                        <div class="paragraph p-gray">
                                        <?php echo $this->parse_text_editor($settings['_rhr_cm_contents']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="pc-right">
                                    <?php
                                    if(!empty($settings['_rhr_cm_img'])):
                                     $cm_image = wp_get_attachment_image_url( $settings['_rhr_cm_img']['id'], $settings['thumbnail_size'] );
                                    ?>
                                    <div class="image">
                                    <img src="<?php echo esc_url($cm_image); ?>" alt="<?php echo get_post_meta($settings['_rhr_cm_img']['id'], '_wp_attachment_image_alt', true); ?>">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                             <?php endif; ?>
                            <?php $i++; endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $this->__close_wrap();
    }
}
