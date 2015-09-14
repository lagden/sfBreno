'use strict';

import $ from 'jquery';
import webFont from 'webfontloader';
import 'component/svg';
import 'component/dropdown-checkbox';
import 'component/slider';
import 'component/banner';
import 'component/burger';
import 'component/pagina';
import 'component/form';
import 'component/aviso';

const $btnBack = $('.backbutton');
$btnBack.on('click.back', () => {
	window.history.back();
});

const $siteHeader = $('#siteHeader');
$siteHeader.on('click.logo', '> .logo-breno', (event) => {
	event.currentTarget.firstElementChild.click();
});

// Select
const $selectmultiple = $('select[multiple]');
$selectmultiple.find('option:first').attr('disabled', true);

// Webfont
const webFontConfig = {
	google: {
		families: [
			'Courgette::latin',
			'Roboto+Condensed::latin'
		]
	}
};
webFont.load(webFontConfig);
