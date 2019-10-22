<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package Napoli
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class Napoli_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'napoli' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/themes/napoli/', 'napoli' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=napoli&utm_content=theme-page" target="_blank">
						<?php esc_html_e( 'Theme Page', 'napoli' ); ?>
					</a>
				</p>

				<p>
					<a href="http://preview.themezee.com/?demo=napoli&utm_source=customizer&utm_campaign=napoli" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'napoli' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/docs/napoli-documentation/', 'napoli' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=napoli&utm_content=documentation" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'napoli' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/changelogs/?action=themezee-changelog&type=theme&slug=napoli/', 'napoli' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Changelog', 'napoli' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/napoli/reviews/', 'napoli' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'napoli' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
