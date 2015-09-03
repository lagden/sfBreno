'use strict';

import $ from 'jquery';
import Flickity from 'flickity-imagesloaded/flickity-imagesloaded';

function changeCaption($el, v) {
	$el.empty().text(v);
}

const $homeGallery = $('#homeGallery');
if ($homeGallery.length > 0) {
	const $staticBannerHome = $('#staticBannerHome');
	const flktyHome = new Flickity($homeGallery[0], {
		cellSelector: '.gallery-cell',
		imagesLoaded: true,
		pageDots: false,
		autoPlay: true,
		wrapAround: true,
		prevNextButtons: true,
		draggable: false,
		resize: true,
		lazyLoad: false
	});
	flktyHome.on('cellSelect', () => {
		changeCaption($staticBannerHome, flktyHome.selectedElement.lastElementChild.textContent);
	});
	flktyHome.resize();
}

const $estateGallery = $('#estateGallery');
if ($estateGallery.length > 0) {
	const flktyGallery = new Flickity($estateGallery[0], {
		cellSelector: '.gallery-cell',
		imagesLoaded: true,
		pageDots: false,
		autoPlay: true,
		wrapAround: true,
		prevNextButtons: true,
		draggable: false,
		resize: true,
		lazyLoad: false
	});
	flktyGallery.resize();
}
