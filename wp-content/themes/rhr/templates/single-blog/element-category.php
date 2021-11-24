<?php 
$category = get_the_category();
echo esc_html( $category[0]->cat_name );
?>