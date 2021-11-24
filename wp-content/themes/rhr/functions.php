<?php
/**
 * rhr functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rhr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! defined( 'RHR_VERSION' ) ) {
	define( 'RHR_VERSION', wp_get_theme()->get( 'Version' ) );
}

if ( ! defined( 'RHR_THEMEROOT' ) ) {
	define( 'RHR_THEMEROOT', get_template_directory_uri());
}

if ( ! defined( 'RHR_THEMEROOT_DIR' ) ) {
	define( 'RHR_THEMEROOT_DIR', get_template_directory());
}

if ( ! defined( 'RHR_IMAGES' ) ) {
	define( 'RHR_IMAGES', RHR_THEMEROOT.'/assets/img');
}

if ( ! defined( 'RHR_ASSETS' ) ) {
	define( 'RHR_ASSETS', RHR_THEMEROOT.'/assets');
}

if ( ! defined( 'RHR_CSS' ) ) {
	define( 'RHR_CSS', RHR_THEMEROOT.'/assets/css');
}

if ( ! defined( 'RHR_JS' ) ) {
	define( 'RHR_JS', RHR_THEMEROOT.'/assets/js');
}

if ( ! defined( 'RHR_ADMIN' ) ) {
	define( 'RHR_ADMIN', RHR_THEMEROOT.'/assets/admin');
}

if ( ! defined( 'RHR_VENDOR' ) ) {
	define( 'RHR_VENDOR', RHR_THEMEROOT.'/assets/vendors');
}


if ( ! function_exists( 'rhr_theme_setup' ) ) :
	function rhr_theme_setup() {

		load_theme_textdomain( 'rhr', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'block-templates' );
		remove_theme_support( 'widgets-block-editor' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus(
			array(
				'primary_menu' => esc_html__( 'Primary Menu', 'rhr' ),
				'footer_menu' => esc_html__( 'Footer Menu', 'rhr' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support(
			'custom-background',
			apply_filters(
				'rhr_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );


		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		// add_image_size( 'rhr_default', 288, 300, true );
		// add_image_size( 'rhr_client', 200, 200, true );
		// add_image_size( 'rhr_blog', 369, 385, true );
		// add_image_size( 'blog_rel', 340, 354, true );
		// add_image_size( 'blog_single', 956, 550, true );
		// add_image_size( 'rhr_clients_cases', 415, 250, true );
		// add_image_size( 'rhr_clients_cases_stories', 611, 272, true );
		// add_image_size( 'clients_cases_single', 1152, 550, true );
		// add_image_size( 'clients_cases_logo', 104, 101, true );
		// add_image_size( 'rhr_ebooks', 288, 430, true );
		// add_image_size( 'ebooks_single', 432, 433, true );
		// add_image_size( 'rhr_event', 693, 530, true );
		// add_image_size( 'event_single', 441, 337, true );
		// add_image_size( 'event_rel', 340, 354, true );
		// add_image_size( 'rhr_news', 693, 530, true );
		// add_image_size( 'rhr_last_news', 288, 300, true );
		// add_image_size( 'news_single', 441, 337, true );
		// add_image_size( 'news_rel', 340, 354, true );
		// add_image_size( 'research_single', 1288, 740, true );
		// add_image_size( 'research_rel', 340, 354, true );
		// add_image_size( 'rhr_team', 190, 254, true );
		// add_image_size( 'team_single', 432, 560, true );
		// add_image_size( 'rhr_webniar', 288, 199, true );
		// add_image_size( 'webinar_single', 432, 240, true );
		// add_image_size( 'rhr_resources', 288, 300, true );
		// add_image_size( 'rhr_resources_masonry', 719, 440, true );
		// add_image_size( 'rhr_resources_grid', 288, 300, true );
		// add_image_size( 'rhr_resources_ls', 288, 300, true );

	}
endif;
add_action( 'after_setup_theme', 'rhr_theme_setup' );

function rhr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rhr_content_width', 640 );
}
add_action( 'after_setup_theme', 'RHR_content_width', 0 );

function rhr_admin_privacy_remove() { ?>
	<style type="text/css">
		.login .privacy-policy-page-link{
			display: none!important;
		}
	</style>
<?php }
add_action( 'login_head', 'rhr_admin_privacy_remove' );
require_once RHR_THEMEROOT_DIR . '/inc/init.php';
require_once RHR_THEMEROOT_DIR . '/lib/init.php';

$rhr_role_object = get_role( 'editor' );
$rhr_role_object->add_cap( 'manage_privacy_options', true );
$rhr_role_object->add_cap( 'manage_options' );
