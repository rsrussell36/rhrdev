<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rhr
 */

if ( ! is_active_sidebar( 'rhr-page-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-lg-4 sidebar_right">
	<?php dynamic_sidebar( 'rhr-page-sidebar' ); ?>
</aside><!-- #secondary -->
