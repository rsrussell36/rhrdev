<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Fun_Factor extends CREST_BASE{
    
    public function get_name(){
        return 'rhr-cfun-factor';
    }

    public function get_title(){
        return esc_html__( 'Fun Factor', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-number-field';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'fun factor', 'fun', 'count down', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_funfacts_preset',
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
            '_rhr_fun_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            '_rhr_fun_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Leaders Coached', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_fun_number',
            [
                'label' => 'Number',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '10', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter number..', 'rhr' ),
                'description' => __( 'Enter number (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_fun_prefix',
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
        $repeater->add_control(
            '_rhr_fun_sufix',
            [
                'label' => 'Sufix',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'K', 'rhr' ),
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
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_fun_title' => __( 'Leaders Coached', 'rhr' ),
                        '_rhr_fun_number' => 10,
                        '_rhr_fun_prefix' => '+',
                        '_rhr_fun_sufix' => 'K',
                    ],
                    [
                        '_rhr_fun_title' => __( 'Retention', 'rhr' ),
                        '_rhr_fun_number' => 157,
                        '_rhr_fun_prefix' => '+',
                        '_rhr_fun_sufix' => '%',
                    ],
                ],
                'title_field' => '{{ _rhr_fun_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_funfact_style_section',
            [
                'label' => __('Fun Factor', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            '_rhr_fun_width',
            [
                'label' => __('Width', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .chart .numbers' => 'width: {{SIZE}}{{UNIT}};',
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
            <div class="pages-content pc-home-chart">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-6">
                            <div class="chart">
                                <?php 
                                if ( !empty( $settings['_rhr_funfact_lists'] ) ) :
                                    $count = 1;
                                    foreach ( $settings['_rhr_funfact_lists'] as $item ) : 
                                        $prefix = !empty($item['_rhr_fun_prefix']) ? $item['_rhr_fun_prefix'] : '';
                                        $sufix = !empty($item['_rhr_fun_sufix']) ? '<span>'.$item['_rhr_fun_sufix'].'</span>' : '';
                                ?>
                                    <div class="numbers" data-count="<?php echo esc_attr($item['_rhr_fun_number']); ?>">
                                    <?php if (isset($item['_rhr_fun_number']) && !empty($item['_rhr_fun_number'])): ?>
                                        <span class="number"><?php echo $prefix . $this->parse_text_editor($item['_rhr_fun_number']); ?></span><?php echo $sufix; ?>
                                        <?php endif ?>
                                        <?php if (isset($item['_rhr_fun_title']) && !empty($item['_rhr_fun_title'])): ?>
                                            <div class="label"><?php echo $this->parse_text_editor($item['_rhr_fun_title']); ?></div>
                                        <?php endif ?>
                                    </div>
                                <?php endforeach; endif; ?>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $this->__close_wrap();
    }
    
}
