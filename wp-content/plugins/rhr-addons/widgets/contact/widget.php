<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Contact extends CREST_BASE{

    public function get_name(){
        return 'rhr-contact';
    }

    public function get_title(){
        return esc_html__( 'Get In Touch', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-form-horizontal';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'contact', 'get in touch', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_contact_preset',
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
            '_rhr_contact_content_section',
            [
                'label' => __( 'Tab', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_contact_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Get In Touch', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater->add_control(
            '_rhr_contact_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'post_type' => '',
                'default' => 'contact_form',
                'options' => [
                    'contact_form' => __('Form', 'rhr' ),
                    'left_heading' => __('Left Right Content', 'rhr' ),
                    'location' => __('Location', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );
        $repeater->add_control(
            '_rhr_content_f_title',
            [
                'label' => __( 'Title', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Get In Touch', 'rhr' ),
                'placeholder' => __( 'Type your title here', 'rhr' ),
                'description' => __( 'Enter title (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_content_f_text',
            [
                'label' => __( 'Form Text', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'We meet you where you are. RHR International has a global presence.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_contact_type' => 'contact_form',
                ]
            ]
        );
        $repeater->add_control(
            '_rhr_form_shortcode',
            [
                'label' => __( 'Form Shortcode', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
                'default' => '[rhr_contact_form]',
                'condition' => [
                    '_rhr_contact_type' => 'contact_form',
                ]
            ]
        );
        $this->add_control(
            '_rhr_contact_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_contact_tab_title' => __( 'Get In Touch', 'rhr' ),
                        '_rhr_content_f_title' => __( 'Get In Touch', 'rhr' ),
                        '_rhr_content_f_text' => __('We meet you where you are. RHR International has a global presence.','rhr'),
                        '_rhr_form_shortcode' => '',
                        '_rhr_contact_type' => 'contact_form',
                    ],
                    [
                        '_rhr_contact_tab_title' => __( 'Global Headquarters', 'rhr' ),
                        '_rhr_content_f_title' => __( 'Global Headquarters', 'rhr' ),
                        '_rhr_contact_type' => 'left_heading',
                    ],
                    [
                        '_rhr_contact_tab_title' => __( 'Locations', 'rhr' ),
                        '_rhr_contact_type' => 'location',
                    ],
                ],
                'title_field' => '{{ _rhr_contact_tab_title }}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_gh_content',
            [
                'label' => __( 'Left Right Content', 'rhr' ),
            ]
        );

        $repeater2 = new Repeater();
        $repeater2->add_control(
            '_rhr_gh_left_title',
            [
                'label' => 'Left Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Global Headquarters', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2->add_control(
            '_rhr_gh_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'RHR International LLP', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater2->add_control(
            '_rhr_gh_editor',
            [
                'label' => 'Description',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.', 'rhr' ),
                'placeholder' => __( 'Enter description here', 'rhr' ),
                'description' => __( 'Enter description here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_gh_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater2->get_controls(),
                'default' => [
                    [
                        '_rhr_gh_left_title' => __( 'Global Headquarters', 'rhr' ),
                        '_rhr_gh_title' => __( 'RHR International LLP', 'rhr' ),
                        '_rhr_gh_editor' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.', 'rhr' ),
                    ],
                    [
                        '_rhr_gh_left_title' => __( 'Regional Headquarters', 'rhr' ),
                        '_rhr_gh_title' => __( 'Build Diverse Leadership Team', 'rhr' ),
                        '_rhr_gh_editor' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.', 'rhr' ),
                    ],
                ],
                'title_field' => '{{ _rhr_gh_title }}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_loc_content',
            [
                'label' => __( 'Location', 'rhr' ),
            ]
        );

        $repeater_loc = new Repeater();
        $repeater_loc->add_control(
            '_rhr_loc_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'North America', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter location title..', 'rhr' ),
                'description' => __( 'Enter location title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_loc->add_control(
            '_rhr_loc_state',
            [
                'label' => esc_html__( 'State', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    '_rhr_na' => 'North America',
                    '_rhr_me' => 'Europe - Middle East - Africa',
                    '_rhr_eu' => 'Asia Pacific',
                    '_rhr_af' => 'South America',
                ],
                'default' => '_rhr_na',
            ]
        );
        $this->add_control(
            '_rhr_loc_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_loc->get_controls(),
                'default' => [
                    [
                        '_rhr_loc_title' => __( 'North America', 'rhr' ),
                        '_rhr_loc_state' => '_rhr_na',
                    ],
                    [
                        '_rhr_loc_title' => __( 'Europe - Middle East - Africa', 'rhr' ),
                        '_rhr_loc_state' => '_rhr_me',
                    ],
                    [
                        '_rhr_loc_title' => __( 'Asia Pacific', 'rhr' ),
                        '_rhr_loc_state' => '_rhr_eu',
                    ],
                    [
                        '_rhr_loc_title' => __( 'South America', 'rhr' ),
                        '_rhr_loc_state' => '_rhr_af',
                    ],
                ],
                'title_field' => '{{ _rhr_loc_title }}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_na_content',
            [
                'label' => __( 'North America', 'rhr' ),
            ]
        );

        $repeater_na = new Repeater();
        $repeater_na->add_control(
            '_rhr_na_name',
            [
                'label' => 'Country Name',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Atlanta', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_na->add_control(
            '_rhr_na_lat',
            [
                'label' => 'Latitude',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '33.78239432284687',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter latitude..', 'rhr' ),
                'description' => __( 'Enter latitude here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_na->add_control(
            '_rhr_na_lon',
            [
                'label' => 'Longitude',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '-84.38808091534499',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter longitude..', 'rhr' ),
                'description' => __( 'Enter longitude here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_na->add_control(
            '_rhr_na_addr',
            [
                'label' => __( 'Address', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => '10 10th St NW #390, Atlanta, GA 30309',
                'placeholder' => __( 'Type your address here', 'rhr' ),
                'description' => __( 'Enter address (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_na_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_na->get_controls(),
                'default' => [
                    [
                        '_rhr_na_name' => __( 'Atlanta', 'rhr' ),
                        '_rhr_na_lat' => '33.78239432284687',
                        '_rhr_na_lon' => '-84.38808091534499',
                        '_rhr_na_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                    [
                        '_rhr_na_name' => __( 'Boston', 'rhr' ),
                        '_rhr_na_lat' => '33.78239432284687',
                        '_rhr_na_lon' => '-84.38808091534499',
                        '_rhr_na_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                    [
                        '_rhr_na_name' => __( 'Chicago', 'rhr' ),
                        '_rhr_na_lat' => '33.78239432284687',
                        '_rhr_na_lon' => '-84.38808091534499',
                        '_rhr_na_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                ],
                'title_field' => '{{ _rhr_na_name }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_me_content',
            [
                'label' => __( 'Europe - Middle East - Africa', 'rhr' ),
            ]
        );

        $repeater_me = new Repeater();
        $repeater_me->add_control(
            '_rhr_me_name',
            [
                'label' => 'Country Name',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Atlanta', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_me->add_control(
            '_rhr_me_lat',
            [
                'label' => 'Latitude',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '33.78239432284687',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter latitude..', 'rhr' ),
                'description' => __( 'Enter latitude here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_me->add_control(
            '_rhr_me_lon',
            [
                'label' => 'Longitude',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '-84.38808091534499',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter longitude..', 'rhr' ),
                'description' => __( 'Enter longitude here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_me->add_control(
            '_rhr_me_addr',
            [
                'label' => __( 'Address', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => '10 10th St NW #390, Atlanta, GA 30309',
                'placeholder' => __( 'Type your address here', 'rhr' ),
                'description' => __( 'Enter address (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_me_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_me->get_controls(),
                'default' => [
                    [
                        '_rhr_me_name' => __( 'Atlanta', 'rhr' ),
                        '_rhr_me_lat' => '33.78239432284687',
                        '_rhr_me_lon' => '-84.38808091534499',
                        '_rhr_me_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                    [
                        '_rhr_me_name' => __( 'Boston', 'rhr' ),
                        '_rhr_me_lat' => '33.78239432284687',
                        '_rhr_me_lon' => '-84.38808091534499',
                        '_rhr_me_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                    [
                        '_rhr_me_name' => __( 'Chicago', 'rhr' ),
                        '_rhr_me_lat' => '33.78239432284687',
                        '_rhr_me_lon' => '-84.38808091534499',
                        '_rhr_me_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                ],
                'title_field' => '{{ _rhr_me_name }}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_eu_content',
            [
                'label' => __( 'Asia Pacific', 'rhr' ),
            ]
        );

        $repeater_eu = new Repeater();
        $repeater_eu->add_control(
            '_rhr_eu_name',
            [
                'label' => 'Country Name',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Atlanta', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_eu->add_control(
            '_rhr_eu_lat',
            [
                'label' => 'Latitude',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '33.78239432284687',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter latitude..', 'rhr' ),
                'description' => __( 'Enter latitude here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_eu->add_control(
            '_rhr_eu_lon',
            [
                'label' => 'Longitude',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '-84.38808091534499',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter longitude..', 'rhr' ),
                'description' => __( 'Enter longitude here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_eu->add_control(
            '_rhr_eu_addr',
            [
                'label' => __( 'Address', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => '10 10th St NW #390, Atlanta, GA 30309',
                'placeholder' => __( 'Type your address here', 'rhr' ),
                'description' => __( 'Enter address (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_eu_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_eu->get_controls(),
                'default' => [
                    [
                        '_rhr_eu_name' => __( 'Atlanta', 'rhr' ),
                        '_rhr_eu_lat' => '33.78239432284687',
                        '_rhr_eu_lon' => '-84.38808091534499',
                        '_rhr_eu_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                    [
                        '_rhr_eu_name' => __( 'Boston', 'rhr' ),
                        '_rhr_eu_lat' => '33.78239432284687',
                        '_rhr_eu_lon' => '-84.38808091534499',
                        '_rhr_eu_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                    [
                        '_rhr_eu_name' => __( 'Chicago', 'rhr' ),
                        '_rhr_eu_lat' => '33.78239432284687',
                        '_rhr_eu_lon' => '-84.38808091534499',
                        '_rhr_eu_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                ],
                'title_field' => '{{ _rhr_eu_name }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_af_content',
            [
                'label' => __( 'South America', 'rhr' ),
            ]
        );

        $repeater_af = new Repeater();
        $repeater_af->add_control(
            '_rhr_af_name',
            [
                'label' => 'Country Name',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Atlanta', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_af->add_control(
            '_rhr_af_lat',
            [
                'label' => 'Latitude',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '33.78239432284687',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter latitude..', 'rhr' ),
                'description' => __( 'Enter latitude here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_af->add_control(
            '_rhr_af_lon',
            [
                'label' => 'Longitude',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => '-84.38808091534499',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter longitude..', 'rhr' ),
                'description' => __( 'Enter longitude here (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater_af->add_control(
            '_rhr_af_addr',
            [
                'label' => __( 'Address', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => '10 10th St NW #390, Atlanta, GA 30309',
                'placeholder' => __( 'Type your address here', 'rhr' ),
                'description' => __( 'Enter address (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_af_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_af->get_controls(),
                'default' => [
                    [
                        '_rhr_af_name' => __( 'Atlanta', 'rhr' ),
                        '_rhr_af_lat' => '33.78239432284687',
                        '_rhr_af_lon' => '-84.38808091534499',
                        '_rhr_af_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                    [
                        '_rhr_af_name' => __( 'Boston', 'rhr' ),
                        '_rhr_af_lat' => '33.78239432284687',
                        '_rhr_af_lon' => '-84.38808091534499',
                        '_rhr_af_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                    [
                        '_rhr_af_name' => __( 'Chicago', 'rhr' ),
                        '_rhr_af_lat' => '33.78239432284687',
                        '_rhr_af_lon' => '-84.38808091534499',
                        '_rhr_af_addr' => '10 10th St NW #390, Atlanta, GA 30309',
                    ],
                ],
                'title_field' => '{{ _rhr_af_name }}',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );

        $this->__open_wrap();
        ?>
            <div class="pages-content pc-noPadidng">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-2 sidenav-wrap service-terms">
                            <?php if ( !empty( $settings['_rhr_contact_lists'] ) ) : ?>
                                <div class="menu-navigate">
                                    <div class="items">
                                        <?php
                                            $i = 1;
                                                foreach ( $settings['_rhr_contact_lists'] as $index => $tab_item ) :
                                                    $tab_count = $index + 1;
                                                    $active_class = $i == 1 ? ' active' : '';
                                        ?>
                                        <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($tab_item['_rhr_contact_tab_title']); ?></a>
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
                            if ( !empty( $settings['_rhr_contact_lists'] ) ) :
                                $i = 1;
                                foreach ( $settings['_rhr_contact_lists'] as $index => $item ) :
                                    $tab_count = $index + 1;
                        ?>
                            <?php if( $item['_rhr_contact_type'] == 'contact_form' ) : ?>
                                <div class="pc-initial-contact pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <?php if( !empty($item['_rhr_content_f_title']) ) : ?>
                                        <h1 class="title"> <?php echo $this->parse_text_editor($item['_rhr_content_f_title']); ?> </h1>
                                    <?php endif; ?>
                                </div>
                                <div class="pc-inner">
                                    <div class="pc-left">
                                    <?php if( !empty($item['_rhr_content_f_text']) ) : ?>
                                        <div class="paragraph p-bigger p-gray">
                                            <?php echo $this->parse_text_editor($item['_rhr_content_f_text']); ?>
                                        </div>
                                    <?php endif; ?>

                                    </div>
                                    <div class="pc-right">
                                        <div class="form">
                                        <?php echo do_shortcode($item['_rhr_form_shortcode']); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($item['_rhr_contact_type'] == 'left_heading'): ?>
                                <div class="pc-inner pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <?php
                                    if ( !empty( $settings['_rhr_gh_lists'] ) ) :
                                        $count = 1;
                                        foreach ( $settings['_rhr_gh_lists'] as $g_item ) :
                                            $class = $count == 1 ? ' office-black ' : ' office-gray'
                                    ?>
                                    <div class="pc-left <?php echo esc_attr($class); ?>">
                                        <?php if( !empty($g_item['_rhr_gh_left_title']) ) : ?>
                                            <div class="caption c-light">
                                            <span> <?php echo $this->parse_text_editor($g_item['_rhr_gh_left_title']); ?> </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pc-right <?php echo esc_attr($class); ?>">
                                        <div class="offices">
                                            <div class="item">
                                            <?php if( !empty($g_item['_rhr_gh_title']) ) : ?>
                                                <div class="office">
                                                    <?php echo $this->parse_text_editor($g_item['_rhr_gh_title']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php
                                                if (isset($g_item['_rhr_gh_editor']) && !empty($g_item['_rhr_gh_editor'])): ?>
                                                    <div class="contacts">
                                                        <?php echo $this->parse_text_editor($g_item['_rhr_gh_editor']); ?>
                                                    </div>
                                               <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <?php $count++; endforeach; endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="pc-inner no-margin pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <div class="pc-left">
                                        <?php if( !empty($item['_rhr_content_f_title']) ) : ?>
                                            <div class="caption c-light">
                                            <span> <?php echo $this->parse_text_editor($item['_rhr_content_f_title']); ?> </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="pc-inner">
                                    <div class="map">
                                        <div class="continents">
                                        <?php
                                            if ( !empty( $settings['_rhr_loc_lists'] ) ) :
                                                $loc = 1;
                                                $count = 1;
                                                foreach ( $settings['_rhr_loc_lists'] as $loc_item ) :
                                                    $loc_ac_class = $loc == 1 ? ' active' : '';
                                            ?>
                                            <?php if( !empty($loc_item['_rhr_loc_title']) ) : ?>
                                            <div class="item">
                                                <div class="label <?php echo esc_attr($loc_ac_class); ?>" data-cursor="scale"><?php echo $this->parse_text_editor($loc_item['_rhr_loc_title']); ?></div>
                                                <div class="place <?php echo esc_attr($loc_ac_class); ?>">
                                                    <?php if($loc_item['_rhr_loc_state'] == '_rhr_na'): ?>
                                                        <?php
                                                        if ( !empty( $settings['_rhr_na_lists'] ) ) :
                                                            foreach ( $settings['_rhr_na_lists'] as $index => $na_item ) :
                                                                $_rhr_na = $this->get_repeater_setting_key( '_rhr_na_lat', '_rhr_na_lists', $index );
                                                                $this->add_render_attribute(
                                                                    $_rhr_na,
                                                                    [
                                                                        'data-cursor'   => 'scale',
                                                                    ]
                                                                );
                                                                if(!empty($na_item['_rhr_na_lat']) && !empty($na_item['_rhr_na_lon'])){
                                                                    $this->add_render_attribute(
                                                                        $_rhr_na,
                                                                        [
                                                                            'class'         => 'p-item',
                                                                            'data-lat'   => $this->parse_text_editor($na_item['_rhr_na_lat']),
                                                                            'data-long'   => $this->parse_text_editor($na_item['_rhr_na_lon']),
                                                                            'data-address'   => $this->parse_text_editor($na_item['_rhr_na_addr']),
                                                                        ]
                                                                    );
                                                                }else{
                                                                    $this->add_render_attribute(
                                                                        $_rhr_na,
                                                                        [
                                                                            'class'         => 'no-map'
                                                                        ]
                                                                    );
                                                                }
                                                                $_get_rhr_na = $this->get_render_attribute_string( $_rhr_na );
                                                        ?>
                                                        <?php if( !empty($na_item['_rhr_na_name']) ) : ?>
                                                            <div <?php echo $_get_rhr_na; ?> ><span><?php echo $this->parse_text_editor($na_item['_rhr_na_name']); ?></span></div>
                                                        <?php endif; ?>
                                                        <?php endforeach; endif; ?>
                                                    <?php elseif($loc_item['_rhr_loc_state'] == '_rhr_me'): ?>
                                                        <?php
                                                        if ( !empty( $settings['_rhr_me_lists'] ) ) :
                                                            foreach ( $settings['_rhr_me_lists'] as $index => $na_item ) :
                                                                $_rhr_me = $this->get_repeater_setting_key( '_rhr_me_lat', '_rhr_me_lists', $index );
                                                                $this->add_render_attribute(
                                                                    $_rhr_me,
                                                                    [
                                                                        'data-cursor'   => 'scale',
                                                                    ]
                                                                );
                                                                if(!empty($na_item['_rhr_me_lat']) && !empty($na_item['_rhr_me_lon'])){
                                                                    $this->add_render_attribute(
                                                                        $_rhr_me,
                                                                        [
                                                                            'class'         => 'p-item',
                                                                            'data-lat'   => $this->parse_text_editor($na_item['_rhr_me_lat']),
                                                                            'data-long'   => $this->parse_text_editor($na_item['_rhr_me_lon']),
                                                                            'data-address'   => $this->parse_text_editor($na_item['_rhr_me_addr']),
                                                                        ]
                                                                    );
                                                                }else{
                                                                    $this->add_render_attribute(
                                                                        $_rhr_me,
                                                                        [
                                                                            'class'         => 'no-map'
                                                                        ]
                                                                    );
                                                                }
                                                                $_get_rhr_me = $this->get_render_attribute_string( $_rhr_me );
                                                        ?>
                                                        <?php if( !empty($na_item['_rhr_me_name']) ) : ?>
                                                            <div <?php echo $_get_rhr_me; ?>><span><?php echo $this->parse_text_editor($na_item['_rhr_me_name']); ?></span></div>
                                                        <?php endif; ?>
                                                        <?php endforeach; endif; ?>
                                                    <?php elseif($loc_item['_rhr_loc_state'] == '_rhr_eu'): ?>
                                                        <?php
                                                        if ( !empty( $settings['_rhr_eu_lists'] ) ) :
                                                            foreach ( $settings['_rhr_eu_lists'] as $index => $na_item ) :
                                                                $_rhr_eu = $this->get_repeater_setting_key( '_rhr_eu_lat', '_rhr_eu_lists', $index );
                                                                $this->add_render_attribute(
                                                                    $_rhr_eu,
                                                                    [
                                                                        'data-cursor'   => 'scale',
                                                                    ]
                                                                );
                                                                if(!empty($na_item['_rhr_eu_lat']) && !empty($na_item['_rhr_eu_lon'])){
                                                                    $this->add_render_attribute(
                                                                        $_rhr_eu,
                                                                        [
                                                                            'class'         => 'p-item',
                                                                            'data-lat'   => $this->parse_text_editor($na_item['_rhr_eu_lat']),
                                                                            'data-long'   => $this->parse_text_editor($na_item['_rhr_eu_lon']),
                                                                            'data-address'   => $this->parse_text_editor($na_item['_rhr_eu_addr']),
                                                                        ]
                                                                    );
                                                                }else{
                                                                    $this->add_render_attribute(
                                                                        $_rhr_eu,
                                                                        [
                                                                            'class'         => 'no-map'
                                                                        ]
                                                                    );
                                                                }
                                                                $_get_rhr_eu = $this->get_render_attribute_string( $_rhr_eu );
                                                        ?>
                                                        <?php if( !empty($na_item['_rhr_eu_name']) ) : ?>
                                                            <div <?php echo $_get_rhr_eu; ?> ><span><?php echo $this->parse_text_editor($na_item['_rhr_eu_name']); ?></span></div>
                                                        <?php endif; ?>
                                                        <?php endforeach; endif; ?>
                                                        <?php elseif($loc_item['_rhr_loc_state'] == '_rhr_af'): ?>
                                                            <?php
                                                        if ( !empty( $settings['_rhr_af_lists'] ) ) :
                                                            foreach ( $settings['_rhr_af_lists'] as $index => $na_item ) :
                                                                $_rhr_af = $this->get_repeater_setting_key( '_rhr_af_lat', '_rhr_af_lists', $index );
                                                                $this->add_render_attribute(
                                                                    $_rhr_af,
                                                                    [
                                                                        'data-cursor'   => 'scale',
                                                                    ]
                                                                );
                                                                if(!empty($na_item['_rhr_af_lat']) && !empty($na_item['_rhr_af_lon'])){
                                                                    $this->add_render_attribute(
                                                                        $_rhr_af,
                                                                        [
                                                                            'class'         => 'p-item',
                                                                            'data-lat'   => $this->parse_text_editor($na_item['_rhr_af_lat']),
                                                                            'data-long'   => $this->parse_text_editor($na_item['_rhr_af_lon']),
                                                                            'data-address'   => $this->parse_text_editor($na_item['_rhr_af_addr']),
                                                                        ]
                                                                    );
                                                                }else{
                                                                    $this->add_render_attribute(
                                                                        $_rhr_af,
                                                                        [
                                                                            'class'         => 'no-map'
                                                                        ]
                                                                    );
                                                                }
                                                                $_get_rhr_af = $this->get_render_attribute_string( $_rhr_af );
                                                        ?>
                                                        <?php if( !empty($na_item['_rhr_af_name']) ) : ?>
                                                            <div <?php echo $_get_rhr_af; ?>><span><?php echo $this->parse_text_editor($na_item['_rhr_af_name']); ?></span></div>
                                                        <?php endif; ?>
                                                        <?php endforeach; endif; ?>
                                                        <?php endif; ?>

                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php $loc++; endforeach; endif; ?>
                                        </div>
                                        <div class="iframe"></div>
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
