<?php
get_header();
?>

	<main id="primary" class="site-main">
		<h2 class="page-title">Featured Articles</h2>
		<div class="featured-article-wrapper">
			<div class="featured-article-container">
				<div class="featured-article-content">
					<h3 class="featured-article-header">Soft kitty warm kitty little ball of furr wake up wander around the house</h3>
					<p class="featured-article-lede">Scream at teh bath chase laser chase the pig around the house sleep in the bathroom sink Steal raw zucchini off kitchen counter. I am the best hide at bottom of staircase to trip human prance along on top of the garden fence, annoy the neighbor's dog and make it bark for hide head under blanket so no one can see so if it smells like fish</p>
					<a href="#" class="button">Read More</a>
				</div>
				<div class="featured-article-image-container">
					<img class="featured-article-image" alt="" src="<?= get_template_directory_uri() ?>/images/homepage-splash.jpg" />
				</div>
			</div>
		</div>

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
