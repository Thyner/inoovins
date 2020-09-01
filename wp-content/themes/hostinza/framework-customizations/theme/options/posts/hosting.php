<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(
    '_hosting_meta' => array(
        'title'		 => esc_html__( 'Hosting Banner Settings', 'hostinza' ),
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
            'overlay'		 => array(
                'type'		 => 'color-picker',
                'value'		 => '',
                'label'		 => esc_html__( 'Overlay', 'hostinza' ),
                'desc'		 => esc_html__( 'This is optional Overlay', 'hostinza' ),
            ),
        ),
    ),
);