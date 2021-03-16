<?php

//////////////////////////////////////////////////////
//
// Globals
//
//////////////////////////////////////////////////////

$DP_MASTHEAD_SHORTCODES = array('due_processed_author_masthead');

//////////////////////////////////////////////////////
//
// Carbon Fields
//
//////////////////////////////////////////////////////

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function due_processed_masthead_crb_attach_post_meta() {
	$post = get_page_by_path( '/about/', OBJECT, 'page');
	$id = $post ? $post->ID : null;
	Container::make( 'post_meta', __( 'Page Options' ) )
		->where( 'post_id', '=', $id )
		->add_fields( array(
			Field::make( 'complex', 'authors', 'Authors' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(
					Field::make( 'image', 'image', 'Image' ),
					Field::make( 'text', 'title', 'Title' ),
					Field::make( 'text', 'name', 'Name' ),
				) ),
		) );
}
add_action( 'carbon_fields_register_fields', 'due_processed_masthead_crb_attach_post_meta' );

//////////////////////////////////////////////////////
//
// Masthead Markup
//
//////////////////////////////////////////////////////

function due_processed_masthead_func($atts, $content = "") {

	$ret = '';
	$authors = carbon_get_the_post_meta( 'authors' );

	if ($authors) {

		$ret .= '
			<div class="masthead-container">
				<h2 class="masthead-header">Authors</h2>
				<div class="masthead">
		';

		foreach ($authors as $author) {
			$ret.= '
				<div class="masthead-item">' .
					wp_get_attachment_image( $author["image"], "thumbnail", false, array("alt" => "Author avatar", "class" => "masthead-image")) .
					'<div class="masthead-text">
						<p class="masthead-title">' . $author["title"] . '</p>
						<p class="masthead-name">' . $author["name"] . '</p>
					</div>
				</div>
			';
		}

		$ret .= '
				</div>
			</div>
		';
	}
	return $ret;
}

foreach ($DP_MASTHEAD_SHORTCODES as $shortcode) {
  add_shortcode('due_processed_author_masthead', 'due_processed_masthead_func');
}

//////////////////////////////////////////////////////
//
// RSS Feeds
//
//////////////////////////////////////////////////////

function due_processed_masthead_return_blank_for_rss_func($atts, $content = "") {
  return "";
}

function due_processed_masthead_remove_from_rss_feed($content) {
  foreach ($GLOBALS['DP_MASTHEAD_SHORTCODES'] as $shortcode) {
    remove_shortcode($shortcode);
    add_shortcode($shortcode, 'due_processed_masthead_return_blank_for_rss_func');
  }
  return $content;
}

add_filter('the_excerpt_rss', 'due_processed_masthead_remove_from_rss_feed');
add_filter('the_content_feed', 'due_processed_masthead_remove_from_rss_feed');