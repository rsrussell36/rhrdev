<?php 
$is_tag_show_ebook    = rhr_options( 'is_tag_show_ebook', '' );

if( true == $is_tag_show_ebook ) : ?>
    <div class="tags">
        <?php 
            $terms = rhr_get_the_term_list( get_the_ID(), 'rhr_ebook_tags',' ','');
            if( !empty( $terms ) ) :
                echo $terms ;
            endif;
        ?>
    </div>
<?php endif; ?>