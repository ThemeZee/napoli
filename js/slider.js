/**
 * Flexslider Setup
 *
 * Adds the Flexslider Plugin for the Featured Post Slideshow
 *
 * @package Napoli
 */

jQuery( document ).ready(function($) {

	/* Add flexslider to #post-slider div */
	$( "#post-slider" ).flexslider({
		animation: napoli_slider_params.animation,
		slideshowSpeed: napoli_slider_params.speed,
		namespace: "zeeflex-",
		selector: ".zeeslides > li",
		smoothHeight: true,
		pauseOnHover: true,
		controlNav: false,
		controlsContainer: ".post-slider-controls"
	});

});
