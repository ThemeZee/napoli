<?php
/**
 * The template for displaying single posts
 *
 * @package Napoli
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php napoli_post_image_single(); ?>

	<div class="post-content clearfix">

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-content clearfix">

			<?php the_content(); ?>

			<?php wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'napoli' ),
				'after'  => '</div>',
			) ); ?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php napoli_entry_tags(); ?>

		</footer><!-- .entry-footer -->

	</div>

	<?php napoli_post_navigation(); ?>

	<?php napoli_entry_meta(); ?>

</article>
