<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}


Kirki::add_config( 'hostinza_customizer', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );


function hostinza_customizer_sections($wp_customize){
    $wp_customize->add_panel( 'theme_option', array(
        'priority'    => 10,
        'title'       => esc_attr__( 'Theme Options', 'hostinza' ),
    ) );

	$wp_customize->add_section( 'general_section', array(
		'title'			=> esc_html__( 'General Settings', 'hostinza' ),
		'priority'		=> 1,
		'description'	=> esc_html__( 'to change logo,favicon etc', 'hostinza' ),
        'panel'          => 'theme_option',
	) );

	$wp_customize->add_section( 'nav_section', array(
		'title'			=> esc_html__( 'Navigation Settings', 'hostinza' ),
		'priority'		=> 2,
		'description'	=> esc_html__( 'Setting Your Menu', 'hostinza' ),
        'panel'          => 'theme_option',
	) );

	$wp_customize->add_section( 'page_section', array(
        'title'			=> esc_html__( 'Page Settings', 'hostinza' ),
        'priority'		=> 3,
        'description'	=> esc_html__( 'Setting Your Page', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'page_banner_section', array(
        'title'         => esc_html__( 'Page Banner Settings', 'hostinza' ),
        'priority'      => 4,
        'description'   => esc_html__( 'Setting Your Page Banner', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );
    $wp_customize->add_section( 'blog_section', array(
        'title'         => esc_html__( 'Blog Settings', 'hostinza' ),
        'priority'      => 4,
        'description'   => esc_html__( 'Setting Your Blog', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );
    $wp_customize->add_section( 'blog_banner_section', array(
        'title'         => esc_html__( 'Blog Banner Settings', 'hostinza' ),
        'priority'      => 4,
        'description'   => esc_html__( 'Setting Your Blog Banner', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );
    $wp_customize->add_section( 'blog_single_section', array(
        'title'         => esc_html__( 'Single Blog Settings', 'hostinza' ),
        'priority'      => 5,
        'description'   => esc_html__( 'Setting Your Singel Blog', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );
    $wp_customize->add_section( 'shop_banner_section', array(
        'title'         => esc_html__( 'Shop Banner Settings', 'hostinza' ),
        'priority'      => 4,
        'description'   => esc_html__( 'Setting Your Shop Banner', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );
    $wp_customize->add_section( 'footer_section', array(
        'title'			=> esc_html__( 'Footer Settings', 'hostinza' ),
        'priority'		=> 6,
        'description'	=> esc_html__( 'Setting Your Footer', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );
    $wp_customize->add_section( '404_section', array(
        'title'			=> esc_html__( '404 Settings', 'hostinza' ),
        'priority'		=>7,
        'description'	=> esc_html__( 'Setting Your 404 Page', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );

    $wp_customize->add_section( 'styling_section', array(
        'title'			=> esc_html__( 'Styling Settings', 'hostinza' ),
        'priority'		=> 8,
        'description'	=> esc_html__( 'Setting Your font', 'hostinza' ),
        'panel'          => 'theme_option',
    ) );
}

add_action( 'customize_register', 'hostinza_customizer_sections' );

require HOSTINZA_CUSTOMIZER_DIR . 'customizer-fields.php' ;