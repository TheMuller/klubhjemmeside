<?php
/**
 * River update
 *
 */

if (0) { ?><script><?php }

?>

elgg.provide('elgg.gianna');

elgg.gianna.init = function() {
	var form = $('form[name=elgg-wire]');
	form.find('input[type=submit]').live('click', elgg.gianna.submit);
};

elgg.gianna.submit = function(e) {
	var form = $(this).parents('form');
	var data = form.serialize();

	elgg.action('gianna/add', {
		data: data,
		success: function(json) {

			var river = $('.elgg-list-river');
						
			if (river.length < 1) {
				river.append(json.output);
			} else {				
				$(json.output).find('li:first').hide().prependTo(river).slideDown(500);
			};
			
			form.find('textarea').val('');
			$("#thewire-characters-remaining span").html("140");
		}
	});
	e.preventDefault();
};
elgg.register_hook_handler('init', 'system', elgg.gianna.init);
