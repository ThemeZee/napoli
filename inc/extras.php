<?php
/**
 * Custom functions that are not template related
 *
 * @package Napoli
 */

if ( ! function_exists( 'napoli_default_menu' ) ) :
	/**
	 * Display default page as navigation if no custom menu was set
	 */
	function napoli_default_menu() {

		echo '<ul id="menu-main-navigation" class="main-navigation-menu menu">' . wp_list_pages( 'title_li=&echo=0' ) . '</ul>';

	}
endif;


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function napoli_body_classes( $classes ) {

	// Get theme options from database.
	$theme_options = napoli_theme_options();

	// Switch sidebar layout to left.
	if ( 'left-sidebar' == $theme_options['layout'] ) {
		$classes[] = 'sidebar-left';
	}

	// Add Post Columns classes.
	if ( is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'post-layout-two-columns post-layout-columns';
	} else {
		$classes[] = 'post-layout-three-columns post-layout-columns no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'napoli_body_classes' );


/**
 * Hide Elements with CSS.
 *
 * @return void
 */
function napoli_hide_elements() {

	// Get theme options from database.
	$theme_options = napoli_theme_options();

	$elements = array();

	// Hide Site Title?
	if ( false === $theme_options['site_title'] ) {
		$elements[] = '.site-title';
	}

	// Hide Site Description?
	if ( false === $theme_options['site_description'] ) {
		$elements[] = '.site-description';
	}

	// Return early if no elements are hidden.
	if ( empty( $elements ) ) {
		return;
	}

	// Create CSS.
	$classes = implode( ', ', $elements );
	$custom_css = $classes . ' {
	position: absolute;
	clip: rect(1px, 1px, 1px, 1px);
}';

	// Add Custom CSS.
	wp_add_inline_style( 'napoli-stylesheet', $custom_css );
}
add_filter( 'wp_enqueue_scripts', 'napoli_hide_elements', 11 );


/**
 * Change excerpt length for default posts
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function napoli_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	// Get theme options from database.
	$theme_options = napoli_theme_options();

	// Return excerpt text.
	if ( isset( $theme_options['excerpt_length'] ) and $theme_options['excerpt_length'] >= 0 ) :
		return absint( $theme_options['excerpt_length'] );
	else :
		return 20; // Number of words.
	endif;
}
add_filter( 'excerpt_length', 'napoli_excerpt_length' );


/**
 * Change excerpt more text for posts
 *
 * @param String $more_text Excerpt More Text.
 * @return string
 */
function napoli_excerpt_more( $more_text ) {

	if ( is_admin() ) {
		return $more_text;
	}

	return ' <span class="more-text">&hellip;</span>';

}
add_filter( 'excerpt_more', 'napoli_excerpt_more' );


/**
 * Get Magazine Post IDs
 *
 * @param String $cache_id        Magazine Widget Instance.
 * @param int    $category        Category ID.
 * @param int    $number_of_posts Number of posts.
 * @return array Post IDs
 */
function napoli_get_magazine_post_ids( $cache_id, $category, $number_of_posts ) {

	$cache_id = sanitize_key( $cache_id );
	$post_ids = get_transient( 'napoli_magazine_post_ids' );

	if ( ! isset( $post_ids[ $cache_id ] ) ) {

		// Get Posts from Database.
		$query_arguments = array(
			'fields'              => 'ids',
			'cat'                 => (int) $category,
			'posts_per_page'      => (int) $number_of_posts,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);
		$query = new WP_Query( $query_arguments );

		// Create an array of all post ids.
		$post_ids[ $cache_id ] = $query->posts;

		// Set Transient.
		set_transient( 'napoli_magazine_post_ids', $post_ids );
	}

	return apply_filters( 'napoli_magazine_post_ids', $post_ids[ $cache_id ], $cache_id );
}


/**
 * Delete Cached Post IDs
 *
 * @return void
 */
function napoli_flush_magazine_post_ids() {
	delete_transient( 'napoli_magazine_post_ids' );
}
add_action( 'save_post', 'napoli_flush_magazine_post_ids' );
add_action( 'deleted_post', 'napoli_flush_magazine_post_ids' );
add_action( 'switch_theme', 'napoli_flush_magazine_post_ids' );


/**
 * Set wrapper start for wooCommerce
 */
function napoli_wrapper_start() {
	echo '<section id="primary" class="content-area">';
	echo '<main id="main" class="site-main" role="main">';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'napoli_wrapper_start', 10 );


/**
 * Set wrapper end for wooCommerce
 */
function napoli_wrapper_end() {
	echo '</main><!-- #main -->';
	echo '</section><!-- #primary -->';
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content', 'napoli_wrapper_end', 10 );
