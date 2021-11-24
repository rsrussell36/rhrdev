<?php
 if(!function_exists('rhr_options')){

    function rhr_options ( $section_id, $default = '' ) {

        $option_data = $default;

        if ( class_exists( 'Redux' ) ) {

            global $rhr;
            $option_data = (isset($rhr[$section_id]) && (!empty($rhr[$section_id]))) ? $rhr[$section_id] : $default;

        }

        return $option_data;

    }

 }

    if(!function_exists('rhr_wrapper_start')) {

	function rhr_wrapper_start( $sidebar = 'right', $col = 8 ) {

		$row_class = 'row';

		if($sidebar == 'left' && is_active_sidebar( 'rhr-page-sidebar' )) {
			$row_class = 'row flex-row-reverse';
		}

		if($sidebar == 'full' || !is_active_sidebar( 'rhr-page-sidebar' )) {
			$row_class = 'row justify-content-center';
			get_sidebar();
		}

		?>
		 <div class="container page_padding">
			<div class="<?php esc_attr_e($row_class); ?>">
				<div class="col-lg-8">
		<?php

	}

}
if(!function_exists('rhr_wrapper_end')) {

	function rhr_wrapper_end( $sidebar = 'right' ) {
		?>
		  </div>
		 <?php
			if($sidebar != 'full' && is_active_sidebar( 'rhr-page-sidebar' )){
				get_sidebar();
			}
	     ?>

		 </div>
	   </div>
		<?php
	}

}
function rhr_head(){
    ?>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

    <meta name="language"                     	content="english" />
    <meta name="description"                  	content="" />
    <meta name="keywords"                     	content="" />

    <meta property="og:type"                  	content="website"/>
    <meta property="og:locale"               	  content="en_US"/>
    <meta property="og:site_name"             	content="RHR" />
    <meta property="og:title"                 	content="RHR | Senior Leadership Development" />

    <meta property="og:description"           	content="description" />
    <meta property="og:image:type"            	content="image/jpeg"/>
    <meta property="og:image:width"           	content="800"/>
    <meta property="og:image:height"          	content="400"/>

      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
    <?php
	if(class_exists( 'Redux' ) ) {
        // Apple Touch Icon From ThemeOptions
        $rhr_apple_touch_icon = rhr_options('rhr_apple_touch_icon');
        if ( isset( $rhr_apple_touch_icon['url'] ) && !empty( $rhr_apple_touch_icon['url'] ) ) :
			echo '<link rel="apple-touch-icon" href="'.esc_url($rhr_apple_touch_icon['url']).'">';
		endif;
        /* Fav Icon From ThemeOptions */
	   $fav = rhr_options('rhr_fav_icon');
		if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) :
		   if ( isset( $fav['url'] ) && ! empty( $fav['url'] ) ) :
			   echo '<link rel="shortcut icon" href="'.esc_url($fav['url']).'">';
            endif;
        endif;
   }
}
function rhr_admin_head(){
    if(class_exists( 'Redux' ) ) {
        /* Fav Icon From ThemeOptions */
        $fav = rhr_options('rhr_d_fav_icon');
        if ( isset( $fav['url'] ) && ! empty( $fav['url'] ) ) :
            echo '<link rel="shortcut icon" href="'.esc_url($fav['url']).'">';
            echo '<link rel="icon" href="'.esc_url($fav['url']).'">';
        endif;
   }
}
add_action( 'admin_head', 'rhr_admin_head' );
 function rhr_social_icons_header() {
    $facebook  = rhr_options( 'general_facebook', '' );
    $twitter   = rhr_options( 'general_twitter', '' );
    $gplus     = rhr_options( 'general_gplus', '' );
    $linkedIn  = rhr_options( 'general_linkedin', '' );
    $dribble   = rhr_options( 'general_dribble', '' );
    $flickr    = rhr_options( 'general_flickr', '' );
    $pinterest = rhr_options( 'general_pinterest', '' );
    $tumblr    = rhr_options( 'general_tumblr', '' );
    $youtube   = rhr_options( 'general_youtube', '' );
    $vimeo     = rhr_options( 'general_vimeo', '' );
    $blogger    = rhr_options( 'general_blogger', '' );
    $rss       = rhr_options( 'general_rss', '' );
    $instagram = rhr_options( 'general_instagram', '' );
    $dribbble = rhr_options( 'general_dribbble', '' );
    $github = rhr_options( 'general_github', '' );

    $social_icons_html = '';

    if( !empty( $facebook ) || !empty( $twitter ) || !empty( $gplus ) || !empty( $linkedIn ) || !empty( $dribble ) || !empty( $flickr ) || !empty( $pinterest ) || !empty( $tumblr ) || !empty( $blogger ) || !empty( $youtube ) || !empty( $vimeo ) || !empty( $rss ) || !empty( $instagram ) || !empty( $dribbble ) || !empty( $github ) ) {

        $social_icons_html .= '<div class="social">';

        if( !empty($facebook)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $facebook ) .'" target="_blank" class="ico ico-fb" data-cursor="scale-dark"><div class="svg"></div></a>';
        }

        if( !empty($twitter)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $twitter ) .'" target="_blank" class="ico ico-tt" data-cursor="scale-dark"><div class="svg"></div></a>';
        }

        if( !empty($linkedIn)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $linkedIn ) .'" target="_blank" class="ico ico-ld" data-cursor="scale-dark"><div class="svg"></div></a>';
        }

        if( !empty($instagram) ) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $instagram ) .'" target="_blank" class="ico ico-in" data-cursor="scale-dark"><div class="svg"></div></a>';
        }

        if( !empty($gplus)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $gplus ) .'" target="_blank" class="external item rhr-google-plus" data-cursor="scale-dark">'.esc_html__('Google Plus', 'rhr').'</a>';
        }

        if( !empty($flickr)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $flickr ) .'" target="_blank" class="external item rhr-flickr" data-cursor="scale-dark">'.esc_html__('Flickr', 'rhr').'</a>';
        }

        if( !empty($pinterest)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $pinterest ) .'" target="_blank" class="external item rhr-pinterest" data-cursor="scale-dark">'.esc_html__('Pinterest', 'rhr').'</a>';
        }

        if( !empty($tumblr)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $tumblr ) .'" target="_blank" class="external item rhr-tumblr" data-cursor="scale-dark">'.esc_html__('Tumblr', 'rhr').'</a>';
        }

        if( !empty($youtube )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $youtube ) .'" target="_blank" class="external item rhr-youtube" data-cursor="scale-dark">'.esc_html__('Youtube', 'rhr').'</a>';
        }

        if( !empty($vimeo )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $vimeo ) .'" target="_blank" class="external item rhr-vimeo" data-cursor="scale-dark">'.esc_html__('Vimeo', 'rhr').'</a>';
        }

        if( !empty($blogger )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $blogger ) .'" target="_blank" class="external item rhr-blogger" data-cursor="scale-dark">'.esc_html__('Blogger', 'rhr').'</a>';
        }

        if( !empty($rss )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $rss ) .'" target="_blank" class="external item rhr-rss" data-cursor="scale-dark">'.esc_html__('RSS', 'rhr').'</a>';
        }

        if( !empty($dribbble )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $dribbble ) .'" target="_blank" class="external item rhr-dribble" data-cursor="scale-dark">'.esc_html__('Dribble', 'rhr').'</a>';
        }

        if( !empty($github )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $github ) .'" target="_blank" class="external item rhr-github" data-cursor="scale-dark">'.esc_html__('Github', 'rhr').'</a>';
        }
    $social_icons_html .= '</div>';
    }

    return $social_icons_html;
}
function rhr_social_icons() {
    $facebook  = rhr_options( 'general_facebook', '' );
    $twitter   = rhr_options( 'general_twitter', '' );
    $gplus     = rhr_options( 'general_gplus', '' );
    $linkedIn  = rhr_options( 'general_linkedin', '' );
    $dribble   = rhr_options( 'general_dribble', '' );
    $flickr    = rhr_options( 'general_flickr', '' );
    $pinterest = rhr_options( 'general_pinterest', '' );
    $tumblr    = rhr_options( 'general_tumblr', '' );
    $youtube   = rhr_options( 'general_youtube', '' );
    $vimeo     = rhr_options( 'general_vimeo', '' );
    $blogger    = rhr_options( 'general_blogger', '' );
    $rss       = rhr_options( 'general_rss', '' );
    $instagram = rhr_options( 'general_instagram', '' );
    $dribbble = rhr_options( 'general_dribbble', '' );
    $github = rhr_options( 'general_github', '' );

    $social_icons_html = '';

    if( !empty( $facebook ) || !empty( $twitter ) || !empty( $gplus ) || !empty( $linkedIn ) || !empty( $dribble ) || !empty( $flickr ) || !empty( $pinterest ) || !empty( $tumblr ) || !empty( $blogger ) || !empty( $youtube ) || !empty( $vimeo ) || !empty( $rss ) || !empty( $instagram ) || !empty( $dribbble ) || !empty( $github ) ) {

        $social_icons_html .= '<div class="social">';

        if( !empty($facebook)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $facebook ) .'" target="_blank" class="ico ico-fb" data-cursor="scale"><div class="svg"></div></a>';
        }

        if( !empty($twitter)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $twitter ) .'" target="_blank" class="ico ico-tt" data-cursor="scale"><div class="svg"></div></a>';
        }

        if( !empty($linkedIn)) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $linkedIn ) .'" target="_blank" class="ico ico-ld" data-cursor="scale"><div class="svg"></div></a>';
        }

        if( !empty($instagram) ) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $instagram ) .'" target="_blank" class="ico ico-in" data-cursor="scale"><div class="svg"></div></a>';
        }

        if( !empty($gplus)) {
            $social_icons_html .= '<atarget="_blank" href="'. esc_url( $gplus ) .'" target="_blank" class="external item rhr-google-plus" data-cursor="scale">'.esc_html__('Google Plus', 'rhr').'</a>';
        }

        if( !empty($flickr)) {
            $social_icons_html .= '<atarget="_blank" href="'. esc_url( $flickr ) .'" target="_blank" class="external item rhr-flickr" data-cursor="scale">'.esc_html__('Flickr', 'rhr').'</a>';
        }

        if( !empty($pinterest)) {
            $social_icons_html .= '<atarget="_blank" href="'. esc_url( $pinterest ) .'" target="_blank" class="external item rhr-pinterest" data-cursor="scale">'.esc_html__('Pinterest', 'rhr').'</a>';
        }

        if( !empty($tumblr)) {
            $social_icons_html .= '<atarget="_blank" href="'. esc_url( $tumblr ) .'" target="_blank" class="external item rhr-tumblr" data-cursor="scale">'.esc_html__('Tumblr', 'rhr').'</a>';
        }

        if( !empty($youtube )) {
            $social_icons_html .= '<atarget="_blank" href="'. esc_url( $youtube ) .'" target="_blank" class="external item rhr-youtube" data-cursor="scale">'.esc_html__('Youtube', 'rhr').'</a>';
        }

        if( !empty($vimeo )) {
            $social_icons_html .= '<atarget="_blank" href="'. esc_url( $vimeo ) .'" target="_blank" class="external item rhr-vimeo" data-cursor="scale">'.esc_html__('Vimeo', 'rhr').'</a>';
        }

        if( !empty($blogger )) {
            $social_icons_html .= '<atarget="_blank" href="'. esc_url( $blogger ) .'" target="_blank" class="external item rhr-blogger" data-cursor="scale">'.esc_html__('Blogger', 'rhr').'</a>';
        }

        if( !empty($rss )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $rss ) .'" target="_blank" class="external item rhr-rss" data-cursor="scale">'.esc_html__('RSS', 'rhr').'</a>';
        }

        if( !empty($dribbble )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $dribbble ) .'" target="_blank" class="external item rhr-dribble" data-cursor="scale">'.esc_html__('Dribble', 'rhr').'</a>';
        }

        if( !empty($github )) {
            $social_icons_html .= '<a target="_blank" href="'. esc_url( $github ) .'" target="_blank" class="external item rhr-github" data-cursor="scale">'.esc_html__('Github', 'rhr').'</a>';
        }
    $social_icons_html .= '</div>';
    }

    return $social_icons_html;
}
function rhr_social_share() {

    $facebook  = rhr_options( 'share_facebook', '' );
    $twitter   = rhr_options( 'share_twitter', '' );
    $linkedIn  = rhr_options( 'share_linkedin', '' );
    $gplus    = rhr_options( 'share_gplus', '' );


        $url = urlencode(get_permalink());
        $social_share_html = '';
            $social_share_html .= '<div class="share">';
                $social_share_html .= '<div class="type">'.esc_html('SHARE').'<span class="svg"></span></div>';

                if( !empty($linkedIn)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&amp;title='.urlencode(get_the_title())).'" class="item" data-cursor="scale">'.esc_html('LinkedIn').'</a>';
                }

                if( !empty($twitter)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&amp;url='.$url).'" class="item" data-cursor="scale">'.esc_html('Twitter').'</a>';
                }

                if( !empty($facebook)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.facebook.com/sharer/sharer.php?u='.$url).'" class="item" data-cursor="scale">'.esc_html('Facebook').'</a>';
                }

                if( !empty($gplus)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://plus.google.com/share?url='.$url).'" class="item" data-cursor="scale">'.esc_html('Google Plus').'</a>';
                }
            $social_share_html .= '</div>';

        return $social_share_html;
}
function rhr_social_share_event() {

    $facebook  = rhr_options( 'share_facebook_event', '' );
    $twitter   = rhr_options( 'share_twitter_event', '' );
    $linkedIn  = rhr_options( 'share_linkedin_event', '' );
    $gplus    = rhr_options( 'share_gplus_event', '' );


        $url = urlencode(get_permalink());
        $social_share_html = '';
            $social_share_html .= '<div class="share">';
                $social_share_html .= '<div class="type">'.esc_html('SHARE').'<span class="svg"></span></div>';

                if( !empty($linkedIn)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&amp;title='.urlencode(get_the_title())).'" class="item" data-cursor="scale">'.esc_html('LinkedIn').'</a>';
                }

                if( !empty($twitter)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&amp;url='.$url).'" class="item" data-cursor="scale">'.esc_html('Twitter').'</a>';
                }

                if( !empty($facebook)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.facebook.com/sharer/sharer.php?u='.$url).'" class="item" data-cursor="scale">'.esc_html('Facebook').'</a>';
                }

                if( !empty($gplus)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://plus.google.com/share?url='.$url).'" class="item" data-cursor="scale">'.esc_html('Google Plus').'</a>';
                }
            $social_share_html .= '</div>';

        return $social_share_html;
}
function rhr_social_share_ebooks() {

    $facebook  = rhr_options( 'share_facebook_ebook', '' );
    $twitter   = rhr_options( 'share_twitter_ebook', '' );
    $linkedIn  = rhr_options( 'share_linkedin_ebook', '' );
    $gplus    = rhr_options( 'share_gplus_ebook', '' );


        $url = urlencode(get_permalink());
        $social_share_html = '';
            $social_share_html .= '<div class="share">';
                $social_share_html .= '<div class="type">'.esc_html('SHARE').'<span class="svg"></span></div>';

                if( !empty($linkedIn)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&amp;title='.urlencode(get_the_title())).'" class="item" data-cursor="scale">'.esc_html('LinkedIn').'</a>';
                }

                if( !empty($twitter)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&amp;url='.$url).'" class="item" data-cursor="scale">'.esc_html('Twitter').'</a>';
                }

                if( !empty($facebook)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.facebook.com/sharer/sharer.php?u='.$url).'" class="item" data-cursor="scale">'.esc_html('Facebook').'</a>';
                }

                if( !empty($gplus)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://plus.google.com/share?url='.$url).'" class="item" data-cursor="scale">'.esc_html('Google Plus').'</a>';
                }
            $social_share_html .= '</div>';

        return $social_share_html;
}
function rhr_social_share_news() {

    $facebook  = rhr_options( 'share_facebook_news', '' );
    $twitter   = rhr_options( 'share_twitter_news', '' );
    $linkedIn  = rhr_options( 'share_linkedin_news', '' );
    $gplus    = rhr_options( 'share_gplus_news', '' );


        $url = urlencode(get_permalink());
        $social_share_html = '';
            $social_share_html .= '<div class="share">';
                $social_share_html .= '<div class="type">'.esc_html('SHARE').'<span class="svg"></span></div>';

                if( !empty($linkedIn)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&amp;title='.urlencode(get_the_title())).'" class="item" data-cursor="scale">'.esc_html('LinkedIn').'</a>';
                }

                if( !empty($twitter)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&amp;url='.$url).'" class="item" data-cursor="scale">'.esc_html('Twitter').'</a>';
                }

                if( !empty($facebook)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.facebook.com/sharer/sharer.php?u='.$url).'" class="item" data-cursor="scale">'.esc_html('Facebook').'</a>';
                }

                if( !empty($gplus)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://plus.google.com/share?url='.$url).'" class="item" data-cursor="scale">'.esc_html('Google Plus').'</a>';
                }
            $social_share_html .= '</div>';

        return $social_share_html;
}
function rhr_social_share_research() {

    $facebook  = rhr_options( 'share_facebook_research', '' );
    $twitter   = rhr_options( 'share_twitter_research', '' );
    $linkedIn  = rhr_options( 'share_linkedin_research', '' );
    $gplus    = rhr_options( 'share_gplus_research', '' );

        $url = urlencode(get_permalink());
        $social_share_html = '';
            $social_share_html .= '<div class="share">';
                $social_share_html .= '<div class="type">'.esc_html('SHARE').'<span class="svg"></span></div>';


                if( !empty($linkedIn)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&amp;title='.urlencode(get_the_title())).'" class="item" data-cursor="scale">'.esc_html('LinkedIn').'</a>';
                }

                if( !empty($twitter)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&amp;url='.$url).'" class="item" data-cursor="scale">'.esc_html('Twitter').'</a>';
                }

                if( !empty($facebook)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.facebook.com/sharer/sharer.php?u='.$url).'" class="item" data-cursor="scale">'.esc_html('Facebook').'</a>';
                }

                if( !empty($gplus)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://plus.google.com/share?url='.$url).'" class="item" data-cursor="scale">'.esc_html('Google Plus').'</a>';
                }
            $social_share_html .= '</div>';

        return $social_share_html;
}
function rhr_social_share_webinars() {

    $facebook  = rhr_options( 'share_facebook_webinar', '' );
    $twitter   = rhr_options( 'share_twitter_webinar', '' );
    $linkedIn  = rhr_options( 'share_linkedin_webinar', '' );
    $gplus    = rhr_options( 'share_gplus_webinar', '' );


        $url = urlencode(get_permalink());
        $social_share_html = '';
            $social_share_html .= '<div class="share natural">';
                $social_share_html .= '<div class="type">'.esc_html('SHARE').'<span class="svg"></span></div>';

                if( !empty($linkedIn)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&amp;title='.urlencode(get_the_title())).'" class="item" data-cursor="scale">'.esc_html('LinkedIn').'</a>';
                }

                if( !empty($twitter)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&amp;url='.$url).'" class="item" data-cursor="scale">'.esc_html('Twitter').'</a>';
                }

                if( !empty($facebook)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://www.facebook.com/sharer/sharer.php?u='.$url).'" class="item" data-cursor="scale">'.esc_html('Facebook').'</a>';
                }

                if( !empty($gplus)) {
                    $social_share_html .= '<a target="_blank" href="'.esc_url('https://plus.google.com/share?url='.$url).'" class="item" data-cursor="scale">'.esc_html('Google Plus').'</a>';
                }
            $social_share_html .= '</div>';

        return $social_share_html;
}
if ( ! function_exists( 'rhr_wphead' ) ){

	function rhr_wphead() {
		$rhr_custom_css = rhr_options('rhr_custom_css', '');
		$rhr_custom_js = rhr_options('rhr_custom_js', '');
		$rhr_google_analytics_g = rhr_options('rhr_google_analytics_g', '');
		$rhr_google_analytics_eu = rhr_options('rhr_google_analytics_eu', '');
		$rhr_google_analytics_uk = rhr_options('rhr_google_analytics_uk', '');

		// Custom CSS From ThemeOptions
		if( isset( $rhr_custom_css ) && ! empty( $rhr_custom_css ) ){
			echo '<style>'. $rhr_custom_css . '</style>';
		}

		// Custom JS From ThemeOptions
		if( isset( $rhr_custom_js ) && ! empty( $rhr_custom_js ) ){
			echo '<script>'. $rhr_custom_js . '</script>';
		}
        $google_code = rhr_get_country_code();
        if($google_code->geoplugin_countryCode == 'GB'){
            echo $rhr_google_analytics_uk;
        }else{
            if($google_code->geoplugin_countryCode == 'EU'){
                echo $rhr_google_analytics_eu;
            }else{
                echo $rhr_google_analytics_g;
            }
        }

	}

	add_action('wp_head', 'rhr_wphead');
}

