<div class="main-content pages">
    <section>
        <div class="pages-content pc-noPadidng pc-pages-inners">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-2">
                        <?php
                            $is_blog_back = rhr_options( 'is_blog_back', '' );
                            if( true == $is_blog_back ) :
                        ?>
                        <a href="<?php echo rhr_inner_back_button('rhr_blog_back');?>" data-cursor="scale" class="button b-back">
                            <div class="arrow svg"></div>
                            <span><?php echo esc_html__('Our Blogs' ,'rhr');?></span>
                        </a>
                        <?php endif; ?>
                        <?php get_template_part( 'templates/single-blog/element', 'share' ); ?>
                    </div>
                    <div class="col col-8">
                        <div class="pc-inner-blog">

                            <?php get_template_part( 'templates/single-blog/element', 'title' ); ?>

                            <div class="description">
                                <?php
                                    get_template_part( 'templates/single-blog/element', 'date' );
                                ?>
                            </div>
                            <?php get_template_part( 'templates/single-blog/element', 'image' );  ?>
                            <div class="paragraph p-gray  p-marginT">
                                <?php get_template_part( 'templates/single-blog/element', 'content' );  ?>
                            </div>

                            <?php
                                get_template_part( 'templates/single-blog/element', 'tag' );
                                get_template_part( 'templates/single-blog/element', 'author-media' );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pages-content pc-gray">
            <div class="container-fluid">

                <?php
                    get_template_part( 'templates/single-blog/element', 'related-post' );
                    get_template_part( 'templates/single-blog/element', 'author-post' );
                ?>

            </div>
        </div>
    </section>
 </div>
