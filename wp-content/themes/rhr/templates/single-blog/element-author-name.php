<?php 
global $post;
$author_id = $post->post_author;
$is_author_show    = rhr_options( 'is_author_show', '' );
if( true == $is_author_show ) : ?>
    <span class="d-author"><?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></span>
<?php endif; ?>