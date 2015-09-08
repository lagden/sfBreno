'use strict';

import $ from 'jquery';
// import Flickity from 'flickity/dist/flickity.pkgd';
import Flickity from 'flickity-imagesloaded/flickity-imagesloaded';
import 'imagesloaded/imagesloaded';
import './lightbox';

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

// Lightbox
let $indica;
let $closeBtn;
let $overlay;

function activityIndicatorOn() {
	const str = '<div class="imagelightbox-loading"><div></div></div>';
	$indica = $(str).appendTo('body');
}

function activityIndicatorOff() {
	$indica.remove();
}

function closeButtonOn(instance) {
	const str = '<button type="button" class="imagelightbox-close"></button>';
	$closeBtn = $(str).appendTo('body').on('click touchend', () => {
		closeButtonOff();
		instance.quitImageLightbox();
		return false;
	});
}

function closeButtonOff() {
	$closeBtn.remove();
}

function overlayOn() {
	const srt = '<div class="imagelightbox-overlay"></div>';
	$overlay = $(srt).appendTo('body');
}

function overlayOff() {
	$overlay.remove();
}

const $lightbox = $estateGallery.find('.picWorks').imageLightbox({
	quitOnDocClick: false,
	onStart: () => {
		overlayOn();
		closeButtonOn($lightbox);
	},
	onEnd: () => {
		overlayOff();
		closeButtonOff();
		activityIndicatorOff();
	},
	onLoadStart: activityIndicatorOn,
	onLoadEnd: activityIndicatorOff
});
