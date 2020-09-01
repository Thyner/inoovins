<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class XS_Locations_Widget extends Widget_Base {

	public function get_name() {
		return 'xs-locations';
	}

	public function get_title() {
		return esc_html__( 'Hostinza Locations', 'hostinza' );
	}

	public function get_icon() {
		return 'eicon-insert-image';
	}

	public function get_categories() {
		return [ 'hostinza-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
		'location', [
			'label' => esc_html__( 'Locations', 'hostinza' ),
		]
		);
		$this->add_control(
		'image', [
			'label'		 => esc_html__( 'Background Map Image', 'hostinza' ),
			'type'		 => Controls_Manager::MEDIA,
			'default'	 => [
				'url' => Utils::get_placeholder_image_src(),
			],
		]
		);
		/* Pricing Table Style 1 */
		$this->add_control(
		'locations', [
			'type'			 => Controls_Manager::REPEATER,
			'default'		 => [
				[
					'title' => esc_html__( 'South Carolina Data Center', 'hostinza' ),
				]
			],
			'fields'		 => [
				[
					'name'			 => 'title',
					'type'			 => Controls_Manager::TEXT,
					'label'			 => esc_html__( 'Title', 'hostinza' ),
					'default'		 => esc_html__( 'South Carolina Data Center', 'hostinza' ),
					'label_block'	 => true,
				],
				[
					'name'			 => 'address',
					'type'			 => Controls_Manager::TEXTAREA,
					'label'			 => esc_html__( 'Address', 'hostinza' ),
					'label_block'	 => true,
				],
				[
					'name'		 => 'left_pos',
					'label'		 => esc_html__( 'Left', 'hostinza' ),
					'type'		 => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'		 => [
						'px' => [
							'min'	 => 0,
							'max'	 => 100,
							'step'	 => 1,
						],
						'%'	 => [
							'min'	 => 0,
							'max'	 => 100,
							'step'	 => 1,
						],
					],
					'default'	 => [
						'unit'	 => '%',
						'size'	 => 50,
					],
					'selectors'	 => [
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
					],
				],
				[
					'name'		 => 'top_pos',
					'label'		 => esc_html__( 'Top', 'hostinza' ),
					'type'		 => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'		 => [
						'px' => [
							'min'	 => 0,
							'max'	 => 100,
							'step'	 => 1,
						],
						'%'	 => [
							'min'	 => 0,
							'max'	 => 100,
							'step'	 => 1,
						],
					],
					'default'	 => [
						'unit'	 => '%',
						'size'	 => 50,
					],
					'selectors'	 => [
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			],
			'title_field'	 => '{{{ title }}}',
		]
		);

		$this->end_controls_section();
		/**
		 *
		 * Title Style
		 *
		 */
		$this->start_controls_section(
		'section_indicator_tab', [
			'label'	 => esc_html__( 'Indicatior', 'hostinza' ),
			'tab'	 => Controls_Manager::TAB_STYLE,
		]
		);

		$this->add_control(
		'indicatior_color', [
			'label'		 => esc_html__( 'Color', 'hostinza' ),
			'type'		 => Controls_Manager::COLOR,
			'default'	 => '',
			'selectors'	 => [
				'{{WRAPPER}} .location_indicator'			 => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .location_indicator::after'	 => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .location_indicator::before'	 => 'background-color: {{VALUE}};',
			],
		]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$locations = $settings[ 'locations' ];

		/* General Package Contents */
		?>
		<div class="location-groups">
			<div class="map-image">
		<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
			</div>
			<div class="location-wraper clearfix">

		<?php $i = 1;
		foreach ( $locations as $location ): ?>
					<div class="elementor-repeater-item-<?php echo esc_attr( $location[ '_id' ] ); ?>  location location-<?php echo esc_attr($i); ?>" data-placement="top" data-toggle="tooltip" data-html="true" title="<h2 class='location-name'><?php echo hostinza_kses( $location[ 'title' ] ); ?></h2><p class='location-des'><?php echo hostinza_kses( $location[ 'address' ] ); ?></p>">
						<div class="location_indicator"></div>
						<div class="location_details d-block d-md-none">
							<h2 class="location-name"><?php echo hostinza_kses( $location[ 'title' ] ); ?></h2>
							<p class="location-des"><?php echo hostinza_kses( $location[ 'address' ] ); ?></p>
						</div>
					</div>

			<?php $i++;
		endforeach; ?>

			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		
	}

}
