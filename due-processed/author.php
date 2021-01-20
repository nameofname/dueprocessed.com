<?php
/**
 * The template for displaying author pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#author-display
 *
 * @package Due_Processed
 */

get_header();

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$photo_element = get_avatar( $curauth->user_email , '90', '', '', array('class' => 'author-profile-photo-desktop'));

$display_name = isset($curauth->display_name) ? $curauth->display_name : $curauth->user_nicename;

// to prevent bots from picking up emails for spam
$email = $curauth->user_email;
$parts = explode('@', $email);
$left_parts = str_split($parts[0], 2);
$right_parts = str_split($parts[1], 2);
$author_email_parts = array(
	left_side => $left_parts,
	right_side => $right_parts
);
?>

<main id="primary" class="site-main site-main-author">
	<div class='author-profile'>

		<!-- mobile photo, title, and name -->
		<div class='author-profile-photo-name-container-mobile'>
			<?php echo get_avatar( $curauth->user_email , '90', '', '', array('class' => 'author-profile-photo-mobile')); ?>
			<div class='author-profile-name-title-container'>
				<?php if ( get_the_author_meta( 'title' )) { ?>
					<div class='author-profile-title-mobile'>
						<?php the_author_meta( 'title' ) ?>
					</div>
				<?php } ?>
				<h1 class='author-profile-name-mobile'>
					<?php echo $display_name; ?>
				</h1>
			</div>
		</div>

		<!-- desktop title and name -->
		<?php if ( get_the_author_meta( 'title' )) { ?>
			<div class='author-profile-title-desktop'>
				<?php the_author_meta( 'title' ) ?>
			</div>
		<?php } ?>
		<h1 class='author-profile-name-desktop'>
			<?php echo $display_name; ?></h2>
		</h1>

		<div class='author-profile-body'>

			<!-- desktop photo -->
			<?php echo get_avatar( $curauth->user_email , '90', '', '', array('class' => 'author-profile-photo-desktop')); ?>

			<!-- bio -->
			<div class='author-profile-bio'>
				<?php echo $curauth->user_description; ?>
			</div>

			<!-- contact information -->
			<div class='author-profile-body-right'>
				<?php if ( get_the_author_meta( 'twitter' )) { ?>
					<div class='author-profile-contact-info'>
						<span class="author-profile-icon">
							<?php get_template_part( 'template-parts/icon', 'twitter' ); ?>
						</span>
						<div class='author-profile-twitter'>
							<?php the_author_meta( 'twitter' ) ?>
						</div>
					</div>
				<?php } ?>
				<div class='author-profile-contact-info'>
					<span class="author-profile-icon">
						<?php get_template_part( 'template-parts/icon', 'email' ); ?>
					</span>
					<div class='author-profile-email'>
						<script>
							function dpMailTo() {
								const parts = <?php echo json_encode($author_email_parts); ?>;
								const link = document.getElementById('mailToLink');
								const href = link.getAttribute('href');
								const address = parts.left_side.join('') + '@' + parts.right_side.join('');
								const settings = '?subject=DueProcessed.com+contact'
								link.setAttribute('target', '_blank');
								link.setAttribute('href', 'mailto:' + address + settings);
							}
						</script>
						<a href="#" id="mailToLink" onClick="dpMailTo()">Contact <?php echo $display_name ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if ( have_posts() ) :
		get_template_part( 'template-parts/content', 'posts-container' );
		endif;
	?>
</main>

<?php
get_footer();
