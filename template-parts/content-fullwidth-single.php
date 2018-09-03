<?php
/**
 * The template for displaying single posts in fullwidth
 *
 * @package Napoli
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_post_thumbnail( 'napoli-fullwidth-page' ); ?>

	<div class="post-content clearfix">

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-content clearfix">

			<?php the_content(); ?>

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'napoli' ),
				'after'  => '</div>',
			) );
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php napoli_entry_tags(); ?>

		</footer><!-- .entry-footer -->

	</div>

	<?php do_action( 'napoli_author_bio' ); ?>

	<?php napoli_post_navigation(); ?>

	<?php napoli_entry_meta(); ?>

</article>
