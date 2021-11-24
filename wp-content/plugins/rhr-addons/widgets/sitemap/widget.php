<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Sitemap extends CREST_BASE{

    public function get_name(){
        return 'rhr-sitemap';
    }

    public function get_title(){
        return esc_html__( 'Site Map', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-editor-list-ol';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Site Map', 'sitemap', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_site_map_preset',
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
            '_rhr_site_map_content_section',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_sitemap_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Our Solutions', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_sitemap_h_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter heading link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_sitemap_title!' => '',
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_sitemap_menu_filter',
            array(
                'label' => __('Choose Menus', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'options' => rhr_navigation_menus(),
                'default' => '',
                'description' => __( 'Choose menu name (or) Leave it empty to aply default.', 'rhr' ),
            )
        );
        $this->add_control(
            '_rhr_sitemap_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_sitemap_title' => __( 'Our Solutions', 'rhr' ),
                    ],
                ],
                'title_field' => '{{ _rhr_sitemap_title }}',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );

        $this->__open_wrap();
        ?>
            <div class="pages-content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-10">
                            <div class="site-map">
                                    <?php if ( !empty( $settings['_rhr_sitemap_lists'] ) ) : ?>
                                        <?php
                                            $i = 1;
                                            foreach ( $settings['_rhr_sitemap_lists'] as $index => $site_item ) :
                                                if ($i%4 == 1)
                                                {
                                                    echo '<div>';
                                                }
                                        ?>
                                        <div class="group">
                                            <?php if (isset($site_item['_rhr_sitemap_title']) && !empty($site_item['_rhr_sitemap_title'])): ?>
                                                <a <?php echo rhr__link($site_item['_rhr_sitemap_h_link']); ?> class="type" data-cursor="scale"><?php echo $this->parse_text_editor($site_item['_rhr_sitemap_title']); ?></a>
                                            <?php endif; ?>
                                            <?php if (isset($site_item['_rhr_sitemap_menu_filter']) && !empty($site_item['_rhr_sitemap_menu_filter'])):
                                                $menu_items = wp_get_nav_menu_items($site_item['_rhr_sitemap_menu_filter']);
                                                foreach ($menu_items as $j => $item) {
                                                        $target = !empty($item->target) ? ' target=' . $item->target : '';
                                                        $attr_title = !empty($item->attr_title) ? ' title=' . $item->attr_title : '';
                                                        $attr_rel = !empty($item->xfn) ? ' rel=' . $item->xfn : '';
                                                    if (empty($item->menu_item_parent)) {
                                                        echo '<a href="'.esc_url($item->url).'" '.$target. $attr_title . $attr_rel .' id="item-'.$item->ID.'" class="item '.$item->classes[0].'" >'.$item->title.'</a>';
                                                    }else{
                                                        echo '<a href="'.esc_url($item->url).'" '.$target. $attr_title . $attr_rel .' id="item-'.$item->ID.'" class="item i-sub '.$item->classes[0].'" >'.$item->title.'</a>';
                                                    }
                                                }
                                            ?>
                                             <?php endif; ?>
                                        </div>
                                        <?php
                                            if ($i%4 == 0)
                                            {
                                                echo '</div>';
                                            }
                                        ?>
                                        <?php $i++; endforeach; ?>
                                        <?php if ($i%4 != 1) echo "</div>"; ?>
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
