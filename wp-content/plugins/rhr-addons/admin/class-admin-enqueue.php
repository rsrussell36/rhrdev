<?php 
/**
 * @package rhr
 *
 */
namespace KC_GLOBAL;
use \KC_GLOBAL\Utils;
use \KC_GLOBAL\Dashboard;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Admin_Enqueue{

	protected $plugin_name;

    public $utils;

    protected static $dashboard_data = null;

    protected $assets_enqueued = false;

    public function __construct(){
    	$this->rhr_admin_init();
    }
    protected function rhr_admin_init()
    {
    	$this->utils = new Utils;
        add_action( 'admin_enqueue_scripts', [ $this, 'rhr__menu_style' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_dashboard_assets' ] );
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'rhr__editor_assets']);
    }
    public static function get_dashboard_data() {
        if ( is_null( self::$dashboard_data ) ) {
            self::$dashboard_data = new Dashboard();
        }

        return self::$dashboard_data;
    }
    public function enqueue_dashboard_assets() {
        $dashboard_data = self::get_dashboard_data();
    	 if ( ! $dashboard_data->is_dashboard_page() ) {
            return false;
        }

        if ( $this->assets_enqueued ) {
            return false;
        }

        $this->rhr__enqueue_assets();

        $this->assets_enqueued = true;
    }
    
    public function rhr__enqueue_assets()
    {
        $dashboard_data = self::get_dashboard_data();
        wp_enqueue_style(
            'rhr-lite-dashboard-css',
            $this->utils->rhr__plugin_url('/assets/admin/css/rhr-dashboard.min.css'),
            false,
            Utils::rhr__version()
        );

        wp_enqueue_script(
            'rhr-lite-dashboard-script',
            $this->utils->rhr__plugin_url('/assets/admin/js/rhr-dashboard.js'),
            ['jquery'],
            Utils::rhr__version(),
            true
        );
        wp_localize_script(
            'rhr-lite-dashboard-script',
            'rhrDashboardConfig',
            apply_filters( 'rhr-dashboard/js-page-config',
                array(
                    'pageModule'           => false,
                    'subPageModule'        => false,
                    'rhr_ajax'      => esc_url( admin_url( 'admin-ajax.php' ) ),
                    'rhr_nonce'     => wp_create_nonce( 'rhrs_nonce' ),
                ),
                $dashboard_data->rhr_get_page()
            )
        );
        do_action( 'rhr-dashboard/after-enqueue-assets', $this, $dashboard_data->rhr_get_page() );
    }
    public function rhr__editor_assets()
    {
        wp_enqueue_style(
            'rhr-editor-css',
            $this->utils->rhr__plugin_url('/assets/admin/css/rhr-editor.css'),
            false,
            Utils::rhr__version()
        );
    }
    public static function rhr__menu_style() {
        ?>
        <style>
            #toplevel_page_rhr a.toplevel_page_rhr{
                background: -webkit-linear-gradient(4.95deg, #d7ad64 6.33%, #f7d18f 102.21%) !important;
                background: linear-gradient(85.05deg, #d7ad64 6.33%, #f7d18f 102.21%) !important
            }
            #toplevel_page_rhr a.toplevel_page_rhr img{width: 18px; height: 18px;}
        </style>
    <?php }
}