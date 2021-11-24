<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Client_Slider extends CREST_BASE{

    public function get_name(){
        return 'rhr-client-slider';
    }

    public function get_title(){
        return esc_html__( 'Home Client + Slider', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-slider-full-screen';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Home Slider', 'Cleint Slider', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_cslider_preset',
            [
                'label' => __( 'Preset', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_design_section',
            [
                'label' => esc_html__( 'Design Format', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'default' => 'Select',
                ],
                'default' => 'default',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_cleint_content',
            [
                'label' => __( 'Client Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_cleint_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'TRUSTED BY', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_clients_category',
            array(
                'label' => __('Category', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => _get_custom_taxnomies('rhr_clients'),
                'description' => __( 'Choose category (or) Leave it empty to display all.', 'rhr' ),
            )
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_slider_content',
            [
                'label' => __( 'Slider Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_slider_type',
            [
                'label' => esc_html__( 'Slider Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'by_case_studies' => 'By Case Studies',
                    'by_custom' => 'By Custom',
                ],
                'default' => 'by_case_studies',
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_slider_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'RHR knows that driving long-term change is all about the people—curious, open-minded people—who are mentally and emotionally agile”', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater->add_control(
            '_rhr_slider_contents',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Building high-performing teams in Private Equity.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_slider_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Read Full Story', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter button text..', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_slider_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_slider_btn!' => '',
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_slider_img',
            [
                'label' => __( 'Image', 'rhr' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'description' => __( 'Choose image (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_slider_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'condition' =>[
                    '_rhr_slider_type' => 'by_custom',
                ],
                'default' => [
                    [
                        '_rhr_slider_title' => __( '“RHR knows that driving long-term change is all about the people—curious, open-minded people—who are mentally and emotionally agile”', 'rhr' ),
                        '_rhr_slider_contents' => __( 'Building high-performing teams in Private Equity.', 'rhr' ),
                        '_rhr_slider_btn' => __( 'Read Full Story', 'rhr' ),
                        '_rhr_slider_link' => [
                            'url' => '#',
                        ],
                        '_rhr_slider_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        '_rhr_slider_title' => __( '“RHR knows that driving long-term change is all about the people—curious, open-minded people—who are mentally and emotionally agile”', 'rhr' ),
                        '_rhr_slider_contents' => __( 'Building high-performing teams in Private Equity.', 'rhr' ),
                        '_rhr_slider_btn' => __( 'Read Full Story', 'rhr' ),
                        '_rhr_slider_link' => [
                            'url' => '#',
                        ],
                        '_rhr_slider_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        '_rhr_slider_title' => __( '“RHR knows that driving long-term change is all about the people—curious, open-minded people—who are mentally and emotionally agile”', 'rhr' ),
                        '_rhr_slider_contents' => __( 'Building high-performing teams in Private Equity.', 'rhr' ),
                        '_rhr_slider_btn' => __( 'Read Full Story', 'rhr' ),
                        '_rhr_slider_link' => [
                            'url' => '#',
                        ],
                        '_rhr_slider_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],

                ],
                //'title_field' => '{{ _rhr_slider_title }}',
            ]
        );
        $this->add_control(
            '_rhr_slider_case_type',
            [
                'label' => esc_html__( 'Slider Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'by_cats' => 'By Category',
                    'by_post_id' => 'By Post id',
                ],
                'default' => 'by_post_id',
                'condition' => [
                    '_rhr_slider_type' => ['by_case_studies']
                ]
            ]
        );
        $this->add_control(
            '_rhr_slc_post_id', [
                'label' => esc_html__('Post Id', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Post Id', 'rhr' ),
                'min'         => 1,
                'default' => '',
                'description' => __( 'Enter post id like(1200,1233) (or) Leave it to apply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_slider_case_type' => ['by_post_id']
                ],
            ]
        );
        $this->add_control(
            '_rhr_slc_category',
            array(
                'label' => __('Category', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => _get_custom_taxnomies('rhr_client_cases'),
                'description' => __( 'Choose category (or) Leave it empty to display all.', 'rhr' ),
                'condition' => [
                    '_rhr_slider_case_type' => ['by_cats']
                ]
            )
        );
        $this->add_control(
            '_rhr_slc_order_by',
            [
                'label' => __('Order By', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'meta_value_num' => __('Meta Value', 'rhr' ),
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
                    '_rhr_slider_case_type' => ['by_cats']
                ],
            ]
        );
        $this->add_control(
            '_rhr_slc_order',
            [
                'label' => __('Order', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase' => __('Ascending Order', 'rhr' ),
                    'desc' => __('Descending Order', 'rhr' ),
                ],
                'condition' => [
                    '_rhr_slider_case_type' => ['by_cats']
                ],
            ]
        );
        $this->add_control(
            '_rhr_slc_per_page', [
                'label' => esc_html__('Per Page', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'rhr' ),
                'min'         => 1,
                'default' => 20,
                'description' => __( 'Enter the integer value to display client item (or) Leave it to apply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_slider_case_type' => ['by_cats']
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_bc_content',
            [
                'label' => __( 'Bottom Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_bc_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Generate lasting positive impact on employees, shareholders, and communities. ', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_bc_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Get in Touch', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter button text..', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_bc_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_bc_btn!' => '',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_cs_options',
                [
                    'label' => __( 'Options', 'rhr' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control(
                'show_client',
                [
                    'label' => __('Show Client', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',

                ]
            );
            $this->add_control(
                'show_slider',
                [
                    'label' => __('Show Slider', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',

                ]
            );
            $this->add_control(
                'show_bottom',
                [
                    'label' => __('Show Bottom Content', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',

                ]
            );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
            $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
            $category = !empty($settings['_rhr_clients_category']) ? $settings['_rhr_clients_category'] : '';

            $args = array(
                'post_type'   => 'rhr_clients',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby'             => 'date',
                'order'               => 'asc',
                'posts_per_page'      => 20,
                'paged' => $paged,
            );

            $args2 = array(
                'post_type'   => 'rhr_clients',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby'             => 'date',
                'order'               => 'desc',
                'posts_per_page'      => 20,
                'paged' => $paged,
            );
            if( !empty( $category ) ) {
                $tax_query[] = array(
                    'taxonomy' => 'rhr_categories',
                    'field'    => 'slug',
                    'terms'    => $category
                );
            }
            $tax_query[] = array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array( 'post-format-quote', 'post-format-link' ),
                'operator' => 'NOT IN'
            );

            if( !empty( $category ) ) {
                $tax_query2[] = array(
                    'taxonomy' => 'rhr_categories',
                    'field'    => 'slug',
                    'terms'    => $category
                );
            }
            $tax_query2[] = array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array( 'post-format-quote', 'post-format-link' ),
                'operator' => 'NOT IN'
            );
            if( ! empty( $tax_query ) ) {
                $tax_query = array_merge( array( 'relation' => 'AND' ), $tax_query );
                $args = array_merge( $args, array( 'tax_query' => $tax_query ) );
            }
            if( ! empty( $tax_query2 ) ) {
                $tax_query2 = array_merge( array( 'relation' => 'AND' ), $tax_query2 );
                $args2 = array_merge( $args2, array( 'tax_query' => $tax_query2 ) );
            }
            $client_query = new \WP_Query( $args );
            $client_query2 = new \WP_Query( $args2 );
        $this->__open_wrap();
        ?>
            <div class="pages-content pc-home-clients">
                <?php if( 'yes' === $settings['show_client'] ) : ?>
                    <?php if (isset($settings['_rhr_cleint_title']) && !empty($settings['_rhr_cleint_title'])): ?>
                        <div class="caption c-center c-white">
                            <span><?php echo $this->parse_text_editor($settings['_rhr_cleint_title']); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="home-clients">

                        <div class="line line-forward">
                            <?php
                                $count = 1;
                                    while ( $client_query->have_posts() ) : $client_query->the_post();
                                    $width = 200;
                                    $height = 200;

                                    $image_id = get_post_thumbnail_id();

                                    $img_attr = array(
                                        'image_id'    => $image_id,
                                        'image_tag'   => true,
                                        'placeholder' => true,
                                        'width'       => $width,
                                        'height'      => $height,
                                        'id'      => '',
                                        'class'      => 'hc-image svg',
                                        'srcset'      => array(
                                            '1024' => array( $width, $height ),
                                            '991'  => array( 991, 460 ),
                                            '768'  => array( 768, 400 ),
                                            '480'  => array( 480, 360 ),
                                            '320'  => array( 320, 260 )
                                        )
                                    );
                                    echo rhr_get_image( $img_attr );
                                $count++; endwhile; wp_reset_postdata();
                            ?>
                        </div>
                        <div class="line line-backward">
                            <?php
                                $count = 1;
                                    while ( $client_query2->have_posts() ) : $client_query2->the_post();

                                    $width2 = 200;
                                    $height2 = 200;

                                    $image_id2 = get_post_thumbnail_id();

                                    $img_attr2 = array(
                                        'image_id'    => $image_id2,
                                        'image_tag'   => true,
                                        'placeholder' => true,
                                        'width'       => $width2,
                                        'height'      => $height2,
                                        'id'      => '',
                                        'class'      => 'hc-image svg',
                                        'srcset'      => array(
                                            '1024' => array( $width2, $height2 ),
                                            '991'  => array( 991, 460 ),
                                            '768'  => array( 768, 400 ),
                                            '480'  => array( 480, 360 ),
                                            '320'  => array( 320, 260 )
                                        )
                                    );
                                    echo rhr_get_image( $img_attr2 );

                                $count++; endwhile; wp_reset_postdata();

                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if( 'yes' === $settings['show_slider'] ) : ?>
                <div class="container-fluid home-stories">
                    <div class="row justify-content-center">
                        <div class="col col-10">
                        <?php if ( isset( $settings['_rhr_slider_type'] ) && $settings['_rhr_slider_type'] == 'by_custom') : ?>
                            <div class="home-gallery">
                                <div class="slides">
                                <?php
                                    if ( !empty( $settings['_rhr_slider_lists'] ) ) :
                                        $i = 1;
                                        foreach ( $settings['_rhr_slider_lists'] as $item ) :
                                        $_image = wp_get_attachment_image_url( $item['_rhr_slider_img']['id'], $settings['thumbnail_size'] );
                                    ?>
                                    <div class="slide" data-title="<?php echo esc_html($item['_rhr_slider_title']); ?>" data-desc="<?php echo esc_html($item['_rhr_slider_contents']); ?>" data-button="<?php echo esc_html($item['_rhr_slider_btn']); ?>" data-link="<?php echo esc_url($item['_rhr_slider_link']['url']); ?>">
                                    <a href="" target="_blank" class="hg-link" data-cursor="scale"><div class="hg-image" style="background-image: url(<?php echo esc_url($_image); ?>);"></div> </a>
                                    </div>
                                    <?php $i++; endforeach; endif; ?>
                                </div>
                                <div class="info">
                                    <a href="" target="_blank" class="hg-link" data-cursor="scale"><div class="g-title"></div> </a>
                                    <div class="g-desc">
                                        <a href="" target="_blank" class="hg-link" data-cursor="scale"><span class="g-desc-text"></span> </a>
                                        <a href="" target="_blank" class="button b-white" data-cursor="scale">
                                            <span></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="g-arrow a-left" data-cursor="left"></div>
                                <div class="g-arrow a-right" data-cursor="right"></div>
                            </div>
                            <?php else: ?>
                                <div class="home-gallery">
                                <div class="slides">
                                <?php
                                    $category_c = !empty($settings['_rhr_slc_category']) ? $settings['_rhr_slc_category'] : '';
                                    $order_by_c = !empty($settings['_rhr_slc_order_by']) ? $settings['_rhr_slc_order_by'] : 'ID';
                                    $order_c = !empty($settings['_rhr_slc_order']) ? $settings['_rhr_slc_order'] : 'desc';
                                    $perpage_c = !empty($settings['_rhr_slc_per_page']) ? $settings['_rhr_slc_per_page'] : 6;
                                    if(!empty($settings['_rhr_slider_case_type']) && $settings['_rhr_slider_case_type'] == 'by_post_id'){
                                        $cls_args = array(
                                            'post_type' => 'rhr_client_cases',
                                            'post__in' => explode( ',', $settings['_rhr_slc_post_id'] ),
                                            'post_status' => 'publish',
                                        );
                                    }else{
                                    $cls_args = array(
                                        'post_type' => 'rhr_client_cases',
                                        'order' => $order_c,
                                        'orderby' => $order_by_c,
                                        'posts_per_page' => $perpage_c,
                                        'ignore_sticky_posts' => 1,
                                        'post_status' => 'publish',
                                    );

                                    if( !empty( $category_c ) ) {
                                        $tax_query_c[] = array(
                                            'taxonomy' => 'rhr_client_cases_categories',
                                            'field'    => 'slug',
                                            'terms'    => $category_c
                                        );
                                    }
                                    $tax_query_c[] = array(
                                        'taxonomy' => 'post_format',
                                        'field' => 'slug',
                                        'terms' => array( 'post-format-quote', 'post-format-link' ),
                                        'operator' => 'NOT IN'
                                    );
                                    if( ! empty( $tax_query_c ) ) {
                                        $tax_query_c = array_merge( array( 'relation' => 'AND' ), $tax_query_c );
                                        $cls_args = array_merge( $cls_args, array( 'tax_query' => $tax_query_c ) );
                                    }
                                }

                                    $cls_q = new \WP_Query( $cls_args );
                                    if ( $cls_q->have_posts() ) :
                                        while ( $cls_q->have_posts() ) : $cls_q->the_post();
                                        $h_s_text = rhr_get_meta_value( get_the_id(), '_rhr_h_s_text' );
                                        $h_s_btntext = rhr_get_meta_value( get_the_id(), '_rhr_h_s_btntext' );
                                        $width_c = 863;
                                        $height_c = 594;

                                        $image_id_c = get_post_thumbnail_id();

                                        $img_attr_c = array(
                                            'image_id'    => $image_id_c,
                                            'image_tag'   => false,
                                            'placeholder' => true,
                                            'width'       => $width_c,
                                            'height'      => $height_c,
                                            'id'      => '',
                                            'class'      => '',
                                            'srcset'      => array(
                                                '1024' => array( $width_c, $height_c ),
                                                '991'  => array( 991, 460 ),
                                                '768'  => array( 768, 400 ),
                                                '480'  => array( 480, 360 ),
                                                '320'  => array( 320, 260 )
                                            )
                                        );
                                        $_img = rhr_get_image( $img_attr_c );
                                    ?>

                                    <div class="slide" data-title="“<?php echo the_title(); ?>”" data-desc="<?php echo html_entity_decode($h_s_text); ?>" data-button="<?php echo html_entity_decode($h_s_btntext); ?>" data-link="<?php echo the_permalink(); ?>">
                                        <a href="" target="_blank" class="hg-link" data-cursor="scale"><div class="hg-image" style="background-image: url(<?php echo esc_url($_img); ?>);"></div></a>
                                    </div>
                                    <?php endwhile; wp_reset_postdata();endif; ?>
                                </div>
                                <div class="info">
                                    <a href="" target="_blank" class="hg-link" data-cursor="scale">
                                        <div class="g-title"></div>
                                    </a>
                                    <div class="g-desc">
                                        <a href="" target="_blank" class="hg-link" data-cursor="scale">
                                            <span class="g-desc-text"></span>
                                        </a>
                                        <a href="" target="_blank" class="button b-white" data-cursor="scale">
                                            <span></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="g-arrow a-left" data-cursor="left"></div>
                                <div class="g-arrow a-right" data-cursor="right"></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if( 'yes' === $settings['show_bottom'] ) : ?>
                <div class="container-fluid">
                    <div class="row justify-content-center pc-home-slider-bottom">
                        <div class="col col-8">
                            <?php if (isset($settings['_rhr_bc_title']) && !empty($settings['_rhr_bc_title'])): ?>
                                <h2 class="title t-small t-white">
                                    <?php echo $this->parse_text_editor($settings['_rhr_bc_title']); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if (isset($settings['_rhr_bc_btn']) && !empty($settings['_rhr_bc_btn'])): ?>
                                <a <?php echo rhr__link($settings['_rhr_bc_link']); ?> class="button b-white" data-cursor="scale">
                                    <span><?php echo $this->parse_text_editor($settings['_rhr_bc_btn']); ?></span>
                                    <div class="arrow svg"></div>
                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                  <div class="row justify-content-center">
                      <div class="col col-8">
                        <div class="triangle svg"></div>
                      </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        <?php
        $this->__close_wrap();
    }

}
