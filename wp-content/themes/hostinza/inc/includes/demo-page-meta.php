<?php
function get_meta_page_feild($feild){
  if($feild){
    return array(
        'navigation_style'    => array(
            'label'      => esc_html__( 'Menu Style', 'hostinza' ),
            'type'       => 'image-picker',
            'value'      => '',
            'desc'       => esc_html__( 'Select Menu style.', 'hostinza' ),
            'choices'    => array(
                '1' => array(
                    'small'  => array(
                        'height' => 30,
                        'src'    =>  get_template_directory_uri() . '/assets/images/header-style/header-1.png',
                    ),
                ),
                '2' => array(
                    'small'  => array(
                        'height' => 30,
                        'src'    =>  get_template_directory_uri() . '/assets/images/header-style/header-2.png',
                    ),
                ),
            ),
        ),
        'custom_logo'	 => array(
            'label'	 => esc_html__( ' Custom Logo', 'hostinza' ),
            'desc'	 => esc_html__( 'Upload logo only for this page', 'hostinza' ),
            'type'	 => 'upload'
        ),
      );
  }else{
      return array();
  }
}