
<?php
$is_rel_show_research    = rhr_options( 'is_rel_show_research', '' );
$is_rel_date_show_research    = rhr_options( 'is_rel_date_show_research', '' );
$_title    = rhr_options( 'single_rel_title_research', '' );
$_title_limit    = rhr_options( 'single_rel_title_limit_research', '30' );
$_items    = rhr_options( 'single_rel_limit_research', '6' );
$_order    = rhr_options( 'single_rel_sortingorder_research', 'desc' );
$_order_by    = rhr_options( 'single_rel_orderby_research', 'date' );

if( true == $is_rel_show_research ) :
$id = get_the_ID();

$category = get_the_terms( $id , 'rhr_research_categories' );


if( !empty( $category ) ) :

    foreach ( $category as $cat ) :
        $slug[] = $cat->slug;
    endforeach;

    $slug_string = implode( ', ', $slug );

endif;
$post_author_id = rhr_get_meta_value( $id, 'profile_auth_m_r', '' );
$args = array(
    'post_type' => 'rhr_research',
    'order' => $_order,
    'orderby' => $_order_by,
    'posts_per_page' => $_items,
    'post__not_in' => array( $id ),
    'ignore_sticky_posts' => 1,
    'post_status' => 'publish',
    'meta_query'             => array(
        array(
            //'key'       => 'profile_auth_m_r',
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
            'taxonomy' => 'rhr_research_categories',
            'field' => 'slug',
            'terms' => $slug
        ),
    )
);

$research_rel_q = new WP_Query( $args );
$count_post = $research_rel_q->found_posts;
$clsss_post = $count_post > 4 ? 'resources-gallery' : 'resources-gallery-rel';
if ( $research_rel_q->have_posts() ) :
?>
<div class="pages-content pc-gray">
    <div class="row justify-content-center">
        <div class="col col-10">
            <div class="resources <?php echo esc_attr($clsss_post);?>">
                <?php if( !empty($_title) ) : ?>
                    <div class="r-caption"><?php echo esc_html($_title); ?></div>
                <?php endif; ?>
                <div class="items i-research">
                    <?php while ( $research_rel_q->have_posts() ) : $research_rel_q->the_post();
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
                                <?php if( true == $is_rel_date_show_research ) : ?>
                                    <div class="date"><?php echo get_the_time( get_option('date_format') ); ?></div>
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
