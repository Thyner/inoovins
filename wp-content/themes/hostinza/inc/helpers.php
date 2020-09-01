<?php
if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );
/**
 * Helper functions used all over the theme
 */
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package xs
 */
/*
  Return
 *
 *  */






// simply echos the variable
if ( !function_exists( 'hostinza_return' ) ) {

	function hostinza_return( $s ) {
		return $s;
	}

}
/*
 * FOR ONE PAGE Section
 * since 1.0
 */

if ( !function_exists( 'hostinza_editor_data' ) ) {

	function hostinza_editor_data( $value ) {
		return wp_kses_post( $value );
	}

}
// Gets unyson option data in safe mode
// since 1.0
if ( !function_exists( 'hostinza_get_option' ) ) {

	function hostinza_get_option( $k, $v = '', $m = 'theme-settings' ) {
		if ( defined( 'FW' ) ) {
			switch ( $m ) {
				case 'theme-settings':
					$v = fw_get_db_settings_option( $k );
					break;

				default:
					$v = '';
					break;
			}
		}
		return $v;
	}

}
if ( !function_exists( 'hostinza_resize' ) ) {

	function hostinza_resize( $url, $width = false, $height = false, $crop = false ) {
		if ( function_exists( 'fw_resize' ) ) {
			$fw_resize	 = FW_Resize::getInstance();
			$response	 = $fw_resize->process( $url, $width, $height, $crop );
			return (!is_wp_error( $response ) && !empty( $response[ 'src' ] ) ) ? $response[ 'src' ] : $url;
		} else {
			$response = wp_get_attachment_image_src( $url, array( $width, $height ) );
			if ( !empty( $response ) ) {
				return $response[ 0 ];
			}
		}
	}

}
// Gets unyson image url from option data in a much simple way
// sience 1.0
if ( !function_exists( 'hostinza_get_image' ) ) {

	function hostinza_get_image( $k, $v = '', $d = false ) {

		if ( $d == true ) {
			$attachment = $k;
		} else {
			$attachment = hostinza_get_option( $k );
		}

		if ( isset( $attachment[ 'url' ] ) && !empty( $attachment ) ) {
			$v = $attachment[ 'url' ];
		}

		return $v;
	}

}
/* Gets unyson image url from variable
 * sience 1.0
 * hostinza_image($img, $alt )
 */

if ( !function_exists( 'hostinza_image' ) ) {

	function hostinza_image( $img, $alt, $v = '' ) {

		if ( isset( $img[ 'url' ] ) && !empty( $img ) ) {
			$i	 = $img[ 'url' ];
			$v	 = "<img src=" . $i . " alt=" . $alt . " />";
		}

		return $v;
	}

}
// Gets original page ID/ Slug
// since 1.0
if ( !function_exists( 'hostinza_main' ) ) {

	function hostinza_main( $id, $name = true ) {
		if ( function_exists( 'icl_object_id' ) ) {
			$id = icl_object_id( $id, 'page', true, 'en' );
		}

		if ( $name === true ) {
			$post = get_post( $id );
			return $post->post_name;
		} else {
			return $id;
		}
	}

}
if ( !function_exists( 'hostinza_page_list' ) ) {

	function hostinza_page_list() {
		$xs_pagess	 = array();
		$xs_pages	 = get_pages();
		if ( is_array( $xs_pages ) ) {
			foreach ( $xs_pages as $xs_page ) {
				$xs_pagess[ $xs_page->ID ] = $xs_page->post_title;
			}
		}
		return $xs_pagess;
	}

}
// Gets post's meta data in a much simplier way.
// since 1.0

if ( !function_exists( 'hostinza_get_post_meta' ) ) {

	function hostinza_get_post_meta( $id, $needle ) {
		$data = get_post_meta( $id, 'fw_options' );
		if ( is_array( $data ) && isset( $data[ 0 ][ 'page_sections' ] ) ) {
			$data = $data[ 0 ][ 'page_sections' ];

			if ( is_array( $data ) ) {
				return hostinza_seekKey( $data, $needle );
			}
		}
	}

}

/*
 * btn Function
 * since 1.0
 */
//btn function

if ( !function_exists( 'hostinza_theme_button_class' ) ) :

	function hostinza_theme_button_class( $style ) {
		/**
		 * Display specific class for buttons - depends on theme
		 */
		if ( $style == 'default' ) {
			echo 'btn btn-border';
		} elseif ( $style == 'primary' ) {
			echo 'btn btn-primary';
		} else {
			echo 'default';
		}
	}

