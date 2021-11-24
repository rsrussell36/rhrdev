<?php 
global $post;
$author_id = $post->post_author;
$is_date_show_webinar    = rhr_options( 'is_date_show_webinar', '' );
if( true == $is_date_show_webinar ) : ?>
    <div class="description">
        <?php echo get_the_time( get_option('date_format')); ?> <span class="bullet">•</span> <span class="time"><span class="svg"></span><?php echo rhr_time_ago(get_the_time( get_option('date_format'))); ?></span>
    </div>
<?php endif; ?>