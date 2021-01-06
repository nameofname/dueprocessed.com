<?php

//////////////////////////////////////////////////////
//
// Globals
//
//////////////////////////////////////////////////////

$DP_FN_USED_REF_NUMS = array(); // keeps track of what reference numbers have been used
$DP_FN_SHORTCODES = array('due_processed_footnote', 'dpfn');

//////////////////////////////////////////////////////
//
// Footnote Markup
//
//////////////////////////////////////////////////////

function due_processed_footnotes_func($atts, $content = "") {
	global $DP_FN_USED_REF_NUMS; 
  
  if (isset($atts['referencereset']) && $atts['referencereset'] == 'true') {
    $DP_FN_USED_REF_NUMS = array();
  }
  
	$additional_attributes = '';
	if (isset($atts['referencenumber'])) {
		$display_number = $atts['referencenumber'];
		$additional_attributes = 'refnum="' . $display_number . '"';
	} else if (count($DP_FN_USED_REF_NUMS) == 0) {
		$display_number = 1;
	} else {
		$display_number = max($DP_FN_USED_REF_NUMS) + 1;
	}
  
  $content = do_shortcode($content); // render out any shortcodes within the contents
	
  $content = str_replace('<p>','', $content);
  $content = str_replace('</p>','<br /><br />', $content);
  
  // ensure that reference numbers restart when multiple posts are listed on a page, or when the referencereset attribute is present
  if (count($DP_FN_USED_REF_NUMS) == 0) {
    $additional_attributes .= ' data-dpfn-reset';
  }

  $data_num = str_replace('"',"\\\"", $display_number);

  $content = '
    <span class="footnote-wrapper footnote-hidden" data-dpfn="' . $data_num . '"> 
      <a class="footnote-anchor" data-dpfn="' . $data_num . '" href="javascript:void(0)" ' . $additional_attributes . '>' .
        '<sup>'.  $display_number . '</sup>' .
      '</a>' .
      '<span class="footnote-note" data-dpfn="' . $data_num . '">' .
          '<span class="footnote-note-number">' . 
            $data_num . 
            '<span class="footnote-note-sep">|</span>' . 
          '</span>' . 
          '<span class="footnote-note-content">' . $content . '</span>' .
          '<a class="footnote-cta" data-dpfn="' . $data_num . '">
            <span class="footnote-cta-more">More</span>
            <span class="footnote-cta-less">Less</span>
          </a>' .
      '</span>' . 
    '</span>'
    ;

	$DP_FN_USED_REF_NUMS[] = $display_number;
	return $content;
}

/**
 * Reset the footnote counter for every new post
 */
function due_processed_footnotes_reset_count() {
	global $DP_FN_USED_REF_NUMS;
	$DP_FN_USED_REF_NUMS = array();
}

foreach ($DP_FN_SHORTCODES as $shortcode) {
  add_shortcode($shortcode, 'due_processed_footnotes_func');
}

add_filter('the_post', 'due_processed_footnotes_reset_count');

/**
 * 
 * Replace <dpfn> HTML tags added by Gutenberg/block editor to [dpfn] shortcodes.
 * When multiple formats are applied, Gutenberg can have multiple <dpfn> tags for one footnote.
 * Iterate through the text and group sibling tags together (see https://github.com/seankwilliams/modern-footnotes/issues/14)
 * 
 */
function due_processed_footnotes_replace_dpfn_tag_with_shortcode($content = "") {
  $content = str_replace('</dpfn>', '<dpfn>', $content); // using [dpfn] instead of [/dpfn] is intentional here
  $content_parts = explode('<dpfn>', $content);
  $content_data = array();
  $in_footnote = false;

  foreach ($content_parts as $c) {
    $content_data[] = array(
      "content" => $c,
      "in_footnote" => $in_footnote
    );    
    $in_footnote = !$in_footnote;
  }

  $was_in_footnote = false;
  for ($i = 0; $i < count($content_data); $i++) {
    // if this is only opening tags or only closing tags, place it in the footnote
    $replacedString = preg_replace("/<\/?\\w+\\s?\\w?.*?>/ms", "", $content_data[$i]['content']);

    // check $was_in_footnote to fix https://github.com/seankwilliams/modern-footnotes/issues/18
    if (strlen($replacedString) === 0 && !$content_data[$i]['in_footnote'] && $was_in_footnote) { 
      $content_data[$i]['in_footnote'] = true;
    } else {
      $was_in_footnote = $content_data[$i]['in_footnote'];
    }
  }

  $final_content = '';
  $in_footnote = false;

  foreach ($content_data as $cd) {
    if ($cd['in_footnote'] && !$in_footnote) {
      $in_footnote = true;
      $final_content .= '[dpfn]';
    } else if ($in_footnote && !$cd['in_footnote']) {
      $in_footnote = false;
      $final_content .= '[/dpfn]';
    }
    
    $final_content .= $cd['content'];
  }

  if ($in_footnote) {
    $final_content .= '[/dpfn]';
  }

  return $final_content;
}

function due_processed_footnotes_append_footer($content = "") {
  return $content . '<div class="footnotes-footer"><div class="footnotes-footer-title">Footnotes</div></div>';
}

add_filter( 'the_content', 'due_processed_footnotes_replace_dpfn_tag_with_shortcode' );
add_filter( 'the_content', 'due_processed_footnotes_append_footer' );

//////////////////////////////////////////////////////
//
// CSS and JS Scripts
//
//////////////////////////////////////////////////////
 
// TODO: Add styles to main style sheet
function due_processed_footnotes_enqueue_scripts_styles() {
 	wp_enqueue_script('due-processed-footnotes', get_template_directory_uri() . '/js/footnotes.js', array(), DUE_PROCESSED_VERSION, true);
}

add_action('wp_enqueue_scripts', 'due_processed_footnotes_enqueue_scripts_styles');

//////////////////////////////////////////////////////
//
// RSS Feeds
//
//////////////////////////////////////////////////////

function due_processed_footnotes_return_blank_for_rss_func($atts, $content = "") {
  return "";
}

// remove shortcode from RSS feed
function due_processed_footnotes_remove_from_rss_feed($content) {
  foreach ($GLOBALS['DP_FN_SHORTCODES'] as $shortcode) {
    remove_shortcode($shortcode);
    add_shortcode($shortcode, 'due_processed_footnotes_return_blank_for_rss_func');
  }
  return $content;
}

add_filter('the_excerpt_rss', 'due_processed_footnotes_remove_from_rss_feed');
add_filter('the_content_feed', 'due_processed_footnotes_remove_from_rss_feed');
