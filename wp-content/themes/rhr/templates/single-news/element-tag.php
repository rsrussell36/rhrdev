<?php 
$is_tag_show_news    = rhr_options( 'is_tag_show_news', '' );

if( true == $is_tag_show_news ) : ?>
    <div class="tags">
        <?php 
            $terms = rhr_get_the_term_list( get_the_ID(), 'rhr_news_tags',' ','');
            if( !empty( $terms ) ) :
                echo $terms ;
            endif;
        ?>
    </div>
<?php endif; ?>