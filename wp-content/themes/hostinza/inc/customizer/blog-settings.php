<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_sidebar',
    'label'       => esc_html__( 'Blog Sidebar Position', 'hostinza' ),
    'section'     => 'blog_section',
    'default'     => '3',
    'choices'     => array(
        '1'      => esc_html__('Full Width','hostinza'),
        '2'      => esc_html__('Left Sidebar','hostinza'),
        '3'      => esc_html__('Right Sidebar','hostinza'),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'blog_show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'hostinza' ),
    'section'     => 'blog_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);