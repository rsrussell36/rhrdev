<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use \KC_GLOBAL\Utils;

function _get_options($setting, $default = false){
	return \KC_GLOBAL\Utils::_get($setting, $default = false);
}
function _get_inactive(){
	return \KC_GLOBAL\Utils::_inactive();
}
function rhr__elementor(){
	return \KC_GLOBAL\Utils::rhr__elementor();
}
function rhr__version(){
	return \KC_GLOBAL\Utils::rhr__version();
}
function get_enqueue_dependencies(){
	return \KC_GLOBAL\Utils::get_enqueue_dependencies();
}
function rhr_is_true(){
	return \KC_GLOBAL\Utils::rhr_is_true();
}
function _css_minify($css){
	return \KC_GLOBAL\Utils::_css_minify($css);
}

function rhr_animate_animation(){
	return \KC_GLOBAL\Utils::rhr_animate_animation();
}
function rhr_link( $settings_key, $is_echo = true ){
	return \KC_GLOBAL\Utils::rhr_link( $settings_key, $is_echo = true );
}
function rhr_get_post_types($args = [], $array_diff_key = []){
	return \KC_GLOBAL\Utils::rhr_get_post_types($args = [], $array_diff_key = []);
}
function rhr_contact7_activated(){
	return \KC_GLOBAL\Utils::rhr_contact7_activated();
}
function rhr_cf7_list(){
	return \KC_GLOBAL\Utils::rhr_cf7_list();
}
function rhr_metform_list(){
	return \KC_GLOBAL\Utils::rhr_metform_list();
}
function get_portfolio_categories(){
	return \KC_GLOBAL\Utils::get_portfolio_categories();
}
function get_blog_categories(){
	return \KC_GLOBAL\Utils::get_blog_categories();
}
function rhr_title_tag( $title_tag ){
	return \KC_GLOBAL\Utils::rhr_title_tag( $title_tag );
}
function rhr_shorten_text($text , $no_of__limit){
	return \KC_GLOBAL\Utils::rhr_shorten_text($text , $no_of__limit);
}
function rhr__link(array $url_control)
{
	$attributes_url = '';
	$attributes_target = '';
	$attributes_rel = '';

	if ( ! empty( $url_control['url'] ) ) {
		$allowed_protocols = array_merge( wp_allowed_protocols(), [ 'skype', 'viber' ] );
		$attributes_url = ' href="' . esc_url( $url_control['url'], $allowed_protocols ) . '"';

	}else{
		$attributes_url = ' href="#"';
	}

	if ( ! empty( $url_control['is_external'] ) ) {
		$attributes_target = ' target="_blank"';
	}

	if ( ! empty( $url_control['nofollow'] ) ) {
		$attributes_rel = ' rel="nofollow"';
	}
    return $attributes_url . $attributes_target . $attributes_rel;

}

function rhr_is_shop(){
	return \KC_GLOBAL\Utils::rhr_is_shop();
}
function rhr_bbp_is_user_home(){
	return \KC_GLOBAL\Utils::rhr_bbp_is_user_home();
}
function rhr_is_product_category(){
	return \KC_GLOBAL\Utils::rhr_is_product_category();
}
function rhr_is_product_tag(){
	return \KC_GLOBAL\Utils::rhr_is_product_tag();
}
function rhr_is_product(){
	return \KC_GLOBAL\Utils::rhr_is_product();
}
function _get_custom_taxnomies($post_type){
	return \KC_GLOBAL\Utils::_get_custom_taxnomies($post_type);
}
function rhr_navigation_menus($args = [], $array_diff_key = []){
	return \KC_GLOBAL\Utils::rhr_navigation_menus($args = [], $array_diff_key = []);
}
