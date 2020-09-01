<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Xs_Call_To_action_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'xs-call-to-action-box';
    }

    public function get_title()
    {
        return esc_html__('Hostinza Call To Action', 'hostinza');
    }

    public function get_icon()
    {
        return 'eicon-insert-image';
    }

    public function get_categories()
    {
        return ['hostinza-elements'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Call To Action', 'hostinza'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'hostinza'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'label' => esc_html__('Image Size', 'hostinza'),
                'default' => 'full',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'hostinza'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('99.9% Uptime Guarantee', 'hostinza'),
                'default' => esc_html__('Add Title', 'hostinza'),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'hostinza'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('Share processes and data secure lona need to know basis', 'hostinza'),

            ]
        );

        $this->add_control(
            'link_title',
            [
                'label' => esc_html__('Link Text', 'hostinza'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Learn More', 'hostinza'),
                'default' => esc_html__('Learn More', 'hostinza'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'hostinza'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => '#',
                'default' => '#',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_tab',
            [
                'label' => esc_html__('General', 'hostinza'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'general_bg_color',
                'selector' => '{{WRAPPER}} .xs-feature-group',
            )
        );

        $this->end_controls_section();
        /**
         *
         *Title Style
         *
         */

        $this->start_controls_section(
            'section_title_tab',
            [
                'label' => esc_html__('Title', 'hostinza'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-feature-group .xs-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'hostinza'),
                'selector' => '{{WRAPPER}} .xs-feature-group .xs-title',
            ]
        );

        $this->end_controls_section();


        /**
         *
         *Sub Title Style
         *
         */

        $this->start_controls_section(
            'section_sub_title_tab',
            [
                'label' => esc_html__('Sub Title', 'hostinza'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__('Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-feature-group p ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => esc_html__('Typography', 'hostinza'),
                'selector' => '{{WRAPPER}} .xs-feature-group p',
            ]
        );

        $this->end_controls_section();

        /**
         *
         *Link Style
         *
         */

        $this->start_controls_section(
            'section_link_tab',
            [
                'label' => esc_html__('Link Style', 'hostinza'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => esc_html__('Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__('Hover Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary:hover ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_bg_color',
            [
                'label' => esc_html__('BG Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary ' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_bg_hover_color',
            [
                'label' => esc_html__('Hover BG Color', 'hostinza'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-feature-group .btn-secondary:hover::before ' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings();
        $title = $settings['title'];
        $sub_title = $settings['sub_title'];
        $link_title = $settings['link_title'];
        $link = $settings['link'];
        ?>
        <div class="xs-feature-group">
            <div class="media">
                <div class="feature-img d-flex">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings); ?>
                </div>
                <div class="media-body feature-content">
                    <h4 class="xs-title"><?php echo esc_html($title); ?></h4>
                    <p><?php echo hostinza_kses($sub_title); ?></p>
                    <div class="xs-btn-wraper">
                        <a href="<?php echo esc_url($link); ?>" class="btn btn-secondary"><?php echo esc_html($link_title); ?></a>
                    </div>
                </div>
            </div>
            <span class="icon icon-dollar watermark-icon"></span>
        </div><!-- .xs-feature-group END -->
        <?php
    }


    protected function _content_template()
    {
    }
}