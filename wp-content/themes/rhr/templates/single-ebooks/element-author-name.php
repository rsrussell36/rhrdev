<?php 
global $post;
$author_id = $post->post_author;
$is_author_show_ebook    = rhr_options( 'is_author_show_ebook', '' );
if( true == $is_author_show_ebook ) : ?>
    <span class="d-author"><?php echo esc_html('By:' . get_the_author_meta( 'display_name', $author_id ) ); ?></span>
<?php endif; ?>