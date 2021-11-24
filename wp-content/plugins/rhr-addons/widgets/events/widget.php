<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Events extends CREST_BASE{

    public function get_name(){
        return 'rhr-events';
    }

    public function get_title(){
        return esc_html__( 'Events', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-plug';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Events', 'Event', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_events_preset',
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
            '_rhr_events_content_section',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_event_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Next Events', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater->add_control(
            '_rhr_event_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'post_type' => '',
                'default' => 'next_events',
                'options' => [
                    'next_events' => __('Next Events', 'rhr' ),
                    'upcoming_events' => __('Upcoming Events', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );
        $repeater->add_control(
            '_rhr_event_category',
            array(
                'label' => __('Category', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => _get_custom_taxnomies('rhr_events'),
                'description' => __( 'Choose category (or) Leave it empty to display all.', 'rhr' ),
                'condition' => [
                    '_rhr_event_type' => ['upcoming_events']
                ]
            )
        );
        $repeater->add_control(
            '_rhr_event_order_by',
            [
                'label' => __('Order By', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    '_rhr_start_from' => __('Start Date', 'rhr' ),
                    '_rhr_end_from' => __('End Date', 'rhr' ),
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
                    '_rhr_event_type' => ['upcoming_events']
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_event_order',
            [
                'label' => __('Order', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase' => __('Ascending Order', 'rhr' ),
                    'desc' => __('Descending Order', 'rhr' ),
                ],
                'condition' => [
                    '_rhr_event_type' => ['upcoming_events']
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_event_per_page', [
                'label' => esc_html__('Per Page', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'rhr' ),
                'min'         => 1,
                'default' => 20,
                'description' => __( 'Enter the integer value to display client item (or) Leave it to apply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_event_type' => ['upcoming_events']
                ],
            ]
        );
        $this->add_control(
            '_rhr_event_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_event_tab_title' => __( 'Next Events', 'rhr' ),
                        '_rhr_event_type' => 'next_events',
                    ],
                    [
                        '_rhr_event_tab_title' => __( 'Upcoming Events', 'rhr' ),
                        '_rhr_event_type' => 'upcoming_events',
                        '_rhr_event_category' => '',
                        '_rhr_clien_order_by' => 'meta_value_num',
                        '_rhr_event_order' => 'desc',
                        '_rhr_event_per_page' => '6',
                    ],
                ],
                'title_field' => '{{ _rhr_event_tab_title }}',
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
                        <?php if ( !empty( $settings['_rhr_event_lists'] ) ) : ?>
                        <div class="menu-navigate">
                            <div class="items">
                                <?php
                                    $i = 1;
                                    foreach ( $settings['_rhr_event_lists'] as $index => $item ) :
                                        $tab_count = $index + 1;
                                        $active_class = $i == 1 ? ' active' : '';
                                ?>
                                <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($item['_rhr_event_tab_title']); ?></a>
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
                            if ( !empty( $settings['_rhr_event_lists'] ) ) :
                                $i = 1;
                                foreach ( $settings['_rhr_event_lists'] as $index => $item ) :
                                    $tab_count = $index + 1;
                        ?>
                        <?php if( $item['_rhr_event_type'] == 'next_events' ) :

                            $next_args = array(
                                'post_type' => 'rhr_events',
                                'order' => 'asc',
                                'orderby' => 'meta_value_num',
                                'posts_per_page' => 1,
                                'ignore_sticky_posts' => 1,
                                'post_status' => 'publish',
                                'meta_key' => '_rhr_next_events',
                                'meta_value' => 'yes',
                            );
                            $next_q = new \WP_Query( $next_args );
                            ?>
                            <div class="pc-initial-events pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <?php if ( $next_q->have_posts() ) :
                                    while ( $next_q->have_posts() ) : $next_q->the_post();
                                    $is_next = rhr_get_meta_value( get_the_id(), '_rhr_next_events' );
                                    $event_from = rhr_get_meta_value( get_the_id(), '_rhr_start_from' );
                                    $event_end = rhr_get_meta_value( get_the_id(), '_rhr_end_from' );
                                    $event_end_format = date("F j, Y" , strtotime($event_end));
                                    $e_end_date = !empty($event_end_format) ? ' - ' . $event_end_format : '';
                                    $width = 576;
                                    $height = 440;

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
                                    <div class="pc-left">
                                        <div class="image">
                                            <a href="<?php the_permalink(); ?>" data-cursor="scale">
                                                <?php echo rhr_get_image( $img_attr ); ?>
                                            </a>
                                        </div>
                                    </div>
                                <div class="pc-right">

                                    <div class="date-events">
                                    <h4 class="events-heading"><?php echo esc_html__('Next Events', 'rhr'); ?></h4>
                                    <?php echo get_the_time( get_option('date_format') ); ?>
                                    </div>
                                    <h1 class="title t-tinny">
                                        <a href="<?php the_permalink(); ?>" data-cursor="scale">
                                            <?php the_title(); ?>
                                    </a>
                                    </h1>
                                    <div class="paragraph p-gray">
                                        <?php
                                             if ( ! has_excerpt() ) {
                                                echo wp_trim_words( get_the_content(), 40, '...' );
                                            }else{
                                                echo wp_trim_words( get_the_excerpt(), 40, '...' );
                                            }
                                        ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="button" data-cursor="scale">
                                        <span><?php echo esc_html__('Read More', 'rhr'); ?></span>
                                        <div class="arrow svg"></div>
                                    </a>
                                </div>
                                <?php endwhile; wp_reset_postdata();endif; ?>
                            </div>
                            <?php else: ?>
                            <div class="pc-inner pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <div class="events">
                                    <?php
                                     $meta_quer_args = array(
                                        'relation'  =>   'OR',
                                        array(
                                            'key' => '_rhr_start_from',
                                            'value' => date('Y-m-d'),
                                            'compare' => '>=',
                                            'type' => 'date'
                                        ),
                                        array(
                                            'key' => '_rhr_end_from',
                                            'value' => date('Y-m-d'),
                                            'compare' => '>=',
                                            'type' => 'date'
                                        ),
                                    );
                                    $category = !empty($item['_rhr_event_category']) ? $item['_rhr_event_category'] : '';
                                    $order_by = !empty($item['_rhr_event_order_by']) ? $item['_rhr_event_order_by'] : 'meta_value_num';
                                    $order = !empty($item['_rhr_event_order']) ? $item['_rhr_event_order'] : 'desc';
                                    $item = !empty($item['_rhr_event_per_page']) ? $item['_rhr_event_per_page'] : 6;
                                    $up_args = array(
                                        'post_type' => 'rhr_events',
                                        'order' => $order,
                                        'orderby' => $order_by,
                                        'posts_per_page' => $item,
                                        'ignore_sticky_posts' => 1,
                                        'post_status' => 'publish',
                                        'meta_query'  =>   $meta_quer_args
                                    );
                                    if( !empty( $category ) ) {
                                        $tax_query[] = array(
                                            'taxonomy' => 'rhr_event_categories',
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
                                        $up_args = array_merge( $up_args, array( 'tax_query' => $tax_query ) );
                                    }

                                    $up_q = new \WP_Query( $up_args );
                                    if ( $up_q->have_posts() ) :
                                        while ( $up_q->have_posts() ) : $up_q->the_post();
                                        $event_from = rhr_get_meta_value( get_the_id(), '_rhr_start_from' );
                                        $event_end = rhr_get_meta_value( get_the_id(), '_rhr_end_from' );
                                        $event_end_format = date("F j, Y" , strtotime($event_end));
                                        $e_end_date = !empty($event_end_format) ? ' - ' . $event_end_format : '';

                                    ?>
                                    <h4 class="events-heading"><?php echo esc_html__('Upcoming Events', 'rhr'); ?></h4>
                                    <a href="<?php the_permalink(); ?>" class="item" data-cursor="scale">
                                        <div class="date">
                                          <?php echo get_the_time( get_option('date_format') ); ?>
                                        </div>
                                        <div class="text">
                                            <?php the_title(); ?>
                                        </div>
                                    </a>
                                    <?php endwhile; wp_reset_postdata();endif; ?>
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
