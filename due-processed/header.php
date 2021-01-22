<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Due_Processed
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'due-processed' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-print-header">
			<div class="site-print-branding-link">
				<?php get_template_part( 'template-parts/icon', 'logo' ); ?>
			</div>
		</div>
		<div class="site-header-top">
			<button id="site-navigation-icon" class="main-navigation-icon" aria-controls="primary-menu" aria-expanded="false">
				<span class="main-navigation-hamburger">
					<?php get_template_part( 'template-parts/icon', 'hamburger' ); ?>
				</span>
				<span class="main-navigation-close">
					<?php get_template_part( 'template-parts/icon', 'x' ); ?>
				</span>
			</button>
			<div class="site-branding">
				<a class="site-branding-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php get_template_part( 'template-parts/icon', 'logo' ); ?>
				</a>
			</div><!-- .site-branding -->

			<?php get_search_form(); ?>
		</div>

		<div class="site-header-bottom">
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
