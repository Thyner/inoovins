<?php
$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'header_layout',
    'label'       => esc_html__( 'Header Layout', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => '1',
    'choices'     => array(
        '1'   => esc_url(get_template_directory_uri()) . '/assets/images/header-style/header-1.png',
        '2'   => esc_url(get_template_directory_uri()) . '/assets/images/header-style/header-2.png',
    ),
); 

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'is_transparent_header',
    'label'       => esc_html__( 'Make Transparent Header', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'is_dark_header',
    'label'       => esc_html__( 'Make Dark Header', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'is_transparent_header',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
);

$fields[]= array( 
    'type'        => 'switch',
    'settings'    => 'is_sticky_header',
    'label'       => esc_html__( 'Make Sticky Header', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'sticky_nav_bg_color',
    'label'       => esc_html__( 'Sticky Nav Background Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'is_sticky_header',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
    'output'      => array(
        array(
            'element' 	=> '.sticky-header.sticky .xs-header:not(.header-boxed)',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'sticky_nav_color',
    'label'       => esc_html__( 'Sticky Nav Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'is_sticky_header',
            'operator'  => '==',
            'value'     => true,
        ),
    ),
    'output'      => array(
        array(
            'element' 	=> '.nav-sticky.sticky-header.sticky .xs-header .xs-menus .nav-menu > li > a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.nav-sticky.sticky-header.sticky .xs-header .xs-menus .nav-menu > li > a::before',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.nav-sticky.sticky-header.sticky .xs-header .xs-menus .nav-menu > li > a .submenu-indicator-chevron',
            'property'	=> 'border-color',
        ),
        array(
            'element' 	=> '.nav-sticky.sticky-header .xs-menu-tools > li > a',
            'property'	=> 'color',
        ),
    ),
);
/*
 * Top Header
 *
*/
$fields[] = array(
    'type'        => 'custom',
    'settings'    => 'top_header_title',
    'label'       => '',
    'section'     => 'nav_section',
    'default'     => '<div class="xs-title-divider">'.esc_html__("Top Header Section","hostinza").'</div>',
    'priority'    => 10,
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_top_header',
    'label'       => esc_html__( 'Show Top Header', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'top_background_color',
    'label'       => esc_html__( 'Background Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.header-transparent .xs-top-bar',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-top-bar',
            'property'	=> 'background-color',
        ),
    ),
);


$fields[] = array(
    'type'        => 'color',
    'settings'    => 'top_text_color',
    'label'       => esc_html__( 'Text Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-top-bar-info li p, .xs-top-bar-info li a',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'top_link_color',
    'label'       => esc_html__( 'Link Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.top-menu li a',
            'property'	=> 'color',
        ),
    ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'top_header_phn',
    'label'       => esc_html__( 'Phone Number', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-top-bar-info li.top-phone p',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( '009-215-5596', 'hostinza' ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'top_header_phn_icon',
    'label'       => esc_html__( 'Phone Icon', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-top-bar-info li.top-phone p i',
            'function' => 'class'
        ),
    ),
    'default'     => esc_attr( 'icon icon-phone'),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'top_header_email',
    'label'       => esc_html__( 'Email Address', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-top-bar-info li.top-email a',
            'function' => 'html'
        ),
    ),
    'default'     => esc_html__( 'info@domain.com', 'hostinza' ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'top_header_email_icon',
    'label'       => esc_html__( 'Email Icon', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-top-bar-info li.top-email a i',
            'function' => 'class'
        ),
    ),
    'default'     => esc_attr( 'icon icon-envelope' ),
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Navigation', 'hostinza' ),
    'section'     => 'nav_section',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Navigation', 'hostinza' ),
    ),
    'settings'    => 'top_header_nav',
    'default'     => array(
        array(
            'label' => esc_html__('Login','hostinza'),
            'link'  => '#',
            'icon'  => 'icon icon-key2',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'show_top_header',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
    'fields' => array(
        'label' => array(
            'type'        => 'text',
            'settings'    => 'label',
            'label'       => esc_html__( 'Login', 'hostinza' ),
            'default'     => esc_html__( 'Login', 'hostinza' ),
        ),
        'link' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link', 'hostinza' ),
            'default'     => '#',
        ),
        'icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Icon', 'hostinza' ),
            'default'     => '',
        ),
    )
);
/*
 *
 * Main Nav
 *
 */
$fields[] = array(
    'type'        => 'custom',
    'settings'    => 'nav_header_title',
    'label'       => '',
    'section'     => 'nav_section',
    'default'     => '<div class="xs-title-divider">'.esc_html__("Navigation Section","hostinza").'</div>',
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'nav_cart',
    'label'       => esc_html__( 'Show Cart', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'nav_cart_url',
    'label'       => esc_html__( 'Cart Url', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'nav_cart',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'default'     => '#',
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'nav_lang',
    'label'       => esc_html__( 'Show Language Switcher', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'nav_search',
    'label'       => esc_html__( 'Show Search', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_bg_color',
    'label'       => esc_html__( 'Background Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'header_layout',
            'operator'  => '==',
            'value'     => 1,
        ),
        array(
            'setting'   => 'is_transparent_header',
            'operator'  => '==',
            'value'     => false,
        ),
    ),
    'output'      => array(
        array(
            'element' 	=> '.header .xs-header',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_bg3_color',
    'label'       => esc_html__( 'Background Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'required'      => array(
        array(
            'setting'   => 'header_layout',
            'operator'  => '==',
            'value'     => 3,
        )
    ),
    'output'      => array(
        array(
            'element' 	=> '.xs-header.header-boxed > .container::before',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_menu_color',
    'label'       => esc_html__( 'Menu Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.header-transparent .xs-menus .nav-menu > li > a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-menus .nav-menu > li > a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-menus .nav-menu > li > a .submenu-indicator-chevron',
            'property'	=> 'border-color',
        ),
        array(
            'element' 	=> '.nav-sticky .xs-menu-tools > li > a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.header-transparent .xs-menu-tools > li > a',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'nav_menu_hover_color',
    'label'       => esc_html__( 'Menu Hover Color', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.header-transparent .xs-menus .nav-menu > li > a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-menus .nav-menu .xs-icon-menu .single-menu-item a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.header-transparent .xs-menus .nav-menu > li > a::before',
            'property'	=> 'border-color',
        ),
        array(
            'element' 	=> '.xs-menus .nav-menu > li > a .submenu-indicator-chevron:hover',
            'property'	=> 'border-color',
        ),
        array(
            'element' 	=> '.header-transparent .xs-menu-tools > li > a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.nav-sticky .xs-menu-tools > li > a:hover',
            'property'	=> 'color',
        ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'nav_sidebar',
    'label'       => esc_html__( 'Show Sidebar', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'nav_sidebar_content',
    'label'       => esc_html__( 'Content', 'hostinza' ),
    'section'     => 'nav_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-top-bar-info li p',
            'function' => 'html'
        ),
    ),
    'default'     => '',
);

/*
 *
 * Nevigation Sidebar
 *
 *
 */

$fields[] = array(
    'type'        => 'image',
    'settings'    => 'nav_sidebar_logo',
    'label'       => esc_html__( 'Logo', 'hostinza' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Contact Info', 'hostinza' ),
    'section'     => 'nav_section',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Contact Info', 'hostinza' ),
    ),
    'settings'    => 'nav_contact_info',
    'default'     => array(
        array(
            'image' => '',
            'title'  => esc_html__('759 Pinewood Avenue','hostinza'),
            'sub_title'  => esc_html__('Marquette, Michigan','hostinza'),
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
    'fields' => array(
        'image' => array(
            'type'        => 'image',
            'label'       => esc_html__( 'Image', 'hostinza' ),
            'default'     => '',
        ),
        'title' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Title', 'hostinza' ),
            'default'     => '#',
        ),
        'sub_title' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Sub Title', 'hostinza' ),
            'default'     => '',
        ),
    )
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'sidebar_show_subscribe',
    'label'       => esc_html__( 'Show Subscribe Form', 'hostinza' ),
    'section'     => 'nav_section',
    'default'     => true,
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'sidebar_subscribe_title',
    'label'       => esc_html__( 'Subscribe Form Title', 'hostinza' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
        array(
            'setting'   => 'sidebar_show_subscribe',
            'operator'  => '==',
            'value'     => 1,
        ),

    ),
    'default'     => esc_html__('Get Subscribed!','hostinza'),
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'sidebar_subscribe_shortcode',
    'label'       => esc_html__( 'Subscribe Form Shortcode', 'hostinza' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
        array(
            'setting'   => 'sidebar_show_subscribe',
            'operator'  => '==',
            'value'     => 1,
        ),

    ),
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Social Icon', 'hostinza' ),
    'section'     => 'nav_section',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Social Icon', 'hostinza' ),
    ),
    'settings'    => 'sidebar_social_icon',
    'default'     => array(
        array(
            'icon' => 'fa fa-facebook',
            'link'  => '#',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
    'fields' => array(
        'icon' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Image', 'hostinza' ),
            'default'     => '',
        ),
        'link' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link', 'hostinza' ),
            'default'     => '#',
        ),
    )
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'sidebar_btn',
    'label'       => esc_html__( 'Button Label', 'hostinza' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        )
    ),

    'default'     => esc_html__( 'Purchase Now', 'hostinza' ),
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'sidebar_btn_link',
    'label'       => esc_html__( 'Button Link', 'hostinza' ),
    'section'     => 'nav_section',
    'required'      => array(
        array(
            'setting'   => 'nav_sidebar',
            'operator'  => '==',
            'value'     => 1,
        )
    ),

    'default'     => '#',
);
