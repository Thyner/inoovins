<?php 

$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'blog_banner_layout',
    'label'       => esc_html__( 'Banner Layout', 'hostinza' ),
    'section'     => 'blog_banner_section',
    'default'     => '1',
    'choices'     => array(
        '1'   => esc_url(get_template_directory_uri()) . '/assets/images/header-style/1.png',
        '2'   => esc_url(get_template_directory_uri()) . '/assets/images/header-style/2.png',
    ),
);
$fields[]= array(
    'type'        => 'switch', 
    'settings'    => 'blog_show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'hostinza' ),
    'section'     => 'blog_banner_section',
    'default'     => false,
    'choices'     => array(
        true  => esc_attr__( 'Enable', 'hostinza' ),
        false => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[] = array(
        'type'        => 'image',
        'settings'    => 'blog_banner_img',
        'label'       => esc_html__( 'Banner Image', 'hostinza' ),
        'section'     => 'blog_banner_section',
        'default'     => '',
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'blog_banner_title',
    'label'       => esc_html__( 'Blog Banner Title', 'hostinza' ),
    'section'     => 'blog_banner_section',
    'transport'   => 'auto',
    'js_vars'     => array(
        array(
            'element'  => '.xs-banner-content h2.banner-title',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'Our Blog', 'hostinza' ),
);


$fields[] = array(
        'type'        => 'image',
        'settings'    => 'single_banner_img',
        'label'       => esc_html__( 'Blog Details Banner Image', 'hostinza' ),
        'section'     => 'blog_banner_section',
        'default'     => '',
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'single_banner_title',
    'label'       => esc_html__( 'Blog Details Banner Title', 'hostinza' ),
    'section'     => 'blog_banner_section',
    'transport'   => 'auto',
    'js_vars'     => array(
        array(
            'element'  => '.hostinza-blog h2',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'Blog Details', 'hostinza' ),
);
$fields[]	 = array(
	'type'			 => 'color',
	'settings'		 => 'blog_gradient1',
	'label'			 => __( 'Background Color gradient 1', 'hostinza' ),
	'description'	 => esc_attr__( 'This is a color control - without alpha channel.', 'hostinza' ),
	'section'		 => 'blog_banner_section',
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
	'settings'		 => 'blog_gradient2',
	'label'			 => __( 'Background Color gradient21', 'hostinza' ),
	'description'	 => esc_attr__( 'This is a color control - without alpha channel.', 'hostinza' ),
	'section'		 => 'blog_banner_section',
	'default'		 => '#15095e',
	'required'		 => array(
		array(
			'setting'	 => 'show_page_banner',
			'operator'	 => '==',
			'value'		 => 1,
		)
	),
);