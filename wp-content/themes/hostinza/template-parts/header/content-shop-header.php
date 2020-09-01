<?php
/**
 * Blog Header
 *
 */

$bg_image	 = $heading	 = $overlay	 = '';
$page_banner_title	 = $page_banner_subtitle   = $page_banner_desc	= $header_image  = $header_buttons  =$header_icons = '';
$page_banner_layout = hostinza_option('shop_banner_layout');
$global_page_banner_img = hostinza_option('shop_banner_img');
$global_page_banner_title = hostinza_option('shop_banner_title');
$global_page_header_desc = hostinza_option('shop_header_desc');
$global_page_banner_subtitle = hostinza_option('shop_banner_subtitle');
$global_page_show_breadcrumb = hostinza_option('show_breadcrumb');
$gradient1 = hostinza_option('shop_gradient1');
$gradient2 = hostinza_option('shop_gradient2');
$global_blog_banner_overlay = kirki_build_gradients( $gradient1, $gradient2 );

$grid = 'col-lg-12 text-center';


if($page_banner_title != ''){
    $page_banner_title = $page_banner_title;
}elseif($global_page_banner_title != ''){
    $page_banner_title = $global_page_banner_title;
    
}else{
    $page_banner_title = get_the_title();
    
}
if($page_banner_subtitle != ''){
    $page_banner_subtitle = $page_banner_subtitle;
}elseif($global_page_banner_subtitle != ''){
    $page_banner_subtitle = $global_page_banner_subtitle;
}else{
    $page_banner_subtitle = '';
}
if($page_banner_desc != ''){
    $page_banner_desc = $page_banner_desc;
}elseif($global_page_header_desc != ''){
    $page_banner_desc = $global_page_header_desc;
}else{
    $page_banner_desc = '';
}


$page_show_breadcrumb = $global_page_show_breadcrumb;

if($global_page_banner_img != ''){
    $banner_image = $global_page_banner_img;
}elseif($header_image != ''){
    $banner_image = $header_image['url'];
}else{
    $banner_image = '';
}

if($global_blog_banner_overlay != ''){
    $bg_color = 'style="' . $global_blog_banner_overlay . '"';
}else{
    $bg_color = '';
}


if($page_banner_layout == '1'):
?>
<section class="xs-banner inner-banner contet-to-center" <?php echo wp_kses_post( $bg_color ); ?>>
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr($grid);?> align-self-center">
                <div class="xs-banner-content">
                <?php if($page_banner_subtitle != ''){ ?><h1 class="banner-sub-title wow fadeInLeft"><?php echo esc_html( $page_banner_subtitle ); ?></h1><?php } ?>
                    <h2 class="banner-title wow fadeInLeft" data-wow-duration="1.5s"><?php echo esc_html( $page_banner_title ); ?></h2>
                    <?php if($page_show_breadcrumb): ?>
                        <?php hostinza_get_breadcrumbs(); ?>
                    <?php endif; ?>
                    <p class="wow fadeInUp" data-wow-duration="1.5s"><?php echo esc_html( $page_banner_desc ); ?></p>
                    <?php if($header_buttons): ?>
                        <div class="xs-btn-wraper wow fadeInUp" data-wow-duration="1.7s">
                            <?php if($header_buttons[0]): ?>
                                <a href="<?php echo esc_url($header_buttons[0]['url']);?>" class="btn btn-primary"><?php echo esc_html($header_buttons[0]['text']);?></a>
                            <?php endif; ?>
                            <?php if($header_buttons[1]): ?>
                                <a href="<?php echo esc_url($header_buttons[1]['url']);?>" class="btn btn-outline-primary"><?php echo esc_html($header_buttons[1]['text']);?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div><!-- .xs-banner-content END -->
            </div>
            <div class="col-md-6">
                <div class="inner-welcome-image-group">
                    <?php if($banner_image != ''):?>
                        <img src="<?php echo esc_url($banner_image);?>" alt="<?php esc_attr_e('Welcome banner image','hostinza');?>">
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- .row END -->
    </div><!-- .container END -->
</section>

<?php else: ?>


<div class="xs-banner service-banner contet-to-center" style="background-image: url('<?php echo esc_url($banner_image); ?>');">
<div class="container">
    <div class="row">
        <div class="col-lg-7 align-self-center">
            <div class="xs-banner-content">
                <div class="xs-banner-group">
                    <h2 class="banner-title wow fadeInLeft" data-wow-duration="1.5s"><?php echo esc_html( $page_banner_title ); ?></h2>
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
