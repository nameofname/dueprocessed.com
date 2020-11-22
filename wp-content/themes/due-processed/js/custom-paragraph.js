( function( blocks, editor, element ) {
	const el = element.createElement;
	const RichText = editor.RichText;

	blocks.registerBlockType( 'due-processed/custom-paragraph', {
		title: 'Custom Paragraph (dueprocessed)',
		icon: 'editor-paragraph',
		category: 'text',

		attributes: {
			content: {
				type: 'array',
				source: 'children',
				selector: 'p',
			},
		},
		example: {
			attributes: {
				content: 'Hello World',
			},
		},
		edit( props ) {
			const content = props.attributes.content;
			function onChangeContent( newContent ) {
				props.setAttributes( { content: newContent } );
			}

			return el(
				'div',
				{
					className: props.className,
				},
				el( RichText, {
					tagName: 'p',
					onChange: onChangeContent,
					value: content,
				} ) );
		},

		save( props ) {
			return el(
				'div',
				{},
				el( RichText.Content, {
					tagName: 'p',
					value: props.attributes.content,
				} ) );
		},
	} );
}( window.wp.blocks, window.wp.editor, window.wp.element ) );
