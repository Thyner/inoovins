<?php

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );



return array(
	/**
	 * Array for demos
	 */
	'plugins'			 => array(
		array(
			'name'		 => esc_html__( 'Unyson', 'hostinza' ),
			'slug'		 => 'unyson',
			'required'	 => true,
		), 
		array(
			'name'		 => esc_html__( 'Elementor', 'hostinza' ),
			'slug'		 => 'hostinza',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Kirki', 'hostinza' ),
			'slug'		 => 'kirki',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'WHMCS Bridge', 'hostinza' ),
			'slug'		 => 'whmcs-bridge',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Hostinza Assistance', 'hostinza' ),
			'slug'		 => 'hostinza-assistance',
			'required'	 => true,
            'version'	 => '1.2',
			'source'	 =>  HOSTINZA_REMOTE_URL . '/hostinza-assistance.zip' ,
		),
        array(
            'name'		 => esc_html__( 'Contact Form 7', 'hostinza' ),
            'slug'		 => 'contact-form-7',
            'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Slider Revolution', 'hostinza' ),
			'slug'		 => 'revslider',
			'required'	 => true,
			'source'	 =>  HOSTINZA_REMOTE_URL . '/revslider.zip' ,
		),
		array(
			'name'		 => esc_html__( 'MailChimp for WordPress', 'hostinza' ),
			'slug'		 => 'mailchimp-for-wp',
			'required'	 => true,
		),
	),
	'theme_id'			 => 'hostinza',
	'child_theme_source' => HOSTINZA_REMOTE_URL . '/hostinza-child.zip',
	'has_demo_content'	 => true
);
