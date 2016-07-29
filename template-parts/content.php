<?php
/**
 * The template for displaying articles in the loop with post excerpts
 *
 * @package Napoli
 */

?>

<div class="post-column clearfix">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php napoli_post_image(); ?>

		<div class="post-content clearfix">

			<header class="entry-header">

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			</header><!-- .entry-header -->

			<div class="entry-content entry-excerpt clearfix">

				<?php the_excerpt(); ?>

			</div><!-- .entry-content -->

		</div>

		<?php napoli_entry_meta(); ?>

	</article>

</div>
