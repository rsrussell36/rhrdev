<?php
global $post;

$is_author_media_show_ebook    = rhr_options( 'is_author_media_show_ebook', '' );
$id = get_the_ID();
$post_profile_id = rhr_get_meta_value( $id, '_rhr_profile_auth_m_eb', '' );

if( true == $is_author_media_show_ebook ) :
    if( !empty($post_profile_id) ) :
$args = array(
    'post_type' => 'rhr_teams',
    'posts_per_page' => -1,
    'post__in' => $post_profile_id,
    'ignore_sticky_posts' => 1,
    'post_status' => 'publish',
);

$auth_media_q = new WP_Query( $args );
if ( $auth_media_q->have_posts() ) :
?>
    <div class="authors">
    <?php while ( $auth_media_q->have_posts() ) : $auth_media_q->the_post();
    $bio = rhr_get_meta_value( $id, '_rhr_bio', '' );
    ?>
        <div class="item">
        <?php
                $width = 144;
                $height = 144;

                $image_id = get_post_thumbnail_id();
                $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                $img_attr = array(
                    'image_id'    => $image_id,
                    'image_tag'   => false,
                    'placeholder' => true,
                );
            $current_img_url = rhr_get_profile_image( $img_attr );
            ?>
             <?php if( !empty($current_img_url) ) : ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" data-cursor="scale">
                    <img src="<?php echo esc_url( $current_img_url ); ?>" alt="<?php echo $alt; ?>">
                </a>
            <?php else:
                $rhr_default_thumb = rhr_options( 'rhr_profile_default_thumb', '' );
                ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>" data-cursor="scale">
                    <img src="<?php echo esc_url( $rhr_default_thumb['url'] ); ?>" alt="profile">
                </a>
            <?php endif; ?>
            <div class="paragraph p-gray p-small">
                <a href="<?php esc_url(the_permalink());?>" data-cursor="scale" class="rhr-profile-links"><strong><?php echo esc_html( the_title() ); ?></strong></a> <?php echo html_entity_decode( $bio ); ?>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