if ( ! function_exists( 'rhr_wpfooter' ) ){

	function rhr_wpfooter() {
		$f_custom_js = rhr_options('f_custom_js', '');

		// Custom JS From ThemeOptions
		if( isset( $f_custom_js ) && ! empty( $f_custom_js ) ){
			echo '<script>'. $f_custom_js . '</script>';
		}

	}

    add_action('wp_footer', 'rhr_wpfooter', 999);
}
if( ! function_exists( 'rhr_get_page_title' ) ) {
    function rhr_get_page_title(){
        global $post;
    $post_slug = $post->post_name;
        return esc_html( $post_slug);
        //return esc_html( get_the_title());
    }
}
if( ! function_exists( 'rhr_page_name' ) ) {

    function rhr_page_name() {

        if( is_home() || is_front_page() ) {
            $prefix = 'home';
        }
        else if ( is_archive() ) {
            $prefix = 'archives';
        }
        else if ( is_search() ) {
            $prefix = 'search';
        }
        else if ( is_404() ) {
            $prefix = '404';
        }
        elseif(is_page('home')){
            $prefix = 'home';
        }
        elseif(is_page('about-us')){
            $prefix = 'about';
        }
        elseif(is_page('blogs')){
            $prefix = 'blog';
        }
        elseif(is_single() && 'post' == get_post_type()){
            $prefix = 'blog-post';
        }
        elseif(is_page('terms') || is_page('cookies') || is_page('privacy-policy')){
            $prefix = 'legals';
        }
        elseif(is_page('solutions-diversity')){
            $prefix = 'solutions-diversity';
        }
        elseif(is_page('solutions-development')){
            $prefix = 'solutions-development';
        }
        elseif(is_page('solutions-assessment')){
            $prefix = 'solutions-assessment';
        }
        elseif(is_page('client-cases')){
            $prefix = 'clients-cases';
        }
        elseif(is_page('ebook')){
            $prefix = 'ebooks';
        }
        elseif(is_page('event')){
            $prefix = 'events';
        }
        elseif(is_page('last-news')){
            $prefix = 'last-news';
        }
        elseif(is_page('new')){
            $prefix = 'news';
        }
        elseif(is_page('our-clients')){
            $prefix = 'clients-our';
        }
        elseif(is_page('research-studies')){
            $prefix = 'research-studies';
        }
        elseif(is_page('webinars')){
            $prefix = 'webinars';
        }
        elseif(is_single() && 'rhr_webinar' == get_post_type()){
            $prefix = 'webinar';
        }
        elseif(is_page('profiles')){
            $prefix = 'about-team';
        }
        elseif(is_single() && 'rhr_teams' == get_post_type()){
            $prefix = 'about-team-member';
        }
        elseif(is_page('get-in-touch')){
            $prefix = 'get-in-touch';
        }
        elseif(is_page('get-in-touch')){
            $prefix = 'get-in-touch';
        }
        elseif(is_page('succession')){
            $prefix = 'landing';
        }
        elseif(is_page('private')){
            $prefix = 'landing';
        }
        elseif(is_page('venture')){
            $prefix = 'landing';
        }
        else {
            $prefix = rhr_get_page_title();
        }

        return $prefix;
    }
}
function rhr_webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'rhr_webp_upload_mimes');
function rhr_svg_upload_mimes($existing_mimes) {
    $existing_mimes['svg'] = 'image/svg';
    return $existing_mimes;
}
add_filter('mime_types', 'rhr_svg_upload_mimes');

 function rhr_time_ago( $datetime, $full = false ) {
    $today = time();
    $createdday = strtotime( $datetime );
    $datediff = abs( $today - $createdday );
    $difftext = "";
    $years = floor( $datediff / ( 365 * 60 * 60 * 24 ) );
    $months = floor( ( $datediff - $years * 365 * 60 * 60 * 24 ) / ( 30 * 60 * 60 * 24 ) );
    $days = floor( ( $datediff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 ) / ( 60 * 60 * 24 ) );
    $hours = floor( $datediff / 3600 );
    $minutes = floor( $datediff / 60 );
    $seconds = floor( $datediff );
    // Years
    if ( $difftext == "" ) {
      if ( $years > 1 )
        $difftext = $years . ' years ago';
      elseif ( $years == 1 )
        $difftext = $years . ' year ago';
    }
    // Mounth
    if ( $difftext == "" ) {
      if ( $months > 1 )
        $difftext = $months . ' months ago';
      elseif ( $months == 1 )
        $difftext = $months . ' month ago';
    }
    // Days
    if ( $difftext == "" ) {
      if ( $days > 1 )
        $difftext = $days . ' days ago';
      elseif ( $days == 1 )
        $difftext = $days . ' day ago';
    }
    // Hours
    if ( $difftext == "" ) {
      if ( $hours > 1 )
        $difftext = $hours . ' hours ago';
      elseif ( $hours == 1 )
        $difftext = $hours . ' hour ago';
    }
    // Minutes
    if ( $difftext == "" ) {
      if ( $minutes > 1 )
        $difftext = $minutes . ' minutes ago';
      elseif ( $minutes == 1 )
        $difftext = $minutes . ' minute ago';
    }
    // Seconds
    if ( $difftext == "" ) {
      if ( $seconds > 1 )
        $difftext = $seconds . ' seconds ago';
      elseif ( $seconds == 1 )
        $difftext = $seconds . ' second ago';
    }
    echo $difftext;
   }
