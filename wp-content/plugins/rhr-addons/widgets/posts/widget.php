<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Scheme_Typography;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\CREST_BASE;
use \KC_GLOBAL\Query as Query_Builder;

if (!defined('ABSPATH')) exit;

class Posts extends CREST_BASE{

    public function get_name(){
        return 'rhr-posts';
    }

    public function get_title(){
        return esc_html__( 'Posts', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-posts-grid';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'blog', 'blogs', 'post', 'posts', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            '_rhr_design_preset',
            [
                'label' => __( 'Preset', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_rhr_design',
            [
                'label' => esc_html__( 'Design Format', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'default' => 'Default',
                    'design-1' => 'Blog',
                    'design-2' => 'Client Cases',
                    'design-3' => 'eBooks',
                    'design-4' => 'Last News',
                    'design-5' => 'Research Studies',
                    'design-6' => 'Team',
                    'design-7' => 'Webinar',
                ],
                'default' => 'default',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_general',
            [
                'label' => __( 'General', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_rhr_blog_equal_height',
            [
                'label' => __('Equal Box Height', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => __( 'Enable this to equal box height (you will need to make sure all featured images are the same height.) (or) Leave it empty to apply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_blog_on_scroll',
            [
                'label' => __('On Scroll', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'description' => __( 'Enable on scroll to display post after scroll (or) Leave it empty to apply theme default.', 'rhr' ),
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_blog_text_section',
            [
                'label' => __( 'Text', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_rhr_design' => ['default'],
                ],
            ]
        );
        $this->add_control(
			'_rhr_text_heading',
			[
				'label' => __( 'Heading', 'rhr' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Resources', 'rhr' ),
				'placeholder' => __( 'Type your heading here', 'rhr' ),
                'description' => __( 'Enter heading (or) Leave it empty to aply theme default.', 'rhr' ),
			]
		);
        $this->add_control(
            '_rhr_text_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'See More', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'See More', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_text_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_text_btn!' => '',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_blog_query',
            [
                'label' => __( 'Query', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_rhr_query_filter',
            array(
                'label' => __('Source', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'options' => Query_Builder::_get_post_types(),
                'default' => 'post',
                'description' => __( 'Choose post type (or) Leave it empty to aply default.', 'rhr' ),
            )
        );
        $this->start_controls_tabs('_rhr_blog_category_tabs');

            $this->start_controls_tab('_rhr_blog_category_include',
                [
                    'label' => esc_html__('Include', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id', 'page'],
                    ],
                ]
            );
            foreach (Query_Builder::_get_post_types() as $key => $type) {
                $taxonomy = Query_Builder::_get_taxnomies($key);

                if (!empty($taxonomy)) {
                    foreach ($taxonomy as $index => $tax) {

                        $terms = get_terms($index, array('hide_empty' => false));

                        $related_tax = array();

                        if (!empty($terms)) {

                            foreach ($terms as $t_index => $t_obj) {

                                $related_tax[$t_obj->slug] = $t_obj->name;
                            }

                            $this->add_control(
                                'tax_' . $index . '_' . $key . '_include',
                                array(
                                    'label' => sprintf(__('By %s', 'rhr' ), $tax->label),
                                    'type' => Controls_Manager::SELECT2,
                                    'default' => '',
                                    'multiple' => true,
                                    'label_block' => true,
                                    'options' => $related_tax,
                                    'condition' => [
                                        '_rhr_query_filter' => $key,
                                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                                    ],
                                )
                            );
                        }
                    }
                }
            }
            $this->end_controls_tab();

             $this->start_controls_tab('_rhr_blog_category_exclude',
                [
                    'label' => esc_html__('Exclude', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id', 'page'],
                    ],
                ]
            );
            foreach (Query_Builder::_get_post_types() as $key => $type) {
                $taxonomy = Query_Builder::_get_taxnomies($key);

                if (!empty($taxonomy)) {
                    foreach ($taxonomy as $index => $tax) {

                        $terms = get_terms($index, array('hide_empty' => false));

                        $related_tax = array();

                        if (!empty($terms)) {

                            foreach ($terms as $t_index => $t_obj) {

                                $related_tax[$t_obj->slug] = $t_obj->name;
                            }

                            $this->add_control(
                                'tax_' . $index . '_' . $key . '_exclude',
                                array(
                                    'label' => sprintf(__('By %s', 'rhr' ), $tax->label),
                                    'type' => Controls_Manager::SELECT2,
                                    'default' => '',
                                    'multiple' => true,
                                    'label_block' => true,
                                    'options' => $related_tax,
                                    'condition' => [
                                        '_rhr_query_filter' => $key,
                                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                                    ],
                                )
                            );
                        }
                    }
                }
            }
            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->start_controls_tabs('_rhr_blog_authors_tabs');

            $this->start_controls_tab('_rhr_blog_authors_include',
                [
                    'label' => esc_html__('Include', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                ]
            );
            $this->add_control(
                '_rhr_blog_include_authors',
                array(
                    'label' => __('Authors', 'rhr' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => Query_Builder::_get_authors(),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                )
            );
            $this->end_controls_tab();
            $this->start_controls_tab('_rhr_blog_authors_exclude',
                [
                    'label' => esc_html__('Exclude', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                ]
            );
            $this->add_control(
                '_rhr_blog_exclude_authors',
                array(
                    'label' => __('Authors', 'rhr' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => Query_Builder::_get_authors(),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                )
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->add_control(
                '_rhr_by_id_posttype',
                array(
                    'label' => __('Post Type', 'rhr' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => Query_Builder::_get_post_types_by_id(),
                    'default' => 'post',
                    'description' => __( 'Choose post type (or) Leave it empty to aply default.', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter' => ['by_id', 'by_post_id'],
                    ],
                )
            );
            $this->add_control(
                '_rhr_blog_posts_id',
                [
                    'label' => 'Post Id',
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'show_label' => true,
                    'default' => '',
                    'dynamic' => [
                        'active'   => true,
                    ],
                    'placeholder' => __( 'Post Id(1,2,3)', 'rhr' ),
                    'description' => __( 'Enter post id like(1200,1300,1400) (or) Leave it empty to hide.', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter' => ['by_post_id'],
                    ],
                ]
            );
            $this->start_controls_tabs('_rhr_blog_category_posts_tabs');

            $this->start_controls_tab('_rhr_blog_category_posts_include',
                [
                    'label' => esc_html__('Include', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter' => ['by_id'],
                    ],
                ]
            );
            $this->add_control(
                '_rhr_blog_include_posts',
                [
                    'label' => __('Posts', 'rhr' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => Query_Builder::_get_manual_posts_lists(),
                    'condition' => [
                        '_rhr_query_filter' => ['by_id'],
                    ],
                ]
            );
            $this->end_controls_tab();

            $this->start_controls_tab('_rhr_blog_category_posts_exclude',
                [
                    'label' => esc_html__('Exclude', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter' => ['by_id'],
                    ],
                ]
            );
            $this->add_control(
                '_rhr_blog_exclude_posts',
                [
                    'label' => __('Posts', 'rhr' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => Query_Builder::_get_posts_list(),
                    'condition' => [
                        '_rhr_query_filter' => ['by_id'],
                    ],
                ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();


            $this->add_control(
                '_rhr_blog_ignore_sticky_posts', [
                    'label' => __('Ignore Sticky Posts', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'description' => __( 'Sticky-posts ordering is visible on frontend only (or) Leave it empty to aply default.', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                ]
            );

            $this->add_control(
                '_rhr_blog_post_offset', [
                    'label' => esc_html__('Offset', 'rhr' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 0,
                    'min' => '0',
                    'label_block' => false,
                    'description' => __('This option is used to exclude number of initial posts from being display.)', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                ]
            );

            $this->add_control(
                '_rhr_post_query_exclude_current',
                array(
                    'label' => __('Exclude Current Post', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('This option will remove the current post from the query.', 'rhr' ),
                    'label_on' => __('Yes', 'rhr' ),
                    'label_off' => __('No', 'rhr' ),
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                )
            );
            $this->add_control(
                '_rhr_blog_post_custom_date',
                [
                    'label' => __('Date', 'rhr' ),
                    'type' => Controls_Manager::SELECT,
                    'post_type' => '',
                    'default' => 'anytime',
                    'options' => [
                        'anytime' => __('All', 'rhr' ),
                        'today' => __('Past Day', 'rhr' ),
                        'week' => __('Past Week', 'rhr' ),
                        'month' => __('Past Month', 'rhr' ),
                        'quarter' => __('Past Quarter', 'rhr' ),
                        'year' => __('Past Year', 'rhr' ),
                        'exact' => __('Custom', 'rhr' ),
                    ],
                    'label_block' => false,
                    'multiple' => false,
                    'separator' => 'before',
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                ]
            );

            $this->add_control(
                '_rhr_blog_post_before_date',
                [
                    'label' => __('Before', 'rhr' ),
                    'type' => Controls_Manager::DATE_TIME,
                    'post_type' => '',
                    'label_block' => false,
                    'multiple' => false,
                    'placeholder' => __('Choose', 'rhr' ),
                    'condition' => [
                        '_rhr_blog_post_custom_date' => ['exact'],
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                    'description' => __('Setting a ‘Before’ date will show all the posts published until the chosen date (inclusive).', 'rhr' ),
                ]
            );
            $this->add_control(
                '_rhr_blog_post_date_after',
                [
                    'label' => __('After', 'rhr' ),
                    'type' => Controls_Manager::DATE_TIME,
                    'post_type' => '',
                    'label_block' => false,
                    'multiple' => false,
                    'placeholder' => __('Choose', 'rhr' ),
                    'condition' => [
                        '_rhr_blog_post_custom_date' => ['exact'],
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                    'description' => __('Setting an ‘After’ date will show all the posts published since the chosen date (inclusive).', 'rhr' ),
                ]
            );
            $this->add_control(
                '_rhr_blog_posts_per_page', [
                    'label' => esc_html__('Posts Per Page', 'rhr' ),
                    'type' => Controls_Manager::NUMBER,
                    'placeholder' => esc_html__('Enter Number', 'rhr' ),
                    'min'         => 1,
                    'default' => 3,
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                ]
            );
            $this->add_control(
                '_rhr_blog_order_by_type',
                [
                    'label' => __('Order By Type', 'rhr' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'normal',
                    'options' => [
                        'normal' => __('Normal', 'rhr' ),
                        'alphabetically' => __('Alphabetically', 'rhr' ),
                    ],
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                ]
            );
            $this->add_control(
                '_rhr_blog_order_by',
                [
                    'label' => __('Order By', 'rhr' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'date',
                    'options' => [
                        'modified' => __('Modified', 'rhr' ),
                        'date' => __('Date', 'rhr' ),
                        'rand' => __('Rand', 'rhr' ),
                        'ID' => __('ID', 'rhr' ),
                        'title' => __('Title', 'rhr' ),
                        'author' => __('Author', 'rhr' ),
                        'name' => __('Name', 'rhr' ),
                        'parent' => __('Parent', 'rhr' ),
                        'menu_order' => __('Menu Order', 'rhr' ),
                    ],
                    'separator' => 'before',
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                        '_rhr_blog_order_by_type' => ['normal'],
                    ],
                ]
            );
            $this->add_control(
                '_rhr_blog_order',
                [
                    'label' => __('Order', 'rhr' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'ase',
                    'options' => [
                        'ase' => __('Ascending Order', 'rhr' ),
                        'desc' => __('Descending Order', 'rhr' ),
                    ],
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                ]
            );
            $this->add_control(
                '_rhr_blog_empty_message',
                array(
                    'label' => __('Empty Query Message', 'rhr' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'condition' => [
                        '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    ],
                )
            );


        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_blog_tab_filter',
            [
                'label' => __( 'Filter', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_rhr_design' => ['design-1', 'design-3', 'design-5', 'design-7'],
                ],
            ]
        );
        $this->add_control(
            'show_tab_filter',
            [
                'label' => __('Filter', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'rhr' ),
                'label_off' => __('Hide', 'rhr' ),
                'default' => 'yes',
            ]
        );
        $this->add_control(
            '_rhr_tab_filter_from',
            [
                'label' => __('Filter From', 'rhr'),
                'type' => Controls_Manager::SELECT,
                'options' => Query_Builder::_get_registered_taxonomies(),
                'default' => 'category',
                'condition' => [
                    'show_tab_filter' => 'yes',
                ]
            ]
        );
        $this->add_control(
            '_rhr_tab_filter_label',
            [
                'label' => __('Label', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('All Project', 'rhr' ),
                'description' => __( 'Enter label (or) Leave it empty to apply theme default.', 'rhr' ),
                'condition' => [
                    'show_tab_filter' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_blog_options',
                [
                    'label' => __( 'Options', 'rhr' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control(
                'show_title',
                [
                    'label' => __('Title', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                '_rhr_title_length',
                [
                    'label' => __('Title Length', 'rhr' ),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [
                        'active'   => true,
                    ],
                    'default' => '',
                    'description' => __( 'Enter title length (or) Leave it empty to aply theme default.', 'rhr' ),
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_content',
                [
                    'label' => __('Content', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_off' => __('Hide', 'rhr' ),
                    'label_on' => __('Show', 'rhr' ),
                    'condition' => [
                        '_rhr_design!' => ['default'],
                    ],
                ]
            );
             $this->add_control(
                'content_source',
                [
                    'label'       => __( 'Content From', 'rhr' ),
                    'type'        => Controls_Manager::SELECT,
                    'options'     => array(
                        'excerpt' => __( 'Excerpt', 'rhr' ),
                        'full'    => __( 'Full Content', 'rhr' ),
                    ),
                    'default'     => 'excerpt',
                    'condition'   => array(
                        '_rhr_design!' => ['default'],
                        'show_content' => 'yes',
                    ),
                ]
            );
            $this->add_control(
                '_rhr_blog_content_length',
                [
                    'label' => __('Content Length', 'rhr' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => apply_filters('excerpt_length', 150),
                    'separator' => 'after',
                    'description' => __( 'Enter content length (or) Leave it empty to aply theme default.', 'rhr' ),
                    'condition' => [
                        '_rhr_design!' => ['default'],
                        'show_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'show_thumb',
                [
                    'label' => __('Thumbnail', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                ]
            );

            $this->add_control(
                '_rhr_thumb_animation',
                [
                    'label' => esc_html__( 'Hover Animation', 'rhr' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'default' => 'no_effect',
                    'options'   => [
                        'no_effect' => __('No Effect', 'rhr' ),
                        'thumbnail-zoom_in_img' => __('Zoom In', 'rhr' ),
                        'zoom_out_img' => __('Zoom Out One', 'rhr' ),
                        'slide_img' => __('Slide', 'rhr' ),
                        'rotate_in_img' => __('Rotate In', 'rhr' ),
                        'rotate_img' => __('Rotate Out', 'rhr' ),
                        'blur_img' => __('Blur In', 'rhr' ),
                        'blur_out_img' => __('Blur Out', 'rhr' ),
                        'gray_scale_img' => __('Gray Scale', 'rhr' ),
                        'sepia_img' => __('Sepia', 'rhr' ),
                        'blur_gray_scale_img' => __('Blur + Gray Scale', 'rhr' ),
                        'opacity_one_img' => __('Opacity One', 'rhr' ),
                        'opacity_two_img' => __('Opacity Two', 'rhr' ),
                        'flashing_img' => __('Flashing', 'rhr' ),
                        'shine_img' => __('Shine', 'rhr' ),
                        'circle_img' => __('Circle', 'rhr' ),
                    ],
                    'condition' => [
                        'show_thumb' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_cat',
                [
                    'label' => __('Category', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',
                    'condition' => [
                        '_rhr_design' => ['default', 'design-2'],
                    ],
                ]
            );
            $this->add_control(
                'show_time',
                [
                    'label' => __('Time', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',
                    'condition' => [
                        '_rhr_design' => ['default'],
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_blog_read_section',
            [
                'label' => esc_html__('Read More', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_rhr_design!' => ['default'],
                ],
            ]
        );
        $this->add_control(
            'show_read_more',
            [
                'label' => __('Read More', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'rhr' ),
                'label_off' => __('Hide', 'rhr' ),
                'default' => 'yes',
            ]
        );
        $this->add_control(
            '_rhr_blog_read_text',
            [
                'label' => __('Read Text', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('Learn More', 'rhr' ),
                'description' => __( 'Enter read more text (or) Leave it empty to apply theme default.', 'rhr' ),
                'condition' => [
                    'show_read_more' => 'yes',
                ]
            ]
        );
        $this->add_control(
            '_rhr_blog_new_tab',
            [
                'label' => __('Open New Tab', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'separator' => 'after',
                'condition' => [
                    'show_read_more' => 'yes',
                    '_rhr_blog_read_text!' => '',
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_blog_pagination_section',
            [
                'label' => esc_html__('Pagination', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_rhr_query_filter!' => ['by_id', 'by_post_id'],
                    '_rhr_blog_on_scroll!' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_rhr_blog_paging',
            [
                'label' => __('Enable', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => __( 'Enable pagination (or) Leave it empty to apply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_blog_paging_ajax',
            [
                'label' => __('Enable Ajax', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => __( 'Enable ajax (or) Leave it empty to apply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_blog_paging' => ['yes'],
                ],
            ]
        );
        $this->add_control(
            '_rhr_blog_scroll_to_offset',
            [
                'label' => __('Scroll After Pagination', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => __( 'Enable scroll after pagination (or) Leave it empty to apply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_blog_paging' => ['yes'],
                ],
            ]
        );
        $this->add_control(
            '_rhr_blog_max_pages',
            [
                'label' => __('Page Limit', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'description' => __( 'Enter page limit (or) Leave it empty to apply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_blog_paging' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_rhr_blog_pag_strings',
            [
                'label' => __('Show Next/Prev', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => __( 'Show next/prev button (or) Leave it empty to apply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_blog_paging' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_rhr_pag_next_text_img',
            [
                'label' => __( 'Next', 'rhr' ),
                'type' => Controls_Manager::MEDIA,

                'dynamic' => [
                    'active' => true,
                ],
                'description' => __( 'Choose image (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_blog_paging' => ['yes'],
                    '_rhr_blog_pag_strings' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_rhr_pag_prev_text_img',
            [
                'label' => __( 'Previous', 'rhr' ),
                'type' => Controls_Manager::MEDIA,

                'dynamic' => [
                    'active' => true,
                ],
                'description' => __( 'Choose image (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_blog_paging' => ['yes'],
                    '_rhr_blog_pag_strings' => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_rhr_blog_pagi_align',
            [
                'label' => __('Alignment', 'rhr' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'rhr' ),
                        'icon' => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => __('Center', 'rhr' ),
                        'icon' => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => __('Right', 'rhr' ),
                        'icon' => 'fa fa-align-right',
                    ),
                ),
                'default' => 'center',
                'toggle' => false,
                'condition' => [
                    '_rhr_blog_paging' => ['yes'],
                ],
                'selectors' => array(
                    '{{WRAPPER}} .elementor-rhr-posts .rhr-pagination' => 'text-align: {{VALUE}}',
                ),
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_blog_general',
            [
                'label' => __('General', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( '_rhr_blog_general_tabs' );
        $this->start_controls_tab( '_rhr_blog_general_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rhr'),
            ]
        );
            $this->add_responsive_control(
                '_rhr_blog_general_cgap',
                [
                    'label'     => __( 'Column Gap', 'rhr' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => array(
                        'px' => array(
                            'min' => 0,
                            'max' => 500,
                        ),
                    ),
                    'selectors' => array(
                        '{{WRAPPER}} .elementor-rhr-posts .rhr_blog-grid .rhr_blog_item' => 'margin: 0 {{SIZE}}{{UNIT}}',
                    ),
                ]
            );
            $this->add_responsive_control(
                '_rhr_blog_general_rgap',
                [
                    'label'     => __( 'Row Gap', 'rhr' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => array(
                        'px' => array(
                            'min' => 0,
                            'max' => 500,
                        ),
                    ),
                    'selectors' => array(
                        '{{WRAPPER}} .elementor-rhr-posts .rhr_blog-grid .rhr_blog_item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ),
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => '_rhr_blog_general_bg',
                    'label' => 'Background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item',
                    'fields_options' => [
                        'background' => [
                            'label' => __('Background', 'rhr'),
                        ],
                    ],
                ]
            );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_rhr_blog_general_border',
                'label' => esc_html__('Border', 'rhr'),
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item',
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_general_radius',
            [
                'label' => esc_html__('Border Radius', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_general_padding',
            [
                'label' => esc_html__('Padding', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_rhr_blog_general_shadow',
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item',
            ]
        );
        $this->add_control(
            '_rhr_blog_general_transition', [
                 'label' => esc_html__( 'Transition', 'rhr' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1000,
                'step' => 0.1,
                'placeholder' => __(0.2, 'rhr'),
                'default' => __(0.2, 'rhr'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item' => '-webkit-transition: all {{VALUE}}s;transition: all {{VALUE}}s;',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_general_align',
            [
                'label' => __('Alignment', 'rhr'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'rhr'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'rhr'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'rhr'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( '_rhr_blog_general_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rhr')
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => '_rhr_blog_general_bg_h',
                    'label' => 'Background Color',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item:hover',
                    'fields_options' => [
                        'background' => [
                            'label' => __('Background', 'rhr'),
                        ],
                    ],
                ]
            );
             $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => '_rhr_blog_general_border_h',
                    'label' => esc_html__('Border', 'rhr'),
                    'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item:hover',
                ]
            );
            $this->add_responsive_control(
                '_rhr_blog_general_radius_h',
                [
                    'label' => esc_html__('Border Radius', 'rhr'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => '_rhr_blog_general_shadow_h',
                    'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item:hover',
                ]
            );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_title_style_section',
            [
                'label' => __('Title', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            '_rhr_title_color',
            [
                'label' => esc_html__('Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_title_color_hover',
            [
                'label' => esc_html__('Hover Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_title_hover_transition', [
                 'label' => esc_html__( 'Transition', 'rhr' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1000,
                'step' => 0.1,
                'placeholder' => __(0.2, 'rhr'),
                'default' => __(0.2, 'rhr'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--title' => '-webkit-transition: all {{VALUE}}s;transition: all {{VALUE}}s;',
                ],
                'condition' => [
                    '_rhr_title_color_hover!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_rhr_title_typography',
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--title',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_rhr_title_bg_color',
                'label' => 'Background Color',
                'types' => ['classic', 'gradient'],
                'selector' =>
                '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--title',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'rhr'),
                    ],
                ],
            ]
        );
        $this->add_control(
            '_rhr_title_position_toggle',
            [
                'label' => __('Position', 'rhr'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'rhr'),
                'label_on' => __('yes', 'rhr'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            '_rhr_title_position_y',
            [
                'label' => __('Vertical', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_title_position_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--title' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_title_position_x',
            [
                'label' => __('Horizontal', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_title_position_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--title' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_content_style_section',
            [
                'label' => __('Content', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '_rhr_design!' => ['default'],
                    'show_content' => 'yes',
                ],
            ]
        );

        $this->add_control(
            '_rhr_content_color',
            [
                'label' => esc_html__('Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_content_color_hover',
            [
                'label' => esc_html__('Hover Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--content p:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_content_hover_transition', [
                 'label' => esc_html__( 'Transition', 'rhr' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1000,
                'step' => 0.1,
                'placeholder' => __(0.2, 'rhr'),
                'default' => __(0.2, 'rhr'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--content p' => '-webkit-transition: all {{VALUE}}s;transition: all {{VALUE}}s;',
                ],
                'condition' => [
                    '_rhr_content_color_hover!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_rhr_content_typography',
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--content p',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_rhr_content_bg_color',
                'label' => 'Background Color',
                'types' => ['classic', 'gradient'],
                'selector' =>
                '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--content p',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'rhr'),
                    ],
                ],
            ]
        );
        $this->add_control(
            '_rhr_content_position_toggle',
            [
                'label' => __('Position', 'rhr'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'rhr'),
                'label_on' => __('yes', 'rhr'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            '_rhr_content_position_y',
            [
                'label' => __('Vertical', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_content_position_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--content p' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_content_position_x',
            [
                'label' => __('Horizontal', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_content_position_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--content p' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_blog_animation_section',
            [
                'label' => esc_html__('Animation', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_tab_animation_content',
            [
                'label' => esc_html__( 'Content Animation', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'separator' => 'before',
                'default' => 'fadeInUp',
                'options' => rhr_animate_animation(),
            ]
        );
        $this->add_control(
            'animation_speed_content',
            [
                'label' => esc_html__( 'Animation speed', 'rhr' ) . ' (ms)',
                'type' => Controls_Manager::NUMBER,
                'default' => '300',
                'min' => 1,
                'step' => 10,
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    '_rhr_blog_tab_animation_content!' => ['', 'no-animation'],
                ],
            ]
        );
        $this->add_control(
            'animation_delay_content',
            [
                'label' => esc_html__( 'Animation delay', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '200',
                'min' => 1,
                'step' => 10,
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    '_rhr_blog_tab_animation_content!' => ['', 'no-animation'],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_blog_item_style_section',
            [
                'label' => __('Thumbnail', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_thumb' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_item_width',
            [
                'label' => __('Width', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_rhr_blog_item_height',
            [
                'label' => __('Height', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_item_object_fit',
            [
                'label' => __('Object Fit', 'rhr'),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                    '_rhr_blog_item_height[size]!' => '',
                ],
                'options' => [
                    '' => __('Default', 'rhr'),
                    'fill' => __('Fill', 'rhr'),
                    'cover' => __('Cover', 'rhr'),
                    'contain' => __('Contain', 'rhr'),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_item_padding',
            [
                'label' => __('Padding', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_rhr_blog_item_border',
                'label' => esc_html__('Border', 'rhr'),
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img',
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_item_radius',
            [
                'label' => esc_html__('Border Radius', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_rhr_blog_item_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img',
            ]
        );
        $this->add_control(
            '_rhr_blog_item_opacity',
            [
                'label' => __( 'Opacity', 'rhr' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_blog_item_opacity_h',
            [
                'label' => __( 'Opacity On Hover', 'rhr' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_blog_item_position_xy',
            [
                'label' => __('Position', 'rhr'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'rhr'),
                'label_on' => __('yes', 'rhr'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            '_rhr_blog_item_y',
            [
                'label' => __('Vertical', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_blog_item_position_xy' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_blog_item_x',
            [
                'label' => __('Horizontal', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_blog_item_position_xy' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item img' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_avater_style_section',
            [
                'label' => __('Avater', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '_rhr_design!' => ['default'],
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_avater_width',
            [
                'label' => __('Width', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '23',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '23',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '23',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_rhr_avater_height',
            [
                'label' => __('Height', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '23',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '23',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '23',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_avater_object_fit',
            [
                'label' => __('Object Fit', 'rhr'),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                    '_rhr_avater_height[size]!' => '',
                ],
                'options' => [
                    '' => __('Default', 'rhr'),
                    'fill' => __('Fill', 'rhr'),
                    'cover' => __('Cover', 'rhr'),
                    'contain' => __('Contain', 'rhr'),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_avater_padding',
            [
                'label' => __('Padding', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_rhr_avater_border',
                'label' => esc_html__('Border', 'rhr'),
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .post-author img',
            ]
        );
        $this->add_responsive_control(
            '_rhr_avater_radius',
            [
                'label' => esc_html__('Border Radius', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_rhr_avater_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .post-author img',
            ]
        );
        $this->add_control(
            '_rhr_avater_opacity',
            [
                'label' => __( 'Opacity', 'rhr' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_avater_opacity_h',
            [
                'label' => __( 'Opacity On Hover', 'rhr' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_avater_position_xy',
            [
                'label' => __('Position', 'rhr'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'rhr'),
                'label_on' => __('yes', 'rhr'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            '_rhr_avater_y',
            [
                'label' => __('Vertical', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_avater_position_xy' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author img' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_avater_x',
            [
                'label' => __('Horizontal', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_avater_position_xy' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .post-author img' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_cat_style_section',
            [
                'label' => __('Category', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_cat' => 'yes',
                ],
            ]
        );

        $this->add_control(
            '_rhr_cat_color',
            [
                'label' => esc_html__('Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--cat' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_cat_color_hover',
            [
                'label' => esc_html__('Hover Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--cat:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_cat_hover_transition', [
                 'label' => esc_html__( 'Transition', 'rhr' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1000,
                'step' => 0.1,
                'placeholder' => __(0.2, 'rhr'),
                'default' => __(0.2, 'rhr'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--cat' => '-webkit-transition: all {{VALUE}}s;transition: all {{VALUE}}s;',
                ],
                'condition' => [
                    '_rhr_cat_color_hover!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_rhr_cat_typography',
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--cat',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_rhr_cat_bg_color',
                'label' => 'Background Color',
                'types' => ['classic', 'gradient'],
                'selector' =>
                '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--cat',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'rhr'),
                    ],
                ],
            ]
        );
        $this->add_control(
            '_rhr_cat_position_toggle',
            [
                'label' => __('Position', 'rhr'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'rhr'),
                'label_on' => __('yes', 'rhr'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            '_rhr_cat_position_y',
            [
                'label' => __('Vertical', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_cat_position_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--cat' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_cat_position_x',
            [
                'label' => __('Horizontal', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_cat_position_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--cat' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_time_style_section',
            [
                'label' => __('Time Ago', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_time' => 'yes',
                ],
            ]
        );

        $this->add_control(
            '_rhr_time_color',
            [
                'label' => esc_html__('Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--time' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_time_color_hover',
            [
                'label' => esc_html__('Hover Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--time:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_time_hover_transition', [
                 'label' => esc_html__( 'Transition', 'rhr' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1000,
                'step' => 0.1,
                'placeholder' => __(0.2, 'rhr'),
                'default' => __(0.2, 'rhr'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--time' => '-webkit-transition: all {{VALUE}}s;transition: all {{VALUE}}s;',
                ],
                'condition' => [
                    '_rhr_time_color_hover!' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_rhr_time_typography',
                'selector' => '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--time',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_rhr_time_bg_color',
                'label' => 'Background Color',
                'types' => ['classic', 'gradient'],
                'selector' =>
                '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--time',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'rhr'),
                    ],
                ],
            ]
        );
        $this->add_control(
            '_rhr_time_position_toggle',
            [
                'label' => __('Position', 'rhr'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'rhr'),
                'label_on' => __('yes', 'rhr'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            '_rhr_time_position_y',
            [
                'label' => __('Vertical', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_time_position_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--time' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_time_position_x',
            [
                'label' => __('Horizontal', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    '_rhr_time_position_toggle' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-posts .rhr_blog_item .post--time' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $settings['widget_id'] = $this->get_id();
        $query_builder = Query_Builder::_get_instance();
        $query_builder->set_widget_settings($settings);
        $query = $query_builder->_get_grid_query();
        if ( ! $query->have_posts() ) {
            $_get_error_message = $settings['_rhr_blog_empty_message'];
            $query_builder->_get_message( $_get_error_message );
            return;
        }
        $this->__open_wrap();

        $after_scroll = 'yes' === $settings['_rhr_blog_scroll_to_offset'] ? true : false;
        $push_equal_height = 'yes' === $settings['_rhr_blog_equal_height'] ? true : false;
        $onScroll = 'yes' === $settings['_rhr_blog_on_scroll'] ? true : false;

        $this->add_render_attribute(
            '_rhr_wrapper',
            [
                'class'         => 'rhr_blog-grid',
                'data-scroll'   => $after_scroll,
                'data-equal'   => $push_equal_height,
                'data-onscroll'   => $onScroll,
                'data-preset'   => $settings['_rhr_design'],
            ]
        );

        if( $settings['_rhr_design'] === 'default' ){
            $this->add_render_attribute(
                '_rhr_wrapper',
                [
                    'class' => 'resources'
                ]
            );

            $this->add_render_attribute(
                '_rhr_wrapper_inner',
                [
                    'class' => 'items'
                ]
            );
        }elseif($settings['_rhr_design'] === 'design-1'){
            $this->add_render_attribute(
                '_rhr_wrapper',
                [
                    'class' => 'resources'
                ]
            );
            $this->add_render_attribute(
                '_rhr_wrapper_inner',
                [
                    'class' => 'items app-posts i-blog'
                ]
            );
        }elseif($settings['_rhr_design'] === 'design-2'){
            $this->add_render_attribute(
                '_rhr_wrapper_inner',
                [
                    'class' => 'stories s-page app-posts'
                ]
            );
        }elseif($settings['_rhr_design'] === 'design-3'){
            $this->add_render_attribute(
                '_rhr_wrapper',
                [
                    'class' => 'resources'
                ]
            );

            $this->add_render_attribute(
                '_rhr_wrapper_inner',
                [
                    'class' => 'items i-ebooks app-posts'
                ]
            );
        }elseif($settings['_rhr_design'] === 'design-4'){
            $this->add_render_attribute(
                '_rhr_wrapper',
                [
                    'class' => 'resources'
                ]
            );

            $this->add_render_attribute(
                '_rhr_wrapper_inner',
                [
                    'class' => 'items i-news app-posts'
                ]
            );
        }elseif($settings['_rhr_design'] === 'design-5'){
            $this->add_render_attribute(
                '_rhr_wrapper',
                [
                    'class' => 'resources'
                ]
            );

            $this->add_render_attribute(
                '_rhr_wrapper_inner',
                [
                    'class' => 'items i-research app-posts'
                ]
            );
        }elseif($settings['_rhr_design'] === 'design-6'){
            $this->add_render_attribute(
                '_rhr_wrapper',
                [
                    'class' => 'teams not-slick'
                ]
            );
            $this->add_render_attribute(
                '_rhr_wrapper_inner',
                [
                    'class' => 'items app-posts'
                ]
            );
        }elseif($settings['_rhr_design'] === 'design-7'){
            $this->add_render_attribute(
                '_rhr_wrapper',
                [
                    'class' => 'podcast'
                ]
            );
            $this->add_render_attribute(
                '_rhr_wrapper_inner',
                [
                    'class' => 'items i-list app-posts'
                ]
            );
        }


        if ( 'yes' === $settings['_rhr_blog_paging'] ) {

            $total_pages = $query->max_num_pages;

            if ( ! empty( $settings['_rhr_blog_max_pages'] ) ) {
                $total_pages = min( $settings['_rhr_blog_max_pages'], $total_pages );
            }
        }
        $page_id = '';
        if ( null !== \Elementor\Plugin::$instance->documents->get_current() ) {
            $page_id = \Elementor\Plugin::$instance->documents->get_current()->get_main_id();
        }
        $this->add_render_attribute( '_rhr_wrapper', 'data-page', $page_id );

        if ( 'yes' === $settings['_rhr_blog_paging'] && $total_pages > 1 ) {

            $this->add_render_attribute( '_rhr_wrapper', 'data-pagination', 'true' );

        }

        if ( 'yes' === $settings['_rhr_blog_paging'] && 'yes' === $settings['_rhr_blog_paging_ajax'] ) {

            $this->add_render_attribute( '_rhr_wrapper', 'data-pagiajax', 'true' );

        }
        if ( 'yes' === $settings['show_tab_filter'] ) {
            $this->add_render_attribute( '_rhr_wrapper', 'data-filter', 'true' );
        }
        $_get_wrapper = $this->get_render_attribute_string( '_rhr_wrapper' );
        $_get_wrapper_inner = $this->get_render_attribute_string( '_rhr_wrapper_inner' );
        ?>
        <?php if( $settings['_rhr_design'] === 'default' ): ?>
            <div class="pages-content pc-home-resources">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-11">
                            <?php if (isset($settings['_rhr_text_heading']) && !empty($settings['_rhr_text_heading'])): ?>
                                <div class="title t-medium t-center">
                                <?php echo $this->parse_text_editor($settings['_rhr_text_heading']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($settings['_rhr_text_btn']) && !empty($settings['_rhr_text_btn'])): ?>
                                <a <?php echo rhr__link($settings['_rhr_text_link']); ?> class="button b-center" data-cursor="scale">
                                    <span><?php echo $this->parse_text_editor($settings['_rhr_text_btn']); ?></span>
                                    <div class="arrow svg"></div>
                                </a>
                            <?php endif; ?>
                            <div <?php echo $_get_wrapper; ?>>
                                <div <?php echo $_get_wrapper_inner; ?>>
                                    <?php $query_builder->_get_layout(); ?>
                                </div>
                            </div>
                            <?php if ( 'yes' === $settings['_rhr_blog_paging'] && $settings['_rhr_design'] === 'default' && $total_pages > 1 ) : ?>
                                <div class="rhr-pagination">
                                    <?php $query_builder->_get_render_pagination(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php elseif($settings['_rhr_design'] === 'design-1') :?>
                <div class="pages-content">
                    <div class="container-fluid">
                        <?php
                            if($settings['show_tab_filter'] == 'yes') {
                                echo $query_builder->get_filter_tabs_markup();
                            }
                        ?>
                        <div class="row justify-content-center">
                            <div class="col col-10">
                                <div <?php echo $_get_wrapper; ?>>
                                    <div <?php echo $_get_wrapper_inner; ?>>
                                        <?php $query_builder->_get_layout(); ?>
                                    </div>
                                </div>
                                <?php if ( 'yes' === $settings['_rhr_blog_paging'] && $settings['_rhr_design'] === 'design-1' && $total_pages > 1 ) : ?>
                                    <div class="rhr-pagination">
                                        <?php $query_builder->_get_render_pagination(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif($settings['_rhr_design'] === 'design-2') :?>
                <div class="pages-content">
                    <div class="container-fluid">
                        <div class="row justify-content-center align-top">
                            <div class="col col-10">
                                <div <?php echo $_get_wrapper; ?>>
                                    <div <?php echo $_get_wrapper_inner; ?>>
                                        <?php $query_builder->_get_layout(); ?>
                                    </div>
                                </div>
                                <?php if ( 'yes' === $settings['_rhr_blog_paging'] && $settings['_rhr_design'] === 'design-2' && $total_pages > 1 ) : ?>
                                    <div class="rhr-pagination">
                                        <?php $query_builder->_get_render_pagination(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php elseif($settings['_rhr_design'] === 'design-3') :?>
                <div class="pages-content">
                    <div class="container-fluid">
                        <?php
                            if($settings['show_tab_filter'] == 'yes') {
                                echo $query_builder->get_filter_tabs_markup();
                            }
                        ?>
                        <div class="row justify-content-center">
                            <div class="col col-10">
                                <div <?php echo $_get_wrapper; ?>>
                                    <div <?php echo $_get_wrapper_inner; ?>>
                                        <?php $query_builder->_get_layout(); ?>
                                    </div>
                                </div>
                                <?php if ( 'yes' === $settings['_rhr_blog_paging'] && $settings['_rhr_design'] === 'design-3' && $total_pages > 1 ) : ?>
                                    <div class="rhr-pagination">
                                        <?php $query_builder->_get_render_pagination(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php elseif($settings['_rhr_design'] === 'design-4') :?>
                    <div class="pages-content pc-PadidngBottom">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col col-10">
                                    <div <?php echo $_get_wrapper; ?>>
                                        <div <?php echo $_get_wrapper_inner; ?>>
                                            <?php $query_builder->_get_layout(); ?>
                                        </div>
                                    </div>
                                    <?php if ( 'yes' === $settings['_rhr_blog_paging'] && $settings['_rhr_design'] === 'design-4' && $total_pages > 1 ) : ?>
                                        <div class="rhr-pagination">
                                            <?php $query_builder->_get_render_pagination(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php elseif($settings['_rhr_design'] === 'design-5') :?>
                        <div class="pages-content">
                            <div class="container-fluid">
                                <?php
                                    if($settings['show_tab_filter'] == 'yes') {
                                        echo $query_builder->get_filter_tabs_markup();
                                    }
                                ?>
                                <div class="row justify-content-center">
                                    <div class="col col-10">
                                        <div <?php echo $_get_wrapper; ?>>
                                            <div <?php echo $_get_wrapper_inner; ?>>
                                                <?php $query_builder->_get_layout(); ?>
                                            </div>
                                        </div>
                                        <?php if ( 'yes' === $settings['_rhr_blog_paging'] && $settings['_rhr_design'] === 'design-5' && $total_pages > 1 ) : ?>
                                            <div class="rhr-pagination">
                                                <?php $query_builder->_get_render_pagination(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php elseif($settings['_rhr_design'] === 'design-6') :?>
                        <div class="pages-content">
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    <div class="col col-10">
                                            <div <?php echo $_get_wrapper; ?>>
                                                <div <?php echo $_get_wrapper_inner; ?>>
                                                    <?php $query_builder->_get_layout(); ?>
                                                </div>
                                            </div>
                                            <?php if ( 'yes' === $settings['_rhr_blog_paging'] && $settings['_rhr_design'] === 'design-6' && $total_pages > 1 ) : ?>
                                                <div class="rhr-pagination">
                                                    <?php $query_builder->_get_render_pagination(); ?>
                                                </div>
                                            <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php elseif($settings['_rhr_design'] === 'design-7') :?>
                        <div class="pages-content">
                            <div class="container-fluid">
                                <?php
                                    if($settings['show_tab_filter'] == 'yes') {
                                        echo $query_builder->get_filter_tabs_markup();
                                    }
                                ?>
                                <div class="row justify-content-center">
                                    <div class="col col-10">
                                        <div <?php echo $_get_wrapper; ?>>
                                            <div <?php echo $_get_wrapper_inner; ?>>
                                                <?php $query_builder->_get_layout(); ?>
                                            </div>
                                        </div>
                                        <?php if ( 'yes' === $settings['_rhr_blog_paging'] && $settings['_rhr_design'] === 'design-7' && $total_pages > 1 ) : ?>
                                            <div class="rhr-pagination">
                                                <?php $query_builder->_get_render_pagination(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php endif; ?>
        <?php
        $this->__close_wrap();
    }
}
