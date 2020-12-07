/* eslint-disable jsdoc/require-returns-check, no-unused-vars, no-console, jsdoc/require-param */
'use strict';

const LAYOUTS = {
	STACKED: 'STACKED',
	INLINE: 'INLINE',
};

const CLASSNAMES = {
	/* Structural Classes */
	WRAPPER: 'footnote-wrapper',
	ANCHOR: 'footnote-anchor',
	NOTE: 'footnote-note',

	/* Layout Classes */
	STACKED: 'footnote-stacked',
	INLINE: 'footnote-inline',

	/* State Classes */
	HIDDEN: 'footnote-hidden',
	OPEN: 'footnote-open',
};

const STACKED_FOOTNOTE_SPACING = 20;

/**
 * Toggle "OPEN" class on matching "WRAPPER" element.
 *
 * @param {*} event
 * @param {*} closeOpened - If "true", removes "OPEN" class from all non-matching "WRAPPER" elements.
 */
function toggleOpenState( event, closeOpened = true ) {
	event.preventDefault();
	const footnoteNum = event.currentTarget.dataset.dpfn;
	if ( footnoteNum ) {
		const el = document.querySelector( `.${ CLASSNAMES.WRAPPER }[data-dpfn="${ footnoteNum }"]` );

		if ( el.classList.contains( CLASSNAMES.OPEN ) ) {
			el.classList.remove( CLASSNAMES.OPEN );
		} else {
			el.classList.add( CLASSNAMES.OPEN );
		}

		if ( closeOpened ) {
			const footnoteEls = Array.from( document.querySelectorAll( `.${ CLASSNAMES.WRAPPER }` ) ) || [];
			footnoteEls.forEach( ( footnoteEl ) => {
				if ( footnoteEl.dataset.dpfn !== footnoteNum ) {
					footnoteEl.classList.remove( CLASSNAMES.OPEN );
				}
			} );
		}
	}
}

/**
 * Stacked Layout Setup
 *
 * @return {function(): void} Cleanup function removes sidebar classes and event listeners
 */
function setUpStackedLayout() {
	function onAnchorOrFootnoteClick( event ) {
		toggleOpenState( event );
	}

	const footnoteWrapperEls = Array.from( document.querySelectorAll( `.${ CLASSNAMES.WRAPPER }` ) ) || [];
	footnoteWrapperEls.forEach( ( footnoteWrapperEl ) => {
		footnoteWrapperEl.classList.add( CLASSNAMES.STACKED );
	} );

	const footnoteEls = Array.from( document.querySelectorAll( `.${ CLASSNAMES.NOTE }` ) ) || [];
	footnoteEls.sort( ( a, b ) => {
		const aNum = Number( a.dataset.dpfn );
		const bNum = Number( b.dataset.dpfn );
		return aNum - bNum;
	} );

	const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
	const articleEl = document.querySelector( 'article' );
	const articleOffset = articleEl.getBoundingClientRect().top + scrollTop;

	const [ heights, offsets ] = footnoteEls.reduce( ( acc, footnoteEl ) => {
		const rect = footnoteEl.getBoundingClientRect();

		acc[ 0 ].push( rect.height );
		acc[ 1 ].push( ( rect.top + scrollTop ) - articleOffset );
		return acc;
	}, [ [], [] ] );

	const tops = [];

	footnoteEls.forEach( ( footnoteEl, index ) => {
		if ( index === 0 ) {
			tops.push( offsets[ 0 ] );
		}

		if ( index > 0 ) {
			const top = Math.max( tops[ index - 1 ] + heights[ index - 1 ] + STACKED_FOOTNOTE_SPACING, offsets[ index ] );
			tops.push( top );
		}

		footnoteEl.setAttribute( 'style', `top: ${ tops[ index ] }px;` );
	} );

	const anchorEls = Array.from( document.querySelectorAll( `.${ CLASSNAMES.ANCHOR }` ) ) || [];
	anchorEls.forEach( ( anchorEl ) => {
		anchorEl.addEventListener( 'click', onAnchorOrFootnoteClick );
	} );

	footnoteWrapperEls.forEach( ( footnoteWrapperEl ) => {
		footnoteWrapperEl.classList.remove( CLASSNAMES.HIDDEN );
	} );

	return function cleanUpStackedLayout() {
		footnoteWrapperEls.forEach( ( footnoteWrapperEl ) => {
			footnoteWrapperEl.classList.remove( CLASSNAMES.STACKED );
			footnoteWrapperEl.classList.add( CLASSNAMES.HIDDEN );
		} );
		footnoteEls.forEach( ( footnoteEl ) => {
			footnoteEl.removeAttribute( 'style' );
		} );
		anchorEls.forEach( ( anchorEl ) => {
			anchorEl.removeEventListener( 'click', onAnchorOrFootnoteClick );
		} );
	};
}

