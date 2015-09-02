'use strict';

import $ from 'jquery';
import 'component/svg';
import 'component/dropdown-checkbox';
import 'component/slider';
import 'component/banner';
import 'component/burger';
import 'component/pagina';
import 'component/form';

const $btnBack = $('.backbutton');
$btnBack.on('click.back', () => {
	window.history.back();
});

const $siteHeader = $('#siteHeader');
$siteHeader.on('click.logo', '> .logo-breno', (event) => {
	event.currentTarget.firstElementChild.click();
});
