<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit;

class Xs_Domain_Search_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'xs-domain-search';
    }

    public function get_title()
    {
        return esc_html__('Hostinza Domain Search', 'hostinza');
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
                'label' => esc_html__('Hostinza Doamin Search', 'hostinza'),
            ]
        );


        $this->add_control(
            'whmcs_url', [
                'label' => esc_html__('WHMCS URL', 'hostinza'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_url('wp.xpeedstudio.com/hostinza/whmcs-bridge', 'hostinza'),
                'default' => esc_html__('wp.xpeedstudio.com/hostinza/whmcs-bridge', 'hostinza'),
            ]
        );

        $this->add_control(
            'btn_text', [
                'label' => esc_html__('Button Text', 'hostinza'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Search', 'hostinza'),
                'default' => esc_html__('search', 'hostinza'),
            ]
        );


        $this->add_control(
            'domains',
            [
                'label' => esc_html__( 'Domains title for search filter', 'hostinza' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'domain_title' => esc_html__( 'com', 'hostinza' ),
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Domain Title', 'hostinza' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'com', 'hostinza' ),
                        'placeholder' => esc_html__( 'com', 'hostinza' ),
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ title }}}',
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
                        'domain_image' => Utils::get_placeholder_image_src(),
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
                            'url' => Utils::get_placeholder_image_src(),
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
                    '{{WRAPPER}} .domain-search-form input[type="submit"]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_color', [
                'label' => esc_html__('Button Hover Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain-search-form input[type="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color', [
                'label' => esc_html__('Button Bg Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain-search-form input[type="submit"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color', [
                'label' => esc_html__('Button Bg Hover Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain-search-form input[type="submit"]:hover' => 'background-color: {{VALUE}};',
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
        $whmcs_url = $settings['whmcs_url'];
        $domains_info = $settings['domains_info'];
        $domains = $settings['domains'];

        if(isset($_POST['submit_query'])){
            $query = $_POST['query'].'.'.$_POST['ext'];
        }
        if (!empty($whmcs_url)) {
            $whmcs_url = $whmcs_url;
        } else {
            $whmcs_url = 'wp.xpeedstudio.com/hostinza/whmcs-bridge/';
        }
        ?>
        <form action="<?php echo esc_url($whmcs_url);?>" method="GET" class="domain-search-form">
            <input type="search" name="domain_query" placeholder="<?php  echo esc_attr__('Enter Address','hostinza');?>">
            <div class="select-group">
                <select class="xs-domain-search" name="ext">
                    <?php
                    if (is_array($domains) && !empty($domains)):
                        foreach ($domains as $key => $item) : ?>
                        <option value="<?php echo esc_html($item['title']); ?>" selected>.<?php echo esc_html($item['title']); ?></option>
                        <?php endforeach;
                    endif;
                    ?>
                    
                </select>
                <input type="hidden" name="query" value="">
                <input type="hidden" name="ccce" value="cart">
                <input type="hidden" name="a" value="add">
                <input type="hidden" name="domain" value="register">
                <input type="hidden" name="systpl" value="six">
                <input type="submit" name="submit_query" value="<?php echo esc_html($btn_text); ?>">
            </div>
        </form>
        <?php
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
