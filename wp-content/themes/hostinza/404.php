<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Not Found).
 */
?>

<?php get_header();
    if ( defined( 'FW' ) ) {
        $title	 = hostinza_option( '404_title' );
        $back_to_home_label	 = hostinza_option('back_to_home_label' );
        $logo	 = hostinza_option('404_logo' );
    }else{
        $title = esc_html__('404 Page','hostinza');
        $back_to_home_label = esc_html__('Back to Home','hostinza');
        $logo = hostinza_get_image( 'menu_logo', HOSTINZA_IMAGES . '/404.png' );
    }

?>

<section class="xs-banner banner-404">
    <div class="container">
        <div class="row">
            <div class="col-md-7 align-self-center">
                <div class="xs-banner-content">
                    <h2 class="banner-title"><?php echo esc_html($title);?></h2>
                    <div class="xs-btn-wraper">
                        <a href="<?php echo esc_url(home_url('/'));?>" class="btn btn-primary"><?php echo esc_html($back_to_home_label);?></a>
                    </div>
                </div><!-- .xs-banner-content END -->
            </div>
            <?php if($logo != ''):?>
                <div class="col-md-5">
                    <div class="xs-banner-image">
                        <img src="<?php echo esc_url($logo);?>" data-parallax='{"y": 150}' alt="<?php esc_attr_e('404 image','hostinza');?>">
                    </div>
                </div>
            <?php endif; ?>
        </div><!-- .row END -->
    </div><!-- .container END -->
    <div class="icon-bg"></div>
</section>
<?php get_footer(); ?>