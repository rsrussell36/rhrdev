<?php 
    $is_show_share_webinar  = rhr_options( 'is_show_share_webinar', '' );
    if(true == $is_show_share_webinar){
        echo rhr_social_share_webinars(); 
    }
?>