function _shorten_text($text , $no_of__limit)
{
	$chars_limit = $no_of__limit;
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	if ($chars_text > $chars_limit)
	{

		$text = $text."...";

	}
	return $text;
}
if(!function_exists('rhr_get_meta_value')){
	function rhr_get_meta_value( $id, $meta_key, $meta_default = '') {
		$value = ( null != get_post_meta( $id, $meta_key, true ) ) ? get_post_meta( $id, $meta_key, true ) : $meta_default;
		return $value;
	}
}
function rhr_get_the_term_list( $id, $taxonomy, $before = '', $sep = '', $after = '' ) {
	$terms = get_the_terms( $id, $taxonomy );

	if ( is_wp_error( $terms ) )
		return $terms;

	if ( empty( $terms ) )
		return false;


	$links = array();

	foreach ( $terms as $term ) {
		$link = get_term_link( $term, $taxonomy );
		if ( is_wp_error( $link ) ) {
			return $link;
		}
        $links[] = '<a href="' . esc_url( $link ) . '" rel="tag"  data-cursor="scale" class="tag">' . $term->name . '</a>';
        //$links[] = '<a href="#" rel="tag"  data-cursor="scale" class="tag">' . $term->name . '</a>';
	}

	$term_links = apply_filters( "term_links-{$taxonomy}", $links );

	return $before . join( $sep, $links ) . $after;
}
function rhr_default_featured_imgae(){
    $is_default_thumb    = rhr_options( 'is_default_thumb', '' );
    $rhr_default_thumb    = rhr_options( 'rhr_default_thumb', '' );
    if( !empty( $is_default_thumb ) ){
        echo '<img src="'. esc_url( $rhr_default_thumb['url'] ) .'" alt="RHR">';
    }
}
if( ! function_exists( 'rhr_update_search_exlude' ) ) {

    function rhr_update_search_exlude( $query ) {

        if( ! isset( $_GET['s'] ) ) {
           return $query;
        }

        $all_post_type = array();

        $args = array(
           'public'   => true,
           '_builtin' => false,
        );

        $post_types = get_post_types( $args );

        $post_types = array_merge( $post_types, array( 'post', 'page' ) );
        foreach ( $post_types as $key => $post_type ) {
            $all_post_type[] = $post_type;
        }

        //Search Exclude
        $search_exclude = ['page'];

        $search_diff = array_diff( $all_post_type, $search_exclude );

        if ( ! $query->is_admin && $query->is_search ) {
            $query->set('post_type', $search_diff );
        }
        return $query;
    }

}

