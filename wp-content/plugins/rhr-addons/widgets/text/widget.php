<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Text extends CREST_BASE{
    
    public function get_name(){
        return 'rhr-text';
    }

    public function get_title(){
        return esc_html__( 'RHR Text', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-text';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'title', 'heading', 'text', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_text_preset',
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
                    'default' => 'Default',
                ],
                'default' => 'default',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_text_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_text',
            [
                'label' => 'Text',
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Lorem Ipsum dolor site...', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter text..', 'rhr' ),
                'description' => __( 'Enter text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_text_wrap_class',
            [
                'label' => 'Wrapper Extra Class',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter class name..', 'rhr' ),
                'description' => __( 'Enter class name (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_text!' => ''
                ]
            ]
        );
        $this->add_control(
            '_rhr_text_class',
            [
                'label' => 'Text Extra Class',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter class name..', 'rhr' ),
                'description' => __( 'Enter class name (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_text!' => ''
                ]
            ]
        );
        
        $this->add_control(
            'text_tag', 
            [
                'label' => __('HTML Tag', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
                'description' => __( 'Choose title tag (or) Leave it empty to aply theme default(h2).', 'rhr' ),
                'condition' => [
                    '_rhr_text!' => ''
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_text_align',
            [
                'label' => __('Alignment', 'rhr' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'rhr' ),
                        'icon' => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => __('Center', 'rhr' ),
                        'icon' => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => __('Right', 'rhr' ),
                        'icon' => 'fa fa-align-right',
                    ),
                ),
                'default' => 'center',
                'toggle' => false,
                'condition' => [
                    '_rhr_blog_paging' => ['yes'],
                ],
                'selectors' => array(
                    '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title' => 'text-align: {{VALUE}}',
                ),
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_link_section',
            [
                'label' => __( 'Link', 'rhr' ),
                'condition' => [
                    '_rhr_text!' => ''
                ]
            ]
        );
        $this->add_control(
            'show_link',
            [
                'label' => __('Enable', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'rhr' ),
                'label_off' => __('Hide', 'rhr' ),
                'default' => 'yes', 
            ]
        );
        
        $this->add_control(
            '_rhr_text_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    'show_link' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'show_data_cursor',
            [
                'label' => __('Cursor', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'rhr' ),
                'label_off' => __('Hide', 'rhr' ),
                'default' => 'yes',
                'condition' =>[
                    'show_link' => 'yes',
                    '_rhr_text_link!' => ''
                ], 
            ]
        );
        $this->add_control(
            '_rhr_link_class',
            [
                'label' => 'Extra Class',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter class name..', 'rhr' ),
                'description' => __( 'Enter class name (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    'show_link' => 'yes',
                    '_rhr_text_link!' => ''
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_text_style_section',
            [
                'label' => __('Text Style', 'auspicious'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                        '_rhr_text!' => '',
                    ],
            ]
        );

        $this->add_control(
            '_rhr_text_color',
            [
                'label' => esc_html__('Color', 'auspicious'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_text_color_hover',
            [
                'label' => esc_html__('Hover Color', 'auspicious'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_text_hover_transition', [
                 'label' => esc_html__( 'Transition', 'auspicious' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1000,
                'step' => 0.1,
                'placeholder' => __(0.2, 'auspicious'),
                'default' => __(0.2, 'auspicious'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title' => '-webkit-transition: all {{VALUE}}s;transition: all {{VALUE}}s;',
                ],
                'condition' => [
                    '_rhr_text_color_hover!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_rhr_text_typography',
                'selector' => '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_rhr_text_bg_color',
                'label' => 'Background Color',
                'types' => ['classic', 'gradient'],
                'selector' =>
                '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'auspicious'),
                    ],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_rhr_text_border',
                'label' => esc_html__('Border', 'auspicious'),
                'selector' => '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title',
            ]
        );
        $this->add_responsive_control(
            '_rhr_text_radius',
            [
                'label' => esc_html__('Border Radius', 'auspicious'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_text_margin',
            [
                'label' => esc_html__('Margin', 'auspicious'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_text_padding',
            [
                'label' => esc_html__('Padding', 'auspicious'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-text .rhr-custom-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $this->add_render_attribute(
            '_rhr_text_wrapper',
            [
                'class'         => 'rhr-text-wrapper',
            ]
        );
        $this->add_render_attribute(
            '_rhr_text_inner',
            [
                'class'         => 'rhr-custom-title',
            ]
        );
        if(!empty($settings['_rhr_text']) && !empty($settings['_rhr_text_class'])){
            $this->add_render_attribute(
                '_rhr_text_inner',
                [
                    'class'         => $settings['_rhr_text_class'],
                ]
            );
        }

        $this->add_render_attribute(
            '_rhr_text_wrapper_inner',
            [
                'class'         => 'rhr-text-wrapper',
            ]
        );

        if(!empty($settings['_rhr_text']) && !empty($settings['_rhr_text_wrap_class'])){
            $this->add_render_attribute(
                '_rhr_text_wrapper_inner',
                [
                    'class'         => $settings['_rhr_text_wrap_class'],
                ]
            );
        }

        $this->add_render_attribute(
            '_rhr_link_wrapper',
            [
                'class'         => 'rhr-link',
            ]
        );
        if('yes' === $settings['show_link'] && !empty($settings['_rhr_text_link'])){
            $this->add_render_attribute(
                '_rhr_link_wrapper',
                [
                    'class'         => $settings['_rhr_link_class'],
                ]
            );
        }
        if('yes' === $settings['show_link'] && 'yes' === $settings['show_data_cursor'] && !empty($settings['_rhr_text_link'])){
            $this->add_render_attribute(
                '_rhr_link_wrapper',
                [
                    'dara-cursor'         => 'scale',
                ]
            );
        }
        $_get_wrapper = $this->get_render_attribute_string( '_rhr_text_wrapper' );
        $_get_link_wrapper = $this->get_render_attribute_string( '_rhr_link_wrapper' );
        $_get_text_inner = $this->get_render_attribute_string( '_rhr_text_inner' );
        $_get_text_wrapper_inner = $this->get_render_attribute_string( '_rhr_text_wrapper_inner' );
        $this->__open_wrap();
        ?>
            <div <?php echo $_get_wrapper; ?>>
                <?php if (isset($settings['show_link']) && 'yes' === $settings['show_link'] && !empty($settings['_rhr_text_link'])): ?>
                        <a <?php echo rhr__link($settings['_rhr_text_link']); ?> <?php echo $_get_link_wrapper; ?>>
                    <?php endif; ?>
                    <?php if (isset($settings['_rhr_text']) && !empty($settings['_rhr_text'])): ?>
                        <?php if (!empty($settings['_rhr_text_wrap_class'])): ?>
                            <div <?php echo $_get_text_wrapper_inner; ?>>
                        <?php endif; ?>
                            <<?php echo rhr_title_tag($settings['text_tag']); ?> <?php echo $_get_text_inner; ?>><?php echo $this->parse_text_editor($settings['_rhr_text']); ?></<?php echo rhr_title_tag($settings['text_tag']); ?>>
                        <?php if (!empty($settings['_rhr_text_wrap_class'])): ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (isset($settings['show_link']) && 'yes' === $settings['show_link'] && !empty($settings['_rhr_text_link'])): ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php
        $this->__close_wrap();
    }
    
}
