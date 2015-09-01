'use strict';

import $ from 'jquery';

const $paginacao = $('.pagination');
$paginacao.on('click.paginacao', '> button.paginacao--ui:not(:disabled)', (event) => {
	let u;
	let v;
	const btn = event.currentTarget;
	if (btn.classList.contains('paginacao__ok')) {
		const input = btn.previousElementSibling;
		v = input.value;
		v = (v >= input.min && v <= input.max) ? v : 1;
		u = btn.dataset.pagina.replace(/__num__/g, v);
	} else {
		u = btn.dataset.pagina;
	}
	window.location = u;
});
