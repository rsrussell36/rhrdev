<?php
namespace KC_GLOBAL;

use \KC_GLOBAL\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Enqueue{

	protected static $utils = null;

    public function __construct(){
        $this->init_hooks();
    }

    public function init_hooks(){
		// add_action( 'wp_enqueue_scripts', [ $this, 'rhr__addons_style' ] );
		// add_action( 'wp_enqueue_scripts', [ $this, 'rhr__addons_script' ] );
        // add_action( 'elementor/frontend/after_register_styles', array( $this, 'rhr__addons_style' ) );
        // add_action( 'elementor/frontend/before_register_styles', array( $this, 'rhr__addons_style' ) );
        // add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'rhr__addons_script' ) );
        // add_action( 'elementor/frontend/after_register_scripts', array( $this, 'rhr__addons_script' ) );

       //add_action('wp_enqueue_scripts', [__CLASS__, 'rhr_addons_frontend_scripts']);
    }

    public static function get_utils_data() {
        if ( is_null( self::$utils ) ) {
            self::$utils = new Utils();
        }

        return self::$utils;
    }
    public function rhr__addons_style()
    {
        // $utils = self::get_utils_data();
        // wp_enqueue_style(
        //     'rhr-frontend',
        //     $utils->rhr__plugin_url('/assets/css/flickity.css'),
        //     [],
        //     Utils::rhr__version()
        // );
        // do_action( 'rhr-dashboard/after-enqueue-style', $this );
    }
    public function rhr__addons_script()
    {
        $utils = self::get_utils_data();
        
        // wp_enqueue_script(
        //     'rhr-flickity',
        //     $utils->rhr__plugin_url('/assets/js/flickity.pkgd.min.js'),
        //     ['jquery','elementor-frontend'],
        //     Utils::rhr__version(),
        //     true
        // );
        // wp_enqueue_script(
        //     'rhr-frontend',
        //     $utils->rhr__plugin_url('/assets/js/rhr-frontend.js'),
        //     ['jquery','elementor-frontend'],
        //     Utils::rhr__version(),
        //     true
        // );
        // wp_localize_script(
        //     'rhr-frontend',
        //     'rhrConfig',
        //     apply_filters( 'rhr-dashboard/rhr-editor-config',
        //         array(
        //         	'ajaxurl'        => esc_url( admin_url( 'admin-ajax.php' ) ),
        //             'nonce'	=> wp_create_nonce( 'rhr-tab-nonce' ),
        //         )
        //     )
        // );
        // do_action( 'rhr-dashboard/after-enqueue-script', $this );
    }
   
}