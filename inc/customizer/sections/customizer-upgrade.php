<?php
/**
 * Pro Version Upgrade Section
 *
 * Registers Upgrade Section for the Pro Version of the theme
 *
 * @package Napoli
 */

/**
 * Adds pro version description and CTA button
 *
 * @param object $wp_customize / Customizer Object.
 */
function napoli_customize_register_upgrade_settings( $wp_customize ) {

	// Add Upgrade / More Features Section.
	$wp_customize->add_section( 'napoli_section_upgrade', array(
		'title'    => esc_html__( 'More Features', 'napoli' ),
		'priority' => 70,
		'panel' => 'napoli_options_panel',
		)
	);

	// Add custom Upgrade Content control.
	$wp_customize->add_setting( 'napoli_theme_options[upgrade]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( new Napoli_Customize_Upgrade_Control(
		$wp_customize, 'napoli_theme_options[upgrade]', array(
		'section' => 'napoli_section_upgrade',
		'settings' => 'napoli_theme_options[upgrade]',
		'priority' => 1,
		)
	) );

}
add_action( 'customize_register', 'napoli_customize_register_upgrade_settings' );
