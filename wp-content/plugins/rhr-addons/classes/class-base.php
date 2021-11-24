<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

abstract class CREST_BASE extends Widget_Base{
	public $__new_icon_prefix  = 'selected_';
	public function __get_icon( $setting = null, $settings = null, $format = '%s', $icon_class = '' ) {
		return $this->__render_icon( $setting, $settings, $format, $icon_class, false );
	}
 	public function __render_icon( $setting = null, $settings = null, $format = '%s', $icon_class = '', $echo = true ) {

		if ( null === $settings ) {
			$settings = $this->get_settings_for_display();
		}

		$new_setting = $this->__new_icon_prefix . $setting;

		$migrated = isset( $settings['__fa4_migrated'][ $new_setting ] );
		$is_new = ( empty( $settings[ $setting ] ) || 'false' === $settings[ $setting ] )
		          && class_exists( 'Elementor\Icons_Manager' ) && Icons_Manager::is_migration_allowed();

		$icon_html = '';

		if ( $is_new || $migrated ) {

			$attr = array( 'aria-hidden' => 'true' );

			if ( ! empty( $icon_class ) ) {
				$attr['class'] = $icon_class;
			}

			if ( isset( $settings[ $new_setting ] ) ) {
				ob_start();
				Icons_Manager::render_icon( $settings[ $new_setting ], $attr );

				$icon_html = ob_get_clean();
			}

		} else if ( ! empty( $settings[ $setting ] ) ) {

			if ( empty( $icon_class ) ) {
				$icon_class = $settings[ $setting ];
			} else {
				$icon_class .= ' ' . $settings[ $setting ];
			}

			$icon_html = sprintf( '<i class="%s" aria-hidden="true"></i>', $icon_class );
		}

		if ( empty( $icon_html ) ) {
			return;
		}

		if ( ! $echo ) {
			return sprintf( $format, $icon_html );
		}

		printf( $format, $icon_html );
	}
	protected function get_html_wrapper_class() {
		return 'rhr-addons rhr-addons-'.$this->get_name();
	}
	public function __open_wrap() {
		printf( '<div class="elementor-%s">', $this->get_name() );
	}
	public function __close_wrap() {
		echo '</div>';
	}
}