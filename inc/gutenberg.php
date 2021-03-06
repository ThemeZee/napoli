<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package Napoli
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function napoli_gutenberg_support() {

	// Add theme support for wide and full images.
	#add_theme_support( 'align-wide' );

	// Define block color palette.
	$color_palette = apply_filters( 'napoli_color_palette', array(
		'primary_color'    => '#ee4455',
		'secondary_color'  => '#d52b3c',
		'tertiary_color'   => '#bb1122',
		'accent_color'     => '#4466ee',
		'highlight_color'  => '#eee644',
		'light_gray_color' => '#e0e0e0',
		'gray_color'       => '#999999',
		'dark_gray_color'  => '#303030',
	) );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'napoli_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'napoli' ),
			'slug'  => 'primary',
			'color' => esc_html( $color_palette['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'napoli' ),
			'slug'  => 'secondary',
			'color' => esc_html( $color_palette['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Tertiary', 'block color', 'napoli' ),
			'slug'  => 'tertiary',
			'color' => esc_html( $color_palette['tertiary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'napoli' ),
			'slug'  => 'accent',
			'color' => esc_html( $color_palette['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'napoli' ),
			'slug'  => 'highlight',
			'color' => esc_html( $color_palette['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'napoli' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'napoli' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $color_palette['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'napoli' ),
			'slug'  => 'gray',
			'color' => esc_html( $color_palette['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'napoli' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $color_palette['dark_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'napoli' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );
}
add_action( 'after_setup_theme', 'napoli_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function napoli_block_editor_assets() {

	// Enqueue Editor Styling.
	wp_enqueue_style( 'napoli-editor-styles', get_theme_file_uri( '/assets/css/gutenberg-styles.css' ), array(), '20210306', 'all' );

	// Enqueue Page Template Switcher Editor plugin.
	#wp_enqueue_script( 'napoli-page-template-switcher', get_theme_file_uri( '/assets/js/page-template-switcher.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), '20210306' );
}
add_action( 'enqueue_block_editor_assets', 'napoli_block_editor_assets' );


/**
 * Remove inline styling in Gutenberg.
 *
 * @return array $editor_settings
 */
function napoli_block_editor_settings( $editor_settings ) {
	// Remove editor styling.
	if ( ! current_theme_supports( 'editor-styles' ) ) {
		$editor_settings['styles'] = '';
	}

	return $editor_settings;
}
#add_filter( 'block_editor_settings', 'napoli_block_editor_settings', 11 );


/**
 * Add body classes in Gutenberg Editor.
 */
function napoli_block_editor_body_classes( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) ) {
		return $classes;
	}

	// Fullwidth Page Template?
	if ( 'templates/template-fullwidth.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' napoli-fullwidth-page-layout ';
	}

	// No Title Page Template?
	if ( 'templates/template-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-left-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-right-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' napoli-page-title-hidden ';
	}

	// Full-width / No Title Page Template?
	if ( 'templates/template-fullwidth-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' napoli-fullwidth-page-layout napoli-page-title-hidden ';
	}

	return $classes;
}
#add_filter( 'admin_body_class', 'napoli_block_editor_body_classes' );
