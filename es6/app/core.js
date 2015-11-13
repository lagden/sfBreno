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
import 'sumoselect/jquery.sumoselect';

const $btnBack = $('.backbutton');
$btnBack.on('click.back', () => {
	window.history.back();
});

const $siteHeader = $('#siteHeader');
$siteHeader.on('click.logo', '> .logo-breno', event => {
	event.currentTarget.firstElementChild.click();
});

// Select
// const $selectmultiple = $('select[multiple]');
const $selectmultiple = $('#estate_filters_neighborhood_id');
$selectmultiple.SumoSelect({
	placeholder: 'Selecione os bairros',
	captionFormat: '{0} selecionados',
	selectAll: true,
	selectAlltext: 'Todos os bairros'
});

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

// Aviso
const $clearAviso = $('#clearAviso');
$clearAviso.on('click.aviso', () => {
	$clearAviso.parent().remove();
});
