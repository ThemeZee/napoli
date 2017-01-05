<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Napoli
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="hfeed site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'napoli' ); ?></a>

		<header id="masthead" class="site-header clearfix" role="banner">

			<div class="header-main container clearfix">

				<?php if ( has_nav_menu( 'social' ) ) : ?>

					<div id="header-social-icons" class="header-social-icons social-icons-navigation clearfix">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'container' => false,
								'menu_class' => 'social-icons-menu',
								'echo' => true,
								'fallback_cb' => '',
								'link_before' => '<span class="screen-reader-text">',
								'link_after' => '</span>',
								'depth' => 1,
							) );
						?>
					</div>

				<?php endif; ?>

				<div id="logo" class="site-branding clearfix">

					<?php napoli_site_logo(); ?>
					<?php napoli_site_title(); ?>
					<?php napoli_site_description(); ?>

				</div><!-- .site-branding -->

				<nav id="main-navigation" class="primary-navigation navigation clearfix" role="navigation">

					<div class="main-navigation-menu-wrap">
					<?php
						// Display Main Navigation.
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container' => false,
							'menu_class' => 'main-navigation-menu',
							'echo' => true,
							'fallback_cb' => 'napoli_default_menu',
						) );
					?>
					</div>

				</nav><!-- #main-navigation -->

			</div><!-- .header-main -->

			<?php do_action( 'napoli_header_menu' ); ?>

		</header><!-- #masthead -->

		<?php napoli_breadcrumbs(); ?>

		<?php napoli_header_image(); ?>

		<div id="content" class="site-content container clearfix">
