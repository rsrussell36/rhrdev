<?php
$research_title = rhr_get_meta_value( get_the_id(), '_rhr_title' );
$research_btn = rhr_get_meta_value( get_the_id(), '_rhr_btn' );
$research_url = rhr_get_meta_value( get_the_id(), '_rhr_download_file' );
$research_new_tab = rhr_get_meta_value( get_the_id(), '_rhr_new_tab' );
$featured_image = rhr_get_meta_value( get_the_id(), '_rhr_featured_image' );
$to_email_r  = rhr_options( 'to_email_r', '' );
$from_email_r  = rhr_options( 'from_email_r', '' );
$subject_r  = rhr_options( 'subject_r', '' );
$reply_msgprefix_r  = rhr_options( 'reply_msgprefix_r', '' );
$reply_msg_r  = rhr_options( 'reply_msg_r', '' );
$form_class_r  = rhr_options( 'form_class_r', '' );
$form_bgclass_r  = rhr_options( 'form_bgclass_r', '' );
$form_btn_r  = rhr_options( 'form_btn_r', '' );
$success_r  = rhr_options( 'success_r', '' );
$empty_r  = rhr_options( 'empty_r', '' );
$error_r  = rhr_options( 'error_r', '' );
$name_empty_r  = rhr_options( 'name_empty_r', '' );
$email_empty_r  = rhr_options( 'email_empty_r', '' );
$email_invalid_r  = rhr_options( 'email_invalid_r', '' );
$company_empty_r  = rhr_options( 'company_empty_r', '' );
$current_email = '';
$current_from_email = '';
$current_subject = '';
if(!empty($to_email_r)){
    $current_email = $to_email_r;
}else{
    $current_email = rhr_popup_email();
}
if(!empty($from_email_r)){
    $current_from_email = $from_email_r;
}else{
    $current_from_email = rhr_popup_from_email();
}
if(!empty($subject_r)){
    $current_subject = $subject_r;
}else{
    $current_subject = rhr_popup_subject();
}
?>
<div class="main-content pages">
    <section>
        <div class="pages-content pc-pages-inners pc-noPadidng">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-2">
                        <?php
                            $is_research_back = rhr_options( 'is_research_back', '' );
                            if( true == $is_research_back ) :
                        ?>
                        <a href="<?php echo rhr_inner_back_button('rhr_research_back');?>" data-cursor="scale" class="button b-back">
                            <div class="arrow svg"></div>
                            <span><?php echo esc_html__('Back' ,'rhr');?></span>
                        </a>
                        <?php endif; ?>
                        <?php get_template_part( 'templates/single-research/element', 'share' ); ?>
                    </div>
                    <div class="col col-8">
                        <div class="pc-inner pc-inner-page">

                            <?php get_template_part( 'templates/single-research/element', 'title' ); ?>

                            <div class="boxinfo">
                            <?php
                                if(isset($featured_image) && $featured_image != 'hide'){
                                    get_template_part( 'templates/single-research/element', 'image' );
                                }
                            ?>
                                <div class="box-black">
                                    <?php if(isset($research_title) && !empty($research_title)): ?>
                                        <div class="title t-white t-tinny">
                                            <?php echo esc_attr($research_title); ?>
                                        </div>
                                        <div class="bar" data-color="red"></div>
                                    <?php endif; ?>
                                    <?php if(isset($research_btn) && !empty($research_btn)):
                                        $clcs_r_url_json = !empty( $research_url ) ? json_decode( $research_url ) : '';
                                        $current_pdf = $clcs_r_url_json[0]->full;

                                        $current_tab = isset($research_new_tab) && !empty($research_new_tab) && 'yes' == $research_new_tab ? '_blank' : '_self';

                                        ?>

                                        <div class="download-popup gh-download">
                                        <div class="button b-white b-external page-btns b-download" data-cursor="scale">
                                        <span><?php echo esc_html($research_btn); ?></span>
                                            <div class="arrow svg"></div>
                                        </div>
                                        <?php echo do_shortcode('[rhr_download_form form_class="'.$form_class_r.'" button_class="'.$form_btn_r.'" data_color="'.$form_bgclass_r.'" data-to="'.$current_email.'" data-subject="'.$current_subject.'" data-reply="'.$current_from_email.'" data-msg="'.$reply_msg_r.'" data-msgprefix="'.$reply_msgprefix_r.'" data-success="'.$success_r.'" data-empty="'.$empty_r.'" data-error="'.$error_r.'" name_empty="'.$name_empty_r.'" email_empty="'.$email_empty_r.'" invalid_email="'.$email_invalid_r.'" company_empty="'.$company_empty_r.'" file="'.$current_pdf.'"]'); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="paragraph p-gray p-marginT">
                                <?php get_template_part( 'templates/single-research/element', 'content' ); ?>
                            </div>

                            <?php
                                get_template_part( 'templates/single-research/element', 'tag' );
                                get_template_part( 'templates/single-research/element', 'author-media' );
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            get_template_part( 'templates/single-research/element', 'related-research' );
        ?>
    <section>
</div>
