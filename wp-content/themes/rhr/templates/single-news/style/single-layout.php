<?php
$news_title = rhr_get_meta_value( get_the_id(), '_rhr_title' );
$news_date = rhr_get_meta_value( get_the_id(), '_rhr_news_from' );
$news_btn = rhr_get_meta_value( get_the_id(), '_rhr_btn' );
$news_url = rhr_get_meta_value( get_the_id(), '_rhr_url' );
$news_new_tab = rhr_get_meta_value( get_the_id(), '_rhr_new_tab' );
$news_show_box = rhr_get_meta_value( get_the_id(), '_rhr_show_box' );
?>
<div class="main-content pages">
    <section>
    <div class="pages-content pc-pages-inners pc-noPadidng">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-2">
                    <?php
                        $is_news_back = rhr_options( 'is_news_back', '' );
                        if( true == $is_news_back ) :
                    ?>
                    <a href="<?php echo rhr_inner_back_button('rhr_news_back');?>" data-cursor="scale" class="button b-back">
                        <div class="arrow svg"></div>
                        <span><?php echo esc_html__('Back' ,'rhr');?></span>
                    </a>
                    <?php endif; ?>
                    <?php get_template_part( 'templates/single-news/element', 'share' ); ?>
                </div>
                <div class="col col-8">
                    <div class="pc-inner pc-inner-page">

                        <?php get_template_part( 'templates/single-news/element', 'title' ); ?>
                        <div class="description">
                           <?php get_template_part( 'templates/single-news/element', 'date' ); ?>
                       </div>
                        <?php if( $news_show_box != 'no'  ) : ?>
                            <div class="boxinfo">
                                <?php get_template_part( 'templates/single-news/element', 'image' );  ?>
                                <div class="group-black">
                                    <?php if(isset($news_title) && !empty($news_title)): ?>
                                        <div class="title t-white t-tinny">
                                            <?php echo esc_attr($news_title); ?>
                                        </div>
                                        <div class="bar" data-color="red"></div>
                                    <?php endif; ?>
                                    <?php if(isset($news_btn) && !empty($news_btn)):
                                        $current_url = isset($news_url) && !empty($news_url) ? $news_url : '';
                                        $current_tab = isset($news_new_tab) && !empty($news_new_tab) && 'yes' == $news_new_tab ? '_blank' : '_self';

                                        ?>
                                        <a href="<?php echo esc_url($current_url); ?>" target="<?php echo esc_attr($current_tab); ?>" class="button b-white b-external" data-cursor="scale">
                                            <span><?php echo esc_html($news_btn); ?></span>
                                            <div class="arrow svg"></div>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="paragraph p-gray p-marginT">
                            <?php get_template_part( 'templates/single-news/element', 'content' ); ?>
                        </div>

                            <?php
                                get_template_part( 'templates/single-news/element', 'tag' );
                                get_template_part( 'templates/single-news/element', 'author-media' );
                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        get_template_part( 'templates/single-news/element', 'related-news' );
    ?>
    </section>
</div>
