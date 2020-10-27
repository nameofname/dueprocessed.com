<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Due_Processed
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					// Custom search results subheading
					global $wp_query;
					$posts_found    = $wp_query->found_posts;
					$query_value = get_search_query( false );
					if ( $posts_found ) {
						// # results for "<query>"
						$subheading = sprintf(
							esc_html__( '%1$s %2$s for "%3$s"', 'due-processed' ),
							$posts_found,
							$posts_found === 1 ? 'result' : 'results',
							$query_value
						);
					} else {
						$subheading = esc_html__('No results for "'. $query_value .'"', 'due-processed');
					}
					/* translators: %s: search query. */
					printf( normalize_whitespace($subheading) );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="search-results-wrapper">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'excerpt' );

			endwhile;

			the_posts_navigation();
			?>

		<?php 
			else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
