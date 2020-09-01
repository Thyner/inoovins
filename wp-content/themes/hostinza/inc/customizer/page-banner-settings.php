<?php
$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'page_banner_layout',
    'label'       => esc_html__( 'Banner Layout', 'hostinza' ),
    'section'     => 'page_banner_section',
    'default'     => '1',
    'choices'     => array(
        '1'   => esc_url(get_template_directory_uri()) . '/assets/images/header-style/1.png',
        '2'   => esc_url(get_template_directory_uri()) . '/assets/images/header-style/2.png',
    ),
); 
$fields[]	 = array(
	'type'		 => 'image',
	'settings'	 => 'page_banner_img',
	'label'		 => esc_html__( 'Banner Image', 'hostinza' ),
	'section'	 => 'page_banner_section',
	'default'	 => '',
);
$fields[]	 = array(
	'type'		 => 'text',
	'settings'	 => 'page_banner_title',
	'label'		 => esc_html__( 'Heading Title', 'hostinza' ),
	'section'	 => 'page_banner_section',
	'transport'	 => 'postMessage',
	'js_vars'	 => array(
		array(
			'element'	 => '.hostinza-bolog h2',
			'function'	 => 'html'
		),
	),
	'default'	 => '',
);

$fields[]	 = array(
	'type'		 => 'text',
	'settings'	 => 'page_banner_subtitle',
	'label'		 => esc_html__( 'Heading Sub Title', 'hostinza' ),
	'section'	 => 'page_banner_section',
	'transport'	 => 'postMessage',
	'js_vars'	 => array(
		array(
			'element'	 => '.hostinza-bolog h2',
			'function'	 => 'html'
		),
	),
	'default'	 => '',
);
$fields[]	 = array(
	'type'			 => 'color',
	'settings'		 => 'page_gradient1',
	'label'			 => __( 'Background Color gradient 1', 'hostinza' ),
	'description'	 => esc_attr__( 'This is a color control - without alpha channel.', 'hostinza' ),
	'section'		 => 'page_banner_section',
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
	'settings'		 => 'page_gradient2',
	'label'			 => __( 'Background Color gradient 2', 'hostinza' ),
	'description'	 => esc_attr__( 'This is a color control - without alpha channel.', 'hostinza' ),
	'section'		 => 'page_banner_section',
	'default'		 => '#15095e',
	'required'		 => array(
		array(
			'setting'	 => 'show_page_banner',
			'operator'	 => '==',
			'value'		 => 1,
		)
	),
);