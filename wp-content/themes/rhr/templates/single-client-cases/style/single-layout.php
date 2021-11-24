<?php
$clcs_s_logo = rhr_get_meta_value( get_the_id(), '_rhr_s_logo' );
$logo = !empty( $clcs_s_logo ) ? json_decode( $clcs_s_logo ) : '';
$current_logo = !empty($logo) ? wp_get_attachment_image_url( $logo[0]->itemId, 'clients_cases_logo' ) : '';
$clcs_c_title = rhr_get_meta_value( get_the_id(), '_rhr_c_title' );
$clcs_c__sub_title = rhr_get_meta_value( get_the_id(), '_rhr_c__sub_title' );
$clcs_c_description = rhr_get_meta_value( get_the_id(), '_rhr_c_description' );
$clcs_s_title = rhr_get_meta_value( get_the_id(), '_rhr_s_title' );
$clcs_s_description = rhr_get_meta_value( get_the_id(), '_rhr_s_description' );
$clcs_s_re_title_one = rhr_get_meta_value( get_the_id(), '_rhr_s_re_title_one' );
$clcs_s_re_desc_one = rhr_get_meta_value( get_the_id(), '_rhr_s_re_desc_one' );
$clcs_s_re_icon_one = rhr_get_meta_value( get_the_id(), '_rhr_s_re_icon_one' );
$s_re_icon_one = !empty( $clcs_s_re_icon_one ) ? json_decode( $clcs_s_re_icon_one ) : '';
$s_logo_one = !empty($s_re_icon_one) ? wp_get_attachment_image_url( $s_re_icon_one[0]->itemId, '' ) : '';

$clcs_s_re_title_two = rhr_get_meta_value( get_the_id(), '_rhr_s_re_title_two' );
$clcs_s_re_desc_two = rhr_get_meta_value( get_the_id(), '_rhr_s_re_desc_two' );
$clcs_s_re_icon_two = rhr_get_meta_value( get_the_id(), '_rhr_s_re_icon_two' );
$s_re_icon_two = !empty( $clcs_s_re_icon_two ) ? json_decode( $clcs_s_re_icon_two ) : '';
$s_logo_two = !empty($s_re_icon_two) ? wp_get_attachment_image_url( $s_re_icon_two[0]->itemId, '' ) : '';

$clcs_s_re_title_three = rhr_get_meta_value( get_the_id(), '_rhr_s_re_title_three' );
$clcs_s_re_desc_three = rhr_get_meta_value( get_the_id(), '_rhr_s_re_desc_three' );
$clcs_s_re_icon_three = rhr_get_meta_value( get_the_id(), '_rhr_s_re_icon_three' );
$s_re_icon_three = !empty( $clcs_s_re_icon_three ) ? json_decode( $clcs_s_re_icon_three ) : '';
$s_logo_three = !empty($s_re_icon_three) ? wp_get_attachment_image_url( $s_re_icon_three[0]->itemId, '' ) : '';


$clcs_r_title = rhr_get_meta_value( get_the_id(), '_rhr_r_title' );
$clcs_r_number_one = rhr_get_meta_value( get_the_id(), '_rhr_r_number_one' );
$clcs_r_number_title_one = rhr_get_meta_value( get_the_id(), '_rhr_r_number_title_one' );

$clcs_r_number_two = rhr_get_meta_value( get_the_id(), '_rhr_r_number_two' );
$clcs_r_number_title_two = rhr_get_meta_value( get_the_id(), '_rhr_r_number_title_two' );

$clcs_r_number_three = rhr_get_meta_value( get_the_id(), '_rhr_r_number_three' );
$clcs_r_number_title_three = rhr_get_meta_value( get_the_id(), '_rhr_r_number_title_three' );

$clcs_r_text = rhr_get_meta_value( get_the_id(), '_rhr_r_text' );

$clcs_r_bx_title = rhr_get_meta_value( get_the_id(), '_rhr_r_bx_title' );
$clcs_r_btn = rhr_get_meta_value( get_the_id(), '_rhr_r_btn' );
$clcs_r_url = rhr_get_meta_value( get_the_id(), '_rhr_r_download_file' );


$clcs_r_new_tab = rhr_get_meta_value( get_the_id(), '_rhr_r_new_tab' );

