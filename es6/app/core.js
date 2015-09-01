'use strict';

import $ from 'jquery';
import svgLocalstorage from 'svg-localstorage';
import 'component/dropdown-checkbox';
import 'component/slider';
import 'component/banner';
import 'component/burger';
import 'component/pagina';
import 'component/form';

svgLocalstorage('/assets/sprites.svg', '0.1.4');

const $btnBack = $('.backbutton');
$btnBack.on('click.back', () => {
	window.history.back();
});

const $siteHeader = $('#siteHeader');
$siteHeader.on('click.logo', '> .logo-breno', (event) => {
	event.currentTarget.firstElementChild.click();
});
