<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rhr
 */

get_header();


$page_sidebar = rhr_options('rhr_page_setting');


?>

	<main id="primary" class="site-main">

		<?php 
	    rhr_wrapper_start( $page_sidebar  );

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/page/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		rhr_wrapper_end( $page_sidebar );
		?>
	</main><!-- #main -->

<?php
get_footer();
