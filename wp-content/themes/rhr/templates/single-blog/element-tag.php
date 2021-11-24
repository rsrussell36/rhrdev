<?php 
$is_tag_show    = rhr_options( 'is_tag_show', '' );
$is_tag_show_cat_tag    = rhr_options( 'is_tag_show_cat_tag', 'category' );
if( true == $is_tag_show){
  if($is_tag_show_cat_tag == 'category'){
    ?>
    <div class="tags">
        <?php 
        $postcats = rhr_get_multiple_category('post');
        if ($postcats) {
          foreach($postcats as $cat) {?>
            <a href="<?php echo get_category_link($cat->term_id);?>" data-cursor="scale" class="tag"> <?php echo $cat->name . ' ';  ?></a>
         <?php }
        }
        ?>
    </div>
  <?php }else{ ?>
    <div class="tags">
        <?php 
        $posttags = get_the_tags();
        if ($posttags) {
          foreach($posttags as $tag) {?>
            <a href="<?php echo get_tag_link($tag->term_id);?>" data-cursor="scale" class="tag"> <?php echo $tag->name . ' ';  ?></a>
         <?php }
        }
        ?>
    </div>
  <?php }
}