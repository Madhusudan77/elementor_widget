<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Essential_Elementor_Card_Widget extends \Elementor\Widget_Base { 
  


	public function get_name() {
		return 'card';
	}



	public function get_title() {
		return esc_html__( 'Essenial Card', 'essential-elementor-widget' );
	}


	public function get_icon() {
		return 'eicon-header';
	}


	public function get_categories() {
		return [ 'basic' ];
	}


	public function get_keywords() {
		return [ 'card', 'service', 'highlight', 'essential' ];
	}



	protected function register_controls() { 
		// our control function code goes here.

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'essential-elementor-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_title',
			[
				'label' => esc_html__( 'Card title', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Your card title here', 'essential-elementor-widget' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);
		$this->add_control(
			'card_description',
			[
				'label' => esc_html__( 'Card Description', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block'   => true,
				'placeholder' => esc_html__( 'Your card description here', 'essential-elementor-widget' ),
			]
		);	

		$this->end_controls_section();

		


		// style controls
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'essential-elementor-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		//title for the slider
		$this->add_control(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		); 

		//give color to the title
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f00',
				'selectors' => [
					'{{WRAPPER}} h3' => 'color: {{VALUE}}',
				],
			]
		);	


		//give style to the slider
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} h3',
			]
		);

		//
		$this->add_control(
			'description_options',
			[
				'label' => esc_html__( 'Description Options', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);		

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f00',
				'selectors' => [
					'{{WRAPPER}} .card__description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .card__description',
			]
		);	

		$this->end_controls_section();	

	}


	protected function render() { 

	// get our input from the widget settings.
	$settings = $this->get_settings_for_display();
	
	// get the individual values of the input
	$card_title = $settings['card_title'];
	$card_description = $settings['card_description'];
	?>

        <!-- Start rendering the output -->
        <div class="card">
        	<div><?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?></div>
            <h3 class="card_title"><?php echo $card_title;  ?></h3>
            <p class= "card__description"><?php echo $card_description;  ?></p>
        </div>
        <!-- End rendering the output -->

        <?php
	
	}		

}