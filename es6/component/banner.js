'use strict';

import $ from 'jquery';
import Flickity from 'flickity-imagesloaded/flickity-imagesloaded';
import 'imagesloaded/imagesloaded';

function changeCaption($el, v) {
	$el.empty().text(v);
}

const $homeGallery = $('#homeGallery');
if ($homeGallery.length > 0) {
	$homeGallery
		.imagesLoaded()
		.done(() => {
			$homeGallery.addClass('home-gallery--done');
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
		});
}

const $estateGallery = $('#estateGallery');
if ($estateGallery.length > 0) {
	$estateGallery
		.imagesLoaded()
		.done(() => {
			$estateGallery.addClass('estate-gallery--done');
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
		});
}
