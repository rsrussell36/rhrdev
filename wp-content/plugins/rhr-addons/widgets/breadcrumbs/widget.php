<?php

namespace KC_GLOBAL\Widget;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Utils;
use \Elementor\CREST_BASE;
if (!defined('ABSPATH')) {
    exit;
}

class Breadcrumbs extends CREST_BASE
{

    public function get_name()
    {
        return 'rhr-breadcrumbs';
    }

    public function get_title()
    {
        return esc_html__('Breadcrumbs', 'rhr');
    }

    public function get_icon()
    {
        return 'rhr-signature eicon-product-breadcrumbs';
    }

    public function get_categories()
    {
        return ['rhr_cat'];
    }
    public function get_keywords()
    {
        return ['Breadcrumbs', 'breadcrumbs', 'rhr', 'rhr'];
    }
    public function get_help_url()
    {
        return '';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            '_rhr_design_preset',
            [
                'label' => __('Preset', 'rhr'),
            ]
        );

        $this->add_control(
            '_rhr_design',
            [
                'label' => esc_html__('Design Format', 'rhr'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('rhr/premium/icon/presets', [
                    'default' => 'Select',
                ]),
                'default' => 'default',
            ]
        );

        $this->end_controls_section();

 
		$this->start_controls_section(
			'_rhr_section_breadcrumbs',
			array(
				'label' => __( 'Breadcrumbs', 'rhr' ),
			)
		);
			$this->add_control(
                'show_home',
                [
                    'label' => __('Home', 'rhr' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'rhr' ),
                    'label_off' => __('Hide', 'rhr' ),
                    'default' => 'yes',
                    
                ]
            );
            $this->add_control(
	            'rhr_breadcumb_h_text',
	            [
	                'label' => __('Home Text', 'rhr' ),
	                'type' => Controls_Manager::TEXT,
	                'label_block' => false,
	                'default' => __('Home', 'rhr' ),
	                'description' => __( 'Enter homepage text (or) Leave it empty to apply theme default.', 'rhr' ),
	                'condition' => [
	                    'show_home' => 'yes',
	                ]
	            ]
	        );
            $this->add_control(
	            $this->__new_icon_prefix . 'bread_hicon',
	            	[
	                'label'            => esc_html__( 'Home Icon', 'rhr' ),
	                'type'             => Controls_Manager::ICONS,
	                'label_block'      => false,
	                'skin'             => 'inline',
	                'fa4compatibility' => 'bread_hicon',
	                'default'          => [
	                    'value'   => 'fas fa-home',
	                    'library' => 'fa-solid',
	                ],
	                'description' => __( 'Choose homepage icon (or) Leave it empty to apply theme default.', 'rhr' ),
	                'condition' => [
	                    'show_home' => 'yes',
	                ]
	            ]
	        );
	        $this->add_responsive_control(
            'rhr_breadcumb_align',
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb' => 'text-align: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
            '_rhr_breadcumb_seperator',
                [
                    'label' => __( 'Seperator', 'rhr' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );
            
        $this->add_control(
            '_rhr_seperator_type',
            [   
                'label' => esc_html__('Type', 'rhr'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'rhr'),
                        'icon' => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'rhr'),
                        'icon' => 'fas fa-home',
                    ],
                    'text' => [
                        'title' => esc_html__('Text', 'rhr'),
                        'icon' => 'eicon-heading',
                    ],
                ],
                'default' => 'text',
                'description' => __( 'Choose seperator type (or) Leave it empty to apply theme default.', 'rhr' ),
            ]
        );
        $this->add_control(
            '_rhr_seperator_text', [
                'label' => __('Text', 'rhr'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Enter Text', 'rhr'),
                'default' => __('/', 'rhr'),
               'condition' => [
                    '_rhr_seperator_type' => 'text'
               ],
               'description' => __( 'If the field is empty, seperator will not be shown.', 'rhr' ),
            ]
        );
         $this->add_control(
            $this->__new_icon_prefix . 'seperator_icon',
            array(
                'label'            => esc_html__( 'Icon', 'rhr' ),
                'type'             => Controls_Manager::ICONS,
                'label_block'      => false,
                'skin'             => 'inline',
                'fa4compatibility' => 'seperator_icon',
                'default'          => [
                    'value'   => 'fas fa-greater-than',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    '_rhr_seperator_type' => 'icon'
               ],
                'description' => __( 'If the field is empty, seperator will not be shown.', 'rhr' ),
            )
        );     
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_bread_general_section',
            [
                'label' => __('General', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_rhr_bread_general_bg',
                'label' => 'Background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background', 'rhr'),
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_bread_general_mr',
            [
                'label' => __('Margin', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_bread_general_padding',
            [
                'label' => __('Padding', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_rhr_bread_general_border',
                'selector' => '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb',
            ]
        );
        $this->add_control(
            '_rhr_bread_general_radius',
            [
                'label' => __('Border Radius', 'rhr'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_breadcumbs_style_section',
            [
                'label' => __('Breadcrumbs', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            '_rhr_bread_home_size',
            [
                'label' => __('Home Icon Size', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li .rhr-breadcrumb-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li .rhr-breadcrumb-icon svg' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_bread_color',
            [
                'label' => esc_html__('Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_rhr_bread_color_link',
            [
                'label' => esc_html__('Link Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li a' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            '_rhr_bread_color_link_h',
            [
                'label' => esc_html__('Link Hover Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li a:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_rhr_bread_typography',
                'selector' => '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li a, {{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li',
            ]
        );
        $this->add_responsive_control(
            '_rhr_bread_gap',
            [
                'label' => __('Gap', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_rhr_breadcumbs_seperator_style_section',
            [
                'label' => __('Seperator', 'rhr'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_rhr_bread_color_seperator',
            [
                'label' => esc_html__('Separator Color', 'rhr'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li .rhr-separator i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li .rhr-separator svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_bread_separator_size',
            [
                'label' => __('Size', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li .rhr-separator i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li .rhr-separator svg' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_bread_separator_pl',
            [
                'label' => __('Padding Left', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li .rhr-separator' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_rhr_bread_separator_pr',
            [
                'label' => __('Padding Right', 'rhr'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-rhr-breadcrumbs .rhr-breadcrumb li .rhr-separator' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
	
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $id_int = substr($this->get_id_int(), 0, 3);
        $this->__open_wrap();
        $this->_render_breadcrumbs();
	?>


    <?php $this->__close_wrap();
	}

	protected function _render_breadcrumbs( $echo = true ) {
		$settings = $this->get_settings_for_display();
		global $post;
		$bread_icon =  $this->__get_icon( 'bread_hicon', $settings, '<span class="rhr-breadcrumb-icon">%s</span>' );
		// Useful variables
		$delimiter = ''; // delimiter between crumbs
		if('yes' === $settings['show_home']){
			if('text' === $settings['_rhr_seperator_type'] && !empty($settings['_rhr_seperator_text'])){
				$delimiter = '<span class="rhr-separator ">'.$settings['_rhr_seperator_text'].'</span>';
			}elseif('icon' === $settings['_rhr_seperator_type']){
				$delimiter = $this->__get_icon( 'seperator_icon', $settings, '<span class="rhr-separator ">%s</span>' );
			}
		}


		$home = 'yes' === $settings['show_home'] ? esc_html__( $settings['rhr_breadcumb_h_text'], 'rhr' ) : '';
		$home_icon = 'yes' === $settings['show_home'] ? $bread_icon : '';
		$before = '<span class="current">'; // tag before the current crumb
		$after = '</span>'; // tag after the current crumb

		$title = $this->_render_page_title();

		$homeLink = home_url( '/' );

		ob_start();

		
			if ( is_home() ) {
				echo '<ul class="rhr-breadcrumb"><li><a data-cursor="scale" href="' . esc_url( $homeLink ) . '">'. esc_html( ucwords( $home ) ) .'</a></li><li>'. $before . esc_html( $title ) . $after .'</span></li></ul>';
			}
			else if( rhr_is_shop() || rhr_is_product() || rhr_is_product_category() || rhr_is_product_tag() ) {
				woocommerce_breadcrumb();
			}
			else {

				echo '<ul class="rhr-breadcrumb"><li><a data-cursor="scale" href="' . esc_url( $homeLink ) . '">'. $home_icon .esc_html( ucwords( $home ) ) .'</a> ' . $delimiter . '</li>';

					if ( is_category() ) {
						global $wp_query;
						$cat_obj = $wp_query->get_queried_object(); 
						$this_cat = $cat_obj->term_id;
						$this_cat = get_category( $this_cat );
						$parent_cat = get_category( $this_cat->parent );
						if ( $this_cat->parent != 0 ) {
							echo '<li>' . $before . get_category_parents( $parent_cat, TRUE, ' ' . $delimiter . ' ' ) . $after .'</li>';
						}
						echo '<li>' . $before . esc_html( single_cat_title( '', false ) ) . $after .'</li>';

					}
					else if ( is_search() ) {
						echo '<li>' . $before . esc_html( get_search_query() ) . $after .'</li>';

					}
					else if ( is_day() ) {
						echo '<li><a data-cursor="scale" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a> ' . $delimiter . '</li>';
						echo '<li><a data-cursor="scale" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . esc_html( get_the_time('F') ) . '</a> ' . $delimiter . '</li>';
						echo '<li>' . $before . esc_html( get_the_time('d') ) . $after . '</li>';

					}
					else if ( is_month() ) {
						echo '<li><a data-cursor="scale" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . $delimiter . '</li>';
						echo '<li>' . $before . esc_html( get_the_time('F') ) . $after . '</li>';

					}
					else if ( is_year() ) {
						echo '<li>' . $before . esc_html( get_the_time('Y') ) . $after . '</li>';

					}
					else if ( is_single() && !is_attachment() ) {
						if ( is_singular( 'post' ) ) {

							$blog_page_title = esc_html__( 'Blog', 'rhr' );
							$blog_page_id = get_option( 'page_for_posts' );

							echo '<li><a data-cursor="scale" href="'. esc_url( get_permalink( $blog_page_id ) ) .'">'. $before . ucwords( $blog_page_title ) . $after . '</a></li>';
						}
						
						echo '<li>'. $before . ucwords( rhr_shorten_text( esc_html( get_the_title() ), 40 ) ) . $after . '</li>';

					}
					else if ( !is_single() && !is_page() && get_post_type() != 'post' && !rhr_is_shop() && !rhr_bbp_is_user_home() && !is_404() ) {

						$post_type = get_post_type_object( get_post_type() );
						echo '<li>'. $before . esc_html( ucwords( $post_type->labels->singular_name ) ) . $after.'</li>';

						if( is_tax() ) {
							$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

							echo '<li>'. $before . esc_html( ucwords( $current_term->name ) ) . $after.'</li>';
						}				

					}
					else if( rhr_bbp_is_user_home() ) {
						echo '<li>'. $before . esc_html__( 'User', 'rhr' ) . $after.'</li>';
					}
					else if ( is_attachment() ) {
						$parent = get_post( $post->post_parent );
						$cat = get_the_category( $parent->ID ); 
						if(!empty($cat)){
							$cat = $cat[0];
							echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
						}
						echo '<li><a data-cursor="scale" href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_html( ucwords( $parent->post_title ) ) . '</a></li>';
						
						echo '<li>' . $delimiter . ' ' . $before . ucwords( esc_html( get_the_title() ) ) . $after . '</li>';

					} 
					elseif ( is_page() && !$post->post_parent ) {
						echo '<li>' . $before . ucwords( esc_html( get_the_title() ) ) . $after .'</li>';

					}
					elseif ( is_page() && $post->post_parent ) {
						$parent_id  = $post->post_parent;
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_page( $parent_id );
							$breadcrumbs[] = '<li><a data-cursor="scale" href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( ucwords( get_the_title( $page->ID ) ) ) . '</a></li>';
							$parent_id  = $page->post_parent;
						}
						$breadcrumbs = array_reverse( $breadcrumbs );
						for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
							echo $breadcrumbs[$i]; //escaped Properly on five lines before from here
							if ( $i != count( $breadcrumbs ) -1 ) {
								echo ' ' . $delimiter . ' ';
							}
						}
						echo '<li>' . $delimiter . ' ' . $before . ucwords( esc_html(get_the_title() ) ) . $after . '</li>';

					}
					elseif ( is_tag() ) {
						echo '<li>' . $before . esc_html__( 'Posts Tag: ', 'rhr' ) . esc_html( ucwords(single_tag_title('', false) . '') ) . $after . '</li>';

					}
					elseif ( is_author() ) {
						global $author;
						$userdata = get_userdata($author);
						echo '<li>' .$before . esc_html__( 'Posted By: ', 'rhr' ) . esc_html( ucwords($userdata->display_name ) ) . $after .'</li>';

					}
					elseif ( is_404() ) {
						echo '<li>' .$before . esc_html__('Error 404', 'rhr' ) . $after .'</li>';
					}

					if ( get_query_var( 'paged' ) ) {
						if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
							echo ' (';
								echo esc_html__(' - Page', 'rhr' ) . ' ' . get_query_var( 'paged' );
							echo ')';
						}
					}

				echo '</ul>';

			}

		$html = ob_get_contents();
		ob_end_clean();


		// Pass breadcrumbs values for filter
		$value = array();

		$value['delimiter'] = $delimiter;
		$value['home']      = $home;
		$value['home_link'] = $homeLink;
		$value['before']    = $before;
		$value['after']     = $after;

		$html = apply_filters( 'rhrpicious_breadcrumbs_html', $html, $value );

		if( $echo ) {
			echo $html;
		}
		else {
			return $html;
		}
	}
	protected function _render_page_title() {

        // Post ID
        if ( rhr_is_shop() ) {
            $post_id = wc_get_page_id( 'shop' );
        }
        else if( is_home() || is_archive() || is_search() || is_404() ) {
            $post_id = get_option('page_for_posts');
        }       
        else {
            global $wp_query; 
            $post_id = ( 0 == get_the_ID() || NULL == get_the_ID() ) ? $wp_query->post->ID : get_the_ID();
        }

        // Post title
        if( rhr_is_shop() ) {
            $page_title = get_the_title( $post_id );
        }
        else if ( rhr_is_product_category() ) {
            $page_title = single_cat_title( '', false );
        }
        else if( rhr_bbp_is_user_home() ) {
            $page_title = esc_html( get_the_title( $post_id ) );
        }
        else if( is_home() ) {
            $page_title = esc_html__( 'Blog', 'rhr' );
        }
        else if( is_category() ) {
            $page_title = esc_html__('Posts Categorized:', 'rhr' ) . ' ' . single_cat_title( $prefix = '', $display = false );
        }
        else if( is_tag() ) { 
            $page_title = esc_html__('Posts Tagged:', 'rhr' ) . ' ' . single_tag_title( $prefix = '', $display = false );
        }
        else if( is_author() ) { 
            global $post;
            $author_id = $post->post_author;

            $page_title = esc_html__('Posts By:', 'rhr' ) . ' ' . get_the_author_meta('display_name', $author_id);

        }
        else if ( is_day() ) { 
            $page_title = esc_html__('Daily Archives:', 'rhr' ) . ' ' . get_the_time('l, F j, Y');
        }
        else if ( is_month() ) {  
            $page_title = esc_html__('Monthly Archives:', 'rhr' ) . ' ' . get_the_time('F Y');
        }
        else if ( is_year() ) {  
            $page_title = esc_html__('Posts Categorized:', 'rhr' ) . ' ' . get_the_time('Y');
        }
        else if ( is_search() ) {  
            $page_title = esc_html__('Search Result: ', 'rhr' ) .get_search_query();
        }
        else if ( is_404() ) {  
            $page_title = esc_html__('404 Error', 'rhr' );
        }
        else if ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( isset($post_type->labels->singular_name ) ) {
                $page_title = esc_html( ucwords( $post_type->labels->singular_name ) );
            }
            else {
                $page_title = esc_html( get_the_title( $post_id ) );
            }
        }       
        else {  
            $page_title = esc_html( get_the_title( $post_id ) );
        }

        return $page_title;
    }
    protected function content_template(){
        /*Content Template*/
    }

}