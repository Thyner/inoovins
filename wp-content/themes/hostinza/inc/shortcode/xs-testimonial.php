<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Testimonial_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-testimonial';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Testimonial', 'hostinza' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return ['hostinza-elements'];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
            'section_tab_style',
            [
                'label' => esc_html__('Hostinza Testimonial', 'hostinza'),
            ]
        );

        /**
         *
         * Testimonial Style selection
         *
         */
        $this->add_control(

            'style', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Choose Style', 'hostinza'),
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'hostinza'),
                    'style2' => esc_html__('Style 2', 'hostinza'),
                ],
            ]
        );

        $this->add_control(
            'testimonial',
            [
                'label' => esc_html__('Testimonial', 'hostinza'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'client_name' => esc_html__('Testimonial #1', 'hostinza'),
                        'review' => esc_html__('Our best-in-class WordPress solution with additio nal optiz ation to make an running a WooCommerce', 'hostinza'),
                        'designation' => esc_html__('CEO, Pranklin Agency', 'hostinza'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],

                    [
                        'client_name' => esc_html__('Testimonial #1', 'hostinza'),
                        'review' => esc_html__('Our best-in-class WordPress solution with additio nal optiz ation to make an running a WooCommerce', 'hostinza'),
                        'designation' => esc_html__('CEO, Pranklin Agency', 'hostinza'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],

                    [
                        'client_name' => esc_html__('Testimonial #1', 'hostinza'),
                        'review' => esc_html__('Our best-in-class WordPress solution with additio nal optiz ation to make an running a WooCommerce', 'hostinza'),
                        'designation' => esc_html__('CEO, Pranklin Agency', 'hostinza'),
                        'image' => Utils::get_placeholder_image_src(),
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'client_name',
                        'label' => esc_html__('Client Name', 'hostinza'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Testimonial #1', 'hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'review',
                        'label' => esc_html__('Testimonial', 'hostinza'),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],

                    [
                        'name' => 'designation',
                        'label' => esc_html__('Designation', 'hostinza'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],

                    [
                        'name' => 'image',
                        'label' => esc_html__('Image', 'hostinza'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],
                    
                ],
                
                'title_field' => '{{{ client_name }}}',
            ]
        );

        $this->end_controls_section();


        /**
         *
         * Genarel
         *
         */


        $this->start_controls_section(
            'section_genarel_style',
            [
                'label' => esc_html__('Genarel', 'hostinza'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'center_bg_color',
                'selector' => '{{WRAPPER}} .xs-testimonial-slider .owl-item .xs-testimonial-item::before, .xs-testimonial-slider .owl-item .xs-testimonial-item::after, .xs-testimonial-slider .owl-item .xs-testimonial-item '
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'other_bg_color',
                'selector' => '{{WRAPPER}} .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item, .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item::before, .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item::after'
            )
        );

        $this->add_control(
            'other_bg_opacity',
            [
                'label' => esc_html__( 'Other BG Opacity', 'hostinza' ),
                'type' => Controls_Manager::TEXT,
                'default' => '0.8',
                'selectors' => [
                    '{{WRAPPER}} .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item' => 'opacity: {{VALUE}};'
                ],
            ]
        );
        $this->end_controls_section();

        /**
         *
         * Client Name
         *
         */

        $this->start_controls_section(
            'section_name_style',
            [
                'label' => esc_html__('Name', 'hostinza'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__( 'Color', 'hostinza' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .commentor-bio .commentor-title ' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => esc_html__( 'Typography', 'hostinza' ),
                'selector' => ' {{WRAPPER}} .commentor-bio .commentor-title',
            ]
        );

        $this->end_controls_section();


        /**
         *
         * Designnation Name
         *
         */

        $this->start_controls_section(
            'section_deg_style',
            [
                'label' => esc_html__('designation', 'hostinza'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'deg_color',
            [
                'label' => esc_html__( 'Center Color', 'hostinza' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-testimonial-slider .owl-item.center .testimonial-content .commentor-info' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'deg_other_color',
            [
                'label' => esc_html__( 'Other Color', 'hostinza' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item p.commentor-info' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'deg_typography',
                'label' => esc_html__( 'Typography', 'hostinza' ),
                'selector' => ' {{WRAPPER}} .xs-testimonial-slider .owl-item.center .testimonial-content .commentor-info',
            ]
        );

        $this->end_controls_section();

        /**
         *
         * Testimonial
         *
         */
        

        $this->start_controls_section(
            'section_testimonial_style',
            [
                'label' => esc_html__('Testimonial', 'hostinza'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'tetimonial_color',
            [
                'label' => esc_html__( 'Color Center Text', 'hostinza' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'other_color',
            [
                'label' => esc_html__( 'Other Color', 'hostinza' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_typography',
                'label' => esc_html__( 'Typography', 'hostinza' ),
                'selector' => '{{WRAPPER}}.testimonial-content > p',
            ]
        );

        $this->end_controls_section();


    }

    protected function render( ) {

        $settings = $this->get_settings();


        $testimonials = $settings['testimonial'];

        $styles = $settings['style'];

        switch ($styles){

            case 'style1':
                require HOSTINZA_SHORTCODE_DIR_STYLE .'/testimonial/style1.php';
                break;

            case 'style2':
                require HOSTINZA_SHORTCODE_DIR_STYLE .'/testimonial/style2.php';
                break;
        }

    }

    protected function _content_template() { }
}