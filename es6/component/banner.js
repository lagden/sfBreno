'use strict';

import Flickity from 'flickity/dist/flickity.pkgd';
import $ from 'jquery';
import './lightbox';

function changeCaption($el, v) {
	$el.empty().text(v);
}

const $homeGallery = $('#homeGallery');
if ($homeGallery.length > 0) {
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
}

const $estateGallery = $('#estateGallery');
const isMobile = Number($estateGallery.data('mobile')) || 0;

if ($estateGallery.length > 0) {
	$estateGallery.addClass('estate-gallery--done');
	const flktyGallery = new Flickity($estateGallery[0], {
		cellSelector: '.gallery-cell',
		imagesLoaded: true,
		pageDots: false,
		autoPlay: false,
		contain: true,
		// wrapAround: true,
		prevNextButtons: !isMobile,
		draggable: isMobile,
		resize: true,
		lazyLoad: false
	});
	flktyGallery.resize();
}

// Lightbox
let $indica;
let $closeBtn;
let $overlay;
let $arrows;

function arrowsOn(instance) {
	const selector = instance.selector;
	const $selector = $(selector);
	const str = [
		'<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left">',
		'<svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path></svg>',
		'</button>',
		'<button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"><svg viewBox="0 0 100 100">',
		'<path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path></svg>',
		'</button>'
	].join('');
	$arrows = $(str).appendTo('body');
	$arrows.on('click touchend', e => {
		e.preventDefault();
		const $this	= $(e.currentTarget);
		const $target	= $(`${selector}[href="${$('#imagelightbox').attr('src')}"]`);
		let index	= $target.index(selector);
		if ($this.hasClass('imagelightbox-arrow-left')) {
			index += -1;
			if ($selector.eq(index).length === 0) {
				index = $selector.length;
			}
		} else {
			index += 1;
			if ($selector.eq(index).length === 0) {
				index = 0;
			}
		}
		instance.switchImageLightbox(index);
		return false;
	});
}

function arrowsOff() {
	$arrows.remove();
}

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
		if (!isMobile) {
			arrowsOn($lightbox);
		}
	},
	onEnd: () => {
		overlayOff();
		closeButtonOff();
		activityIndicatorOff();
		if (!isMobile) {
			arrowsOff();
		}
	},
	onLoadStart: activityIndicatorOn,
	onLoadEnd: activityIndicatorOff
});
