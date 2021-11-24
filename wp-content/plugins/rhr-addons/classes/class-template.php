<?php
namespace KC_GLOBAL;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Template
{   

    static $is_elementor_ajax = false;
    public function __construct(){
        
    }
    
    public static function get_query_post_list($post_type = 'any', $limit = -1, $search = '')
    {
        global $wpdb;
        $where = '';
        $data = [];

        if (-1 == $limit) {
            $limit = '';
        } elseif (0 == $limit) {
            $limit = "limit 0,1";
        } else {
            $limit = $wpdb->prepare(" limit 0,%d", esc_sql($limit));
        }

        if ('any' === $post_type) {
            $in_search_post_types = get_post_types(['exclude_from_search' => false]);
            if (empty($in_search_post_types)) {
                $where .= ' AND 1=0 ';
            } else {
                $where .= " AND {$wpdb->posts}.post_type IN ('" . join("', '",
                    array_map('esc_sql', $in_search_post_types)) . "')";
            }
        } elseif (!empty($post_type)) {
            $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_type = %s", esc_sql($post_type));
        }

        if (!empty($search)) {
            $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql($search) . '%');
        }

        $query = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
        $results = $wpdb->get_results($query);
        if (!empty($results)) {
            foreach ($results as $row) {
                $data[$row->ID] = $row->post_title;
            }
        }
        return $data;
    }
    public static function get_elementor_templates($type = null)
    {
        $options = [];

        if ($type) {
            $args = [
                'post_type' => 'elementor_library',
                'posts_per_page' => -1,
            ];
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field' => 'slug',
                    'terms' => $type,
                ],
            ];

            $page_templates = get_posts($args);

            if (!empty($page_templates) && !is_wp_error($page_templates)) {
                foreach ($page_templates as $post) {
                    $options[$post->ID] = $post->post_title;
                }
            }
        } else {
            $options = self::get_query_post_list('elementor_library');
        }

        return $options;
    }
    public static function in_elementor() {
        $result = false;

        if ( wp_doing_ajax() ) {
            $result = self::$is_elementor_ajax;
        } elseif ( \Elementor\Plugin::instance()->editor->is_edit_mode()
            || \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
            $result = true;
        }
        return apply_filters( 'rhr/in-elementor', $result );
        }
    public static function is_edit_mode() {
        $result = false;
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
            $result = true;
        }
        return apply_filters( 'rhr/is-edit-mode', $result );
    }
}
