/* global document */

'use strict';

import $ from 'jquery';
import {insert, remove, last} from 'mout/array';

const optsObj = {};

const $opts = $('.opt-drop');
const $btns = $('button');
const opens = [];

function update(field, v, checked) {
	const el = document.getElementById(`${field}Choices`);
	const current = optsObj[field] || [];
	const m = (checked) ? insert : remove;

	m(current, parseInt(v, 10));
	optsObj[field] = current;

	if (current.length > 0) {
		current.sort((a, b) => a - b);
		const num = last(current);
		const plus = num === 4 ? '+' : '';
		let str = current.join(', ');
		const ax = str.lastIndexOf(',');
		if (ax !== -1) {
			str = str.substring(0, ax) + ' ou ' + str.substring(ax + 1);
		}
		el.textContent = `${str}${plus}`;
	} else {
		el.textContent = '...';
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

function beforeUpdate(opt) {
	const opts = opt.closest('.opts');
	update(opts.dataset.field, opt.value, opt.checked);
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
	beforeUpdate(event.currentTarget);
});

$opts.each((idx, el) => {
	beforeUpdate(el);
});
