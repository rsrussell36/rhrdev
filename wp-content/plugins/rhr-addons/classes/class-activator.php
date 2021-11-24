<?php
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class rhr__Activator{
    
    public static function rhr__activate() {
		flush_rewrite_rules();
	}
}