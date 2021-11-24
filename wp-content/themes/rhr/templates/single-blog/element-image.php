<?php 

$width = 956;
$height = 550;
$image_id = get_post_thumbnail_id();

		$img_attr = array(
	        'image_id'    => $image_id,
	        'image_tag'   => true,
	        'placeholder' => true,
	        'width'       => $width,
	        'height'      => $height,
	        'srcset'      => array(
	            '1024' => array( $width, $height ),
	            '991'  => array( 991, 460 ),
	            '768'  => array( 768, 400 ),
	            '480'  => array( 480, 360 ),
	            '320'  => array( 320, 260 )
	        )
	    );

$is_featured_show    = rhr_options( 'is_featured_show', '' );
if( true == $is_featured_show ) : ?>
	<div class="image i-blog-hero">
		<?php echo rhr_get_image( $img_attr ); ?>
	</div>
<?php endif;?>