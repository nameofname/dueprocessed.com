<?php
/**
 * Shared Counts, add a Small Circle style
 * @see https://sharedcountsplugin.com/2019/05/13/creating-new-button-styles/
 */
function due_processed_shared_counts_styles( $styles ) {
    $styles['small-circle'] = 'Small Circle';
    return $styles;
}
add_filter( 'shared_counts_styles', 'due_processed_shared_counts_styles' );
