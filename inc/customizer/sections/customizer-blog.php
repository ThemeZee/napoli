<?php
/**
 * Blog Settings
 *
 * Register Blog Settings section, settings and controls for Theme Customizer
 *
 * @package Napoli
 */

/**
 * Adds blog settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function napoli_customize_register_blog_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'napoli_section_blog', array(
		'title'    => esc_html__( 'Blog Settings', 'napoli' ),
		'priority' => 25,
		'panel' => 'napoli_options_panel',
	) );

	// Add Blog Title setting and control.
	$wp_customize->add_setting( 'napoli_theme_options[blog_title]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'napoli_theme_options[blog_title]', array(
		'label'    => esc_html__( 'Blog Title', 'napoli' ),
		'section'  => 'napoli_section_blog',
		'settings' => 'napoli_theme_options[blog_title]',
		'type'     => 'text',
		'priority' => 10,
	) );

	// Add Blog Description setting and control.
	$wp_customize->add_setting( 'napoli_theme_options[blog_description]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'napoli_theme_options[blog_description]', array(
		'label'    => esc_html__( 'Blog Description', 'napoli' ),
		'section'  => 'napoli_section_blog',
		'settings' => 'napoli_theme_options[blog_description]',
		'type'     => 'textarea',
		'priority' => 20,
	) );

	// Add Magazine Widgets Headline.
	$wp_customize->add_control( new Napoli_Customize_Header_Control(
		$wp_customize, 'napoli_theme_options[blog_magazine_widgets_title]', array(
			'label'    => esc_html__( 'Magazine Widgets', 'napoli' ),
			'section'  => 'napoli_section_blog',
			'settings' => array(),
			'priority' => 30,
		)
	) );

	// Add Setting and Control for Magazine widgets.
	$wp_customize->add_setting( 'napoli_theme_options[blog_magazine_widgets]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[blog_magazine_widgets]', array(
		'label'    => esc_html__( 'Display Magazine widgets on blog index', 'napoli' ),
		'section'  => 'napoli_section_blog',
		'settings' => 'napoli_theme_options[blog_magazine_widgets]',
		'type'     => 'checkbox',
		'priority' => 40,
	) );
}
add_action( 'customize_register', 'napoli_customize_register_blog_settings' );
