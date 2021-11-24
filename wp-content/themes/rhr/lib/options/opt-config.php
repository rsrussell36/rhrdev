<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $opt_name = 'rhr';

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'display_name'         => $theme->get( 'Name' ),
        'page_title'           => __( 'RHR Options', 'rhr' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_title'           => esc_html__( 'Theme Options', 'rhr' ),
        'customizer'           => true,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons dashicons-screenoptions',
        'page_slug'            => 'rhr-options',
		'dev_mode'             => false
    );

    Redux::setArgs( $opt_name, $args );

	require RHR_THEMEROOT_DIR . '/lib/options/opt_general.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_header.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_blog.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_events.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_ebooks.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_news.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_research.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_teams.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_webinar.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_form.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_mailchimp.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_pages.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_login.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_back.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_404.php';
	require RHR_THEMEROOT_DIR . '/lib/options/opt_footer.php';
