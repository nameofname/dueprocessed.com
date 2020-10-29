<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Due_Processed
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( '© %1$s %2$s', 'due-processed' ), date('Y'), get_bloginfo('name') );	
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
