<?php

/**
 * Plugin Name: Essential Elementor Widgets
 * Description: Elementor custom widgets from Eessential Web Apps.
 * Text Domain: essential-elementor-widget
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Widgets.
 */
function register_essential_custom_widgets( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/card-widget.php' );  // include the widget file
    require_once( __DIR__ . '/widgets/slider_widget.php' );
    require_once( __DIR__ . '/widgets/repeater.php' );
    


    $widgets_manager->register( new \Essential_Elementor_Card_Widget() );  // register the widget
    $widgets_manager->register( new \Custom_slider_widget() );
    $widgets_manager->register( new \Elementor_Test_Widget() );
}
add_action( 'elementor/widgets/register', 'register_essential_custom_widgets' );