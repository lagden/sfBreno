/* globals define, requirejs */

'use strict';

define('config', () => {
	requirejs.config({
		baseUrl: '/js2/lib',
		paths: {
			app: '../app',
			component: '../component'
		}
	});
});
