<?php

namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit;

class XS_Domain_Pricing_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-domain-pricing';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Domain pricing', 'hostinza' );
    }

    public function get_icon() {
        return 'eicon-insert-image';
    }

    public function get_categories() {
        return [ 'hostinza-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'domain_pricing',
            [
                'label' => esc_html__('Domain pricing', 'hostinza'),
            ]
        );

        $this->add_control(

            'items',
            [
                'label' => esc_html__('Domain pricing', 'hostinza'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'name' => '',
                        'icon' => '',
                        'register' => '',
                        'transfer' => '',
                        'renew' => '',
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'use_tld_img',
                        'label' => esc_html__('Use image for TLD?', 'hostinza'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => 'yes',
                        'label_off' => 'no',
                        'default' => 'yes',
                    ],
                    [
                        'name' => 'name',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Domain Name', 'hostinza'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'icon',
                        'label' =>esc_html__( 'Domain Image', 'hostinza' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'condition' => [
							'use_tld_img' => 'yes',
						],
                    ],
                    [
                        'name' => 'register',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Register', 'hostinza'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'transfer',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Transfer', 'hostinza'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'renew',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Renew', 'hostinza'),
                        'label_block' => true,
                    ],

                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' 	=> esc_html__( 'Styles', 'hostinza' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'table_heading_bg_color',
                'selector' => '{{WRAPPER}} .xs-table .domain-pricing-header tr'
            )
        );

        $this->add_control(
            'table_title_color',
            [
                'label'		=> esc_html__( 'Table Content Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-table .domain-pricing-header tr th' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'table_content_color',
            [
                'label'		=> esc_html__( 'Table Content Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-table tbody tr td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $items = $settings['items'];
        
        require HOSTINZA_SHORTCODE_DIR_STYLE .'/price-table/style6.php';
        
    }


    protected function _content_template() { }
}