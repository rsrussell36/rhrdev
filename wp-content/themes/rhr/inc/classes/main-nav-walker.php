<?php 

class RHR_Navwalker extends Walker_Nav_Menu  {

    public function start_lvl( &$output, $depth = 0, $args = []) {

       $indent = str_repeat("\t", $depth);
       $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    public function start_el(&$output, $page, $depth = 0, $args = [], $current_page = 0) {

  
         $indent = ($depth) ? str_repeat("\t", $depth) : '';
         $li_attributes = '';
         $class_names = $value = '';
         $classes =  empty($page->classes) ? array() : (array) $page->classes ;    
         $classes[] = 'nav-item' ;
         $classes[]  =   ($args->walker->has_children) ? 'dropdown submenu' : '';
         $classes[]  =   ($page->current || $page->current_item_ancestor) ? 'active current-menu-item current_item_ancestor' : '';
         $classes[]  =   'menu-item-'.$page->ID;
         $classes[]  =   'item';
         if($depth && $args->walker->has_children) {
            $classes[] = 'dropdown dropdown-submenu';
         }
         $class_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter($classes), $page, $args));
         $class_names = ' class="'.esc_attr($class_names).'"';

         $id = apply_filters( 'nav_menu_item_id', 'menu-item'.$page->ID, $page, $args );

         $id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';

         $output .= $indent. '<li>';

        $attributes = ! empty( $page->attr_title ) ? ' title="' . esc_attr($page->attr_title) . '"' : '';
		$attributes .= ! empty( $page->target ) ? ' target="' . esc_attr($page->target) . '"' : '';
		$attributes .= ! empty( $page->xfn ) ? ' rel="' . esc_attr($page->xfn) . '"' : '';
		$attributes .= ! empty( $page->url ) ? ' href="' . esc_attr($page->url) . '"' : '';

        $attributes .= $class_names;
        $attributes .= ' data-cursor="scale"';
        $has_child_icon = '';

        if($depth == 0 && $args->walker->has_children) {

            $has_child_icon = '<i class="fas fa-angle-down mobile_dropdown_icon"></i>';

        }elseif ($depth > 0 && $args->walker->has_children) {

            $has_child_icon = '<i class="fas fa-angle-down mobile_dropdown_icon"></i>';

        }
         
        $item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $page->title, $page->ID ) . $args->link_after;
		$item_output .='</a>'.$has_child_icon;
		$item_output .= $args->after;

        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $page, $depth, $args );
    }

}

