<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Client_Stories extends CREST_BASE{

    public function get_name(){
        return 'rhr-client-stories';
    }

    public function get_title(){
        return esc_html__( 'Client Stories', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-plug';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Client Stories', 'stories', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_cls_preset',
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
            '_rhr_cls_content_section',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_cstories_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Our Clients', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater->add_control(
            '_rhr_cstories_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Our Clients', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_cstories_text',
            [
                'label' => 'Content',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Our clients operate in a world where change is constant, time is critical, and the path forward may often be unclear.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter content here..', 'rhr' ),
                'description' => __( 'Enter content here text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_cstories_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'SEE ALL CLIENTS', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'SEE ALL CLIENTS', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_cstories_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_cstories_btn!' => '',
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_cstories_btn_b',
            [
                'label' => 'Bottom Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'SEE ALL', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'SEE ALL', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_cstories_link_b',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_cstories_btn_b!' => '',
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_stories_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'our_clients',
                'options' => [
                    'our_clients' => __('Our Clients', 'rhr' ),
                    'latest_stories' => __('Latest Stories', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );
        $repeater->add_control(
            '_rhr_cstories_category',
            array(
                'label' => __('Category', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => _get_custom_taxnomies('rhr_clients'),
                'description' => __( 'Choose category (or) Leave it empty to display all.', 'rhr' ),
                'condition' => [
                    '_rhr_stories_type' => ['our_clients']
                ]
            )
        );
        $repeater->add_control(
            '_rhr_lstories_category',
            array(
                'label' => __('Category', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => _get_custom_taxnomies('rhr_client_cases'),
                'description' => __( 'Choose category (or) Leave it empty to display all.', 'rhr' ),
                'condition' => [
                    '_rhr_stories_type' => ['latest_stories']
                ]
            )
        );
        $repeater->add_control(
            '_rhr_cstories_order_by',
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
            ]
        );
        $repeater->add_control(
            '_rhr_cstories_order',
            [
                'label' => __('Order', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase' => __('Ascending Order', 'rhr' ),
                    'desc' => __('Descending Order', 'rhr' ),
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_cstories_per_page', [
                'label' => esc_html__('Per Page', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'rhr' ),
                'min'         => 1,
                'default' => 20,
                'description' => __( 'Enter the integer value to display client item (or) Leave it to apply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_cstories_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_cstories_tab_title' => __( 'Our Clients', 'rhr' ),
                        '_rhr_cstories_title' => __( 'Our Clients', 'rhr' ),
                        '_rhr_cstories_text' => __( 'Our clients operate in a world where change is constant, time is critical, and the path forward may often be unclear.', 'rhr' ),
                        '_rhr_cstories_btn' => __( 'SEE ALL CLIENTS', 'rhr' ),
                        '_rhr_stories_type' => 'our_clients',
                        '_rhr_cstories_category' => '',
                        '_rhr_cstories_order_by' => 'date',
                        '_rhr_cstories_order' => 'desc',
                        '_rhr_cstories_per_page' => '12',
                    ],
                    [
                        '_rhr_cstories_tab_title' => __( 'Latest Stories', 'rhr' ),
                        '_rhr_cstories_title' => __( 'Latest Stories', 'rhr' ),
                        '_rhr_cstories_text' => __( 'Discover RHR in the news and see all the latest developments in the organizational psychology space.', 'rhr' ),
                        '_rhr_cstories_btn' => __( 'SEE ALL STORIES', 'rhr' ),
                        '_rhr_stories_type' => 'latest_stories',
                        '_rhr_lstories_category' => '',
                        '_rhr_cstories_order_by' => 'date',
                        '_rhr_cstories_order' => 'desc',
                        '_rhr_cstories_per_page' => '12',
                    ],
                ],
                'title_field' => '{{ _rhr_cstories_tab_title }}',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );

        $this->__open_wrap();
        ?>
            <div class="pages-content pc-paddingTop">
                <div class="container-fluid">
                    <div class="row justify-content-center align-top">
                        <div class="col col-2 sidenav-wrap service-terms">
                        <?php if ( !empty( $settings['_rhr_cstories_lists'] ) ) : ?>
                            <div class="menu-navigate">
                                <div class="items">
                                <?php
                                    $i = 1;
                                    foreach ( $settings['_rhr_cstories_lists'] as $index => $item_tab ) :
                                        $tab_count = $index + 1;
                                        $active_class = $i == 1 ? ' active' : '';
                                ?>
                                <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($item_tab['_rhr_cstories_tab_title']); ?></a>
                                <?php $i++; endforeach; ?>
                                </div>
                            </div>
                            <div class="line">
                                    <div class="l-bar"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col col-8">
                            <?php
                                if ( !empty( $settings['_rhr_cstories_lists'] ) ) :
                                    $i = 1;
                                    foreach ( $settings['_rhr_cstories_lists'] as $index => $item ) :
                                        $tab_count = $index + 1;
                                        $posttype = '';
                                        $order_by = !empty($item['_rhr_cstories_order_by']) ? $item['_rhr_cstories_order_by'] : 'date';
                                        $order = !empty($item['_rhr_cstories_order']) ? $item['_rhr_cstories_order'] : 'desc';
                                        $per_page = !empty($item['_rhr_cstories_per_page']) ? $item['_rhr_cstories_per_page'] : 12;

                            ?>
                            <?php if( $item['_rhr_stories_type'] === 'our_clients' ) :
                                $category = !empty($item['_rhr_cstories_category']) ? $item['_rhr_cstories_category'] : '';

                                $stories_args = array(
                                    'post_type' => 'rhr_clients',
                                    'order' => $order,
                                    'orderby' => $order_by,
                                    'posts_per_page' => $per_page,
                                    'ignore_sticky_posts' => 1,
                                    'post_status' => 'publish',
                                );
                                if( !empty( $category  ) ){
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
                                if( ! empty( $tax_query ) ) {
                                    $tax_query = array_merge( array( 'relation' => 'AND' ), $tax_query );
                                    $stories_args = array_merge( $stories_args, array( 'tax_query' => $tax_query ) );
                                }
                                $stories_q = new \WP_Query( $stories_args );


                                ?>
                                <div class="pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <div class="pc-inner">
                                        <div class="pc-left">
                                            <div class="caption c-light">
                                                <?php if (isset($item['_rhr_cstories_title']) && !empty($item['_rhr_cstories_title'])): ?>
                                                    <span><?php echo $this->parse_text_editor($item['_rhr_cstories_title']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="pc-right">
                                            <?php if (isset($item['_rhr_cstories_text']) && !empty($item['_rhr_cstories_text'])): ?>
                                                <div class="paragraph p-gray p-medium">
                                                    <?php echo $this->parse_text_editor($item['_rhr_cstories_text']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($item['_rhr_cstories_btn']) && !empty($item['_rhr_cstories_btn'])): ?>
                                                <a <?php echo rhr__link($item['_rhr_cstories_link']); ?> class="button" data-cursor="scale">
                                                    <span><?php echo $this->parse_text_editor($item['_rhr_cstories_btn']); ?></span>
                                                    <div class="arrow svg"></div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="pc-inner">
                                        <div class="clients">
                                            <?php
                                                if ( $stories_q->have_posts() ) :
                                                while ( $stories_q->have_posts() ) : $stories_q->the_post();
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
                                                    'class'      => '',
                                                    'srcset'      => array(
                                                        '1024' => array( $width, $height ),
                                                        '991'  => array( 991, 460 ),
                                                        '768'  => array( 768, 400 ),
                                                        '480'  => array( 480, 360 ),
                                                        '320'  => array( 320, 260 )
                                                    )
                                                );

                                                ?>
                                                <div data-ids="<?php echo get_the_ID(); ?>" class="c-image svg">
                                            <?php echo rhr_get_image( $img_attr );  ?></div>
                                            <?php endwhile; wp_reset_postdata();endif; ?>
                                        </div>
                                        <?php if (isset($item['_rhr_cstories_btn_b']) && !empty($item['_rhr_cstories_btn_b'])): ?>
                                            <a <?php echo rhr__link($item['_rhr_cstories_link_b']); ?> class="link l-center" data-cursor="scale">
                                                <span><?php echo $this->parse_text_editor($item['_rhr_cstories_btn_b']); ?></span>
                                                <div class="arrow svg"></div>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else:
                                $lcategory = !empty($item['_rhr_lstories_category']) ? $item['_rhr_lstories_category'] : '';

                                $stories_n_args = array(
                                    'post_type' => 'rhr_client_cases',
                                    'order' => $order,
                                    'orderby' => $order_by,
                                    'posts_per_page' => $per_page,
                                    'ignore_sticky_posts' => 1,
                                    'post_status' => 'publish',
                                );
                                if( !empty( $lcategory  ) ){
                                    $ltax_query[] = array(
                                        'taxonomy' => 'rhr_client_cases_categories',
                                        'field'    => 'slug',
                                        'terms'    => $lcategory
                                    );
                                }

                                $ltax_query[] = array(
                                    'taxonomy' => 'post_format',
                                    'field' => 'slug',
                                    'terms' => array( 'post-format-quote', 'post-format-link' ),
                                    'operator' => 'NOT IN'
                                );
                                if( ! empty( $ltax_query ) ) {
                                    $ltax_query = array_merge( array( 'relation' => 'AND' ), $ltax_query );
                                    $stories_n_args = array_merge( $stories_n_args, array( 'tax_query' => $ltax_query ) );
                                }
                                $stories_n = new \WP_Query( $stories_n_args );

                                ?>
                                <div class="pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <div class="pc-inner">
                                        <div class="pc-left">
                                            <div class="caption c-light">
                                            <?php if (isset($item['_rhr_cstories_title']) && !empty($item['_rhr_cstories_title'])): ?>
                                                    <span><?php echo $this->parse_text_editor($item['_rhr_cstories_title']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="pc-right">
                                            <?php if (isset($item['_rhr_cstories_text']) && !empty($item['_rhr_cstories_text'])): ?>
                                                <div class="paragraph p-gray p-medium">
                                                    <?php echo $this->parse_text_editor($item['_rhr_cstories_text']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($item['_rhr_cstories_btn']) && !empty($item['_rhr_cstories_btn'])): ?>
                                                <a <?php echo rhr__link($item['_rhr_cstories_link']); ?> class="button" data-cursor="scale">
                                                    <span><?php echo $this->parse_text_editor($item['_rhr_cstories_btn']); ?></span>
                                                    <div class="arrow svg"></div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="pc-inner">
                                        <div class="stories">
                                            <?php
                                                if ( $stories_n->have_posts() ) :
                                                while ( $stories_n->have_posts() ) : $stories_n->the_post();
                                            ?>
                                                <a href="<?php the_permalink(); ?>" class="item" data-cursor="scale">
                                                <?php  if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail( 'rhr_clients_cases_stories' ); ?>
                                                <?php else: rhr_default_featured_imgae(); endif; ?>
                                                <?php
                                                $categories = get_the_terms( get_the_ID() , 'rhr_client_cases_categories' );
                                                if(!empty($categories)):
                                                ?>
                                                <div class="name"><?php echo esc_html($categories[0]->name); ?></div>
                                                <?php endif; ?>
                                                <div class="s-title"><?php the_title(); ?></div>
                                                </a>
                                            <?php endwhile; wp_reset_postdata(); endif; ?>

                                        </div>
                                        <?php if (isset($item['_rhr_cstories_btn_b']) && !empty($item['_rhr_cstories_btn_b'])): ?>
                                            <a <?php echo rhr__link($item['_rhr_cstories_link_b']); ?> class="link l-center" data-cursor="scale">
                                                <span><?php echo $this->parse_text_editor($item['_rhr_cstories_btn_b']); ?></span>
                                                <div class="arrow svg"></div>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php $i++; endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $this->__close_wrap();
    }

}
