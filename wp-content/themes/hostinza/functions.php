<?php
/**
 * functions.php
 *
 * The theme's functions and definitions.
 */
/**
 * 1.0 - Define constants. Current Version number & Theme Name.
 */
define( 'HOSTINZA_THEME', 'Hostinza WordPress Theme' );
define( 'HOSTINZA_VERSION', '1.4.2' );

define( 'HOSTINZA_THEMEROOT', get_template_directory_uri() );
define( 'HOSTINZA_THEMEROOT_DIR', get_parent_theme_file_path() );
define( 'HOSTINZA_IMAGES', HOSTINZA_THEMEROOT . '/assets/images' );
define( 'HOSTINZA_IMAGES_DIR', HOSTINZA_THEMEROOT_DIR . '/assets/images' );
define( 'HOSTINZA_IMAGES_URI', HOSTINZA_THEMEROOT . '/assets/images' );
define( 'HOSTINZA_CSS', HOSTINZA_THEMEROOT . '/assets/css' );
define( 'HOSTINZA_CSS_DIR', HOSTINZA_THEMEROOT_DIR . '/assets/css' );
define( 'HOSTINZA_SCRIPTS', HOSTINZA_THEMEROOT . '/assets/js' );
define( 'HOSTINZA_SCRIPTS_DIR', HOSTINZA_THEMEROOT_DIR . '/assets/js' );
define( 'HOSTINZA_PHPSCRIPTS', HOSTINZA_THEMEROOT . '/assets/php' );
define( 'HOSTINZA_PHPSCRIPTS_DIR', HOSTINZA_THEMEROOT_DIR . '/assets/php' );
define( 'HOSTINZA_INC', HOSTINZA_THEMEROOT_DIR . '/inc' );
define( 'HOSTINZA_CUSTOMIZER_DIR', HOSTINZA_INC . '/customizer/' );
define( 'HOSTINZA_SHORTCODE_DIR', HOSTINZA_INC . '/shortcode/' );
define( 'HOSTINZA_SHORTCODE_DIR_STYLE', HOSTINZA_INC . '/shortcode/style' );
define( 'HOSTINZA_REMOTE_CONTENT', esc_url( 'https://wp.xpeedstudio.com/demo-content/hostinza' ) );
define( 'HOSTINZA_PLUGINS_DIR', HOSTINZA_INC . '/includes/plugins' );
define( 'HOSTINZA_REMOTE_URL', 'https://wp.xpeedstudio.com/demo-content/hostinza/plugins' );


/**
 * ----------------------------------------------------------------------------------------
 * 3.0 - Set up the content width value based on the theme's design.
 * ----------------------------------------------------------------------------------------
 */
if ( !isset( $content_width ) ) {
	$content_width = 800;
}


/**
 * ----------------------------------------------------------------------------------------
 * 4.0 - Set up theme default and register various supported features.
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'hostinza_setup' ) ) {

	function hostinza_setup() {
		/**
		 * Make the theme available for translation.
		 */
		load_theme_textdomain( 'hostinza', get_template_directory() . '/languages' );
		$locale		 = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		/**
		 * Add support for post formats.
		 */
		add_theme_support( 'post-formats', array( 'standard', 'gallery', 'video', 'audio' )
		);

		/**
		 * Add support for automatic feed links.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add support for post thumbnails.
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 750, 465, array( 'center', 'center' ) ); // Hard crop center center

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		//		Woocommercd theme suypport
		add_theme_support( 'woocommerce' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'hostinza' ),
		)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		* Enable support for wide alignment class for Gutenberg blocks.
		*/
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
	}

	add_action( 'after_setup_theme', 'hostinza_setup' );
}

/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - theme INC.
 * ----------------------------------------------------------------------------------------
 */
include_once get_template_directory() . '/inc/init.php';
include_once get_template_directory() . '/inc/mav-menu-custom-fields.php';

add_filter( 'woocommerce_add_to_cart_fragments', 'hostinza_cart_button_item_count', 30 );

function hostinza_cart_button_item_count( $array_s ) {
	$xs_product_count			 = WC()->cart->cart_contents_count;
	ob_start();
	?>
	<span class="xs-item-count highlight xscart"><?php echo esc_html( $xs_product_count ); ?></span>
	<?php
	$array_s[ 'span.xscart' ]	 = ob_get_clean();
	return $array_s;
}

add_action( 'admin_menu', 'hostinza_remove_theme_settings', 999 );

function hostinza_remove_theme_settings() {
	remove_submenu_page( 'themes.php', 'fw-settings' );
}

$footer_style = hostinza_option( 'footer_style' );

if ( $footer_style == '2' ):
	add_filter( 'hostinza_footer_widget_1_width', 'hostinza_footer_1_width' );

	function hostinza_footer_1_width() {
		return hostinza_option( 'footer_widget_1_grid' );
	}

	add_filter( 'hostinza_footer_widget_2_width', 'hostinza_footer_2_width' );

	function hostinza_footer_2_width() {
		return hostinza_option( 'footer_widget_2_grid' );
	}

	add_filter( 'hostinza_footer_widget_3_width', 'hostinza_footer_3_width' );

	function hostinza_footer_3_width() {
		return hostinza_option( 'footer_widget_3_grid' );
	}

	add_filter( 'hostinza_footer_widget_4_width', 'hostinza_footer_4_width' );

	function hostinza_footer_4_width() {
		return hostinza_option( 'footer_widget_4_grid' );
	}

	add_filter( 'hostinza_footer_widget_5_width', 'hostinza_footer_5_width' );
	

	function hostinza_footer_5_width() {
		return hostinza_option( 'footer_widget_5_grid' );
	}
endif;



function hostinza_body_classes( $classes ) {

    if ( is_active_sidebar( 'sidebar-1' ) || ( class_exists( 'Woocommerce' ) && ! is_woocommerce() ) || class_exists( 'Woocommerce' ) && is_woocommerce() && is_active_sidebar( 'shop-sidebar' ) ) {
        $classes[] = 'sidebar-active';
    }else{
        $classes[] = 'sidebar-inactive';
    }
    return $classes;
}
add_filter( 'body_class','hostinza_body_classes' );


add_action('enqueue_block_editor_assets', 'exhibz_action_enqueue_block_editor_assets' );
function exhibz_action_enqueue_block_editor_assets() {
    wp_enqueue_style( 'hostinza-fonts', hostinza_google_fonts_url(['Karla:300,400,500,600,700,800,900', 'Rubik:300,400,500,700,900']), null, HOSTINZA_VERSION );
    wp_enqueue_style( 'hostinza-gutenberg-editor-font-awesome-styles', HOSTINZA_CSS . '/font-awesome.min.css', null, HOSTINZA_VERSION );
    wp_enqueue_style( 'hostinza-gutenberg-editor-customizer-styles', HOSTINZA_CSS . '/gutenberg-editor-custom.css', null, HOSTINZA_VERSION );
    wp_enqueue_style( 'hostinza-gutenberg-editor-styles', HOSTINZA_CSS . '/gutenberg-custom.css', null, HOSTINZA_VERSION );
   // wp_enqueue_style( 'hostinza-gutenberg-blog-styles', HOSTINZA_CSS . '/blog.css', null, HOSTINZA_VERSION );
}
