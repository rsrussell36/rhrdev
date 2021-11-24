<?php 
$is_tag_show_event    = rhr_options( 'is_tag_show_event', '' );

if( true == $is_tag_show_event ) : ?>
    <div class="tags">
        <?php 
            $terms = rhr_get_the_term_list( get_the_ID(), 'rhr_event_tags',' ','');
            if( !empty( $terms ) ) :
                echo $terms ;
            endif;
        ?>
    </div>
<?php endif; ?>