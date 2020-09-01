<?php
/**
 * Blog Header
 *
 */


$page_show_breadcrumb = hostinza_option('blog_show_breadcrumb');

$grid = 'col-lg-12 text-center';
$page_banner_layout = hostinza_option('blog_banner_layout');
$gradient1 = hostinza_option('blog_gradient1');
$gradient2 = hostinza_option('blog_gradient2');
$global_blog_banner_overlay = kirki_build_gradients( $gradient1, $gradient2 );
if($global_blog_banner_overlay != ''){
    $bg_color = 'style="' . $global_blog_banner_overlay . '"';
}else{
    $bg_color = '';
}

if($page_banner_layout == '1'):
?>
<!-- banner section -->
<section class="xs-banner inner-banner contet-to-center" <?php echo wp_kses_post( $bg_color ); ?>>
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr($grid);?> align-self-center">
                <div class="xs-banner-content">
                    <h2 class="banner-title wow fadeInLeft" data-wow-duration="1.5s">
                    <?php the_archive_title(); ?>
                    </h2>
                    <?php if($page_show_breadcrumb): ?>
                        <?php hostinza_get_breadcrumbs(); ?>
                    <?php endif; ?>
                </div><!-- .xs-banner-content END -->
            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
</section><!-- End banner section -->
<?php else: ?>
<div class="xs-banner service-banner contet-to-center" style="background-image: url('<?php echo esc_url($banner_image); ?>');">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 align-self-center">
                <div class="xs-banner-content">
                <div class="xs-banner-group">
                <h2 class="banner-title wow fadeInLeft" data-wow-duration="1.5s">
                    <?php the_archive_title(); ?>
                </h2>
                <?php if($page_show_breadcrumb): ?>
                    <?php hostinza_get_breadcrumbs(); ?>
                <?php endif; ?>
                </div><!-- .xs-banner-content END -->
                </div><!-- .xs-banner-content END -->
            </div>
        </div>
    </div>
    <div class="xs-overlay" <?php echo wp_kses_post( $bg_color ); ?>></div>
</div>
<?php endif; ?>