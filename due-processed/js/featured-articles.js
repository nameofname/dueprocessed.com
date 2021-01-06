// from https://davidwalsh.name/javascript-debounce-function
function debounce( func, wait, immediate ) {
	let timeout;
	return function() {
		const context = this;
		const args = arguments;
		const later = function() {
			timeout = null;
			if ( ! immediate ) {
				func.apply( context, args );
			}
		};
		const callNow = immediate && ! timeout;
		clearTimeout( timeout );
		timeout = setTimeout( later, wait );
		if ( callNow ) {
			func.apply( context, args );
		}
	};
}

const FEATURED_ARTICLE_CLASSNAMES = {
	WRAPPER: 'featured-article-wrapper-inner',
	ARTICLE_CONTAINER: 'featured-article-container',
	CAROUSEL_DOTS_WRAPPER: 'featured-article-carousel-dots-wrapper',
	CAROUSEL_DOT: 'featured-article-carousel-dot',
	CAROUSEL_DOT_SELECTED: 'featured-article-carousel-dot-selected',
};

// apply 'selected' class to first argument dotElement, and remove it from other dots
const selectDotElement = ( dotElement, allDots ) => {
	allDots.forEach( ( dot ) => {
		dot.classList.remove( FEATURED_ARTICLE_CLASSNAMES.CAROUSEL_DOT_SELECTED );
	} );
	dotElement.classList.add( FEATURED_ARTICLE_CLASSNAMES.CAROUSEL_DOT_SELECTED );
};

document.addEventListener( 'DOMContentLoaded', function() {
	const articlesWrapper = document.querySelector( `.${ FEATURED_ARTICLE_CLASSNAMES.WRAPPER }` );
	const articleEls = Array.from( document.querySelectorAll( `.${ FEATURED_ARTICLE_CLASSNAMES.ARTICLE_CONTAINER }` ) ) || [];

	if ( articlesWrapper === null || articleEls.length < 1 ) {
		return null;
	}

	const dotsWrapper = document.querySelector( `.${ FEATURED_ARTICLE_CLASSNAMES.CAROUSEL_DOTS_WRAPPER }` );
	const allDots = [];

	articleEls.forEach( ( articleEl ) => {
		const dotElement = document.createElement( 'div' );
		dotElement.classList.add( FEATURED_ARTICLE_CLASSNAMES.CAROUSEL_DOT );
		dotElement.addEventListener( 'click', () => {
			articlesWrapper.scrollTo( {
				top: 0,
				left: articleEl.offsetLeft,
				behavior: 'smooth',
			} );
			selectDotElement( dotElement, allDots );
		} );
		dotsWrapper.appendChild( dotElement );
		allDots.push( dotElement );
	} );

	selectDotElement( allDots[ 0 ], allDots );

	articlesWrapper.addEventListener( 'scroll', debounce( () => {
		const scrollLeft = articlesWrapper.scrollLeft;
		const articleWidth = articleEls[ 0 ].clientWidth;
		const numToSelect = Math.floor( scrollLeft / articleWidth );
		selectDotElement( allDots[ numToSelect ], allDots );
	}, 100 ) );
} );
