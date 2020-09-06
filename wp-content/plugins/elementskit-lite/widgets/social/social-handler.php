<?php
namespace Elementor;


class Elementskit_Widget_Social_Handler extends \ElementsKit_Lite\Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-social-media';
    }

    static function get_title() {
        return esc_html__( 'Social Media', 'elementskit-lite' );
    }

    static function get_icon() {
        return 'eicon-social-icons ekit-widget-icon ';
    }

    static function get_categories() {
        return ['elementskit-lite'];
    }

    static function get_dir() {
        return \ElementsKit_Lite::widget_dir() . 'social/';
    }

    static function get_url() {
        return \ElementsKit_Lite::widget_url() . 'social/';
    }

}