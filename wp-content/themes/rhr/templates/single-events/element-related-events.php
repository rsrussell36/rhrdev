
<?php
$is_rel_show_event    = rhr_options( 'is_rel_show_event', '' );
$is_rel_date_show_event    = rhr_options( 'is_rel_date_show_event', '' );
$_title    = rhr_options( 'single_rel_title_event', '' );
$_title_limit    = rhr_options( 'single_rel_title_limit_event', '30' );
$_items    = rhr_options( 'single_rel_limit_event', '6' );
$_order    = rhr_options( 'single_rel_sortingorder_event', 'desc' );
$_order_by    = rhr_options( 'single_rel_orderby_event', 'meta_value_num' );
if( true == $is_rel_show_event ) :
$id = get_the_ID();

$meta_quer_args = array(
    'relation'  =>   'AND',
    array(
        'key'       =>   '_rhr_end_from',
        'value'     =>   date("F j, Y", time()),
        'compare'   =>   '>='
    )
);

$post_args = array(
    'post_type' => 'rhr_events',
    'order' => $_order,
    'orderby' => $_order_by,
    'posts_per_page' => $_items,
    'post__not_in' => array( $id ),
    'ignore_sticky_posts' => 1,
    'post_status' => 'publish',
    'meta_key'    =>   '_rhr_start_from',
    'meta_query'  =>   $meta_quer_args
);
$select_date = rhr_options( 'single_rel_date_event', '' );
    if (!empty($select_date)) {
        $date_query = [];
        switch ($select_date) {
            case 'today':
                $date_query['after'] = '-1 day';
                break;
            case 'week':
                $date_query['after'] = '-1 week';
                break;
            case 'month':
                $date_query['after'] = '-1 month';
                break;
            case 'quarter':
                $date_query['after'] = '-3 month';
                break;
            case 'year':
                $date_query['after'] = '-1 year';
                break;
            case 'exact':
                $after_date = date_create(rhr_options( 'after_date', '' ));
                $after_current_date = date_format($after_date, "Y-m-d");
                if (!empty($after_date)) {
                    $date_query['after'] = $after_current_date;
                }
                $before_date = date_create(rhr_options( 'before_date', '' ));
                $before_current_date = date_format($before_date, "Y-m-d");
                if (!empty($before_date)) {
                    $date_query['before'] = $before_current_date;
                }
                $date_query['inclusive'] = true;
                break;
        }
        $query_by_date = array(
            'date_query' => $date_query
        );

        $post_args = wp_parse_args( $post_args, $query_by_date );
    }
$event_rel_q = new WP_Query( $post_args );
$count_post = $event_rel_q->found_posts;
$clsss_post = $count_post > 4 ? 'resources-gallery' : 'resources-gallery-rel';
if ( $event_rel_q->have_posts() ) :
?>
<div class="pages-content pc-gray">
    <div class="row justify-content-center">
        <div class="col col-10">
            <div class="resources <?php echo esc_attr($clsss_post);?>">
                <?php if( !empty($_title) ) : ?>
                    <div class="r-caption"><?php echo esc_html($_title); ?></div>
                <?php endif; ?>
                <div class="items">
                    <?php while ( $event_rel_q->have_posts() ) : $event_rel_q->the_post();
                    //$event_date = rhr_get_meta_value( get_the_id(), '_rhr_event_from' );
                    $event_from = rhr_get_meta_value( get_the_id(), '_rhr_start_from' );
                    $event_end = rhr_get_meta_value( get_the_id(), '_rhr_end_from' );
                    $e_end_date = !empty($event_end) ? ' - ' . $event_end : '';
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
                                <?php if( true == $is_rel_date_show_event ) : ?>
                                    <div class="infos">
                                        <span class="date"><?php echo esc_attr($event_from . $e_end_date); ?></span>
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
