<?php

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );
/**
 * Enqueue all theme scripts and styles
 *
 * ** REGISTERING THEME ASSETS
 * ** ------------------------------------ */
/**
 * Enqueue styles.
 */
if ( !is_admin() ) {
	wp_enqueue_style( 'hostinza-fonts', hostinza_google_fonts_url(), null, HOSTINZA_VERSION );

	wp_enqueue_style( 'bootstrap', HOSTINZA_CSS . '/bootstrap.min.css', null, HOSTINZA_VERSION );
	wp_style_add_data( 'bootstrap', 'rtl', 'replace' );
    	wp_enqueue_style( 'magnific-popup', HOSTINZA_CSS . '/magnific-popup.css', null, HOSTINZA_VERSION );

	if ( !is_page_template( 'template/template-full-width-whmcs.php' ) ):
		wp_enqueue_style( 'hostinza-xs-main', HOSTINZA_CSS . '/xs_main.css', null, HOSTINZA_VERSION );
		wp_enqueue_style( 'hostinza-custom-blog', HOSTINZA_CSS . '/blog-style.css', null, HOSTINZA_VERSION );
	
		wp_enqueue_style( 'animate', HOSTINZA_CSS . '/animate.css', null, HOSTINZA_VERSION );
		wp_enqueue_style( 'owl-carousel', HOSTINZA_CSS . '/owl.carousel.min.css', null, HOSTINZA_VERSION );
		wp_enqueue_style( 'owl-theme-default', HOSTINZA_CSS . '/owl.theme.default.min.css', null, HOSTINZA_VERSION );
		wp_enqueue_style( 'jquery-ui-structure', HOSTINZA_CSS . '/jquery-ui.structure.min.css', null, HOSTINZA_VERSION );
		wp_enqueue_style( 'jquery-ui-theme', HOSTINZA_CSS . '/jquery-ui.theme.min.css', null, HOSTINZA_VERSION );
		wp_enqueue_style( 'hostinza-main-styles', HOSTINZA_CSS . '/domain-checker/style.css', array(), HOSTINZA_VERSION );
	endif;
	wp_enqueue_style( 'iconfont', HOSTINZA_CSS . '/iconfont.css', null, HOSTINZA_VERSION );

	wp_enqueue_style( 'font-awesome', HOSTINZA_CSS . '/font-awesome.min.css', null, HOSTINZA_VERSION );

	wp_enqueue_style( 'hostinza-navigation', HOSTINZA_CSS . '/navigation.min.css', null, HOSTINZA_VERSION );


	wp_enqueue_style( 'hostinza-gutenberg', HOSTINZA_CSS . '/gutenberg.css', null, HOSTINZA_VERSION );
	wp_enqueue_style( 'hostinza-style', HOSTINZA_CSS . '/style.css', null, HOSTINZA_VERSION );
    wp_enqueue_style( 'hostinza-gutenberg-custom', HOSTINZA_CSS . '/gutenberg-custom.css', null, HOSTINZA_VERSION );
	wp_style_add_data( 'hostinza-style', 'rtl', 'replace' );
}
wp_enqueue_style( 'hostinza-responsive', HOSTINZA_CSS . '/responsive.css', null, HOSTINZA_VERSION );



/**
 * Enqueue scripts.
 */
if ( !is_admin() ) {
    
    	wp_enqueue_script( 'magnific-popup', HOSTINZA_SCRIPTS . '/jquery.magnific-popup.min.js', array( 'jquery' ), HOSTINZA_VERSION, true );
    	wp_enqueue_script( 'navigation', HOSTINZA_SCRIPTS . '/navigation.min.js', array( 'jquery' ), HOSTINZA_VERSION, true );
	if ( !is_page_template( 'template/template-full-width-whmcs.php' ) ):
		wp_enqueue_script( 'jquery-ui', HOSTINZA_SCRIPTS . '/jquery-ui.min.js', array( 'jquery' ), HOSTINZA_VERSION, true );
		wp_enqueue_script( 'tweetie', HOSTINZA_SCRIPTS . '/tweetie.js', array( 'jquery' ), HOSTINZA_VERSION, true );
	
		//Bootstrap Main JS
		wp_enqueue_script( 'owl-carousel', HOSTINZA_SCRIPTS . '/owl.carousel.min.js', array( 'jquery' ), HOSTINZA_VERSION, true );
		wp_enqueue_script( 'shuffle-letters', HOSTINZA_SCRIPTS . '/shuffle-letters.js', array( 'jquery' ), HOSTINZA_VERSION, true );
		wp_enqueue_script( 'ajaxchimp', HOSTINZA_SCRIPTS . '/jquery.ajaxchimp.min.js', array( 'jquery' ), HOSTINZA_VERSION, true );
	
	wp_enqueue_script( 'wow', HOSTINZA_SCRIPTS . '/wow.min.js', array( 'jquery' ), HOSTINZA_VERSION, true );
    

	wp_enqueue_script( 'hostinza-hostslide', HOSTINZA_SCRIPTS . '/hostslide.js', array( 'jquery' ), HOSTINZA_VERSION, true );

		wp_enqueue_script( 'popper', HOSTINZA_SCRIPTS . '/Popper.js', array( 'jquery' ), HOSTINZA_VERSION, true );
		
    	wp_enqueue_script( 'hostinza-main', HOSTINZA_SCRIPTS . '/main.js', array( 'jquery' ), HOSTINZA_VERSION, true );
		if ( is_rtl() ) {
			wp_enqueue_script( 'bootstrap-js', HOSTINZA_SCRIPTS . '/bootstrap.min-rtl.js', array( 'jquery' ), HOSTINZA_VERSION, true );
		} else {
			wp_enqueue_script( 'bootstrap-js', HOSTINZA_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), HOSTINZA_VERSION, true );
		}
	else:
	//	wp_enqueue_script( 'bootstrap-3-3-7', HOSTINZA_SCRIPTS . '/bootstrap-3.3.7.min.js', array( 'jquery' ), HOSTINZA_VERSION, true );
//			wp_script_add_data( 'bootstrap', 'rtl', 'replace' );
	wp_enqueue_script( 'hostinza-main', HOSTINZA_SCRIPTS . '/main-whmcs.js', array( 'jquery' ), HOSTINZA_VERSION, true );
	endif;

	/* Ajax Call */
	$params = array(
		'ajaxurl'			 => admin_url( 'admin-ajax.php' ),
		'marketpess_nonce'	 => wp_create_nonce( 'xs_nonce' ),
	);
	wp_localize_script( 'hostinza-setting', 'xs_ajax_obj', $params );

	$translate_array = array(
		'load_more' => esc_html__( 'Load More', 'hostinza' ),
	);
	wp_localize_script( 'hostinza-main', 'translate_array', $translate_array );

	// Load WordPress Comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}