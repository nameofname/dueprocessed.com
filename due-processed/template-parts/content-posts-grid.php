<?php
/**
 * The template for displaying search results-like pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Due_Processed
 */

/**
 * Display Category in WordPress
 */ 


get_header();
?>

<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>
		<header class="page-header search-results-page-header">
			<h1 class="page-title search-results-page-title">
				<?php
					// $args is locally scoped to `get_template_part` templates
					if ($args['template'] === 'search') {
						due_processed_get_search_header();
					} else if ($args['template'] === 'category') {
						due_processed_get_category_name_header();
					}
				?>
			</h1>
		</header><!-- .page-header -->

		<?php
			get_template_part( 'template-parts/content', 'posts-container' );
		?>

	<?php 
		else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</main><!-- #main -->

<?php
get_footer();