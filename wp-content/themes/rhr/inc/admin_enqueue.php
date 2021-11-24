<?php 

add_action( 'admin_enqueue_scripts', 'rhr_admin_enqueues');

function rhr_admin_enqueues() {
  
    if(function_exists('get_current_screen')){
    
        $screen = get_current_screen(); 
        
        if($screen->base == 'toplevel_page_rhr-options') {
            wp_enqueue_style( 'rhr-redux-style', RHR_ADMIN.'/redux-style.css' );
            wp_enqueue_style( 'rhr-sofiapro', RHR_ADMIN.'/sofiapro.css' );
        }
    }
    
}
