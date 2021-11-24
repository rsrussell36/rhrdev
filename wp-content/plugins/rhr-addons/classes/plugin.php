<?php
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

Final class Plugin {

    const __CREST_PHP__ = '5.6';
    const __CREST_EL_VERSION__ = '2.0.0';
    const __CREST_RECOMMENDATION_EL_VERSION__ = '2.0.0';
    
    public static $instance = null;
    private static $classes_map;
    
    public static function instance(){
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            do_action( 'rhr_lite/loaded' );
        }
        return self::$instance;
    }
    
    private function rhr__notice() {
        require_once CREST_PATH . 'classes/class-notice.php';
        return new Notice();
    }
    public function rhr__notice_missing_free_plugin(){
         return $this->rhr__notice()->rhr__missing_php(); 
    }
    public function rhr__missing_el_plugin(){
         return $this->rhr__notice()->is_missing_elementor_plugin(); 
    }
    public function rhr__minimum_version(){
         return $this->rhr__notice()->is_minimum_el_version(); 
    }
    public function rhr__re_version(){
         return $this->rhr__notice()->is_recommendation_el_version(); 
    }
    public function rhr__thanks_message(){
         return $this->rhr__notice()->thanks_message_notice(); 
    }
    public function ajax_rhr__set_thanks_message(){
         return $this->rhr__notice()->ajax_rhr__set_thanks_message(); 
    }

    public function rhr__load_check(){
        if (version_compare(PHP_VERSION, self::__CREST_PHP__, '<')) {
            add_action('admin_notices', [$this, 'rhr__notice_missing_free_plugin']);
            return;
        }
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'rhr__missing_el_plugin']);
            return;
        }
        if (!version_compare(ELEMENTOR_VERSION, self::__CREST_EL_VERSION__, '>=')) {
            add_action('admin_notices', [$this, 'rhr__minimum_version']);
            return;
        }
        if (!version_compare(ELEMENTOR_VERSION, self::__CREST_RECOMMENDATION_EL_VERSION__, '>=')) {
            add_action('admin_notices', [$this, 'rhr__re_version']);
            return;
        }
        require_once CREST_PATH . 'classes/class-helper.php';
       $this->register_autoloader();
    }
    
    public function rhr__activation(){
        require_once CREST_PATH . 'classes/class-activator.php';
        rhr__Activator::rhr__activate();
    }
    
    public function rhr__deactivation(){
        require_once CREST_PATH . 'classes/class-deactivator.php';
        rhr__Deactivator::rhr__deactivate();
        rhr__Deactivator::rhr__user_meta_delete();     
    }

    public function rhr__installed_time() {
        $installed_time = get_option( '_rhr__installed_time' );

        if ( ! $installed_time ) {
            $installed_time = time();

            update_option( '_rhr__installed_time', $installed_time );
        }

        return $installed_time;
    }
    
    private function rhr__loaded(){
        add_action('plugins_loaded', [$this, 'rhr__load_check']);
    }

    private function rhr__hooks(){
        add_action( 'admin_notices', [$this, 'rhr__thanks_message'] );
        add_action( 'wp_ajax_rhr__set_thanks_message', [$this, 'ajax_rhr__set_thanks_message'] );
        register_activation_hook(CREST_FILE, [$this, 'rhr__activation']);
        register_activation_hook(CREST_FILE, [$this, 'rhr__installed_time']);
        register_deactivation_hook(CREST_FILE, [$this, 'rhr__deactivation']);
        $this->rhr__loaded();
    }
    private function __construct(){
       $this->rhr__hooks();
    }
    private function register_autoloader() {
        require CREST_PATH . '/classes/autoloader.php';
        \KC_GLOBAL\Autoloader::run();
        \KC_GLOBAL\Autoloader::rhr__components();
    }
}

if (defined("CREST_PLUGIN_NAME")) {
    Plugin::instance();
}