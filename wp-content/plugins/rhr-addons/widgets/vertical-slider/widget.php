<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Vertical_Slider extends CREST_BASE{

    public function get_name(){
        return 'rhr-vertical-slider';
    }

    public function get_title(){
        return esc_html__( 'Home Vertical Slider', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-slider-full-screen';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Home Slider', 'Vertical Slider', 'assignment', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_vslider_preset',
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
                    'style-1' => 'Style One',
                    'style-2' => 'Style Two',
                ],
                'default' => 'style-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_rhr_vs_content',
            [
                'label' => __( 'Content', 'rhr' ),
                'condition' => [
                    '_rhr_design_section' => 'style-1'
                ]
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            '_rhr_vs_tab',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Assessment', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_vs_tab_targer',
            [
                'label' => 'Tab Target',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'assessment', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab target..', 'rhr' ),
                'description' => __( 'Enter tab target text like(assessment, development, teams, founder, diversity) (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_vs_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Optimize your <br>leadership <br>pipeline.', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_vs_sutitle',
            [
                'label' => 'Sub Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Assessment', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter sub title..', 'rhr' ),
                'description' => __( 'Enter sub title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_vs_contents',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Leverage data-driven insights for<br>critical talent decisions.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_vs_btn',
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
        $repeater->add_control(
            '_rhr_vs_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_vs_btn!' => '',
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_vs_img',
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
        $repeater->add_control(
            '_rhr_vs_color',
            [
                'label' => 'Color Name',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => 'orange',
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter border color name..', 'rhr' ),
                'description' => __( 'Enter border color name (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_vs_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_vs_tab' => __( 'Assessment', 'rhr' ),
                        '_rhr_vs_tab_targer' => 'assessment',
                        '_rhr_vs_title' => __( 'Optimize your <br>leadership <br>pipeline.', 'rhr' ),
                        '_rhr_vs_sutitle' => __( 'Assessment', 'rhr' ),
                        '_rhr_vs_contents' => __( 'Leverage data-driven insights for<br>critical talent decisions.', 'rhr' ),
                        '_rhr_vs_btn' => __( 'LEARN MORE', 'rhr' ),
                        '_rhr_vs_color' => 'orange',
                        '_rhr_vs_link' => [
                            'url' => '#',
                        ],
                        '_rhr_vs_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        '_rhr_vs_tab' => __( 'Development', 'rhr' ),
                        '_rhr_vs_tab_targer' => 'development',
                        '_rhr_vs_title' => __( 'Accelerate <br>growth and <br>unlock potential.', 'rhr' ),
                        '_rhr_vs_sutitle' => __( 'Development', 'rhr' ),
                        '_rhr_vs_contents' => __( 'Invest in capabilities<br>and performance.', 'rhr' ),
                        '_rhr_vs_btn' => __( 'LEARN MORE', 'rhr' ),
                        '_rhr_vs_color' => 'blue',
                        '_rhr_vs_link' => [
                            'url' => '#',
                        ],
                        '_rhr_vs_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],

                    ],
                    [
                        '_rhr_vs_tab' => __( 'Teams', 'rhr' ),
                        '_rhr_vs_tab_targer' => 'teams',
                        '_rhr_vs_title' => __( 'Build <br>high-performing <br>teams.', 'rhr' ),
                        '_rhr_vs_sutitle' => __( 'Teams', 'rhr' ),
                        '_rhr_vs_contents' => __( 'Align and accelerate<br>for performance.', 'rhr' ),
                        '_rhr_vs_btn' => __( 'LEARN MORE', 'rhr' ),
                        '_rhr_vs_color' => 'green',
                        '_rhr_vs_link' => [
                            'url' => '#',
                        ],
                        '_rhr_vs_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        '_rhr_vs_tab' => __( 'Board, CEO, Founder', 'rhr' ),
                        '_rhr_vs_tab_targer' => 'founder',
                        '_rhr_vs_title' => __( 'Set the tone <br>from the top.', 'rhr' ),
                        '_rhr_vs_sutitle' => __( 'Board, CEO, Founder', 'rhr' ),
                        '_rhr_vs_contents' => __( 'Master the C-Suite to<br>cultivate success.', 'rhr' ),
                        '_rhr_vs_btn' => __( 'LEARN MORE', 'rhr' ),
                        '_rhr_vs_color' => 'purple',
                        '_rhr_vs_link' => [
                            'url' => '#',
                        ],
                        '_rhr_vs_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        '_rhr_vs_tab' => __( 'D,B&I', 'rhr' ),
                        '_rhr_vs_tab_targer' => 'diversity',
                        '_rhr_vs_title' => __( 'Create an <br>inclusive <br>organization <br>where everyone <br>belongs.', 'rhr' ),
                        '_rhr_vs_sutitle' => __( 'Diversity, Inclusion and Belonging', 'rhr' ),
                        '_rhr_vs_contents' => __( 'Maximize your talent,<br>leaders, and teams.', 'rhr' ),
                        '_rhr_vs_btn' => __( 'LEARN MORE', 'rhr' ),
                        '_rhr_vs_color' => 'red',
                        '_rhr_vs_link' => [
                            'url' => '#',
                        ],
                        '_rhr_vs_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '{{ _rhr_vs_tab }}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_hs_content',
            [
                'label' => __( 'Content', 'rhr' ),
                'condition' => [
                    '_rhr_design_section' => 'style-2'
                ]
            ]
        );
        $this->add_control(
            '_rhr_hs_heading',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Highlights', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter heading..', 'rhr' ),
                'description' => __( 'Enter heading text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_hs = new Repeater();

        $repeater_hs->add_control(
            '_rhr_hs_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Investor-Backed<br>Companies', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );

        $repeater_hs->add_control(
            '_rhr_hs_contents',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Private companies often have different needs. RHR works with both Private Equity and venture-backed organizations to align and accelerate leadership capabilities needed to deliver growth.', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater_hs->add_control(
            '_rhr_hs_btn',
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
        $repeater_hs->add_control(
            '_rhr_hs_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter button link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_hs_btn!' => '',
                ],
            ]
        );
        $repeater_hs->add_control(
            '_rhr_hs_img',
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
                'name' => 'thumbnail_hs',
                'default' => 'full',
                'separator' => 'none',
                'description' => __( 'Choose image size (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_hs_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater_hs->get_controls(),
                'default' => [
                    [
                        '_rhr_hs_title' => __( 'Investor-Backed<br>Companies', 'rhr' ),
                        '_rhr_hs_contents' => __( 'Private companies often have different needs. RHR works with both Private Equity and venture-backed organizations to align and accelerate leadership capabilities needed to deliver growth.', 'rhr' ),
                        '_rhr_hs_btn' => __( 'Discover more', 'rhr' ),
                        '_rhr_hs_link' => [
                            'url' => '#',
                        ],
                        '_rhr_hs_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        '_rhr_hs_title' => __( 'Succession<br>Insights', 'rhr' ),
                        '_rhr_hs_contents' => __( 'Intelligent analytics have the power to inform succession planning by giving accurate, clear, and comprehensive views of your talent.', 'rhr' ),
                        '_rhr_hs_btn' => __( 'Discover more', 'rhr' ),
                        '_rhr_hs_link' => [
                            'url' => '#',
                        ],
                        '_rhr_hs_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        '_rhr_hs_title' => __( 'The Founder’s<br>Journey', 'rhr' ),
                        '_rhr_hs_contents' => __( 'The market loves your product or service. Now, you need to scale your company. To scale your company, you need to scale your leadership.', 'rhr' ),
                        '_rhr_hs_btn' => __( 'Discover more', 'rhr' ),
                        '_rhr_hs_link' => [
                            'url' => '#',
                        ],
                        '_rhr_hs_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],

                ],
                'title_field' => '{{ _rhr_hs_title }}',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );

        $this->__open_wrap();
        ?>
        <?php if( $settings['_rhr_design_section'] == 'style-1' ) : ?>
           <div class="pages-content pc-home-solutions">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col col-10">
                        <div class="home-solutions">
                            <div class="home-navigate">
                                <div class="hn-wrapper">
                                  <?php
                                  if ( !empty( $settings['_rhr_vs_lists'] ) ) :
                                      ?>
                                      <div class="hn-itemd"><span><?php echo esc_html__('Our Solutions','rhr'); ?></span></div>
                                      <?php
                                      $i = 1;
                                      foreach ( $settings['_rhr_vs_lists'] as $tab ) :
                                      $active_class = $i === 1 ? 'active' : '';
                                      $target_text = strtolower($tab['_rhr_vs_tab_targer']);
                                      $target = $target_text;
                                  ?>
                                <?php if (isset($tab['_rhr_vs_tab']) && !empty($tab['_rhr_vs_tab'])): ?>
                                    <div class="hn-item <?php echo esc_attr($active_class); ?>" data-cursor="scale" data-target="<?php echo $target; ?>"><span><?php echo esc_html__($tab['_rhr_vs_tab'],'rhr'); ?></span></div>
                                <?php endif; ?>
                                <?php $i++; endforeach; endif; ?>

                                </div>
                            </div>
                            <div class="vector svg"></div>
                            <div class="items">
                                <?php
                                if ( !empty( $settings['_rhr_vs_lists'] ) ) :
                                    $i = 1;
                                    foreach ( $settings['_rhr_vs_lists'] as $item ) :
                                    $motion_in = $i == 1 ? 'motion-in' : '';
                                    $target_text = strtolower($item['_rhr_vs_tab']);
                                    $target = str_replace(" ", "_", $target_text);
                                    $_image = wp_get_attachment_image_url( $item['_rhr_vs_img']['id'], $settings['thumbnail_size'] );
                                    $color_name =  !empty($item['_rhr_vs_color']) ? $item['_rhr_vs_color'] : 'orange';
                                ?>
                                    <div class="item <?php echo esc_attr($motion_in); ?>" data-color="<?php echo esc_attr($color_name); ?>">
                                        <div class="infos">
                                            <?php if (isset($item['_rhr_vs_sutitle']) && !empty($item['_rhr_vs_sutitle'])): ?>
                                                <div class="type"><a <?php echo rhr__link($item['_rhr_vs_link']); ?>><?php echo esc_html__($item['_rhr_vs_sutitle'],'rhr'); ?></a></div>
                                            <?php endif; ?>

                                            <?php if (isset($item['_rhr_vs_title']) && !empty($item['_rhr_vs_title'])): ?>
                                                <div class="title t-medium"><a <?php echo rhr__link($item['_rhr_vs_link']); ?>><?php echo $this->parse_text_editor($item['_rhr_vs_title']); ?></a></div>
                                            <?php endif; ?>

                                            <?php if (isset($item['_rhr_vs_contents']) && !empty($item['_rhr_vs_contents'])): ?>
                                                <div class="paragraph p-gray p-marginT"><?php echo $this->parse_text_editor($item['_rhr_vs_contents']); ?></div>
                                            <?php endif; ?>

                                            <?php if (isset($item['_rhr_vs_btn']) && !empty($item['_rhr_vs_btn'])): ?>
                                                <a <?php echo rhr__link($item['_rhr_vs_link']); ?> class="button" data-cursor="scale">
                                                    <span><?php echo $this->parse_text_editor($item['_rhr_vs_btn']); ?></span>
                                                    <div class="arrow svg"></div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <?php if( isset($_image) && !empty($_image) ) : ?>
                                            <div class="hh-image">
                                                <a <?php echo rhr__link($item['_rhr_vs_link']); ?>>
                                                    <img src="<?php echo esc_url($_image); ?>" alt="<?php echo get_post_meta($item['_rhr_vs_img']['id'], '_wp_attachment_image_alt', true); ?>">
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php $i++; endforeach; endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif( $settings['_rhr_design_section'] == 'style-2' ) : ?>
            <div class="pages-content pc-gray pc-home-hightlight">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-12">
                            <?php if (isset($settings['_rhr_hs_heading']) && !empty($settings['_rhr_hs_heading'])): ?>
                                <div class="caption c-center">
                                    <span class="rhr-text-uppercase"><?php echo esc_html__($settings['_rhr_hs_heading'],'rhr'); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ( !empty( $settings['_rhr_hs_lists'] ) ) : ?>
                                <div class="home-highlights">
                                    <div class="slides">
                                        <?php
                                            $i = 1;
                                            foreach ( $settings['_rhr_hs_lists'] as $hs_item ) :
                                                $hs_image = wp_get_attachment_image_url( $hs_item['_rhr_hs_img']['id'], $settings['thumbnail_hs_size'] );

                                            ?>
                                            <a <?php echo rhr__link($hs_item['_rhr_hs_link']); ?> class="item" data-cursor="scale">
                                                <div class="wrapper">
                                                    <?php if( isset($hs_image) && !empty($hs_image) ) : ?>
                                                        <img class="image" src="<?php echo esc_url($hs_image); ?>" alt="<?php echo get_post_meta($hs_item['_rhr_hs_img']['id'], '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?>
                                                    <div class="infos">
                                                        <?php if (isset($hs_item['_rhr_hs_title']) && !empty($hs_item['_rhr_hs_title'])): ?>
                                                            <div class="title t-small t-white"><?php echo $this->parse_text_editor($hs_item['_rhr_hs_title']); ?></div>
                                                        <?php endif; ?>
                                                        <?php if (isset($hs_item['_rhr_hs_contents']) && !empty($hs_item['_rhr_hs_contents'])): ?>
                                                            <div class="paragraph p-white"><?php echo $this->parse_text_editor($hs_item['_rhr_hs_contents']); ?></div>
                                                        <?php endif; ?>
                                                        <?php if (isset($hs_item['_rhr_hs_btn']) && !empty($hs_item['_rhr_hs_btn'])): ?>
                                                        <div class="link">
                                                            <?php echo $this->parse_text_editor($hs_item['_rhr_hs_btn']); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php $i++; endforeach; ?>
                                    </div>
                                    <div class="hh-arrow a-left" data-cursor="left"></div>
                                    <div class="hh-arrow a-right" data-cursor="right"></div>
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
