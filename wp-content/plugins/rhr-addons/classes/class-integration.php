<?php
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Integration{

    public function __construct(){
        add_action( 'elementor/init', [$this, 'rhr__register_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [$this, 'rhr__register'] );
    }

    public function rhr__register_category() {
        $elements_manager = \Elementor\Plugin::instance()->elements_manager;
        $rhr_cat       = 'rhr_cat';

        $elements_manager->add_category(
            $rhr_cat,
            array(
                'title' => esc_html__( 'RHR Elements', 'rhr' ),
                'icon'  => 'font',
            ),
            1
        );
    }
    public static function rhr__widgets_map() {
        return [
            'about' => [
                'title' => __( 'About', 'rhr' ),
                'icon' => 'eicon-plug',
            ],
            'banner' => [
                'title' => __( 'Banner', 'rhr' ),
                'icon' => 'eicon-banner',
            ],
            'breadcrumbs' => [
                'title' => __( 'Breadcrumbs', 'rhr' ),
                'icon' => 'eicon-banner',
            ],
            'breadcrumb' => [
                'title' => __( 'RHR Breadcrumb', 'rhr' ),
                'icon' => 'eicon-banner',
            ],
            'contact' => [
                'title' => __( 'Get In Touch', 'rhr' ),
                'icon' => 'eicon-form-horizontal',
            ],
            'content-button' => [
                'title' => __( 'Content + Button', 'rhr' ),
                'icon' => 'eicon-text',
            ],
            'clients' => [
                'title' => __( 'Clients', 'rhr' ),
                'icon' => 'eicon-slider-full-screen',
            ],
            'client-slider' => [
                'title' => __( 'Client + Slider', 'rhr' ),
                'icon' => 'eicon-slider-full-screen',
            ],
            'events' => [
                'title' => __( 'Events', 'rhr' ),
                'icon' => 'eicon-plug',
            ],
            'client-stories' => [
                'title' => __( 'Client Stories', 'rhr' ),
                'icon' => 'eicon-plug',
            ],
            'fun-factor' => [
                'title' => __( 'Fun Facts', 'rhr' ),
                'icon' => 'eicon-number-field',
            ],
            'home-content' => [
                'title' => __( 'Home Content', 'rhr' ),
                'icon' => 'eicon-text',
            ],
            'image-box' => [
                'title' => __( 'Image Box', 'rhr' ),
                'icon' => ' eicon-image-box',
            ],
            'news' => [
                'title' => __( 'News', 'rhr' ),
                'icon' => 'eicon-posts-grid',
            ],
            'posts' => [
                'title' => __( 'Posts', 'rhr' ),
                'icon' => 'eicon-posts-grid',
            ],
            'page-heading' => [
                'title' => __( 'Page Heading', 'rhr' ),
                'icon' => 'eicon-heading',
            ],
            'client-stories-heading' => [
                'title' => __( 'Client Stories Heading', 'rhr' ),
                'icon' => 'eicon-heading',
            ],
            'resources' => [
                'title' => __( 'Resources', 'rhr' ),
                'icon' => 'eicon-editor-list-ol',
            ],
            'sitemap' => [
                'title' => __( 'Site Map', 'rhr' ),
                'icon' => 'eicon-editor-list-ol',
            ],
            'sidebar-text' => [
                'title' => __( 'Sidebar Text', 'rhr' ),
                'icon' => 'eicon-text',
            ],
            'solutions' => [
                'title' => __( 'Solutions', 'rhr' ),
                'icon' => 'eicon-editor-list-ol',
            ],
            'successions' => [
                'title' => __( 'Successions', 'rhr' ),
                'icon' => 'eicon-editor-list-ol',
            ],
            'lprivate' => [
                'title' => __( 'Private', 'rhr' ),
                'icon' => 'eicon-editor-list-ol',
            ],
            'venture' => [
                'title' => __( 'Venture', 'rhr' ),
                'icon' => 'eicon-editor-list-ol',
            ],
            'our-solutions' => [
                'title' => __( 'Our Solutions', 'rhr' ),
                'icon' => 'eicon-editor-list-ol',
            ],
            'text' => [
                'title' => __( 'Text', 'rhr' ),
                'icon' => 'eicon-text',
            ],
            'text-two' => [
                'title' => __( 'Text Second', 'rhr' ),
                'icon' => 'eicon-text',
            ],
            'submit-button' => [
                'title' => __( 'Submit Button', 'rhr' ),
                'icon' => 'eicon-button',
            ],
            'vertical-slider' => [
                'title' => __( 'Home Vertical Slider', 'rhr' ),
                'icon' => 'eicon-slider-full-screen',
            ],
            'whats-new' => [
                'title' => __( 'Whats New', 'rhr' ),
                'icon' => 'eicon-posts-grid',
            ],
        ];
    }
    public function rhr__register() {
        $_inactive       = _get_inactive();
        require CREST_PATH . 'classes/class-base.php';
        foreach ( self::rhr__widgets_map() as $widget_key => $data ) {
            $slug = CREST_PATH . 'widgets/' . $widget_key . '/widget.php';
            if ( !is_readable( $slug) ) {
                continue;
            }
            include_once( $slug );
            $widget_class = '\KC_GLOBAL\Widget\\' . str_replace( '-', '_', $widget_key );
            if ( class_exists( $widget_class ) ) {
                if ( ! in_array( $widget_key, $_inactive ) ) {
                    rhr__elementor()->widgets_manager->register_widget_type( new $widget_class );
                }
            }
        }
    }
}
