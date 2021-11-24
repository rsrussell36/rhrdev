<footer class="footer ">

<div class="button b-white b-backUp" data-cursor="scale">
  <span><?php echo esc_html('BACK TO TOP'); ?></span>
  <div class="arrow svg"></div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col col-10">
    <?php
      $is_f_logo_show = rhr_options('is_f_logo_show', '');
      if (true == $is_f_logo_show):
        $f_logo_url = rhr_options('f_logo_url', home_url( '/' ));
    ?>
      <a href="<?php echo esc_url($f_logo_url); ?>" class="logo" data-cursor="scale">
        <div class="svg"></div>
      </a>
      <?php endif; ?>
      <?php
        $is_f_btn_show = rhr_options('is_f_btn_show', '');
        if (true == $is_f_btn_show):
          $f_btn_text = rhr_options('f_btn_text', 'Get In Touch');
          $f_btn_url = rhr_options('f_btn_url', home_url( '/' ));
      ?>
        <a href="<?php echo esc_url($f_btn_url); ?>" class="getTouch" data-cursor="scale-dark">
          <span><?php echo esc_html__($f_btn_text, 'rhr'); ?></span>
          <div class="over">
            <span><?php echo esc_html__($f_btn_text, 'rhr'); ?></span>
          </div>
        </a>
      <?php endif; ?>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col col-10">

        <?php
          if( is_active_sidebar( 'f-f-sidebar' ) ) {
            dynamic_sidebar( 'f-f-sidebar' );
          }
        ?>
      <?php get_template_part( 'templates/element', 'subscriber' ); ?>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col col-10">
      <?php
          if( is_active_sidebar( 's-f-sidebar' ) ) {
            dynamic_sidebar( 's-f-sidebar' );
          }
        ?>
        <div class="mobile-subscriber">
        <?php get_template_part( 'templates/element', 'subscriber' ); ?>
        </div>
      <div class="group g-full">
        <?php
          $is_footer_des_show = rhr_options('is_footer_des_show', '');
          if (true == $is_footer_des_show):
            $footer_desc = rhr_options('footer_desc', 'RHR, RHR International, The Winning Formula, Executive Bench, Readiness for Scale, and Scaling for Growth are service marks owned and/or registered by RHR International LLP. All logos and client trademarks are the property of their respective trademark owners.');
        ?>
            <div class="disclaimer">
              <?php echo $footer_desc; ?>
            </div>
        <?php endif; ?>
      </div>
    </div>

  </div>

  <div class="row justify-content-center">
    <div class="col col-10">
      <div class="contents border-none-mobile">
        <?php
        $current_code_footer = rhr_get_country_code();
          if($current_code_footer->geoplugin_countryCode == 'GB'){
            if( is_active_sidebar( 'copyright-f-sidebar-uk' ) ) {
              dynamic_sidebar( 'copyright-f-sidebar-uk' );
            }
          }else{
            if($current_code_footer->geoplugin_continentCode == 'EU'){
              if( is_active_sidebar( 'copyright-f-sidebar-eu' ) ) {
                dynamic_sidebar( 'copyright-f-sidebar-eu' );
              }
            }else{
              if( is_active_sidebar( 'copyright-f-sidebar' ) ) {
                dynamic_sidebar( 'copyright-f-sidebar' );
              }
            }
          }

          $is_show_social = rhr_options('is_show_social', '');
          $is_show_social_f = rhr_options('is_show_social_f', '');
          if(true == $is_show_social) {
            if(true == $is_show_social_f) {
              echo rhr_social_icons();
            }
          }
        ?>

      </div>
      <?php
        $is_footer_copy_show = rhr_options('is_footer_copy_show', '');
        if (true == $is_footer_copy_show):
          $footer_copy = rhr_options('footer_copy', '© 2021 RHR International LLP.');
      ?>
        <div class="contents c-legals">
          <div class="bottom">
            <div class="text"><?php echo $footer_copy; ?></div>
          </div>
        </div>
        <?php endif; ?>
    </div>
  </div>

</div>
</footer>
<div id="cursor" class="cursor">
<div class="pointer"></div>
<div class="icos">
  <div class="ico i-play svg"></div>
  <div class="ico i-left svg"></div>
  <div class="ico i-right svg"></div>
</div>
<div class="text">
  <span><?php echo esc_html('More'); ?></span>
</div>
</div>
<div class="search-modal">
      <div class="sm-background"></div>
      <div class="sm-close svg" data-cursor="scale"></div>
      <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-10">
                  <div class="search s-modal">
                    <form method="get" action="/" class="search-global-action">
                        <div class="row">
                            <input type="text" value="" name="s" class="s rhr-search-modal" placeholder="Type here..." data-item ="5"/>
                            <button class="s-icon svg" type="submit"></button>
                        </div>
                    </form>
                  </div>
                  <div class="loading-search-modal"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cookies Form -->
  <?php $cookeie_code = rhr_get_country_code(); if($cookeie_code->geoplugin_countryCode == 'GB'): ?>
    <div class="rhr-cookies">
    <p>We use cookies to optimize our website and our service.</p>
      <a href="<?php echo esc_attr( esc_url( get_page_link( 5620 ) ) ); ?>">
            Cookie Policy
      </a>
    <div class="functional-btn btn-div">
      <label class="switch" for="functional">
        <input type="checkbox" id="functional" />
        <div class="slider round"></div>
        <span>Functional</span>
      </label>
    </div>
    <div class="statistics-btn btn-div">
      <label class="switch" for="statistics">
        <input type="checkbox" id="statistics" />
        <div class="slider round"></div>
        <span>Statistics</span>
      </label>
    </div>
    <div class="marketing-btn btn-div">
      <label class="switch" for="marketing">
        <input type="checkbox" id="marketing" />
        <div class="slider round"></div>
        <span>Marketing</span>
      </label>
    </div>
    <div class="btn-block">
      <button class="btn btn-accept" id="rhrAcceptCookie">
        Accept all
      </button>
      <button class="btn btn-preference" id="rhrAcceptCookie">
        Save preferences
      </button>
    </div>
  </div>
  <button class="btn manage-content">Manage consent</button>
  <?php else: ?>
    <?php if( $cookeie_code->geoplugin_continentCode == 'EU' ) : ?>
      <div class="rhr-cookies">
      <p>We use cookies to optimize our website and our service.</p>
    <a href="<?php echo esc_attr( esc_url( get_page_link( 4876 ) ) ); ?>">
            Cookie Policy
          </a>
    <div class="functional-btn btn-div">
      <label class="switch" for="functional">
        <input type="checkbox" id="functional" />
        <div class="slider round"></div>
        <span>Functional</span>
      </label>
    </div>
    <div class="statistics-btn btn-div">
      <label class="switch" for="statistics">
        <input type="checkbox" id="statistics" />
        <div class="slider round"></div>
        <span>Statistics</span>
      </label>
    </div>
    <div class="marketing-btn btn-div">
      <label class="switch" for="marketing">
        <input type="checkbox" id="marketing" />
        <div class="slider round"></div>
        <span>Marketing</span>
      </label>
    </div>
    <div class="btn-block">
      <button class="btn btn-accept" id="rhrAcceptCookie">
        Accept all
      </button>
      <button class="btn btn-preference" id="rhrAcceptCookie">
        Save preferences
      </button>
    </div>
  </div>
  <button class="btn manage-content">Manage consent</button>
    <?php endif; ?>
  <?php endif; ?>
</main>
<?php wp_footer(); ?>
</body>
</html>
