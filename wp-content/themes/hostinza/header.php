<?php
/**
 * header.php
 *
 * The header for the theme.
 */
?>
<!DOCTYPE html>
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> data-spy="scroll" data-target="#header">
    <div class="xs_page_wrapper">
    <?php
    echo hostinza_preloader();
    if ( defined( 'FW' ) ) {
        $navigation_style	 = fw_get_db_post_option( get_the_ID(), 'navigation_style' );
    }
    if(isset($navigation_style) && $navigation_style !=''){
        $heading = $navigation_style;
    }else{
        $heading = hostinza_option('header_layout');
    }
    get_template_part( 'template-parts/header-style/header',$heading );
    ?>