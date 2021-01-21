<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Due_Processed
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function due_processed_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'due_processed_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function due_processed_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'due_processed_pingback_header' );
 
function due_processed_get_category_name_header() {
	global $wp_query;
	global $post; 
	$cat = get_the_category($post->ID);
	$posts_found = $wp_query->found_posts;

	$cat_name = '';
	if (! empty( $cat )) {
		$cat_name = $cat[0]->cat_name;
	}

	if ( $posts_found ) {
		// # results for "<category>"
		$subheading = sprintf(
			esc_html__( '%1$s for "%2$s"', 'due-processed' ),
			$posts_found === 1 ? 'Result' : 'Results',
			$cat_name
		);
	} else {
		$subheading = esc_html__('No results for "'. $cat_name .'"', 'due-processed');
	}
	/* translators: %s: search query. */
	printf( normalize_whitespace($subheading) );

}

function due_processed_get_search_header() {
	// Custom search results subheading
	global $wp_query;
	$posts_found    = $wp_query->found_posts;
	$query_value = get_search_query( false );
	if ( $posts_found ) {
		// # results for "<query>"
		$subheading = sprintf(
			esc_html__( '%1$s %2$s for "%3$s"', 'due-processed' ),
			$posts_found,
			$posts_found === 1 ? 'result' : 'results',
			$query_value
		);
	} else {
		$subheading = esc_html__('No results for "'. $query_value .'"', 'due-processed');
	}
	/* translators: %s: search query. */
	printf( normalize_whitespace($subheading) );
}

function recent_posts() {

    $args = array(
        'posts_per_page' => 4, /* how many post you need to display */
        'offset' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post', /* your post type name */
        'post_status' => 'publish'
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
			echo get_template_part( 'template-parts/content', 'excerpt' );
        endwhile;
    endif;
}