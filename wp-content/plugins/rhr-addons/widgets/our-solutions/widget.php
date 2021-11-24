<?php
namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\CREST_BASE;

if (!defined('ABSPATH')) exit;

class Our_Solutions extends CREST_BASE{

    public function get_name(){
        return 'rhr-our-solutions';
    }

    public function get_title(){
        return esc_html__( 'Our Solutions', 'rhr' );
    }

    public function get_icon(){
        return 'rhr-signature eicon-editor-list-ol';
    }

    public function get_categories(){
        return ['rhr_cat'];
    }
    public function get_keywords() {
        return [ 'Our Solutions', 'Solutions', 'rhr'];
    }
    public function get_help_url() {
        return '';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_rhr_slda_preset',
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
            '_rhr_slda_content_section',
            [
                'label' => __( 'Tab', 'rhr' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_rhr_os_tab_title',
            [
                'label' => 'Tab Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Our Solutions', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter tab title..', 'rhr' ),
                'description' => __( 'Enter tab title text(or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_os_title',
            [
                'label' => 'Title',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Our Solutions', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter title..', 'rhr' ),
                'description' => __( 'Enter title text (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_os_sub_text',
            [
                'label' => __( 'Sub Content', 'rhr' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __( 'Leadership starts at the top.  Successfully navigate the complex and unique challenges faced by CEOs, founders and boards.', 'rhr' ),
                'placeholder' => __( 'Type your sub content here', 'rhr' ),
                'description' => __( 'Enter sub content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_os_contents',
            [
                'label' => __( 'Content', 'rhr' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( '', 'rhr' ),
                'placeholder' => __( 'Type your content here', 'rhr' ),
                'description' => __( 'Enter content (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_os_btn',
            [
                'label' => 'Button Text',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( '', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Discover More', 'rhr' ),
                'description' => __( 'Enter button text (or) Leave it empty to hide.', 'rhr' ),
            ]
        );
        $repeater->add_control(
            '_rhr_os_link',
            [
                'label' => __( 'Link', 'rhr' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
                ],
                'placeholder' => __( 'https://your-link.com', 'rhr' ),
                'description' => __( 'Enter link (or) Leave it empty to aply theme default.', 'rhr' ),
                'condition' =>[
                    '_rhr_os_btn!' => '',
                ],
            ]
        );
        $repeater->add_control(
            '_rhr_os_img',
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
            '_rhr_os_bcolor',
            [
                'label' => 'Border Color',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'purple', 'rhr' ),
                'dynamic' => [
                    'active'   => true,
                ],
                'placeholder' => __( 'Enter border color name', 'rhr' ),
                'description' => __( 'Enter border color name like(purple,orange,blue,green,red) (or) Leave it empty to aply theme default.', 'rhr' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'description' => __('Select image size (or) Leave it empty to apply theme default.', 'kcg'),
            ]
        );
        $this->add_control(
            '_rhr_os_lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default' => [
                    [
                        '_rhr_os_tab_title' => __( 'Our Solutions', 'rhr' ),
                        '_rhr_os_title' => __( 'Our Solutions', 'rhr' ),
                        '_rhr_os_sub_text' => __( 'Explore our range of solutions, developed to build a deep understanding of your pipeline, develop your talent, and empower your leaders.', 'rhr' ),
                        '_rhr_os_contents' => __( '', 'rhr' ),
                        '_rhr_os_btn' => __( '', 'rhr' ),
                        '_rhr_os_link' => [
                            'url' => '',
                       ],
                        '_rhr_os_img' => [
                            'url' => '',
                       ],
                       '_rhr_os_bcolor' => __( '', 'rhr' ),
                    ],

                    [
                        '_rhr_os_tab_title' => __( 'Founder', 'rhr' ),
                        '_rhr_os_title' => __( 'Board, CEO, Founder', 'rhr' ),
                        '_rhr_os_sub_text' => __( 'Leadership starts at the top.  Successfully navigate the complex and unique challenges faced by CEOs, founders and boards.', 'rhr' ),
                        '_rhr_os_contents' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.', 'rhr' ),
                        '_rhr_os_btn' => __( 'Discover More', 'rhr' ),
                        '_rhr_os_link' => [
                            'url' => '#',
                       ],
                       '_rhr_os_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_os_bcolor' => __( 'purple', 'rhr' ),
                    ],
                    [
                        '_rhr_os_tab_title' => __( 'Assessment', 'rhr' ),
                        '_rhr_os_title' => __( 'Assessment', 'rhr' ),
                        '_rhr_os_sub_text' => __( 'Measure precisely how prepared your leaders are to take on more responsibility and tackle your most critical business challenges.', 'rhr' ),
                        '_rhr_os_contents' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.', 'rhr' ),
                        '_rhr_os_btn' => __( 'Discover More', 'rhr' ),
                        '_rhr_os_link' => [
                            'url' => '#',
                       ],
                       '_rhr_os_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_os_bcolor' => __( 'orange', 'rhr' ),
                    ],
                    [
                        '_rhr_os_tab_title' => __( 'Development', 'rhr' ),
                        '_rhr_os_title' => __( 'Development', 'rhr' ),
                        '_rhr_os_sub_text' => __( 'Build scalable leaders who excel in diverse, unpredictable, and complex business environments.', 'rhr' ),
                        '_rhr_os_contents' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.', 'rhr' ),
                        '_rhr_os_btn' => __( 'Discover More', 'rhr' ),
                        '_rhr_os_link' => [
                            'url' => '#',
                       ],
                       '_rhr_os_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_os_bcolor' => __( 'blue', 'rhr' ),
                    ],
                    [
                        '_rhr_os_tab_title' => __( 'Teams', 'rhr' ),
                        '_rhr_os_title' => __( 'Teams', 'rhr' ),
                        '_rhr_os_sub_text' => __( 'Design, align, and build high-performing senior teams that thrive in complex business environments.', 'rhr' ),
                        '_rhr_os_contents' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.', 'rhr' ),
                        '_rhr_os_btn' => __( 'Discover More', 'rhr' ),
                        '_rhr_os_link' => [
                            'url' => '#',
                       ],
                       '_rhr_os_bcolor' => __( 'green', 'rhr' ),
                    ],
                    [
                        '_rhr_os_tab_title' => __( 'Diversity', 'rhr' ),
                        '_rhr_os_title' => __( 'Diversity, Inclusion and Belonging', 'rhr' ),
                        '_rhr_os_sub_text' => __( 'Break down systems of inequity, build inclusive and courageous leaders, and accelerate female and diverse talent growth.', 'rhr' ),
                        '_rhr_os_contents' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.', 'rhr' ),
                        '_rhr_os_btn' => __( 'Discover More', 'rhr' ),
                        '_rhr_os_link' => [
                            'url' => '#',
                       ],
                       '_rhr_os_img' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        '_rhr_os_bcolor' => __( 'red', 'rhr' ),
                    ],
                ],
                'title_field' => '{{ _rhr_os_tab_title }}',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );

        $this->__open_wrap();
        ?>
             <div class="pages-content pc-noPadidng pc-solutions rhr_section__fix">
                <div class="container-fluid">
                    <div class="row justify-content-center align-top">
                        <div class="col col-2 sidenav-wrap service-terms">

                            <?php if ( !empty( $settings['_rhr_os_lists'] ) ) : ?>
                                <div class="menu-navigate">
                                    <div class="items">
                                    <?php
                                            $i = 1;
                                                foreach ( $settings['_rhr_os_lists'] as $index => $tab_item ) :
                                                    $tab_count = $index + 1;
                                                    $active_class = $i == 1 ? ' active' : '';
                                        ?>
                                        <a href="#target-<?php echo $id_int . $tab_count ?>" class="item scroll_menu_item target-<?php echo esc_attr($id_int . $tab_count);?> <?php echo esc_attr($active_class);?>" data-cursor="scale"> <?php echo $this->parse_text_editor($tab_item['_rhr_os_tab_title']); ?></a>
                                        <?php $i++; endforeach; ?>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="l-bar"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col col-8">
                        <?php if ( !empty( $settings['_rhr_os_lists'] ) ) : ?>
                            <?php
                                $i = 1;
                                foreach ( $settings['_rhr_os_lists'] as $index => $item ) :
                                    $tab_count = $index + 1;
                            ?>
                            <?php if($i == 1): ?>
                                <div class="pc-solutions-webdoor pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" id="target-<?php echo $id_int . $tab_count ?>">
                                    <?php if( !empty($item['_rhr_os_title']) ) : ?>
                                        <h1 class="title t-medium">
                                            <?php echo $this->parse_text_editor($item['_rhr_os_title']); ?>
                                        </h1>
                                    <?php endif; ?>
                                    <?php if( !empty($item['_rhr_os_sub_text']) ) : ?>
                                        <div class="paragraph p-gray">
                                            <?php echo $this->parse_text_editor($item['_rhr_os_sub_text']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php $i++; endforeach; ?>
                            <div class="pc-inner">
                                <div class="solutions-highlights">
                                    <?php
                                        $j = 1;
                                        foreach ( $settings['_rhr_os_lists'] as $index => $item ) :
                                            $tab_count = $index + 1;
                                            if($j <> 1) :
                                    ?>

                                        <div class="item pc_section target-<?php echo esc_attr($id_int . $tab_count);?>" data-color="<?php echo esc_attr($item['_rhr_os_bcolor']); ?>" id="target-<?php echo $id_int . $tab_count ?>">
                                            <?php if(isset($item['_rhr_os_img']['url']) && !empty($item['_rhr_os_img']['url'])) :
                                                $image = wp_get_attachment_image_url( $item['_rhr_os_img']['id'], $settings['thumbnail_size'] );
                                                ?>
                                                <div class="sh-image">
                                                    <a <?php echo rhr__link($item['_rhr_os_link']); ?> data-cursor="scale">
                                                        <figure style="background-image: url(<?php echo esc_url( $image ); ?>);"></figure>
                                                </a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="infos">
                                                <?php if( !empty($item['_rhr_os_title']) ) : ?>
                                                    <div class="title t-small"><a <?php echo rhr__link($item['_rhr_os_link']); ?> data-cursor="scale"><?php echo $this->parse_text_editor($item['_rhr_os_title']); ?></a></div>
                                                <?php endif; ?>
                                                <?php if( !empty($item['_rhr_os_sub_text']) ) : ?>
                                                <div class="paragraph p-gray"><?php echo $this->parse_text_editor($item['_rhr_os_sub_text']); ?></div>
                                                <?php endif; ?>
                                                <div class="rhr-editor-content">
                                                  <?php
                                                      if (isset($item['_rhr_os_contents']) && !empty($item['_rhr_os_contents'])):
                                                          ?>
                                                          <a <?php echo rhr__link($item['_rhr_os_link']); ?> data-cursor="scale">
                                                              <?php echo $this->parse_text_editor($item['_rhr_os_contents']); ?>
                                                          </a>
                                                      <?php endif;
                                                  ?>
                                                </div>
                                                <?php if (isset($item['_rhr_os_btn']) && !empty($item['_rhr_os_btn'])): ?>
                                                    <a <?php echo rhr__link($item['_rhr_os_link']); ?> class="button" data-cursor="scale">
                                                        <span><?php echo $this->parse_text_editor($item['_rhr_os_btn']); ?></span>
                                                        <div class="arrow svg"></div>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; $j++; endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        $this->__close_wrap();
    }

}
