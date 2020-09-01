<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Button_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-button';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Button', 'hostinza' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'hostinza-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Button', 'hostinza'),
            ]
        );

        $this->add_control(
			'btn_text',
			[
				'label' =>esc_html__( 'Label', 'hostinza' ),
				'type' => Controls_Manager::TEXT,
				'default' =>esc_html__( 'Learn more ', 'hostinza' ),
				'placeholder' =>esc_html__( 'Learn more ', 'hostinza' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' =>esc_html__( 'Link', 'hostinza' ),
				'type' => Controls_Manager::URL,
				'placeholder' =>esc_html__('http://your-link.com','hostinza' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' =>esc_html__( 'Icon', 'hostinza' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' =>esc_html__( 'Icon Position', 'hostinza' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' =>esc_html__( 'Before', 'hostinza' ),
					'right' =>esc_html__( 'After', 'hostinza' ),
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'btn_align',
			[
				'label' =>esc_html__( 'Alignment', 'hostinza' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' =>esc_html__( 'Left', 'hostinza' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' =>esc_html__( 'Center', 'hostinza' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' =>esc_html__( 'Right', 'hostinza' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style',
			[
				'label' =>esc_html__( 'Button Style', 'hostinza' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label' =>esc_html__( 'Border Radius', 'hostinza' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '' ,
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .xs-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' =>esc_html__( 'Padding', 'hostinza' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' =>esc_html__( 'Typography', 'hostinza' ),
				'selector' => '{{WRAPPER}} a.xs-btn',
			]
		);

		$this->start_controls_tabs( 'xs_tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' =>esc_html__( 'Normal', 'hostinza' ),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label' =>esc_html__( 'Text Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label' =>esc_html__( 'Background Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_tab_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'hostinza' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label' =>esc_html__( 'Text Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.xs-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_bg_hover_color',
			[
				'label' =>esc_html__( 'Background Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-btn:before' => 'border-bottom: 100px solid {{VALUE}};',
					'{{WRAPPER}} .xs-btn:after' => 'border-top: 100px solid {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_hover_border_color',
			[
				'label' =>esc_html__( 'Border Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.xs-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);


        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();

        $btn_text = $settings['btn_text'];

		$btn_link = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';
		
		$btn_target = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';
		
        $this->add_render_attribute( 'icon-align', 'class', 'xs-button-icon xs-align-icon-' . $settings['icon_align'] );
        ?>
		<a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="xs-btn btn btn-primary">
			<span <?php echo hostinza_kses($this->get_render_attribute_string( 'icon-align' )); ?> ><i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i></span>
			<span class="xs-button-text"><?php echo esc_html( $btn_text ); ?></span>
		</a>
        <?php
    }

    protected function _content_template() { }
}