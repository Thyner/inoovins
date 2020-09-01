<?php
$fields[]= array(
    'type'        => 'text',
    'settings'    => '404_title',
    'label'       => esc_html__( '404 Title', 'hostinza' ),
    'section'     => '404_section',

    'default'     =>  '',
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'back_to_home_label',
    'label'       => esc_html__( 'Back to home button label', 'hostinza' ),
    'section'     => '404_section',

    'default'     =>  '',
);

$fields[] = array(
	'type'        => 'image',
	'settings'    => '404_logo',
	'label'       => esc_html__( '404 Logo', 'hostinza' ),
	'section'     => '404_section',
);