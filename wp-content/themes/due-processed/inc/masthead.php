<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function crb_attach_post_meta() {
	Container::make( 'post_meta', __( 'Page Options' ) )
		>where( 'post_template', '=', 'page-about.php' )
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
add_action( 'carbon_fields_register_fields', 'crb_attach_post_meta' );
