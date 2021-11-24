<?php 

/*
 * RHR Menu Widget
*/
class RHR_Vertical_Menu extends WP_Widget {

    public function __construct() {
		$widget_ops = array(
			'description'                 => __( 'Add a navigation menu to your footer section.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rhr_vertical_menus', esc_html__('RHR:: Navigation Menu(Vertical)','rhr' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		// Get menu.
		$nav_menu = ! empty( $instance['rhr_nav_menu'] ) ? wp_get_nav_menu_object( $instance['rhr_nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$title_url = ! empty( $instance['title_url'] ) ? $instance['title_url'] : '';
		$dataCursor = ! empty( $instance['dataCursor'] ) ? $instance['dataCursor'] : '';
		$item_class = ! empty( $instance['item_class'] ) ? $instance['item_class'] : '';
		$show_social = isset( $instance['show_social'] ) ? $instance['show_social'] : false;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $this->get_title_link($title_url, $title) . $args['after_title'];
		}
        $menu_items = wp_get_nav_menu_items($nav_menu);

        
        echo '<div class="items">';
        foreach ($menu_items as $item) {
                $target = !empty($item->target) ? ' target=' . $item->target : '';
                $attr_title = !empty($item->attr_title) ? ' title=' . $item->attr_title : '';
                $attr_rel = !empty($item->xfn) ? ' rel=' . $item->xfn : '';
                echo '<a href="'.esc_url($item->url).'" '.$target. $attr_title . $attr_rel .' id="item-'.$item->ID.'" class="item '.$item->classes[0]. ' ' .$item_class . '" data-cursor="'.esc_attr($dataCursor).'">'.$item->title.'</a>';
        }
        echo '</div>';
		if ( $show_social ) {
			$is_show_social = rhr_options('is_show_social', '');
			$is_show_social_h = rhr_options('is_show_social_h', '');
			if(true == $is_show_social) {
				if(true == $is_show_social_h) {
				echo rhr_social_icons_header(); 
				}
			}
		}
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['title_url'] ) ) {
			$instance['title_url'] = sanitize_text_field( $new_instance['title_url'] );
		}
		if ( ! empty( $new_instance['dataCursor'] ) ) {
			$instance['dataCursor'] = sanitize_text_field( $new_instance['dataCursor'] );
		}
		if ( ! empty( $new_instance['item_class'] ) ) {
			$instance['item_class'] = sanitize_text_field( $new_instance['item_class'] );
		}
		$instance['show_social'] = isset( $new_instance['show_social'] ) ? (bool) $new_instance['show_social'] : false;
		
		if ( ! empty( $new_instance['rhr_nav_menu'] ) ) {
			$instance['rhr_nav_menu'] = (int) $new_instance['rhr_nav_menu'];
		}
		return $instance;
	}

	public function form( $instance ) {
		global $wp_customize;
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$title_url    = isset( $instance['title_url'] ) ? $instance['title_url'] : '';
		$dataCursor    = isset( $instance['dataCursor'] ) ? $instance['dataCursor'] : 'scale';
		$item_class    = isset( $instance['item_class'] ) ? $instance['item_class'] : '';
		$show_social = isset( $instance['show_social'] ) ? $instance['show_social'] : false;
		$nav_menu = isset( $instance['rhr_nav_menu'] ) ? $instance['rhr_nav_menu'] : '';

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
				<label for="<?php echo $this->get_field_id( 'title_url' ); ?>"><?php _e( 'Title Url:' ); ?></label>
				<input type="url" class="widefat" id="<?php echo $this->get_field_id( 'title_url' ); ?>" name="<?php echo $this->get_field_name( 'title_url' ); ?>" value="<?php echo esc_attr( $title_url ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'dataCursor' ); ?>"><?php _e( 'Data Cursor:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dataCursor' ); ?>" name="<?php echo $this->get_field_name( 'dataCursor' ); ?>" value="<?php echo esc_attr( $dataCursor ); ?>" placeholder="Enter data-cursor like scale, scale-dark"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'item_class' ); ?>"><?php _e( 'Item Class:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'item_class' ); ?>" name="<?php echo $this->get_field_name( 'item_class' ); ?>" value="<?php echo esc_attr( $item_class ); ?>" placeholder="Enter item class like i-small"/>
			</p>
			<p><input class="checkbox" type="checkbox" <?php checked( $show_social ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_social' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_social' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_social' ) ); ?>"><?php esc_html_e( 'Display social icon?', 'rhr' ); ?></label></p>
			<p>
				<label for="<?php echo $this->get_field_id( 'rhr_nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'rhr_nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'rhr_nav_menu' ); ?>">
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
	public function get_title_link($link, $text){
		$get_link = '';
		if(!empty($link)){
			$get_link = "<a href=".esc_url($link).">$text</a>";
		}else{
			$get_link = $text;
		}
		return $get_link; 
	}
}

function rhr_vertical_menu_init(){
	register_widget('RHR_Vertical_Menu');	
}
add_action('widgets_init','rhr_vertical_menu_init');