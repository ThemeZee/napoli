<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Napoli
 */

get_header();

// Get Theme Options from Database.
$theme_options = napoli_theme_options();

// Display Slider.
if ( true === $theme_options['slider_blog'] ) :

	get_template_part( 'template-parts/post-slider' );

endif;
?>

	<section id="primary" class="content-archive content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Display Magazine Homepage Widgets.
			if ( ! is_paged() && is_active_sidebar( 'magazine-homepage' ) ) : ?>

				<div id="magazine-homepage-widgets" class="widget-area clearfix">

					<?php dynamic_sidebar( 'magazine-homepage' ); ?>

				</div><!-- #magazine-homepage-widgets -->

				<?php
			endif;

			// Display Homepage Title.
			if ( '' !== $theme_options['blog_title'] ) : ?>

				<header class="page-header clearfix">

					<h1 class="home-title archive-title"><?php echo wp_kses_post( $theme_options['blog_title'] ); ?></h1>
					<div class="homepage-description"><?php echo wp_kses_post( $theme_options['blog_description'] ); ?></div>

				</header>

			<?php endif;

			if ( have_posts() ) : ?>

				<div id="post-wrapper" class="post-wrapper clearfix">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content' );

					endwhile; ?>

				</div>

				<?php napoli_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
