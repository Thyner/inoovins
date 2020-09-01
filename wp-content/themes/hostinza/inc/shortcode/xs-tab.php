<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Tabs_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-tab';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Tab', 'hostinza' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return ['hostinza-elements'];
    }

    protected function _register_controls() {

        /**
         *
         * Tabs
         *
         */

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'hostinza' ),
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__( 'Tabs Items', 'hostinza' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'tab_title' => esc_html__( 'Tab #1', 'hostinza' ),
                        'title_image' => Utils::get_placeholder_image_src(),
                        'tab_content' => esc_html__( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'hostinza' ),
                        'content_image' => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'tab_title' => esc_html__( 'Tab #2', 'hostinza' ),
                        'title_image' => Utils::get_placeholder_image_src(),
                        'tab_content' => esc_html__( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'hostinza' ),
                        'content_image' => Utils::get_placeholder_image_src(),
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'tab_title',
                        'label' => esc_html__( 'Title', 'hostinza' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Tab Title', 'hostinza' ),
                        'placeholder' => esc_html__( 'Tab Title', 'hostinza' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'title_image',
                        'label' => esc_html__('Title Image', 'hostinza'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'tab_content',
                        'label' => esc_html__( 'Content', 'hostinza' ),
                        'default' => esc_html__( 'Tab Content', 'hostinza' ),
                        'placeholder' => esc_html__( 'Tab Content', 'hostinza' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'show_label' => true,
                    ],
                    [
                        'name' => 'content_image',
                        'label' => esc_html__('Content Image', 'hostinza'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
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

        $this->add_control(
            'center_bg_color',
            [
                'label' => esc_html__( 'Center BG Color', 'hostinza' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-testimonial-slider .owl-item .xs-testimonial-item::before, .xs-testimonial-slider .owl-item .xs-testimonial-item::after, .xs-testimonial-slider .owl-item .xs-testimonial-item ' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'other_bg_color',
            [
                'label' => esc_html__( 'Other BG Color', 'hostinza' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item, .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item::before, .xs-testimonial-slider .owl-item:not(.center) .xs-testimonial-item::after' => 'background-color: {{VALUE}};'
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

        $tabs_item = $settings['tabs'];

        $styles = 'style1';

        switch ($styles){
            case 'style1':
                require HOSTINZA_SHORTCODE_DIR_STYLE .'/tabs/style1.php';
                break;
        }

    }

    protected function _content_template() { }
}