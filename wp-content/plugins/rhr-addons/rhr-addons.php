<?php
/*
Plugin Name: RHR Elementor Addons
Plugin URI: http://kingscrestglobal.com/
Description: RHR Elementor Addons of super useful widgets. This Elementor compatible plugin is easy to use and you can customize different features as you like. Just plug and play.
Version: 1.0.0
Author: King Crest Global
Author URI: https://kingscrestglobal.com/
License: GPLv3
Text Domain: rhr
Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if (!defined("CREST_PLUGIN_NAME")) {
    define("CREST_PLUGIN_NAME", 'RHR Elementor Addons');
}

if (!defined("CREST_VERSION")) {
    define("CREST_VERSION", '1.0.0');
}

if (!defined("CREST_WP_VERSION")) {
    define("CREST_WP_VERSION", '4.9');
}

if (!defined("CREST_PHP_VERSION")) {
    define("CREST_PHP_VERSION", '5.6');
}

if (!defined("CREST_FILE")) {
    define("CREST_FILE", __FILE__);
}

if (!defined("CREST_BASE")) {
    define("CREST_BASE", trailingslashit(plugin_basename(CREST_FILE)));
}

if (!defined("CREST_PATH")) {
    define("CREST_PATH", trailingslashit(plugin_dir_path(CREST_FILE)));
}

if (!defined("CREST_URL")) {
    define("CREST_URL", trailingslashit(plugin_dir_url(CREST_FILE)));
}
if (!defined("CREST_IMAGE")) {
    define("CREST_IMAGE", CREST_URL . 'assets/_images/');
}

if (!defined("CREST_WIDGETS")) {
    define("CREST_WIDGETS", CREST_PATH . 'assets/widgets/');
}
require_once CREST_PATH . 'classes/plugin.php';