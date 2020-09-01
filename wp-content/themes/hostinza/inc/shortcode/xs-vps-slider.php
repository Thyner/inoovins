<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class XS_VPS_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-vps-slider';
    }

    public function get_title() {
        return esc_html__( 'Hostinza VPS Slider', 'hostinza' );
    }
 
    public function get_icon() {
        return 'eicon-insert-image';
    }

    public function get_categories() {
        return [ 'hostinza-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'vps_slider',
            [
                'label' => esc_html__('VPS Slider', 'hostinza'),
            ]
        );

        $this->add_control(

            'slider_items',
            [
                'label' => esc_html__('VPS Slider', 'hostinza'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [ 
                        'name' => esc_html__('Basic Pack','hostinza'),
                        'price' => esc_html__('$5.99','hostinza'),
                        'desc' => esc_html__('It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name','hostinza'),
                        'cpu' => esc_html__('1 Core','hostinza'),
                        'brandwidth' => esc_html__('100 BG','hostinza'),
                        'brandwidth2' => esc_html__('0.5 TB','hostinza'),
                        'ram' => esc_html__('1 TB','hostinza'),
                        'setup' => esc_html__('Paid','hostinza'),
                        'setup2' => esc_html__('Free','hostinza'),
                        'diskspace' => esc_html__('100 GB','hostinza'),
                        'ipOne' => esc_html__('Up to 1','hostinza'),
                        'ipTwo' => esc_html__('Up to 0','hostinza'),
                        'urlLink' => esc_url('http://whmcs.finesttheme.com/cart.php?a=add&pid=3'),
                    ]
                ],
                'fields' => [

                    [
                        'name' => 'name',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Slide Name', 'hostinza'),
                        'default'   =>  esc_html__('Basic','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'price',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Price', 'hostinza'),
                        'default'   =>  esc_html__('$5.99','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'desc',
                        'type' => Controls_Manager::TEXTAREA,
                        'label' => esc_html__('Description', 'hostinza'),
                        'default' => esc_html__('It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'cpu',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('CPU', 'hostinza'),
                        'default'   => esc_html__('1 Core','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'bandwidth',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Bandwidth', 'hostinza'),
                        'default'   => esc_html__('100 GB','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'bandwidth2',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Bandwidth Two', 'hostinza'),
                        'default'   => esc_html__('0.5 TB','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'ram',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('RAM', 'hostinza'),
                        'default'   => esc_html__('1 GB','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'setup',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Setup', 'hostinza'),
                        'default'   => esc_html__('Paid','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'setup2',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Setup Two', 'hostinza'),
                        'default'   => esc_html__('Free','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'diskspace',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Diskspace', 'hostinza'),
                        'default'   => esc_html__('100 GB','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'ipOne',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('IP One', 'hostinza'),
                        'default'   => esc_html__('Up to 1','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'ipTwo',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('IP Two', 'hostinza'),
                        'default'   => esc_html__('Up to 0','hostinza'),
                        'label_block' => true,
                    ],

                    [
                        'name'          => 'urlLink',
                        'type'          => Controls_Manager::URL,
                        'label'         => esc_html__('urlLink', 'hostinza'),
                        'placeholder'   => esc_url('http://whmcs.finesttheme.com/cart.php?a=add&pid=3'),
                        'label_block'   => true,
                    ],

                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $slider_items = $settings['slider_items'];
        foreach($slider_items as $slider_item){
            $sliderplans[0][] = $slider_item['name'];
            $sliderplans[1][] = $slider_item['price'];
            $sliderplans[2][] = $slider_item['desc'];
            $sliderplans[3][] = $slider_item['cpu'];
            $sliderplans[4][] = $slider_item['bandwidth'];
            $sliderplans[5][] = $slider_item['bandwidth2'];
            $sliderplans[6][] = $slider_item['ram'];
            $sliderplans[7][] = $slider_item['setup'];
            $sliderplans[8][] = $slider_item['setup2'];
            $sliderplans[9][] = $slider_item['diskspace'];
            $sliderplans[10][] = $slider_item['ipOne'];
            $sliderplans[11][] = $slider_item['ipTwo'];
            $sliderplans[12][] = $slider_item['urlLink']['url'];
        }
        
        require HOSTINZA_SHORTCODE_DIR_STYLE .'/price-table/style4.php';
        

        // Register the script
        wp_register_script( 'hostinza-vps-slider-settings', HOSTINZA_SCRIPTS . '/vps-slider-settings.js' );

        wp_localize_script( 'hostinza-vps-slider-settings', 'sliderplans', $sliderplans );

        // Enqueued script with localized data.
        wp_enqueue_script( 'hostinza-vps-slider-settings' );



    }


    protected function _content_template() { }
}