<?php
namespace Elementor;


class Elementskit_Widget_Caldera_Forms_Handler extends \ElementsKit_Lite\Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-caldera-forms';
    }

    static function get_title() {
        return esc_html__( 'Caldera Forms', 'elementskit-lite' );
    }

    static function get_icon() {
        return 'eicon-mail ekit-widget-icon';
    }

    static function get_categories() {
        return [ 'elementskit-lite' ];
    }

    static function get_dir() {
        return \ElementsKit_Lite::widget_dir() . 'caldera-forms/';
    }

    static function get_url() {
        return \ElementsKit_Lite::widget_url() . 'caldera-forms/';
    }
}