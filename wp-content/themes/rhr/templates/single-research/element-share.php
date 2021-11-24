<?php 
$is_show_share_research  = rhr_options( 'is_show_share_research', '' );
    if(true == $is_show_share_research){
        echo rhr_social_share_research(); 
    }
?>