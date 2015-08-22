'use strict';

import $ from 'jquery';

const $burger = $('#burger');
const $main = $('#siteMain');
const $header = $('#siteHeader');
const $body = $('body');
const $navbar = $('#navbarOut');

function burgerClick(contain) {
	let a;
	let b;
	let m;
	m = ['addClass', 'removeClass'];
	contain = contain || $burger.hasClass('open');
	a = contain ? 1 : 0;
	b = a ^ 1;
	$burger[m[a]]('open');
	$burger[m[b]]('close');
}

function closeMenu() {
	let $el;
	let els;
	let i;
	let len;
	els = [$body, $navbar, $header];
	for (i = 0, len = els.length; i < len; i++) {
		$el = els[i];
		$el.removeClass('open');
	}
	burgerClick(true);
}

function toggleMenu() {
	let $el;
	let els;
	let i;
	let len;
	els = [$body, $navbar, $header];
	for (i = 0, len = els.length; i < len; i++) {
		$el = els[i];
		$el.toggleClass('open');
	}
	burgerClick();
}

$main.on('click', closeMenu);
$burger.on('click.anima', toggleMenu);
