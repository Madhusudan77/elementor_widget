<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class List_and_Grid_view extends \Elementor\Widget_Base { 

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
		return 'list_and_grid_view';
	}



	public function get_title() {
		return esc_html__( 'List and Grid View', 'essential-elementor-widget' );
	}


	public function get_icon() {
		return 'eicon-posts-grid';
	}


	public function get_categories() {
		return [ 'basic' ];
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


		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Heading Alignment', 'essential-elementor-widget' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'grid' => [
						'title' => esc_html__( 'Grid', 'essential-elementor-widget' ),
						'icon' => 'eicon-gallery-grid',
					],
					'list' => [
						'title' => esc_html__( 'List', 'essential-elementor-widget' ),
						'icon' => 'eicon-post-list',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->end_controls_section();

	}


	protected function render() { 

	// get our input from the widget settings.
	$settings = $this->get_settings_for_display();
	$loop = new WP_Query( array( 'post_type' => 'vehicles', 'posts_per_page' => -1 ) ); ?>
        <div id="container">
		    <div class="buttons">

		        <button class="grid"><i class="eicon-gallery-grid"></i></button>
		        <button class="list"><i class="eicon-post-list"></i></button>
		    </div>
		    <?php if($loop->have_posts()): ?>
		    	<div class="content_main_class list">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					  	<div class="content_inner_class_view">
					  		<div class="content_class_view">
					  			<div class="image_outer_class_view">
						  			<div class="image_class_view" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
						  			</div>
					  			</div>
						  		
						  		<?php if ( 'yes' === $settings['show_title'] ) { ?>
						  			<?php if ( 'yes' === $settings['title_link'] ) { ?>
						  				<a href="<?php the_permalink(); ?>">
						  					<h3 class="post_title_view" style="text-align: <?php echo esc_attr( $settings['title_align'] ); ?>;">
												<?php echo get_the_title();?>
											</h3>
						  				</a>
							  		<?php }else { ?>
							  			<h3 class="post_title_view"  style="text-align: <?php echo esc_attr( $settings['title_align'] ); ?>;">
											<?php echo get_the_title();?>
										</h3>
								<?php } }?>
					  		</div>	
					  	</div>
				  	<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>    

        <?php
	
	}		

}