add_filter('pre_get_posts', 'rhr_update_search_exlude');


if( !function_exists( 'rhr_search_pagination' ) ) {

    // Return pagination style
    function rhr_search_pagination( $args = array(), $values = array() ) {

        //Empty assignment
        $output = '';

        // Set max number of pages
        if( !isset( $values['max'] ) ) {
            if( $args == '' ) {
                global $wp_query;
                $max = $wp_query->max_num_pages;
                if ( $max <= 1 )
                    return;

            }
            else {
                // Assign and call query
                if( isset( $_GET['s'] ) && $_GET['s'] != '' ) {
                    $args['s'] = $_GET['s'];
                }

                $q = new WP_Query( $args );
                $max = $q->max_num_pages;
                wp_reset_postdata();
                if ( $max <= 1 )
                    return;

            }

            $values['max']   = $max;
        }

        // Set page number
        if( !isset( $values['paged'] ) ) {
            if( get_query_var( 'paged' ) ) {
                $paged = get_query_var( 'paged' );
            }
            elseif( get_query_var( 'page' ) ) {
                $paged = get_query_var( 'page' );
            }
            else {
                $paged = 1;
            }

            $values['paged']   = $paged;
        }
            $pagination = paginate_links( array(
                'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                'format'       => '',
                'current'      => max( 1, $values['paged'] ),
                'total'        => $values['max'],
                'prev_text'    => '<',
                'next_text'    => '>',
                'type'         => 'list',
                'end_size'     => 4,
                'mid_size'     => 4
            ) );

            $output .= '<div class="pagination p-margin clearfix">';
                $output .= $pagination;
            $output .= '</div>';
        return $output;
    }
}

