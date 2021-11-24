<?php
$desig = rhr_get_meta_value( get_the_id(), '_rhr_desig' );
$desig2 = rhr_get_meta_value( get_the_id(), '_rhr_desig2' );
$code_text = rhr_get_meta_value( get_the_id(), '_rhr_code' );
$bio = rhr_get_meta_value( get_the_id(), '_rhr_bio', '' );
$is_desig_show_team    = rhr_options( 'is_desig_show_team', '' );

?>
 <div class="main-content pages">
    <section>
        <div class="pages-content pc-about-team">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col col-1 c-initial">
                        <?php
                            $is_team_back = rhr_options( 'is_team_back', '' );
                            if( true == $is_team_back ) :
                        ?>
                        <a href="<?php echo rhr_inner_back_button('rhr_team_back');?>" data-cursor="scale" class="button b-back">
                            <div class="arrow svg"></div>
                            <span><?php echo esc_html__('Our Team' ,'rhr');?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col col-5">
                        <?php get_template_part( 'templates/single-teams/element', 'title' ); ?>
                        <?php
                                if( true == $is_desig_show_team):
                                if(isset($desig) && !empty($desig)):
                            ?>
                            <div class="description d-team">
                                <?php
                                echo esc_attr($desig);
                                 if(!empty($desig2)):
                                    echo esc_attr($desig2);
                                endif;
                                ?>
                        </div>
                        <?php endif; endif;?>
                    </div>
                    <div class="col col-4">
                        <?php get_template_part( 'templates/single-teams/element', 'image' );  ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="pages-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-5">
                        <?php if( !empty($bio) ) : ?>
                        <div class="paragraph p-bigger p-team-highlights">
                            <div class="triangle-line svg"></div><br>
                            <?php echo esc_html( the_title() ). ' ' .  html_entity_decode( $bio ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col col-5">
                        <div class="paragraph p-gray">
                        <?php get_template_part( 'templates/single-teams/element', 'content' ); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
