<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// class to slider widget
class Custom_slider_widget extends \Elementor\Widget_Base {
	public function __construct($data = [], $args = null) {
      	parent::__construct($data, $args);
      	wp_register_style( 'Font_Awesome', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
		wp_enqueue_style('Font_Awesome');
		wp_register_style( 'Custom_Style', '/wp-content/plugins/essential-elementor-widgets/widgets/custom_style.css' );
		wp_enqueue_style('Custom_Style');
      	wp_register_script( 'script-handle', '/wp-content/plugins/essential-elementor-widgets/widgets/file.js', [ 'elementor-frontend' ], '1.0.0', true );
      	wp_register_script( 'Slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', null, null, true );
		wp_enqueue_script('Slick');
   }

   public function get_script_depends() {
       return [ 'script-handle' ];
   }


	public function get_name() {
		return 'slider';
	}



	public function get_title() {
		return esc_html__( 'Post Type Slider widget', 'essential-elementor-widget' );
	}


	public function get_icon() {
		return 'eicon-post-slider';
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

		// Show heading for the slider
		$this->add_control(
			'show_head_title',
			[
				'label' => esc_html__( 'Slider Heading', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Slider heading here', 'essential-elementor-widget' ),
			]
		);

		//adding post slug
		$this->add_control(
			'post_slug',
			[
				'label' => esc_html__( 'Enter Post Type Slug', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your slug here', 'essential-elementor-widget' ),
			]
		);

		//for no of posts to be added
		$this->add_control(
			'no_of_posts',
			[
				'label' => esc_html__( 'No of posts', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 10,
			]
		);

		//no of slides to show
		$this->add_control(
			'slides_to_show',
			[
				'label' => esc_html__( 'Slides to show at once', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 4,
				'step' => 1,
				'default' => 1,
			]
		);


		//if you want to show title of the post
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Show Title', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'essential-elementor-widget' ),
				'label_off' => esc_html__( 'Hide', 'essential-elementor-widget' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//if you want ot add the link to the title
		$this->add_control(
			'title_link',
			[
				'label' => esc_html__( 'Add Link to the Title', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Add', 'essential-elementor-widget' ),
				'label_off' => esc_html__( 'Remove', 'essential-elementor-widget' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		//if you want to add dots as well to slide
		$this->add_control(
			'add_dots',
			[
				'label' => esc_html__( 'Add Slider Dots', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Add', 'essential-elementor-widget' ),
				'label_off' => esc_html__( 'Remove', 'essential-elementor-widget' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		//if you want to add auto scroll to slide
		$this->add_control(
			'auto_scroll',
			[
				'label' => esc_html__( 'Auto Scroll', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Add', 'essential-elementor-widget' ),
				'label_off' => esc_html__( 'Remove', 'essential-elementor-widget' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		//adj
		$this->add_control(
			'play_speed',
			[
				'label' => esc_html__( 'Speed for slides(in secs *10 min 100)', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 500,
				'step' => 50,
				'default' => 100,
				'condition' => [
					'auto_scroll' => 'yes',
				],
			]
		);

		$this->end_controls_section();


		//responsive controls
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'essential-elementor-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		//want to show post title
		$this->add_control(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		//heading color
		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Heading Color', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .show_head_title' => 'color: {{VALUE}}',
				],
			]
		);	


		//heading typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => esc_html__( 'Heading Typography', 'essential-elementor-widget' ),
				'selector' => '{{WRAPPER}} .show_head_title',
			],
		);
		

		//heading alignment
		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Heading Alignment', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'essential-elementor-widget' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'essential-elementor-widget' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'essential-elementor-widget' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);


		//post title color
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Post title Color', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .post_title' => 'color: {{VALUE}}',
				],
			]
		);	


		//post title typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Post title Typography', 'essential-elementor-widget' ),
				'selector' => '{{WRAPPER}} .post_title',
			],
		);



		//post title align
		$this->add_responsive_control(
			'title_align',
			[
				'label' => esc_html__( 'Title Alignment', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'essential-elementor-widget' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'essential-elementor-widget' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'essential-elementor-widget' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);
		

		$this->end_controls_section();	

	}

	protected function render() {

		$settings = $this->get_settings_for_display();


		$post_slug = $settings['post_slug'];   // add the slug of the post type
		$number = $settings['no_of_posts'];   //no of posts
		$slides_to_show = $settings['slides_to_show'];   //no of slides want to show in a glance
		$add_dots = $settings['add_dots'];   //dots for sliders to slide
		$auto_scroll = $settings['auto_scroll'];   //slider auto scroll
		$play_speed = $settings['play_speed']*10;  //autoslide play speed


		$loop = new WP_Query( array( 'post_type' => $post_slug, 'posts_per_page' => $number ) ); ?>
		<?php if($loop->have_posts()): ?>
			<div class="outer_class">
				<input type="hidden" id="no_of_slides" name="no_of_slides" value="<?php echo $slides_to_show; ?>">
				<input type="hidden" id="add_dots" name="add_dots" value="<?php echo $add_dots; ?>"><!-- inpput to add dots -->
				<input type="hidden" id="auto_scroll" name="auto_scroll" value="<?php echo $auto_scroll; ?>"><!-- inpput to add auto scroll -->
				<input type="hidden" id="play_speed" name="play_speed" value="<?php echo $play_speed; ?>"><!-- inpput to add play speed -->
				<h2 class="show_head_title" style="text-align: <?php echo esc_attr( $settings['text_align'] ); ?>;"><?php echo $settings['show_head_title']; ?></h2>
				
				<div class="slider-class content_main_class">
					
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					  	<div class="content_inner_class">
					  		<div class="content_class">
					  			<div class="image_outer_class">
					  				<div class="image_class" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
						  			</div>
					  			</div>
						  		
						  		<?php if ( 'yes' === $settings['show_title'] ) { ?>
						  			<?php if ( 'yes' === $settings['title_link'] ) { ?>
						  				<a href="<?php the_permalink(); ?>">
						  					<h3 class="post_title" style="text-align: <?php echo esc_attr( $settings['title_align'] ); ?>;">
												<?php echo get_the_title();?>
											</h3>
						  				</a>
							  		<?php }else { ?>
							  			<h3 class="post_title"  style="text-align: <?php echo esc_attr( $settings['title_align'] ); ?>;">
											<?php echo get_the_title();?>
										</h3>
								<?php } }?>
					  		</div>	
					  	</div>
				  	<?php endwhile; ?>
				</div>
			</div>
		<?php endif;
	}

	protected function content_template() {
		
	}

}