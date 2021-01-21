<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Due_Processed
 */

?>
<!-- content-none -->
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title">
			<?php 
				due_processed_get_search_header()
			?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<h2 class="page-title no-results-recent-articles">Recent Articles</h2>
		<?php
			echo get_template_part( 'template-parts/content', 'posts-container' );
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
