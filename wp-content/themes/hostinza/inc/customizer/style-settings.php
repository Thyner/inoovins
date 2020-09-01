<?php

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'primary_color',
    'label'       => esc_html__( 'Primary Color', 'hostinza' ),
    'section'     => 'styling_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '#preloader',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-serach .search-btn',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.pagination li a:hover, .pagination li.active a',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.footer-widget .widget-title::before',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.footer-bottom-info p a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.sidebar .tagcloud a:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.sidebar .widget ul li a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-list.check li::before',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.comment-respond .btn.btn-primary',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-blog-post .entry-meta > span',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-blog-post .post-meta',
            'property'	=> 'border-left-color',
        ),
        array(
            'element' 	=> 'a',
            'property'	=> 'color',
        ),

    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'secondary_color',
    'label'       => esc_html__( 'Secondary Color', 'hostinza' ),
    'section'     => 'styling_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-serach .search-btn:hover',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.comment-respond .btn.btn-primary:hover',
            'property'	=> 'background-color',
        ),
    ),
);
$fields[] = array(
    'type'        => 'typography',
    'settings'    => 'body_font',
    'label'       => esc_html__( 'Body Font', 'hostinza' ),
    'section'     => 'styling_section',
    'default'     => array(
        'font-family'    => '',
        'variant'        => '',
        'font-size'      => '',
        'font-weight'      => '',
        'line-height'    => '',
        'color'          => ''
    ),
    'output'      => array(
        array(
            'element' => 'body',
        ),
    ),
);