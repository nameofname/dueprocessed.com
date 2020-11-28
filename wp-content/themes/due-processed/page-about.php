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
			echo $authors;
			echo count($authors);
			if( $authors ):?>
				<h1 class='masthead-header'>Authors</h1>
				<div class='masthead'>
					<?php foreach( $authors as $author ): ?>
						<div class='masthead-item'>
							<?php echo wp_get_attachment_image( $author['image'], 'thumbnail', false, array('alt' => 'Author avatar', 'class' => 'masthead-image')); ?>
							<p class='masthead-title'><?php echo $author['title']; ?></p>
							<p class='masthead-name'><?php echo $author['name']; ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php
get_sidebar();
get_footer();
