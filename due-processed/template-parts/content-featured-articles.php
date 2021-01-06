<?php
$featured = new WP_Query( array( 'tag' => 'featured', 'posts_per_page' => 5, 'max_num_pages' => 1 ) );
if ( $featured->have_posts() ) : ?>
	<h2 class="page-title featured-article-title">Featured Articles</h2>
	<div class="featured-article-wrapper-outer">
		<div class="featured-article-wrapper-inner">
			<?php while ($featured->have_posts()) : $featured->the_post() ?>
				<div class="featured-article-container">
					<div class="featured-article-content">
						<h3 class="featured-article-header"><?= the_title() ?></h3>
						<div class="featured-article-lede"><?= the_excerpt() ?></div>
						<a href="<?= the_permalink() ?>" class="button">Read More</a>
					</div>
					<div class="featured-article-image-container">
						<?= the_post_thumbnail('post-thumbnail', ['class' => 'featured-article-image']) ?>
					</div>
				</div>
			<?php endwhile ?>
		</div>
	</div>
	<div class="featured-article-carousel-dots-wrapper">
		<!-- created by script -->
	</div>
<?php
endif;
wp_reset_postdata();
