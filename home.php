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
if ( true === $theme_options['slider_blog'] && ! napoli_is_amp() ) :

	get_template_part( 'template-parts/post-slider' );

endif;
?>

	<section id="primary" class="content-archive content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Display Magazine Homepage Widgets.
			napoli_magazine_widgets();

			do_action( 'napoli_before_blog' );

			if ( have_posts() ) :

				// Display Blog Title.
				napoli_blog_title();
				?>

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
