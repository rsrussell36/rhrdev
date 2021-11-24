<?php 
$is_tag_show_research    = rhr_options( 'is_tag_show_research', '' );

if( true == $is_tag_show_research ) : ?>
    <div class="tags">
        <?php 
            $terms = rhr_get_the_term_list( get_the_ID(), 'rhr_research_tags',' ','');
            if( !empty( $terms ) ) :
                echo $terms ;
            endif;
        ?>
    </div>
<?php endif; ?>