/* global document */

'use strict';

import $ from 'jquery';
import noUiSlider from 'nouislider/distribute/nouislider';
import {abbreviate, currencyFormat} from 'mout/number';

const $disponivel = $('.optsDisponibilidades');
const _dict = {
	thousand: ' mil',
	million: ' Mi',
	billion: ' Bi'
};

function customAbbr(val) {
	return abbreviate(val, 1, _dict);
}

function update(plus, ...v) {
	const [field, min, max] = v;
	plus = plus || '';
	const el = document.getElementById(`${field}Choices`);
	el.textContent = `${min} - ${max}${plus}`;
}

function prepare(reset, abbr, ...els) {
	const [slider, fmin, fmax, range, step, times] = els;
	const $noS = $(`#${slider}`);
	if ($noS.length > 0) {
		const noS = $noS[0];
		const elMin = document.getElementById(fmin);
		const elMax = document.getElementById(fmax);
		const $opts = $noS.closest('.opts');
		const startMin = (reset) ? range.min : elMin.value || range.min;
		const startMax = (reset) ? range.max : elMax.value || range.max;

		noUiSlider.create(noS, {
			start: [startMin, startMax],
			step,
			connect: true,
			range
		});
		noS.noUiSlider.on('update', (v, b, r) => {
			const vmin = parseInt(v[0], 10) * times;
			const vmax = parseInt(v[1], 10) * times;
			const plus = r[1] === range.max ? '+' : '';
			elMin.value = vmin / times;
			elMax.value = vmax / times;
			if (abbr) {
				update(plus, $opts.data('field'), customAbbr(vmin), customAbbr(vmax));
			} else {
				update(plus, $opts.data('field'), currencyFormat(vmin, 0, ',', '.'), currencyFormat(vmax, 0, ',', '.'));
			}
		});
	}
}

prepare(
	false,
	false,
	'areaSlider',
	'estate_filters_area',
	'estate_filters_area_max',
	{
		min: 0,
		'40%': 200,
		'70%': 1000,
		max: 10000
	},
	10,
	1
);

function builder(reset = false) {
	const val = parseInt($disponivel.filter(':checked').val(), 10) || 1;
	const noS = document.getElementById('valorSlider');
	if (noS && noS.hasOwnProperty('noUiSlider')) {
		noS.noUiSlider.destroy();
	}
	prepare(
		reset,
		val === 1,
		'valorSlider',
		'estate_filters_valor',
		'estate_filters_valor_max',
		{
			min: (val === 1) ? 50 : 100,
			max: (val === 1) ? 2000 : 20000
		},
		50,
		(val === 1) ? 1000 : 1
	);
}

$disponivel.on('click', () => {
	builder(true);
});
builder();
