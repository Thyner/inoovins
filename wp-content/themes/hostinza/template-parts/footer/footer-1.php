<?php
$footer_columns = hostinza_option('footer_widget_layout');
$footer_bg_image = hostinza_option('footer_bg_image');
$footer_logo = hostinza_option('footer_logo');
$footer_social_links = hostinza_option('footer_social_links');
$bg_image = '';
if (!empty($footer_bg_image)) {
    $bg_image = "background-image: url('" . $footer_bg_image . "')";
}
if ($footer_columns == 12) {
    $footer_column = 1;
} elseif ($footer_columns == 6) {
    $footer_column = 2;
} elseif ($footer_columns == 4) {
    $footer_column = 3;
} elseif ($footer_columns == 3) {
    $footer_column = 4;
} elseif ($footer_columns == 2) {
    $footer_column = 6;
}

$show_terms = hostinza_option('show_terms');
$show_footer_widget = hostinza_option('show_footer_widget');
$terms_text = hostinza_option('terms_text');
$terms_logo = hostinza_option('terms_logo');

?>
<footer class="xs-footer-section footer-group" style="<?php echo hostinza_kses($bg_image); ?>">
    <?php if($show_footer_widget): ?>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <?php for ($i = 1; $i <= $footer_column; $i++): ?>
                    <div class="col-md-<?php echo esc_attr($footer_columns); ?>">
                        <?php
                        if (is_active_sidebar('footer-widget-' . $i)):
                            dynamic_sidebar('footer-widget-' . $i);
                        endif;
                        ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($show_terms): ?>
        <div class="container">
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <?php if (!empty($terms_text)): ?>
                            <div class="footer-bottom-info wow fadeInUp">
                                <p><?php echo wp_kses_post($terms_text); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <?php if (is_array($terms_logo) && !empty($terms_logo)): ?>
                            <ul class="xs-list list-inline wow fadeInUp">
                                <?php foreach ($terms_logo as $index => $item): ?>
                                    <?php
                                    $img = '';
                                    if (!empty($item['image'])) {
                                        $imgs = wp_get_attachment_image_src($item['image'], 'full');
                                        $img = $imgs[0];
                                        echo '<li><img src="' . esc_url($img) . '" alt="' . hostinza_get_alt_name($item) . '"></li>';
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php  ?>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="copyright-text copyright-text-style-2 wow fadeInUp">
                        <p><?php echo hostinza_option('copyright_text'); ?></p>
                    </div><!-- .copyright-text END -->
                </div>

                <div class="col-md-4">
                    <?php  if (!empty($footer_logo)) { ?>
                        <div class="footer-logo-wraper wow fadeInUp" data-wow-duration="1s">
                            <a href="<?php echo esc_url(home_url('/'));?>" class="footer-logo"><img src="<?php echo esc_url($footer_logo);?>" alt="<?php esc_attr_e('footer logo','hostinza');?>"></a>
                        </div>
                    <?php } ?>
                    <!-- .footer-logo-wraper END -->
                </div>
                <div class="col-md-4">
                    <div class="social-list-wraper wow fadeInUp" data-wow-duration="1.3s">
                        <ul class="social-list">
                            <?php if($footer_social_links) {
                                foreach($footer_social_links as $social){
                                    ?><li><a href="<?php echo esc_url($social['social_url']); ?>"><i class="<?php echo esc_attr($social['social_icon']); ?>"></i></a></li><?php
                                }
                            } ?>
                        </ul>
                    </div><!-- .social-list-wraper END -->
                </div>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </div><!-- .footer-copyright END -->

</footer>
<?php
get_template_part( 'template-parts/header-style/nav','search' );
get_template_part( 'template-parts/header-style/nav','sidebar' );
get_template_part( 'template-parts/header-style/nav','wpml' );

?>