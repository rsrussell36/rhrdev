<?php
$webinar_title = rhr_get_meta_value( get_the_id(), '_rhr_title' );
$webinar_btn = rhr_get_meta_value( get_the_id(), '_rhr_btn' );
$webinar_url = rhr_get_meta_value( get_the_id(), '_rhr_url' );
$webinar_new_tab = rhr_get_meta_value( get_the_id(), '_rhr_new_tab' );
$webinar_show_box = rhr_get_meta_value( get_the_id(), '_rhr_show_box' );
?>
<div class="main-content pages">
    <section>
    <div class="pages-content pc-pages-inners pc-noPadidng">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-2">
                        <?php
                            $is_webinar_back = rhr_options( 'is_webinar_back', '' );
                            if( true == $is_webinar_back ) :
                        ?>
                        <a href="<?php echo rhr_inner_back_button('rhr_webinar_back');?>" data-cursor="scale" class="button b-back">
                            <div class="arrow svg"></div>
                            <span><?php echo esc_html__('Back' ,'rhr');?></span>
                        </a>
                        <?php endif; ?>
                        <?php get_template_part( 'templates/single-webinar/element', 'share' ); ?>
                </div>
                <div class="col col-8">
                    <div class="pc-inner pc-inner-page">

                        <?php
                            get_template_part( 'templates/single-webinar/element', 'title' );
                            get_template_part( 'templates/single-webinar/element', 'date' );
                        ?>

                        <div class="boxinfo">
                            <?php get_template_part( 'templates/single-webinar/element', 'image' );  ?>
                            <?php if( $webinar_show_box != 'no'  ) : ?>
                            <div class="group-black">
                            <?php if(isset($webinar_title) && !empty($webinar_title)): ?>
                                <div class="title t-white t-tinny">
                                <?php echo esc_html($webinar_title); ?>
                                </div>
                                <div class="bar" data-color="red"></div>
                            <?php endif; ?>
                            <?php if(isset($webinar_btn) && !empty($webinar_btn)):
                                $current_url = isset($webinar_url) && !empty($webinar_url) ? $webinar_url : '';
                                $current_tab = isset($webinar_new_tab) && !empty($webinar_new_tab) && 'yes' == $webinar_new_tab ? '_blank' : '_self';

                                ?>
                                <a href="<?php echo esc_url($current_url); ?>" target="<?php echo esc_attr($current_tab); ?>" class="button b-white b-play" data-cursor="scale">
                                    <span><?php echo esc_html($webinar_btn); ?></span>
                                    <div class="play svg"></div>
                                </a>
                            <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="paragraph p-gray p-marginT">
                            <?php get_template_part( 'templates/single-webinar/element', 'content' ); ?>
                        </div>

                        <?php
                            get_template_part( 'templates/single-webinar/element', 'tag' );
                            get_template_part( 'templates/single-webinar/element', 'author-media' );
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
