<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Test_Widget extends \Elementor\Widget_Base {


	public function get_name() {
		return 'select';
	} 



	public function get_title() {
		return esc_html__( 'Select widget', 'essential-elementor-widget' );
	}


	public function get_categories() {
		return [ 'basic' ];
	}
	

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'essential-elementor-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'border_style',
			[
				'label' => esc_html__( 'Border Style', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'  => esc_html__( 'Solid', 'essential-elementor-widget' ),
					'dashed' => esc_html__( 'Dashed', 'essential-elementor-widget' ),
					'dotted' => esc_html__( 'Dotted', 'essential-elementor-widget' ),
					'double' => esc_html__( 'Double', 'essential-elementor-widget' ),
					'none' => esc_html__( 'None', 'essential-elementor-widget' ),
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div style="border-style: <?php echo esc_attr( $settings['border_style'] ); ?>">
			...
		</div>
		<?php
	}

	protected function content_template() {
		
	}

}