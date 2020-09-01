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
}elseif ($footer_columns == 2) {
    $footer_column = 5;
}else{
    $footer_column = 3;
}

$show_terms = hostinza_option('show_terms');
$show_footer_widget = hostinza_option('show_footer_widget');
$terms_text = hostinza_option('terms_text');
$terms_logo = hostinza_option('terms_logo');
?>
<footer class="xs-footer-section footer-v2">
	<div class="container">
        <?php if ($show_terms): ?>
            <div class="footer-bottom"> 
                <div class="row">
                    <?php if (!empty($terms_text)): ?>    
                        <div class="col-md-6">
                            <div class="footer-bottom-info f-style-2 wow fadeInUp">
                                <p><?php echo wp_kses_post($terms_text); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
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
        <?php endif; ?>
    </div>
    <?php if($show_footer_widget): ?>
        <div class="footer-group" style="<?php echo hostinza_kses($bg_image); ?>">
            <div class="footer-main">
                <div class="container">
                    <div class="row">
                        <?php
                            for ($i = 1; $i <= $footer_column; $i++): 

                            $footer_columns = apply_filters( "hostinza_footer_widget_{$i}_width", $footer_columns );
                            ?>
                            <div class="col-lg-<?php echo esc_attr($footer_columns); ?> col-md-6">
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
        </div>
    <?php endif; ?>
</footer>
<?php
get_template_part( 'template-parts/header-style/nav','search' );
get_template_part( 'template-parts/header-style/nav','sidebar' );
get_template_part( 'template-parts/header-style/nav','wpml' );

?>