endif;





/*
 * This fucntion for recent post shortcode.
 * people can select show from one category or from all category
 * since 1.0
 */

// term
if ( !function_exists( 'hostinza_get_category_term_list' ) ) :

	function hostinza_get_category_term_list() {
		/**
		 * Return array of categories
		 */
		$taxonomy	 = 'category';
		$args		 = array(
			'hide_empty' => true,
		);

		$terms		 = get_terms( $taxonomy, $args );
		$result		 = array();
		$result[ 0 ] = esc_html__( 'All Categories', 'hostinza' );

		if ( !empty( $terms ) )
			foreach ( $terms as $term ) {
				$result[ $term->term_id ] = $term->name;
			}
		return $result;
	}

endif;



/*
 * Function for color RGB
 */
if ( !function_exists( 'hostinza_color_rgb' ) ) {

	function hostinza_color_rgb( $hex ) {
		$hex		 = preg_replace( "/^#(.*)$/", "$1", $hex );
		$rgb		 = array();
		$rgb[ 'r' ]	 = hexdec( substr( $hex, 0, 2 ) );
		$rgb[ 'g' ]	 = hexdec( substr( $hex, 2, 2 ) );
		$rgb[ 'b' ]	 = hexdec( substr( $hex, 4, 2 ) );

		$color_hex = $rgb[ "r" ] . ", " . $rgb[ "g" ] . ", " . $rgb[ "b" ];

		return $color_hex;
	}

}



// breadcrumbs

if ( !function_exists( 'hostinza_get_breadcrumbs' ) ) {

	function hostinza_get_breadcrumbs( $seperator = '', $word = '' ) {
		if ( defined( 'FW' ) ) {
			$word = hostinza_option( 'breadcrumb_length' );
		}
		echo '<ul class="breadcrumbs list-inline wow fadeInLeft" data-wow-duration="2s">';
		if ( !is_home() ) {
			echo '<li><a href="';
			echo esc_url( get_home_url( '/' ) );
			echo '">';
			echo esc_html__( 'Home', 'hostinza' );
			echo "</a></li> " . esc_attr( $seperator );
			if ( is_category() || is_single() ) {
				echo '<li>';
				$category	 = get_the_category();
				$post		 = get_queried_object();
				$postType	 = get_post_type_object( get_post_type( $post ) );
				if ( !empty( $category ) ) {
					echo esc_html( $category[ 0 ]->cat_name ) . '</li>';
					//echo esc_attr( $seperator );
				} else if ( $postType ) {
					echo esc_html( $postType->labels->singular_name ) . '</li>';
					//echo esc_attr( $seperator );
				}

				if ( is_single() ) {
					echo esc_attr( $seperator ) . "  <li>";
					echo esc_html( $word ) != '' ? wp_trim_words( get_the_title(), $word ) : get_the_title();
					echo '</li>';
				}
			} elseif ( is_page() ) {
				echo '<li>';
				echo esc_html( $word ) != '' ? wp_trim_words( get_the_title(), $word ) : get_the_title();
				echo '</li>';
			}
		}
		if ( is_tag() ) {
			single_tag_title();
		} elseif ( is_day() ) {
			echo"<li>" . esc_html__( 'Blogs for', 'hostinza' ) . " ";
			the_time( 'F jS, Y' );
			echo'</li>';
		} elseif ( is_month() ) {
			echo"<li>" . esc_html__( 'Blogs for', 'hostinza' ) . " ";
			the_time( 'F, Y' );
			echo'</li>';
		} elseif ( is_year() ) {
			echo"<li>" . esc_html__( 'Blogs for', 'hostinza' ) . " ";
			the_time( 'Y' );
			echo'</li>';
		} elseif ( is_author() ) {
			echo"<li>" . esc_html__( 'Author Blogs', 'hostinza' );
			echo'</li>';
		} elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) {
			echo "<li>" . esc_html__( 'Blogs', 'hostinza' );
			echo'</li>';
		} elseif ( is_search() ) {
			echo"<li>" . esc_html__( 'Search Result', 'hostinza' );
			echo'</li>';
		} elseif ( is_404() ) {
			echo"<li>" . esc_html__( '404 Not Found', 'hostinza' );
			echo'</li>';
		}
		echo '</ul>';
	}

}


