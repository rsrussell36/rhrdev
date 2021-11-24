<?php 
    $is_show_share_ebook  = rhr_options( 'is_show_share_ebook', '' );
    if(true == $is_show_share_ebook){
        echo rhr_social_share_ebooks(); 
    }
?>