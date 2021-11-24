<?php 
    $is_show_share  = rhr_options( 'is_show_share', '' );
    if(true == $is_show_share){
        echo rhr_social_share(); 
    }
?>