/*
 * WP Kses Allowed HTML Tags Array in function
 * @Since Version 0.1
 * @param ar
 * Use: hostinza_kses($raw_string);
 * */
if ( !function_exists( 'hostinza_kses' ) ) {

	function hostinza_kses( $raw ) {

		$allowed_tags = array(
			'a'								 => array(
				'class'	 => array(),
				'href'	 => array(),
				'rel'	 => array(),
				'title'	 => array(),
			),
			'abbr'							 => array(
				'title' => array(),
			),
			'b'								 => array(),
			'blockquote'					 => array(
				'cite' => array(),
			),
			'cite'							 => array(
				'title' => array(),
			),
			'code'							 => array(),
			'del'							 => array(
				'datetime'	 => array(),
				'title'		 => array(),
			),
			'dd'							 => array(),
			'div'							 => array(
				'class'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'dl'							 => array(),
			'dt'							 => array(),
			'em'							 => array(),
			'h1'							 => array(),
			'h2'							 => array(),
			'h3'							 => array(),
			'h4'							 => array(),
			'h5'							 => array(),
			'h6'							 => array(),
			'i'								 => array(
				'class' => array(),
			),
			'img'							 => array(
				'alt'	 => array(),
				'class'	 => array(),
				'height' => array(),
				'src'	 => array(),
				'width'	 => array(),
			),
			'li'							 => array(
				'class' => array(),
			),
			'ol'							 => array(
				'class' => array(),
			),
			'p'								 => array(
				'class' => array(),
			),
			'q'								 => array(
				'cite'	 => array(),
				'title'	 => array(),
			),
			'span'							 => array(
				'class'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'iframe'						 => array(
				'width'			 => array(),
				'height'		 => array(),
				'scrolling'		 => array(),
				'frameborder'	 => array(),
				'allow'			 => array(),
				'src'			 => array(),
			),
			'strike'						 => array(),
			'br'							 => array(),
			'strong'						 => array(),
			'data-wow-duration'				 => array(),
			'data-wow-delay'				 => array(),
			'data-wallpaper-options'		 => array(),
			'data-stellar-background-ratio'	 => array(),
			'ul'							 => array(
				'class' => array(),
			),
		);

		if ( function_exists( 'wp_kses' ) ) { // WP is here
			$allowed = wp_kses( $raw, $allowed_tags );
		} else {
			$allowed = $raw;
		}


		return $allowed;
	}

}
/*
 * WP Kses Allowed HTML Tags Array in function
 * @Since Version 0.1
 * @param ar
 * Use: hostinza_currency_symbols();
 * */
if ( !function_exists( 'hostinza_currency_symbols' ) ) {

	function hostinza_currency_symbols() {

		$currency_symbols = array(
			'AED'	 => '&#1583;.&#1573;', // ?
			'AFN'	 => '&#65;&#102;',
			'ALL'	 => '&#76;&#101;&#107;',
			'AMD'	 => '',
			'ANG'	 => '&#402;',
			'AOA'	 => '&#75;&#122;', // ?
			'ARS'	 => '&#36;',
			'AUD'	 => '&#36;',
			'AWG'	 => '&#402;',
			'AZN'	 => '&#1084;&#1072;&#1085;',
			'BAM'	 => '&#75;&#77;',
			'BBD'	 => '&#36;',
			'BDT'	 => '&#2547;', // ?
			'BGN'	 => '&#1083;&#1074;',
			'BHD'	 => '.&#1583;.&#1576;', // ?
			'BIF'	 => '&#70;&#66;&#117;', // ?
			'BMD'	 => '&#36;',
			'BND'	 => '&#36;',
			'BOB'	 => '&#36;&#98;',
			'BRL'	 => '&#82;&#36;',
			'BSD'	 => '&#36;',
			'BTN'	 => '&#78;&#117;&#46;', // ?
			'BWP'	 => '&#80;',
			'BYR'	 => '&#112;&#46;',
			'BZD'	 => '&#66;&#90;&#36;',
			'CAD'	 => '&#36;',
			'CDF'	 => '&#70;&#67;',
			'CHF'	 => '&#67;&#72;&#70;',
			'CLF'	 => '', // ?
			'CLP'	 => '&#36;',
			'CNY'	 => '&#165;',
			'COP'	 => '&#36;',
			'CRC'	 => '&#8353;',
			'CUP'	 => '&#8396;',
			'CVE'	 => '&#36;', // ?
			'CZK'	 => '&#75;&#269;',
			'DJF'	 => '&#70;&#100;&#106;', // ?
			'DKK'	 => '&#107;&#114;',
			'DOP'	 => '&#82;&#68;&#36;',
			'DZD'	 => '&#1583;&#1580;', // ?
			'EGP'	 => '&#163;',
			'ETB'	 => '&#66;&#114;',
			'EUR'	 => '&#8364;',
			'FJD'	 => '&#36;',
			'FKP'	 => '&#163;',
			'GBP'	 => '&pound;',
			'GEL'	 => '&#4314;', // ?
			'GHS'	 => '&#162;',
			'GIP'	 => '&#163;',
			'GMD'	 => '&#68;', // ?
			'GNF'	 => '&#70;&#71;', // ?
			'GTQ'	 => '&#81;',
			'GYD'	 => '&#36;',
			'HKD'	 => '&#36;',
			'HNL'	 => '&#76;',
			'HRK'	 => '&#107;&#110;',
			'HTG'	 => '&#71;', // ?
			'HUF'	 => '&#70;&#116;',
			'IDR'	 => '&#82;&#112;',
			'ILS'	 => '&#8362;',
			'INR'	 => '&#8377;',
			'IQD'	 => '&#1593;.&#1583;', // ?
			'IRR'	 => '&#65020;',
			'ISK'	 => '&#107;&#114;',
			'JEP'	 => '&#163;',
			'JMD'	 => '&#74;&#36;',
			'JOD'	 => '&#74;&#68;', // ?
			'JPY'	 => '&#165;',
			'KES'	 => '&#75;&#83;&#104;', // ?
			'KGS'	 => '&#1083;&#1074;',
			'KHR'	 => '&#6107;',
			'KMF'	 => '&#67;&#70;', // ?
			'KPW'	 => '&#8361;',
			'KRW'	 => '&#8361;',
			'KWD'	 => '&#1583;.&#1603;', // ?
			'KYD'	 => '&#36;',
			'KZT'	 => '&#1083;&#1074;',
			'LAK'	 => '&#8365;',
			'LBP'	 => '&#163;',
			'LKR'	 => '&#8360;',
			'LRD'	 => '&#36;',
			'LSL'	 => '&#76;', // ?
			'LTL'	 => '&#76;&#116;',
			'LVL'	 => '&#76;&#115;',
			'LYD'	 => '&#1604;.&#1583;', // ?
			'MAD'	 => '&#1583;.&#1605;.', //?
			'MDL'	 => '&#76;',
			'MGA'	 => '&#65;&#114;', // ?
			'MKD'	 => '&#1076;&#1077;&#1085;',
			'MMK'	 => '&#75;',
			'MNT'	 => '&#8366;',
			'MOP'	 => '&#77;&#79;&#80;&#36;', // ?
			'MRO'	 => '&#85;&#77;', // ?
			'MUR'	 => '&#8360;', // ?
			'MVR'	 => '.&#1923;', // ?
			'MWK'	 => '&#77;&#75;',
			'MXN'	 => '&#36;',
			'MYR'	 => '&#82;&#77;',
			'MZN'	 => '&#77;&#84;',
			'NAD'	 => '&#36;',
			'NGN'	 => '&#8358;',
			'NIO'	 => '&#67;&#36;',
			'NOK'	 => '&#107;&#114;',
			'NPR'	 => '&#8360;',
			'NZD'	 => '&#36;',
			'OMR'	 => '&#65020;',
			'PAB'	 => '&#66;&#47;&#46;',
			'PEN'	 => '&#83;&#47;&#46;',
			'PGK'	 => '&#75;', // ?
			'PHP'	 => '&#8369;',
			'PKR'	 => '&#8360;',
			'PLN'	 => '&#122;&#322;',
			'PYG'	 => '&#71;&#115;',
			'QAR'	 => '&#65020;',
			'RON'	 => '&#108;&#101;&#105;',
			'RSD'	 => '&#1044;&#1080;&#1085;&#46;',
			'RUB'	 => '&#1088;&#1091;&#1073;',
			'RWF'	 => '&#1585;.&#1587;',
			'SAR'	 => '&#65020;',
			'SBD'	 => '&#36;',
			'SCR'	 => '&#8360;',
			'SDG'	 => '&#163;', // ?
			'SEK'	 => '&#107;&#114;',
			'SGD'	 => '&#36;',
			'SHP'	 => '&#163;',
			'SLL'	 => '&#76;&#101;', // ?
			'SOS'	 => '&#83;',
			'SRD'	 => '&#36;',
			'STD'	 => '&#68;&#98;', // ?
			'SVC'	 => '&#36;',
			'SYP'	 => '&#163;',
			'SZL'	 => '&#76;', // ?
			'THB'	 => '&#3647;',
			'TJS'	 => '&#84;&#74;&#83;', // ? TJS (guess)
			'TMT'	 => '&#109;',
			'TND'	 => '&#1583;.&#1578;',
			'TOP'	 => '&#84;&#36;',
			'TRY'	 => '&#x20BA;',
			'TTD'	 => '&#36;',
			'TWD'	 => '&#78;&#84;&#36;',
			'TZS'	 => '',
			'UAH'	 => '&#8372;',
			'UGX'	 => '&#85;&#83;&#104;',
			'USD'	 => '$',
			'UYU'	 => '&#36;&#85;',
			'UZS'	 => '&#1083;&#1074;',
			'VEF'	 => '&#66;&#115;',
			'VND'	 => '&#8363;',
			'VUV'	 => '&#86;&#84;',
			'WST'	 => '&#87;&#83;&#36;',
			'XAF'	 => '&#70;&#67;&#70;&#65;',
			'XCD'	 => '&#36;',
			'XDR'	 => '',
			'XOF'	 => '',
			'XPF'	 => '&#70;',
			'YER'	 => '&#65020;',
			'ZAR'	 => '&#82;',
			'ZMK'	 => '&#90;&#75;', // ?
			'ZWL'	 => '&#90;&#36;',
		);

		return $currency_symbols;
	}

}

/**
 *
 * Load Goggle Font
 * @since 1.0.0
 *
 */
if ( !function_exists( 'hostinza_google_fonts_url' ) ) {

	function hostinza_google_fonts_url() {
		$fonts_url		 = '';
		$font_families	 = array();
		//Body Font
		$body_font		 = hostinza_option( 'body_font' );
		if ( !empty( $body_font ) ) {
			$body_families	 = isset( $body_font[ 'font-family' ] ) ? $body_font[ 'font-family' ] : '';
			$body_variant	 = isset( $body_font[ 'variant' ] ) ? $body_font[ 'variant' ] : '';
			$font_families[] = $body_families . ":" . $body_variant;
		}
		//Heading font
		if ( !empty( $head_font ) ) {
			$head_font		 = hostinza_option( 'heading_font' );
			$head_families	 = isset( $head_font[ 'font-family' ] ) ? $head_font[ 'font-family' ] : '';
			$head_variant	 = isset( $head_font[ 'variant' ] ) ? $head_font[ 'variant' ] : '';
			$font_families[] = $head_families . ":" . $head_variant;
		}

		$font_families[] = 'Karla:400,700|Rubik:300,400,500,700';

		if ( $font_families ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) )
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}
		return esc_url_raw( $fonts_url );
	}

}
/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */
if ( !function_exists( 'hostinza_category_list_slug' ) ) {

	function hostinza_category_list_slug( $cat ) {
		$query_args = array(
			'orderby'	 => 'ID',
			'order'		 => 'DESC',
			'hide_empty' => 1,
			'taxonomy'	 => $cat
		);

		$categories	 = get_categories( $query_args );
		$options	 = array( esc_html__( '0', 'hostinza' ) => 'All Category' );
		if ( is_array( $categories ) && count( $categories ) > 0 ) {
			return $categories;
		}
	}

}
/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */
if ( !function_exists( 'hostinza_featured_product' ) ) {

	function hostinza_featured_product() {
		$query_args	 = array(
			'post_type'		 => 'product',
			'tax_query'		 => array(
				'relation' => 'AND',
				array(
					'taxonomy'	 => 'product_type',
					'field'		 => 'slug',
					'terms'		 => 'wp_fundraising',
				),
				array(
					'taxonomy'	 => 'product_visibility',
					'field'		 => 'name',
					'terms'		 => 'featured',
				),
			),
			'posts_per_page' => -1,
		);
		$xs_query	 = new WP_Query( $query_args );
		$options	 = array( esc_html__( '0', 'hostinza' ) => 'Select Product' );
		if ( $xs_query->have_posts() ):
			while ( $xs_query->have_posts() ) {
				$xs_query->the_post();
				$options[ get_the_ID() ] = get_the_title();
			}
			wp_reset_postdata();
			return $options;
		endif;
	}

}
if ( !function_exists( 'hostinza_option' ) ) {

	function hostinza_option( $option ) {
		// Get options
		return get_theme_mod( $option, hostinza_defaults( $option ) );
	}

}
if ( !function_exists( 'hostinza_defaults' ) ) {

	function hostinza_defaults( $options ) {

		$default = array(
			'header_layout'			 => 1,
			'show_top_header'		 => false,
			'show_top_nav'			 => true,
			'show_breadcrumb'		 => 1,
			'blog_show_breadcrumb'	 => true,
			'page_show_breadcrumb'	 => true,
			'nav_search'			 => false,
			'nav_sidebar'			 => false,
			'footer_style'			 => 1,
			'footer_widget_layout'	 => 3,
			'show_terms'			 => false,
			'show_footer_widget'	 => false,
			'blog_single_sidebar'	 => 3,
			'blog_sidebar'			 => 3,
			'page_banner_layout'			 => 1,
			'blog_banner_layout'			 => 1,
			'shop_banner_layout'			 => 1,
			'hostinza_footer_widget_1_width'			 => 3,
			'hostinza_footer_widget_2_width'			 => 2,
			'hostinza_footer_widget_3_width'			 => 2,
			'hostinza_footer_widget_4_width'			 => 2,
			'hostinza_footer_widget_5_width'			 => 3,
			'show_preloader'			 => 'on',
			'blog_banner_title'		 => esc_html__( 'Our Blog', 'hostinza' ),
			'single_banner_title'	 => esc_html__( 'blog posts', 'hostinza' ),
		);

		if ( !empty( $default[ $options ] ) )
			return $default[ $options ];
	}

}
/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */
if ( !function_exists( 'hostinza_category_list' ) ) {

	function hostinza_category_list( $cat ) {
		$query_args = array(
			'orderby'	 => 'ID',
			'order'		 => 'DESC',
			'hide_empty' => 1,
			'taxonomy'	 => $cat
		);

		$categories	 = get_categories( $query_args );
		$options	 = array( esc_html__( '0', 'hostinza' ) => 'All Category' );
		if ( is_array( $categories ) && count( $categories ) > 0 ) {
			foreach ( $categories as $cat ) {
				$options[ $cat->term_id ] = $cat->name;
			}
			return $options;
		}
	}

}
if ( !function_exists( 'hostinza_get_posts' ) ) {

	function hostinza_get_posts( $post_type ) {
		$mega_menus	 = array();
		$args		 = array(
			'post_type' => $post_type,
		);
		$posts		 = get_posts( $args );
		foreach ( $posts as $post ) {
			$mega_menus[ $post->post_name ] = $post->post_title;
		}
		return $mega_menus;
	}

}
if ( !function_exists( 'hostinza_get_mega_item_child_slug' ) ) {

	function hostinza_get_mega_item_child_slug( $location, $option_id ) {

		$mega_item	 = '';
		$locations	 = get_nav_menu_locations();
		$menu		 = wp_get_nav_menu_object( $locations[ $location ] );
		$menuitems	 = wp_get_nav_menu_items( $menu->term_id );

		foreach ( $menuitems as $menuitem ) {

			$id			 = $menuitem->ID;
			$mega_item	 = fw_ext_mega_menu_get_db_item_option( $id, $option_id );
		}
		return $mega_item;
	}

}
if ( !function_exists( 'hostinza_get_post_content' ) ) {

	function hostinza_get_post_content( $ID ) {
		
		$args = array(
			'ID'			 => $ID,
			'post_type'		 => 'mega_menu',
			'post_status'	 => 'publish',
			'posts_per_page'	 => 1
		);
		$the_query	 = new WP_Query( $args );
		$output		 = '';
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
		
				ob_start();
				the_content();
				$output = ob_get_clean();
				
				return $output;


			endwhile;
		endif;
		wp_reset_postdata();

		
	}

}
if ( !function_exists( 'hostinza_wc_get_product_list' ) ) {

	function hostinza_wc_get_product_list() {
		$query_args	 = array(
			'post_type'		 => 'product',
			'posts_per_page' => -1,
		);
		$xs_query	 = new WP_Query( $query_args );
		$options	 = array( esc_html__( '0', 'hostinza' ) => 'Select Product' );
		if ( $xs_query->have_posts() ):
			while ( $xs_query->have_posts() ) {
				$xs_query->the_post();
				$options[ get_the_ID() ] = get_the_title();
			}
			wp_reset_postdata();
			return $options;
		endif;
	}

}
if ( !function_exists( 'hostinza_content_read_more' ) ) {

	function hostinza_content_read_more( $num = 20 ) {

		$excerpt		 = get_the_excerpt();
		$trimmed_content = wp_trim_words( $excerpt, $num_words		 = $num, $more			 = null );

		echo wp_kses_post( $trimmed_content );
		echo '</div><div class="post-footer xs-right"><a href="' . get_the_permalink() . '" class="simple-btn icon-right">' . esc_html__( 'Read More', 'hostinza' ) . '<i class="icon icon-arrow-right"></i></a>';
	}
}
if ( !function_exists( 'hostinza_get_alt_name' ) ) {

	function hostinza_get_alt_name( $id ) {
		if ( !empty( $id ) ) {
			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
			if ( !empty( $alt ) ) {
				$alt = $alt;
			} else {
				$alt = get_the_title( $id );
			}
			return $alt;
		}
	}

}

