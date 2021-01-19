<?php

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) : the_post(); ?>
			<div class="about-container">
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			</div>

			<?php
			// Authors
			$authors = carbon_get_the_post_meta( 'authors' );
			if( $authors ):?>
				<div class='masthead-container'>
					<h1 class='masthead-header'>Authors</h1>
					<div class='masthead'>
						<?php foreach( $authors as $author ): ?>
							<div class='masthead-item'>
								<?php echo wp_get_attachment_image( $author['image'], 'thumbnail', false, array('alt' => 'Author avatar', 'class' => 'masthead-image')); ?>
								<div class='masthead-text'>
									<p class='masthead-title'><?php echo $author['title']; ?></p>
									<p class='masthead-name'><?php echo $author['name']; ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php
get_footer();
