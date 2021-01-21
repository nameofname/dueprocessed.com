<div class="search-results-wrapper">
	<?php
		if (have_posts()) {
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
		} else {
			// no search results
			$args = array(
				'posts_per_page' => 4, /* how many post you need to display */
				'offset' => 0,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post', /* your post type name */
				'post_status' => 'publish'
			);
			$query = new WP_Query($args);
			if ($query->have_posts()) :
				while ($query->have_posts()) :
					$query->the_post();
					echo get_template_part( 'template-parts/content', 'excerpt' );
				endwhile;
			endif;
		}
		the_posts_navigation();
	?>
</div>