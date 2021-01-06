<div class="search-results-wrapper">
<?php
			/* Start the Loop */
			while ( have_posts() ) :

				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'excerpt' );
			endwhile;
			the_posts_navigation();
?>
</div>