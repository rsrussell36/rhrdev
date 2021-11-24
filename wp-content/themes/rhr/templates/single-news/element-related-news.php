
<?php
$is_rel_show_news    = rhr_options( 'is_rel_show_news', '' );
$is_rel_date_show_news    = rhr_options( 'is_rel_date_show_news', '' );
$_title    = rhr_options( 'single_rel_title_news', '' );
$_title_limit    = rhr_options( 'single_rel_title_limit_news', '30' );
$_items    = rhr_options( 'single_rel_limit_news', '6' );
$_order    = rhr_options( 'single_rel_sortingorder_news', 'desc' );
$_order_by    = rhr_options( 'single_rel_orderby_news', 'date' );
if( true == $is_rel_show_news ) :
$id = get_the_ID();

$args = array(
    'post_type' => 'rhr_news',
    'order' => $_order,
    'orderby' => $_order_by,
    'posts_per_page' => $_items,
    'post__not_in' => array( $id ),
    'ignore_sticky_posts' => 1,
    'post_status' => 'publish',
);

$news_rel_q = new WP_Query( $args );
$count_post = $news_rel_q->found_posts;
$clsss_post = $count_post > 4 ? 'resources-gallery' : 'resources-gallery-rel';
if ( $news_rel_q->have_posts() ) :
?>
<div class="pages-content pc-gray">
        <div class="row justify-content-center">
            <div class="col col-10">
                <div class="resources <?php echo esc_attr($clsss_post);?>">
                    <?php if( !empty($_title) ) : ?>
                        <div class="r-caption"><?php echo esc_html($_title); ?></div>
                    <?php endif; ?>
                    <div class="items">
                    <?php while ( $news_rel_q->have_posts() ) : $news_rel_q->the_post();
                        $news_date = rhr_get_meta_value( get_the_id(), '_rhr_news_from' );
                    ?>
                        <a href="<?php the_permalink(); ?>" class="item" data-cursor="scale">
                            <div class="wrapper">
                                <?php
                                    $width = 288;
                                    $height = 300;

                                    $image_id = get_post_thumbnail_id();

                                    $img_attr = array(
                                        'image_id'    => $image_id,
                                        'image_tag'   => true,
                                        'placeholder' => true,
                                        'width'       => $width,
                                        'height'      => $height,
                                        'id'      => '',
                                        'class'      => '',
                                        'srcset'      => array(
                                            '1024' => array( $width, $height ),
                                            '991'  => array( 991, 460 ),
                                            '768'  => array( 768, 400 ),
                                            '480'  => array( 480, 360 ),
                                            '320'  => array( 320, 260 )
                                        )
                                    );
                                echo rhr_get_image( $img_attr );
                                ?>
                                <?php if( true == $is_rel_date_show_news ) : ?>
                                    <div class="infos">
                                        <span class="date"><?php echo get_the_time( get_option('date_format') ); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="r-title"><?php echo _shorten_text(get_the_title(), $_title_limit); ?></div>
                            </div>
                        </a>

                    <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                    <div class="rg-line">
                        <div class="rg-bar"></div>
                    </div>
                    <div class="rg-arrow a-left" data-cursor="left"></div>
                    <div class="rg-arrow a-right" data-cursor="right"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; endif;?>
