<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package Napoli
 */

/**
 * Adds all general settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function napoli_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'napoli_section_general', array(
		'title'    => esc_html__( 'General Settings', 'napoli' ),
		'priority' => 10,
		'panel'    => 'napoli_options_panel',
	) );

	// Add Settings and Controls for Layout.
	$wp_customize->add_setting( 'napoli_theme_options[layout]', array(
		'default'           => 'right-sidebar',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'napoli_sanitize_select',
	) );

	$wp_customize->add_control( 'napoli_theme_options[layout]', array(
		'label'    => esc_html__( 'Theme Layout', 'napoli' ),
		'section'  => 'napoli_section_general',
		'settings' => 'napoli_theme_options[layout]',
		'type'     => 'radio',
		'priority' => 10,
		'choices'  => array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'napoli' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'napoli' ),
		),
	) );
}
add_action( 'customize_register', 'napoli_customize_register_general_settings' );
