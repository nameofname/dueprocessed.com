
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
}( window.wp ) );
