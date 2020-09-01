<?PHP

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Logo_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-partner';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Logo Carousel', 'hostinza' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'hostinza-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Hostinza Logo Carousel', 'hostinza'),
            ]
        );

        $this->add_control(
            'logo',
            [
                'label' => esc_html__('Slider', 'hostinza'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'image' => Utils::get_placeholder_image_src(),
                        'link' => esc_html__('#', 'hostinza'),
                    ],

                    [
                        'image' => Utils::get_placeholder_image_src(),
                        'link' => esc_html__('#', 'hostinza'),

                    ],

                    [
                        'image' => Utils::get_placeholder_image_src(),
                        'link' => esc_html__('#', 'hostinza'),

                    ],
                ],
                'fields' => [

                    [
                        'name' => 'image',
                        'label' => esc_html__('Image', 'hostinza'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'link',
                        'label' => esc_html__('Link', 'hostinza'),
                        'type' => Controls_Manager::URL,
                    ],

                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $logo = $settings['logo'];
        ?>
        <div class="xs-client-slider owl-carousel">
            <?php if(is_array($logo)): ?>
                <?php foreach($logo as $logos): ?>
                    <?php $btn_link = (! empty( $logos['link']['url'])) ? $logos['link']['url'] : ''; ?>
                    <?php $btn_target = ( $logos['link']['is_external']) ? '_blank' : '_self'; ?>
                    <?php if(!empty($logos['image']['url'])): ?>
                        <?php
                        if(!empty($logos['image']['id'])){
                            $alt = get_post_meta($logos['image']['id'], '_wp_attachment_image_alt', true);
                            if(!empty($alt)) {
                                $alt = $alt;
                            }else{
                                $alt = get_the_title($logos['image']['id']);
                            }
                        }
                        ?>
                        <div class="single-client">
                            <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_attr( $btn_target ); ?>"> <img src="<?php echo esc_url($logos['image']['url'])?>" alt="<?php echo esc_attr($alt); ?>"></a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() { }
}