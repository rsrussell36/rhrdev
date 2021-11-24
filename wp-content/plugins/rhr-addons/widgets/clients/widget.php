<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Clients extends CREST_BASE{

    public function get_name(){
        return 'rhr-clients';
    }

    public function get_title(){
        return esc_html__( 'Client', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-slider-full-screen';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Clients', 'Client', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_clients_preset',
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
            '_rhr_clients_content_section',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_client_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Overview', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater->add_control(
            '_rhr_client_type',
            [
                'label' => __('Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'post_type' => '',
                'default' => 'content',
                'options' => [
                    'content' => __('Content', 'rhr' ),
                    'post' => __('Post', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );
        $repeater->add_control(
            '_rhr_client_text',
            [
                'label' => __( 'Text', 'rhr' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'The day-to-day decisions they must make are profound, affecting the vitality and sustainability of the organization, the livelihood of its employees, and the well-being of its customers.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_client_type' => ['content']
                ]
            ]
        );

        $repeater->add_control(
            '_rhr_client_texts',
            [
                'label' => __( 'Text', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'At RHR, we help our clients to navigate this complex environment with the power of high-performance leadership.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_client_type' => ['post']
                ]
            ]
        );
        $repeater->add_control(
            '_rhr_client_category',
            array(
                'label' => __('Category', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => _get_custom_taxnomies('rhr_clients'),
                'description' => __( 'Choose category (or) Leave it empty to display all.', 'rhr' ),
                'condition' => [
                    '_rhr_client_type' => ['post']
                ]
            )
        );
        $repeater->add_control(
            '_rhr_clien_order_by',
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
                    '_rhr_client_type' => ['post']
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_client_order',
            [
                'label' => __('Order', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase' => __('Ascending Order', 'rhr' ),
                    'desc' => __('Descending Order', 'rhr' ),
                ],
                'condition' => [
                    '_rhr_client_type' => ['post']
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_client_per_page', [
                'label' => esc_html__('Per Page', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'rhr' ),
                'min'         => 1,
                'default' => 20,
                'description' => __( 'Enter the integer value to display client item (or) Leave it to apply theme default.', 'rhr' ),
                'condition' => [
                    '_rhr_client_type' => ['post']
                ],
            ]
        );
        $this->add_control(
            '_rhr_client_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_client_tab_title' => __( 'Overview', 'rhr' ),
                        '_rhr_client_type' => 'content',
                        '_rhr_client_text' => __( 'The day-to-day decisions they must make are profound, affecting the vitality and sustainability of the organization, the livelihood of its employees, and the well-being of its customers.', 'rhr' ),
                    ],
                    [
                        '_rhr_client_tab_title' => __( 'Clients', 'rhr' ),
                        '_rhr_client_texts' => __( 'At RHR, we help our clients to navigate this complex environment with the power of high-performance leadership.', 'rhr' ),
                        '_rhr_client_type' => 'post',
                        '_rhr_client_category' => '',
                        '_rhr_clien_order_by' => 'date',
                        '_rhr_client_order' => 'desc',
                        '_rhr_client_per_page' => '20',
                    ],
                ],
                'title_field' => '{{ _rhr_client_tab_title }}',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );

        $this->__open_wrap();
        ?>
             <div class="pages-content pc-paddingTopBg">
                <div class="container-fluid">
                    <div class="row justify-content-center align-top">
                        <div class="col col-2 sidenav-wrap">
                            <?php if ( !empty( $settings['_rhr_client_lists'] ) ) : ?>
                                <div class="menu-navigate">
                                    <div class="items">
                                        <?php
                                            $i = 1;
                                            foreach ( $settings['_rhr_client_lists'] as $index => $item ) :
                                                $tab_count = $index + 1;
                                        ?>
                                        <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($item['_rhr_client_tab_title']); ?></a>
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
                                    if ( !empty( $settings['_rhr_client_lists'] ) ) :
                                        $i = 1;
                                        foreach ( $settings['_rhr_client_lists'] as $index => $item ) :
                                            $tab_count = $index + 1;
                                ?>
                                <?php if( $item['_rhr_client_type'] == 'content' ) : ?>
                                    <div class="pc-initial-clients pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                        <div class="paragraph p-bigger p-white">
                                            <?php echo $this->parse_text_editor($item['_rhr_client_text']); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                <div class="pc-inners pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                <div class="pc-inner">
                                    <div class="pc-left">
                                        <?php  if( !empty($item['_rhr_client_tab_title']) ) : ?>
                                            <div class="caption c-light">
                                                <span><?php echo $this->parse_text_editor($item['_rhr_client_tab_title']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if( !empty($item['_rhr_client_texts']) ) : ?>
                                        <div class="pc-right">
                                            <div class="paragraph p-gray">
                                            <?php echo $this->parse_text_editor($item['_rhr_client_texts']); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="pc-inner">
                                    <div class="clients c-page">
                                        <?php
                                        $category = !empty($item['_rhr_client_category']) ? $item['_rhr_client_category'] : '';
                                        $order_by = !empty($item['_rhr_clien_order_by']) ? $item['_rhr_clien_order_by'] : 'date';
                                        $order = !empty($item['_rhr_client_order']) ? $item['_rhr_client_order'] : 'desc';
                                        $item = !empty($item['_rhr_client_per_page']) ? $item['_rhr_client_per_page'] : 20;
                                        $client_args = array(
                                            'post_type' => 'rhr_clients',
                                            'order' => $order,
                                            'orderby' => $order_by,
                                            'posts_per_page' => $item,
                                            'ignore_sticky_posts' => 1,
                                            'post_status' => 'publish',
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
                                        if( ! empty( $tax_query ) ) {
                                            $tax_query = array_merge( array( 'relation' => 'AND' ), $tax_query );
                                            $client_args = array_merge( $client_args, array( 'tax_query' => $tax_query ) );
                                        }
                                        $clients = new \WP_Query( $client_args );
                                        if ( $clients->have_posts() ) :

                                            while ( $clients->have_posts() ) : $clients->the_post();
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
                                                'class'      => 'c-image svg',
                                                'srcset'      => array(
                                                    '1024' => array( $width, $height ),
                                                    '991'  => array( 991, 460 ),
                                                    '768'  => array( 768, 400 ),
                                                    '480'  => array( 480, 360 ),
                                                    '320'  => array( 320, 260 )
                                                )
                                            );
                                            echo rhr_get_image( $img_attr );

                                        endwhile; wp_reset_postdata();endif; ?>
                                    </div>
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
