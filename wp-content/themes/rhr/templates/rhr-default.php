<?php
/**
 * Template Name: RHR Default
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RHR
 */
get_header();?>

<div class="main-content pages">
	<section>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/page/content', 'page' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		?>
	</section>
</div>
<?php get_footer(); ?>