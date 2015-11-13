'use strict';

import $ from 'jquery';

const Broadcast = {};

$.Broadcast = id => {
	let callbacks;
	let topic = id && Broadcast[id];
	if (!topic) {
		callbacks = $.Callbacks();
		topic = {
			publish: callbacks.fire,
			subscribe: callbacks.add,
			unsubscribe: callbacks.remove
		};
		if (id) {
			Broadcast[id] = topic;
		}
	}
	return topic;
};
