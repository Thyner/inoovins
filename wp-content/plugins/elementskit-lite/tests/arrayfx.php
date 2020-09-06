
<?php
$x = array(10,2,4);
$y = array(1 => 2, 0 => 10, 2 => 4);
var_dump($x == $y);

?>





<?php 

exit;



$default_list = [
    'image-accordion',
    'accordion',
    'button',
    'heading',
    'blog-posts',
    'icon-box',
    'image-box',
    'countdown-timer',
    'client-logo',
    'faq',
    'funfact',
    'image-comparison',
    'lottie',
    'testimonial',
    'pricing',
    'team',
    'social',
    'progressbar',
    'category-list',
    'page-list',
    'post-grid',
    'post-list',
    'post-tab',
    'nav-menu',
    'mail-chimp',
    'header-info',
    'piechart',
    'header-search',
    'header-offcanvas',
    'tab',
    'contact-form7',
    'video',
    'business-hours',
    'drop-caps',
    'social-share',
    'dual-button',
    'caldera-forms',
    'we-forms',
    'wp-forms',
    'ninja-forms',
    'tablepress',
];

$optional_list = [
    'advanced-accordion',
    'advanced-tab',
    'hotspot',
    'motion-text',
    'twitter-feed',
    'facebook-feed',
    'instagram-feed',
    'gallery',
    'chart',
    'woo-category-list',
    'woo-mini-cart',
    'woo-product-carousel',
    'woo-product-list',
    'table',
    'timeline',
    'creative-button',
    'vertical-menu',
    'advanced-toggle'
];

ob_start();
echo '[';

foreach($default_list as $n){
    ?>
'<?php echo $n; ?>' => [
        'slug' => '<?php echo $n; ?>',
        'title' => '<?php echo ucwords(str_replace('-', ' ', $n)); ?>',
        'package' => 'lite',
    ],
    <?php
}


foreach($optional_list as $n){
    ?>
'<?php echo $n; ?>' => [
        'slug' => '<?php echo $n; ?>',
        'title' => '<?php echo ucwords(str_replace('-', ' ', $n)); ?>',
        'package' => 'pro-disabled',
    ],
    <?php
}

echo ']';

$output = ob_get_contents();

file_put_contents('f.txt',$output);