<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'page_sidebar',
    'label'       => esc_html__( 'Page Sidebar Position', 'hostinza' ),
    'section'     => 'page_section',
    'default'     => '1',
    'choices'     => array(
      '1'      => esc_html__('Full Width','hostinza'),
      '2'      => esc_html__('Left Sidebar','hostinza'),
      '3'      => esc_html__('Right Sidebar','hostinza'),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'hostinza' ),
    'section'     => 'page_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'breadcrumb_length',
    'label'       => esc_html__( 'Breadcrumb Length', 'hostinza' ),
    'section'     => 'page_section',
    'transport'   => 'postMessage',
    'default'     => '',
);