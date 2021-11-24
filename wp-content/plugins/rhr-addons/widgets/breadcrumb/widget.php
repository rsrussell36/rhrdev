<?php

namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;
if (!defined('ABSPATH')) {
    exit;
}

class Breadcrumb extends CREST_BASE
{

    public function get_name()
    {
        return 'rhr-breadcrumb';
    }

    public function get_title()
    {
        return esc_html__('RHR Breadcrumb', 'rhr');
    }

    public function get_icon()
    {
        return 'rhr-signature eicon-product-breadcrumb';
    }

    public function get_categories()
    {
        return ['rhr_cat'];
    }
    public function get_keywords()
    {
        return ['Breadcrumb', 'breadcrumb', 'rhr', 'rhr'];
    }
    public function get_help_url()
    {
        return '';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            '_rhr_design_preset',
            [
                'label' => __('Preset', 'rhr'),
            ]
        );

        $this->add_control(
            '_rhr_design',
            [
                'label' => esc_html__('Design Format', 'rhr'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'default' => 'Select',
                ],
                'default' => 'default',
            ]
        );

        $this->end_controls_section();


		$this->start_controls_section(
			'_rhr_section_breadcrumb',
			array(
				'label' => __( 'Breadcrumb', 'rhr' ),
			)
		);
		$this->add_control(
            '_rhr_br_text',
            [
                'label' => 'Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Resources', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter text', 'rhr' ),
                'description' => __( 'Enter text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
		$this->add_control(
            '_rhr_br_separator',
            [
                'label' => 'Separator',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '/', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter separator', 'rhr' ),
                'description' => __( 'Enter separator (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_br_last',
            [
                'label' => 'Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Blog', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter text', 'rhr' ),
                'description' => __( 'Enter text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_br_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_br_text!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_br_search',
            [
                'label' => __('Enable Search Icon', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => __( 'Enable search icon (or) Leave it empty to apply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_br_search_type',
            [
                'label' => 'Post Type',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter post type', 'rhr' ),
                'description' => __( 'Enter post type to search by type (or) Leave it empty to hide.', 'rhr' ),
                'condition' =>[
                    '_rhr_br_search' => ['yes'],
                ],
            ]
        );
        $this->add_control(
            '_rhr_br_class',
            [
                'label' => __( 'Extra Class', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __( 'Enter section class', 'rhr' ),
                'description' => __( 'Enter section class name like(pc-events) (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
		$this->end_controls_section();
        $this->start_controls_section(
            '_rhr_breadcrumb_style_section',
            [
                'label' => __('Breadcrumb', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_rhr_breadcrumb_color',
            [
                'label' => esc_html__('Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumb .breadcrumbs' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_breadcrumb_link',
            [
                'label' => esc_html__('Link Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumb .breadcrumbs .breadcumbs-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_breadcrumb_unlink',
            [
                'label' => esc_html__('Unlink Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumb .breadcrumbs .breadcumbs-unlink' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $id_int = substr($this->get_id_int(), 0, 3);
        $this->__open_wrap();
        $_br_class = isset($settings['_rhr_br_class']) && !empty($settings['_rhr_br_class']) ? $settings['_rhr_br_class'] : '';
        $_rhr_br_search = isset($settings['_rhr_br_search']) && !empty($settings['_rhr_br_search']) ? $settings['_rhr_br_search'] : '';
        $br_text = isset($settings['_rhr_br_text']) && !empty($settings['_rhr_br_text']) ? '<a '.rhr__link($settings['_rhr_br_link']).' data-cursor="scale" class="breadcumbs-link">'.$settings['_rhr_br_text'].'</a>' : '';
        $br_separator = isset($settings['_rhr_br_separator']) && !empty($settings['_rhr_br_separator']) ? $settings['_rhr_br_separator'] : '';
        $br_text_last = isset($settings['_rhr_br_last']) && !empty($settings['_rhr_br_last']) ? '<span class="breadcumbs-unlink">'.$settings['_rhr_br_last'].'</span>' : '';
	?>

    <div class="pages-content pc-noPadidng <?php echo esc_attr($_br_class); ?>">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-10">
                    <div class="breadcrumbs">
                        <?php echo $br_text . ' ' . $br_separator . ' ' . $br_text_last ?>
                    </div>
                    <?php if( 'yes' == $_rhr_br_search ) : ?>
                        <div class="filters">
                            <input type="hidden" class="search-post-type" value="<?php echo esc_html($settings['_rhr_br_search_type']);?>">
                            <div class="ico-search i-search">
                                <div class="svg"></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->__close_wrap();
	}
    protected function content_template(){
        /*Content Template*/
    }
}
