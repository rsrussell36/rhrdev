<?php
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class rhr__Deactivator{
    
    public static function rhr__deactivate() {
        flush_rewrite_rules();
	}
    public static function rhr__user_meta_delete() {
        return delete_user_meta(get_current_user_id(), '_rhr__thanks_notice');
	}
}