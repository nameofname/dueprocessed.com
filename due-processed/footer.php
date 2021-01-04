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
						'theme_location' => 'footer-menu',
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
					<h3 class="sign-up-title">Sign Up For Email Updates</h3>
				</div>
				<div class="site-info-row">
					<!--TODO: make this work -->
					<form role="email" method="post" class="email-form" action="http://localhost:8000/">
						<input type="email" class="email-field" placeholder="Enter Email Address" value="" name="email">
						<input type="submit" class="email-submit" value="Submit">
					</form>
				</div>
				<div class='site-info-row copyright-mobile'>
					<?php
					echo $copyright;
					?>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
