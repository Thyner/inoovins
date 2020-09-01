<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class Xs_Heading_Widget extends Widget_Base {

	public function get_name() {
		return 'xs-heading';
	}

	public function get_title() {
		return esc_html__( 'Hostinza Heading', 'hostinza' );
	}

	public function get_icon() {
		return 'eicon-type-tool';
	}

	public function get_categories() {
		return [ 'hostinza-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' =>esc_html__( 'Hostinza Heading', 'hostinza' ),
			]
		);


		$this->add_control(
			'title_text', [
				'label'			 =>esc_html__( 'Heading Title', 'hostinza' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Best Hosting', 'hostinza' ),
				'default'		 =>esc_html__( 'Best Hosting', 'hostinza' ),
			]
		);
 
		$this->add_control(
			'sub_title', [
				'label'			 =>esc_html__( 'Heading Sub Title', 'hostinza' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'MarketPress Collections', 'hostinza' ),
				'default'		 =>esc_html__( 'WHY CHOOSE US', 'hostinza' ),
			]
		);


		$this->add_responsive_control(
			'title_align', [
				'label'			 =>esc_html__( 'Alignment', 'hostinza' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'hostinza' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'hostinza' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'hostinza' ),
						'icon'	 => 'fa fa-align-right',
					],
					'justify'	 => [
						'title'	 =>esc_html__( 'Justified', 'hostinza' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-heading' => 'text-align: {{VALUE}};'
                ],
			]
		);
		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'section_title_style', [
				'label'	 => esc_html__( 'Title', 'hostinza' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color_one', [
				'label'		 =>esc_html__( 'Title color', 'hostinza' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .xs-heading .heading-title' => 'color: {{VALUE}};'
				],
			]
		);

        $this->add_control(
            'title_color_two', [
                'label'		 => esc_html__( 'color Two', 'hostinza' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-heading .heading-title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'hostinza' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-heading .heading-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .xs-heading .heading-title',
			]
		);

		$this->end_controls_section();

		//Subtitle Style Section
		$this->start_controls_section(
			'section_subtitle_style', [
				'label'	 => esc_html__( 'Sub Title', 'hostinza' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color', [
				'label'		 => esc_html__( 'color', 'hostinza' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .xs-heading .heading-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'subtitle_typography',
			'selector'	 => '{{WRAPPER}} .xs-heading .heading-sub-title',
			]
		);

        $this->add_control(
            'subtitle_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'hostinza' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-heading .heading-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$style = 'style1';
		$title = $settings[ 'title_text' ];
		$sub_title = $settings[ 'sub_title' ];

		switch ( $style ) {
			case 'style1':
				require HOSTINZA_SHORTCODE_DIR_STYLE . '/heading/style1.php';
				break;
		}
	}

	protected function _content_template() {
		
	}
}
