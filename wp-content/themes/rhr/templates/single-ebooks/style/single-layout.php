<?php
$ebook_title = rhr_get_meta_value( get_the_id(), '_rhr_title' );
$ebook_btn = rhr_get_meta_value( get_the_id(), '_rhr_btn' );
$ebook_url = rhr_get_meta_value( get_the_id(), '_rhr_url' );
$ebook_new_tab = rhr_get_meta_value( get_the_id(), '_rhr_new_tab' );
$to_email_e  = rhr_options( 'to_email_e', '' );
$from_email_e  = rhr_options( 'from_email_e', '' );
$subject_e  = rhr_options( 'subject_e', '' );
$reply_msgprefix_e  = rhr_options( 'reply_msgprefix_e', '' );
$reply_msg_e  = rhr_options( 'reply_msg_e', '' );
$form_class_e  = rhr_options( 'form_class_e', '' );
$form_bgclass_e  = rhr_options( 'form_bgclass_e', '' );
$form_btn_e  = rhr_options( 'form_btn_e', '' );
$success_e  = rhr_options( 'success_e', '' );
$empty_e  = rhr_options( 'empty_e', '' );
$error_e  = rhr_options( 'error_e', '' );
$name_empty_e  = rhr_options( 'name_empty_e', '' );
$email_empty_e  = rhr_options( 'email_empty_e', '' );
$email_invalid_e  = rhr_options( 'email_invalid_e', '' );
$company_empty_e  = rhr_options( 'company_empty_e', '' );

$current_email = '';
$current_from_email = '';
$current_subject = '';
if(!empty($to_email_e)){
    $current_email = $to_email_e;
}else{
    $current_email = rhr_popup_email();
}
if(!empty($from_email_e)){
    $current_from_email = $from_email_e;
}else{
    $current_from_email = rhr_popup_from_email();
}
if(!empty($subject_e)){
    $current_subject = $subject_e;
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
                            $is_ebooks_back = rhr_options( 'is_ebooks_back', '' );
                            if( true == $is_ebooks_back ) :
                        ?>
                        <a href="<?php echo rhr_inner_back_button('rhr_ebooks_back');?>" data-cursor="scale" class="button b-back">
                            <div class="arrow svg"></div>
                            <span><?php echo esc_html__('Back' ,'rhr');?></span>
                        </a>
                        <?php endif; ?>
                        <?php get_template_part( 'templates/single-ebooks/element', 'share' ); ?>
                    </div>
                    <div class="col col-8">
                        <div class="pc-inner pc-inner-page">
                            <?php get_template_part( 'templates/single-ebooks/element', 'title' ); ?>

                            <div class="description">
                                <?php get_template_part( 'templates/single-ebooks/element', 'date' ); ?>
                            </div>
                            <div class="boxinfo">
                                <?php get_template_part( 'templates/single-ebooks/element', 'image' );  ?>
                                <div class="box-black">
                                    <?php if(isset($ebook_title) && !empty($ebook_title)): ?>
                                        <div class="title t-white t-tinny">
                                        <?php echo esc_html($ebook_title); ?>
                                        </div>
                                        <div class="bar" data-color="red"></div>
                                    <?php endif; ?>
                                    <?php if(isset($ebook_btn) && !empty($ebook_btn)):
                                        $current_url = isset($ebook_url) && !empty($ebook_url) ? $ebook_url : '';
                                        $current_tab = isset($ebook_new_tab) && !empty($ebook_new_tab) && 'yes' == $ebook_new_tab ? '_blank' : '_self';
                                        ?>
                                        <div class="download-popup gh-download">
                                        <div class="button b-white b-external page-btns b-download" data-cursor="scale">
                                        <span><?php echo esc_html($ebook_btn); ?></span>
                                            <div class="arrow svg"></div>
                                        </div>
                                        <?php echo do_shortcode('[rhr_download_form form_class="'.$form_class_e.'" button_class="'.$form_btn_e.'" data_color="'.$form_bgclass_e.'" data-to="'.$current_email.'" data-subject="'.$current_subject.'" data-reply="'.$current_from_email.'" data-msg="'.$reply_msg_e.'" data-msgprefix="'.$reply_msgprefix_e.'" data-success="'.$success_e.'" data-empty="'.$empty_e.'" data-error="'.$error_e.'" name_empty="'.$name_empty_e.'" email_empty="'.$email_empty_e.'" invalid_email="'.$email_invalid_e.'" company_empty="'.$company_empty_e.'" file="'.$current_url.'"]'); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="paragraph p-gray p-marginT">
                            <?php get_template_part( 'templates/single-ebooks/element', 'content' ); ?>
                            </div>
                            <?php
                                get_template_part( 'templates/single-ebooks/element', 'tag' );
                                get_template_part( 'templates/single-ebooks/element', 'author-media' );
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
