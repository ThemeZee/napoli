<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Napoli
 */

if ( ! function_exists( 'napoli_site_logo' ) ) :
	/**
	 * Displays the site logo in the header area
	 */
	function napoli_site_logo() {

		if ( function_exists( 'the_custom_logo' ) ) {

			the_custom_logo();

		}

	}
endif;


if ( ! function_exists( 'napoli_site_title' ) ) :
	/**
	 * Displays the site title in the header area
	 */
	function napoli_site_title() {

		if ( is_home() or is_page_template( 'template-magazine.php' )  ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php endif;

	}
endif;


if ( ! function_exists( 'napoli_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function napoli_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) : ?>

			<p class="site-description"><?php echo $description; ?></p>

		<?php
		endif;

	}
endif;


if ( ! function_exists( 'napoli_header_image' ) ) :
	/**
	 * Displays the custom header image below the navigation menu
	 */
	function napoli_header_image() {

		// Check if user has set header image.
		if ( get_header_image() ) : ?>

			<div id="headimg" class="header-image">

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>

			</div>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'napoli_post_image' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 *
	 * @param string $size Post thumbnail size.
	 * @param array  $attr Post thumbnail attributes.
	 */
	function napoli_post_image( $size = 'post-thumbnail', $attr = array() ) {

		// Display Post Thumbnail.
		if ( has_post_thumbnail() ) : ?>

			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( $size, $attr ); ?>
			</a>

		<?php endif;

	}
endif;


if ( ! function_exists( 'napoli_post_image_single' ) ) :
	/**
	 * Displays the featured image on single posts
	 */
	function napoli_post_image_single() {

		// Get theme options from database.
		$theme_options = napoli_theme_options();

		// Display Post Thumbnail if activated.
		if ( true === $theme_options['post_image_single'] ) :

			the_post_thumbnail();

		endif;

	}
endif;


if ( ! function_exists( 'napoli_entry_meta' ) ) :
	/**
	 * Displays the date, author and categories of a post
	 */
	function napoli_entry_meta() {

		$postmeta = napoli_meta_date();
		$postmeta .= napoli_meta_author();

		// Display categories on comments on single posts.
		if ( is_single() ) {

			$postmeta .= napoli_meta_category();
			$postmeta .= napoli_meta_comments();

		}

		echo '<div class="entry-meta">' . $postmeta . '</div>';
	}
endif;


if ( ! function_exists( 'napoli_meta_date' ) ) :
	/**
	 * Displays the post date
	 */
	function napoli_meta_date() {

		$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		return '<span class="meta-date">' . $time_string . '</span>';
	}
endif;


if ( ! function_exists( 'napoli_meta_author' ) ) :
	/**
	 * Displays the post author
	 */
	function napoli_meta_author() {

		$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'napoli' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		return '<span class="meta-author"> ' . $author_string . '</span>';
	}
endif;


if ( ! function_exists( 'napoli_meta_category' ) ) :
	/**
	 * Displays the category of posts
	 */
	function napoli_meta_category() {

		return '<span class="meta-category"> ' . get_the_category_list( ', ' ) . '</span>';

	}
endif;


if ( ! function_exists( 'napoli_meta_comments' ) ) :
	/**
	 * Displays the post comments
	 */
	function napoli_meta_comments() {

		// Start Output Buffering.
		ob_start();

		// Display Comments.
		comments_popup_link( esc_html__( 'Leave a comment', 'napoli' ), esc_html__( 'One comment', 'napoli' ), esc_html__( '% comments', 'napoli' ) );
		$comments = ob_get_contents();

		// End Output Buffering.
		ob_end_clean();

		return '<span class="meta-comments"> ' . $comments . '</span>';
	}
endif;


if ( ! function_exists( 'napoli_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function napoli_entry_tags() {

		// Get tags.
		$tag_list = get_the_tag_list( '', '' );

		// Display tags.
		if ( $tag_list ) : ?>

			<div class="entry-tags clearfix">
				<span class="meta-tags">
					<?php echo $tag_list; ?>
				</span>
			</div><!-- .entry-tags -->

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'napoli_more_link' ) ) :
	/**
	 * Displays the more link on posts
	 */
	function napoli_more_link() {
		?>

		<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php esc_html_e( 'Continue reading &raquo;', 'napoli' ); ?></a>

		<?php
	}
endif;


if ( ! function_exists( 'napoli_post_navigation' ) ) :
	/**
	 * Displays Single Post Navigation
	 */
	function napoli_post_navigation() {

		// Get theme options from database.
		$theme_options = napoli_theme_options();

		if ( true === $theme_options['post_navigation'] || is_customize_preview() ) {

			the_post_navigation( array(
				'prev_text' => '<span class="nav-link-text">' . esc_html_x( 'Previous Post', 'post navigation', 'napoli' ) . '</span><h3 class="entry-title">%title</h3>',
				'next_text' => '<span class="nav-link-text">' . esc_html_x( 'Next Post', 'post navigation', 'napoli' ) . '</span><h3 class="entry-title">%title</h3>',
			) );

		}
	}
endif;


if ( ! function_exists( 'napoli_breadcrumbs' ) ) :
	/**
	 * Displays ThemeZee Breadcrumbs plugin
	 */
	function napoli_breadcrumbs() {

		if ( function_exists( 'themezee_breadcrumbs' ) ) {

			themezee_breadcrumbs( array(
				'before' => '<div class="breadcrumbs-container container clearfix">',
				'after' => '</div>',
			) );

		}
	}
endif;


if ( ! function_exists( 'napoli_related_posts' ) ) :
	/**
	 * Displays ThemeZee Related Posts plugin
	 */
	function napoli_related_posts() {

		if ( function_exists( 'themezee_related_posts' ) ) {

			themezee_related_posts( array(
				'class' => 'related-posts type-page clearfix',
				'before_title' => '<h2 class="page-title related-posts-title">',
				'after_title' => '</h2>',
			) );

		}
	}
endif;


if ( ! function_exists( 'napoli_pagination' ) ) :
	/**
	 * Displays pagination on archive pages
	 */
	function napoli_pagination() {

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'napoli' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'napoli' ) . '</span>&raquo;',
		) );

	}
endif;


/**
 * Displays credit link on footer line
 */
function napoli_footer_text() {
	?>

	<span class="credit-link">
		<?php printf( esc_html__( 'Powered by %1$s and %2$s.', 'napoli' ),
			'<a href="http://wordpress.org" title="WordPress">WordPress</a>',
			'<a href="https://themezee.com/themes/napoli/" title="Napoli WordPress Theme">Napoli</a>'
		); ?>
	</span>

	<?php
}
add_action( 'napoli_footer_text', 'napoli_footer_text' );
