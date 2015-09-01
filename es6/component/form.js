'use strict';

import $ from 'jquery';
import growl from 'lagden-growl/es5/growl';

const $form = $('.formTrigger');
$form.on('submit', (event) => {
	event.preventDefault();
	const f = event.currentTarget;
	const $f = $(f);
	const $submit = $f.find('button:submit');

	$submit[0].disabled = true;

	$.post(f.action, $f.serialize())
		.then((r) => {
			growl().notifica(r.success ? 'Sucesso' : 'Atenção', r.msg);
			if (r.success) {
				f.reset();
			}
		})
		.always(() => {
			$submit[0].disabled = false;
		})
		.fail(() => {
			growl().notifica('Falha', 'Problemas ao enviar!');
		});
});
