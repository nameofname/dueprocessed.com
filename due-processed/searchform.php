<div class="search-form-wrapper">
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <label class="search-form-label">
            <span class="screen-reader-text"><?php echo _x( 'Search', 'label' ) ?></span>
            <input 
                type="search" 
                class="search-field"
                autocomplete="off" 
                autocorrect="off" 
                spellcheck="false"
                placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
                value="<?php echo get_search_query() ?>" name="s"
                title="<?php echo esc_attr_x( 'Search', 'label' ) ?>" />
        </label>
        <button type="submit" aria-label="Search" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" >
            <?php get_template_part( 'template-parts/icon', 'search' ); ?>
        </button>
    </form>
</div>