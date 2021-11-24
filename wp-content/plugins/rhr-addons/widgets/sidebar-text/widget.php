<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Sidebar_Text extends CREST_BASE{

    public function get_name(){
        return 'rhr-sidebar-text';
    }

    public function get_title(){
        return esc_html__( 'Sidebar Text', 'rhr' );
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

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_st_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Privacy Policy', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
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
        $repeater->add_control(
            '_rhr_st_sub_title',
            [
                'label' => 'Sub Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Effective Date: January 1, 2020', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter sub title..', 'rhr' ),
                'description' => __( 'Enter sub title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_st_text',
            [
                'label' => __( 'Text', 'rhr' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'For more than 75 years, RHR International LLP (“RHR”) has been building relationships with our clients based on respect and integrity. We appreciate the trust and confidence you place in us when you visit our website and when you do business with us.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );


        $this->add_control(
            '_rhr_st_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_st_tab_title' => __( 'Privacy Policy', 'rhr' ),
                        '_rhr_st_title' => __( 'Privacy Policy', 'rhr' ),
                        '_rhr_st_sub_title' => __( 'Effective Date: January 1, 2020', 'rhr' ),
                        '_rhr_st_text' => __( 'For more than 75 years, RHR International LLP (“RHR”) has been building relationships with our clients based on respect and integrity. We appreciate the trust and confidence you place in us when you visit our website and when you do business with us.', 'rhr' ),
                    ],
                    [
                        '_rhr_st_tab_title' => __( 'Restrictions on Use', 'rhr' ),
                        '_rhr_st_title' => __( 'Restrictions on Use', 'rhr' ),
                        '_rhr_st_sub_title' => __( '', 'rhr' ),
                        '_rhr_st_text' => __( 'For more than 75 years, RHR International LLP (“RHR”) has been building relationships with our clients based on respect and integrity. We appreciate the trust and confidence you place in us when you visit our website and when you do business with us.', 'rhr' ),
                    ],
                    [
                        '_rhr_st_tab_title' => __( 'Submissions', 'rhr' ),
                        '_rhr_st_title' => __( 'Submissions and Ideas', 'rhr' ),
                        '_rhr_st_sub_title' => __( '', 'rhr' ),
                        '_rhr_st_text' => __( 'For more than 75 years, RHR International LLP (“RHR”) has been building relationships with our clients based on respect and integrity. We appreciate the trust and confidence you place in us when you visit our website and when you do business with us.', 'rhr' ),
                    ],

                ],
                'title_field' => '{{ _rhr_st_tab_title }}',
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
                        <div class="col col-2 sidenav-wrap service-terms">
                            <!-- BEGIN MENU SIDEBAR -->
                            <?php if ( !empty( $settings['_rhr_st_lists'] ) ) : ?>
                                <div class="menu-navigate">
                                    <div class="items">
                                        <?php
                                            $i = 1;
                                                foreach ( $settings['_rhr_st_lists'] as $index => $tab_item ) :
                                                    $tab_count = $index + 1;
                                                    $active_class = $i == 1 ? 'active' : '';
                                        ?>
                                        <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($tab_item['_rhr_st_tab_title']); ?></a>                                        <?php $i++; endforeach; ?>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="l-bar"></div>
                                </div>
                            <?php endif; ?>
                            <!-- END MENU SIDEBAR -->
                        </div>
                        <div class="col col-8">
                            <?php if ( !empty( $settings['_rhr_st_lists'] ) ) :
                                    $i = 1;
                                        foreach ( $settings['_rhr_st_lists'] as $index => $item ) :
                                            $tab_count = $index + 1;

                                    if( $i == 1 ) : ?>
                                <div class="pc-initial-legals pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <?php if( !empty($item['_rhr_st_title']) ) : ?>
                                        <h1 class="title"> <?php echo $this->parse_text_editor($item['_rhr_st_title']); ?> </h1>
                                    <?php endif; ?>
                                    <?php if( !empty($item['_rhr_st_sub_title']) ) : ?>
                                        <div class="subtitle">
                                            <?php echo $this->parse_text_editor($item['_rhr_st_sub_title']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( !empty($item['_rhr_st_text']) ) : ?>
                                    <div class="pc-inner">
                                        <div class="pc-left"></div>
                                        <div class="pc-right">
                                            <div class="paragraph p-gray">
                                                <?php echo $this->parse_text_editor($item['_rhr_st_text']); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                </div>

                                <?php else: ?>
                                <div class="pc-inner pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <div class="pc-left">
                                    <?php if( !empty($item['_rhr_st_title']) ) : ?>
                                        <div class="caption c-light">
                                            <span><?php echo $this->parse_text_editor($item['_rhr_st_title']); ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pc-right">
                                        <?php if( !empty($item['_rhr_st_text']) ) : ?>
                                            <div class="paragraph p-gray">
                                                <?php echo html_entity_decode($item['_rhr_st_text']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php $i++; endforeach; endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $this->__close_wrap();
    }

}
