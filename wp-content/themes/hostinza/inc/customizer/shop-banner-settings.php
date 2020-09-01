<?php
$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'shop_banner_layout',
    'label'       => esc_html__( 'Banner Layout', 'hostinza' ),
    'section'     => 'shop_banner_section',
    'default'     => '1',
    'choices'     => array(
        '1'   => esc_url(get_template_directory_uri()) . '/assets/images/header-style/1.png',
        '2'   => esc_url(get_template_directory_uri()) . '/assets/images/header-style/2.png',
    ),
); 
$fields[]	 = array(
	'type'		 => 'image',
	'settings'	 => 'shop_banner_img',
	'label'		 => esc_html__( 'Banner Image', 'hostinza' ),
	'section'	 => 'shop_banner_section',
	'default'	 => '',
);
$fields[]	 = array(
	'type'		 => 'text',
	'settings'	 => 'shop_banner_title',
	'label'		 => esc_html__( 'Heading Title', 'hostinza' ),
	'section'	 => 'shop_banner_section',
	'transport'	 => 'auto',
	'js_vars'	 => array(
		array(
			'element'	 => '.xs-banner-content .banner-title',
			'function'	 => 'html'
		),
	),
	'default'	 => '',
);

$fields[]	 = array(
	'type'		 => 'text',
	'settings'	 => 'shop_banner_subtitle',
	'label'		 => esc_html__( 'Heading Sub Title', 'hostinza' ),
	'section'	 => 'shop_banner_section',
	'transport'	 => 'auto',
	'js_vars'	 => array(
		array(
			'element'	 => '.xs-banner-content .banner-sub-title',
			'function'	 => 'html'
		),
	),
	'default'	 => '',
);
$fields[]	 = array(
	'type'			 => 'color',
	'settings'		 => 'shop_gradient1',
	'label'			 => __( 'Background Color gradient 1', 'hostinza' ),
	'description'	 => esc_attr__( 'This is a color control - without alpha channel.', 'hostinza' ),
	'section'		 => 'shop_banner_section',
	'default'		 => '#1045db',
	'required'		 => array(
		array(
			'setting'	 => 'show_page_banner',
			'operator'	 => '==',
			'value'		 => 1,
		)
	),
);
$fields[]	 = array(
	'type'			 => 'color',
	'settings'		 => 'shop_gradient2',
	'label'			 => __( 'Background Color gradient 2', 'hostinza' ),
	'description'	 => esc_attr__( 'This is a color control - without alpha channel.', 'hostinza' ),
	'section'		 => 'shop_banner_section',
	'default'		 => '#15095e',
	'required'		 => array(
		array(
			'setting'	 => 'show_page_banner',
			'operator'	 => '==',
			'value'		 => 1,
		)
	),
);