<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Banner extends CREST_BASE{

    public function get_name(){
        return 'rhr-banner';
    }

    public function get_title(){
        return esc_html__( 'Banner', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-banner';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'banner', 'video', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_banner_section',
            [
                'label' => __( 'Preset', 'rhr' ),
            ]
        );

        $this->add_control(
            '_rhr_design_banner_section',
            [
                'label' => esc_html__( 'Design Format', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'default' => 'Default',
                    'design-1' => 'Design One',
                ],
                'default' => 'default',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_banner_content',
            [
                'label' => __( 'Content', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_banner_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'We shape leaders,<br> leaders shape<br> <span>the world.</span>', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_banner_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Get Started', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Get Started', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_banner_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_banner_btn!' => '',
                ],
            ]
        );
        $this->add_control(
            '_rhr_banner_img',
            [
                'label' => __( 'Banner Image', 'rhr' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'description' => __( 'Choose banner image (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
                'description' => __( 'Choose banner image size (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            'rhr_hosted_url',
            [
                'label' => __( 'Choose File', 'rhr' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'description' => __( 'Choose video file (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_video_poster',
            [
                'label' => __( 'Video Poster', 'rhr' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_poster',
                'default' => 'large',
                'separator' => 'none',
                'description' => __( 'Choose video poster image size (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' => [
                    'rhr_hosted_url.url!' => ''
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_banner_options',
                [
                    'label' => __( 'Options', 'rhr' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        '_rhr_design_banner_section' => ['default']
                    ]
                ]
            );
            $this->add_control(
                'show_video',
                [
                    'label' => __('Video', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',
                    'description' => __( 'Enable scroll button (or) Leave it empty to aply theme default.', 'rhr' ),
                ]
            );
            $this->add_control(
                'show_scroll',
                [
                    'label' => __('Scroll', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',
                    'description' => __( 'Enable scroll button (or) Leave it empty to aply theme default.', 'rhr' ),
                ]
            );
            $this->add_control(
                'show_vector',
                [
                    'label' => __('Vector', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',
                    'description' => __( 'Enable scroll button (or) Leave it empty to aply theme default.', 'rhr' ),
                ]
            );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_funb_content',
            [
                'label' => __( 'Fun Fact', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_rhr_design_banner_section' => ['design-1']
                ]
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            '_rhr_funb_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Leaders Coached', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_funb_type',
            [
                'label' => esc_html__( 'Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'left' => 'Left',
                    'right' => 'Right',
                    'bottom' => 'Bottom',
                ],
                'default' => 'left',
            ]
        );

        $repeater->add_control(
            '_rhr_funb_number',
            [
                'label' => 'Number',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '10', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter number..', 'rhr' ),
                'description' => __( 'Enter number (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_funb_prefix',
            [
                'label' => 'Prefix',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '+', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter prefix..', 'rhr' ),
                'description' => __( 'Enter prefix (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_funb_sufix',
            [
                'label' => 'Sufix',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'K', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter sufix..', 'rhr' ),
                'description' => __( 'Enter sufix text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_funbfact_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_funb_title' => __( 'Lorem ipsum dolor sit am ipsum sit amet', 'rhr' ),
                        '_rhr_funb_type' => 'left',
                        '_rhr_funb_number' => 34,
                        '_rhr_funb_prefix' => '+',
                        '_rhr_funb_sufix' => '%',
                    ],
                    [
                        '_rhr_funb_title' => __( 'Lorem ipsum dolor sit am ipsum sit amet', 'rhr' ),
                        '_rhr_funb_type' => 'left',
                        '_rhr_funb_number' => 45,
                        '_rhr_funb_prefix' => '+',
                        '_rhr_funb_sufix' => '%',
                    ],
                    [
                        '_rhr_funb_title' => __( 'Lorem ipsum dolor sit am ipsum sit amet', 'rhr' ),
                        '_rhr_funb_type' => 'right',
                        '_rhr_funb_number' => 10,
                        '_rhr_funb_prefix' => '+',
                        '_rhr_funb_sufix' => '%',
                    ],
                    [
                        '_rhr_funb_title' => __( 'Lorem ipsum dolor sit am ipsum sit amet', 'rhr' ),
                        '_rhr_funb_type' => 'bottom',
                        '_rhr_funb_number' => 157,
                        '_rhr_funb_prefix' => '+',
                        '_rhr_funb_sufix' => '%',
                    ],
                ],
                'title_field' => '{{ _rhr_funb_title }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_cimg_content',
            [
                'label' => __( 'Image', 'rhr' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_rhr_design_banner_section' => ['design-1']
                ]
            ]
        );
        $repeater_t = new Repeater();
        $repeater_t->add_control(
            '_rhr_cimge_type',
            [
                'label' => esc_html__( 'Type', 'rhr' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    '1' => 'Top',
                    '2' => 'Center',
                    '3' => 'Right',
                ],
                'default' => 'top',
            ]
        );
        $repeater_t->add_control(
            '_rhr_banner_img_c',
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
        $repeater_t->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_c',
                'default' => 'large',
                'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_img_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_t->get_controls(),
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $banner_image = wp_get_attachment_image_url( $settings['_rhr_banner_img']['id'], $settings['thumbnail_size'] );
        $video_poster = wp_get_attachment_image_url( $settings['_rhr_video_poster']['id'], $settings['thumbnail_poster_size'] );

        $this->__open_wrap();
        ?>
       <div class="pages-content pc-home-webdoor">
        <?php if (isset($settings['show_scroll']) && !empty($settings['show_scroll']) && 'yes' === $settings['show_scroll']): ?>
            <div class="button b-scroll" data-cursor="scale">
                <span><?php echo esc_html__('SCROLL', 'rhr'); ?></span>
                <div class="arrow svg"></div>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-10">
                    <div class="webdoor">
                        <?php if (isset($settings['_rhr_banner_title']) && !empty($settings['_rhr_banner_title'])): ?>
                            <h1 class="title">
                                <?php echo $this->parse_text_editor($settings['_rhr_banner_title']); ?>
                            </h1>
                        <?php endif; ?>
                        <?php if (isset($settings['_rhr_banner_btn']) && !empty($settings['_rhr_banner_btn'])): ?>
                            <a <?php echo rhr__link($settings['_rhr_banner_link']); ?> class="button banner-button" data-cursor="scale">
                                <span><?php echo $this->parse_text_editor($settings['_rhr_banner_btn']); ?></span>
                                <div class="arrow svg"></div>
                            </a>
                        <?php endif; ?>
                        <?php if( isset($banner_image) && !empty($banner_image) ) : ?>
                            <div class="image rhr_banner__fixs">
                                <img src="<?php echo esc_url($banner_image); ?>" alt="<?php echo get_post_meta($settings['_rhr_banner_img']['id'], '_wp_attachment_image_alt', true); ?>">
                            </div>
                        <?php endif; ?>
                        <?php if (isset($settings['show_vector']) && !empty($settings['show_vector']) && 'yes' === $settings['show_vector']): ?>
                            <div class="vector">
                                <div class="svg"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($settings['_rhr_design_banner_section']) && 'default' === $settings['_rhr_design_banner_section']): ?>
    <?php if (isset($settings['show_video']) && !empty($settings['show_video']) && 'yes' === $settings['show_video']): ?>
        <?php if (isset($settings['rhr_hosted_url']) && !empty($settings['rhr_hosted_url']['id'])): ?>
            <div class="pages-content pc-home-video" id="video-section">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-8">
                            <div class="video" data-youtube="UpolBSznWp0" data-cursor="video">
                                <?php if( isset($video_poster) && !empty($video_poster) ) : ?>
                                    <img src="<?php echo esc_url($video_poster); ?>" alt="<?php echo get_post_meta($settings['_rhr_video_poster']['id'], '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                                <video autoplay loop muted poster="<?php echo esc_url($video_poster); ?>">
                                    <source src="<?php echo esc_url($settings['rhr_hosted_url']['url']); ?>" type="video/mp4">
                                </video>
                                <div class="button-play">
                                    <div class="arrow svg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="video-frame">
                <button class="bt-close">
                    <div class="svg"></div>
                </button>
            </section>
        <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($settings['_rhr_design_banner_section']) && 'design-1' === $settings['_rhr_design_banner_section']): ?>
        <div class="pages-content pc-home-numbers">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-10">
                    <div class="home-numbers">
                        <?php
                            if ( !empty( $settings['_rhr_img_lists'] ) ) :
                            $i = 1;
                            foreach ( $settings['_rhr_img_lists'] as $index => $item ) :
                                $c_image = wp_get_attachment_image_url( $item['_rhr_banner_img_c']['id'], $item['thumbnail_c_size'] );
                        ?>
                            <div class="hm-images hm-image-<?php echo esc_attr($item['_rhr_cimge_type']);?>">
                            <img src="<?php echo esc_url($c_image); ?>" alt="<?php echo get_post_meta($item['_rhr_banner_img_c']['id'], '_wp_attachment_image_alt', true); ?>">
                            </div>
                        <?php $i++; endforeach; endif; ?>
                        <?php
                            if ( !empty( $settings['_rhr_funbfact_lists'] ) ) :
                        ?>
                        <div class="hm-numbers hm-number-1">
                            <?php
                                $i = 1;
                                foreach ( $settings['_rhr_funbfact_lists'] as $index => $item ) :
                                    if($item['_rhr_funb_type'] == 'left'):
                                    $prefix = !empty($item['_rhr_funb_prefix']) ? $item['_rhr_funb_prefix'] : '';
                                    $sufix = !empty($item['_rhr_funb_sufix']) ? '<span>'.$item['_rhr_funb_sufix'].'</span>' : '';
                                    $class = $i == 1 ? 'c-margin' : '';
                            ?>
                            <div class="chart c-white <?php echo esc_attr($class);?>">
                                <div class="numbers" data-count="<?php echo esc_attr($item['_rhr_funb_number']); ?>">
                                    <div class="n-triangle svg"></div>
                                    <div class="n-texts">
                                        <span class="number"><?php echo $prefix . $this->parse_text_editor($item['_rhr_funb_number']); ?></span><?php echo $sufix; ?>
                                    </div>
                                    <?php if (isset($item['_rhr_funb_title']) && !empty($item['_rhr_funb_title'])): ?>
                                        <div class="label"><?php echo $this->parse_text_editor($item['_rhr_funb_title']); ?></div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php endif; $i++; endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <?php
                            if ( !empty( $settings['_rhr_funbfact_lists'] ) ) :
                                $i = 1;
                                foreach ( $settings['_rhr_funbfact_lists'] as $index => $item ) :
                                    if($item['_rhr_funb_type'] == 'right'):
                                    $prefix = !empty($item['_rhr_funb_prefix']) ? $item['_rhr_funb_prefix'] : '';
                                    $sufix = !empty($item['_rhr_funb_sufix']) ? '<span>'.$item['_rhr_funb_sufix'].'</span>' : '';
                            ?>
                        <div class="hm-numbers hm-number-2">
                            <div class="chart c-white">
                                <div class="numbers" data-count="<?php echo esc_attr($item['_rhr_funb_number']); ?>">
                                    <div class="n-triangle svg"></div>
                                    <div class="n-texts">
                                        <span class="number"><?php echo $prefix . $this->parse_text_editor($item['_rhr_funb_number']); ?></span><?php echo $sufix; ?>
                                    </div>
                                    <?php if (isset($item['_rhr_funb_title']) && !empty($item['_rhr_funb_title'])): ?>
                                        <div class="label"><?php echo $this->parse_text_editor($item['_rhr_funb_title']); ?></div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; $i++; endforeach; endif; ?>
                        <?php
                            if ( !empty( $settings['_rhr_funbfact_lists'] ) ) :
                                $i = 1;
                                foreach ( $settings['_rhr_funbfact_lists'] as $index => $item ) :
                                    if($item['_rhr_funb_type'] == 'bottom'):
                                    $prefix = !empty($item['_rhr_funb_prefix']) ? $item['_rhr_funb_prefix'] : '';
                                    $sufix = !empty($item['_rhr_funb_sufix']) ? '<span>'.$item['_rhr_funb_sufix'].'</span>' : '';
                            ?>
                        <div class="hm-numbers hm-number-3">
                            <div class="chart c-white">
                                <div class="numbers" data-count="<?php echo esc_attr($item['_rhr_funb_number']); ?>">
                                    <div class="n-triangle svg"></div>
                                    <div class="n-texts">
                                        <span class="number"><?php echo $prefix . $this->parse_text_editor($item['_rhr_funb_number']); ?></span><?php echo $sufix; ?>
                                    </div>
                                    <?php if (isset($item['_rhr_funb_title']) && !empty($item['_rhr_funb_title'])): ?>
                                        <div class="label"><?php echo $this->parse_text_editor($item['_rhr_funb_title']); ?></div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; $i++; endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
        <?php
        $this->__close_wrap();
    }

}
