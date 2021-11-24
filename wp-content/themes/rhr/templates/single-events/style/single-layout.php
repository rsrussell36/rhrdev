<?php
$event_date = rhr_get_meta_value( get_the_id(), '_rhr_event_from' );
$event_btn = rhr_get_meta_value( get_the_id(), '_rhr_btn' );
$event_url = rhr_get_meta_value( get_the_id(), '_rhr_url' );
$event_new_tab = rhr_get_meta_value( get_the_id(), '_rhr_new_tab' );
?>
<div class="main-content pages">
    <section>
        <div class="pages-content pc-pages-inners pc-noPadidng">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-2">
                        <?php
                            $is_events_back = rhr_options( 'is_events_back', '' );
                            if( true == $is_events_back ) :
                        ?>
                        <a href="<?php echo rhr_inner_back_button('rhr_events_back');?>"  data-cursor="scale" class="button b-back">
                            <div class="arrow svg"></div>
                            <span><?php echo esc_html__('Back' ,'rhr');?></span>
                        </a>
                        <?php endif; ?>
                        <?php get_template_part( 'templates/single-events/element', 'share' ); ?>
                    </div>
                    <div class="col col-8">
                        <div class="pc-inner pc-inner-page">

                            <?php get_template_part( 'templates/single-events/element', 'title' ); ?>

                            <div class="boxinfo">
                            <?php get_template_part( 'templates/single-events/element', 'image' );  ?>
                                <div class="group-black">

                                        <div class="title t-white t-tinny">
                                            <?php echo get_the_time( get_option('date_format') ); ?>
                                        </div>
                                        <div class="bar" data-color="red"></div>
                                    <?php if(isset($event_btn) && !empty($event_btn)):
                                        $current_url = isset($event_url) && !empty($event_url) ? $event_url : '';
                                        $current_tab = isset($event_new_tab) && !empty($event_new_tab) && 'yes' == $event_new_tab ? '_blank' : '_self';

                                        ?>
                                        <a href="<?php echo esc_url($current_url); ?>" target="<?php echo esc_attr($current_tab); ?>" class="button b-white b-external" data-cursor="scale">
                                            <span><?php echo esc_html($event_btn); ?></span>
                                            <div class="arrow svg"></div>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="paragraph p-gray p-marginT">
                                <?php get_template_part( 'templates/single-events/element', 'content' ); ?>
                            </div>

                            <?php
                                get_template_part( 'templates/single-events/element', 'tag' );
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            get_template_part( 'templates/single-events/element', 'related-events' );
        ?>
    <section>
</div>
