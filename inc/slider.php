<?php
/**
 * Post Slider Setup
 *
 * Enqueues scripts and styles for the slideshow
 * Sets slideshow excerpt length and slider animation parameter
 *
 * The template for displaying the slideshow can be found under /template-parts/post-slider.php
 *
 * @package Napoli
 */

/**
 * Enqueue slider scripts and styles.
 */
function napoli_slider_scripts() {

	// Get theme options from database.
	$theme_options = napoli_theme_options();

	// Register and enqueue FlexSlider JS and CSS if necessary.
	if ( true === $theme_options['slider_blog'] or true === $theme_options['slider_magazine'] or is_page_template( 'template-slider.php' ) ) :

		// FlexSlider CSS.
		if ( is_rtl() ) {
			wp_enqueue_style( 'napoli-flexslider', get_template_directory_uri() . '/css/flexslider-rtl.css' );
		} else {
			wp_enqueue_style( 'napoli-flexslider', get_template_directory_uri() . '/css/flexslider.css' );
		}

		// FlexSlider JS.
		wp_enqueue_script( 'flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js', array( 'jquery' ), '2.6.0' );

		// Register and enqueue slider setup.
		wp_enqueue_script( 'napoli-post-slider', get_template_directory_uri() .'/js/slider.js', array( 'flexslider' ) );

	endif;

}
add_action( 'wp_enqueue_scripts', 'napoli_slider_scripts' );


/**
 * Function to change excerpt length for post slider
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function napoli_slider_excerpt_length( $length ) {
	return 25;
}


/**
 * Sets slider animation effect
 *
 * Passes parameters from theme options to the javascript files (js/slider.js)
 */
function napoli_slider_options() {

	// Get theme options from database.
	$theme_options = napoli_theme_options();

	// Set parameters array.
	$params = array();

	// Set slider animation.
	$params['animation'] = $theme_options['slider_animation'];

	// Set slider speed.
	$params['speed'] = $theme_options['slider_speed'];

	// Passing parameters to Flexslider.
	wp_localize_script( 'napoli-post-slider', 'napoli_slider_params', $params );

}
add_action( 'wp_enqueue_scripts', 'napoli_slider_options' );
