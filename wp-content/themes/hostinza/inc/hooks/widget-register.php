<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('hostinza_widget_init')) {

    function hostinza_widget_init()
    {
        if (function_exists('register_sidebar')) {
            register_sidebar(
                array(
                    'name' => esc_html__('Blog Widget Area', 'hostinza'),
                    'id' => 'sidebar-1',
                    'description' => esc_html__('Appears on posts.', 'hostinza'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h4 class="xs-title">',
                    'after_title' => '</h4>',
                )
            );
            register_sidebar(
                array(
                    'name' => esc_html__('Page Widget Area', 'hostinza'),
                    'id' => 'sidebar-2',
                    'description' => esc_html__('Appears on Pages.', 'hostinza'),
                    'before_widget' => '<div id="%1$s" class="sidebar xs-single-sidebar border xs-content-padding %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h4 class="widget-title xs-title">',
                    'after_title' => '</h4>',
                )
            );
            register_sidebar(
                array(
                    'name' => esc_html__('Shop Widget Area', 'hostinza'),
                    'id' => 'sidebar-3',
                    'description' => esc_html__('Appears on Shop.', 'hostinza'),
                    'before_widget' => '<div id="%1$s" class="sidebar xs-single-sidebar border xs-content-padding %2$s">',
                    'after_widget' => '</div><!-- end widget -->',
                    'before_title' => '<h3 class="widget-title xs-widget-title">',
                    'after_title' => '</h3>',
                )
            );

            $show_footer_widget = hostinza_option( 'show_footer_widget');
            $footer_column = hostinza_get_footer_column(hostinza_option('footer_widget_layout'));
            for ($i = 1; $i <= $footer_column; $i++) {
                $args_sidebar = array(
                    'name' => esc_html__('Footer Widget ', 'hostinza') . $i,
                    'id' => 'footer-widget-' . $i,
                    'description' => esc_html__('Appears on posts and pages.', 'hostinza'),
                    'before_widget' => '<div class="footer-widget wow fadeInUp">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3 class="widget-title">',
                    'after_title' => '</h3>',
                );

                register_sidebar($args_sidebar);
            }

        }
    }

    add_action('widgets_init', 'hostinza_widget_init');
}


