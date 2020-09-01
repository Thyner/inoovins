<?php
if ( defined( 'FW' ) ) {
    //Page settings
    $custom_logo	 = fw_get_db_post_option( get_the_ID(), 'custom_logo' );
}
if(isset($custom_logo['url']) && $custom_logo['url'] !=''){
    $logo = $custom_logo['url'];
}else{
    $logo = hostinza_option('site_logo');
}
$nav_search = hostinza_option('nav_search');
$nav_sidebar = hostinza_option('nav_sidebar');
$nav_cart = hostinza_option('nav_cart');
$nav_cart_url = hostinza_option('nav_cart_url');
$nav_lang = hostinza_option('nav_lang');
$is_sticky_header = hostinza_option('is_sticky_header');
$is_transparent_header = hostinza_option('is_transparent_header');
$header_class = 'header';
if ($is_sticky_header):
    $header_class .= ' header-transparent nav-sticky';
endif;

if ($is_transparent_header):
    $header_class .= ' header-transparent';
endif;
?>
<div class="<?php echo esc_attr($header_class);?>">
    <?php get_template_part('template-parts/header-style/top','bar') ?>
    <header class="xs-header header-boxed">
        <div class="container">
            <div class="row align-items-center">
                    <div class="xs-logo-wraper">
                        <a href="<?php echo esc_url(home_url('/'));?>" class="xs-logo">
                            <?php if(!empty($logo)): ?>
                                <img src="<?php echo esc_url($logo);  ?>" alt="<?php echo get_bloginfo(); ?>">
                            <?php endif ?>
                        </a>
                    </div>
                    <nav class="xs-menus ml-auto">
                        <div class="nav-header">
                            <a class="nav-brand" href="<?php echo esc_url(home_url('/'));?>">
                                <?php if(!empty($logo)): ?>
                                    <img src="<?php echo esc_url($logo);  ?>" alt="<?php echo get_bloginfo(); ?>">
                                <?php endif ?>
                            </a>
                            <div class="nav-toggle"></div>
                        </div>
                        <?php
                        if(has_nav_menu('primary')) {
                            wp_nav_menu(
                                array(
                                    'theme_location'	 => 'primary',
                                    'container_class'	 => 'nav-menus-wrapper',
                                    'menu_class'		 => 'nav-menu',
                                    'fallback_cb'		 => '',
                                    'menu_id'			 => 'main-menu',
                                    'walker'			 => new hostinza_main_nav_walker(),
                                )
                            );
                        }
                        ?>
                    </nav>
               
                <?php if(($nav_sidebar) || ($nav_search) || ($nav_lang) || ($nav_cart)): ?>
                    <ul class="xs-menu-tools">
                        <?php if ($nav_lang): ?>
                            <li>
                                <a href="#modal-popup-wpml" class="languageSwitcher-button xs-modal-popup"><i class="icon icon-internet"></i></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($nav_cart): ?>
                            <li>
                                <a href="<?php echo esc_url($nav_cart_url);?>" class="offset-side-bar"><i class="icon icon-cart2"></i></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($nav_search): ?>
                            <li>
                                <a href="#modal-popup-2" class="navsearch-button xs-modal-popup"><i class="icon icon-search"></i></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($nav_sidebar): ?>
                            <li>
                                <a href="#" class="navSidebar-button"><i class="icon icon-burger-menu"></i></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </header>
</div>