?>
<div class="main-content pages">
    <section>
        <?php
            $is_client_cases_stories_back = rhr_options( 'is_client_cases_stories_back', '' );
            if( true == $is_client_cases_stories_back ) :
        ?>
        <div class="pages-content pc-noPadidng">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-10">
                        <div class="breadcrumbs">
                            <a href="<?php echo rhr_inner_back_button('rhr_client_cases_stories_back');?>"><?php echo esc_html__('Client Stories', 'rhr');?></a> / <a href="<?php echo rhr_inner_back_button('rhr_client_cases_stories_last_back');?>"><?php echo esc_html__('Case Studies', 'rhr');?></a> / <span><?php the_title(); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="pages-content pc-noPadidng">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-5">
                        <?php get_template_part( 'templates/single-client-cases/element', 'title' ); ?>
                    </div>
                    <div class="col col-5">
                        <?php if(!empty($clcs_s_logo)) : ?>
                            <div class="logo">
                                <img class="svg" src="<?php echo esc_url($current_logo);?>" alt="<?php echo get_post_meta( $logo[0]->itemId, '_wp_attachment_image_alt', true); ?>"/>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>

        <div class="pages-content pc-paddingTop">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-10">
                        <?php get_template_part( 'templates/single-client-cases/element', 'image' );  ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="pages-content pc-paddingTop">
            <div class="container-fluid">
                <div class="row justify-content-center align-top">
                    <div class="col col-2 sidenav-wrap service-terms">
                        <div class="menu-navigate">
                            <div class="items">
                                <a href="#challenge" class="item scroll_menu_item client-cases-menu active" data-cursor="scale"><?php echo esc_html__('Challenge', 'rhr');?></a>
                                <a href="#solution" class="item scroll_menu_item client-cases-menu" data-cursor="scale"><?php echo esc_html__('Solution', 'rhr');?></a>
                                <a href="#results" class="item scroll_menu_item client-cases-menu" data-cursor="scale"><?php echo esc_html__('Results', 'rhr');?></a>
                            </div>
                        </div>
                        <div class="line">
                                <div class="l-bar"></div>
                            </div>
                    </div>
                    <div class="col col-8">
                      <div class="pc-inner subtitle-bottom">
                            <div class="pc-left"></div>
                            <div class="pc-right">
                                <?php if(!empty($clcs_c__sub_title)): ?>
                                    <div class="paragraph p-gray">
                                        <?php echo html_entity_decode($clcs_c__sub_title); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="pc-inner pc_section client-cases-section" id="challenge">
                            <div class="pc-left">
                                <div class="caption c-light">
                                    <span><?php echo esc_html__('Challenge', 'rhr');?></span>
                                </div>
                            </div>
                            <div class="pc-right">

                            <?php if(!empty($clcs_c_title)): ?>
                                <div class="paragraph p-gray">
                                    <?php echo html_entity_decode($clcs_c_title); ?>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($clcs_c_description)): ?>
                                <div class="paragraph p-small p-gray p-marginT">
                                    <?php echo html_entity_decode($clcs_c_description); ?>
                                </div>
                            <?php endif; ?>

                            </div>
                        </div>
                        <div class="pc-inner pc_section client-cases-section" id="solution">
                            <div class="pc-left">
                                <div class="caption c-light">
                                    <span><?php echo esc_html__('Solution', 'rhr');?></span>
                                </div>
                            </div>
                            <div class="pc-right">
                                <?php if(!empty($clcs_s_title)): ?>
                                    <div class="paragraph p-gray">
                                        <?php echo html_entity_decode($clcs_s_title); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($clcs_s_description)): ?>
                                    <div class="paragraph p-small p-gray p-marginT">
                                        <?php echo html_entity_decode($clcs_s_description); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($clcs_s_re_icon_one) || !empty($clcs_s_re_title_one) || !empty($clcs_s_re_desc_one)) : ?>
                                    <div class="group-texts gt-ico gt-marginT">

                                        <?php if(!empty($clcs_s_re_icon_one)) : ?>
                                            <div class="ico">
                                                <div class="svg" style="background:url(<?php echo esc_url($s_logo_one);?>);"></div>
                                            </div>
                                        <?php endif;?>
                                        <div class="texts">
                                            <?php if(!empty($clcs_s_re_title_one)): ?>
                                                <span><?php echo html_entity_decode($clcs_s_re_title_one); ?></span>
                                            <?php endif; ?>

                                            <?php if(!empty($clcs_s_re_desc_one)): ?>
                                                <div class="paragraph p-small p-gray">
                                                    <?php echo html_entity_decode($clcs_s_re_desc_one); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($clcs_s_re_icon_two) || !empty($clcs_s_re_title_two) || !empty($clcs_s_re_desc_two)) : ?>
                                    <div class="group-texts gt-ico">
                                        <?php if(!empty($clcs_s_re_icon_two)) : ?>
                                            <div class="ico">
                                                <div class="svg" style="background:url(<?php echo esc_url($s_logo_two);?>);"></div>
                                            </div>
                                        <?php endif;?>
                                        <div class="texts">
                                        <?php if(!empty($clcs_s_re_title_two)): ?>
                                                <span><?php echo html_entity_decode($clcs_s_re_title_two); ?></span>
                                            <?php endif; ?>

                                            <?php if(!empty($clcs_s_re_desc_two)): ?>
                                                <div class="paragraph p-small p-gray">
                                                    <?php echo html_entity_decode($clcs_s_re_desc_two); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($clcs_s_re_icon_three) || !empty($clcs_s_re_title_three) || !empty($clcs_s_re_desc_three)) : ?>
                                    <div class="group-texts gt-ico">
                                        <?php if(!empty($clcs_s_re_icon_three)) : ?>
                                            <div class="ico">
                                                <div class="svg" style="background:url(<?php echo esc_url($s_logo_three);?>);"></div>
                                            </div>
                                        <?php endif;?>
                                        <div class="texts">
                                        <?php if(!empty($clcs_s_re_title_three)): ?>
                                                <span><?php echo html_entity_decode($clcs_s_re_title_three); ?></span>
                                            <?php endif; ?>

                                            <?php if(!empty($clcs_s_re_desc_three)): ?>
                                                <div class="paragraph p-small p-gray">
                                                    <?php echo html_entity_decode($clcs_s_re_desc_three); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="pc-inner pc_section client-cases-section" id="results">
                            <div class="pc-left">
                                <div class="caption c-light">
                                    <span><?php echo esc_html__('Results', 'rhr');?></span>
                                </div>
                            </div>
                            <div class="pc-right">

                                <?php if(!empty($clcs_r_title)): ?>
                                    <div class="paragraph p-gray">
                                        <?php echo html_entity_decode($clcs_r_title);?>
                                    </div>
                                <?php endif; ?>
                                <div class="chart c-intern" data-color="red">
                                    <?php if(!empty($clcs_r_number_one)): ?>
                                        <div class="numbers" data-count="<?php echo esc_attr($clcs_r_number_one);?>">
                                            <span class="number"><?php echo esc_attr($clcs_r_number_one);?></span><span>%</span>
                                            <?php if(!empty($clcs_r_number_title_one)): ?>
                                                <div class="label">
                                                    <?php echo html_entity_decode($clcs_r_number_title_one);?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($clcs_r_number_two)): ?>
                                    <div class="numbers" data-count="<?php echo esc_attr($clcs_r_number_two);?>">
                                        <span class="number"><?php echo esc_attr($clcs_r_number_two);?></span><span>%</span>
                                        <?php if(!empty($clcs_r_number_title_two)): ?>
                                            <div class="label">
                                                <?php echo html_entity_decode($clcs_r_number_title_two);?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty($clcs_r_number_three)): ?>
                                    <div class="numbers" data-count="<?php echo esc_attr($clcs_r_number_three);?>">
                                        <span class="number"><?php echo esc_attr($clcs_r_number_three);?></span><span>%</span>
                                        <?php if(!empty($clcs_r_number_title_three)): ?>
                                            <div class="label">
                                                <?php echo html_entity_decode($clcs_r_number_title_three);?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($clcs_r_text)): ?>
                                    <div class="paragraph p-small p-gray">
                                        <?php echo html_entity_decode($clcs_r_text);?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(!empty($clcs_r_bx_title)): ?>
                        <div class="pc-inner">
                            <div class="group-black gb-solutions gb-download black-download case-study-black">
                            <div class="rhr-download-message"></div>
                                    <?php if(isset($clcs_r_bx_title) && !empty($clcs_r_bx_title)): ?>
                                        <div class="title t-white t-tinny">
                                            <?php echo esc_attr($clcs_r_bx_title); ?>
                                        </div>
                                        <div class="bar" data-color="red"></div>
                                    <?php endif; ?>
                                    <?php if(isset($clcs_r_btn) && !empty($clcs_r_btn)):
                                        $current_pdf = '';
                                        if(!empty($clcs_r_url)){
                                            $clcs_r_url_json = !empty( $clcs_r_url ) ? json_decode( $clcs_r_url ) : '';
                                            $current_pdf = $clcs_r_url_json[0]->full;
                                        }
                                        $current_tab = isset($clcs_r_new_tab) && !empty($clcs_r_new_tab) && 'yes' == $clcs_r_new_tab ? '_blank' : '_self';

                                        ?>
                                        <a href="<?php echo esc_url($current_pdf); ?>" target="<?php echo esc_attr($current_tab); ?>" class="button b-white b-download case-studies-download-pdf" data-cursor="scale" download>
                                            <span><?php echo html_entity_decode($clcs_r_btn); ?></span>
                                            <div class="arrow svg"></div>
                                        </a>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