/*
 *
 * Get Footer Column
 */

if ( !function_exists( 'hostinza_get_footer_column' ) ) {

	function hostinza_get_footer_column( $footer_columns ) {
		if ( $footer_columns == 12 ) {
			return 1;
		} elseif ( $footer_columns == 6 ) {
			return 2;
		} elseif ( $footer_columns == 4 ) {
			return 3;
		}elseif ( $footer_columns == 2 ) {
			return 5;
		} else {
			return 4;
		}
	}

}

if ( !function_exists( 'hostinza_get_youtube_image' ) ) {

	function hostinza_get_youtube_image( $e ) {
		//GET THE URL
		if ( $e != '' ):
			$url = $e;

			$queryString = parse_url( $url, PHP_URL_QUERY );

			parse_str( $queryString, $params );

			$v = $params[ 'v' ];
			//DISPLAY THE IMAGE
			if ( strlen( $v ) > 0 ) {
				echo "<img src='http://i3.ytimg.com/vi/$v/default.jpg' width='600' />";
			}
		endif;
	}

}


/**
 *
 * Page Loader
 * @since 1.0.0
 *
 */
if ( !function_exists( 'hostinza_preloader' ) ) {

	function hostinza_preloader() {

		if ( defined( 'FW' ) ) {
			$loader = hostinza_option( 'show_preloader' );
			if ( $loader) {
				?> 
				<div id="preloader">
					<div class="preloader-wrapper"> 
						<div class="spinner"></div>
					</div>
					<div class="preloader-cancel-btn">
						<a href="#" class="btn btn-secondary prelaoder-btn"><?php esc_html_e('Cancel Preloader','hostinza');?></a>
					</div>
				</div>
				<?php
			}
		}
	}

}
//WPML CUSTOM Swicther

