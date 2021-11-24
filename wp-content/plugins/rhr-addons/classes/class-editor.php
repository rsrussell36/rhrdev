<?php
namespace KC_GLOBAL;

use \KC_GLOBAL\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Editor{

    public function __construct(){
        $this->init_hooks();
    }

    public function init_hooks(){
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'rhr__editor_styles' ) );
        add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'rhr__editor_scripts' ) );
        //add_action( 'wp_enqueue_scripts', [ $this, 'rhr__editor_styles' ], 999999 );
    }

    public static function url(){
        $file = trailingslashit(plugin_dir_url( CREST_FILE )). 'assets/';
        return $file;
    }

    public static function dir(){
        $file = trailingslashit(plugin_dir_path( CREST_FILE )). 'assets/';
        return $file;
    }

    public static function version(){
        if( defined('CREST_VERSION') ){
            return CREST_VERSION;
        } else {
            return apply_filters('dladdons_pro_version', '1.0.0');
        }
    }
    public function rhr__editor_styles() {
        do_action( 'rhr/editor/before_enqueue_styles' );
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        wp_enqueue_style(
            'rhr-editor-tab-editor',
            self::url() . 'css/editor/editor.css',
            [],
            self::version(),
        );
        do_action( 'rhr/editor/after_enqueue_styles' );
    }
    public function rhr__editor_scripts() {
        do_action( 'rhr/editor/before_enqueue_scripts' );
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        
        wp_enqueue_script(
            'rhr-editor-tab-editor',
            self::url() . 'js/editor/editor.js',
            ['jquery', 'underscore', 'backbone-marionette'],
            self::version(),
            true
        );
        do_action( 'rhr/editor/after_enqueue_scripts' );
    }
}