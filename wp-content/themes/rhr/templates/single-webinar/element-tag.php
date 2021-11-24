<?php 
$is_tag_show_webinar    = rhr_options( 'is_tag_show_webinar', '' );

if( true == $is_tag_show_webinar ) : ?>
    <div class="tags">
        <?php 
            $terms = rhr_get_the_term_list( get_the_ID(), 'rhr_webinar_tags',' ','');
            if( !empty( $terms ) ) :
                echo $terms ;
            endif;
        ?>
    </div>
<?php endif; ?>