function languages_list_popup(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        echo '<div class="wpml-ls-legacy-list-horizontal"><ul>';
        foreach($languages as $l){
            echo '<li>';
            if($l['country_flag_url']){
                if(!$l['active']) echo '<a href="'.$l['url'].'">';
                echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                if(!$l['active']) echo '</a>';
            }
            if(!$l['active']) echo '<a href="'.$l['url'].'">';
            echo icl_disp_language($l['native_name'], $l['translated_name']);
            if(!$l['active']) echo '</a>';
            echo '</li>';
        }
        echo '</ul></div>';
    }
}

/**
 * Build a background-gradient style for CSS
 *
 * @param $color_1      hex color value
 * @param $color_2      hex color value
 *
 * @return string       CSS definition
 */
function kirki_build_gradients( $color_1, $color_2) {
	
	if($color_1 !='' && $color_2 !=''){
    $styles  = 'background:'.$color_1.';';
    $styles .= ' background: -webkit-linear-gradient(135deg, '.$color_1.' 0%, '.$color_2.' 60%, '.$color_2.' 99%);';
    $styles .= ' background: -o-linear-gradient(135deg, '.$color_1.' 0%, '.$color_2.' 60%, '.$color_2.' 99%);';
    $styles .= ' background: linear-gradient(135deg, '.$color_1.' 0%, '.$color_2.' 60%, '.$color_2.' 99%);';
	return $styles;
	}

}