/**
 * Inline Layout Setup
 *
 * @return {function(): void} Cleanup function removes inline classes and event listeners
 */
function setUpInlineLayout() {
	function onAnchorOrCloseBtnClick( event ) {
		toggleOpenState( event, false );
	}
	const footnoteWrapperEls = Array.from( document.querySelectorAll( `.${ CLASSNAMES.WRAPPER }` ) ) || [];
	footnoteWrapperEls.forEach( ( footnoteWrapperEl ) => {
		footnoteWrapperEl.classList.add( CLASSNAMES.INLINE );
		footnoteWrapperEl.classList.remove( CLASSNAMES.HIDDEN );
	} );
	const anchorEls = Array.from( document.querySelectorAll( `.${ CLASSNAMES.ANCHOR }` ) ) || [];
	anchorEls.forEach( ( anchorEl ) => {
		anchorEl.addEventListener( 'click', onAnchorOrCloseBtnClick );
	} );

	return function cleanUpInlineLayout() {
		footnoteWrapperEls.forEach( ( footnoteWrapperEl ) => {
			footnoteWrapperEl.classList.remove( CLASSNAMES.INLINE );
			footnoteWrapperEl.classList.add( CLASSNAMES.HIDDEN );
		} );
		anchorEls.forEach( ( anchorEl ) => {
			anchorEl.removeEventListener( 'click', onAnchorOrCloseBtnClick );
		} );
	};
}

document.addEventListener( 'DOMContentLoaded', function() {
	// If there are no footnotes, bail early.
	if ( document.querySelector( `.${ CLASSNAMES.WRAPPER }` ) === null ) {
		return null;
	}

	function getFootenoteLayout() {
		return window.innerWidth > 768 ? LAYOUTS.STACKED : LAYOUTS.INLINE;
	}

	let currentFootnoteLayout = getFootenoteLayout();
	let cleanUpCurrentLayout = () => {};
	let setUpNextLayout = () => {};
	let isCleaning = false;

	if ( currentFootnoteLayout === LAYOUTS.STACKED ) {
		cleanUpCurrentLayout = setUpStackedLayout();
		setUpNextLayout = setUpInlineLayout;
	}

	if ( currentFootnoteLayout === LAYOUTS.INLINE ) {
		cleanUpCurrentLayout = setUpInlineLayout();
		setUpNextLayout = setUpStackedLayout;
	}

	window.addEventListener( 'orientationchange', function() {
		const footnoteWrapperEls = Array.from( document.querySelectorAll( `.${ CLASSNAMES.WRAPPER }` ) ) || [];
		if ( footnoteWrapperEls.length > 0 ) {
			footnoteWrapperEls.forEach( ( footnoteWrapperEl ) => {
				footnoteWrapperEl.classList.remove( CLASSNAMES.HIDDEN );
			} );
		}
	} );

	// TODO: Throttle!!!!
	window.addEventListener( 'resize', function() {
		const nextFootnoteLayout = getFootenoteLayout();
		if ( nextFootnoteLayout !== currentFootnoteLayout && isCleaning !== true ) {
			isCleaning = true;
			cleanUpCurrentLayout();
			cleanUpCurrentLayout = setUpNextLayout();

			currentFootnoteLayout = nextFootnoteLayout;
			setUpNextLayout = nextFootnoteLayout === LAYOUTS.STACKED ? setUpInlineLayout : setUpStackedLayout;

			isCleaning = false;
		}
	} );
} );
