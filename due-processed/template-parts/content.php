<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Due_Processed
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_singular() ) :
		due_processed_post_thumbnail();
	endif;
	?>

	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) :
			due_processed_categories_list();
		endif; 

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
                        ?><div class="entry-title-sep"></div><?php
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
		<footer class="entry-footer">
			<?php due_processed_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</header><!-- .entry-header -->

	<?php
	if ( !is_singular() ) :
		due_processed_post_thumbnail();
	endif;
	?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'due-processed' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
