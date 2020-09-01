<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_single_sidebar',
    'label'       => esc_html__( 'Blog Sidebar Position', 'hostinza' ),
    'section'     => 'blog_single_section',
    'default'     => '3',
    'choices'     => array(
      '1'      => esc_html__('Full Width','hostinza'),
      '2'      => esc_html__('Left Sidebar','hostinza'),
      '3'      => esc_html__('Right Sidebar','hostinza'),
    ),
);
$fields[]= array(
  'type'        => 'switch',
  'settings'    => 'show_author',
  'label'       => esc_html__( 'Show Author', 'hostinza' ),
  'section'     => 'blog_single_section',
  'default'     => '',
  'choices'     => array(
      'on'  => esc_attr__( 'Enable', 'hostinza' ),
      'off' => esc_attr__( 'Disable', 'hostinza' ),
  ),
);

$fields[]= array(
  'type'        => 'switch',
  'settings'    => 'show_social',
  'label'       => esc_html__( 'Show Social', 'hostinza' ),
  'section'     => 'blog_single_section',
  'default'     => '',
  'choices'     => array(
      'on'  => esc_attr__( 'Enable', 'hostinza' ),
      'off' => esc_attr__( 'Disable', 'hostinza' ),
  ),
);