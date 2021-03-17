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

$copyright = sprintf( esc_html__( '© %1$s %2$s', 'due-processed' ), date('Y'), get_bloginfo('name'));

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div class="site-info-left">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'site-info-menu',
					)
				);
				?>
				<div class='site-info-row copyright-desktop'>
					<?php
					echo $copyright;
					?>
				</div>
			</div>
			<div class="site-info-right">
				<div class="site-info-row">
					<?php get_sidebar( 'footer' ); ?>
				</div>
				<div class='site-info-row copyright-mobile'>
					<?php
					echo $copyright;
					?>
				</div>
				<div class='footer-subscribe-form'>
					<?php
						$reusable_block = get_post(214); // you have to manually enter the post id
						echo apply_filters( 'the_content', $reusable_block->post_content );
					?>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
