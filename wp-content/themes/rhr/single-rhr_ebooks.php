<?php
/**
 * The template for displaying all blog post
 *
 *
 * @package rhr
 */

get_header();

if ( have_posts() ) :
     
    while ( have_posts() ) : the_post();
        get_template_part( 'templates/single-ebooks/style/single', 'layout' );
    endwhile;

endif;
get_footer();
