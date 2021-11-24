<?php 
class Metabox{
    public $utils;
    private $meta_arr;
    private $fields;
    public function __construct( $metabox ) {
        
        $this->meta_arr = $metabox['metabox'];
        $this->fields   = $metabox['fields'];
        add_action( 'add_meta_boxes', array( $this,'create_meta_boxes' ) );
        add_action( 'save_post', array( $this,'save_meta_boxes' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'metabox_register_style' ) );
    }
    private function in_array_r( $needle, $haystack, $strict = false ) {
        foreach ( $haystack as $item ) {
            if ( ( $strict ? $item === $needle : $item == $needle ) || ( is_array( $item ) && $this->in_array_r( $needle, $item, $strict ) ) ) {
                return true;
            }
        }

        return false;
    }
    public function metabox_register_style( $hook_suffix ){

        if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {
            wp_enqueue_style( 'metabox-select2', RHR_ASSETS . '/admin/metabox/css/select2.min.css', [], RHR_VERSION );
            wp_enqueue_style( 'metabox-css', RHR_ASSETS . '/admin/metabox/css/metabox.css', [], RHR_VERSION );
            //Scripts
			wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'metabox_select2', RHR_ASSETS . '/admin/metabox/js/select2.full.min.js', [ 'jquery' ], RHR_VERSION);
            wp_enqueue_script( 'metabox_admin_js', RHR_ASSETS . '/admin/metabox/js/plugin.js', [ 'jquery', 'wp-color-picker', 'jquery-ui-datepicker' ], RHR_VERSION);
            
            wp_enqueue_script( 'metabox_plugin_js', RHR_ASSETS . '/admin/metabox/js/metabox.js', [ 'jquery', 'wp-color-picker', 'jquery-ui-datepicker' ], RHR_VERSION);
            wp_enqueue_script( 'metabox_media_manager', RHR_ASSETS .'/admin/metabox/js/media-upload.js', [ 'jquery','jquery-ui-sortable' ], RHR_VERSION);
        }
    }
    public function create_meta_boxes(){
        add_meta_box($this->meta_arr['id'], $this->meta_arr['title'], array($this,'metabox_callback'), $this->meta_arr['post_type'], $this->meta_arr['context'],$this->meta_arr['priority']);
    }

    public function metabox_callback( $post ){

        // Create Nonce
        $nonce = $this->meta_arr['id'];
        wp_nonce_field( __FILE__, $nonce.'_nonce' );

        if ( $this->meta_arr['tabs'] ) {

            $i = $j = 0; $count = count( $this->fields ); $tabs_html = $this->fields_html = '';
            // Fields array
            foreach ( $this->fields as $field ) {
                
                if ( $field['type'] == 'heading' ){

                    // Build Tabs html
                    $tabs_html .= '<li class="' . trim( strtolower( str_replace(' ', '-', $field['title']) ) ) . '">';
                        if( $field['icon'] != '' ){
                            $tabs_html .= '<i class="dashicons dashicons-'.$field['icon'].'"></i>';
                        }                                       
                        $tabs_html .= $field['title'];
                    $tabs_html .= '</li>';

                    if( $j > 0 ){
                        $this->fields_html .= '</div>';
                    }
                    $this->fields_html .= '<div class="'.trim(strtolower(str_replace(' ', '-', $field['title']))).'">';
                    $j++;
                }

                elseif ( $field['type'] == 'repeatable' ) {

                    $meta_value = get_post_meta( $post->ID, $field['id'], true );
                    $this->repeatablefields( $field, $meta_value );

                }

                elseif ( $field['type'] != 'heading' ){

                    $meta_value = get_post_meta( $post->ID, $field['id'], true );
                    $this->metafields( $field, $meta_value );

                }
                        
                $i++;
                if( $count == $i ){
                    $this->fields_html .= '</div>'; //close div for last element (since type=heading will not come as next element)
                }

            }

            // metabox container
            echo '<div id="metabox-tab" class="metabox verticalTab resp-vtabs">';

                // metabox tabs
                echo '<ul class="resp-tabs-list">';
                    echo $tabs_html;
                echo '</ul>';

                // Tab container
                echo '<div class="resp-tabs-container">';                       
                    echo $this->fields_html;
                    echo '<br class="clear">'; // float clear
                echo '</div>'; //#end of .resp-tabs-container

            echo '</div>'; // #end of #metabox-tab

        } else {
            $this->metafields( $value, $meta_value );
        }
    }

    public function repeatablefields( $field, $meta_value ){
        

        $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'] ) . '_field" class="rhr_repeatable_field float-clear">';

            $this->fields_html .= '<h3 class="rhr-sub-title">' . ucwords($field['title']) . '</h3>';
            //Description or tooltips
            if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
            }
            elseif (!empty($field['description'])) {
                $this->fields_html .= '<p class="description rhr_repeatable_desc">' . esc_html ($field['description']). '</p>';
            }

            $fields_value = isset($meta_value[$field['id']]) ? $meta_value[$field['id']] : array();

            $i = 0;
            if ( $fields_value ) {
                
                foreach( $fields_value as $field_value ) {

                    $this->fields_html .= '<div class="rhr_repeatable_field_set"><span class="repeatable-sort sort hndle">|||</span><a class="repeatable-remove button" href="#">-</a>';
                        foreach ( $field['fields'] as $key => $fd ) {   

                            if ( $fd['type'] != 'heading' && $fd['type'] != 'repeatable' ) {    
                                $this->metafields( $fd, $field_value, '[]', '['. $i .']' );
                            } 
                            
                        }
                    $this->fields_html .= '</div>';
                    $i++;
                }

            } else {

                $this->fields_html .= '<div class="rhr_repeatable_field_set"><span class="repeatable-sort sort hndle">|||</span><a class="repeatable-remove button" href="#">-</a>';
                    foreach ( $field['fields'] as $key => $fd ) {   

                        if ( $fd['type'] != 'heading' && $fd['type'] != 'repeatable' ) {    
                            $this->metafields( $fd, $fields_value, '[]', '['. $i .']' );
                        } 
                        
                    }
                $this->fields_html .= '</div>';

            }

            //Hidden one for jquery to clone
            $this->fields_html .= '<div class="empty-row screen-reader-text rhr_repeatable_field_set"><span class="repeatable-sort sort hndle">|||</span><a class="repeatable-remove button" href="#">-</a>';
                foreach ( $field['fields'] as $key => $fd ) {   

                    if ( $fd['type'] != 'heading' && $fd['type'] != 'repeatable' ) {    
                        $this->metafields( $fd, $fields_value, '[]', '['. $i .']' );
                    } 
                    
                }
            $this->fields_html .= '</div>';

            $this->fields_html .= '<a class="repeatable-add button" href="#">+ Add</a>';
        $this->fields_html .= "</div>";
    }

    public function metafields( $field, $meta_value = '', $i = '', $r = '' ){

        global $post;

        $fold_class = '';
        if ( array_key_exists( "fold", $field) ) {
            //print_r($meta_value);

            foreach ( $field['fold'] as $fid => $f_val ) {

                $fold_class = "f_".$fid." ";
                $fold_class .= implode(" ", $f_val);

                if ( $meta_value != $f_val ) {
                    $fold_class .= " temphide ";
                }

            }

        }


        switch($field['type']){             

            case 'text':
            case 'number':
            case 'email':
            case 'tel':
            case 'url':

                $std = isset( $field['std'] ) ? $field['std'] : '';
                $text_value = isset( $meta_value ) && $meta_value ? $meta_value : $std;
                $field_class =  isset($field['class']) ? $field['class'] : '';
                $number_attr = '';
                if ( $field['type'] == 'number' ) {
                    $min = ( isset( $field['min'] ) && ! empty( $field['min'] ) ) ? ' min="' . $field['min'] . '"' : '';
                    $max = ( isset( $field['max'] ) && ! empty( $field['max'] ) ) ? ' max="' . $field['max'] . '"' : '';
                    $step = ( isset( $field['step'] ) && ! empty( $field['step'] ) ) ? ' step="' . $field['step'] . '"' : '';

                    $number_attr = $min . $max . $step;
                }

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class .' '. esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' ">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<input type="' . esc_attr( $field['type'] ) . '" class="' . esc_attr( $field['id']) . '_inner" name="' . esc_attr( $field['id'].$i ) . '" id="' . esc_attr( $field['id'].$r ) . '"'. $number_attr .' value="' . esc_attr( $text_value ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '"/>';

                    $this->fields_html .= '</div>';

                $this->fields_html .= '</div>';
            break;

            case 'textarea':

                $std = isset( $field['std'] ) ? $field['std'] : '';
                $textarea_value = isset( $meta_value ) && $meta_value ? $meta_value : $std;
                $field_class =  isset($field['class']) ? $field['class'] : '';
                $field_rows =  isset($field['rows']) ? $field['rows'] : 10;
                $field_cols =  isset($field['cols']) ? $field['cols'] : 50;

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class .' ' .esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' ">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<textarea class="' . esc_attr( $field['id']) . '_inner" name="' . esc_attr( $field['id'].$i ) . '" id="' . esc_attr( $field['id'].$r ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="' . esc_attr( $field_rows ) . '" cols="' . esc_attr( $field_cols ) . '">' . esc_textarea( $textarea_value ) . '</textarea> ';

                    $this->fields_html .= '</div>';

                $this->fields_html .= '</div>';
            break;

            case 'radio':

                $radio_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' .$field_class .' '. esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $fold = '';
                        if (array_key_exists("folds",$field)) $fold="fld ";

                        $this->fields_html .= '<div class="radio-style">';

                            foreach ( $field['options'] as $key => $opt ) {

                                $this->fields_html .= '<input type="radio" name="'.esc_attr($field['id'].$i).'" data-id="'.esc_attr($field['id'].$i).'" id="'.esc_attr($opt).'" class="'. $fold .'" value="'.esc_attr($key).'" '.checked($radio_value, $key, false).'>';

                                $this->fields_html .= '<label for="'.esc_attr( $opt ).'">'.esc_html( ucwords($opt) ).'</label>';
                            }

                            

                        $this->fields_html .= '</div>';

                    $this->fields_html .= '</div>';

                $this->fields_html .= '</div>';

            break;

            case 'select':

                $select_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' . esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<div class="select-style">';

                        $fold = '';
                        if (array_key_exists("folds",$field)) $fold="fld ";

                            $this->fields_html .= '<select data-id="'.esc_attr($field['id'].$i).'" id="' . esc_attr( $field['id'].$r ) . '" name="' . esc_attr($field['id'].$i ) . '" class="'. $fold . esc_attr( $field['id'] ) . '_inner">';

                                foreach ( $field['options'] as $key => $opt ) {

                                    $this->fields_html .= '<option id="'.esc_attr( $key ).'" value="'.esc_attr( $key ).'" '. (($select_value == $key) ? ' selected="selected"' : ''). '>' .esc_html( $opt ). '</option>';
                                }

                            $this->fields_html .= '</select> ';

                        $this->fields_html .= '</div>';

                    $this->fields_html .= '</div>';

                $this->fields_html .= '</div>';

            break;
            case 'multi_select':

                $select_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';
   
                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' . esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<div class="form-group select-style" app-field-wrapper="' . esc_attr($field['id'].$i) . '">';

                        $fold = '';
                        if (array_key_exists("folds",$field)) $fold="fld ";

                            $this->fields_html .= '<select data-id="'.esc_attr($field['id'].$i).'" id="' . esc_attr( $field['id'].$r ) . '" name="' . esc_attr($field['id'].$i .'[]') . '" class="selectpicker '. $fold . esc_attr( $field['id'] ) . '_inner" multiple="multiple">';

                                foreach ( $field['options'] as $key => $opt ) {
                                    
                                    $this->fields_html .= '<option id="'.esc_attr( $key ).'" value="'.esc_attr( $key ).'" ' . selected(true, in_array($key, $select_value), false) . '>' .esc_html( $opt ). '</option>';
                                }

                            $this->fields_html .= '</select> ';

                        $this->fields_html .= '</div>';

                    $this->fields_html .= '</div>';

                $this->fields_html .= '</div>';

            break; 
            case 'colorpicker':

                $colorpicker_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' . esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';
                                
                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-color-picker">';

                        $this->fields_html .= '<input id="' . esc_attr( $field['id'].$r ) . '" name="' . esc_attr( $field['id'].$i ) . '" class="meta-color ' . esc_attr( $field['id'] ) . '_inner" type="text" value="'. esc_attr( $colorpicker_value ) .'">';

                    $this->fields_html .= '</div>';
                
                $this->fields_html .= '</div>';

            break;

            case 'media_manager':

                $media_manager_value = isset($meta_value) && $meta_value ? $meta_value : '';
                $field_class =  isset($field['class']) ? $field['class'] : '';

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class .' '. esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent rhr-container '.$field['option'].'">';

                    //Left Side Content
                    $this->fields_html .= '<div>';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr_image_select rhr-container ">';
                        $this->fields_html .= '<input type="hidden" class="rhr-saved-val" name="' . esc_attr( $field['id'].$i ) . '" value="' . esc_attr( $media_manager_value ) . '">';
                        $this->fields_html .= '<a href="#" class="select-files" data-title="Insert ' . $field['title'] . '"  data-file-type="' . $field['option'] . '" data-multi-select="' . $field['multi_select'] . '" data-insert="true">' . $field['title'] . '</a>';
                    $this->fields_html .= '</div>';
                
                $this->fields_html .= '</div>';

            break;

            case 'image_select':

                $image_select_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' . esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-image-select-images">';

                            $this->fields_html .= '<ul class="rhr-image-select float-clear">';

                                $fold = '';
                                if (array_key_exists("folds",$field)) $fold="fld-img-sel ";

                                foreach ( $field['options'] as $key => $opt ) {

                                    $this->fields_html .= '<li>';

                                        $this->fields_html .= '<input type="radio" name="'.esc_attr($field['id'].$i).'" data-id="'.esc_attr($field['id'].$i).'" id="'.esc_attr($opt).'" class="'. $fold .'" value="'.esc_attr($key).'" '.checked($image_select_value, $key, false).'>';

                                        $this->fields_html .= '<a href="#"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'assets/img/' . esc_attr( $opt ) . '" alt="" /><i class="icon rhricon-elegant-check"></i></a>';
                                    $this->fields_html .= '</li>';

                                }

                            $this->fields_html .= '</ul>';

                    $this->fields_html .= '</div>';
                
                $this->fields_html .= '</div>';
            break;


            case 'switch':

                $switch_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' . esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' wrapper" data-metaboxid="'.$field['id'].$i.'" >';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-switch rhr-right-side">';

                        foreach ($field['options'] as $key => $opt) {

                            if($switch_value == $key){
                                $switch_class = 'enable selected';
                            }
                            else{
                                $switch_class = 'disable';
                            }
                            $this->fields_html .= '<label class="'.$switch_class.'" data-id="'.$key.'"><span>'. $opt .'</span></label>';
                        }

                        $fold = '';
                        if (array_key_exists("folds",$field)) $fold="fld-switch ";

                        $this->fields_html .= '<input type="hidden" class="'. $fold .'rhr-switch-value ' . esc_attr( $field['id'].$i ) . '_inner" name="' . esc_attr( $field['id'].$i ) . '" data-id="'.esc_attr($field['id'].$i).'" id="' . esc_attr( $field['id'].$r ) . '" value="' .$switch_value . '" >';

                    $this->fields_html .= '</div>';
                
                $this->fields_html .= '</div>';

            break;

            case 'select_sidebar':

                global $wp_registered_sidebars;

                $sidebars = $wp_registered_sidebars;

                $field_class =  isset($field['class']) ? $field['class'] : '';

                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' .esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<div class="select-style">';

                            $this->fields_html .= '<select id="' . esc_attr( $field['id'].$r ) . '" name="' . esc_attr($field['id'].$i ) . '" class="' . esc_attr( $field['id'] ) . '_inner">';

                            $this->fields_html .= '<option value="0" '. (($meta_value == 0) ? ' selected="selected"' : ''). '>' .esc_html__('Default', 'amazee'). '</option>';

                            if ( ! empty ( $sidebars ) ) {
                                foreach ( $sidebars as $key => $opt ) {

                                    if (!in_array($opt['id'], $field['hide_sidebar'])) {
                                        $this->fields_html .= '<option id="'.esc_attr(  $opt['id'] ).'" value="'.esc_attr( $opt['id'] ).'" '. (($meta_value == $opt['id']) ? ' selected="selected"' : ''). '>' .esc_html( $opt['name'] ). '</option>';
                                    }
                                }
                            }                                   

                            $this->fields_html .= '</select> ';

                        $this->fields_html .= '</div>';

                    $this->fields_html .= '</div>';

                $this->fields_html .= '</div>';
            break;

            case 'date_picker':

                $date_picker_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';

                //Container
                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' .esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<input type="text" class="datesFormat ' . esc_attr( $field['id'] ) . '_inner" name="' . esc_attr( $field['id'].$i ) . '" id="' . esc_attr( $field['id'].$r ) . '" value="' . esc_attr( $date_picker_value ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '"/>';


                    $this->fields_html .= '</div>';
                
                $this->fields_html .= '</div>';

            break;
            case 'date_year':

                $date_year_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';

                //Container
                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' .esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<input type="text" class="date_year ' . esc_attr( $field['id'] ) . '_inner" name="' . esc_attr( $field['id'].$i ) . '" id="' . esc_attr( $field['id'].$r ) . '" value="' . esc_attr( $date_year_value ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '"/>';


                    $this->fields_html .= '</div>';
                
                $this->fields_html .= '</div>';

            break;
            case 'date_picker_from_to':

                $date_picker_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';
                
                //Container
                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' .esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<input type="text" class="date_range ' . esc_attr( $field['id'] ) . '_inner" name="' . esc_attr( $field['id'].$i ) . '" id="' . esc_attr( $field['id'].$r ) . '" value="' . esc_attr( $date_picker_value ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '"/>';


                    $this->fields_html .= '</div>';
                
                $this->fields_html .= '</div>';

            break;

            case 'time_picker':

                $time_picker_value = isset($meta_value) && $meta_value ? $meta_value : $field['std'];
                $field_class =  isset($field['class']) ? $field['class'] : '';

                //Container
                $this->fields_html .= '<div id="rhr_' . esc_attr( $field['id'].$r ) . '_field" class="float-clear ' . $field_class . ' ' . esc_attr( $field['id'] ) . '_wrapper '. $fold_class .' parent">';

                    //Left Side Content
                    $this->fields_html .= '<div class="rhr-pull-left">';
                        $this->fields_html .= '<label for="' . esc_attr( $field['id'].$r ) . '" class="rhr-sub-title">' . ucwords($field['title']) . '</label>';

                        //Description or tooltips
                        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
                            $this->fields_html .= '<p class="rhr-tool-tip-icon"><i class="rhricon rhricon-question"></i><span class="desc_tool_tip">' . esc_attr($field['desc_tip']) . '</span></p>';
                        }
                        if (!empty($field['description'])) {
                            $this->fields_html .= '<p class="description">' . esc_html ($field['description']). '</p>';
                        }

                    $this->fields_html .= '</div>';

                    //Right Side Content
                    $this->fields_html .= '<div class="rhr-right-side">';

                        $this->fields_html .= '<input type="text" class="timepicker ' . esc_attr( $field['id'] ) . '_inner" name="' . esc_attr( $field['id'].$i ) . '" id="' . esc_attr( $field['id'].$r ) . '" value="' . esc_attr( $time_picker_value ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '"/>';

                    $this->fields_html .= '</div>';
                
                $this->fields_html .= '</div>';

            break;
        }
    }

    public function save_meta_boxes( $post_id ){

        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        $metabox_id = $this->meta_arr['id'];

        $nonce = isset( $_POST[$metabox_id.'_nonce'])  ? $_POST[$metabox_id.'_nonce'] : '';

        if ( ! wp_verify_nonce( $nonce, __FILE__ ) ||  ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        foreach ( $this->fields as $field ) {

            if( $field['type'] == 'repeatable' ){

                $meta_value = array();                  
                $repeatable_value = array();
                $std = isset( $field['std'] ) ? $field['std'] : '';
                $field_count = count( $_POST[$field['fields'][0]['id']] ) - 1;

                for ( $i = 0; $i < $field_count; $i++ ) {
                    foreach ( $field['fields'] as $fd ) {
                        $std = isset( $field['std'] ) ? $field['std'] : '';

                        $val = $_POST[$fd['id']];
                        $repeatable_value[$i][$fd['id'].'[]'] = ( $val[$i] != $std ) ? $val[$i] : '';
                    }
                }

                $meta_value[$field['id']] = $repeatable_value;

                if( ! empty( $meta_value ) ) {
                    update_post_meta( $post_id, $field['id'], $meta_value );
                }
                else {
                    delete_post_meta( $post_id, $field['id'] );
                }

            }
            elseif( $field['type'] != 'heading' ){

                $meta_value = '';
                $current_val = $_POST[$field['id']];
                $std = isset( $field['std'] ) ? $field['std'] : '';

                // Check array key exsits for certain field types
                if ( $field['type'] == 'switch' || $field['type'] == 'radio' || $field['type'] == 'select'|| $field['type'] == 'image_select' ) {

                    if( $current_val && $current_val != $std && in_array( $current_val, array_keys( $field['options'] ) ) ) {
                    
                        $meta_value = $current_val;

                    }

                }
                else {

                    if( $current_val && $current_val != $std ) {
                    
                        $meta_value = $current_val;
                    }

                }
            
                if( ! empty( $meta_value ) ) {
                    update_post_meta( $post_id, $field['id'], $meta_value );
                }
                else {
                    delete_post_meta( $post_id, $field['id'] );
                }

            }
            

        }
    }
}
