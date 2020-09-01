<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class XS_Price_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-price';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Pricing Table', 'hostinza' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'hostinza-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'pricing_plan',
            [
                'label' => esc_html__('Pricing Plans', 'hostinza'),
            ]
        );
        $this->add_control(

            'columns', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Number of columns', 'hostinza'),
                'default' => '3',
                'options' => [
                    '2' => esc_html__('2', 'hostinza'),
                    '3' => esc_html__('3', 'hostinza'),
                    '4' => esc_html__('4', 'hostinza'),
                ],
            ]
        );
        $this->add_control(
            'monthly_pricing_table',
            [
                'label' => esc_html__( 'Monthly Package', 'hostinza' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Monthly','hostinza'),
            ]
        );

        $this->add_control(
            'yearly_pricing_table',
            [
                'label' => esc_html__( 'Yearly Package', 'hostinza' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Yearly','hostinza'),
            ]
        );

        /*Pricing Table Style 1*/
        $this->add_control(
            'monthly_table_name',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'table_title' => esc_html__('Cloud Hosting','hostinza'),
                    ]

                ],
                'fields' => [
                    [
                        'name' => 'xs_featured_table',
                        'type' => Controls_Manager::SWITCHER,
                        'label' => esc_html__('Do you want to feature it?', 'hostinza'),
                        'label_block'       => true,
                        'default' => 'label_off',
                        'label_on' => esc_html__( 'Yes', 'hostinza' ),
                        'label_off' => esc_html__( 'No', 'hostinza' ),
                    ],

                    [
                        'name' => 'table_title',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Table Title', 'hostinza'),
                        'default'   =>  esc_html__('Cloud Hosting','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_sub_title',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__('Table Sub Title', 'hostinza'),
                        'default'   =>  esc_html__('The High performance cloud platform ever','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_extra',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Starting at', 'hostinza'),
                        'default'   =>  esc_html__('Starting at','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_image',
                        'type' => Controls_Manager::MEDIA,
                        'label' => esc_html__('Table Image', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_content',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__('Table Content', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'currency_icon',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Currency', 'hostinza'),
                        'default'   => '$',
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_price',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Price', 'hostinza'),
                        'default'   => esc_html__('29.99', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_duration',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Duration', 'hostinza'),
                        'default'   => esc_html__('Month', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'button_text',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Button Text', 'hostinza'),
                        'default'   => esc_html__('Buy Now', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name'          => 'button_url',
                        'type'          => Controls_Manager::URL,
                        'label'         => esc_html__('Button URL', 'hostinza'),
                        'placeholder'   => esc_url('http://example.com'),
                        'label_block'   => true,
                    ],

                ],
                'title_field' => '{{{ table_title }}}',
            ]
        );

        /*Yearly Package Repeater*/
        $this->add_control(
            'yearly_table_name',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'table_title' => esc_html__('Cloud Hosting','hostinza'),
                    ]

                ],
                'fields' => [
                    [
                        'name' => 'xs_featured_table',
                        'type' => Controls_Manager::SWITCHER,
                        'label' => esc_html__('Do you want to feature it?', 'hostinza'),
                        'label_block'       => true,
                        'default' => 'label_off',
                        'label_on' => esc_html__( 'Yes', 'hostinza' ),
                        'label_off' => esc_html__( 'No', 'hostinza' ),
                    ],

                    [
                        'name' => 'table_top_image',
                        'type' => Controls_Manager::MEDIA,
                        'label' => esc_html__('Table Top Image', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_title',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Table Title', 'hostinza'),
                        'default'   =>  esc_html__('Cloud Hosting','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_sub_title',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__('Table Sub Title', 'hostinza'),
                        'default'   => esc_html__('The High performance cloud platform ever','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_extra',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Starting at', 'hostinza'),
                        'default'   => esc_html__('Starting at','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_content',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__('Table Content', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'currency_icon',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Currency', 'hostinza'),
                        'default'   => '$',
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_price',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Price', 'hostinza'),
                        'default'   => '29.99',
                        'label_block' => true,
                    ],

                    [
                        'name' => 'table_duration',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Duration', 'hostinza'),
                        'default'   => esc_html__('Month', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'button_text',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Button Text', 'hostinza'),
                        'default'   => 'Buy Now',
                        'label_block' => true,
                    ],

                    [
                        'name'          => 'button_url',
                        'type'          => Controls_Manager::URL,
                        'label'         => esc_html__('Button URL', 'hostinza'),
                        'placeholder'   => esc_url('http://example.com'),
                        'label_block'   => true,
                    ],

                ],
                'title_field' => '{{{ table_title }}}',
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

        $this->add_control(
            'table_title_color',
            [
                'label'		=> esc_html__( 'Table Title Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing .pricing-header .xs-title' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'table_sub_title_color',
            [
                'label'		=> esc_html__( 'Table Sub Title Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-body > p' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'table_extra_color',
            [
                'label'		=> esc_html__( 'Table Extra Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-body .pricing-price > p' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tab_price_color',
            [
                'label'		=> esc_html__( 'Price Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-body h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_price_content_color',
            [
                'label'		=> esc_html__( 'Table Content Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .discount-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_price_btn_color',
            [
                'label'		=> esc_html__( 'Button Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_btn_hover_color',
            [
                'label'		=> esc_html__( 'Button Hover Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_price_btn_bg',
            [
                'label'		=> esc_html__( 'Button BG Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_btn_hover_bg',
            [
                'label'		=> esc_html__( 'Button Hover BG Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:hover::before ' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        /*Featured Table*/

        $this->start_controls_section(
            'section_featured_title_style',
            [
                'label' 	=> esc_html__( 'Featured Table Style', 'hostinza' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'featured_bg_color',
                'selector' => '{{WRAPPER}} .xs-single-pricing.active',
            )
        );

        $this->add_control(
            'table_featured_title_color',
            [
                'label'		=> esc_html__( 'Table Title Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .pricing-header .xs-title' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'table_featured_sub_title_color',
            [
                'label'		=> esc_html__( 'Table Sub Title Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .pricing-body > p' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'table_featured_extra_color',
            [
                'label'		=> esc_html__( 'Table Extra Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .pricing-body .pricing-price > p' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tab_featured_price_color',
            [
                'label'		=> esc_html__( 'Price Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .pricing-body h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_featured_price_content_color',
            [
                'label'		=> esc_html__( 'Table Content Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .discount-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_featured_price_btn_color',
            [
                'label'		=> esc_html__( 'Button Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .btn-primary' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_featured_btn_hover_color',
            [
                'label'		=> esc_html__( 'Button Hover Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .btn-primary:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_featured_price_btn_bg',
            [
                'label'		=> esc_html__( 'Button BG Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .btn-primary' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_featured_btn_hover_bg',
            [
                'label'		=> esc_html__( 'Button Hover BG Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-pricing.active .btn-primary:hover::before ' => 'background-color: {{VALUE}} !important;;'
                ],
            ]
        );

        $this->end_controls_section();

        /*Switch Table*/

        $this->start_controls_section(
            'section_switch_style',
            [
                'label' 	=> esc_html__( 'Switch Style', 'hostinza' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'switch_bg_color',
            [
                'label'		=> esc_html__( 'Switch BG Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-pricing-group .main-nav-tab' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'switch_color',
            [
                'label'		=> esc_html__( 'Switch Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-pricing-group .main-nav-tab li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'switch_on_bg_color',
            [
                'label'		=> esc_html__( 'Switch On BG Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-swipe .indicator' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'switch_on_color',
            [
                'label'		=> esc_html__( 'Switch On Color', 'hostinza' ),
                'type'		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-pricing-group .main-nav-tab li a.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();


        $monthly = $settings['monthly_pricing_table'];
        $columns = $settings['columns'];
        $yearly = $settings['yearly_pricing_table'];

        $monthly_table = $settings['monthly_table_name'];
        $yearly_table = $settings['yearly_table_name'];

        if($columns == '4'){
            $grid = 'grid col-lg-3';
        }elseif($columns == '3'){
            $grid = 'grid col-lg-4';
        }else{
            $grid = 'grid col-lg-6';
        }
        /*General Package Contents*/
        require HOSTINZA_SHORTCODE_DIR_STYLE .'/price-table/style1.php';
               

    }


    protected function _content_template() { }
}