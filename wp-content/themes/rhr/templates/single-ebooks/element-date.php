<?php
$is_date_show    = rhr_options( 'is_date_show', '' );
if( true == $is_date_show ) : ?>
    <?php echo esc_html( get_the_time( get_option('date_format') ) ); ?>
<?php endif; ?>