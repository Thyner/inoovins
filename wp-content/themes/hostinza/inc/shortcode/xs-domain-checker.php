<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit;

class Xs_Domain_Checker_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'xs-domain-checker';
    }

    public function get_title()
    {
        return esc_html__('Hostinza Ajax Domain Checker', 'hostinza');
    }

    public function get_icon()
    {
        return 'eicon-type-tool';
    }

    public function get_categories()
    {
        return ['hostinza-elements'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_tab', [
                'label' => esc_html__('Hostinza Ajax Doamin Checker', 'hostinza'),
            ]
        );

        $this->add_control(
            'btn_text', [
                'label' => esc_html__('Button Text', 'hostinza'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Checker', 'hostinza'),
                'default' => esc_html__('checker', 'hostinza'),
            ]
        );

        $this->add_control(
            'domains_info',
            [
                'label' => esc_html__( 'Domains info', 'hostinza' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'domain_title' => esc_html__( 'com', 'hostinza' ),
                        'domain_price' => esc_html__( '$2.95', 'hostinza' ),
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'domain_title',
                        'label' => esc_html__( 'Domain Title', 'hostinza' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'com', 'hostinza' ),
                        'placeholder' => esc_html__( 'com', 'hostinza' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'domain_price',
                        'label' => esc_html__( 'Domain Price', 'hostinza' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( '$2.95', 'hostinza' ),
                        'placeholder' => esc_html__( '$2.95', 'hostinza' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'domain_image',
                        'label' => esc_html__('Domain Image', 'hostinza'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => '',
                        ],
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ domain_title }}}',
            ]
        );

        $this->end_controls_section();

        //Style Section
        $this->start_controls_section(
            'section_title_style', [
                'label' => esc_html__('Style', 'hostinza'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_color', [
                'label' => esc_html__('Button Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain-checker-form input[type="submit"]' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .domain-checker-form button[type="submit"]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_color', [
                'label' => esc_html__('Button Hover Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain-checker-form input[type="submit"]:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .domain-checker-form button[type="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color', [
                'label' => esc_html__('Button Bg Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain-checker-form button[type="submit"]' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color', [
                'label' => esc_html__('Button Bg Hover Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain-checker-form button[type="submit"]:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'domain_price_color', [
                'label' => esc_html__('Domain price color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-domain-info li strong' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $btn_text = $settings['btn_text'];
        $domains_info = $settings['domains_info'];

        echo do_shortcode('[wpdomainchecker button="'.$btn_text.'"]');
        if (is_array($domains_info) && !empty($domains_info)):
            ?><ul class="xs-domain-info"><?php
            foreach ($domains_info as $key => $item) : ?>

                <li>
                    <img src="<?php echo esc_url($item['domain_image']['url']) ?>" alt="<?php echo esc_attr(hostinza_get_alt_name($item['domain_image']['id'])) ?>" draggable="false">
                    <strong><?php echo wp_kses_post($item['domain_price']); ?></strong>
                </li>

            <?php endforeach;
            ?></ul><?php
        endif;
    }

    protected function _content_template()
    {

    }
}
