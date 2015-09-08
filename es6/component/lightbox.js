/* global Image */
'use strict';

import $ from 'jquery';
import getStyleProperty from 'get-style-property/get-style-property';

const document = window.document;
const $win = $(window);
const $doc = $(document);
const transform = getStyleProperty('transform');
const transition = getStyleProperty('transition');
const hasTouch = ('ontouchstart' in window);
const hasPointers = window.navigator.pointerEnabled || window.navigator.msPointerEnabled;

function cssTransitionTranslateX(element, positionX, speed) {
	const options = {};
	options[transform] = `translateX(${positionX})`;
	options[transition] = `${transform} ${speed}s`;
	element.css(options);
}

function wasTouched(event) {
	if (hasTouch) {
		return true;
	}

	if (!hasPointers || typeof event === 'undefined' || typeof event.pointerType === 'undefined') {
		return false;
	}

	if (typeof event.MSPOINTER_TYPE_MOUSE !== 'undefined') {
		if (event.MSPOINTER_TYPE_MOUSE !== event.pointerType) {
			return true;
		}
	} else if (event.pointerType !== 'mouse') {
		return true;
	}
	return false;
}

function imageLightbox(opts) {
	const original = {
		selector: 'id="imagelightbox"',
		allowedTypes: 'png|jpg|jpeg|gif',
		animationSpeed: 250,
		preloadNext: true,
		enableKeyboard: true,
		quitOnEnd: false,
		quitOnImgClick: false,
		quitOnDocClick: true,
		onStart: false,
		onEnd: false,
		onLoadStart: false,
		onLoadEnd: false
	};
	const options = $.extend(original, opts);

	let targets = $([]);
	let target = $();
	let image = $();
	let imageWidth = 0;
	let imageHeight = 0;
	let inProgress = false;
	let swipeDiff = 0;

	function isTargetValid(element) {
		const $el = $(element);
		return $el.prop('tagName').toLowerCase() === 'a' && (new RegExp(`\.(${options.allowedTypes})$`, 'i')).test($el.attr('href'));
	}

	function setImage() {
		if (!image.length) {
			return true;
		}

		const screenWidth = $win.width() * 0.8;
		const screenHeight = $win.height() * 0.9;
		const tmpImage = new Image();

		tmpImage.src = image.attr('src');
		tmpImage.onload = () => {
			imageWidth = tmpImage.width;
			imageHeight = tmpImage.height;

			if (imageWidth > screenWidth || imageHeight > screenHeight) {
				const ratio = imageWidth / imageHeight > screenWidth / screenHeight ? imageWidth / screenWidth : imageHeight / screenHeight;
				imageWidth /= ratio;
				imageHeight /= ratio;
			}

			image.css({
				width: `${imageWidth}px`,
				height: `${imageHeight}px`,
				top: `${($win.height() - imageHeight) / 2}px`,
				left: `${($win.width() - imageWidth) / 2}px`
			});
		};
	}

	function loadImage(direction) {
		if (inProgress) {
			return false;
		}

		if (typeof direction === 'undefined') {
			direction = false;
		} else {
			direction = direction === 'left' ? 1 : -1;
		}

		if (image.length) {
			if (direction !== false && (targets.length < 2 || (options.quitOnEnd === true && ((direction === -1 && targets.index(target) === 0) || (direction === 1 && targets.index(target) === targets.length - 1))))) {
				quitLightbox();
				return false;
			}
			const params = {opacity: 0};
			cssTransitionTranslateX(image, `${(100 * direction) - swipeDiff}px`, options.animationSpeed / 1000);
			image.animate(params, options.animationSpeed, () => {
				removeImage();
			});
			swipeDiff = 0;
		}

		inProgress = true;
		if (options.onLoadStart !== false) {
			options.onLoadStart();
		}

		setTimeout(() => {
			image = $(`<img ${options.selector} />`)
				.attr('src', target.attr('href'))
				.load(() => {
					image.appendTo('body');
					setImage();
					const params = {opacity: 1};
					image.css('opacity', 0);
					cssTransitionTranslateX(image, `${-100 * direction}px`, 0);
					setTimeout(() => {
						cssTransitionTranslateX(image, '0px', options.animationSpeed / 1000);
					}, 50);

					image.animate(params, options.animationSpeed, () => {
						inProgress = false;
						if (options.onLoadEnd !== false) {
							options.onLoadEnd();
						}
					});
					if (options.preloadNext) {
						let nextTarget = targets.eq(targets.index(target) + 1);
						if (!nextTarget.length) {
							nextTarget = targets.eq(0);
						}
						$('<img />')
							.attr('src', nextTarget.attr('href'))
							.load();
					}
				})
				.error(() => {
					if (options.onLoadEnd !== false) {
						options.onLoadEnd();
					}
				});

			let swipeStart = 0;
			let swipeEnd = 0;

			image
				.on(hasPointers ? 'pointerup MSPointerUp' : 'click', (e) => {
					e.preventDefault();
					if (options.quitOnImgClick) {
						quitLightbox();
						return false;
					}
					if (wasTouched(e.originalEvent)) {
						return true;
					}
					const posX = (e.pageX || e.originalEvent.pageX) - e.target.offsetLeft;
					target = targets.eq(targets.index(target) - (imageWidth / 2 > posX ? 1 : -1));
					if (!target.length) {
						target = targets.eq(imageWidth / 2 > posX ? targets.length : 0);
					}
					loadImage(imageWidth / 2 > posX ? 'left' : 'right');
				})
				.on('touchstart pointerdown MSPointerDown', (e) => {
					if (!wasTouched(e.originalEvent) || options.quitOnImgClick) {
						return true;
					}
					swipeStart = e.originalEvent.pageX || e.originalEvent.touches[0].pageX;
				})
				.on('touchmove pointermove MSPointerMove', (e) => {
					if (!wasTouched(e.originalEvent) || options.quitOnImgClick) {
						return true;
					}
					e.preventDefault();
					swipeEnd = e.originalEvent.pageX || e.originalEvent.touches[0].pageX;
					swipeDiff = swipeStart - swipeEnd;
					cssTransitionTranslateX(image, `${-swipeDiff}px`, 0);
				})
				.on('touchend touchcancel pointerup pointercancel MSPointerUp MSPointerCancel', (e) => {
					if (!wasTouched(e.originalEvent) || options.quitOnImgClick) {
						return true;
					}
					if (Math.abs(swipeDiff) > 50) {
						target = targets.eq(targets.index(target) - (swipeDiff < 0 ? 1 : -1));
						if (!target.length) {
							target = targets.eq(swipeDiff < 0 ? targets.length : 0);
						}
						loadImage(swipeDiff > 0 ? 'right' : 'left');
					} else {
						cssTransitionTranslateX(image, '0px', options.animationSpeed / 1000);
					}
				});
		}, options.animationSpeed + 100);
	}

	function removeImage() {
		if (!image.length) {
			return false;
		}
		image.remove();
		image = $();
	}

	function quitLightbox() {
		if (!image.length) {
			return false;
		}
		image.animate({
			opacity: 0
		}, options.animationSpeed, () => {
			removeImage();
			inProgress = false;
			if (options.onEnd !== false) {
				options.onEnd();
			}
		});
	}

	$win.on('resize', setImage);

	if (options.quitOnDocClick) {
		$doc.on(hasTouch ? 'touchend' : 'click', (e) => {
			if (image.length && !$(e.target).is(image)) {
				quitLightbox();
			}
		});
	}

	if (options.enableKeyboard) {
		$doc.on('keyup', (e) => {
			if (!image.length) {
				return true;
			}
			e.preventDefault();
			if (e.keyCode === 27) {
				quitLightbox();
			}
			if (e.keyCode === 37 || e.keyCode === 39) {
				target = targets.eq(targets.index(target) - (e.keyCode === 37 ? 1 : -1));
				if (!target.length) {
					target = targets.eq(e.keyCode === 37 ? targets.length : 0);
				}
				loadImage(e.keyCode === 37 ? 'left' : 'right');
			}
		});
	}

	$doc.on('click', this.selector, (e) => {
		e.preventDefault();
		const t = e.currentTarget;
		if (!isTargetValid(t)) {
			return true;
		}
		if (inProgress) {
			return false;
		}
		inProgress = false;
		if (options.onStart !== false) {
			options.onStart();
		}
		target = $(t);
		loadImage();
	});

	this.each((idx, el) => {
		if (!isTargetValid(el)) {
			return true;
		}
		targets = targets.add($(el));
	});

	// this.switchImageLightbox = (index) => {
	// 	const tmpTarget = targets.eq(index);
	// 	if (tmpTarget.length) {
	// 		const currentIndex = targets.index(target);
	// 		target = tmpTarget;
	// 		loadImage(index < currentIndex ? 'left' : 'right');
	// 	}
	// 	return this;
	// };

	this.quitImageLightbox = quitLightbox;

	return this;
}

$.fn.imageLightbox = imageLightbox;
