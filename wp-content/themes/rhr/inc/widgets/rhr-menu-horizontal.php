<?php

/*
 * RHR Menu Widget
*/
class RHR_Horizontal_Menu extends WP_Widget {
    public function __construct() {
		$widget_ops = array(
			'description'                 => __( 'Add a navigation menu to your footer section.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rhr_horizontal_menus', esc_html__('RHR:: Navigation Menu (Horizontal)','rhr' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		// Get menu.
		$nav_menu = ! empty( $instance['rhr_nav_menu_h'] ) ? wp_get_nav_menu_object( $instance['rhr_nav_menu_h'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
        $menu_items = wp_get_nav_menu_items($nav_menu);

        $count = count($menu_items);
        echo '<div class="bottom">';
        foreach ($menu_items as $i => $item) {
            if (empty($item->menu_item_parent)) {
                $target = !empty($item->target) ? ' target=' . $item->target : '';
                $attr_title = !empty($item->attr_title) ? ' title=' . $item->attr_title : '';
                $attr_rel = !empty($item->xfn) ? ' rel=' . $item->xfn : '';
                echo '<a href="'.esc_url($item->url).'" '.$target. $attr_title . $attr_rel .' id="item-'.$item->ID.'" class="links '.$item->classes[0].'" data-cursor="scale">'.$item->title.'</a>';
				if ($i < $count - 1) echo '<div class="bullet"></div>';
			}else{
                echo '<p>Use menu without parent menu.</p>';
            }
        }
        echo '</div>';
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['rhr_nav_menu_h'] ) ) {
			$instance['rhr_nav_menu_h'] = (int) $new_instance['rhr_nav_menu_h'];
		}
		return $instance;
	}

	public function form( $instance ) {
		global $wp_customize;
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['rhr_nav_menu_h'] ) ? $instance['rhr_nav_menu_h'] : '';

		// Get menus.
		$menus = wp_get_nav_menus();

		$empty_menus_style     = '';
		$not_empty_menus_style = '';
		if ( empty( $menus ) ) {
			$empty_menus_style = ' style="display:none" ';
		} else {
			$not_empty_menus_style = ' style="display:none" ';
		}

		$nav_menu_style = '';
		if ( ! $nav_menu ) {
			$nav_menu_style = 'display: none;';
		}

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php echo $not_empty_menus_style; ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}

			/* translators: %s: URL to create a new menu. */
			printf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) );
			?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php echo $empty_menus_style; ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'rhr_nav_menu_h' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'rhr_nav_menu_h' ); ?>" name="<?php echo $this->get_field_name( 'rhr_nav_menu_h' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php echo $nav_menu_style; ?>">
					<button type="button" class="button"><?php _e( 'Edit Menu' ); ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}

function rhr_horizontal_menu_init(){
	register_widget('RHR_Horizontal_Menu');
}
add_action('widgets_init','rhr_horizontal_menu_init');
