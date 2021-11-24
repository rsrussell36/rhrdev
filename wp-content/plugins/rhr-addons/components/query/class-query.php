<?php
namespace KC_GLOBAL;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Plugin;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Query{
    public $__new_icon_prefix  = 'selected_';
    protected static $instance;

    public static $page_limit;

    public static $settings;

    public function __construct(){
        add_action('pre_get_posts', array($this, '_get_fix_query_offset'), 1);
        add_filter('found_posts', array($this, '_get_fix_found_posts_query'), 1, 2);

        add_action('wp_ajax_posts_ajax_action', array($this, '_get_ajax__posts'));
        add_action('wp_ajax_nopriv_posts_ajax_action', array($this, '_get_ajax__posts'));
        add_action('wp_enqueue_scripts', [$this, '_get_ajax_url']);
    }

    public function _get_ajax_url(){
        echo '<script> var rhr_ajax_url = "'.admin_url("admin-ajax.php").'";
            var rhr_ajax_nonce = "'.wp_create_nonce("rhr-blog-nonce").'";</script>';
    }
    public static function _get_instance()
    {
        if (!static::$instance) {
            static::$instance = new self();
        }
        return static::$instance;
    }
    public static function _get_registered_taxonomies() {

        $items = array();

        // Get the taxonomies.
        $taxonomies = get_taxonomies(
            array(
                'public' => true,
            )
        );

        // Build the array.
        foreach ( $taxonomies as $taxonomy ) {
            $id           = $taxonomy;
            $taxonomy     = get_taxonomy( $taxonomy );
            $items[ $id ] = $taxonomy->labels->name;
        }

        return $items;
    }
    public static function _get_post_types($args = [], $array_diff_key = [])
    {
        $post_type_args = [
            'public' => true,
            'show_in_nav_menus' => true,
        ];

        if (!empty($args['post_type'])) {
            $post_type_args['name'] = $args['post_type'];
            unset($args['post_type']);
        }

        $post_type_args = wp_parse_args($post_type_args, $args);

        $_post_types = get_post_types($post_type_args, 'objects');

        $post_types = [];
        $post_types = array(
            'by_id' => __('Manual Selection', 'rhr'),
            'by_post_id' => __('By Post Id', 'rhr'),
        );

        foreach ($_post_types as $post_type => $object) {
            $post_types[$post_type] = $object->label;
        }
        if (!empty($array_diff_key)) {
            $post_types = array_diff_key($post_types, $array_diff_key);
        }

        return $post_types;
    }
    public static function _get_post_types_by_id($args = [], $array_diff_key = [])
    {
        $post_type_args = [
            'public' => true,
            'show_in_nav_menus' => true,
        ];

        if (!empty($args['post_type'])) {
            $post_type_args['name'] = $args['post_type'];
            unset($args['post_type']);
        }

        $post_type_args = wp_parse_args($post_type_args, $args);

        $_post_types = get_post_types($post_type_args, 'objects');

        $post_types = [];
        foreach ($_post_types as $post_type => $object) {
            $post_types[$post_type] = $object->label;
        }
        if (!empty($array_diff_key)) {
            $post_types = array_diff_key($post_types, $array_diff_key);
        }

        return $post_types;
    }
    public static function _get_taxnomies($type)
    {

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
    public static function _get_authors()
    {
        $users = get_users();

        $options = array();

        if (!empty($users) && !is_wp_error($users)) {
            foreach ($users as $user) {
                if ('wp_update_service' !== $user->display_name) {
                    $options[$user->ID] = $user->display_name;
                }
            }
        }

        return $options;
    }
    public static function _get_tags()
    {
        $tags = get_tags();

        $options = array();

        if (!empty($tags) && !is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $options[$tag->term_id] = $tag->name;
            }
        }

        return $options;
    }
    public static function _get_posts_list()
    {

        $list = get_posts(
            array(
                'post_type' => 'post',
                'posts_per_page' => -1,
            )
        );

        $options = array();

        if (!empty($list) && !is_wp_error($list)) {
            foreach ($list as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }

        return $options;
    }
    public static function _get_only_post_types($args = [], $array_diff_key = [])
    {
        $post_types = get_post_types(
            array(
                'public' => true,
            ),
            'objects'
        );

        $options = array();

        foreach ($post_types as $key => $post_type) {

            if($post_type->name == 'page' || $post_type->name == 'e-landing-page' || $post_type->name == 'elementor_library'){
                $options[] = 'rhr';
            }else{
                $options[] = $post_type->name;
            }
        }

        return $options;
    }
    public static function _get_manual_posts_lists()
    {
        $list = get_posts(
            array(
                'post_type' => self::_get_only_post_types(),
                'posts_per_page' => -1,
            )
        );

        $options = array();

        if (!empty($list) && !is_wp_error($list)) {
            foreach ($list as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }

        return $options;
    }

    public function _get_query_args()
    {

        $settings = self::$settings;

        $paged = self::get_paged();
        $tax_count = 0;

        $post_type = $settings['_rhr_query_filter'];

        $post_args = array(
            'post_status' => 'publish',
            'paged' => $paged,
            'suppress_filters' => false,
        );
        if ( !empty($post_type) && 'by_id' !== $post_type && 'by_post_id' !== $post_type ) {
            $post_types = array(
                'post_type' => $post_type
            );
            $post_args = wp_parse_args($post_args, $post_types);
        }
        if ( !empty($post_type) && 'by_post_id' === $post_type ) {
            if (!empty($settings['_rhr_blog_posts_id'])) {
                $post__in = array(
                    'post_type' => $settings['_rhr_by_id_posttype'],
                     'orderby'                => 'post__in',
                    'post__in' => explode( ',', $settings['_rhr_blog_posts_id'] ),
                );
                $post_args = wp_parse_args($post_args, $post__in);
            }
        }
        if ( !empty($post_type) && 'by_id' === $post_type ) {
            if (!empty($settings['_rhr_blog_include_posts'])) {
                $post__in = array(
                    'post_type' => $settings['_rhr_by_id_posttype'],
                     'orderby'                => 'post__in',
                    'post__in' => $settings['_rhr_blog_include_posts'],
                );
                $post_args = wp_parse_args($post_args, $post__in);
            }
            if (!empty($settings['_rhr_blog_exclude_posts'])) {
                $post__not_in = array(
                    'post__not_in' => $settings['_rhr_blog_exclude_posts'],
                );
                $post_args = wp_parse_args($post_args, $post__not_in);
            }
        }
        if (!empty($settings['_rhr_blog_order_by_type']) && $settings['_rhr_blog_order_by_type'] == 'alphabetically' && 'by_id' !== $post_type && 'by_post_id' !== $post_type ) {
            $orderby = array(
                'orderby' => array( 'title' => 'ASC', 'menu_order' => 'ASC' ),
            );
            $post_args = wp_parse_args($post_args, $orderby);
        }else{
            if (!empty($settings['_rhr_blog_order_by']) && 'by_id' !== $post_type && 'by_post_id' !== $post_type ) {
                $orderby = array(
                    'orderby' => $settings['_rhr_blog_order_by'],
                );
                $post_args = wp_parse_args($post_args, $orderby);
            }
        }
        if (!empty($settings['_rhr_blog_order']) && 'by_id' !== $post_type && 'by_post_id' !== $post_type) {
            $order = array(
                'order' => $settings['_rhr_blog_order'],
            );
            $post_args = wp_parse_args($post_args, $order);
        }
        if ( !empty($post_type) && 'by_id' !== $post_type && 'by_post_id' !== $post_type ) {
            if ('yes' == $settings['_rhr_blog_ignore_sticky_posts']) {
                $ignore_sticky = array(
                    'ignore_sticky_posts' => 1,
                );
                $post_args = wp_parse_args($post_args, $ignore_sticky);
            } else {
                $ignore_sticky = array(
                    'ignore_sticky_posts' => 0,
                );
                $post_args = wp_parse_args($post_args, $ignore_sticky);
            }
        }
        if ( !empty($post_type) && 'by_id' !== $post_type && 'by_post_id' !== $post_type ) {
            $posts_per_page = array(
                'posts_per_page' => empty($settings['_rhr_blog_posts_per_page']) ? 9999 : $settings['_rhr_blog_posts_per_page'],
            );
            $post_args = wp_parse_args($post_args, $posts_per_page);
        }

        if (!empty($settings['_rhr_blog_include_authors']) && 'by_id' !== $post_type && 'by_post_id' !== $post_type) {
            $author__in = array(
                'author__in' => $settings['_rhr_blog_include_authors'],
            );
            $post_args = wp_parse_args($post_args, $author__in);
        }
        if (!empty($settings['_rhr_blog_exclude_authors']) && 'by_id' !== $post_type && 'by_post_id' !== $post_type) {
            $author__not_in = array(
                'author__not_in' => $settings['_rhr_blog_exclude_authors'],
            );
            $post_args = wp_parse_args($post_args, $author__not_in);
        }
        if (0 < $settings['_rhr_blog_post_offset'] && 'by_id' !== $post_type && 'by_post_id' !== $post_type) {
            $offset_to_fix = array(
                'offset_to_fix' => $settings['_rhr_blog_post_offset'],
            );
            $post_args = wp_parse_args($post_args, $offset_to_fix);
        }
        if ( !empty($post_type) && 'by_id' !== $post_type && 'by_post_id' !== $post_type ) {
            $taxonomy = self::_get_taxnomies($post_type);

            if (!empty($taxonomy) && !is_wp_error($taxonomy)) {

                $tax_count = 0;
                foreach ($taxonomy as $index => $tax) {

                    if (!empty($settings['tax_' . $index . '_' . $post_type . '_include'])) {

                        $tax_query[] = array(
                            'taxonomy' => $index,
                            'field' => 'slug',
                            'terms' => $settings['tax_' . $index . '_' . $post_type . '_include'],
                            'operator' => 'IN',
                        );
                        $tax_count++;
                    }
                }
            }
            if (!empty($taxonomy) && !is_wp_error($taxonomy)) {

                $tax_count = 0;
                foreach ($taxonomy as $index => $tax) {

                    if (!empty($settings['tax_' . $index . '_' . $post_type . '_exclude'])) {

                        $tax_query[] = array(
                            'taxonomy' => $index,
                            'field' => 'slug',
                            'terms' => $settings['tax_' . $index . '_' . $post_type . '_exclude'],
                            'operator' => 'NOT IN',
                        );
                        $tax_count++;
                    }
                }
            }
            // if (!empty($tax_query)) {
            //     $tax_query = wp_parse_args(array('relation' => 'AND'), $tax_query);
            //     $post_args = wp_parse_args($post_args, array('tax_query' => $tax_query));
            // }
        }
        if ( '' !== $settings['active_cat'] && '*' !== $settings['active_cat'] ) {

            $filter_type = $settings['_rhr_tab_filter_from'];

            if ( 'tag' === $settings['_rhr_tab_filter_from'] ) {
                $filter_type = 'post_tag';
            }

            $post_args['tax_query'][0]['taxonomy'] = $filter_type;
            $post_args['tax_query'][0]['field']    = 'slug';
            $post_args['tax_query'][0]['terms']    = $settings['active_cat'];
            $post_args['tax_query'][0]['operator'] = 'IN';
        }
        if ( !empty($post_type) && 'by_id' !== $post_type && 'by_post_id' !== $post_type ) {
        $select_date = $settings['_rhr_blog_post_custom_date'];
            if (!empty($select_date)) {
                $date_query = [];
                switch ($select_date) {
                    case 'today':
                        $date_query['after'] = '-1 day';
                        break;
                    case 'week':
                        $date_query['after'] = '-1 week';
                        break;
                    case 'month':
                        $date_query['after'] = '-1 month';
                        break;
                    case 'quarter':
                        $date_query['after'] = '-3 month';
                        break;
                    case 'year':
                        $date_query['after'] = '-1 year';
                        break;
                    case 'exact':
                        $after_date = $settings['_rhr_blog_post_date_after'];
                        if (!empty($after_date)) {
                            $date_query['after'] = $after_date;
                        }
                        $before_date = $settings['_rhr_blog_post_before_date'];
                        if (!empty($before_date)) {
                            $date_query['before'] = $before_date;
                        }
                        $date_query['inclusive'] = true;
                        break;
                }
                $query_by_date = array(
                    'date_query' => $date_query
                );

                $post_args = wp_parse_args( $post_args, $query_by_date );
            }
        }
        if ( 'yes' === $settings['_rhr_post_query_exclude_current'] ) {
            $post_args['post__not_in'][] = get_the_id();
        }
        return $post_args;
    }
    public function _get_ajax__posts()
    {

        check_ajax_referer('rhr-blog-nonce', 'nonce');

        if (!isset($_POST['page_id']) || !isset($_POST['widget_id'])) {
            return;
        }

        $doc_id = isset($_POST['page_id']) ? sanitize_text_field($_POST['page_id']) : '';
        $elem_id = isset($_POST['widget_id']) ? sanitize_text_field($_POST['widget_id']) : '';
        $active_cat = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';

        $elementor = Plugin::$instance;
        $meta = $elementor->documents->get($doc_id)->get_elements_data();

        $widget_data = $this->_get_element_recursive($meta, $elem_id);

        $data = array(
            'ID' => '',
            'posts' => '',
            'paging' => '',
        );

        if (null !== $widget_data) {

            $widget = $elementor->elements_manager->create_element_instance($widget_data);

            $posts = $this->_get_inner_render($widget, $active_cat);

            $pagination = $this->_get_inner_pagination_render();

            $data['ID'] = $widget->get_id();
            $data['posts'] = $posts;
            $data['paging'] = $pagination;
        }

        wp_send_json_success($data);

    }
    public static function get_paged()
    {

        global $wp_the_query, $paged;

        if (isset($_POST['page_number']) && '' !== $_POST['page_number']) {
            return $_POST['page_number'];
        }

        // Check the 'paged' query var.
        $paged_qv = $wp_the_query->get('paged');

        if (is_numeric($paged_qv)) {
            return $paged_qv;
        }

        // Check the 'page' query var.
        $page_qv = $wp_the_query->get('page');

        if (is_numeric($page_qv)) {
            return $page_qv;
        }

        // Check the $paged global?
        if (is_numeric($paged)) {
            return $paged;
        }

        return 0;
    }
    public function set_widget_settings($settings, $active_cat = '' )
    {
        $settings['active_cat'] = $active_cat;
        self::$settings = $settings;
    }
    public function set_pagination_limit($pages)
    {
        self::$page_limit = $pages;
    }
    public function _get_render_pagination()
    {

        $settings = self::$settings;

        $pages = self::$page_limit;

        if (!empty($settings['_rhr_blog_max_pages'])) {
            $pages = min($settings['_rhr_blog_max_pages'], $pages);
        }

        $paged = $this->get_paged();

        $current_page = $paged;
        if (!$current_page) {
            $current_page = 1;
        }
         $next_img = CREST_IMAGE . '/next_arrow.png';
        $prev_img = CREST_IMAGE . '/previous_arrow.png';
        $next_current_img = isset($settings['_rhr_pag_next_text_img']) && !empty($settings['_rhr_pag_next_text_img']['url']) ? $settings['_rhr_pag_next_text_img']['url'] : $next_img;
        $prev_current_img = isset($settings['_rhr_pag_prev_text_img']) && !empty($settings['_rhr_pag_prev_text_img']['url']) ? $settings['_rhr_pag_prev_text_img']['url'] : $prev_img;
        $nav_links = paginate_links(
            array(
                'current' => $current_page,
                'total' => $pages,
                'prev_next' => 'yes' === $settings['_rhr_blog_pag_strings'] ? true : false,
                'prev_text' => sprintf('<img src="%s" alt="prev">', $prev_current_img),
                'next_text' => sprintf('<img src="%s" alt="next">', $next_current_img),
                'type' => 'array',
            )
        );

        ?>
        <nav class="rhr-pagination-wrapper" role="navigation" aria-label="<?php echo esc_attr(__('Pagination', 'rhr')); ?>">
          <?php
              if($pages > 1){
                  echo wp_kses_post(implode(PHP_EOL, $nav_links));
              }else{
                  echo wp_kses_post($nav_links);
              }
           ?>
        </nav>
        <?php
}
    public function _get_inner_pagination_render()
    {

        ob_start();

        $this->_get_render_pagination();

        return ob_get_clean();

    }
    public function _get_grid_query()
    {

        $post_args = $this->_get_query_args();

        $defaults = array(
            'author' => '',
            'category' => '',
            'orderby' => '',

        );

        $query_args = wp_parse_args($post_args, $defaults);

        $query = new \WP_Query($query_args);

        $total_pages = $query->max_num_pages;

        $this->set_pagination_limit($total_pages);

        return $query;
    }
    protected function _get_post_title()
    {
        $settings = self::$settings;
        if ( ! $settings['show_title'] ) {
            return;
        }
        $title_text = '';
        if (!empty($settings['_rhr_title_length'])) {
            echo $title_text = $this->_get_shorten_text(get_the_title(), $settings['_rhr_title_length'], false);
        } else {
            echo $title_text = get_the_title();
        }
    }
    protected function _get_single_category( $link = false )
    {
        $settings = self::$settings;
        if ( ! $settings['show_cat'] ) {
            return;
        }
        $categories = get_the_category();
        if(!empty($categories)){
            echo '<div class="type post--cat">';
            if(true === $link){
                echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">';
            }
                echo esc_html($categories[0]->cat_name);
            if(true === $link){
                echo '</a>';
            }
            echo '</div>';
        }


    }
    protected function _get_multiple_category()
    {
        $settings = self::$settings;
        if ( ! $settings['show_cat'] ) {
            return;
        }
        $categories = get_the_category();
        if(!empty($categories)){
            foreach($categories as $cat) {
                echo esc_html($cat->cat_name);
            }
        }

    }
    protected function _get_single_custom_category( $tasonomy, $link = false )
    {
        $settings = self::$settings;
        if ( ! $settings['show_cat'] ) {
            return;
        }
        $categories = get_the_terms( get_the_ID() , $tasonomy );
        if(!empty($categories)){
            if(true === $link){
                echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">';
            }
                echo esc_html($categories[0]->name);
            if(true === $link){
                echo '</a>';
            }
        }

    }
    protected function _get_time_ago( $datetime, $full = false ) {
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

    public function _get_grid_layout()
    {
        $settings = self::$settings;
        $total = self::$page_limit;
        $image_effect = $settings['_rhr_thumb_animation'];
        $post_id = get_the_ID();

        $widget_id = isset($settings['widget_id']) ? $settings['widget_id'] : '';

        $key = sprintf( 'post_%s_%s', $widget_id, $post_id );

        $tax_key = sprintf( '%s_tax', $key );

        $this->add_render_attribute(
            $tax_key,
            array(
                'class'      => 'rhr_blog_item ' .esc_attr('thumbnail-' . $image_effect),
                'data-total' => $total,
            )
        );
        if(!empty($settings['_rhr_blog_tab_animation_content']) && $settings['_rhr_blog_tab_animation_content'] != 'no-animation'){
            $this->add_render_attribute(
                $tax_key,
                array(
                    'class'      => 'rhr-animation',
                    'data-trans' => $settings['_rhr_blog_tab_animation_content'],
                    'data-duration' => $settings['animation_speed_content']."ms",
                    'data-delay' => $settings['animation_delay_content']
                )
            );
        }
        if(
            $settings['_rhr_design'] === 'default'
            ||
            $settings['_rhr_design'] === 'design-1'
            || $settings['_rhr_design'] === 'design-2'
            || $settings['_rhr_design'] === 'design-3'
            || $settings['_rhr_design'] === 'design-4'
            || $settings['_rhr_design'] === 'design-5'
            || $settings['_rhr_design'] === 'design-7'
        ){
            $this->add_render_attribute(
                $tax_key,
                array(
                    'class'      => 'item',
                )
            );
        }
        if( $settings['_rhr_design'] === 'design-6' ){
            $this->add_render_attribute(
                $tax_key,
                array(
                    'class'      => 'people',
                )
            );
        }
        if ( 'yes' === $settings['show_tab_filter'] ) {

            $filter_rule = $settings['_rhr_tab_filter_from'];

            $taxonomies = 'category' === $filter_rule ? get_the_category( $post_id ) : get_the_tags( $post_id );

            if ( ! empty( $taxonomies ) ) {
                foreach ( $taxonomies as $index => $taxonomy ) {

                    $taxonomy_key = 'category' === $filter_rule ? $taxonomy->slug : $taxonomy->name;

                    $attr_key = str_replace( ' ', '-', $taxonomy_key );

                    $this->add_render_attribute( $tax_key, 'class', strtolower( $attr_key ) );
                }
            }
        }
        ?>
        <?php if( $settings['_rhr_design'] === 'default' ) : ?>

            <div <?php echo wp_kses_post( $this->get_render_attribute_string( $tax_key ) ); ?>>
                <div class="wrapper">
                <a data-cursor="scale" href="<?php the_permalink();?>">
                <?php
                        if ( 'yes' === $settings['show_thumb'] ):
                                $width = 288;
                                $height = 300;

                                $image_id = get_post_thumbnail_id();

                                $img_attr = array(
                                    'image_id'    => $image_id,
                                    'image_tag'   => true,
                                    'placeholder' => true,
                                    'width'       => $width,
                                    'height'      => $height,
                                    'id'      => '',
                                    'class'      => '',
                                    'srcset'      => array(
                                        '1024' => array( $width, $height ),
                                        '991'  => array( 991, 460 ),
                                        '768'  => array( 768, 400 ),
                                        '480'  => array( 480, 360 ),
                                        '320'  => array( 320, 260 )
                                    )
                                );
                            echo rhr_get_image( $img_attr );
                        endif;
                     ?>
                     </a>
                    <div class="infos">
                        <?php if( 'yes' === $settings['show_cat'] ) : ?>
                            <?php $this->_get_single_category(true); ?>
                        <?php endif; ?>
                        <?php if( 'yes' === $settings['show_time'] ) : ?>
                            <span class="time post--time"><?php $this->_get_time_ago(get_the_time( get_option('date_format') )); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if( 'yes' === $settings['show_title'] ) : ?>
                        <div class="r-title post--title"><a data-cursor="scale" href="<?php the_permalink();?>"><?php $this->_get_post_title(); ?> </a></div>
                    <?php endif; ?>

                </div>
                    </div>
            <?php elseif($settings['_rhr_design'] === 'design-1' ) : ?>
                <div <?php echo wp_kses_post( $this->get_render_attribute_string( $tax_key ) ); ?>>
                <div class="wrapper">
                <a data-cursor="scale" href="<?php the_permalink();?>">
                    <?php
                        if ( 'yes' === $settings['show_thumb'] ):
                                $width = 288;
                                $height = 300;

                                $image_id = get_post_thumbnail_id();

                                $img_attr = array(
                                    'image_id'    => $image_id,
                                    'image_tag'   => true,
                                    'placeholder' => true,
                                    'width'       => $width,
                                    'height'      => $height,
                                    'id'      => '',
                                    'class'      => '',
                                    'srcset'      => array(
                                        '1024' => array( $width, $height ),
                                        '991'  => array( 991, 460 ),
                                        '768'  => array( 768, 400 ),
                                        '480'  => array( 480, 360 ),
                                        '320'  => array( 320, 260 )
                                    )
                                );
                            echo rhr_get_image( $img_attr );
                        endif;
                     ?>
                    </a>
                    <div class="infos">
                        <?php if( 'yes' === $settings['show_cat'] ) : ?>
                            <?php $this->_get_single_category(true); ?>
                        <?php endif; ?>
                        <?php if( 'yes' === $settings['show_time'] ) : ?>
                            <span class="time post--time"><?php $this->_get_time_ago(get_the_time( get_option('date_format') )); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if( 'yes' === $settings['show_title'] ) : ?>
                        <div class="r-title post--title"><a data-cursor="scale" href="<?php the_permalink();?>"><?php $this->_get_post_title(); ?></a></div>
                    <?php endif; ?>

                </div>
                    </div>
            <?php elseif($settings['_rhr_design'] === 'design-2' ) : ?>
                <div <?php echo wp_kses_post( $this->get_render_attribute_string( $tax_key ) ); ?>>
                <a data-cursor="scale" href="<?php the_permalink();?>">
                <?php
                        if ( 'yes' === $settings['show_thumb'] ):
                                $width = 1152;
                                $height = 550;

                                $image_id = get_post_thumbnail_id();

                                $img_attr = array(
                                    'image_id'    => $image_id,
                                    'image_tag'   => true,
                                    'placeholder' => true,
                                    'width'       => $width,
                                    'height'      => $height,
                                    'id'      => '',
                                    'class'      => '',
                                    'srcset'      => array(
                                        '1024' => array( $width, $height ),
                                        '991'  => array( 991, 460 ),
                                        '768'  => array( 768, 400 ),
                                        '480'  => array( 480, 360 ),
                                        '320'  => array( 320, 260 )
                                    )
                                );
                            echo rhr_get_image( $img_attr );
                        endif;
                     ?>
                     </a>
                    <?php if( 'yes' === $settings['show_cat'] ) : ?>
                        <div class="name post--cat"><?php $this->_get_single_custom_category('rhr_client_cases_categories' ,false); ?></div>
                    <?php endif; ?>
                    <?php if( 'yes' === $settings['show_title'] ) : ?>
                        <div class="s-title post--title"><a data-cursor="scale" href="<?php the_permalink();?>"><?php $this->_get_post_title(); ?></a></div>
                    <?php endif; ?>

                    </div>
            <?php elseif($settings['_rhr_design'] === 'design-3' ) : ?>
                <div <?php echo wp_kses_post( $this->get_render_attribute_string( $tax_key ) ); ?>>
                     <div class="wrapper">
                     <a data-cursor="scale" href="<?php the_permalink();?>">
                     <?php
                        if ( 'yes' === $settings['show_thumb'] ):
                          $width = 432;
                          $height = 433;

                                $image_id = get_post_thumbnail_id();

                                $img_attr = array(
                                    'image_id'    => $image_id,
                                    'image_tag'   => true,
                                    'placeholder' => true,
                                    'width'       => $width,
                                    'height'      => $height,
                                    'id'      => '',
                                    'class'      => '',
                                    'srcset'      => array(
                                        '1024' => array( $width, $height ),
                                        '991'  => array( 991, 460 ),
                                        '768'  => array( 768, 400 ),
                                        '480'  => array( 480, 360 ),
                                        '320'  => array( 320, 260 )
                                    )
                                );
                            echo rhr_get_image( $img_attr );
                        endif;
                     ?>
                        <div class="infos">
                            <?php if( 'yes' === $settings['show_time'] ) : ?>
                                <span class="date post--time"><?php $this->_get_time_ago(get_the_time( get_option('date_format') )); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if( 'yes' === $settings['show_title'] ) : ?>
                            <div class="r-title post--title"> <a data-cursor="scale" href="<?php the_permalink();?>"><?php $this->_get_post_title(); ?></a></div>
                        <?php endif; ?>
                        </a>
                    </div>
                        </div>
                <?php elseif($settings['_rhr_design'] === 'design-4' ) : ?>
                    <div <?php echo wp_kses_post( $this->get_render_attribute_string( $tax_key ) ); ?>>
                         <div class="wrapper">
                             <a data-cursor="scale" href="<?php the_permalink();?>">
                         <?php
                        if ( 'yes' === $settings['show_thumb'] ):
                                $width = 288;
                                $height = 300;

                                $image_id = get_post_thumbnail_id();

                                $img_attr = array(
                                    'image_id'    => $image_id,
                                    'image_tag'   => true,
                                    'placeholder' => true,
                                    'width'       => $width,
                                    'height'      => $height,
                                    'id'      => '',
                                    'class'      => '',
                                    'srcset'      => array(
                                        '1024' => array( $width, $height ),
                                        '991'  => array( 991, 460 ),
                                        '768'  => array( 768, 400 ),
                                        '480'  => array( 480, 360 ),
                                        '320'  => array( 320, 260 )
                                    )
                                );
                            echo rhr_get_image( $img_attr );
                        endif;
                     ?>
                            <div class="infos">
                                <?php if( 'yes' === $settings['show_time'] ) : ?>
                                    <span class="date post--time"><?php $this->_get_time_ago(get_the_time( get_option('date_format') )); ?></span>
                                <?php endif; ?>
                                <?php if( 'yes' === $settings['show_title'] ) : ?>
                                    <div class="r-title post--title"><a data-cursor="scale" href="<?php the_permalink();?>"><?php $this->_get_post_title(); ?></a></div>
                                <?php endif; ?>
                            </div>
                                </a>
                        </div>
                                </div>
                <?php elseif($settings['_rhr_design'] === 'design-5' ) :
                     $featured_image = rhr_get_meta_value( get_the_id(), '_rhr_featured_image' );
                 ?>
                    <div href="<?php the_permalink();?>" <?php echo wp_kses_post( $this->get_render_attribute_string( $tax_key ) ); ?>>
                         <div class="wrapper ">
                         <a data-cursor="scale" href="<?php the_permalink();?>">
                            <?php
                                if(isset($featured_image) && $featured_image != 'hide'){
                                    if ( 'yes' === $settings['show_thumb'] ):
                                            $width = 288;
                                            $height = 430;

                                            $image_id = get_post_thumbnail_id();

                                            $img_attr = array(
                                                'image_id'    => $image_id,
                                                'image_tag'   => true,
                                                'placeholder' => true,
                                                'width'       => $width,
                                                'height'      => $height,
                                                'id'      => '',
                                                'class'      => '',
                                                'srcset'      => array(
                                                    '1024' => array( $width, $height ),
                                                    '991'  => array( 991, 460 ),
                                                    '768'  => array( 768, 400 ),
                                                    '480'  => array( 480, 360 ),
                                                    '320'  => array( 320, 260 )
                                                )
                                            );
                                        echo rhr_get_image( $img_attr );
                                    endif;
                                }
                            ?>
                                <?php if( 'yes' === $settings['show_title'] ) : ?>
                                    <div class="r-title post--title"> <a data-cursor="scale" href="<?php the_permalink();?>"><?php $this->_get_post_title(); ?></a></div>
                                <?php endif; ?>
                                </a>
                        </div>
                                </div>
                    <?php elseif($settings['_rhr_design'] === 'design-6' ) :
                        $desig = rhr_get_meta_value( get_the_id(), '_rhr_desig' );
                        ?>
                        <div <?php echo wp_kses_post( $this->get_render_attribute_string( $tax_key ) ); ?>>


                        <?php if ( 'yes' === $settings['show_thumb'] ): ?>
                            <a data-cursor="scale" href="<?php the_permalink();?>">
                        <?php
                                $width = 432;
                                $height = 560;

                                $image_id = get_post_thumbnail_id();

                                $img_attr = array(
                                    'image_id'    => $image_id,
                                    'image_tag'   => true,
                                    'placeholder' => true,
                                    'width'       => $width,
                                    'height'      => $height,
                                    'id'      => '',
                                    'class'      => '',
                                    'srcset'      => array(
                                        '1024' => array( $width, $height ),
                                        '991'  => array( 991, 460 ),
                                        '768'  => array( 768, 400 ),
                                        '480'  => array( 480, 360 ),
                                        '320'  => array( 320, 260 )
                                    )
                                ); ?>
                                <div class="photo">
                                    <?php  echo rhr_get_profile_image( $img_attr );  ?>
                                </div>
                            </a>
                        <?php endif;?>

                                <?php if( 'yes' === $settings['show_title'] ) : ?>
                                    <div class="name"><a data-cursor="scale" href="<?php the_permalink();?>"><?php $this->_get_post_title(); ?></a></div>
                                <?php endif; ?>
                                <?php if(isset($desig) && !empty($desig)): ?>
                                    <div class="occupation"><a data-cursor="scale" href="<?php the_permalink();?>"><?php echo esc_attr($desig); ?></a></div>
                                <?php endif; ?>

                                </div>
                        <?php elseif($settings['_rhr_design'] === 'design-7' ) : ?>
                            <div <?php echo wp_kses_post( $this->get_render_attribute_string( $tax_key ) ); ?>>
                                <div class="wrapper">
                                <a data-cursor="scale" href="<?php the_permalink();?>">
                                <?php
                                    if ( 'yes' === $settings['show_thumb'] ):
                                      $width = 432;
                                      $height = 240;

                                            $image_id = get_post_thumbnail_id();

                                            $img_attr = array(
                                                'image_id'    => $image_id,
                                                'image_tag'   => true,
                                                'placeholder' => true,
                                                'width'       => $width,
                                                'height'      => $height,
                                                'id'      => '',
                                                'class'      => '',
                                                'srcset'      => array(
                                                    '1024' => array( $width, $height ),
                                                    '991'  => array( 991, 460 ),
                                                    '768'  => array( 768, 400 ),
                                                    '480'  => array( 480, 360 ),
                                                    '320'  => array( 320, 260 )
                                                )
                                            );
                                        echo rhr_get_image( $img_attr );
                                    endif;
                                ?>
                                    <div class="infos">
                                      <div class="webinars-meta">
                                      <?php if( 'yes' === $settings['show_cat'] ) : ?>
                                          <div class="type post--cat"><?php $this->_get_single_custom_category('rhr_webinar_categories' ,false); ?></div>
                                      <?php endif; ?>
                                      <?php if( 'yes' === $settings['show_time'] ) : ?>
                                          <div class="date post--time"><?php echo get_the_time( get_option('date_format')); ?></div>
                                      <?php endif; ?>
                                      </div>
                                        <?php if( 'yes' === $settings['show_title'] ) : ?>
                                            <div class="p-title post--title"> <a data-cursor="scale" href="<?php the_permalink();?>"><?php $this->_get_post_title(); ?></a></div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                </div>
                            </div>
            <?php endif; ?>
    <?php
    }

    public function _get_layout()
    {

        $query = $this->_get_grid_query();

        $posts = $query->posts;

        if (count($posts)) {
            global $post;

            foreach ($posts as $post) {
                setup_postdata($post);
                $this->_get_grid_layout();
            }
        }

        wp_reset_postdata();

    }
    protected function get_filter_array( $filter ) {

        $settings = self::$settings;

        $post_type = $settings['_rhr_query_filter'];

        if ( 'tag' === $filter ) {
            $filter = 'post_tag';
        }

        $filter_include = isset( $settings[ 'tax_' . $filter . '_' . $post_type . '_include' ] ) ? $settings[ 'tax_' . $filter . '_' . $post_type . '_include' ] : '';

        $filters_exclude = isset( $settings[ 'tax_' . $filter . '_' . $post_type . '_exclude' ] ) ? $settings[ 'tax_' . $filter . '_' . $post_type . '_exclude' ] : '';
        if(!empty($filter_include)){

            $filters = array_diff($filter_include, $filters_exclude);
        }

        // Get the categories based on filter source.
        $taxs = get_terms( $filter );

        $tabs_array = [];

        if ( is_wp_error( $taxs ) ) {
            return [];
        }
        foreach ( $taxs as $key => $value ) {
            if(!empty($filter_include)){
                if ( in_array( $value->slug, $filters, true ) ) {

                    $tabs_array[] = $value;
                }
            }else{
                if(!empty($filters_exclude)){
                    if (! in_array( $value->slug, $filters_exclude, true ) ) {

                        $tabs_array[] = $value;
                    }
                }else{
                    $tabs_array = $taxs;
                }
            }
        }
        return $tabs_array;
    }
    public function get_filter_tabs_markup() {

        $settings = self::$settings;

        $filter_rule = $settings['_rhr_tab_filter_from'];

        $filters = $this->get_filter_array( $filter_rule );
        if ( empty( $filters ) ) {
            return;
        }

        ?>
        <div class="row justify-content-center">
            <div class="col col-10">
                <div class="filter tab-slider">
                    <div class="items tab-slider-ietms">
                    <?php if(isset($settings['_rhr_tab_filter_label']) && !empty($settings['_rhr_tab_filter_label'])): ?>
                            <a href="javascript:;" data-cursor="scale" data-filter="*" class="item rhr-filter category active"><span><?php echo esc_html( $settings['_rhr_tab_filter_label'] ); ?></span></a>
                        <?php endif; ?>
                        <?php
                            foreach ( $filters as $index => $filter ) {
                                    $key = 'blog_category_' . $index;

                                    $this->add_render_attribute( $key, 'class', 'item rhr-filter category' );

                                if ( empty( $settings['_rhr_tab_filter_label'] ) && 0 === $index ) {
                                    $this->add_render_attribute( $key, 'class', 'active' );
                                }
                                ?>
                                <a href="javascript:;" <?php echo wp_kses_post( $this->get_render_attribute_string( $key ) ); ?> data-filter="<?php echo esc_attr( $filter->slug ); ?>" data-cursor="scale"><span><?php echo wp_kses_post( $filter->name ); ?></span></a>

                            <?php } ?>
                    </div>
                    <div class="items">
                      <input type="hidden" class="search-post-type" value="<?php echo esc_html($settings['_rhr_query_filter']);?>">
                        <div class="item i-search" data-cursor="scale"><span class="svg"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public function _get_inner_render($widget, $active_cat)
    {

        ob_start();

        $settings = $widget->get_settings();

        $this->set_widget_settings($settings, $active_cat);

        $this->_get_layout();

        return ob_get_clean();
    }
    public function _get_element_recursive($elements, $id)
    {

        foreach ($elements as $element) {
            if ($id === $element['id']) {
                return $element;
            }

            if (!empty($element['elements'])) {
                $element = $this->_get_element_recursive($element['elements'], $id);

                if ($element) {
                    return $element;
                }
            }
        }

        return false;
    }
    public function _get_fix_query_offset(&$query)
    {

        if (!empty($query->query_vars['offset_to_fix'])) {
            if ($query->is_paged) {
                $query->query_vars['offset'] = $query->query_vars['offset_to_fix'] + (($query->query_vars['paged'] - 1) * $query->query_vars['posts_per_page']);
            } else {
                $query->query_vars['offset'] = $query->query_vars['offset_to_fix'];
            }
        }
    }
    public function _get_fix_found_posts_query($found_posts, $query)
    {

        $offset_to_fix = $query->get('offset_to_fix');

        if ($offset_to_fix) {
            $found_posts -= $offset_to_fix;
        }

        return $found_posts;
    }
    public function add_render_attribute($element, $key = null, $value = null, $overwrite = false)
    {
        if (is_array($element)) {
            foreach ($element as $element_key => $attributes) {
                $this->add_render_attribute($element_key, $attributes, null, $overwrite);
            }

            return $this;
        }

        if (is_array($key)) {
            foreach ($key as $attribute_key => $attributes) {
                $this->add_render_attribute($element, $attribute_key, $attributes, $overwrite);
            }

            return $this;
        }

        if (empty($this->_render_attributes[$element][$key])) {
            $this->_render_attributes[$element][$key] = array();
        }

        settype($value, 'array');

        if ($overwrite) {
            $this->_render_attributes[$element][$key] = $value;
        } else {
            $this->_render_attributes[$element][$key] = array_merge($this->_render_attributes[$element][$key], $value);
        }

        return $this;
    }
    public function get_render_attribute_string($element)
    {
        if (empty($this->_render_attributes[$element])) {
            return '';
        }

        $render_attributes = $this->_render_attributes[$element];

        $attributes = array();

        foreach ($render_attributes as $attribute_key => $attribute_values) {
            $attributes[] = sprintf('%1$s="%2$s"', $attribute_key, esc_attr(implode(' ', $attribute_values)));
        }

        return implode(' ', $attributes);
    }
    protected function _get_shorten_text($text, $no_of__limit, $dot = false)
    {
        $chars_limit = $no_of__limit;
        $chars_text = strlen($text);
        $text = $text . " ";
        $text = substr($text, 0, $chars_limit);
        $text = substr($text, 0, strrpos($text, ' '));
        if ($dot == true) {

            $text = $text . "...";

        }
        return $text;
    }
    public function __get_icon( $setting = null, $settings = null, $format = '%s', $icon_class = '' ) {
        return $this->__render_icon( $setting, $settings, $format, $icon_class, false );
    }
    public function __render_icon( $setting = null, $settings = null, $format = '%s', $icon_class = '', $echo = true ) {

        if ( null === $settings ) {
            $settings = $this->get_settings_for_display();
        }

        $new_setting = $this->__new_icon_prefix . $setting;

        $migrated = isset( $settings['__fa4_migrated'][ $new_setting ] );
        $is_new = ( empty( $settings[ $setting ] ) || 'false' === $settings[ $setting ] )
                  && class_exists( 'Elementor\Icons_Manager' ) && \Elementor\Icons_Manager::is_migration_allowed();

        $icon_html = '';

        if ( $is_new || $migrated ) {

            $attr = array( 'aria-hidden' => 'true' );

            if ( ! empty( $icon_class ) ) {
                $attr['class'] = $icon_class;
            }

            if ( isset( $settings[ $new_setting ] ) ) {
                ob_start();
                \Elementor\Icons_Manager::render_icon( $settings[ $new_setting ], $attr );

                $icon_html = ob_get_clean();
            }

        } else if ( ! empty( $settings[ $setting ] ) ) {

            if ( empty( $icon_class ) ) {
                $icon_class = $settings[ $setting ];
            } else {
                $icon_class .= ' ' . $settings[ $setting ];
            }

            $icon_html = sprintf( '<i class="%s" aria-hidden="true"></i>', $icon_class );
        }

        if ( empty( $icon_html ) ) {
            return;
        }

        if ( ! $echo ) {
            return sprintf( $format, $icon_html );
        }

        printf( $format, $icon_html );
    }
    public function _get_message( $notice ) {

        if ( empty( $notice ) ) {
            $notice = __( 'The current query has no posts. Please make sure you have published items matching your query.', 'rhr' );
        }

        ?>
        <div class="blog-grid-error-notice">
            <?php echo wp_kses_post( $notice ); ?>
        </div>
        <?php
    }

}
