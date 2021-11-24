<?php

function rhr_widgets_init() {
    register_sidebar( array(
        'id' => 'l-h-sidebar',
        'name' => esc_html__( 'Header Left Menu', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in header right.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="bigger" data-cursor="scale-dark">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'id' => 'r-h-sidebar',
        'name' => esc_html__( 'Header Right Menu', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in header right.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="small">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'id' => 'f-f-sidebar',
        'name' => esc_html__( 'Footer First Row', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in footer layout first row.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="item-bigger" data-cursor="scale">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'id' => 's-f-sidebar',
        'name' => esc_html__( 'Footer Second Row', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in footer layout second row.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="item-bigger" data-cursor="scale">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'id' => 'subscriber-f-sidebar',
        'name' => esc_html__( 'Subscriber', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in footer layout subscriber column.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group g-full %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="item-bigger" data-cursor="scale">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'id' => 'recent-f-sidebar',
        'name' => esc_html__( 'Recent Post', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in footer layout recent post column.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group g-noBorder %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="item-bigger" data-cursor="scale">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'id' => 'copyright-f-sidebar',
        'name' => esc_html__( 'Copyright Menu Global', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in footer layout copyright column.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group g-noBorder %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="item-bigger" data-cursor="scale">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'id' => 'copyright-f-sidebar-eu',
        'name' => esc_html__( 'Copyright Menu EU', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in footer layout copyright column.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group g-noBorder %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="item-bigger" data-cursor="scale">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'id' => 'copyright-f-sidebar-uk',
        'name' => esc_html__( 'Copyright Menu UK', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in footer layout copyright column.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group g-noBorder %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="item-bigger" data-cursor="scale">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'id' => 'rhr-page-sidebar',
        'name' => esc_html__( 'Page Sidebar', 'rhr' ),
        'description' => esc_html__('Add Widgets to display in page sidebar column.', 'rhr' ),
        'before_widget' => '<div id="%1$s" class="widget group %2$s clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="item-bigger" data-cursor="scale">',
        'after_title' => '</h3>',
    ) );

}
add_action( 'widgets_init', 'rhr_widgets_init' );
