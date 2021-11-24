<?php get_header();
$is_404_show    = rhr_options( 'is_404_show', '' );
$rhr_404_text    = rhr_options( 'rhr_404_error_text', '' );
$rhr_404_btn_text    = rhr_options( 'rhr_404_btn_text', '' );
$rhr_404_url    = rhr_options( 'rhr_404_url', '' );
?>
	<div class="main-content">

      <section>

        <div class="pages-content pc-noPadidng">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-10">
                        <div class="not-found">
							<?php if( !empty( $rhr_404_text )): ?>
                            <h1 class="title">
                              <?php echo  html_entity_decode( $rhr_404_text ); ?>
                            </h1>
							<?php endif; ?>
							<?php if( !empty($rhr_404_btn_text) ) : ?>
								<a href="<?php echo esc_url( $rhr_404_url ); ?>" class="button" data-cursor="scale">
								<span><?php echo esc_html( $rhr_404_btn_text ) ?></span>
								<div class="arrow svg"></div>
								</a>
							<?php endif; ?>
							<?php if( !empty( $is_404_show ) ) : ?>
								<div class="logo-line svg"></div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </section>

    </div>
<?php
get_footer();
