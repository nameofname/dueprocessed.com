<?php
get_header();
?>
	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) : the_post(); ?>
			<div class="about-container">
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			</div>
		<?php endwhile; ?>
	</main><!-- #main -->
<?php
get_footer();
