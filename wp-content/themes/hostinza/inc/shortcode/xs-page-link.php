<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Xs_Page_List_Widget extends Widget_Base
{

    public $base;

    public function get_name()
    {
        return 'xs-woo-page-list-link';
    }

    public function get_title()
    {
        return esc_html__('Hostinza Page Link', 'hostinza');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
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
                'label' => esc_html__('Page Link', 'hostinza'),
            ]
        );

        $this->add_control(
            'show_pages',
            [
                'label' => esc_html__('Show Page', 'hostinza'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'hostinza'),
                'label_off' => esc_html__('No', 'hostinza'),
                'default' => 'yes',
            ] 
        );

        $this->add_control(
            'xs_page_link',
            [
                'label' => esc_html__('Select Page', 'hostinza'),
                'type' => Custom_Controls_Manager::AJAXSELECT2,
                'options' => 'page_list',
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'show_pages' => 'yes'
                ], 
            ]
        );

        $this->add_control(
            'custom_link',
            [
                'label' => esc_html__('Custom Link', 'hostinza'),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'title' => esc_html__('Add Label', 'hostinza'),
                        'link' => esc_html__('#', 'hostinza'),
                        'icon' => '',
                    ],
                ],
                'fields' => [

                    [
                        'name' => 'title',
                        'label' => esc_html__('Link Label', 'hostinza'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Add Label', 'hostinza'),
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__('Link', 'hostinza'),
                        'type' => Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'icon',
                        'label' => esc_html__('Icon', 'hostinza'),
                        'type' => Controls_Manager::TEXT,
                    ],

                ],
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'show_pages!' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $show_pages = $settings['show_pages'];
        if ($show_pages) {
            $link = $settings['xs_page_link'];
        } else {
            $link = $settings['custom_link'];
        }

        ?>
        <ul class="xs-icon-menu">
            <?php
            if (is_array($link) && !empty($link)) {
                foreach ($link as $links) {
                    if(!$show_pages){
                        $label = (isset($links['title']) ? $links['title'] : '');
                        $xs_link = (isset($links['link']) ? $links['link'] : '');
                        $xs_icon = (isset($links['icon']) ? $links['icon'] : '');
                    }else{
                        $xs_link = get_the_permalink($links);
                        $label = get_the_title($links);
                    }
                    ?>
                    <?php if ($xs_link): ?>
                        <li class="single-menu-item">
                            <a href="<?php echo esc_url($xs_link); ?>">
                                <?php if ($xs_icon): ?>
                                <i class="<?php echo esc_attr($xs_icon);?>"></i>
                                <?php endif; ?>
                                <?php echo esc_html($label); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php
                }
            }
            ?>
        </ul>
        <?php
    }

    protected function _content_template()
    {
    }
}