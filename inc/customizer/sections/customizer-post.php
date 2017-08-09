<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Napoli
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function napoli_customize_register_post_settings( $wp_customize ) {

	// Add Section for Post Settings.
	$wp_customize->add_section( 'napoli_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'napoli' ),
		'priority' => 30,
		'panel'    => 'napoli_options_panel',
	) );

	// Add Setting and Control for Excerpt Length.
	$wp_customize->add_setting( 'napoli_theme_options[excerpt_length]', array(
		'default'           => 20,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'napoli_theme_options[excerpt_length]', array(
		'label'    => esc_html__( 'Excerpt Length', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[excerpt_length]',
		'type'     => 'text',
		'priority' => 10,
	) );

	// Add Post Details Headline.
	$wp_customize->add_control( new Napoli_Customize_Header_Control(
		$wp_customize, 'napoli_theme_options[post_meta_headline]', array(
			'label'    => esc_html__( 'Post Meta', 'napoli' ),
			'section'  => 'napoli_section_post',
			'settings' => array(),
			'priority' => 20,
		)
	) );

	// Add setting and control for date.
	$wp_customize->add_setting( 'napoli_theme_options[meta_date]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[meta_date]', array(
		'label'    => esc_html__( 'Display post date', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 30,
	) );

	// Add setting and control for author.
	$wp_customize->add_setting( 'napoli_theme_options[meta_author]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[meta_author]', array(
		'label'    => esc_html__( 'Display post author', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 40,
	) );

	// Add Single Posts Headline.
	$wp_customize->add_control( new Napoli_Customize_Header_Control(
		$wp_customize, 'napoli_theme_options[single_post_headline]', array(
			'label'    => esc_html__( 'Single Posts', 'napoli' ),
			'section'  => 'napoli_section_post',
			'settings' => array(),
			'priority' => 50,
		)
	) );

	// Add setting and control for category.
	$wp_customize->add_setting( 'napoli_theme_options[meta_category]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[meta_category]', array(
		'label'    => esc_html__( 'Display post categories', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[meta_category]',
		'type'     => 'checkbox',
		'priority' => 60,
	) );

	// Add setting and control for comments.
	$wp_customize->add_setting( 'napoli_theme_options[meta_comments]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[meta_comments]', array(
		'label'    => esc_html__( 'Display post comments', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[meta_comments]',
		'type'     => 'checkbox',
		'priority' => 70,
	) );

	// Add setting and control for tags.
	$wp_customize->add_setting( 'napoli_theme_options[meta_tags]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[meta_tags]', array(
		'label'    => esc_html__( 'Display post tags', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 80,
	) );

	// Add setting and control for post navigation.
	$wp_customize->add_setting( 'napoli_theme_options[post_navigation]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[post_navigation]', array(
		'label'    => esc_html__( 'Display post navigation on single posts', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 90,
	) );

	// Add Featured Images Headline.
	$wp_customize->add_control( new Napoli_Customize_Header_Control(
		$wp_customize, 'napoli_theme_options[featured_images]', array(
			'label'    => esc_html__( 'Featured Images', 'napoli' ),
			'section'  => 'napoli_section_post',
			'settings' => array(),
			'priority' => 100,
		)
	) );

	// Add Setting and Control for featured images on blog and archives.
	$wp_customize->add_setting( 'napoli_theme_options[post_image_archives]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[post_image_archives]', array(
		'label'    => esc_html__( 'Display on blog and archives', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[post_image_archives]',
		'type'     => 'checkbox',
		'priority' => 110,
	) );

	// Add Setting and Control for featured images on single posts.
	$wp_customize->add_setting( 'napoli_theme_options[post_image_single]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'napoli_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'napoli_theme_options[post_image_single]', array(
		'label'    => esc_html__( 'Display on single posts', 'napoli' ),
		'section'  => 'napoli_section_post',
		'settings' => 'napoli_theme_options[post_image_single]',
		'type'     => 'checkbox',
		'priority' => 120,
	) );

	// Add Partial for Excerpt Length and Post Images on blog and archives.
	$wp_customize->selective_refresh->add_partial( 'napoli_blog_layout_partial', array(
		'selector'         => '.site-main .post-wrapper',
		'settings'         => array(
			'napoli_theme_options[excerpt_length]',
			'napoli_theme_options[post_image_archives]',
		),
		'render_callback'  => 'napoli_customize_partial_blog_layout',
		'fallback_refresh' => false,
	) );
}
add_action( 'customize_register', 'napoli_customize_register_post_settings' );

/**
 * Render the blog layout for the selective refresh partial.
 */
function napoli_customize_partial_blog_layout() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}
}
