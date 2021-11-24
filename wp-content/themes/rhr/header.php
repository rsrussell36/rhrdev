<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php rhr_head(); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<main data-page="<?php echo esc_attr(rhr_page_name()); ?>">
<?php

 if(rhr_get_page_title() == 'highlights' || rhr_get_page_title() == 'succession' || rhr_get_page_title() == 'private' || rhr_get_page_title() == 'venture'){ ?>
  <header class="header h-white">
<?php }else{ ?>
  <header class="header ">
<?php } ?>

    <?php
        $is_h_popup_show = rhr_options('is_h_popup_show', '');
        if (true == $is_h_popup_show):
      ?>
  <div class="hmbrg" data-cursor="scale">
    <span></span>
    <span></span>
  </div>
  <?php endif; ?>
      <?php
        $is_h_btn_show = rhr_options('is_h_btn_show', '');
        if (true == $is_h_btn_show):
          $h_btn_text = rhr_options('h_btn_text', 'Get In Touch');
          $h_btn_url = rhr_options('h_btn_url', home_url( '/' ));
      ?>
        <a href="<?php echo esc_url($h_btn_url); ?>" class="getTouch header-get-in-touch" data-cursor="scale-dark">
          <span><?php echo esc_html__($h_btn_text, 'rhr'); ?></span>
          <div class="over">
            <span><?php echo esc_html__($h_btn_text, 'rhr'); ?></span>
          </div>
        </a>
      <?php endif; ?>
  <div class="icons">
      <?php
          $is_h_search_btn_show = rhr_options('is_h_search_btn_show', '');
          if (true == $is_h_search_btn_show):
          ?>
        <div class="ico ico-search bt-search" data-cursor="scale-dark">
          <div class="svg"></div>
        </div>
        <?php endif; ?>
          <?php
          $is_h_login_btn_show = rhr_options('is_h_login_btn_show', '');
          if (true == $is_h_login_btn_show):
            $h_login_btn_url = rhr_options('h_login_btn_url', home_url( '/' ));
          ?>
        <a href="<?php echo esc_url($h_login_btn_url); ?>" class="ico ico-user" data-cursor="scale-dark">
          <div class="svg"></div>
        </a>
        <?php endif; ?>
      </div>
          <?php if (true == $is_h_search_btn_show): ?>
      <div class="h-search">
        <div class="search s-header">
          <form method="get" action="/" class="search-action">
              <div class="row">
                  <input type="text" value="" name="s" class="s rhr-search" placeholder="What are you looking for?" data-item ="5"/>
                  <button class="s-icon svg" type="submit"></button>
                  <div class="s-close svg" data-cursor="scale-dark"></div>
              </div>
          </form>
        </div>
      </div>
       <div class="loading-search-post header-search"></div>
      <?php endif; ?>

  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div class="col col-10">
        <div class="contents">
          <?php
              $is_h_logo_show = rhr_options('is_h_logo_show', '');
              if (true == $is_h_logo_show):
                $h_logo_url = rhr_options('h_logo_url', home_url( '/' ));
            ?>
              <a href="<?php echo esc_url($h_logo_url); ?>" class="logo" data-cursor="scale">
                <div class="svg"></div>
              </a>
              <?php endif; ?>
          <ul class="items">
              <?php
                wp_nav_menu( array(
                    'menu_class' => '',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'theme_location' => 'primary_menu',
                    'walker'         => new RHR_Navwalker(),
                    'fallback_cb'     => false,
                ) );
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="menu">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col col-9">
        <div class="m-left">
        <?php
          if( is_active_sidebar( 'l-h-sidebar' ) ) {
            dynamic_sidebar( 'l-h-sidebar' );
          }
        ?>
        </div>
        <div class="m-right">
        <?php
          if( is_active_sidebar( 'r-h-sidebar' ) ) {
            dynamic_sidebar( 'r-h-sidebar' );
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
