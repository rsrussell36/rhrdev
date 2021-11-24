<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class About extends CREST_BASE{

    public function get_name(){
        return 'rhr-about';
    }

    public function get_title(){
        return esc_html__( 'About Us', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-plug';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'about', 'about us', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_abu_preset',
            [
                'label' => __( 'Preset', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_abu_design_section',
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
            '_rhr_abuc_content_section',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_abuc_page_title',
            [
                'label' => 'Page Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Raising your game.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->end_controls_section();
         $this->start_controls_section(
            '_rhr_abu_content_section',
            [
                'label' => __( 'Tab', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_abu_tab_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Raising your game.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_abu_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'About Us', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater->add_control(
            '_rhr_abu_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => '_about_us',
                'options' => [
                    '_about_us' => __('About Us', 'rhr' ),
                    '_career' => __('Career', 'rhr' ),
                    '_our_people' => __('Our People', 'rhr' ),
                    '_content_image' => __('Content Image', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );

        $this->add_control(
            '_rhr_abu_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_abu_tab_title' => __( 'About Us', 'rhr' ),
                        '_rhr_abu_type' => '_about_us',
                    ],
                    [
                        '_rhr_abu_tab_title' => __( 'Career', 'rhr' ),
                        '_rhr_abu_type' => '_career',
                    ],
                    [
                        '_rhr_abu_tab_title' => __( 'Spotlight On', 'rhr' ),
                        '_rhr_abu_type' => '_content_image',
                    ],
                ],
                'title_field' => '{{ _rhr_abu_tab_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_about_us_content',
            [
                'label' => __( 'About Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_abuc_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'About Us', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_abuc_contents',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'We partner with leaders to help them to acquire the knowledge, wisdom, and leadership skills necessary to successfully guide their organization to outstanding results.<br><br>
                Meaningful leadership development, powered by behavioral science.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_content = new Repeater();
        $repeater_content->add_control(
            '_rhr_abc_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => '_first',
                'options' => [
                    '_first' => __('First', 'rhr' ),
                    '_left' => __('Left', 'rhr' ),
                    '_right' => __('Right', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );
        $repeater_content->add_control(
            '_rhr_abc_img',
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

        $repeater_content->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'abc_thumbnail',
                'default' => 'large',
                'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_img_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_content->get_controls(),
                'default' => [
                    [   '_rhr_abc_type' => '_first',
                        '_rhr_abc_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [   '_rhr_abc_type' => '_first',
                        '_rhr_abc_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [   '_rhr_abc_type' => '_first',
                        '_rhr_abc_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [   '_rhr_abc_type' => '_first',
                        '_rhr_abc_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [   '_rhr_abc_type' => '_left',
                        '_rhr_abc_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [   '_rhr_abc_type' => '_left',
                        '_rhr_abc_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [   '_rhr_abc_type' => '_right',
                        '_rhr_abc_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );
        $repeater3 = new Repeater();
        $repeater3->add_control(
            '_rhr_about_us_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Our Mission', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater3->add_control(
            '_rhr_about_us_editor',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'At RHR, we believe leadership is a noble endeavor. Done well, it is a force for good in the world. Our mission is to unlock the potential in all leaders.', 'rhr' ),
                'placeholder' => __( 'Enter description here', 'rhr' ),
                'description' => __( 'Enter description here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater3->add_control(
            '_rhr_about_au_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'MEET FULL TEAM', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater3->add_control(
            '_rhr_about_au_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Choose file link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_about_au_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_about_us_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater3->get_controls(),
                'default' => [
                    [
                        '_rhr_about_us_title' => __( 'Our Mission', 'rhr' ),
                        '_rhr_about_us_editor' => __( 'At RHR, we believe leadership is a noble endeavor. Done well, it is a force for good in the world. Our mission is to unlock the potential in all leaders.', 'rhr' ),

                    ],
                    [
                        '_rhr_about_us_title' => __( 'Our History', 'rhr' ),
                        '_rhr_about_us_editor' => __( 'We are pioneers in the field of organizational psychology.<br><br>
                                As the premier boutique firm in this space, we are big enough to bring you the data, experience, and resources your project needs, but small enough that you get all the attention and focus you deserve. Our services are personalized and unique. We have outlasted scores of competitors and have remained a relevant presence in the life of our clients for over 75 years. ', 'rhr' ),
                    ],
                ],
                'title_field' => '{{ _rhr_about_us_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_ab_career_section',
            [
                'label' => __( 'Career', 'rhr' ),
            ]
        );
        $this->add_control(
        '_rhr_career_m_title',
        [
            'label' => 'Title',
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'show_label' => true,
            'default' => __( 'Your future<br>starts here.', 'rhr' ),
            'dynamic' => [
                'active'   => true,
            ],
            'placeholder' => __( 'Enter title..', 'rhr' ),
            'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
        ]
    );
    $this->add_control(
    '_rhr_career_s_title',
        [
            'label' => 'Sub Title',
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'show_label' => true,
            'default' => __( 'Career', 'rhr' ),
            'dynamic' => [
                'active'   => true,
            ],
            'placeholder' => __( 'Enter title..', 'rhr' ),
            'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
        ]
    );
    $career_repeater = new Repeater();
    $career_repeater->add_control(
        '_rhr_career_title',
        [
            'label' => 'Title',
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'show_label' => true,
            'default' => __( 'Partner', 'rhr' ),
            'dynamic' => [
                'active'   => true,
            ],
            'placeholder' => __( 'Enter title..', 'rhr' ),
            'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
        ]
    );
    $career_repeater->add_control(
        '_rhr_career_editor',
        [
            'label' => 'Description',
            'type' => Controls_Manager::WYSIWYG,
            'label_block' => true,
            'show_label' => true,
            'default' => __( 'Become a partner for one of the premier firms in leadership and human performance. Success at RHR requires a unique combination of business and psychological expertise.  If you are a constant learner and thrive in high-stake scenarios, we could be the team for you.', 'rhr' ),
            'placeholder' => __( 'Enter description here', 'rhr' ),
            'description' => __( 'Enter description here (or) Leave it empty to hide.', 'rhr' ),
        ]
    );
    $career_repeater->add_control(
        '_rhr_career_img',
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

    $career_repeater->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name' => 'career_thumbnail',
            'default' => 'large',
            'separator' => 'none',
            'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
        ]
    );
    $career_repeater->add_control(
        '_rhr_career_btn',
        [
            'label' => 'Button Text',
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'show_label' => true,
            'default' => __( '', 'rhr' ),
            'dynamic' => [
                'active'   => true,
            ],
            'placeholder' => __( 'Download information', 'rhr' ),
            'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
        ]
    );
    $career_repeater->add_control(
        '_rhr_career_link',
        [
            'label' => __( 'Link', 'rhr' ),
            'type' => Controls_Manager::URL,
            'default' => [
                'url' => '#',
            ],
            'placeholder' => __( 'https://your-link.com', 'rhr' ),
            'description' => __( 'Choose file link (or) Leave it empty to aply theme default.', 'rhr' ),
            'condition' =>[
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
        '_rhr_srb_email_h',
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
        '_rhr_srb_email_reply_h',
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
        '_rhr_srb_subject_h',
        [
            'label' => 'Subject',
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'show_label' => true,
            'default' => __( 'RHR | About', 'rhr' ),
            'dynamic' => [
                'active'   => true,
            ],
            'placeholder' => __( 'Enter Email Subject', 'rhr' ),
            'description' => __( 'Enter email subject (or) Leave it empty to hide.', 'rhr' ),
            'condition' =>[
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
        '_rhr_srb_form__info_h',
        [
            'label' => __( 'Manage Option', 'rhr' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' =>[
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $career_repeater->add_control(
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
                '_rhr_career_btn!' => '',
            ],
        ]
    );
    $this->add_control(
        '_rhr_career_lists',
        [
            'type' => Controls_Manager::REPEATER,
            'fields'      => $career_repeater->get_controls(),
            'default' => [
                [
                    '_rhr_career_title' => __( 'Partner', 'rhr' ),
                    '_rhr_career_editor' => __( 'Become a partner for one of the premier firms in leadership and human performance. Success at RHR requires a unique combination of business and psychological expertise.  If you are a constant learner and thrive in high-stake scenarios, we could be the team for you.', 'rhr' ),
                    '_rhr_career_img' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ],
                [
                    '_rhr_career_title' => __( 'Project Coordinator', 'rhr' ),
                    '_rhr_career_editor' => __( 'Project coordinators help create the outstanding client service on which RHR has built its reputation. Project coordinator jobs at RHR mean high responsibility in a highly rewarding environment. If you’re an organized business process expert, reach out to us today.', 'rhr' ),
                    '_rhr_career_btn' => __( 'Download information', 'rhr' ),
                ],
            ],
            'title_field' => '{{ _rhr_career_title }}',
        ]
    );
        $this->add_control(
            '_rhr_ab_career_category',
            array(
                'label' => __('Category', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => _get_custom_taxnomies('rhr_clients'),
                'description' => __( 'Choose category (or) Leave it empty to display all.', 'rhr' ),
            )
        );
        $this->add_control(
            '_rhr_lstories_category',
            array(
                'label' => __('Category', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => _get_custom_taxnomies('rhr_teams'),
                'description' => __( 'Choose category (or) Leave it empty to display all.', 'rhr' ),
            )
        );
        $this->add_control(
            '_rhr_ab_career_order_by_type',
            [
                'label' => __('Order By Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'separator' => 'before',
                'options' => [
                    'normal' => __('Normal', 'rhr' ),
                    'alphabetically' => __('Alphabetically', 'rhr' ),
                ],
            ]
        );
        $this->add_control(
            '_rhr_ab_career_order_by',
            [
                'label' => __('Order By', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'modified' => __('Modified', 'rhr' ),
                    'date' => __('Date', 'rhr' ),
                    'rand' => __('Rand', 'rhr' ),
                    'ID' => __('ID', 'rhr' ),
                    'title' => __('Title', 'rhr' ),
                    'author' => __('Author', 'rhr' ),
                    'name' => __('Name', 'rhr' ),
                    'parent' => __('Parent', 'rhr' ),
                    'menu_order' => __('Menu Order', 'rhr' ),
                ],
                'condition' => [
                    '_rhr_ab_career_order_by_type' => ['normal'],
                ],
            ]
        );
        $this->add_control(
            '_rhr_ab_career_order',
            [
                'label' => __('Order', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase' => __('Ascending Order', 'rhr' ),
                    'desc' => __('Descending Order', 'rhr' ),
                ],
            ]
        );
        $this->add_control(
            '_rhr_ab_career_per_page', [
                'label' => esc_html__('Per Page', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'rhr' ),
                'min'         => 1,
                'default' => 18,
                'description' => __( 'Enter the integer value to display client item (or) Leave it to apply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_ab_btn_b',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'SEE ALL', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'SEE ALL', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_ab_link_b',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_ab_btn_b!' => '',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_spotlight_section',
            [
                'label' => __( 'Spotlight', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_sp_m_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'RHR<br>International', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
        '_rhr_sp_s_title',
            [
                'label' => 'Sub Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Spotlight On', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_sp_editor',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Develop and choose your global leaders with wisdom and forethought. At RHR, we have spent over 75 years dedicated to researching and understanding the skills that leaders need to drive results. We apply that knowledge by working with global brands as well as medium and small businesses in order to help them develop the necessary leadership traits and qualities, specific to their needs.<br><br>
                                    Get in touch with us today to discover more about how we can support you. Take a look at our Resources section to find out more about our perspective on leadership skills, leadership development, improving leadership performance, and more. ', 'rhr' ),
                'placeholder' => __( 'Enter description here', 'rhr' ),
                'description' => __( 'Enter description here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_sp_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Contact us', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Contact us', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_sp_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Choose file link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_sp_btn!' => '',
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
        <?php if(isset($settings['_rhr_abu_design_section']) && $settings['_rhr_abu_design_section'] == 'style_two') : ?>
            <div class="about-intro pages-content pc-noPadidng">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-2"></div>
                        <div class="col col-8">
                            <div class="abti-first-images">
                                <?php if ( !empty( $settings['_rhr_img_lists'] ) ) : ?>
                                    <?php foreach ( $settings['_rhr_img_lists'] as $img_item_f ) :
                                            if($img_item_f['_rhr_abc_type'] == '_first'):
                                            $image = wp_get_attachment_image_url( $img_item_f['_rhr_abc_img']['id'], $img_item_f['abc_thumbnail_size'] );
                                            ?>
                                        <div class="abti-image"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo get_post_meta($img_item_f['_rhr_abc_img']['id'], '_wp_attachment_image_alt', true); ?>" /></div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="pc-inner pc-abt-initial">
                            <?php if (isset($settings['_rhr_abuc_page_title']) && !empty($settings['_rhr_abuc_page_title'])): ?>
                                <h1 class="title">
                                    <div class="t-triangle svg"></div><?php echo $this->parse_text_editor($settings['_rhr_abuc_page_title']); ?>
                                </h1>
                            <?php endif; ?>
                            </div>
                            <div class="pc-inner">
                                <div class="pc-left">
                                    <div class="caption c-light">
                                    <?php if (isset($settings['_rhr_abuc_title']) && !empty($settings['_rhr_abuc_title'])): ?>
                                        <span>
                                            <?php echo $this->parse_text_editor($settings['_rhr_abuc_title']); ?>
                                        </span>
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <div class="pc-right">
                                    <?php if (isset($settings['_rhr_abuc_contents']) && !empty($settings['_rhr_abuc_contents'])): ?>
                                            <div class="paragraph p-gray">
                                                <?php echo $this->parse_text_editor($settings['_rhr_abuc_contents']); ?>
                                            </div>
                                        <?php endif; ?>
                                </div>
                            </div>
                            <div class="pc-inner pc-abt-images">
                                <div class="about-images">
                                    <div class="abt-left">
                                        <?php if ( !empty( $settings['_rhr_img_lists'] ) ) : ?>
                                            <?php foreach ( $settings['_rhr_img_lists'] as $img_item_l ) :
                                                    if($img_item_l['_rhr_abc_type'] == '_left'):
                                                    $image = wp_get_attachment_image_url( $img_item_l['_rhr_abc_img']['id'], $img_item_l['abc_thumbnail_size'] );
                                                    ?>
                                                <div class="abt-image"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo get_post_meta($img_item_l['_rhr_abc_img']['id'], '_wp_attachment_image_alt', true); ?>" /></div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="abt-right">
                                        <?php if ( !empty( $settings['_rhr_img_lists'] ) ) : ?>
                                            <?php foreach ( $settings['_rhr_img_lists'] as $img_item_r ) :
                                                    if($img_item_r['_rhr_abc_type'] == '_right'):
                                                    $image = wp_get_attachment_image_url( $img_item_r['_rhr_abc_img']['id'], $img_item_r['abc_thumbnail_size'] );
                                                    ?>
                                                <div class="abt-image"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo get_post_meta($img_item_r['_rhr_abc_img']['id'], '_wp_attachment_image_alt', true); ?>" /></div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
            <div class="pages-content pc-noPadidng">
                <div class="container-fluid">
                    <div class="row justify-content-center align-top">
                        <div class="col col-2 sidenav-wrap service-terms">

                        <?php if ( !empty( $settings['_rhr_abu_lists'] ) ) : ?>
                            <div class="menu-navigate">
                                <div class="items">
                                <?php
                                    $i = 1;
                                    foreach ( $settings['_rhr_abu_lists'] as $index => $tab_item ) :
                                        $tab_count = $index + 1;
                                        $active_class = $i == 1 ? ' active' : '';
                                ?>
                                    <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($tab_item['_rhr_abu_tab_title']); ?></a>
                                    <?php $i++; endforeach; ?>
                                </div>
                            </div>
                            <div class="line">
                                    <div class="l-bar"></div>
                                </div>
                            <?php endif; ?>

                        </div>
                        <div class="col col-8">
                            <?php if ( !empty( $settings['_rhr_abu_lists'] ) ) : ?>
                                <?php
                                    $i = 1;
                                    foreach ( $settings['_rhr_abu_lists'] as $index => $item ) :
                                        $tab_count = $index + 1;
                                ?>
                                <?php if($item['_rhr_abu_type'] == '_about_us') : ?>
                                    <div class="pc-inner pc-abt-initial pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                        <?php if (isset($settings['_rhr_abuc_page_title']) && !empty($settings['_rhr_abuc_page_title'])): ?>
                                            <h1 class="title">
                                                <div class="t-triangle svg"></div><?php echo $this->parse_text_editor($settings['_rhr_abuc_page_title']); ?>
                                            </h1>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pc-inner">
                                        <div class="pc-left">
                                            <div class="caption c-light">
                                            <?php if (isset($settings['_rhr_abuc_title']) && !empty($settings['_rhr_abuc_title'])): ?>
                                                <span>
                                                    <?php echo $this->parse_text_editor($settings['_rhr_abuc_title']); ?>
                                                </span>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="pc-right">
                                            <?php if (isset($settings['_rhr_abuc_contents']) && !empty($settings['_rhr_abuc_contents'])): ?>
                                                <div class="paragraph p-gray">
                                                        <?php echo $this->parse_text_editor($settings['_rhr_abuc_contents']); ?>
                                                        </div>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="pc-inner pc-abt-images">
                                        <div class="about-images">
                                            <div class="abt-left">
                                                <?php if ( !empty( $settings['_rhr_img_lists'] ) ) : ?>
                                                    <?php foreach ( $settings['_rhr_img_lists'] as $img_item_l ) :
                                                            if($img_item_l['_rhr_abc_type'] == '_left'):
                                                            $image = wp_get_attachment_image_url( $img_item_l['_rhr_abc_img']['id'], $img_item_l['abc_thumbnail_size'] );
                                                            ?>
                                                        <div class="abt-image"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo get_post_meta($img_item_l['_rhr_abc_img']['id'], '_wp_attachment_image_alt', true); ?>" /></div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="abt-right">
                                                <?php if ( !empty( $settings['_rhr_img_lists'] ) ) : ?>
                                                    <?php foreach ( $settings['_rhr_img_lists'] as $img_item_r ) :
                                                            if($img_item_r['_rhr_abc_type'] == '_right'):
                                                            $image = wp_get_attachment_image_url( $img_item_r['_rhr_abc_img']['id'], $img_item_r['abc_thumbnail_size'] );
                                                            ?>
                                                        <div class="abt-image"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo get_post_meta($img_item_r['_rhr_abc_img']['id'], '_wp_attachment_image_alt', true); ?>" /></div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $ab = 1;
                                        foreach ( $settings['_rhr_about_us_lists'] as $index => $ab_item ) :
                                            $tab_count = $index + 1;
                                            $section_id = '';
                                            if(!empty($ab_item['_rhr_about_us_title'])){
                                                $get_id = str_replace(' ', '-', $ab_item['_rhr_about_us_title']);
                                                $current_id = strtolower($get_id);
                                                $section_id = 'id='.$current_id.'';
                                            }
                                    ?>
                                    <div class="pc-inner pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" <?php echo $section_id;?>>
                                        <div class="pc-left">
                                            <?php if( !empty($ab_item['_rhr_about_us_title']) ) : ?>
                                                <div class="caption c-light">
                                                    <span><?php echo $this->parse_text_editor($ab_item['_rhr_about_us_title']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="pc-right">
                                            <?php if( !empty($ab_item['_rhr_about_us_editor']) ) : ?>
                                                <div class="paragraph p-gray">
                                                    <span><?php echo $this->parse_text_editor($ab_item['_rhr_about_us_editor']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($ab_item['_rhr_about_us_btn']) && !empty($ab_item['_rhr_about_us_btn'])): ?>
                                                <a <?php echo rhr__link($ab_item['_rhr_about_us_link']); ?> class="link" data-cursor="scale">
                                                    <?php echo $this->parse_text_editor($ab_item['_rhr_about_us_btn']); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php $ab++; endforeach; ?>
                                    <?php elseif($item['_rhr_abu_type'] == '_career') :
                                        $order_by = '';
                                        if (!empty($settings['_rhr_ab_career_order_by_type']) && $settings['_rhr_ab_career_order_by_type'] == 'alphabetically') {
                                            $order_by = array( 'title' => 'ASC', 'menu_order' => 'ASC' );
                                        }else{
                                            $order_by = !empty($settings['_rhr_ab_career_order_by']) ? $settings['_rhr_ab_career_order_by'] : 'date';
                                        }
                                        $order = !empty($settings['_rhr_ab_career_order']) ? $settings['_rhr_ab_career_order'] : 'desc';
                                        $per_page = !empty($settings['_rhr_ab_career_per_page']) ? $settings['_rhr_ab_career_per_page'] : 18;
                                        $category = !empty($settings['_rhr_ab_career_category']) ? $settings['_rhr_ab_career_category'] : '';

                                        $career_args = array(
                                            'post_type' => 'rhr_teams',
                                            'order' => $order,
                                            'orderby' => $order_by,
                                            'posts_per_page' => $per_page,
                                            'ignore_sticky_posts' => 1,
                                            'post_status' => 'publish',
                                        );
                                        if( !empty( $category  ) ){
                                            $tax_query[] = array(
                                                'taxonomy' => 'rhr_teams_categories',
                                                'field'    => 'slug',
                                                'terms'    => $category
                                            );
                                        }

                                        $tax_query[] = array(
                                            'taxonomy' => 'post_format',
                                            'field' => 'slug',
                                            'terms' => array( 'post-format-quote', 'post-format-link' ),
                                            'operator' => 'NOT IN'
                                        );
                                        if( ! empty( $tax_query ) ) {
                                            $tax_query = array_merge( array( 'relation' => 'AND' ), $tax_query );
                                            $career_args = array_merge( $career_args, array( 'tax_query' => $tax_query ) );
                                        }
                                        $career_q = new \WP_Query( $career_args );
                                        ?>
                                        <?php if ( $career_q->have_posts() ) : ?>
                                    <div class="pc-inner">
                                        <div class="teams">
                                            <div class="items">
                                                <?php
                                                $team_count = 1;

                                                    while ( $career_q->have_posts() ) : $career_q->the_post();
                                                    ?>
                                                    <div class="item">
                                                    <a href="<?php the_permalink(); ?>" class="people" data-cursor="scale">
                                                        <?php
                                                        $width = 432;
                                                        $height = 560;

                                                            $image_id = get_post_thumbnail_id();

                                                            $img_attr = array(
                                                                'image_id'    => $image_id,
                                                                'image_tag'   => true,
                                                                'placeholder' => true,
                                                                'width'       => $width,
                                                                'height'      => $height,
                                                                'id'      => '',
                                                                'class'      => '',
                                                                'srcset'      => array(
                                                                    '1024' => array( $width, $height ),
                                                                    '991'  => array( 991, 460 ),
                                                                    '768'  => array( 768, 400 ),
                                                                    '480'  => array( 480, 360 ),
                                                                    '320'  => array( 320, 260 )
                                                                )
                                                            );
                                                            ?>
                                                            <div class="photo" >
                                                                <?php  echo rhr_get_profile_image( $img_attr );  ?>
                                                            </div>
                                                        <?php
                                                            $desig = rhr_get_meta_value( get_the_id(), '_rhr_desig' );
                                                            $desig2 = rhr_get_meta_value( get_the_id(), '_rhr_desig2' );
                                                            $is_desig_show_team    = rhr_options( 'is_desig_show_team', '' );

                                                        ?>
                                                        <div class="name"><?php the_title(); ?></div>
                                                        <?php
                                                            if( true == $is_desig_show_team):
                                                            if(isset($desig) && !empty($desig)):
                                                        ?>
                                                        <div class="occupation">
                                                            <?php echo esc_attr($desig); ?>
                                                            <?php if(!empty($desig2)): ?>
                                                                </br> <?php echo esc_attr($desig2); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php endif; endif;?>
                                                    </a>
                                                    </div>
                                                    <?php $team_count++; endwhile; wp_reset_postdata();?>
                                            </div>
                                            <div class="t-arrow a-left" data-cursor="left"></div>
                                            <div class="t-arrow a-right" data-cursor="right">
                                                <div class="arrow svg"></div>
                                            </div>
                                            <?php if (isset($settings['_rhr_ab_btn_b']) && !empty($settings['_rhr_ab_btn_b'])): ?>
                                                <a <?php echo rhr__link($settings['_rhr_ab_link_b']); ?> class="link l-center" data-cursor="scale">
                                                    <div class="button b-download">
                                                        <span><?php echo $this->parse_text_editor($settings['_rhr_ab_btn_b']); ?></span>
                                                        <div class="arrow svg"></div>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <div class="pc-inner pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <?php
                                    $career_section_id = '';
                                    if(!empty($settings['_rhr_career_s_title'])){
                                        $get_career_id = str_replace(' ', '-', $settings['_rhr_career_s_title']);
                                        $current_career_id = strtolower($get_career_id);
                                        $career_section_id = 'id='.$current_career_id.'';
                                    }
                                    ?>
                                    <div class="pc-left" <?php echo $career_section_id; ?>>
                                            <?php if (isset($settings['_rhr_career_s_title']) && !empty($settings['_rhr_career_s_title'])): ?>
                                                <div class="caption c-light">
                                                <span><?php echo $this->parse_text_editor($settings['_rhr_career_s_title']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($settings['_rhr_career_m_title']) && !empty($settings['_rhr_career_m_title'])): ?>
                                                <div class="title t-small t-margin"><?php echo $this->parse_text_editor($settings['_rhr_career_m_title']); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="pc-right">

                                        <?php
                                            $care = 1;
                                            foreach ( $settings['_rhr_career_lists'] as $index => $care_item ) :
                                                $tab_count = $index + 1;
                                        ?>
                                            <?php if(!empty($care_item['_rhr_career_img'])):
                                                $image = wp_get_attachment_image_url( $care_item['_rhr_career_img']['id'], $care_item['career_thumbnail_size'] );
                                                ?>
                                                <div class="image">
                                                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo get_post_meta($care_item['_rhr_career_img']['id'], '_wp_attachment_image_alt', true); ?>" />
                                                </div>
                                            <?php endif; ?>
                                            <div class="group-texts gt-marginT">
                                                <?php if (isset($care_item['_rhr_career_title']) && !empty($care_item['_rhr_career_title'])): ?>
                                                    <span><?php echo $this->parse_text_editor($care_item['_rhr_career_title']); ?></span>
                                                <?php endif; ?>
                                                <?php if (isset($care_item['_rhr_career_editor']) && !empty($care_item['_rhr_career_editor'])): ?>
                                                    <div class="paragraph p-gray">
                                                        <?php echo $this->parse_text_editor($care_item['_rhr_career_editor']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <?php if (isset($care_item['_rhr_career_btn']) && !empty($care_item['_rhr_career_btn'])): ?>
                                                <div class="download-popup gh-download">
                                                    <div class="button page-btns b-download" data-cursor="scale">
                                                        <span><?php echo $this->parse_text_editor($care_item['_rhr_career_btn']); ?></span>
                                                        <div class="arrow svg"></div>
                                                    </div>
                                                    <?php
                                                        $current_email = '';
                                                        $current_from_email = '';
                                                        $current_subject = '';
                                                        if(!empty($care_item['_rhr_srb_email_h'])){
                                                            $current_email = $care_item['_rhr_srb_email_h'];
                                                        }else{
                                                            $current_email = rhr_popup_email();
                                                        }
                                                        if(!empty($care_item['_rhr_srb_email_reply_h'])){
                                                            $current_from_email = $care_item['_rhr_srb_email_reply_h'];
                                                        }else{
                                                            $current_from_email = rhr_popup_from_email();
                                                        }
                                                        if(!empty($care_item['_rhr_srb_subject_h'])){
                                                            $current_subject = $care_item['_rhr_srb_subject_h'];
                                                        }else{
                                                            $current_subject = rhr_popup_subject();
                                                        }
                                                    ?>
                                                    <?php echo do_shortcode('[rhr_download_form form_class="'.$care_item['_rhr_srb_form_class_h'].'" button_class="'.$care_item['_rhr_srb_form_btn_h'].'" data_color="'.$care_item['_rhr_srb_form_bgclass_h'].'" data-to="'.$current_email.'" data-subject="'.$current_subject.'" data-reply="'.$current_from_email.'" data-msg="'.$this->parse_text_editor($care_item['_rhr_srb_reply_msg_h']).'" data-msgprefix="'.$this->parse_text_editor($care_item['_rhr_srb_reply_msgprefix_h']).'" data-success="'.$care_item['_rhr_srb_success_h'].'" data-empty="'.$care_item['_rhr_srb_empty_h'].'" data-error="'.$care_item['_rhr_srb_error_h'].'" name_empty="'.$care_item['_rhr_srb_name_empty_h'].'" email_empty="'.$care_item['_rhr_srb_email_empty_h'].'" invalid_email="'.$care_item['_rhr_srb_email_invalid_h'].'" company_empty="'.$care_item['_rhr_srb_company_empty_h'].'" file="'.$care_item['_rhr_career_link']['url'].'"]'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php $care++; endforeach; ?>
                                        </div>
                                    </div>
                                    <?php elseif($item['_rhr_abu_type'] == '_our_people') : ?>
                                        <div class="pc-inner pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                        <div class="pc-left"></div>
                                    </div>
                                    <?php elseif($item['_rhr_abu_type'] == '_content_image') :  ?>
                                    <div class="pc-inner pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                        <div class="pc-left">
                                            <?php if (isset($settings['_rhr_sp_s_title']) && !empty($settings['_rhr_sp_s_title'])): ?>
                                                <div class="caption c-light">
                                                <span><?php echo $this->parse_text_editor($settings['_rhr_sp_s_title']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($settings['_rhr_sp_m_title']) && !empty($settings['_rhr_sp_m_title'])): ?>
                                                <div class="title t-small t-margin"><?php echo $this->parse_text_editor($settings['_rhr_sp_m_title']); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="pc-right">
                                            <div class="group-texts gt-marginT">
                                            <?php if (isset($settings['_rhr_sp_editor']) && !empty($settings['_rhr_sp_editor'])): ?>
                                                <div class="paragraph p-gray">
                                                    <?php echo $this->parse_text_editor($settings['_rhr_sp_editor']); ?>
                                                </div>
                                            <?php endif; ?>
                                            </div>

                                            <?php if (isset($settings['_rhr_sp_btn']) && !empty($settings['_rhr_sp_btn'])): ?>
                                                <a <?php echo rhr__link($settings['_rhr_sp_link']); ?> class="button" data-cursor="scale">
                                                    <span><?php echo $this->parse_text_editor($settings['_rhr_sp_btn']); ?></span>
                                                    <div class="arrow svg"></div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <div class="pc-inner">
                                        <div class="pc-left">
                                            <div class="caption c-light">
                                                <span><?php echo esc_html__('Please select type!', 'rhr'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php $i++; endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $this->__close_wrap();
    }
}
