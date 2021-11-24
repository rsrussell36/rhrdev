<?php 
/**
 * @package rhr
 *
 */
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Locale{
	public function __construct(){
    	//die('ok');
    }
	public static function rhr_plugin_textdomain() {
		load_plugin_textdomain(
			'rhr-textdomain',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}