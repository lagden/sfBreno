'use strict';

import $ from 'jquery';
import Flickity from 'flickity/dist/flickity.pkgd';

const $staticBannerHome = $('#staticBannerHome');
const flktyHome = new Flickity('#homeGallery', {
	cellSelector: '.gallery-cell',
	imagesLoaded: true,
	pageDots: false,
	autoPlay: true,
	wrapAround: true,
	prevNextButtons: true,
	draggable: false,
	resize: true,
	lazyLoad: true
});

function changeCaption(v) {
	$staticBannerHome.empty().text(v);
}

flktyHome.on('cellSelect', () => {
	changeCaption(flktyHome.selectedElement.lastElementChild.textContent);
});

flktyHome.resize();
