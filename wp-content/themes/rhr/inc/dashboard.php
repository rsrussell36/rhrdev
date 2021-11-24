<?php

function remove_rhr_notification() {
	//echo '<style>.notice, .update_nag { display: none!important; }</style>';
    echo '<style>.e-notice, .e-admin-top-bar--active, .wpmet-notice, #wp301_404_errors, .hide-postbox-tog, label[for=wp301_404_errors-hide], .update-nag, .rhr-thanks-notice { display: none!important; }</style>';
}
add_action('admin_head', 'remove_rhr_notification');

function rhr_remove_dashboard_meta() {
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );// Remove WordPress Events and News
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );//Remove Quick Draft
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );//Remove Draft
    remove_meta_box( 'dashboard_site_health', 'dashboard', 'core');// Remove WordPress Site Health
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    //remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );//Remove "At a Glance"
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');// Remove "Activity" which includes "Recent Comments"
    remove_meta_box('e-dashboard-overview', 'dashboard', 'normal');// Remove WordPress Elemetor
    remove_meta_box('wpmet-stories', 'dashboard', 'normal');// Remove WordPress WPMet Form Widget
    remove_meta_box('wp301_404_errors', 'dashboard', 'normal');// Remove WordPress WPMet Form Widget
}
add_action( 'admin_init', 'rhr_remove_dashboard_meta' );
