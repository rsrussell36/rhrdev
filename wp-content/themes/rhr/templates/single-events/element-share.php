<?php 
$is_show_share_event  = rhr_options( 'is_show_share_event', '' );
    if(true == $is_show_share_event){
        echo rhr_social_share_event(); 
    }
?>