<?php

function hostinza_action_xs_hook_css() {
    if ( defined( 'FW' ) ) {
        $primary_color = hostinza_option( 'primary_color' );
        $secondary_color = hostinza_option( 'secondary_color' );
        //custom css
        $custom_css	 = hostinza_get_option( 'custom_css' );
        $output		 = 
            $custom_css."
            .woocommerce ul.products li.product .added_to_cart:hover,
            .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{background-color: $secondary_color;}
            .woocommerce ul.products li.product .button,.woocommerce ul.products li.product .added_to_cart,
			.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
			.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.sponsor-web-link a:hover i
		{background-color: $primary_color;}" 
            
            
            ;
        if(!empty($output)){
            wp_add_inline_style( 'hostinza-style', $output );
        }
    }
}

add_action( 'wp_enqueue_scripts', 'hostinza_action_xs_hook_css', 90 );


