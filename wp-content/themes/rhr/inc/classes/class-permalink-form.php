<?php

class rhr_permalink_form {

	private $permalink_metabox = 0;

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'rhr_permalink_edit_box' ) );
		add_action( 'save_post', array( $this, 'rhr_save_post' ), 10, 3 );
		add_action( 'delete_post', array( $this, 'rhr_delete_permalink' ), 10 );
		// add_action( 'category_add_form', array( $this, 'rhr_term_options' ) );
		// add_action( 'category_edit_form', array( $this, 'rhr_term_options' ) );
		//add_action( 'init', array( $this, 'register_taxonomies_form' ) );
		add_action( 'post_tag_add_form', array( $this, 'rhr_term_options' ) );
		add_action( 'post_tag_edit_form', array( $this, 'rhr_term_options' ) );
		add_action( 'created_term', array( $this, 'rhr_save_term' ), 10, 3 );
		add_action( 'edited_term', array( $this, 'rhr_save_term' ), 10, 3 );
		add_action( 'delete_term', array( $this, 'rhr_delete_term_permalink' ), 10, 3 );
		add_action( 'rest_api_init', array( $this, 'rhr_rest_edit_form' ) );
		add_action( 'update_option_page_on_front', array( $this, 'rhr_static_homepage' ), 10, 2);
		add_filter( 'get_sample_permalink_html', array( $this, 'rhr_sample_permalink_html' ), 10, 2);
		add_filter( 'is_protected_meta', array( $this, 'rhr_protect_meta' ), 10, 2 );
	}
	private function rhr_exclude_permalinks( $post ) {
		$args  = array(
			'public' => true,
		);
		$exclude_post_types = apply_filters(
			'rhr_permalinks_exclude_post_type',
			$post->post_type
		);

		/*
		 * Exclude custom permalink `form` from any post(s) if filter returns `true`.
		 */
		$exclude_posts     = apply_filters(
			'rhr_permalinks_exclude_posts',
			$post
		);
		$public_post_types = get_post_types( $args, 'objects' );

		if ( isset( $this->permalink_metabox ) && 1 === $this->permalink_metabox ) {
			$check_availability = true;
		} elseif ( 'attachment' === $post->post_type ) {
			$check_availability = true;
		} elseif ( intval( get_option( 'page_on_front' ) ) === $post->ID ) {
			$check_availability = true;
		} elseif ( ! isset( $public_post_types[ $post->post_type ] ) ) {
			$check_availability = true;
		} elseif ( '__true' === $exclude_post_types ) {
			$check_availability = true;
		} elseif ( is_bool( $exclude_posts ) && $exclude_posts ) {
			$check_availability = true;
		} else {
			$check_availability = false;
		}

		return $check_availability;
	}

	public function rhr_permalink_edit_box() {
		add_meta_box(
			'rhr-modify-permalinks-edit-box',
			__( 'Modify Permalinks', 'rhr' ),
			array( $this, 'rhr_meta_edit_form' ),
			null,
			'normal',
			'high',
			array(
				'__back_compat_meta_box' => false,
			)
		);
	}

	public function rhr_protect_meta( $protected, $meta_key ) {
		if ( 'rhr_permalink' === $meta_key ) {
			$protected = true;
		}

		return $protected;
	}

	private function rhr_sanitize_permalink( $permalink, $language_code ) {
		/*
		 * Add Capability to allow Accents letter
		 * disabled.
		 */
		$check_accents_filter = apply_filters( 'rhr_permalinks_allow_accents', false );

		/*
		 * Add Capability to allow Capital letter
		 * disabled.
		 */
		$check_caps_filter = apply_filters( 'rhr_permalinks_allow_caps', false );

		$allow_accents = false;
		$allow_caps    = false;

		if ( is_bool( $check_accents_filter ) && $check_accents_filter ) {
			$allow_accents = $check_accents_filter;
		}

		if ( is_bool( $check_caps_filter ) && $check_caps_filter ) {
			$allow_caps = $check_caps_filter;
		}

		if ( ! $allow_accents ) {
			$permalink = remove_accents( $permalink );
		}

		if ( empty( $language_code ) ) {
			$language_code = get_locale();
		}

		$permalink = wp_strip_all_tags( $permalink );
		$permalink = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $permalink );
		$permalink = str_replace( '%', '', $permalink );
		$permalink = preg_replace( '|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $permalink );

		if ( 'en' === $language_code || strpos( $language_code, 'en_' ) === 0 ) {
			if ( seems_utf8( $permalink ) ) {
				if ( ! $allow_accents ) {
					if ( function_exists( 'mb_strtolower' ) ) {
						if ( ! $allow_caps ) {
							$permalink = mb_strtolower( $permalink, 'UTF-8' );
						}
					}
					$permalink = utf8_uri_encode( $permalink );
				}
			}
		}

		if ( ! $allow_caps ) {
			$permalink = strtolower( $permalink );
		}
		$permalink = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $permalink );
		$permalink = str_replace( array( '&nbsp;', '&#160;', '&ndash;', '&#8211;', '&mdash;', '&#8212;' ), '-', $permalink );

		$permalink = str_replace(
			array(
				// Soft hyphens.
				'%c2%ad',
				// &iexcl and &iquest.
				'%c2%a1',
				'%c2%bf',
				// Angle quotes.
				'%c2%ab',
				'%c2%bb',
				'%e2%80%b9',
				'%e2%80%ba',
				// Curly quotes.
				'%e2%80%98',
				'%e2%80%99',
				'%e2%80%9c',
				'%e2%80%9d',
				'%e2%80%9a',
				'%e2%80%9b',
				'%e2%80%9e',
				'%e2%80%9f',
				// Bullet.
				'%e2%80%a2',
				// Copy, &reg, &deg, HORIZONTAL ELLIPSIS, and &trade.
				'%c2%a9',
				'%c2%ae',
				'%c2%b0',
				'%e2%80%a6',
				'%e2%84%a2',
				// Acute accents.
				'%c2%b4',
				'%cb%8a',
				'%cc%81',
				'%cd%81',
				// Grave accent, macron, caron.
				'%cc%80',
				'%cc%84',
				'%cc%8c',
			),
			'',
			$permalink
		);

		// Convert &times to 'x'.
		$permalink = str_replace( '%c3%97', 'x', $permalink );
		// Kill entities.
		$permalink = preg_replace( '/&.+?;/', '', $permalink );

		// Avoid removing characters of other languages like persian etc.
		if ( 'en' === $language_code || strpos( $language_code, 'en_' ) === 0 ) {
			// Allow Alphanumeric and few symbols only.
			if ( ! $allow_caps ) {
				$permalink = preg_replace( '/[^%a-z0-9 \.\/_-]/', '', $permalink );
			} else {
				// Allow Capital letters.
				$permalink = preg_replace( '/[^%a-zA-Z0-9 \.\/_-]/', '', $permalink );
			}
		} else {
			$reserved_chars = array(
				'(',
				')',
				'[',
				']',
			);
			$unsafe_chars   = array(
				'<',
				'>',
				'{',
				'}',
				'|',
				'`',
				'^',
				'\\',
			);

			$permalink = str_replace( $reserved_chars, '', $permalink );
			$permalink = str_replace( $unsafe_chars, '', $permalink );
			$permalink = urlencode( $permalink );
			$permalink = str_replace( '%2F', '/', $permalink );

			$replace_hyphen = array( '%20', '%2B', '+' );
			$split_path     = explode( '%3F', $permalink );
			if ( 1 < count( $split_path ) ) {
				$replaced_path = str_replace( $replace_hyphen, '-', $split_path[0] );
				$replaced_path = preg_replace( '/(\-+)/', '-', $replaced_path );
				$permalink     = str_replace(
					$split_path[0],
					$replaced_path,
					$permalink
				);
			} else {
				$permalink = str_replace( $replace_hyphen, '-', $permalink );
				$permalink = preg_replace( '/(\-+)/', '-', $permalink );
			}
		}

		$allow_dot = explode( '.', $permalink );
		if ( 0 < count( $allow_dot ) ) {
			$new_perm   = $allow_dot[0];
			$dot_length = count( $allow_dot );
			for ( $i = 1; $i < $dot_length; ++$i ) {
				preg_match( '/^[a-z]/', $allow_dot[ $i ], $check_perm );
				if ( isset( $check_perm ) && ! empty( $check_perm ) ) {
					$new_perm .= '.';
				}
				$new_perm .= $allow_dot[ $i ];
			}

			$permalink = $new_perm;
		}
		$permalink = preg_replace( '/\s+/', '-', $permalink );
		$permalink = preg_replace( '|-+|', '-', $permalink );
		$permalink = str_replace( '-/', '/', $permalink );
		$permalink = str_replace( '/-', '/', $permalink );
		$permalink = trim( $permalink, '-' );

		return $permalink;
	}
	public function rhr_save_post( $post_id, $post ) {
		if ( ! isset( $_REQUEST['_rhr_permalinks_post_nonce'] )
			&& ! isset( $_REQUEST['rhr_permalink'] )
		) {
			return;
		}

		$action = 'rhr-permalinks_' . $post_id;
		if ( ! wp_verify_nonce( $_REQUEST['_rhr_permalinks_post_nonce'], $action ) ) {
			return;
		}

		$cp_frontend   = new rhr_permalink_frontend();
		$original_link = $cp_frontend->rhr_original_post_link( $post_id );

		if ( ! empty( $_REQUEST['rhr_permalink'] )
			&& $_REQUEST['rhr_permalink'] !== $original_link
		) {
			$language_code = apply_filters(
				'rhr_wpml_element_language_code',
				null,
				array(
					'element_id'   => $post_id,
					'element_type' => $post->post_type,
				)
			);

			$permalink = $this->rhr_sanitize_permalink(
				$_REQUEST['rhr_permalink'],
				$language_code
			);
			$permalink = apply_filters(
				'rhr_permalink_before_saving',
				$permalink,
				$post_id
			);

			update_post_meta( $post_id, 'rhr_permalink', $permalink );
		}
	}

	public function rhr_delete_permalink( $post_id ) {
		delete_metadata( 'post', $post_id, 'rhr_permalink' );
	}
	
	private function rhr_get_permalink_html( $post, $meta_box = false ) {
		$post_id   = $post->ID;
		$permalink = get_post_meta( $post_id, 'rhr_permalink', true );

		ob_start();

		$cp_frontend = new rhr_permalink_frontend();
		if ( 'page' === $post->post_type ) {
			$original_permalink = $cp_frontend->rhr_original_page_link( $post_id );
			$view_post          = __( 'View Page', 'rhr' );
		} else {
			$post_type_name   = '';
			$post_type_object = get_post_type_object( $post->post_type );
			if ( is_object( $post_type_object ) && isset( $post_type_object->labels )
				&& isset( $post_type_object->labels->singular_name )
			) {
				$post_type_name = ' ' . $post_type_object->labels->singular_name;
			} elseif ( is_object( $post_type_object )
				&& isset( $post_type_object->label )
			) {
				$post_type_name = ' ' . $post_type_object->label;
			}

			$original_permalink = $cp_frontend->rhr_original_post_link( $post_id );
			$view_post          = __( 'View', 'rhr' ) . $post_type_name;
		}
		$this->rhr_get_permalink_form(
			$permalink,
			$original_permalink,
			$post_id,
			false,
			$post->post_name
		);

		$content = ob_get_contents();
		ob_end_clean();

		if ( 'trash' !== $post->post_status ) {
			$home_url = trailingslashit( home_url() );
			if ( isset( $permalink ) && ! empty( $permalink ) ) {
				$view_post_link = $home_url . $permalink;
			} else {
				if ( 'draft' === $post->post_status ) {
					$view_post      = 'Preview';
					$view_post_link = $home_url . '?';
					if ( 'page' === $post->post_type ) {
						$view_post_link .= 'page_id';
					} elseif ( 'post' === $post->post_type ) {
						$view_post_link .= 'p';
					} else {
						$view_post_link .= 'post_type=' . $post->post_type . '&p';
					}
					$view_post_link .= '=' . $post_id . '&preview=true';
				} else {
					$view_post_link = $home_url . $original_permalink;
				}
			}

			$content .= ' <span id="view-post-btn">' .
										'<a href="' . $view_post_link . '" class="button button-medium" target="_blank">' . $view_post . '</a>' .
									'</span><br>';
			if ( true === $meta_box ) {
				$content .= '<style>.editor-post-permalink,.cp-permalink-hidden{display:none;}</style>';
			}
		}

		return '<strong>' . __( 'Permalink:', 'rhr' ) . '</strong> ' . $content;
	}

	/**
	 * Per-post/page options.
	 */
	public function rhr_sample_permalink_html( $html, $post_id ) {
		$post = get_post( $post_id );

		$disable_cp              = $this->rhr_exclude_permalinks( $post );
		$this->permalink_metabox = 1;
		if ( $disable_cp ) {
			return $html;
		}

		$output_content = $this->rhr_get_permalink_html( $post );

		return $output_content;
	}
	public function rhr_meta_edit_form( $post ) {
		$disable_cp = $this->rhr_exclude_permalinks( $post );
		if ( $disable_cp ) {
			wp_enqueue_script(
				'rhr-modify-permalinks-form',
				get_theme_file_uri( '/assets/admin/permalink/rhr-permalink.js' ),
				array(),
				'1.0.0',
				true
			);
			return;
		}

		$screen = get_current_screen();
		if ( 'add' === $screen->action ) {
			echo '<input value="add" type="hidden" name="rhr-permalinks-add" id="rhr-permalinks-add" />';
		}

		$output_content = $this->rhr_get_permalink_html( $post, true );

		echo $output_content;
	}

	/**
	 * Per-category/tag options.
	 */
	// public function register_taxonomies_form() {
    //     $args = array(
    //       'public' => true
    //     );
    //     $taxonomies = get_taxonomies( $args, 'names' );
    //     foreach ( $taxonomies as $taxonomy ) {
    //       if ( 'nav_menu' == $taxonomy ) {
    //         continue;
    //       }
    //       add_action( $taxonomy . '_add_form', array( $this, 'rhr_term_options' ) );
    //       add_action( $taxonomy . '_edit_form', array( $this, 'rhr_term_options' ) );
    //     }
    //   }
	public function rhr_term_options( $tag ) {
		$permalink          = '';
		$original_permalink = '';
       
		if ( is_object( $tag ) && isset( $tag->term_id ) ) {
			$cp_frontend = new rhr_permalink_frontend();
			if ( $tag->term_id ) {
				$permalink          = $cp_frontend->rhr_term_permalink( $tag->term_id );
				$original_permalink = $cp_frontend->rhr_original_term_link(
					$tag->term_id
				);
			}
			$this->rhr_get_permalink_form( $permalink, $original_permalink, $tag->term_id );
		} else {
			$this->rhr_get_permalink_form( $permalink, $original_permalink, $tag );
		}

		wp_enqueue_script( 'jquery' );
		?>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			var button = jQuery('#rhr_permalink_form').parent().find('.submit');
			button.remove().insertAfter(jQuery('#rhr_permalink_form'));
		});
		</script>
		<?php
	}

	/**
	 * Helper function to render form.
	 */
	private function rhr_get_permalink_form( $permalink, $original, $id, $render_containers = true, $postname = '') {
		$encoded_permalink = htmlspecialchars( urldecode( $permalink ) );
		$home_url          = trailingslashit( home_url() );

		if ( $render_containers ) {
			wp_nonce_field(
				'rhr-permalinks_' . $id,
				'_rhr_permalinks_term_nonce',
				false,
				true
			);
		} else {
			wp_nonce_field(
				'rhr-permalinks_' . $id,
				'_rhr_permalinks_post_nonce',
				false,
				true
			);
		}

		echo '<input value="' . $home_url . '" type="hidden" name="rhr_permalinks_home_url" id="rhr_permalinks_home_url" />' .
		'<input value="' . $encoded_permalink . '" type="hidden" name="rhr_permalink" id="rhr_permalink" />';

		if ( $render_containers ) {
			echo '<table class="form-table" id="rhr_permalink_form">' .
				'<tr>' .
					'<th scope="row">' . esc_html__( 'Modify Permalink', 'rhr' ) . '</th>' .
					'<td>';
		}
		if ( '' === $permalink ) {
			$original = $this->check_conflicts( $original );
		}

		if ( $permalink ) {
			$post_slug            = htmlspecialchars( urldecode( $permalink ) );
			$original_encoded_url = htmlspecialchars( urldecode( $original ) );
		} else {
			$post_slug            = htmlspecialchars( urldecode( $original ) );
			$original_encoded_url = $post_slug;
		}

		wp_enqueue_script(
			'rhr-modify-permalinks-form',
			get_theme_file_uri( '/assets/admin/permalink/rhr-permalink.js' ),
			array(),
			'1.1.0',
			true
		);
		$postname_html = '';
		if ( isset( $postname ) && '' !== $postname ) {
			$postname_html = '<input type="hidden" id="new-post-slug" class="text" value="' . $postname . '" />';
		}

		$field_style = 'width: 250px;';
		if ( ! $permalink ) {
			$field_style .= ' color: #2c3338;';
		}

		echo $home_url .
		'<span id="editable-post-name" title="Click to edit this part of the permalink">' .
			$postname_html .
			'<input type="hidden" id="rhr-original-permalink" value="' . $original_encoded_url . '" />' .
			'<input type="text" id="rhr-modify-permalinks-post-slug" class="text" value="' . $post_slug . '" style="' . $field_style . '" />' .
		'</span>';

		if ( $render_containers ) {
			echo '<br />' .
			'<small>' .
				esc_html__( 'Enter your permalink (or) Leave to aply theme default.', 'rhr' ) .
			'</small>' .
			'</td>' .
			'</tr>' .
			'</table>';
		}
	}

	/**
	 * Save term (common to tags and categories).
	 */
	public function rhr_save_term( $term_id ) {
		$term = get_term( $term_id );

		if ( ! isset( $_REQUEST['_rhr_permalinks_term_nonce'] )
			&& ! isset( $_REQUEST['rhr_permalink'] )
		) {
			return;
		}

		$action1 = 'rhr-permalinks_' . $term_id;
		$action2 = 'rhr-permalinks_' . $term->taxonomy;
		// phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		if ( ! wp_verify_nonce( $_REQUEST['_rhr_permalinks_term_nonce'], $action1 )
			&& ! wp_verify_nonce( $_REQUEST['_rhr_permalinks_term_nonce'], $action2 )
		) {
			return;
		}

		if ( isset( $term ) && isset( $term->taxonomy ) ) {
			$taxonomy_name = $term->taxonomy;
			if ( 'category' === $taxonomy_name || 'post_tag' === $taxonomy_name ) {
				if ( 'post_tag' === $taxonomy_name ) {
					$taxonomy_name = 'tag';
				}

				$new_permalink = ltrim(
					stripcslashes( $_REQUEST['rhr_permalink'] ),
					'/'
				);
				if ( empty( $new_permalink ) || '' === $new_permalink ) {
					return;
				}

				$cp_frontend   = new rhr_permalink_frontend();
				$old_permalink = $cp_frontend->rhr_original_term_link( $term_id );
				if ( $new_permalink === $old_permalink ) {
					return;
				}

				$this->rhr_delete_term_permalink( $term_id );

				$language_code = '';
				if ( isset( $term->term_taxonomy_id ) ) {
					$term_type = 'category';
					if ( isset( $term->taxonomy ) ) {
						$term_type = $term->taxonomy;
					}

					$language_code = apply_filters(
						'rhr_wpml_element_language_code',
						null,
						array(
							'element_id'   => $term->term_taxonomy_id,
							'element_type' => $term_type,
						)
					);
				}

				$permalink = $this->rhr_sanitize_permalink( $new_permalink, $language_code );
				$table     = get_option( 'rhr_permalinks' );

				if ( $permalink && ! array_key_exists( $permalink, $table ) ) {
					$table[ $permalink ] = array(
						'id'   => $term_id,
						'kind' => $taxonomy_name,
						'slug' => $term->slug,
					);
				}

				update_option( 'rhr_permalinks', $table );
			}
		}
	}

	/**
	 * Delete term.
	 */
	public function rhr_delete_term_permalink( $term_id ) {
		$table = get_option( 'rhr_permalinks' );
		if ( $table ) {
			foreach ( $table as $link => $info ) {
				if ( $info['id'] === (int) $term_id ) {
					unset( $table[ $link ] );
					break;
				}
			}
		}

		update_option( 'rhr_permalinks', $table );
	}

	/**
	 * Check Conflicts and resolve it (e.g: Polylang) UPDATED for Polylang
	 * hide_default setting.
	 */
	public function check_conflicts( $requested_url = '' ) {
		if ( '' === $requested_url ) {
			return;
		}

		// Check if the Polylang Plugin is installed so, make changes in the URL.
		if ( defined( 'POLYLANG_VERSION' ) ) {
			$polylang_config = get_option( 'polylang' );
			if ( 1 === $polylang_config['force_lang'] ) {
				if ( false !== strpos( $requested_url, 'language/' ) ) {
					$requested_url = str_replace( 'language/', '', $requested_url );
				}

				/*
				 * Check if `hide_default` is `true` and the current language is not
				 * the default. Otherwise remove the lang code from the url.
				 */
				if ( 1 === $polylang_config['hide_default'] ) {
					$current_language = '';
					if ( function_exists( 'pll_current_language' ) ) {
						// get current language.
						$current_language = pll_current_language();
					}

					// get default language.
					$default_language = $polylang_config['default_lang'];
					if ( $current_language !== $default_language ) {
						$remove_lang = ltrim( strstr( $requested_url, '/' ), '/' );
						if ( '' !== $remove_lang ) {
							return $remove_lang;
						}
					}
				} else {
					$remove_lang = ltrim( strstr( $requested_url, '/' ), '/' );
					if ( '' !== $remove_lang ) {
						return $remove_lang;
					}
				}
			}
		}

		return $requested_url;
	}

	/**
	 * Refresh Permalink using AJAX Call.
	 */
	public function rhr_refresh_meta_form( $data ) {
		if ( isset( $data['id'] ) && is_numeric( $data['id'] ) ) {
			$post                               = get_post( $data['id'] );
			$all_permalinks                     = array();
			$all_permalinks['rhr_permalink'] = get_post_meta(
				$data['id'],
				'rhr_permalink',
				true
			);

			if ( ! $all_permalinks['rhr_permalink'] ) {
				if ( 'draft' === $post->post_status ) {
					$view_post_link = '?';
					if ( 'page' === $post->post_type ) {
						$view_post_link .= 'page_id';
					} elseif ( 'post' === $post->post_type ) {
						$view_post_link .= 'p';
					} else {
						$view_post_link .= 'post_type=' . $post->post_type . '&p';
					}
					$view_post_link .= '=' . $data['id'] . '&preview=true';

					$all_permalinks['preview_permalink'] = $view_post_link;
				}
			} else {
				$all_permalinks['rhr_permalink'] = htmlspecialchars(
					urldecode(
						$all_permalinks['rhr_permalink']
					)
				);
			}

			$cp_frontend = new rhr_permalink_frontend();
			if ( 'page' === $post->post_type ) {
				$all_permalinks['original_permalink'] = $cp_frontend->rhr_original_page_link(
					$data['id']
				);
			} else {
				$all_permalinks['original_permalink'] = $cp_frontend->rhr_original_post_link(
					$data['id']
				);
			}

			echo wp_json_encode( $all_permalinks );
			exit;
		}
	}

	/**
	 * Added Custom Endpoints for refreshing the permalink.
	 */
	public function rhr_rest_edit_form() {
		register_rest_route(
			'rhr-permalinks/v1',
			'/get-permalink/(?P<id>\d+)',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'rhr_refresh_meta_form' ),
				'args'                => array(
					'id' => array(
						'validate_callback' => 'is_numeric',
					),
				),
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	/**
	 * Delete the permalink for the page selected as the static Homepage.
	 */
	public function rhr_static_homepage( $prev_homepage_id, $new_homepage_id ) {
		if ( $prev_homepage_id !== $new_homepage_id ) {
			$this->rhr_delete_permalink( $new_homepage_id );
		}
	}

}
new rhr_permalink_form();