<?php
/**
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard.
 *
 * @package Napoli
 */

/**
 * Add Theme Info page to admin menu
 */
function napoli_theme_info_menu_link() {

	// Get theme details.
	$theme = wp_get_theme();

	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'napoli' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ),
		esc_html__( 'Theme Info', 'napoli' ),
		'edit_theme_options',
		'napoli',
		'napoli_theme_info_page'
	);

}
add_action( 'admin_menu', 'napoli_theme_info_menu_link' );

/**
 * Display Theme Info page
 */
function napoli_theme_info_page() {

	// Get theme details.
	$theme = wp_get_theme();
	?>

	<div class="wrap theme-info-wrap">

		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'napoli' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ); ?></h1>

		<div class="theme-description"><?php echo $theme->get( 'Description' ); ?></div>

		<hr>
		<div class="important-links clearfix">
			<p><strong><?php esc_html_e( 'Theme Links', 'napoli' ); ?>:</strong>
				<a href="<?php echo esc_url( __( 'https://themezee.com/themes/napoli/', 'napoli' ) . '?utm_source=theme-info&utm_medium=textlink&utm_campaign=napoli&utm_content=theme-page' ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'napoli' ); ?></a>
				<a href="http://preview.themezee.com/?demo=napoli&utm_source=theme-info&utm_campaign=napoli" target="_blank"><?php esc_html_e( 'Theme Demo', 'napoli' ); ?></a>
				<a href="<?php echo esc_url( __( 'https://themezee.com/docs/napoli-documentation/', 'napoli' ) . '?utm_source=theme-info&utm_medium=textlink&utm_campaign=napoli&utm_content=documentation' ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'napoli' ); ?></a>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/napoli/reviews/?filter=5', 'napoli' ) ); ?>" target="_blank"><?php esc_html_e( 'Rate this theme', 'napoli' ); ?></a>
			</p>
		</div>
		<hr>

		<div id="getting-started">

			<h3><?php printf( esc_html__( 'Getting Started with %s', 'napoli' ), $theme->get( 'Name' ) ); ?></h3>

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Theme Documentation', 'napoli' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'You need help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'napoli' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( __( 'https://themezee.com/docs/napoli-documentation/', 'napoli' ) . '?utm_source=theme-info&utm_medium=button&utm_campaign=napoli&utm_content=documentation' ); ?>" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'View %s Documentation', 'napoli' ), 'Napoli' ); ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Theme Options', 'napoli' ); ?></h4>

						<p class="about">
							<?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'napoli' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo wp_customize_url(); ?>" class="button button-primary"><?php esc_html_e( 'Customize Theme', 'napoli' ); ?></a>
						</p>
					</div>

				</div>

				<div class="column column-half clearfix">

					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.jpg" />

				</div>

			</div>

		</div>

		<hr>

		<div id="more-features">

			<h3><?php esc_html_e( 'Get more features', 'napoli' ); ?></h3>

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Pro Version Add-on', 'napoli' ); ?></h4>

						<p class="about">
							<?php printf( esc_html__( 'Purchase the %s Pro Add-on and get additional features and advanced customization options.', 'napoli' ), 'Napoli' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( __( 'https://themezee.com/addons/napoli-pro/', 'napoli' ) . '?utm_source=theme-info&utm_medium=button&utm_campaign=napoli&utm_content=pro-version' ); ?>" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'Learn more about %s Pro', 'napoli' ), 'Napoli' ); ?>
							</a>
						</p>
					</div>

				</div>

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Recommended Plugins', 'napoli' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Extend the functionality of your WordPress website with our free and easy to use plugins.', 'napoli' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&type=author&s=themezee' ) ); ?>" class="button button-secondary">
								<?php esc_html_e( 'Install Plugins', 'napoli' ); ?>
							</a>
						</p>
					</div>

				</div>

			</div>

		</div>

		<hr>

		<div id="theme-author">

			<p>
				<?php printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'napoli' ),
					$theme->get( 'Name' ),
					'<a target="_blank" href="' . __( 'https://themezee.com/', 'napoli' ) . '?utm_source=theme-info&utm_medium=footer&utm_campaign=napoli" title="ThemeZee">ThemeZee</a>',
					'<a target="_blank" href="' . __( 'https://wordpress.org/support/theme/napoli/reviews/?filter=5', 'napoli' ) . '" title="' . esc_attr__( 'Review Napoli', 'napoli' ) . '">' . esc_html__( 'rate it', 'napoli' ) . '</a>'
				); ?>
			</p>

		</div>

	</div>

	<?php
}

/**
 * Enqueues CSS for Theme Info page
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function napoli_theme_info_page_css( $hook ) {

	// Load styles and scripts only on theme info page.
	if ( 'appearance_page_napoli' != $hook ) {
		return;
	}

	// Embed theme info css style.
	wp_enqueue_style( 'napoli-theme-info-css', get_template_directory_uri() . '/css/theme-info.css' );

}
add_action( 'admin_enqueue_scripts', 'napoli_theme_info_page_css' );