function rhr_tinyMCEoptions($options) {
    $options['extended_valid_elements'] = 'span';
    return $options;
}
add_filter('tiny_mce_before_init', 'rhr_tinyMCEoptions');

function rhr_get_public_ip_address(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function rhr_get_country_code(){
	$country_code = '';
	$current_ip = rhr_get_public_ip_address();
  $geoplugin = new geoPlugin();
  $geoplugin->locate();
  return $geoplugin;
	// if(!empty($current_ip)){
	// 	$get_ip = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $current_ip));
	// 	return $get_ip;
	// }
}
function rhr_get_popup_content(){
  $current_code = rhr_get_country_code();
  $get_popup_content = '';
    if($current_code->geoplugin_countryCode == 'GB'){
      $get_popup_content = '<div class="popup-check-inner"><label class="container-checkbox">By checking this box and selecting Confirm I agree: (1) that RHR International LLP and RHR International Consultants Ltd. (together “RHR”) and their affiliates may collect, use, store, process, and transfer the information I enter (including personal information); (2) that I have read and agree to the RHR <a class="popup-link" data-cursor="scale" href="'.esc_attr( esc_url( get_page_link( 5758 ) ) ).'" target="_blank">Terms of Service</a> and <a class="popup-link" data-cursor="scale" href="'.esc_attr( esc_url( get_page_link( 5145 ) ) ).'" target="_blank">Privacy Policy</a>; and (3) RHR may send me content regarding RHR’s products and services.<input id="popup-terms" class="popup-terms" type="checkbox"/><span class="checkmark"></span></label></div>';
    }else{
      if($current_code->geoplugin_continentCode == 'EU'){
        $get_popup_content = '<div class="popup-check-inner"><label class="container-checkbox">By checking this box and selecting Confirm I agree: (1) that RHR International LLP and RHR International Consultants SRL (together “RHR”) and their affiliates may collect, use, store, process, and transfer the information I enter (including personal information); (2) that I have read and agree to the RHR <a class="popup-link" data-cursor="scale" href="'.esc_attr( esc_url( get_page_link( 3766 ) ) ).'" target="_blank">Terms of Service</a> and <a class="popup-link" data-cursor="scale" href="'.esc_attr( esc_url( get_page_link( 3831 ) ) ).'" target="_blank">Privacy Policy</a>; and (3) RHR may send me content regarding RHR’s products and services.<input id="popup-terms" class="popup-terms" type="checkbox"/><span class="checkmark"></span></label></div>';
      }else{
        $get_popup_content = '<div class="popup-check-inner"><label class="container-checkbox">By checking this box and selecting Confirm I agree: (1) that RHR International LLP and their affiliates (together “RHR”) may collect, use, store, process, and transfer the information I enter (including personal information); (2) that I have read and agree to the RHR <a class="popup-link" data-cursor="scale" href="'.esc_attr( esc_url( get_page_link( 1236 ) ) ).'" target="_blank">Terms of Service</a> and <a class="popup-link" data-cursor="scale" href="'.esc_attr( esc_url( get_page_link( 3 ) ) ).'" target="_blank">Privacy Policy</a>; and (3) RHR may send me content regarding RHR’s products and services.<input id="popup-terms" class="popup-terms" type="checkbox"/><span class="checkmark"></span></label></div>';
      }
    }
    return $get_popup_content;
}
function rhr_download_filename($url){
    $file_name = '';
    $path_parts = pathinfo($url);
    if(!empty($path_parts)){
        $file_name =  $path_parts['filename'];
    }
    return $file_name;
}
function rhr_download_shortcode($atts){
    $atts = shortcode_atts( array(
        'data-to' => '',
        'data-subject' => '',
        'data-reply' => 'wordpress@rhrinternational.com',
        'data-msgprefix' => 'Hello',
        'data-msg' => 'Thanks for downloading.',
        'data-success' => 'Thanks for downloading.',
        'data-empty' => 'Oops! file not found!',
        'data-error' => 'Oops! Something wrong, try again!',
        'name_empty' => 'Field must not be blank.',
        'email_empty' => 'Field must not be blank.',
        'invalid_email' => 'Please Enter Valid Email Address.',
        'company_empty' => 'Field must not be blank.',
        'file' => '',
        'form_class' => 'form-wrap',
        'data_color' => 'purple',
        'button_class' => 'form-button',
    ), $atts, 'rhr_download_shortcode' );
    return '<div class="group-black-inputs '.$atts['form_class'].'">
    <div class="rhr-modal-content" data-color="'.$atts['data_color'].'">
    <div class="group-black-close svg bt-close rhr-form-close" data-cursor="scale"></div>
    <div class="paragraph p-white">
    '.esc_html__('Please enter your information below:', 'rhr').'
</div>
<div class="form">
    <div class="rhr-download-error"></div>
    <form id="download_form" class="form download_form" action="#" method="post" data-to="'.$atts['data-to'].'" data-subject="'.$atts['data-subject'].'" data-reply="'.$atts['data-reply'].'" data-msg="'.$atts['data-msg'].'" data-msgprefix="'.$atts['data-msgprefix'].'" data-url="'.attachment_url_to_postid($atts['file']).'" data-success="'.$atts['data-success'].'" data-empty="'.$atts['data-empty'].'" data-error="'.$atts['data-error'].'">
        <div class="row">
            <div class="group g-half">
                <div class="input i-white">
                    <input type="text" name="name" class="name" id="name" placeholder="Name*" arial-label="Name*">
                </div>
                <small class="text-danger form-control-msg">'.esc_html__($atts['name_empty']).'</small>
            </div>
            <div class="group g-half">
                <div class="input i-white">
                    <input type="text" name="email" class="email" id="email" placeholder="Email*" arial-label="Email*">
                </div>
                <small class="text-danger form-control-msg">'.esc_html__($atts['email_empty']).'</small>
                <small class="text-danger form-control-msg-email">'.esc_html__($atts['invalid_email']).'</small>
            </div>
        </div>
        <div class="row">
            <div class="group g-half">
                <div class="input i-white">
                    <input type="text" name="company" class="company" id="company" placeholder="Company*" arial-label="Company*">
                </div>
                <small class="text-danger form-control-msg">'.esc_html__($atts['company_empty']).'</small>
            </div>
            <div class="group g-half">
                <button class="button b-white '.$atts['button_class'].'" data-cursor="scale">
                    <span>'.esc_html__('DOWNLOAD PDF', 'rhr').'</span>
                    <div class="arrow svg"></div>
                </button>
            </div>
        </div>
        <div class="row popup-terms-condition">
          <div class="group g-half">
          '.rhr_get_popup_content().'
          </div>
        </div>
    </form>
</div>
    </div>
</div>

<div class="successful-popup-wrap" id="contactPopUp">
      <div class="successful-popup">
        <div class="close-icon">
            <span></span>
            <span></span>
        </div>
        <p class="popup_message">Thank you for downloading the brochure!<br> We hope you find it informative and helpful.</p>
      </div>
    </div>';
 }
add_shortcode( 'rhr_download_form', 'rhr_download_shortcode' );
function rhr_popup_email(){
    return rhr_options( 'to_email_global', '' );
}
function rhr_popup_from_email(){
    return rhr_options( 'from_email_global', '' );
}
function rhr_popup_subject(){
    return rhr_options( 'subject_global', '' );
}
function rhr_inner_back_button($key){
    $url = '';
    if(isset($key) && !empty($key)){
        $_current_url = rhr_options( $key, '' );
        if(!empty($_current_url)){
            $url = $_current_url;
        }else{
            $url = home_url( '/' );
        }
    }else{
        $url = home_url( '/' );
    }
    return $url;
}
add_filter('body_class', function (array $classes) {
    if (in_array('search', $classes)) {
      unset( $classes[array_search('search', $classes)] );
    }
  return $classes;
});
function rhr_get_taxnomies_object($type){
    $taxonomies = get_object_taxonomies($type, 'objects');
    $data = array();

    foreach ($taxonomies as $tax_slug => $tax) {

        if (!$tax->public || !$tax->show_ui) {
            continue;
        }

        $data[$tax_slug] = $tax;
    }

    return $data;

}
function rhr_get_multiple_category($post_type){
    $taxonomy = rhr_get_taxnomies_object($post_type);
    if (!empty($taxonomy)) {
        foreach ($taxonomy as $index => $tax) {
            $terms = get_the_terms( get_the_ID(), $index );
            return $terms;
        }
    }
}
function rhr_get_image( $args ) {

    // Empty assignment
    $output = $srcset_html = $alt = '';

    $image_id = isset( $args['image_id'] ) && ! empty( $args['image_id'] ) ? $args['image_id'] : get_post_thumbnail_id(); // Image ID

    $full_url = wp_get_attachment_image_src( $image_id, 'full' );
    $full_url = ! empty( $full_url ) ? $full_url[0] : ''; // Full image url

    $width = isset( $args['width'] ) ? $args['width'] : '';
    $height = isset( $args['height'] ) ? $args['height'] : '';

    if( ! empty( $full_url ) ) {

        $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); // Alternative text

        // If width or height not set as 'full', crop the image
        $image_src = ( 'full' != $width && 'full' != $height && NULL != $height ) ? aq_resize( $full_url, $width , $height, true, true ) : $full_url;
        $image_src = ( $image_src ) ? $image_src : $full_url; // if the image size not met the crop size load full size image

        // Build src set
        $srcset_args = isset( $args['srcset'] ) ? $args['srcset'] : '';

        if( ! empty( $srcset_args ) ) {

            $srcset = array();

            foreach( $srcset_args as $key => $size ) {

                $crop_image = aq_resize( $full_url, $size[0] , $size[1], true, true );
                if( $crop_image ) {
                    $srcset[] = aq_resize( $full_url, $size[0] , $size[1], true, true ) .' '.$key.'w';
                }
                else {
                    $srcset[] = $image_src .' '.$key.'w';
                }

            }

            $srcset_html = implode( ', ', $srcset ); // split the srcset image url array to build html string
        }

    }
    else if( empty( $full_url ) ) {
        $is_default_thumb    = rhr_options( 'is_default_thumb', '' );
        if( $is_default_thumb ) {
            $show_placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : true;

            if( $show_placeholder ) {

                $alt = esc_attr__( 'RHR', 'rhr' ); // Alternative text for placeholder image

                $protocol = is_ssl() ? 'https' : 'http';

                $rhr_default_thumb = rhr_options( 'rhr_default_thumb', '' );
                $default_placeholder = $rhr_default_thumb['url'];
                // If none of the placeholder image set it in theme options load external image from placehold.it
                $image_src = empty( $default_placeholder ) ? $protocol.'://via.placeholder.com/'.$width.'x'.$height.'/ef4050/fff?text=RHR' : $default_placeholder;
                // Build src set
                if(!empty($default_placeholder)){
                    $srcset_args = isset( $args['srcset'] ) ? $args['srcset'] : '';

                    if( ! empty( $srcset_args ) ) {

                        $srcset = array();

                        foreach( $srcset_args as $key => $size ) {

                            $crop_image = aq_resize( $default_placeholder, $size[0] , $size[1], true, true );
                            if( $crop_image ) {
                                $srcset[] = aq_resize( $default_placeholder, $size[0] , $size[1], true, true ) .' '.$key.'w';
                            }
                            else {
                                $srcset[] = $image_src .' '.$key.'w';
                            }

                        }

                        $srcset_html = implode( ', ', $srcset ); // split the srcset image url array to build html string
                    }
                }
            }
        }
    }

    if( ! empty( $image_src ) ) {

        $image_tag = isset( $args['image_tag'] ) ? $args['image_tag'] : true;

        if( ! $image_tag ) {
            $output = $full_url;
        }
        else {
            $before = isset( $args['before'] ) ? $args['before'] : ''; // Before image tag
            $after = isset( $args['after'] ) ? $args['after'] : ''; // After image tag
            $class = isset( $args['class'] ) ? $args['class'] : ''; // Class
            $img_id = isset( $args['id'] ) ? $args['id'] : ''; // Id

            $output = $before . '<img src="'.esc_url( $image_src ) .'" id="'. esc_attr( $img_id ) .'" class="'. esc_attr( $class ) .'"  srcset="'. esc_attr( $srcset_html ) .'" alt="'. esc_attr( $alt ) .'">' . $after;
        }
    }

    return $output;

}
function rhr_get_profile_image( $args ) {

    // Empty assignment
    $output = $srcset_html = $alt = '';

    $image_id = isset( $args['image_id'] ) && ! empty( $args['image_id'] ) ? $args['image_id'] : get_post_thumbnail_id(); // Image ID

    $full_url = wp_get_attachment_image_src( $image_id, 'full' );
    $full_url = ! empty( $full_url ) ? $full_url[0] : ''; // Full image url

    $width = isset( $args['width'] ) ? $args['width'] : '';
    $height = isset( $args['height'] ) ? $args['height'] : '';

    if( ! empty( $full_url ) ) {

        $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); // Alternative text

        // If width or height not set as 'full', crop the image
        $image_src = ( 'full' != $width && 'full' != $height && NULL != $height ) ? aq_resize( $full_url, $width , $height, true, true ) : $full_url;
        $image_src = ( $image_src ) ? $image_src : $full_url; // if the image size not met the crop size load full size image

        // Build src set
        $srcset_args = isset( $args['srcset'] ) ? $args['srcset'] : '';

        if( ! empty( $srcset_args ) ) {

            $srcset = array();

            foreach( $srcset_args as $key => $size ) {

                $crop_image = aq_resize( $full_url, $size[0] , $size[1], true, true );
                if( $crop_image ) {
                    $srcset[] = aq_resize( $full_url, $size[0] , $size[1], true, true ) .' '.$key.'w';
                }
                else {
                    $srcset[] = $image_src .' '.$key.'w';
                }

            }

            $srcset_html = implode( ', ', $srcset ); // split the srcset image url array to build html string
        }

    }
    else if( empty( $full_url ) ) {
        $is_default_thumb    = rhr_options( 'is_default_thumb', '' );
        if( $is_default_thumb ) {
            $show_placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : true;

            if( $show_placeholder ) {

                $alt = esc_attr__( 'RHR', 'rhr' ); // Alternative text for placeholder image

                $protocol = is_ssl() ? 'https' : 'http';

                $rhr_default_thumb = rhr_options( 'rhr_profile_default_thumb', '' );
                $default_placeholder = $rhr_default_thumb['url'];
                // If none of the placeholder image set it in theme options load external image from placehold.it
                $image_src = empty( $default_placeholder ) ? $protocol.'://via.placeholder.com/'.$width.'x'.$height.'/ef4050/fff?text=RHR' : $default_placeholder;
                // Build src set
                if(!empty($default_placeholder)){
                    $srcset_args = isset( $args['srcset'] ) ? $args['srcset'] : '';

                    if( ! empty( $srcset_args ) ) {

                        $srcset = array();

                        foreach( $srcset_args as $key => $size ) {

                            $crop_image = aq_resize( $default_placeholder, $size[0] , $size[1], true, true );
                            if( $crop_image ) {
                                $srcset[] = aq_resize( $default_placeholder, $size[0] , $size[1], true, true ) .' '.$key.'w';
                            }
                            else {
                                $srcset[] = $image_src .' '.$key.'w';
                            }

                        }

                        $srcset_html = implode( ', ', $srcset ); // split the srcset image url array to build html string
                    }
                }
            }
        }
    }

    if( ! empty( $image_src ) ) {

        $image_tag = isset( $args['image_tag'] ) ? $args['image_tag'] : true;

        if( ! $image_tag ) {
            $output = $full_url;
        }
        else {
            $before = isset( $args['before'] ) ? $args['before'] : ''; // Before image tag
            $after = isset( $args['after'] ) ? $args['after'] : ''; // After image tag
            $class = isset( $args['class'] ) ? $args['class'] : ''; // Class
            $img_id = isset( $args['id'] ) ? $args['id'] : ''; // Id

            $output = $before . '<img src="'.esc_url( $image_src ) .'" id="'. esc_attr( $img_id ) .'" class="'. esc_attr( $class ) .'"  srcset="'. esc_attr( $srcset_html ) .'" alt="'. esc_attr( $alt ) .'">' . $after;
        }
    }

    return $output;

}
if ( !function_exists('rhr_wp_admin_login_logo') ) :
    function rhr_wp_admin_login_logo() { ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url('<?php echo get_template_directory_uri()."/assets/img/all/logo.svg"; ?>');
            }
        </style>
    <?php }
    add_action( 'login_enqueue_scripts', 'rhr_wp_admin_login_logo' );
