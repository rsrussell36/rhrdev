<?php 
    $is_featured_show_news    = rhr_options( 'is_featured_show_news', '' );
    if( true == $is_featured_show_news ) :

        $width = 432;
        $height = 433;
        
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
        ?>
        <div class="image">
            <?php echo rhr_get_image( $img_attr ); ?>
        </div>
<?php endif;?>