<?php
/**
 * Blog Header
 *
 */

$bg_image	 = $heading	 = $overlay	 = '';
$page_banner_title	 = $page_banner_subtitle	 = '';
$page_banner_layout = hostinza_option('page_banner_layout');
$global_page_show_breadcrumb = hostinza_option('blog_show_breadcrumb');
$global_page_banner_img = hostinza_option('page_banner_img');
$global_page_banner_title = hostinza_option('page_banner_title');
$global_page_header_desc = hostinza_option('page_header_desc');
$global_page_banner_subtitle = hostinza_option('page_banner_subtitle');
$gradient1 = hostinza_option('page_gradient1');
$gradient2 = hostinza_option('page_gradient2');
$global_blog_banner_overlay = kirki_build_gradients( $gradient1, $gradient2 );



if ( defined( 'FW' ) ) {

    //Page settings
    $page_banner_title	 = fw_get_db_post_option( get_the_ID(), 'header_title' );
    $page_banner_subtitle	 = fw_get_db_post_option( get_the_ID(), 'header_sub_title' );
    $page_banner_desc	 = fw_get_db_post_option( get_the_ID(), 'header_desc' );
    $page_show_breadcrumb	 = fw_get_db_post_option( get_the_ID(), 'show_breadcrumb' );
    $header_image	 = fw_get_db_post_option( get_the_ID(), 'header_image' );
    $header_icons	 = fw_get_db_post_option( get_the_ID(), 'header_icons' );
    $header_buttons	 = fw_get_db_post_option( get_the_ID(), 'header_buttons' );

}


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

if(isset($page_show_breadcrumb)){
    $page_show_breadcrumb = $page_show_breadcrumb;
}else{
    $page_show_breadcrumb = $global_page_show_breadcrumb;
}

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
<section class="xs-banner service-banner-2 contet-to-center" <?php echo wp_kses_post( $bg_color ); ?>>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 align-self-center">
                <div class="xs-banner-content">
                    <div class="xs-banner-group">
                        <?php if($page_banner_title != ''){ ?><h2 class="banner-title wow fadeInLeft" data-wow-duration="1s"><?php echo esc_html( $page_banner_title ); ?></h2><?php } ?>
                        <?php if($page_banner_subtitle != ''){ ?><p class="wow fadeInLeft" data-wow-duration="1.5s"><?php echo esc_html( $page_banner_subtitle ); ?></p><?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 align-self-center">
                <?php if($banner_image):?>
                    <div class="inner-welcome-image-group wow fadeIn">
                        <img src="<?php echo esc_url($banner_image);?>" data-parallax='{"y": 150}' alt="<?php esc_attr_e('hosting image','hostinza');?>">
                    </div>
                <?php endif; ?>                
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<div class="xs-banner service-banner contet-to-center" style="background-image: url('<?php echo esc_url($banner_image); ?>');">
<div class="container">
    <div class="row">
        <div class="col-lg-7 align-self-center">
            <div class="xs-banner-content">
                <div class="xs-banner-group">
                    <?php if($page_banner_title != ''){ ?><h2 class="banner-title wow fadeInLeft" data-wow-duration="1s"><?php echo esc_html( $page_banner_title ); ?></h2><?php } ?>
                    <?php if($page_banner_subtitle != ''){ ?><p class="wow fadeInLeft" data-wow-duration="1.5s"><?php echo esc_html( $page_banner_subtitle ); ?></p><?php } ?>
                </div><!-- .xs-banner-content END -->
            </div><!-- .xs-banner-content END -->
        </div>
    </div>
</div>
<div class="xs-overlay" <?php echo wp_kses_post( $bg_color ); ?>></div>
</div>
<?php endif; ?>