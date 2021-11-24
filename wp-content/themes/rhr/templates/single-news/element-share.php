<?php 
$is_show_share_news  = rhr_options( 'is_show_share_news', '' );
    if(true == $is_show_share_news){
        echo rhr_social_share_news(); 
    }
?>