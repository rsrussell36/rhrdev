<?php
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Utils
{
    const __OPTION_KEY__ = '_rhr_settings_';
    static $plugin_path = null;
    static $plugin_url = null;
    protected $path;
    public $settings = null;
    public $avaliable_widgets = [];

    public function rhr__plugin_url($path = '')
    {
        $url = plugins_url( $path, CREST_FILE );

        if ( is_ssl()
        and 'http:' == substr( $url, 0, 5 ) ) {
          $url = 'https:' . substr( $url, 5 );
        }
        return $url;
    }

    public static function rhr__elementor() {
	   return \Elementor\Plugin::instance();
	}

    public static function rhr__version() {
       return CREST_VERSION;
    }
    public function get_view( $path ) {
        return apply_filters( 'rhr/get-view', CREST_PATH . 'admin/views/' . $path . '.php' );
    }
    public static function _get( $setting, $default = false ) {
        $_this = new self;
        if ( null === $_this->settings ) {
            $_this->settings = get_option( $_this->key, [] );
        }
        return isset( $_this->settings[ $setting ] ) ? $_this->settings[ $setting ] : $default;
    }
    public static function _inactive() {
        return get_option( self::__OPTION_KEY__, [] );
    }
    public static function get_enqueue_dependencies(){
        return ['elementor-frontend'];
    }
    public static function rhr_is_true() {
        return true;
    }
    public static function _css_minify($css){
        // Remove comments
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        // Remove remaining whitespace
        $css = str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '), '', $css);
        return $css;
    }
    public static function rhr_title_tag( $title_tag ){
        $title_tag_array = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p' );

        if( in_array( $title_tag, $title_tag_array ) ) {
            return $title_tag;
        }
        else {
            return 'h2';
        }
    }
    public static function rhr_shorten_text($text , $no_of__limit){
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
    public static function rhr_custom_animation()
    {
        return array(
            'no-animation' => esc_html__( 'No Animation', 'rhr' ),
            'rhr__zoomIn' => esc_html__( 'ZoomIn', 'rhr' ),
            'rhr__zoomOut' => esc_html__( 'ZoomOut', 'rhr' ),
            'rhr__stroke' => esc_html__( 'Stroke', 'rhr' ),
            'rhr__arrow-down' => esc_html__( 'Arrow', 'rhr' ),
            'rhr__arrowUp' => esc_html__( 'ArrowUp', 'rhr' ),
            'rhr__arrow-down' => esc_html__( 'Arrow', 'rhr' ),
            'rhr__rotate-cd-1-in' => esc_html__( 'RotateIn', 'rhr' ),
            'rhr__rotate-cd-1-out' => esc_html__( 'RotateOut', 'rhr' ),
            'rhr__rotate-cd-2-in' => esc_html__( 'RotateIn2', 'rhr' ),
            'rhr__rotate-cd-2-out' => esc_html__( 'RotateOut2', 'rhr' ),
            'rhr__rotate-3-in' => esc_html__( 'RotateIn3', 'rhr' ),
            'rhr__rotate-3-out' => esc_html__( 'RotateOut3', 'rhr' ),
            'rhr__scale-up' => esc_html__( 'ScaleUp', 'rhr' ),
            'rhr__scale-down' => esc_html__( 'ScaleDown', 'rhr' ),
            'rhr__push-in' => esc_html__( 'PushIn', 'rhr' ),
            'rhr__push-out' => esc_html__( 'PushOut', 'rhr' ),
            'rhr__push-cd-out' => esc_html__( 'Push Out', 'rhr' ),
        );
    }
    public static function rhr_animate_animation()
    {
        return array(
            'no-animation' => esc_html__( 'No Animation', 'rhr' ),
            'flash' => esc_html__('flash','ausmipious'),
            'pulse' => esc_html__('pulse','ausmipious'),
            'rubberBand' => esc_html__('rubberBand','ausmipious'),
            'shake' => esc_html__('shake','ausmipious'),
            'swing' => esc_html__('swing','ausmipious'),
            'tada' => esc_html__('tada','ausmipious'),
            'wobble' => esc_html__('wobble','ausmipious'),
            'jello' => esc_html__('jello','ausmipious'),
            'bounceIn' => esc_html__('bounceIn','ausmipious'),
            'bounceInDown' => esc_html__('bounceInDown','ausmipious'),
            'bounceInUp' => esc_html__('bounceInUp','ausmipious'),
            'bounceOut' => esc_html__('bounceOut','ausmipious'),
            'bounceOutDown' => esc_html__('bounceOutDown','ausmipious'),
            'bounceOutLeft' => esc_html__('bounceOutLeft','ausmipious'),
            'bounceOutRight' => esc_html__('bounceOutRight','ausmipious'),
            'bounceOutUp' => esc_html__('bounceOutUp','ausmipious'),
            'fadeIn' => esc_html__('fadeIn','ausmipious'),
            'fadeInDown' => esc_html__('fadeInDown','ausmipious'),
            'fadeInDownBig' => esc_html__('fadeInDownBig','ausmipious'),
            'fadeInLeft' => esc_html__('fadeInLeft','ausmipious'),
            'fadeInLeftBig' => esc_html__('fadeInLeftBig','ausmipious'),
            'fadeInRightBig' => esc_html__('fadeInRightBig','ausmipious'),
            'fadeInUp' => esc_html__('fadeInUp','ausmipious'),
            'fadeInUpBig' => esc_html__('fadeInUpBig','ausmipious'),
            'fadeOut' => esc_html__('fadeOut','ausmipious'),
            'fadeOutDown' => esc_html__('fadeOutDown','ausmipious'),
            'fadeOutDownBig' => esc_html__('fadeOutDownBig','ausmipious'),
            'fadeOutLeft' => esc_html__('fadeOutLeft','ausmipious'),
            'fadeOutLeftBig' => esc_html__('fadeOutLeftBig','ausmipious'),
            'fadeOutRightBig' => esc_html__('fadeOutRightBig','ausmipious'),
            'fadeOutUp' => esc_html__('fadeOutUp','ausmipious'),
            'fadeOutUpBig' => esc_html__('fadeOutUpBig','ausmipious'),
            'flip' => esc_html__('flip','ausmipious'),
            'flipInX' => esc_html__('flipInX','ausmipious'),
            'flipInY' => esc_html__('flipInY','ausmipious'),
            'flipOutX' => esc_html__('flipOutX','ausmipious'),
            'flipOutY' => esc_html__('flipOutY','ausmipious'),
            'fadeOutDown' => esc_html__('fadeOutDown','ausmipious'),
            'lightSpeedIn' => esc_html__('lightSpeedIn','ausmipious'),
            'lightSpeedOut' => esc_html__('lightSpeedOut','ausmipious'),
            'rotateIn' => esc_html__('rotateIn','ausmipious'),
            'rotateInDownLeft' => esc_html__('rotateInDownLeft','ausmipious'),
            'rotateInDownRight' => esc_html__('rotateInDownRight','ausmipious'),
            'rotateInUpLeft' => esc_html__('rotateInUpLeft','ausmipious'),
            'rotateInUpRight' => esc_html__('rotateInUpRight','ausmipious'),
            'rotateOut' => esc_html__('rotateOut','ausmipious'),
            'rotateOutDownLeft' => esc_html__('rotateOutDownLeft','ausmipious'),
            'rotateOutDownRight' => esc_html__('rotateOutDownRight','ausmipious'),
            'rotateOutUpLeft' => esc_html__('rotateOutUpLeft','ausmipious'),
            'rotateOutUpRight' => esc_html__('rotateOutUpRight','ausmipious'),
            'slideInUp' => esc_html__('slideInUp','ausmipious'),
            'slideInDown' => esc_html__('slideInDown','ausmipious'),
            'slideInLeft' => esc_html__('slideInLeft','ausmipious'),
            'slideInRight' => esc_html__('slideInRight','ausmipious'),
            'slideOutUp' => esc_html__('slideOutUp','ausmipious'),
            'slideOutDown' => esc_html__('slideOutDown','ausmipious'),
            'slideOutLeft' => esc_html__('slideOutLeft','ausmipious'),
            'slideOutRight' => esc_html__('slideOutRight','ausmipious'),
            'zoomIn' => esc_html__('zoomIn','ausmipious'),
            'zoomInDown' => esc_html__('zoomInDown','ausmipious'),
            'zoomInLeft' => esc_html__('zoomInLeft','ausmipious'),
            'zoomInRight' => esc_html__('zoomInRight','ausmipious'),
            'zoomInUp' => esc_html__('zoomInUp','ausmipious'),
            'zoomOut' => esc_html__('zoomOut','ausmipious'),
            'zoomOutDown' => esc_html__('zoomOutDown','ausmipious'),
            'zoomOutLeft' => esc_html__('zoomOutLeft','ausmipious'),
            'zoomOutUp' => esc_html__('zoomOutUp','ausmipious'),
            'hinge' => esc_html__('hinge','ausmipious'),
            'rollIn' => esc_html__('rollIn','ausmipious'),
            'rollOut' => esc_html__('rollOut','ausmipious')
        );
    }
    public static function rhr_share_network()
    {
        return array(
            'facebook'      => esc_html__( 'Facebook', 'rhr' ),
            'linkedin'      => esc_html__( 'Linkedin', 'rhr' ),
            'twitter'       => esc_html__( 'Twitter', 'rhr' ),
            'instagram'    => esc_html__( 'Instagram', 'rhr' ),
            'odnoklassniki' => esc_html__( 'Odnoklassniki', 'rhr' ),
            'pinterest'     => esc_html__( 'Pinterest', 'rhr' ),
            'tumblr'        => esc_html__( 'Tumblr', 'rhr' ),
            'vkontakte'     => esc_html__( 'Vkontakte', 'rhr' ),
            'moimir'        => esc_html__( 'Moimir', 'rhr' ),
            'flicker'        => esc_html__( 'Flicker', 'rhr' ),
            'evernote'      => esc_html__( 'Evernote', 'rhr' ),
            'reddit'        => esc_html__( 'Reddit', 'rhr' ),
            'snapchat'        => esc_html__( 'Snapchat', 'rhr' ),
            'blogger'       => esc_html__( 'Blogger', 'rhr' ),
            'digg'          => esc_html__( 'Digg', 'rhr' ),
            'live journal'   => esc_html__( 'Live journal', 'rhr' ),
            'delicious'     => esc_html__( 'Delicious', 'rhr' ),
            'surfingbird'   => esc_html__( 'Surfingbird', 'rhr' ),
            'stumbleupon'   => esc_html__( 'Stumbleupon', 'rhr' ),
            'pocket'        => esc_html__( 'Pocket', 'rhr' ),
            'liveinternet'  => esc_html__( 'Liveinternet', 'rhr' ),
            'instapaper'    => esc_html__( 'Instapaper', 'rhr' ),
            'buffer'        => esc_html__( 'Buffer', 'rhr' ),
            'line'          => esc_html__( 'Line', 'rhr' ),
            'wordpress'     => esc_html__( 'WordPress', 'rhr' ),
            'renren'        => esc_html__( 'Renren', 'rhr' ),
            'xing'          => esc_html__( 'Xing', 'rhr' ),
            'weibo'         => esc_html__( 'Weibo', 'rhr' ),
            'baidu'         => esc_html__( 'Baidu', 'rhr' ),
            'telegram'      => esc_html__( 'Telegram', 'rhr' ),
            'viber'         => esc_html__( 'Viber', 'rhr' ),
            'skype'         => esc_html__( 'Skype', 'rhr' ),
            'whatsapp'      => esc_html__( 'Whatsapp', 'rhr' )
        );
    }
    public static function rhr_link( $settings_key, $is_echo = true ) {
        if ( $is_echo == true ) {
            echo !empty($settings_key['url']) ? "href='{$settings_key['url']}'" : '';
            echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
            echo $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
        } else {
            $output = !empty($settings_key['url']) ? "href='{$settings_key['url']}'" : '';
            $output .= $settings_key['is_external'] == true ? 'target="_blank"' : '';
            $output .= $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
            return $output;
        }
    }
    public static function rhr_get_post_types($args = [], $array_diff_key = []){
        $post_type_args = [
            'public' => true,
            'show_in_nav_menus' => true
        ];

        // Keep for backwards compatibility
        if (!empty($args['post_type'])) {
            $post_type_args['name'] = $args['post_type'];
            unset($args['post_type']);
        }

        $post_type_args = wp_parse_args($post_type_args, $args);

        $_post_types = get_post_types($post_type_args, 'objects');

        $post_types = [];
        $post_types = array(
            'by_id'    => __('Manual Selection', 'rhr'),
            'category' => __('Category', 'rhr'),
        );

        foreach ($_post_types as $post_type => $object) {
            $post_types[$post_type] = $object->label;
        }
        if( !empty( $array_diff_key ) ){
            $post_types = array_diff_key( $post_types, $array_diff_key );
        }

        return $post_types;
    }
    public static function rhr_contact7_activated()
    {
        return class_exists('\WPCF7');
    }
    public static function rhr_cf7_list(){
        $cf7_form = array();
        if (self::rhr_contact7_activated()) {
            $cf7_form_list = get_posts(array(
                'post_type' => 'wpcf7_contact_form',
                'showposts' => 999,
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ));
            $cf7_form[0] = esc_html__('Select a Contact Form', 'rhr');
            if (!empty($cf7_form_list) && !is_wp_error($cf7_form_list)) {
                foreach ($cf7_form_list as $post) {
                    $cf7_form[$post->ID] = $post->post_title;
                }
            } else {
                $cf7_form[0] = esc_html__('Create a Form First', 'rhr');
            }
        }
        return $cf7_form;
    }
		public static function rhr_metform_list(){
			 $met_form = array();
					 $met_form_list = get_posts(array(
							 'post_type' => 'metform-form',
							 'showposts' => 999,
							 'post_status'    => 'publish',
							 'posts_per_page' => -1,
							 'orderby'        => 'title',
							 'order'          => 'ASC',
					 ));
					 $met_form[0] = esc_html__('Select a Contact Form', 'rhr');
					 if (!empty($met_form_list) && !is_wp_error($met_form_list)) {
							 foreach ($met_form_list as $post) {
									 $met_form[$post->ID] = $post->post_title;
							 }
					 } else {
							 $met_form[0] = esc_html__('Create a Form First', 'rhr');
					 }
			 return $met_form;
	 }
    public static function get_portfolio_categories()
    {

        $terms = get_terms(
            array(
                'taxonomy' => 'rhr_categories',
                'hide_empty' => true,
            )
        );

        $options = array();

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
        }

        return $options;
    }
    public static function get_blog_categories()
    {

        $terms = get_terms(
            array(
                'taxonomy' => 'category',
                'hide_empty' => true,
            )
        );

        $options = array();

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
        }

        return $options;
    }

