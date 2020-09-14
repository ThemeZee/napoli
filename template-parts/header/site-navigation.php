<?php
/**
 * Main Navigation
 *
 * @version 1.1
 * @package Napoli
 */
?>

<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) || has_nav_menu( 'social' ) ) : ?>

	<button class="mobile-menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false" <?php napoli_amp_menu_toggle(); ?>>
		<?php
		echo napoli_get_svg( 'menu' );
		echo napoli_get_svg( 'close' );
		?>
		<span class="menu-toggle-text screen-reader-text"><?php esc_html_e( 'Menu', 'napoli' ); ?></span>
	</button>

<?php endif; ?>

<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>

	<div class="primary-navigation" <?php napoli_amp_menu_is_toggled(); ?>>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>

			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'napoli' ); ?>">

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
					)
				);
				?>
			</nav><!-- #site-navigation -->

		<?php endif; ?>

		<?php if ( has_nav_menu( 'social' ) ) : ?>

			<div id="header-social-icons" class="header-social-icons social-icons-navigation clearfix">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'container'      => false,
						'menu_class'     => 'social-icons-menu',
						'echo'           => true,
						'fallback_cb'    => '',
						'link_before'    => '<span class = "screen-reader-text">',
						'link_after'     => '</span>',
						'depth'          => 1,
					) );
				?>
			</div>

		<?php endif; ?>

	</div><!-- .primary-navigation -->

<?php endif; ?>

<?php do_action( 'napoli_after_navigation' ); ?>
