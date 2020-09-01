<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Icon_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-icon-box';
    }

    public function get_title() {
        return esc_html__( 'Hostinza Icon Box', 'hostinza' );
    }

    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_categories() {
        return [ 'hostinza-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Hostinza Icon Box', 'hostinza'),
            ]
        );

        $this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'hostinza' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-check',
			]
		);

        $this->add_control(
            'title',
            [
                'label' =>esc_html__( 'Title', 'hostinza' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( '99.9% Uptime Guarantee', 'hostinza' ),
                'default' =>esc_html__( 'Add Title', 'hostinza' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' =>esc_html__( 'Sub Title', 'hostinza' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Share processes and data secure lona need to know basis', 'hostinza' ),
                
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label' =>esc_html__( 'Read More Text', 'hostinza' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Read More', 'hostinza' ),
                
            ]
        );

        $this->add_control(
            'read_more_link',
            [
                'label' =>esc_html__( 'Read More Link', 'hostinza' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '#',
            ]
        );

        $this->end_controls_section();

        /**
		 *
		 *Icon Style
		 *
		*/

        $this->start_controls_section(
			'section_icon_tab',
			[
				'label' =>esc_html__( 'Icon', 'hostinza' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' =>esc_html__( 'Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-img i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' =>esc_html__( 'Typography', 'hostinza' ),
				'selector' => '{{WRAPPER}} .service-img i',
			]
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
				'label' =>esc_html__( 'Title', 'hostinza' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' =>esc_html__( 'Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} h4.xs-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' =>esc_html__( 'Typography', 'hostinza' ),
				'selector' => '{{WRAPPER}} h4.xs-title a',
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
				'label' =>esc_html__( 'Sub Title', 'hostinza' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label' =>esc_html__( 'Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xs-service-block p ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'label' =>esc_html__( 'Typography', 'hostinza' ),
				'selector' => '{{WRAPPER}} .xs-service-block p',
			]
		);

		$this->end_controls_section();

		/**
		 *
		 *Read More Style
		 *
		*/

        $this->start_controls_section(
			'section_read_more_tab',
			[
				'label' =>esc_html__( 'Read More', 'hostinza' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' =>esc_html__( 'Color', 'hostinza' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xs-service-block .simple-btn ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'label' =>esc_html__( 'Typography', 'hostinza' ),
				'selector' => '{{WRAPPER}} .xs-service-block .simple-btn',
			]
		);

		$this->end_controls_section();

    }

    protected function render( ) {
    	
        $settings = $this->get_settings();
        $title = $settings['title'];
        $sub_title = $settings['sub_title'];
        $read_more_text = $settings['read_more_text'];
        $read_more_link = $settings['read_more_link'];
        $icon = $settings['icon'];
        ?>


        <div class="xs-service-block">
            <div class="service-img">
                <i class="<?php echo esc_attr( $icon ); ?>"></i>
            </div>
            <h4 class="xs-title"><a href="<?php echo esc_url( $read_more_link ); ?>"><?php echo esc_html( $title ); ?></a></h4>
            <p><?php echo esc_html( $sub_title ); ?></p>
            <a href="<?php echo esc_url( $read_more_link ); ?>" class="simple-btn"><?php echo esc_html( $read_more_text ); ?></a>
        </div>
        <?php
    }



    protected function _content_template() { }
}