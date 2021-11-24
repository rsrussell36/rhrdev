<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\this;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\CREST_BASE;
use \KC_GLOBAL\Query as Query_Builder;

if (!defined('ABSPATH')) exit;

class Resources extends CREST_BASE{

    public function get_name(){
        return 'rhr-resources';
    }

    public function get_title(){
        return esc_html__( 'Resources', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-editor-list-ol';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Resources', 'resources', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_resor_preset',
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
            '_rhr_resor_content_section',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_resor_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Last updates', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_resor_type',
            [
                'label' => 'Type',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Blog', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter type..', 'rhr' ),
                'description' => __( 'Enter type text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_text_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'See All', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'See All', 'rhr' ),
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
            '_rhr_resor_query_section',
            [
                'label' => __( 'Query', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_resor_layout',
            [
                'label' => __('Layout', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'post_type' => '',
                'default' => 'masonry',
                'options' => [
                    'masonry' => __('Masonry', 'rhr' ),
                    'grid' => __('Grid', 'rhr' ),
                    'list' => __('List', 'rhr' ),
                ],
                'label_block' => false,
                'multiple' => false,
            ]
        );
        $this->add_control(
            '_rhr_res_filter',
            array(
                'label' => __('Source', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'options' => $this->_get_resources_post_types(),
                'default' => 'post',
                'description' => __( 'Choose post type (or) Leave it empty to aply default.', 'rhr' ),
            )
        );
        foreach ($this->_get_resources_post_types() as $key => $type) {
            $taxonomy = $this->_get_taxnomies($key);

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
                                    '_rhr_res_filter' => $key,
                                ],
                            )
                        );
                    }
                }
            }
        }
        $this->add_control(
            '_rhr_res_include_authors',
            array(
                'label' => __('Authors', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->_get_authors(),
            )
        );
        $this->add_control(
            '_rhr_res_ignore_sticky_posts', [
                'label' => __('Ignore Sticky Posts', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => __( 'Sticky-posts ordering is visible on frontend only (or) Leave it empty to aply default.', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_res_post_offset', [
                'label' => esc_html__('Offset', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
                'min' => '0',
                'label_block' => false,
                'description' => __('This option is used to exclude number of initial posts from being display.)', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_res_query_exclude_current',
            array(
                'label' => __('Exclude Current Post', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('This option will remove the current post from the query.', 'rhr' ),
                'label_on' => __('Yes', 'rhr' ),
                'label_off' => __('No', 'rhr' ),
            )
        );
        $this->add_control(
            '_rhr_res_post_custom_date',
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
            ]
        );

        $this->add_control(
            '_rhr_res_post_before_date',
            [
                'label' => __('Before', 'rhr' ),
                'type' => Controls_Manager::DATE_TIME,
                'post_type' => '',
                'label_block' => false,
                'multiple' => false,
                'placeholder' => __('Choose', 'rhr' ),
                'condition' => [
                    '_rhr_res_post_custom_date' => ['exact'],
                ],
                'description' => __('Setting a ‘Before’ date will show all the posts published until the chosen date (inclusive).', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_res_post_date_after',
            [
                'label' => __('After', 'rhr' ),
                'type' => Controls_Manager::DATE_TIME,
                'post_type' => '',
                'label_block' => false,
                'multiple' => false,
                'placeholder' => __('Choose', 'rhr' ),
                'condition' => [
                    '_rhr_res_post_custom_date' => ['exact'],
                ],
                'description' => __('Setting an ‘After’ date will show all the posts published since the chosen date (inclusive).', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_res_posts_per_page', [
                'label' => esc_html__('Posts Per Page', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'rhr' ),
                'min'         => 1,
                'default' => 3,
            ]
        );
        $this->add_control(
            '_rhr_res_order_by',
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
        $this->add_control(
            '_rhr_res_order',
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
        $this->add_control(
            '_rhr_resources_empty_message',
            array(
                'label' => __('Empty Query Message', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_rhr_resor_content_section_l',
            [
                'label' => __( 'Right Content', 'rhr' ),
                'condition' => [
                    '_rhr_resor_layout' => ['list']
                ]
            ]
        );
        $this->add_control(
            '_rhr_resor_title_l',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Last updates', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_resor_type_l',
            [
                'label' => 'Type',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Blog', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter type..', 'rhr' ),
                'description' => __( 'Enter type text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_text_btn_l',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'See All', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'See All', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_text_link_l',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_text_btn_l!' => '',
                ],
            ]
        );
        $this->end_controls_section();
         $this->start_controls_section(
            '_rhr_resor_query_section_l',
            [
                'label' => __( 'Right Query', 'rhr' ),
                'condition' => [
                    '_rhr_resor_layout' => ['list']
                ]
            ]
        );


        $this->add_control(
            '_rhr_res_filter_l',
            array(
                'label' => __('Source', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'options' => $this->_get_resources_post_types(),
                'default' => 'post',
                'description' => __( 'Choose post type (or) Leave it empty to aply default.', 'rhr' ),
            )
        );
        foreach ($this->_get_resources_post_types() as $key => $type) {
            $taxonomy = $this->_get_taxnomies($key);

            if (!empty($taxonomy)) {
                foreach ($taxonomy as $index => $tax) {

                    $terms = get_terms($index, array('hide_empty' => false));

                    $related_tax = array();

                    if (!empty($terms)) {

                        foreach ($terms as $t_index => $t_obj) {

                            $related_tax[$t_obj->slug] = $t_obj->name;
                        }

                        $this->add_control(
                            'tax_' . $index . '_' . $key . '_include_l',
                            array(
                                'label' => sprintf(__('By %s', 'rhr' ), $tax->label),
                                'type' => Controls_Manager::SELECT2,
                                'default' => '',
                                'multiple' => true,
                                'label_block' => true,
                                'options' => $related_tax,
                                'condition' => [
                                    '_rhr_res_filter_l' => $key,
                                ],
                            )
                        );
                    }
                }
            }
        }
        $this->add_control(
            '_rhr_res_include_authors_l',
            array(
                'label' => __('Authors', 'rhr' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->_get_authors(),
            )
        );
        $this->add_control(
            '_rhr_res_ignore_sticky_posts_l', [
                'label' => __('Ignore Sticky Posts', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => __( 'Sticky-posts ordering is visible on frontend only (or) Leave it empty to aply default.', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_res_post_offset_l', [
                'label' => esc_html__('Offset', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
                'min' => '0',
                'label_block' => false,
                'description' => __('This option is used to exclude number of initial posts from being display.)', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_res_query_exclude_current_l',
            array(
                'label' => __('Exclude Current Post', 'rhr' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('This option will remove the current post from the query.', 'rhr' ),
                'label_on' => __('Yes', 'rhr' ),
                'label_off' => __('No', 'rhr' ),
            )
        );
        $this->add_control(
            '_rhr_res_post_custom_date_l',
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
            ]
        );

        $this->add_control(
            '_rhr_res_post_before_date_l',
            [
                'label' => __('Before', 'rhr' ),
                'type' => Controls_Manager::DATE_TIME,
                'post_type' => '',
                'label_block' => false,
                'multiple' => false,
                'placeholder' => __('Choose', 'rhr' ),
                'condition' => [
                    '_rhr_res_post_custom_date_l' => ['exact'],
                ],
                'description' => __('Setting a ‘Before’ date will show all the posts published until the chosen date (inclusive).', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_res_post_date_after_l',
            [
                'label' => __('After', 'rhr' ),
                'type' => Controls_Manager::DATE_TIME,
                'post_type' => '',
                'label_block' => false,
                'multiple' => false,
                'placeholder' => __('Choose', 'rhr' ),
                'condition' => [
                    '_rhr_res_post_custom_date_l' => ['exact'],
                ],
                'description' => __('Setting an ‘After’ date will show all the posts published since the chosen date (inclusive).', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_res_posts_per_page_l', [
                'label' => esc_html__('Posts Per Page', 'rhr' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'rhr' ),
                'min'         => 1,
                'default' => 3,
            ]
        );
        $this->add_control(
            '_rhr_res_order_by_l',
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
        $this->add_control(
            '_rhr_res_order_l',
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
        $this->add_control(
            '_rhr_resources_empty_message_l',
            array(
                'label' => __('Empty Query Message', 'rhr' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $query = $this->_get_resources_grid_query();
        $query_l = $this->_get_resources_grid_query_l();
        if ( ! $query->have_posts() ) {
            $_get_error_message = $settings['_rhr_blog_empty_message'];
            $this->_get_empty_message( $_get_error_message );
            return;
        }


        $this->__open_wrap();
        ?>
        <div class="pages-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-10">
                        <?php if($settings['_rhr_resor_layout'] == 'masonry'): ?>
                            <div class="pc-initial-resources">
                                <div class="resources pc-left">
                                    <div class="items i-highlight">
                                        <?php
                                            $ms = 1;
                                                while ( $query->have_posts() ) : $query->the_post();?>
                                                    <?php if($ms == 1) : ?>
                                                        <a href="<?php the_permalink();?>" class="item" data-cursor="scale">
                                                            <div class="wrapper">
                                                            <?php
                                                                 $width = 719;
                                                                 $height = 440;

                                                                 $image_id = get_post_thumbnail_id();

                                                                 $img_attr = array(
                                                                     'image_id'    => $image_id,
                                                                     'image_tag'   => true,
                                                                     'placeholder' => true,
                                                                     'width'       => $width,
                                                                     'height'      => $height,
                                                                     'id'          => '',
                                                                     'class'       => '',
                                                                     'srcset'      => array(
                                                                         '1024' => array( $width, $height ),
                                                                         '991'  => array( 991, 460 ),
                                                                         '768'  => array( 768, 400 ),
                                                                         '480'  => array( 480, 360 ),
                                                                         '320'  => array( 320, 260 )
                                                                     )
                                                                 );
                                                                 echo rhr_get_image( $img_attr );
                                                            ?>
                                                                <div class="infos">
                                                                    <span class="type"><?php $this->_get_res_type(); ?></span>
                                                                    <span class="time"><?php echo get_the_time( get_option('date_format')); ?></span>
                                                                </div>
                                                                <div class="r-title"><?php echo get_the_title(); ?></div>
                                                            </div>
                                                        </a>
                                                    <?php endif; ?>
                                        <?php $ms++; endwhile; wp_reset_postdata();?>
                                    </div>
                                </div>

                                <div class="resources pc-right">
                                    <?php $this->_get_section_data(); ?>
                                    <div class="items i-list">
                                        <?php
                                            $msl = 1;
                                                while ( $query->have_posts() ) : $query->the_post();?>
                                                    <?php if($msl <> 1) : ?>
                                                        <a href="<?php the_permalink();?>" class="item" data-cursor="scale">
                                                            <div class="wrapper">
                                                                <div class="r-title"><?php echo get_the_title(); ?></div>
                                                                <div class="infos">
                                                                    <?php $this->_get_res_type(); ?>
                                                                    <span class="time"><?php echo get_the_time( get_option('date_format')); ?></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endif; ?>
                                        <?php $msl++; endwhile; wp_reset_postdata();?>
                                    </div>
                                </div>
                            </div>

                        <?php elseif($settings['_rhr_resor_layout'] == 'grid'):
                            $count_post = $query->found_posts;
                            $clsss_post = $count_post > 4 ? 'resources-gallery' : 'resources-gallery-rel';
                         ?>
                            <div class="resources <?php echo esc_attr($clsss_post);?>">
                                <?php $this->_get_section_data(); ?>
                                <div class="items">
                                    <?php
                                        $gr = 1;
                                            while ( $query->have_posts() ) : $query->the_post();?>
                                            <a href="<?php the_permalink();?>" class="item" data-cursor="scale">
                                                <div class="wrapper">
                                                    <?php
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
                                                    ?>
                                                    <div class="infos">
                                                    <?php $this->_get_res_type(); ?>
                                                        <span class="time"><?php echo get_the_time( get_option('date_format')); ?></span>
                                                    </div>
                                                    <div class="r-title"><?php echo get_the_title(); ?></div>
                                                </div>
                                            </a>
                                    <?php $gr++; endwhile; wp_reset_postdata();?>
                                </div>
                                <div class="rg-line">
                                    <div class="rg-bar"></div>
                                </div>
                                <?php if($count_post > 4): ?>
                                <div class="rg-arrow a-left" data-cursor="left"></div>
                                <div class="rg-arrow a-right" data-cursor="right"></div>
                            <?php endif; ?>
                            </div>
                        <?php elseif($settings['_rhr_resor_layout'] == 'list'): ?>
                            <div class="pc-resources">
                                <div class="resources pc-left">
                                <?php $this->_get_section_data(); ?>
                                    <div class="items i-list">
                                    <?php
                                        $ls = 1;
                                            while ( $query->have_posts() ) : $query->the_post();?>
                                            <a href="<?php the_permalink();?>" class="item" data-cursor="scale">
                                                <div class="wrapper">
                                                    <div class="infos">
                                                    <?php $this->_get_res_type(); ?>
                                                        <span class="time"><?php echo get_the_time( get_option('date_format')); ?></span>
                                                    </div>
                                                    <div class="r-title"><?php echo get_the_title(); ?></div>
                                                </div>
                                            </a>
                                    <?php $ls++; endwhile; wp_reset_postdata();?>
                                    </div>
                                </div>

                                <div class="resources pc-right">
                                <?php $this->_get_section_data_l(); ?>
                                    <div class="items i-ebook">
                                        <?php
                                        if ( $query_l->have_posts() ) :
                                            $ls2 = 1;
                                                while ( $query_l->have_posts() ) : $query_l->the_post();?>
                                                <a href="<?php the_permalink();?>" class="item" data-cursor="scale">
                                                    <div class="wrapper">
                                                    <?php
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
                                                    ?>
                                                        <div class="infos">
                                                            <?php $this->_get_res_type_l(); ?>
                                                            <div class="r-title"><?php echo get_the_title(); ?></div>
                                                        </div>
                                                    </div>
                                                </a>
                                        <?php $ls2++; endwhile; wp_reset_postdata(); endif;?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $this->__close_wrap();
    }
    protected function _get_resources_post_types($args = [], $array_diff_key = [])
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
    protected function _get_taxnomies($type)
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
    protected function _get_authors()
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
    protected function _get_resources_query_args()
    {

        $settings = $this->get_settings_for_display();
        $tax_count = 0;

        $post_type = $settings['_rhr_res_filter'];

        $post_args = array(
            'post_status' => 'publish',
            'suppress_filters' => false,
        );
        if ( !empty($post_type) ) {
            $post_types = array(
                'post_type' => $post_type
            );
            $post_args = wp_parse_args($post_args, $post_types);
        }

        if (!empty($settings['_rhr_res_order_by']) ) {
            $orderby = array(
                'orderby' => $settings['_rhr_res_order_by'],
            );
            $post_args = wp_parse_args($post_args, $orderby);
        }
        if (!empty($settings['_rhr_res_order'])) {
            $order = array(
                'order' => $settings['_rhr_res_order'],
            );
            $post_args = wp_parse_args($post_args, $order);
        }
        if ( !empty($post_type) ) {
            if ('yes' == $settings['_rhr_res_ignore_sticky_posts']) {
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
        if ( !empty($post_type) ) {
            $posts_per_page = array(
                'posts_per_page' => empty($settings['_rhr_res_posts_per_page']) ? 9999 : $settings['_rhr_res_posts_per_page'],
            );
            $post_args = wp_parse_args($post_args, $posts_per_page);
        }

        if (!empty($settings['_rhr_res_include_authors'])) {
            $author__in = array(
                'author__in' => $settings['_rhr_res_include_authors'],
            );
            $post_args = wp_parse_args($post_args, $author__in);
        }

        if (0 < $settings['_rhr_res_post_offset']) {
            $offset_to_fix = array(
                'offset_to_fix' => $settings['_rhr_res_post_offset'],
            );
            $post_args = wp_parse_args($post_args, $offset_to_fix);
        }
        if ( !empty($post_type) ) {
            $taxonomy = $this->_get_taxnomies($post_type);

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

            if (!empty($tax_query)) {
                $tax_query = wp_parse_args(array('relation' => 'AND'), $tax_query);
                $post_args = wp_parse_args($post_args, array('tax_query' => $tax_query));
            }
        }

        if ( !empty($post_type) ) {
        $select_date = $settings['_rhr_res_post_custom_date'];
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
                        $after_date = $settings['_rhr_res_post_date_after'];
                        if (!empty($after_date)) {
                            $date_query['after'] = $after_date;
                        }
                        $before_date = $settings['_rhr_res_post_before_date'];
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
        if ( 'yes' === $settings['_rhr_res_query_exclude_current'] ) {
            $post_args['post__not_in'][] = get_the_id();
        }
        return $post_args;
    }
    protected function _get_resources_grid_query()
    {

        $post_args = $this->_get_resources_query_args();

        $defaults = array(
            'author' => '',
            'category' => '',
            'orderby' => '',
            'posts_per_page' => 1,

        );

        $query_args = wp_parse_args($post_args, $defaults);

        $query = new \WP_Query($query_args);

        return $query;
    }

    protected function _get_resources_query_args_l()
    {

        $settings = $this->get_settings_for_display();
        $tax_count = 0;

        $post_type = $settings['_rhr_res_filter_l'];

        $post_args = array(
            'post_status' => 'publish',
            'suppress_filters' => false,
        );
        if ( !empty($post_type) ) {
            $post_types = array(
                'post_type' => $post_type
            );
            $post_args = wp_parse_args($post_args, $post_types);
        }

        if (!empty($settings['_rhr_res_order_by_l']) ) {
            $orderby = array(
                'orderby' => $settings['_rhr_res_order_by'],
            );
            $post_args = wp_parse_args($post_args, $orderby);
        }
        if (!empty($settings['_rhr_res_order_l'])) {
            $order = array(
                'order' => $settings['_rhr_res_order'],
            );
            $post_args = wp_parse_args($post_args, $order);
        }
        if ( !empty($post_type) ) {
            if ('yes' == $settings['_rhr_res_ignore_sticky_posts_l']) {
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
        if ( !empty($post_type) ) {
            $posts_per_page = array(
                'posts_per_page' => empty($settings['_rhr_res_posts_per_page_l']) ? 9999 : $settings['_rhr_res_posts_per_page_l'],
            );
            $post_args = wp_parse_args($post_args, $posts_per_page);
        }

        if (!empty($settings['_rhr_res_include_authors_l'])) {
            $author__in = array(
                'author__in' => $settings['_rhr_res_include_authors_l'],
            );
            $post_args = wp_parse_args($post_args, $author__in);
        }

        if (0 < $settings['_rhr_res_post_offset_l']) {
            $offset_to_fix = array(
                'offset_to_fix' => $settings['_rhr_res_post_offset_l'],
            );
            $post_args = wp_parse_args($post_args, $offset_to_fix);
        }
        if ( !empty($post_type) ) {
            $taxonomy = $this->_get_taxnomies($post_type);

            if (!empty($taxonomy) && !is_wp_error($taxonomy)) {

                $tax_count = 0;
                foreach ($taxonomy as $index => $tax) {

                    if (!empty($settings['tax_' . $index . '_' . $post_type . '_include_l'])) {

                        $tax_query[] = array(
                            'taxonomy' => $index,
                            'field' => 'slug',
                            'terms' => $settings['tax_' . $index . '_' . $post_type . '_include_l'],
                            'operator' => 'IN',
                        );
                        $tax_count++;
                    }
                }
            }

            if (!empty($tax_query)) {
                $tax_query = wp_parse_args(array('relation' => 'AND'), $tax_query);
                $post_args = wp_parse_args($post_args, array('tax_query' => $tax_query));
            }
        }

        if ( !empty($post_type) ) {
        $select_date = $settings['_rhr_res_post_custom_date_l'];
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
                        $after_date = $settings['_rhr_res_post_date_after_l'];
                        if (!empty($after_date)) {
                            $date_query['after'] = $after_date;
                        }
                        $before_date = $settings['_rhr_res_post_before_date_l'];
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
        if ( 'yes' === $settings['_rhr_res_query_exclude_current_l'] ) {
            $post_args['post__not_in'][] = get_the_id();
        }
        return $post_args;
    }
    protected function _get_resources_grid_query_l()
    {

        $post_args = $this->_get_resources_query_args_l();

        $defaults = array(
            'author' => '',
            'category' => '',
            'orderby' => '',
            'posts_per_page' => 1,

        );

        $query_args = wp_parse_args($post_args, $defaults);

        $query = new \WP_Query($query_args);

        return $query;
    }

    protected function _get_empty_message( $notice ) {

        if ( empty( $notice ) ) {
            $notice = __( 'The current query has no posts. Please make sure you have published items matching your query.', 'rhr' );
        }

        ?>
        <div class="blog-grid-error-notice">
            <?php echo wp_kses_post( $notice ); ?>
        </div>
        <?php
    }

    protected function _get_section_data() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="r-caption">
            <?php if(!empty($settings['_rhr_resor_title'])):
                echo $this->parse_text_editor($settings['_rhr_resor_title']);
            endif; ?>
            <?php if(!empty($settings['_rhr_text_btn'])): ?>
                <span class="bullet">•</span> <a <?php echo rhr__link($settings['_rhr_text_link']); ?> data-cursor="scale"><?php echo $this->parse_text_editor($settings['_rhr_text_btn']); ?></a></div>
            <?php endif; ?>
        <?php
    }
    protected function _get_res_type() {
        $settings = $this->get_settings_for_display();

        ?>
            <?php if(!empty($settings['_rhr_resor_type'])): ?>
                <span class="type"><?php echo $this->parse_text_editor($settings['_rhr_resor_type']); ?></span>
            <?php endif; ?>
        <?php
    }
    protected function _get_section_data_l() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="r-caption">
            <?php if(!empty($settings['_rhr_resor_title_l'])):
                echo $this->parse_text_editor($settings['_rhr_resor_title_l']);
            endif; ?>
            <?php if(!empty($settings['_rhr_text_btn_l'])): ?>
                <span class="bullet">•</span> <a <?php echo rhr__link($settings['_rhr_text_link_l']); ?> data-cursor="scale"><?php echo $this->parse_text_editor($settings['_rhr_text_btn_l']); ?></a></div>
            <?php endif; ?>
        <?php
    }
    protected function _get_res_type_l() {
        $settings = $this->get_settings_for_display();

        ?>
            <?php if(!empty($settings['_rhr_resor_type_l'])): ?>
                <span class="type"><?php echo $this->parse_text_editor($settings['_rhr_resor_type_l']); ?></span>
            <?php endif; ?>
        <?php
    }
}
