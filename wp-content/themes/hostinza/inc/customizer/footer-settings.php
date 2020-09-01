<?php
$fields[]= array(
    'type'        => 'radio-image',
    'settings'    => 'footer_style',
    'label'       => esc_html__( 'Footer Style', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => '1',
    'choices'     => array(
        '1'   => esc_url(get_template_directory_uri()) . '/assets/images/footer-style/footer-1.png',
        '2'   => esc_url(get_template_directory_uri()) . '/assets/images/footer-style/footer-2.png',
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_footer_widget',
    'label'       => esc_html__( 'Show Footer widget area', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_layout',
    'label'       => esc_html__( 'Footer Widget Per Row', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array( 
        '12' => esc_attr__( '1', 'hostinza' ),
        '6' => esc_attr__( '2', 'hostinza' ),
        '4' => esc_attr__( '3', 'hostinza' ),
        '3' => esc_attr__( '4', 'hostinza' ),
        '2' => esc_attr__( '5', 'hostinza' ),
        '2' => esc_attr__( '6', 'hostinza' ),
    ),
);

$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_1_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 1', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'hostinza' ),
        '2' => esc_attr__( '2', 'hostinza' ),
        '3' => esc_attr__( '3', 'hostinza' ),
        '4' => esc_attr__( '4', 'hostinza' ),
        '5' => esc_attr__( '5', 'hostinza' ),
        '6' => esc_attr__( '6', 'hostinza' ),
        '7' => esc_attr__( '7', 'hostinza' ),
        '8' => esc_attr__( '8', 'hostinza' ),
        '9' => esc_attr__( '9', 'hostinza' ),
        '10' => esc_attr__( '10', 'hostinza' ),
        '11' => esc_attr__( '11', 'hostinza' ),
        '12' => esc_attr__( '12', 'hostinza' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 2
        )
    ),
);

$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_2_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 2', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'hostinza' ),
        '2' => esc_attr__( '2', 'hostinza' ),
        '3' => esc_attr__( '3', 'hostinza' ),
        '4' => esc_attr__( '4', 'hostinza' ),
        '5' => esc_attr__( '5', 'hostinza' ),
        '6' => esc_attr__( '6', 'hostinza' ),
        '7' => esc_attr__( '7', 'hostinza' ),
        '8' => esc_attr__( '8', 'hostinza' ),
        '9' => esc_attr__( '9', 'hostinza' ),
        '10' => esc_attr__( '10', 'hostinza' ),
        '11' => esc_attr__( '11', 'hostinza' ),
        '12' => esc_attr__( '12', 'hostinza' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 2
        )
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_3_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 3', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'hostinza' ),
        '2' => esc_attr__( '2', 'hostinza' ),
        '3' => esc_attr__( '3', 'hostinza' ),
        '4' => esc_attr__( '4', 'hostinza' ),
        '5' => esc_attr__( '5', 'hostinza' ),
        '6' => esc_attr__( '6', 'hostinza' ),
        '7' => esc_attr__( '7', 'hostinza' ),
        '8' => esc_attr__( '8', 'hostinza' ),
        '9' => esc_attr__( '9', 'hostinza' ),
        '10' => esc_attr__( '10', 'hostinza' ),
        '11' => esc_attr__( '11', 'hostinza' ),
        '12' => esc_attr__( '12', 'hostinza' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 3
        )
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_4_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 4', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'hostinza' ),
        '2' => esc_attr__( '2', 'hostinza' ),
        '3' => esc_attr__( '3', 'hostinza' ),
        '4' => esc_attr__( '4', 'hostinza' ),
        '5' => esc_attr__( '5', 'hostinza' ),
        '6' => esc_attr__( '6', 'hostinza' ),
        '7' => esc_attr__( '7', 'hostinza' ),
        '8' => esc_attr__( '8', 'hostinza' ),
        '9' => esc_attr__( '9', 'hostinza' ),
        '10' => esc_attr__( '10', 'hostinza' ),
        '11' => esc_attr__( '11', 'hostinza' ),
        '12' => esc_attr__( '12', 'hostinza' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 4
        )
    ),
);
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_5_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 5', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'hostinza' ),
        '2' => esc_attr__( '2', 'hostinza' ),
        '3' => esc_attr__( '3', 'hostinza' ),
        '4' => esc_attr__( '4', 'hostinza' ),
        '5' => esc_attr__( '5', 'hostinza' ),
        '6' => esc_attr__( '6', 'hostinza' ),
        '7' => esc_attr__( '7', 'hostinza' ),
        '8' => esc_attr__( '8', 'hostinza' ),
        '9' => esc_attr__( '9', 'hostinza' ),
        '10' => esc_attr__( '10', 'hostinza' ),
        '11' => esc_attr__( '11', 'hostinza' ),
        '12' => esc_attr__( '12', 'hostinza' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '>=',
            'value'     => 5
        )
    ),
);   
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'footer_widget_6_grid',
    'label'       => esc_html__( 'Number of Grids of Footer Widgets 6', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => '3',
    'choices'     => array(
        '1' => esc_attr__( '1', 'hostinza' ),
        '2' => esc_attr__( '2', 'hostinza' ),
        '3' => esc_attr__( '3', 'hostinza' ),
        '4' => esc_attr__( '4', 'hostinza' ),
        '5' => esc_attr__( '5', 'hostinza' ),
        '6' => esc_attr__( '6', 'hostinza' ),
        '7' => esc_attr__( '7', 'hostinza' ),
        '8' => esc_attr__( '8', 'hostinza' ),
        '9' => esc_attr__( '9', 'hostinza' ),
        '10' => esc_attr__( '10', 'hostinza' ),
        '11' => esc_attr__( '11', 'hostinza' ),
        '12' => esc_attr__( '12', 'hostinza' ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_widget_layout',
            'operator'  => '==',
            'value'     => 6
        )
    ),
);   
$fields[] = array(
    'type'        => 'image',
    'settings'    => 'footer_bg_image',
    'label'       => esc_html__( 'Background Image', 'hostinza' ),
    'section'     => 'footer_section',
);
$fields[] = array(
    'type'        => 'image',
    'settings'    => 'footer_logo',
    'label'       => esc_html__( 'Footer Logo', 'hostinza' ),
    'section'     => 'footer_section',
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
);
$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_bg_color',
    'label'       => esc_html__( 'Background Color', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-section',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.footer-group',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.xs-footer-section.footer-v2',
            'property'	=> 'background-color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'widget_title_color',
    'label'       => esc_html__( 'Widget Title Color', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.footer-widget .widget-title',
            'property'	=> 'color',
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_text_color',
    'label'       => esc_html__( 'Footer text color', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(

        array(
            'element' 	=> 'footer.xs-footer-section.footer-v2 p',
            'property'	=> 'color',
        ), array(
            'element' 	=> '.footer-widget .xs-list li a, .contact-info-widget li span',
            'property'	=> 'color',
        ), array(
            'element' 	=> '.footer-bottom-info p',
            'property'	=> 'color',
        ), array(
            'element' 	=> '.xs-footer-section.footer-v2 .footer-bottom .footer-bottom-info.f-style-2 p ',
            'property'	=> 'color',
        )
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_link_color',
    'label'       => esc_html__( 'Footer link color', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> 'footer.xs-footer-section.footer-group a',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> 'footer.xs-footer-section.footer-v2 a',
            'property'	=> 'color',
        ), array(
            'element' 	=> '.xs-footer-section.footer-v2 .footer-widget .menu>li>a',
            'property'	=> 'color',
        ), array(
            'element' 	=> '.xs-footer-section.footer-v2 .footer-widget .contact-info-widget>li>a',
            'property'	=> 'color',
        )
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'footer_link_hover_color',
    'label'       => esc_html__( 'Footer link Hover color', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> 'footer.xs-footer-section.footer-group a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> 'footer.xs-footer-section.footer-v2 a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-footer-section.footer-v2 .footer-widget .menu>li>a:hover',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.xs-footer-section.footer-v2 .footer-widget .contact-info-widget>li>a:hover',
            'property'	=> 'color',
        )
    ),
);
/*
 *
 * Terms & security
 *
 */
$fields[] = array(
    'type'        => 'custom',
    'settings' => 'custom_title_terms',
    'label'       => '',
    'section'     => 'footer_section',
    'default'     => '<div class="xs-title-divider">'.esc_html__("Terms & security","hostinza").'</div>',
);

$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_terms',
    'label'       => esc_html__( 'Show Terms & security', 'hostinza' ),
    'section'     => 'footer_section',
    'default'     => false,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'hostinza' ),
        'off' => esc_attr__( 'Disable', 'hostinza' ),
    ),
);

