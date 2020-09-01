<?php
$fields[] = array(
	'type'        => 'image',
	'settings'    => 'site_logo',
	'label'       => esc_html__( 'Logo', 'hostinza' ),
	'section'     => 'general_section',
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_preloader',
    'label'       => esc_html__( 'Show Preloader', 'hostinza' ),
    'section'     => 'general_section',
    'default'     => '',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);


$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_attr__( 'Social Control', 'hostinza' ),
    'section'     => 'general_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Social Profile', 'hostinza' ),
    ),
    'settings'    => 'social_links',
    'default'     => array(
        array(
            'social_text' => esc_attr__( 'Facebook', 'hostinza' ),
            'social_url'  => esc_url('https://www.facebook.com/xpeedstudio/'),
        ),
    ),

    'fields' => array(
        'social_text' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social Text', 'hostinza' ),
            'description' => esc_attr__( 'This will be the label for your social link', 'hostinza' ),
            'default'     => '',
        ),
        'social_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social URL', 'hostinza' ),
            'description' => esc_attr__( 'This will be the social URL', 'hostinza' ),
            'default'     => '#',
        ),
        'social_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social Icon', 'hostinza' ),
            'description' => esc_attr__( 'This will be the social Icon CSS Class', 'hostinza' ),
            'default'     => 'fa fa-facebook',
        ),
    )
);