<?php

function rhr_scripts() {

	wp_enqueue_style( 'rhr-style', get_stylesheet_uri(), array(), RHR_VERSION );
	wp_enqueue_style( 'rhr-lle2okt', RHR_CSS . '/lle2okt.css', array( 'rhr-style' ), RHR_VERSION );
	wp_enqueue_style( 'rhr-bootstrap-grid', RHR_CSS . '/bootstrap-grid.min.css', array( 'rhr-style' ), RHR_VERSION );
	wp_deregister_style('wp-mediaelement');
	wp_enqueue_style( 'rhr-main', RHR_CSS . '/main.css', array( 'rhr-style' ), RHR_VERSION );

	wp_enqueue_script( 'rhr-mailchimp', RHR_JS . '/ajax-chimp.js', array('jquery'), RHR_VERSION, true );
	wp_enqueue_script( 'rhr-recaptcha', 'https://www.google.com/recaptcha/api.js', array('jquery'), RHR_VERSION, true );
	wp_enqueue_script( 'rhr-themes', RHR_JS . '/themes.js', array('jquery'), RHR_VERSION, true );
	wp_enqueue_script( 'rhr-main', RHR_JS . '/main.js', array('jquery'), RHR_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	$localized_settings = [
		'ajax_url'  => admin_url( 'admin-ajax.php' ),
		'rhr_nonce'  => wp_create_nonce('rhr-nonce'),
	];
	$localized_settings_configure = [
		'ajax_url'  => admin_url( 'admin-ajax.php' ),
		'rhr_nonce_setting'  => wp_create_nonce('rhr-nonce'),
		'rhr_page_id'  => 'page-id-'.get_queried_object_id(),
	];
	wp_localize_script(
		'rhr-themes',
		'rhrSetting',
		$localized_settings_configure
	);
}
add_action( 'wp_enqueue_scripts', 'rhr_scripts' );
