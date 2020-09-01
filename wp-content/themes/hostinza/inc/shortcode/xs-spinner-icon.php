<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Spinner_Icon_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-spinner-icon';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Spinner Icon', 'hostinza' );
    }

    public function get_icon() {
        return 'eicon-insert-image';
    }

    public function get_categories() {
        return [ 'hostinza-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Hostinza Spinner Icon', 'hostinza'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' =>esc_html__( 'Image', 'hostinza' ),
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
                'label' =>esc_html__( 'Image Size', 'hostinza' ),
                'default' => 'full',
            ]
        );

        $this->end_controls_section();


    }

    protected function render( ) {
    	
        $settings = $this->get_settings();
        ?>
        <div class="spinner-icon wow">
            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
        </div>
        
        <?php
    }



    protected function _content_template() { }
}