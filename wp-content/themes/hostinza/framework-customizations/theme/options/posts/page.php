<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

include_once get_template_directory() . '/inc/includes/demo-page-meta.php';
$options = array(
    '_page_meta' => array(
        'title'		 => esc_html__( 'Page Settings', 'hostinza' ),
        'type'		 => 'box',
        'priority'	 => 'high',
        'options'	 => array(

            'header_title'	 => array( 
                'type'	 => 'text', 
                'label'	 => esc_html__( 'Banner title', 'hostinza' ),
                'desc'	 => esc_html__( 'Add your Page hero title', 'hostinza' ),
            ),
            'header_sub_title'	 => array(
                'type'	 => 'text',
                'label'	 => esc_html__( 'Banner subtitle', 'hostinza' ),
                'desc'	 => esc_html__( 'Add your Page hero subtitle', 'hostinza' ),
            ),
            'header_image'	 => array(
                'label'	 => esc_html__( ' Banner Image', 'hostinza' ),
                'desc'	 => esc_html__( 'Upload a Page header image', 'hostinza' ),
                'help'	 => esc_html__( "This default header image.", 'hostinza' ),
                'type'	 => 'upload'
            ),
            'header_icons'	 => array(
                'type' => 'addable-popup',
                'label' => esc_html__('Banner Bouncing Icons', 'hostinza'),
                'template' => 'Banner icon',
                'popup-title' => esc_html__('Banner icon', 'hostinza'),
                'size' => 'small',
                'limit' => 0,
                'add-button-text' => esc_html__('Add icon', 'hostinza'),
                'sortable' => true,
                'popup-options' => array(
                    'header_ico' => array(
                        'label'	 => esc_html__( ' Banner Icon', 'hostinza' ),
                        'desc'	 => esc_html__( 'Upload a image icon', 'hostinza' ),
                        'type'	 => 'upload'
                    ),
                ),
            ),
            'overlay'		 => array(
                'type'		 => 'color-picker',
                'value'		 => '',
                'label'		 => esc_html__( 'Overlay', 'hostinza' ),
                'desc'		 => esc_html__( 'This is optional Overlay', 'hostinza' ),
            ),
        ), 
    ),
);
$options['_page_meta']['options'] = array_merge($options['_page_meta']['options'], get_meta_page_feild(false));