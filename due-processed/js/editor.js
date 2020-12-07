
( function( wp ) {
	const { __ } = wp.i18n;
	const DueProcessedFootnotesButton = function( props ) {
		return wp.element.createElement(
			wp.editor.RichTextToolbarButton, {
				icon: wp.element.createElement( 'span', { className: 'due-processed-footnotes-admin-button' } ),
				title: __( 'Add a Footnote', 'due-processed-footnotes' ),
				onClick() {
					props.onChange( wp.richText.toggleFormat(
						props.value,
						{ type: 'due-processed-footnotes/footnote' }
					) );
				},
				isActive: props.isActive,
			}
		);
	};
	wp.richText.registerFormatType(
		'due-processed-footnotes/footnote', {
			title: 'Due Processed Footnote',
			tagName: 'dpfn',
			className: null,
			edit: DueProcessedFootnotesButton,
		}
	);

	const el = wp.element.createElement;
	const RichText = wp.editor.RichText;

	wp.blocks.registerBlockType( 'due-processed/custom-paragraph', {
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
}( window.wp ) );
