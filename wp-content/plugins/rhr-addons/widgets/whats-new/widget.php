<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Whats_New extends CREST_BASE{

    public function get_name(){
        return 'rhr-whats-new';
    }

    public function get_title(){
        return esc_html__( 'Whats New', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-posts-grid';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'news', 'news', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_news_preset',
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
            '_rhr_news_content_section',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_whtas_new_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'RHR in the news', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater->add_control(
            '_rhr_whats_new_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'post_type' => '',
                'default' => 'top_news',
                'options' => [
                    'top_news' => __('Top News', 'rhr' ),
                    'top_events' => __('Top Events', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );
        $repeater->add_control(
            '_rhr_whats_new_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'SEE ALL EVENTS', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'See all Events', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_whats_new_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_whats_new_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_whats_new_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_whtas_new_tab_title' => __( 'RHR in the news', 'rhr' ),
                        '_rhr_whats_new_type' => 'top_news',
                        '_rhr_whats_new_btn' => 'SEE ALL NEWS',
                    ],
                    [
                        '_rhr_whtas_new_tab_title' => __( 'Events', 'rhr' ),
                        '_rhr_whats_new_type' => 'top_events',
                        '_rhr_whats_new_btn' => 'SEE ALL EVENTS',

                    ],
                ],
                'title_field' => '{{ _rhr_whtas_new_tab_title }}',
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
                        <div class="menu-navigate">
                            <div class="items">
                                <?php
                                    if ( !empty( $settings['_rhr_whats_new_lists'] ) ) :
                                        $i = 1;
                                        foreach ( $settings['_rhr_whats_new_lists'] as $index => $item ) :
                                            $tab_count = $index + 1;
                                            $active_class = $i == 1 ? ' active' : '';
                                ?>
                                <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($item['_rhr_whtas_new_tab_title']); ?></a>
                                <?php $i++; endforeach; endif; ?>
                            </div>
                        </div>
                        <div class="line">
                            <div class="l-bar"></div>
                        </div>
                    </div>
                    <div class="col col-8">
                        <?php
                            if ( !empty( $settings['_rhr_whats_new_lists'] ) ) :
                                $i = 1;
                                foreach ( $settings['_rhr_whats_new_lists'] as $index => $item ) :
                                    $tab_count = $index + 1;
                                    $active_class = $i == 1 ? ' active' : '';
                        ?>
                        <?php if( $item['_rhr_whats_new_type'] == 'top_news' ) :
                            $next_args = array(
                                'post_type' => 'rhr_news',
                                'order' => 'desc',
                                'orderby' => 'date',
                                'posts_per_page' => 1,
                                'ignore_sticky_posts' => 1,
                                'post_status' => 'publish',
                                'meta_key' => '_rhr_featured_news',
                                'meta_value' => 'yes'
                            );
                            $next_q = new \WP_Query( $next_args );
                            ?>
                            <div class="pc-initial-events whats-new-events pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                            <?php if ( $next_q->have_posts() ) : ?>
                            <div class="whtas-new-inner">
                                <?php
                                    while ( $next_q->have_posts() ) : $next_q->the_post();
                                    $is_next = rhr_get_meta_value( get_the_id(), '_rhr_featured_news' );
                                    $news_date = rhr_get_meta_value( get_the_id(), '_rhr_news_from' );

                                    if ( has_post_thumbnail() ) :
                                        $image = wp_get_attachment_image_url( get_post_thumbnail_id(), 'rhr_news' );
                                    ?>
                                    <div class="pc-left">
                                        <div class="image">
                                        <a href="<?php the_permalink(); ?>" data-cursor="scale">
                                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>"/>
                                        </a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="pc-left">
                                        <div class="image">
                                        <a href="<?php the_permalink(); ?>" data-cursor="scale">
                                            <?php rhr_default_featured_imgae(); ?>
                                        </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="pc-right">
                                    <div class="date-events">
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
                                <?php endwhile; wp_reset_postdata();?>
                                </div>
                                <?php if (isset($item['_rhr_whats_new_btn']) && !empty($item['_rhr_whats_new_btn'])): ?>
                                    <a <?php echo rhr__link($item['_rhr_whats_new_link']); ?> class="button whats-new-inner-btn" data-cursor="scale">
                                        <span><?php echo $this->parse_text_editor($item['_rhr_whats_new_btn']); ?></span>
                                        <div class="arrow svg"></div>
                                    </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <?php else:
                                $events_args = array(
                                    'post_type' => 'rhr_events',
                                    'order' => 'asc',
                                    'orderby' => 'meta_value_num',
                                    'posts_per_page' => 1,
                                    'ignore_sticky_posts' => 1,
                                    'post_status' => 'publish',
                                    'meta_key' => '_rhr_next_events',
                                    'meta_value' => 'yes',
                                );
                                $events_q = new \WP_Query( $events_args );

                                ?>
                                <div class="pc-initial-events whats-new-events pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <?php if ( $events_q->have_posts() ) : ?>
                                    <div class="whtas-new-inner">
                                    <?php
                                    while ( $events_q->have_posts() ) : $events_q->the_post();
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
                                    <?php echo esc_attr(date("F j, Y" , strtotime($event_from)) . $e_end_date); ?>
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
                                <?php endwhile; wp_reset_postdata();?>
                            </div>
                            <?php if (isset($item['_rhr_whats_new_btn']) && !empty($item['_rhr_whats_new_btn'])): ?>
                                    <a <?php echo rhr__link($item['_rhr_whats_new_link']); ?> class="button whats-new-inner-btn" data-cursor="scale">
                                        <span><?php echo $this->parse_text_editor($item['_rhr_whats_new_btn']); ?></span>
                                        <div class="arrow svg"></div>
                                    </a>
                                    <?php endif; ?>
                                <?php endif; ?>
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