public static function rhr_is_shop () {
    if ( function_exists('is_shop') ){
        return is_shop();
    } else {
        return false;
    }
}
public static function rhr_bbp_is_user_home() {
    if ( function_exists('is_bbpress') ){
        return bbp_is_user_home();
    } else {
        return false;
    }
}

public static function rhr_is_product_category () {
    if ( function_exists('is_product_category') ){
        return is_product_category();
    } else {
        return false;
    }
}

public static function rhr_is_product_tag () {
    if ( function_exists('is_product_tag') ){
        return is_product_tag();
    } else {
        return false;
    }
}

public static function rhr_is_product() {
    if ( function_exists('is_product') ){
        return is_product();
    } else {
        return false;
    }
}
public static function _get_taxnomies_object($type){
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
public static function _get_custom_taxnomies($post_type){
    $taxonomy = self::_get_taxnomies_object($post_type);
    if (!empty($taxonomy)) {
        foreach ($taxonomy as $index => $tax) {

            $terms = get_terms($index, array('hide_empty' => false));

            $related_tax = array();

            if (!empty($terms)) {

                foreach ($terms as $t_index => $t_obj) {

                    $related_tax[$t_obj->slug] = $t_obj->name;
                }

                return $related_tax;
            }
        }
    }
}
public static function rhr_navigation_menus($args = [], $array_diff_key = []){
    $menus = wp_get_nav_menus();

        $menu_name = [];
        $menu_name = array(
            '' => __('Select Menu', 'rhr'),
        );

        foreach ($menus as $menu) {
            $menu_name[$menu->term_id] = $menu->name;
        }
        if (!empty($array_diff_key)) {
            $menu_name = array_diff_key($menu_name, $array_diff_key);
        }

        return $menu_name;
}
}
