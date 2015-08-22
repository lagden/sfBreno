/* global document */

'use strict';

import $ from 'jquery';
import {insert, remove, last} from 'mout/array';

const badObj = {};

const $opts = $('.opt-drop');
const $btns = $('button');
const opens = [];

function updateBadge(field, v, checked) {
	const badgeEl = document.getElementById(`${field}Badge`);
	const current = badObj[field] || [];
	const m = (checked) ? insert : remove;

	m(current, parseInt(v, 10));
	badObj[field] = current;

	if (current.length > 0) {
		current.sort((a, b) => a - b);
		const num = last(current);
		const plus = num === 4 ? '+' : '';
		badgeEl.dataset.badge = `${plus}${last(current)}`;
	} else {
		badgeEl.removeAttribute('data-badge');
	}
}

function closeBefore(ignore) {
	opens.map(el => {
		if (ignore !== el) {
			el.classList.remove('is-visible');
		}
		return false;
	});
}

$btns.on('click', (event) => {
	const btn = event.currentTarget;
	closeBefore(btn);
	btn.classList.toggle('is-visible');
	if (btn.classList.contains('is-visible')) {
		opens.push(btn);
	}
});

$opts.on('click', (event) => {
	const opt = event.currentTarget;
	const opts = opt.closest('.opts');
	updateBadge(opts.dataset.field, opt.value, opt.checked);
});