endif;

if ( !function_exists('rhr_wp_admin_login_logo_url') ) :
    function rhr_wp_admin_login_logo_url() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'rhr_wp_admin_login_logo_url' );
endif;

function rhr_contact_form_shortoce($atts){
    $current_code = rhr_get_country_code();
    $contact_captcha_sitekey  = rhr_options( 'contact_captcha_sitekey', '' );
    $contact_captcha_secretkey  = rhr_options( 'contact_captcha_secretkey', '' );
    $contact_class = rhr_options('contact_sub_form_class', '');
    $contact_id = rhr_options('contact_sub_form_id', '');
    $atts = shortcode_atts( array(
        'site_key' => $contact_captcha_sitekey,
        'secret_key' => $contact_captcha_secretkey,
        'button-id' => $contact_id,
        'button-class' => $contact_class,
    ), $atts, 'rhr_contact_form_shortoce' );

    ?>

     <form id="rhr_contact_form" class="form rhr_contact_form" action="#" method="post">
         <input type="hidden" data-secret="<?php echo $atts['secret_key']; ?>" class="secret-key">
        <div class="row">
            <div class="group">
                <div class="input i-black">
                    <input type="text" name="name" id="name" placeholder="Name*" arial-label="Name*">
                </div>
                <small class="contact-error-msg"><?php echo esc_html__('Name field is required.', 'rhr');?></small>
            </div>
        </div>
        <div class="row">
            <div class="group">
                <div class="input i-black">
                    <input type="text" name="email" id="email" placeholder="Email*" arial-label="Email*">
                </div>
                <small class="contact-error-msg"><?php echo esc_html__('Email field is required.', 'rhr');?></small>
                <small class="contact-invalidemail-error-msg"><?php echo esc_html__('Please enter a valid Email address.', 'rhr');?></small>
            </div>
        </div>
        <div class="row">
            <div class="group g-half">
                <div class="input i-black">
                    <input type="text" name="company" id="company" placeholder="Company*" arial-label="Company*">
                </div>
                <small class="contact-error-msg"><?php echo esc_html__('Company field is required.', 'rhr');?></small>
            </div>
            <div class="group g-half">
                <div class="input i-black">
                    <input type="text" name="jobtitle" id="jobtitle" placeholder="Job Title*" arial-label="Job Title*">
                </div>
                <small class="contact-error-msg"><?php echo esc_html__('Job title field is required.', 'rhr');?></small>
            </div>
        </div>
        <div class="row">
            <div class="group g-half">
                <div class="input i-black">
                    <input type="tel" name="phone" id="phone" placeholder="Phone" arial-label="Phone">
                </div>
            </div>
            <div class="group g-half">
                <div class="select">
                    <div class="arrow svg"></div>
                    <select name="country" id="country">
                    <option value="">- None -</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Aland Islands">Aland Islands</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="ritish Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="British Virgin Islands">British Virgin Islands</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Caribbean Netherlands">Caribbean Netherlands</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo (Brazzaville)">Congo (Brazzaville)</option>
                    <option value="Congo (Kinshasa)">Congo (Kinshasa)</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curaçao">Curaçao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands">Falkland Islands</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories">French Southern Territories</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernsey">Guernsey</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong S.A.R., China">Hong Kong S.A.R., China</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Ivory Coast">Ivory Coast</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macao S.A.R., China">Macao S.A.R., China</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia">Micronesia</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="etherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="North Korea">North Korea</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="TerritoPalestinianry"> TerritoPalestinianry</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn">Pitcairn</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Barthélemy">Saint Barthélemy</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="aint Martin (French part)">Saint Martin (French part)</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Sint Maarten">Sint Maarten</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                    <option value="South Korea">South Korea</option>
                    <option value="South Sudan">South Sudan</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syria</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-Leste">Timor-Leste</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="U.S. Virgin Islands">U.S. Virgin Islands</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican">Vatican</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="group">
                <div class="textarea">
                    <textarea  placeholder="Let’s Connect" name="message" id="message" arial-label="Let’s Connect"></textarea>
                </div>
                <small class="contact-error-msg"><?php echo esc_html__('Message field is required.', 'rhr');?></small>
                <small class="contact-min-msg"><?php echo esc_html__('You\'ve to need minimum words of 1.', 'rhr');?></small>
                <small class="contact-max-msg"><?php echo esc_html__('You\'ve reached the maximum allowed words of 100.', 'rhr');?></small>
            </div>
        </div>
        <div class="row">
            <div class="group">
                <?php if($current_code->geoplugin_countryCode == 'GB'): ?>
                    <div class="contact-check-inner">
                            <label class="container-checkbox">We are pleased to share our latest updates, newsletters, and similar communications with you. Please check this box to consent to receiving email communications and acknowldge that you agree to our <a class="contact-link" data-cursor="scale" href="<?php echo esc_attr( esc_url( get_page_link( 5758 ) ) ); ?>" target="_blank">terms of use</a> and <a class="contact-link" data-cursor="scale" href="<?php echo esc_attr( esc_url( get_page_link( 5145 ) ) ); ?>" target="_blank">privacy policy</a>.
                                <input id="contact-terms" class="contact-terms" type="checkbox"/>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                <?php else: ?>
                    <?php if( $current_code->geoplugin_continentCode == 'EU' ) : ?>
                        <div class="contact-check-inner">
                            <label class="container-checkbox">We are pleased to share our latest updates, newsletters, and similar communications with you. Please check this box to consent to receiving email communications and acknowldge that you agree to our <a class="contact-link" data-cursor="scale" href="<?php echo esc_attr( esc_url( get_page_link( 3766 ) ) ); ?>" target="_blank">terms of use</a> and <a class="contact-link" data-cursor="scale" href="<?php echo esc_attr( esc_url( get_page_link( 3831 ) ) ); ?>" target="_blank">privacy policy</a>.
                                <input id="contact-terms" class="contact-terms" type="checkbox"/>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    <?php else: ?>
                        <div class="contact-check-inner">
                            <label class="container-checkbox">We are pleased to share our latest updates, newsletters, and similar communications with you. Please check this box to consent to receiving email communications and acknowldge that you agree to our <a class="contact-link" data-cursor="scale" href="<?php echo esc_attr( esc_url( get_page_link( 1236 ) ) ); ?>" target="_blank">terms of use</a> and <a class="contact-link" data-cursor="scale" href="<?php echo esc_attr( esc_url( get_page_link( 3 ) ) ); ?>" target="_blank">privacy policy</a>.
                                <input id="contact-terms" class="contact-terms" type="checkbox"/>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="group">
                <div class="g-recaptcha" data-sitekey="<?php echo $atts['site_key']; ?>"></div>
                <small class="contact-error-msg"><?php echo esc_html__('Robot verification failed, please try again.', 'rhr');?></small>
            </div>
        </div>
        <div class="row ended">
             <button class="button send-message <?php echo $atts['button-class']; ?>" id="<?php echo $atts['button-id']; ?>" data-cursor="scale">
                <span>Send Message</span>
                <div class="arrow svg"></div>
            </button>
            <small class="contact-error-check" id="err-form"><?php echo esc_html__('There was a problem validating the form please check!', 'rhr');?></small>
            <div id="contact-message"></div>
        </div>
    </form>
 <?php }

add_shortcode( 'rhr_contact_form', 'rhr_contact_form_shortoce' );


add_filter( 'wp_mail_from', 'rhr_new_mail_from' );
function rhr_new_mail_from( $old ) {
  $rhr_reset_from_email  = rhr_options( 'rhr_reset_from_email', '' );
    return !empty($rhr_reset_from_email) ? $rhr_reset_from_email : site_url(); // Edit it with your email address
}
