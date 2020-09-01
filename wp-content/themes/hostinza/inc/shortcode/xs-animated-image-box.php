<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Xs_Animated_Image_Box_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'xs-animated-image-box';
    }

    public function get_title()
    {
        return esc_html__('Hostinza Animated Image Box', 'hostinza');
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
                'label' => esc_html__('Hostinza Animeted Image', 'hostinza'),
            ]
        );

        $this->add_control(
            'main_image',
            [
                'label' => esc_html__('Main Image', 'hostinza'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'animated_image_one',
            [
                'label' => esc_html__('Animated Image One', 'hostinza'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'animated_image_two',
            [
                'label' => esc_html__('Animated Image Two', 'hostinza'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'animated_image_three',
            [
                'label' => esc_html__('Animated Image Three', 'hostinza'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'animated_image_four',
            [
                'label' => esc_html__('Animated Image Four', 'hostinza'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings();
        $main_image = $settings['main_image'];
        $animated_image_one = $settings['animated_image_one'];
        $animated_image_two = $settings['animated_image_two'];
        $animated_image_three = $settings['animated_image_three'];
        $animated_image_four = $settings['animated_image_four'];

        ?>
        <div class="hosting-info-img">
            <?php if (!empty($main_image['url'])): ?>
                <img src="<?php echo esc_url($main_image['url']); ?>"
                     alt="<?php echo esc_attr(hostinza_get_alt_name($main_image['id'])) ?>">
            <?php endif; ?>

            <?php if (!empty($animated_image_one['url'])): ?>
                <img src="<?php echo esc_url($animated_image_one['url']); ?>" class="info-icon icon-1"
                     alt="<?php echo esc_attr(hostinza_get_alt_name($animated_image_one['id'])) ?>">
            <?php endif; ?>

            <?php if (!empty($animated_image_two['url'])): ?>
                <img src="<?php echo esc_url($animated_image_two['url']); ?>" class="info-icon icon-2"
                     alt="<?php echo esc_attr(hostinza_get_alt_name($animated_image_two['id'])) ?>">
            <?php endif; ?>

            <?php if (!empty($animated_image_three['url'])): ?>
                <img src="<?php echo esc_url($animated_image_three['url']); ?>" class="info-icon icon-3"
                     alt="<?php echo esc_attr(hostinza_get_alt_name($animated_image_three['id'])) ?>">
            <?php endif; ?>

            <?php if (!empty($animated_image_four['url'])): ?>
                <img src="<?php echo esc_url($animated_image_four['url']); ?>" class="info-icon icon-4"
                     alt="<?php echo esc_attr(hostinza_get_alt_name($animated_image_four['id'])) ?>">
            <?php endif; ?>
        </div>
        <?php
    }


    protected function _content_template()
    {
    }
}