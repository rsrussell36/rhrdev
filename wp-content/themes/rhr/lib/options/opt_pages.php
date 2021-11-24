<?php
Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Page', 'rhr' ),
    'id'               => 'rhr_page_sec',
    'customizer_width' => '400px',
    'icon'             => 'el el-adjust-alt',
));

// color 

Redux::set_section( 'rhr', array(
    'title'            => esc_html__( 'Layout', 'rhr' ),
    'id'               => 'rhr_page_opt',
    'subsection'       => true,
    'icon'             => 'el el-cogs',
    'fields'           => array(
      
        array(
            'id'       => 'rhr_page_setting',
            'type'     => 'image_select',
            'title'    => __('Page Layout', 'rhr'), 
            'subtitle' => __('Select your Page Layout', 'rhr'),
            'options'  => array(
                'full'      => array(
                    'alt'   => '1 Column', 
                    'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                ),
                'left'      => array(
                    'alt'   => '2 Column Left', 
                    'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                ),
                'right'      => array(
                    'alt'   => '2 Column Right', 
                    'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                ),
            ),
            'default' => 'full'
        ),
    )
) );