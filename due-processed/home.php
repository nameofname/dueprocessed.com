<?php

function due_processed_featured_articles_enqueue_scripts() {
	wp_enqueue_script('due-processed-featured-articles', get_template_directory_uri() . '/js/featured-articles.js', array(), DUE_PROCESSED_VERSION, true);
}

add_action('wp_enqueue_scripts', 'due_processed_featured_articles_enqueue_scripts');

get_header();

get_template_part('template-parts/content', 'featured-articles');
?>

	<main id="primary" class="site-main">
		<?php
		if ( have_posts() ) :

			get_template_part('template-parts/content', 'posts-container');

		else :

			get_template_part( 'template-parts/content', 'posts-container-none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
