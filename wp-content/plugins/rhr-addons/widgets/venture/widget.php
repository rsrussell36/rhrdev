<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Venture extends CREST_BASE{

    public function get_name(){
        return 'rhr-venture';
    }

    public function get_title(){
        return esc_html__( 'Venture', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-editor-list-ol';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Venture', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_venture_preset',
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
            '_rhr_venture_content_section',
            [
                'label' => __( 'Tab', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_venture_tab_title',
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
            '_rhr_venture_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'post_type' => '',
                'default' => 'venture_overview',
                'options' => [
                    'venture_overview' => __('Overview', 'rhr' ),
                    'venture_program' => __('Program', 'rhr' ),
                    'left_heading' => __('Challenges', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );

        $this->add_control(
            '_rhr_venture_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_venture_tab_title' => __( 'Overview', 'rhr' ),
                        '_rhr_venture_type' => 'venture_overview',
                    ],
                    [
                        '_rhr_venture_tab_title' => __( 'Program', 'rhr' ),
                        '_rhr_venture_type' => 'venture_program',
                    ],
                    [
                        '_rhr_venture_tab_title' => __( 'Challenges', 'rhr' ),
                        '_rhr_venture_type' => 'left_heading',
                    ],
                ],
                'title_field' => '{{ _rhr_venture_tab_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_overviews_content',
            [
                'label' => __( 'Overview', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_overviews_text',
            [
                'label' => __( 'Overview Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __( 'Execution risk is mitigated by strong leadership and strong teams.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2 = new Repeater();
        $repeater2->add_control(
            '_rhr_overviews_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'of Series B startups will fail to exit this year or ever.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2->add_control(
            '_rhr_overview_number',
            [
                'label' => 'Number',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '84',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter number..', 'rhr' ),
                'description' => __( 'Enter number (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2->add_control(
            '_rhr_overview_prefix',
            [
                'label' => 'Prefix',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '+',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter prefix..', 'rhr' ),
                'description' => __( 'Enter prefix (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2->add_control(
            '_rhr_overview_suffix',
            [
                'label' => 'Suffix',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '<span>%</span>',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter suffix..', 'rhr' ),
                'description' => __( 'Enter suffix (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_overviews_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater2->get_controls(),
                'default' => [
                    [
                        '_rhr_overviews_title' => __( 'of Series B startups will fail to exit this year or ever.', 'rhr' ),
                        '_rhr_overview_number' => '84',
                        '_rhr_overview_prefix' => '+',
                        '_rhr_overview_suffix' => '%',
                    ],
                    [
                        '_rhr_overviews_title' => __( 'of the CEO/Founders we have coached successfully completed an IPO', 'rhr' ),
                        '_rhr_overview_number' => '50',
                        '_rhr_overview_prefix' => '+',
                        '_rhr_overview_suffix' => '%',
                    ],
                ],
                'title_field' => '{{ _rhr_overviews_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_program_content',
            [
                'label' => __( 'Program', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_program_heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'The Journey', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter heading..', 'rhr' ),
                'description' => __( 'Enter heading text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_program_heading_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'The Founder’s Journey gives leaders: ', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_program_text',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __( 'We built this service area in collaboration with entrepreneurs and their teams, while also leveraging RHR’s 75+ years of experience working with 1000s of CEOS. <br><br>
                                All programs and insights are specifically tailored to meet the scale and speed of hypergrowth companies.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_program = new Repeater();
        $repeater_program->add_control(
            '_rhr_program_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'A clear path to grow from founder to CEO', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_program_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_program->get_controls(),
                'default' => [
                    [
                        '_rhr_program_title' => __( 'A clear path to grow from founder to CEO', 'rhr' ),
                    ],
                    [
                        '_rhr_program_title' => __( 'Agile, sprint-based coaching to hone your leadership skills', 'rhr' ),
                    ],
                    [
                        '_rhr_program_title' => __( 'Access to a team of world-class coaches', 'rhr' ),
                    ],
                ],
                'title_field' => '{{ _rhr_program_title }}',
            ]
        );

        $repeater_program_img = new Repeater();
        $repeater_program_img->add_control(
            '_rhr_pimg_img',
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

        $repeater_program_img->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_program_img_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_program_img->get_controls(),
                'default' => [
                    [
                        '_rhr_pimg_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_pimg_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_pimg_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_pimg_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_pimg_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_pimg_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_services_content',
            [
                'label' => __( 'Challange', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_challange_heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'The Seven Navigation Challenges', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter heading..', 'rhr' ),
                'description' => __( 'Enter heading text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_challange_text',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __( ' Working with current founders, we identified seven development milestones that Founder CEOS need to overcome to scale their company. While not every CEO or Founder masters these challenges in the same order or at the same stage of growth, the challenge emerges somewhere along the way.<br><br>
                When you work with RHR, you will complete a self-audit of the seven navigation challenges. Using the self-audit and stakeholder interviews, we benchmark you against other founders and identify key areas of opportunity. From there, we will craft a customized coaching plan with you to build the skills and capabilities needed to scale.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
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
                'default' => __( 'Continuous Self Evolution', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater3->add_control(
            '_rhr_services_editor',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Grow yourself to grow your company. Manage your super strengths as well as blind spots and capability gaps', 'rhr' ),
                'placeholder' => __( 'Enter description here', 'rhr' ),
                'description' => __( 'Enter description here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_services_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater3->get_controls(),
                'default' => [
                    [
                        '_rhr_services_title' => __( 'Continuous Self Evolution', 'rhr' ),
                        '_rhr_services_editor' => __( 'Grow yourself to grow your company. Manage your super strengths as well as blind spots and capability gaps', 'rhr' ),
                    ],
                    [
                        '_rhr_services_title' => __( 'Building Scalable Teams', 'rhr' ),
                        '_rhr_services_editor' => __( 'Hire the right people, set expectations and manage team dynamics to cultivate individual and team success', 'rhr' ),
                    ],
                    [
                        '_rhr_services_title' => __( 'Active Stakeholder Management', 'rhr' ),
                        '_rhr_services_editor' => __( 'Establish strong partnerships with prospective investors, board members and strategic partners.', 'rhr' ),
                    ],
                    [
                        '_rhr_services_title' => __( 'Strategic Vision', 'rhr' ),
                        '_rhr_services_editor' => __( 'Transform your vision into action. Clearly communicate priorities to inspire, align and focus the company.', 'rhr' ),
                    ],
                    [
                        '_rhr_services_title' => __( 'Obsessive Product and Customer Focus', 'rhr' ),
                        '_rhr_services_editor' => __( 'Build value by maintaining laser focus on product, customers and markets. Ensure a mindset of continuous improvement.', 'rhr' ),
                    ],
                    [
                        '_rhr_services_title' => __( 'Company Rigor', 'rhr' ),
                        '_rhr_services_editor' => __( 'Instill operational rigor to accelerate growth and mitigate execution risk. Build efficiency without sacrificing agility.', 'rhr' ),
                    ],
                    [
                        '_rhr_services_title' => __( 'Powered By People and Culture', 'rhr' ),
                        '_rhr_services_editor' => __( 'Make people and culture your hidden advantage. Create a company culture that employees, customers, and investors are proud to be part of.', 'rhr' ),
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
                'default' => __( 'Learn more about the Founder\'s Journey', 'rhr' ),
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
                'placeholder' => __( 'Dowbload PDF', 'rhr' ),
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
                'default' => __( '', 'rhr' ),
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
                'default' => __( '', 'rhr' ),
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
            '_rhr_srb_email_subject',
            [
                'label' => 'Subject',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'RHR | Venture', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'RHR | Private', 'rhr' ),
                'description' => __( 'Enter form to email (or) Leave it empty to hide.', 'rhr' ),
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
            '_rhr_rservice_content',
            [
                'label' => __( 'Related Service', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_rservice_h',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Related Services', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_r = new Repeater();
        $repeater_r->add_control(
            '_rhr_rservice_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Board, CEO, Founder', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_r->add_control(
            '_rhr_rservice_text',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __( 'Leadership starts at the top.  Successfully navigate the complex and unique challenges faced by CEOs, founders and boards.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater_r->add_control(
            '_rhr_rservices_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Learn More', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter button text', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_r->add_control(
            '_rhr_rservices_link',
            [
                'label' => __('Link', 'rhr'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#',
                ],
                'condition' =>[
                    '_rhr_rservices_btn!' => '',
                ],
                'placeholder' => __('https://your-link.com', 'rhr'),
                "description" => __("Enter link (or) Leave it to apply default.", 'rhr'),
            ]
        );
        $repeater_r->add_control(
            '_rhr_rservice_img',
            [
                'label' => __( 'Poster Image', 'rhr' ),
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

        $repeater_r->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_r->add_control(
            '_rhr_rservices_b_color',
            [
                'label' => 'Border Color Class',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => 'purple',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter border color class name', 'rhr' ),
                'description' => __( 'Enter border color class name like(purple, red, green) (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_rservices_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_r->get_controls(),
                'default' => [
                    [
                        '_rhr_rservice_title' => __( 'Board, CEO, Founder', 'rhr' ),
                        '_rhr_rservice_text' => __( 'Leadership starts at the top.  Successfully navigate the complex and unique challenges faced by CEOs, founders and boards.', 'rhr' ),
                        '_rhr_rservices_btn'    => 'Learn More',
                        '_rhr_rservices_link' => [
                            'url' => '#',
                        ],
                    ],

                ],
                'title_field' => '{{ _rhr_rservice_title }}',
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
                        <div class="col col-2 sidenav-wrap service-terms">
                        <?php if ( !empty( $settings['_rhr_venture_lists'] ) ) : ?>
                            <div class="menu-navigate">
                                <div class="items">
                                    <?php
                                        $i = 1;
                                            foreach ( $settings['_rhr_venture_lists'] as $index => $tab_item ) :
                                                $tab_count = $index + 1;
                                                $active_class = $i == 1 ? 'active' : '';
                                    ?>
                                    <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($tab_item['_rhr_venture_tab_title']); ?></a>
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
                                if ( !empty( $settings['_rhr_venture_lists'] ) ) :
                                    $i = 1;
                                    foreach ( $settings['_rhr_venture_lists'] as $index => $item ) :
                                        $tab_count = $index + 1;
                            ?>
                            <?php if( $item['_rhr_venture_type'] == 'venture_overview' ) : ?>
                                <div class="pc-initial-landing pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <?php if( !empty($settings['_rhr_overviews_text']) ) : ?>
                                        <div class="paragraph p-bigger">
                                            <?php echo $this->parse_text_editor($settings['_rhr_overviews_text']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['_rhr_overviews_lists'] ) ) : ?>
                                    <div class="chart c-intern" data-color="red">
                                        <?php
                                            $count = 1;
                                            foreach ( $settings['_rhr_overviews_lists'] as $fun_item ) :
                                                $prefix = !empty($fun_item['_rhr_overview_prefix']) ? $fun_item['_rhr_overview_prefix'] : '';
                                                $sufix = !empty($fun_item['_rhr_overview_suffix']) ? '<span>'.$fun_item['_rhr_overview_suffix'].'</span>' : '';
                                        ?>
                                        <div class="numbers" data-count="<?php echo esc_attr($fun_item['_rhr_overview_number']); ?>">
                                            <?php if (isset($fun_item['_rhr_overview_number']) && !empty($fun_item['_rhr_overview_number'])): ?>
                                                <span class="number"><?php echo $prefix . $this->parse_text_editor($fun_item['_rhr_overview_number']); ?></span><?php echo $sufix; ?>
                                            <?php endif; ?>
                                            <?php if (isset($fun_item['_rhr_overviews_title']) && !empty($fun_item['_rhr_overviews_title'])): ?>
                                                    <div class="label"><?php echo $this->parse_text_editor($fun_item['_rhr_overviews_title']); ?></div>
                                            <?php endif ?>
                                        </div>
                                        <?php endforeach;?>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <?php elseif($item['_rhr_venture_type'] == 'venture_program'): ?>
                                    <div class="pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <div class="pc-inner">
                                        <?php if( !empty($settings['_rhr_program_heading']) ) : ?>
                                            <div class="pc-left">
                                                <div class="caption c-light">
                                                    <span><?php echo $this->parse_text_editor($settings['_rhr_program_heading']); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="pc-right">
                                            <?php if( !empty($settings['_rhr_program_heading_title']) ) : ?>
                                                <div class="paragraph p-gray">
                                                    <?php echo $this->parse_text_editor($settings['_rhr_program_heading_title']); ?>
                                                </div>
                                                <?php endif; ?>
                                                <?php if ( !empty( $settings['_rhr_program_lists'] ) ) : ?>
                                                <div class="group-lists" data-color="red">
                                                    <?php
                                                        $p = 1;
                                                        foreach ( $settings['_rhr_program_lists'] as $index => $p_item ) :
                                                            $tab_count = $index + 1;
                                                    ?>
                                                    <?php if( !empty($p_item['_rhr_program_title']) ) : ?>
                                                        <div class="item item-ball">
                                                            <div class="number"><?php echo esc_attr($p); ?></div>
                                                            <span><?php echo $this->parse_text_editor($p_item['_rhr_program_title']); ?> </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php $p++; endforeach; ?>
                                                </div>
                                                <?php endif; ?>
                                                <?php if( !empty($settings['_rhr_program_text']) ) : ?>
                                                    <div class="paragraph p-gray">
                                                        <?php echo $this->parse_text_editor($settings['_rhr_program_text']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="pc-inner">
                                                <div class="pc-landing-prllx">
                                                    <?php
                                                        foreach ( $settings['_rhr_program_img_lists'] as $index => $pim_item ) :
                                                            $number = $index + 1;
                                                            $pimg_image = wp_get_attachment_image_url( $pim_item['_rhr_pimg_img']['id'], $pim_item['thumbnail_size'] );
                                                    ?>
                                                    <?php if( !empty($pim_item['_rhr_pimg_img']) ) : ?>
                                                        <img class="prllx-images prllx-img-<?php echo esc_attr($number); ?>" src="<?php echo esc_url($pimg_image); ?>" alt="<?php echo get_post_meta($pim_item['_rhr_pimg_img']['id'], '_wp_attachment_image_alt', true); ?>"/>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php elseif($item['_rhr_venture_type'] == 'left_heading'): ?>
                                    <div class="pc-inner pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                        <?php if( !empty($settings['_rhr_challange_heading']) ) : ?>
                                            <div class="pc-left">
                                                <div class="title t-small t-relative">
                                                    <?php echo $this->parse_text_editor($settings['_rhr_challange_heading']); ?>
                                                    <div class="t-triangle-line"></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="pc-right">
                                            <?php if( !empty($settings['_rhr_challange_text']) ) : ?>
                                                <div class="paragraph p-gray">
                                                    <?php echo $this->parse_text_editor($settings['_rhr_challange_text']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php
                                                if(!empty($settings['_rhr_services_lists'])):
                                                    foreach ( $settings['_rhr_services_lists'] as $index => $_item ) :
                                            ?>
                                            <div class="group-texts gt-marginT">
                                                <?php if(!empty($_item['_rhr_services_title'])): ?>
                                                    <span><?php echo $this->parse_text_editor($_item['_rhr_services_title']); ?> </span>
                                                <?php endif; ?>
                                                <?php if(!empty($_item['_rhr_services_editor'])): ?>
                                                    <div class="paragraph p-gray">
                                                        <?php echo $this->parse_text_editor($_item['_rhr_services_editor']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php endforeach; endif;?>
                                        </div>
                                    </div>
                                    <?php if (isset($settings['_rhr_srb_contents']) && !empty($settings['_rhr_srb_contents'])): ?>
                                        <div class="pc-inner">
                                            <div class="group-black gb-solutions gb-download black-download black-download-pc">
                                                <div class="rhr-download-message"></div>
                                                <?php if( !empty($settings['_rhr_srb_contents']) ) : ?>
                                                    <div class="title t-white t-tinny">
                                                        <?php echo $this->parse_text_editor($settings['_rhr_srb_contents']); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="bar" data-color="red"></div>
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
                                                    if(!empty($settings['_rhr_srb_email_subject'])){
                                                        $current_subject = $settings['_rhr_srb_email_subject'];
                                                    }else{
                                                        $current_subject = rhr_popup_subject();
                                                    }
                                                ?>
                                                <?php echo do_shortcode('[rhr_download_form form_class="'.$settings['_rhr_srb_form_class'].'" button_class="'.$settings['_rhr_srb_form_btn'].'" data_color="'.$settings['_rhr_srb_form_bgclass'].'" data-to="'.$current_email.'" data-reply="'.$current_from_email.'" data-subject="'.$current_subject.'" data-msg="'.$this->parse_text_editor($settings['_rhr_srb_reply_msg']).'" data-msgprefix="'.$this->parse_text_editor($settings['_rhr_srb_reply_msgprefix']).'" data-success="'.$settings['_rhr_srb_success'].'" data-empty="'.$settings['_rhr_srb_empty'].'" data-error="'.$settings['_rhr_srb_error'].'" name_empty="'.$settings['_rhr_srb_name_empty'].'" email_empty="'.$settings['_rhr_srb_email_empty'].'" invalid_email="'.$settings['_rhr_srb_email_invalid'].'" company_empty="'.$settings['_rhr_srb_company_empty'].'" file="'.$settings['_rhr_srb_link']['url'].'"]'); ?>
                                            </div>
                                            <div class="download-popup black-download-modal-mobile">
                                                <div class="rhr-download-message"></div>
                                                <?php if( !empty($settings['_rhr_srb_contents']) ) : ?>
                                                    <div class="title t-white t-tinny">
                                                        <?php echo $this->parse_text_editor($settings['_rhr_srb_contents']); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="bar" data-color="red"></div>
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
                                                    if(!empty($settings['_rhr_srb_email_subject'])){
                                                        $current_subject = $settings['_rhr_srb_email_subject'];
                                                    }else{
                                                        $current_subject = rhr_popup_subject();
                                                    }
                                                ?>
                                                <?php echo do_shortcode('[rhr_download_form form_class="'.$settings['_rhr_srb_form_class'].'" button_class="'.$settings['_rhr_srb_form_btn'].'" data_color="'.$settings['_rhr_srb_form_bgclass'].'" data-to="'.$current_email.'" data-reply="'.$current_from_email.'" data-subject="'.$current_subject.'" data-msg="'.$this->parse_text_editor($settings['_rhr_srb_reply_msg']).'" data-msgprefix="'.$this->parse_text_editor($settings['_rhr_srb_reply_msgprefix']).'" data-success="'.$settings['_rhr_srb_success'].'" data-empty="'.$settings['_rhr_srb_empty'].'" data-error="'.$settings['_rhr_srb_error'].'" name_empty="'.$settings['_rhr_srb_name_empty'].'" email_empty="'.$settings['_rhr_srb_email_empty'].'" invalid_email="'.$settings['_rhr_srb_email_invalid'].'" company_empty="'.$settings['_rhr_srb_company_empty'].'" file="'.$settings['_rhr_srb_link']['url'].'"]'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                            <?php endif; ?>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pages-content pc-landing pc-gray">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-10">
                            <?php
                            $count = count($settings['_rhr_rservices_lists']);
                            ?>
                            <div class="resources resources-gallery">
                                <?php if (isset($settings['_rhr_rservice_h']) && !empty($settings['_rhr_rservice_h'])): ?>
                                    <div class="r-caption"><?php echo $this->parse_text_editor($settings['_rhr_rservice_h']); ?></div>
                                <?php endif; ?>
                                    <div class="items i-services">
                                    <?php
                                    if ( !empty( $settings['_rhr_rservices_lists'] ) ) :
                                        $count = 1;
                                        foreach ( $settings['_rhr_rservices_lists'] as $r_item ) :
                                            $rservices_img = wp_get_attachment_image_url( $r_item['_rhr_rservice_img']['id'], $r_item['thumbnail_size'] );
                                    ?>
                                        <a <?php echo rhr__link($r_item['_rhr_rservices_link']); ?> class="item" data-cursor="scale" data-color="<?php echo esc_attr($r_item['_rhr_rservices_b_color']);?>">
                                            <div class="wrapper">
                                                <?php if( isset($rservices_img) && !empty($rservices_img) ) : ?>
                                                    <img src="<?php echo esc_url($rservices_img); ?>" alt="<?php echo get_post_meta($r_item['_rhr_rservice_img']['id'], '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                                <div class="infos">
                                                <?php if (!empty($r_item['_rhr_rservice_title'])): ?>
                                                    <div class="r-title"><?php echo $this->parse_text_editor($r_item['_rhr_rservice_title']); ?></div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($r_item['_rhr_rservice_text'])): ?>
                                                    <span class="paragraph p-gray"><?php echo $this->parse_text_editor($r_item['_rhr_rservice_text']); ?> </span>
                                                    <?php endif; ?>
                                                    <?php if (isset($r_item['_rhr_rservices_btn']) && !empty($r_item['_rhr_rservices_btn'])): ?>
                                                        <button <?php echo rhr__link($r_item['_rhr_rservices_link']); ?> class="button" data-cursor="scale">
                                                            <span><?php echo $this->parse_text_editor($r_item['_rhr_rservices_btn']); ?></span>
                                                            <div class="arrow svg"></div>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                        <?php endforeach; endif; ?>
                                    </div>
                                <?php if( $count > 4  ) : ?>
                                    <div class="rg-arrow a-left" data-cursor="left"></div>
                                    <div class="rg-arrow a-right" data-cursor="right"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $this->__close_wrap();
    }
}
