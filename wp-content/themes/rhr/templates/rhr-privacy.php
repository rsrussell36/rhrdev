<?php
/**
 * Template Name: RHR Privacy
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RHR
 */
get_header();?>

<section class="privacy-policy">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12 col-xl-10">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/page/content', 'page' );
		endwhile;
		?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>