$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'terms_text',
    'label'       => esc_html__( 'Content', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'postMessage',
    'required'      => array(
        array(
            'setting'   => 'show_terms',
            'operator'  => '==',
            'value'     => 1,
        )
    ),
    'js_vars'     => array(
        array(
            'element'  => '.xs-footer-section .footer-bottom-info p',
            'function' => 'html'
        ),
    ),
    'default'     => '',
);

$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_html__( 'Client Logo', 'hostinza' ),
    'section'     => 'footer_section',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Logo', 'hostinza' ),
    ),
    'settings'    => 'terms_logo',
    'default'     => array(
        array(
            'image' => '',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'show_terms',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
    'fields' => array(
        'image' => array(
            'type'        => 'image',
            'label'       => esc_html__( 'Logo', 'hostinza' ),
            'default'     => '',
        )
    )
);

$fields[] = array(
    'type'        => 'custom',
    'settings' => 'custom_title_transparent',
    'label'       => '',
    'section'     => 'footer_section',
    'default'     => '<div class="xs-title-divider">'.esc_html__("Copyright Section","hostinza").'</div>',
);

$fields[]= array(
    'type'        => 'textarea',
    'settings'    => 'copyright_text',
    'label'       => esc_html__( 'Copyright text', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'js_vars'     => array(
        array(
            'element'  => 'copyright-text p',
            'function' => 'html'
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
    'default'     => esc_html__( 'Copyrights By Xpeedstudio - 2018', 'hostinza' ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_bg_color',
    'label'       => esc_html__( 'Background color', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.xs-footer-section .xs-footer-bottom-layer',
            'property'	=> 'background-color',
        ),
        array(
            'element' 	=> '.footer-copyright',
            'property'	=> 'background-color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_text_color',
    'label'       => esc_html__( 'Text color', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> '.footer-copyright .copyright-text p',
            'property'	=> 'color',
        ),
        array(
            'element' 	=> '.copyright-text.copyright-text-style-2 p',
            'property'	=> 'color',
        ), array(
            'element' 	=> 'footer.xs-footer-section.footer-group p',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
);

$fields[] = array(
    'type'        => 'color',
    'settings'    => 'copyright_link_color',
    'label'       => esc_html__( 'Link color', 'hostinza' ),
    'section'     => 'footer_section',
    'transport'   => 'auto',
    'output'      => array(
        array(
            'element' 	=> 'footer.xs-footer-section.footer-group .copyright-text p a',
            'property'	=> 'color',
        ),
    ),
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
);


$fields[] = array(

    'type'        => 'repeater',
    'label'       => esc_attr__( 'Social Control', 'hostinza' ),
    'section'     => 'footer_section',
    'priority'    => 10,
    'row_label' => array(
        'type' => 'text',
        'value' => esc_attr__('Social Profile', 'hostinza' ),
    ),
    'settings'    => 'footer_social_links',
    'default'     => array(
        array(
            'social_icon' => '',
            'social_url'  => '',
        ),
    ),
    'fields' => array(
        'social_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social Icon', 'hostinza' ),
            'default'     => '',
        ),
        'social_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social URL', 'hostinza' ),
            'default'     => '',
        ),

    ),
    'required'      => array(
        array(
            'setting'   => 'footer_style',
            'operator'  => '==',
            'value'     => 1,
        ),
    ),
);