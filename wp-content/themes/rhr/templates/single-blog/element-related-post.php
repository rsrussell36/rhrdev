
<?php
$is_rel_show    = rhr_options( 'is_rel_show', '' );
$_title    = rhr_options( 'single_rel_title', '' );
$_title_limit    = rhr_options( 'single_rel_title_limit', '30' );
$_items    = rhr_options( 'single_rel_limit', '6' );
$_order    = rhr_options( 'single_rel_sortingorder', 'desc' );
$_order_by    = rhr_options( 'single_rel_orderby', 'date' );
if( true == $is_rel_show ) :
$id = get_the_ID();
$category = get_the_category();

if( !empty( $category ) ) :

    foreach ( $category as $key => $cat ) :
        $slug[] = $cat->slug;
    endforeach;

    $slug_string = implode( ', ', $slug );

endif;

$post_author_id = rhr_get_meta_value( $id, '_rhr_profile_auth_m', '' );
$args = array(
    'post_type' => 'post',
    'order' => $_order,
    'orderby' => $_order_by,
    'posts_per_page' => $_items,
    'post__not_in' => array( $id ),
    'ignore_sticky_posts' => 1,
    'post_status' => 'publish',
    'meta_query'             => array(
        array(
            //'key'       => '_rhr_profile_auth_m',
            'value'     => $post_author_id,
            'compare' => 'IN',
        ),
    ),
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array( 'post-format-quote', 'post-format-link' ),
            'operator' => 'NOT IN'
        ),
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $slug
        ),
    )
);

$q = new WP_Query( $args );
$count_post = $q->found_posts;
$clsss_post = $count_post > 4 ? 'resources-gallery' : 'resources-gallery-rel';
if ( $q->have_posts() ) :
?>
<div class="row justify-content-center">
    <div class="col col-10">
        <div class="resources blog-resources <?php echo esc_attr($clsss_post);?>">
            <?php if( !empty($_title) ) : ?>
                <div class="r-caption"><?php echo esc_html($_title); ?></div>
            <?php endif; ?>
            <div class="items">
                <?php while ( $q->have_posts() ) : $q->the_post(); ?>
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
                        <div class="infos">
                            <span class="type"><?php get_template_part( 'templates/single-blog/element', 'category' ); ?></span>
                            <span class="time"><?php echo rhr_time_ago(get_the_time( get_option('date_format') )); ?></span>
                        </div>
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
<?php endif; endif;?>
