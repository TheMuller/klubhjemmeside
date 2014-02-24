<?php
/**
 * Tabs
 *
 */

if (0) { ?><script><?php }

?>

$(document).ready(function() {
	$("#elggzone-tabs").tabs({
		select: function(event, ui) {                   
		   window.location.hash = ui.tab.hash;
		},
	});	
});

elgg.provide('ez.options.panel');

ez.options.panel.init = function() {
	var form = $('form[name=ez-options-panel]');
	form.find('input[type=submit]').live('click', ez.options.panel.submit);
};

ez.options.panel.submit = function(e) {
	
	is_tinyMCE_active = false;
	
	if ((typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) {
		is_tinyMCE_active = true;
	}
	if (is_tinyMCE_active) {
		tinyMCE.triggerSave();
	}
	
	var form = $(this).parents('form');
	var id = form.find('textarea').attr('id');
	
	var data = form.serialize();
	
	$('.ez-result').addClass('elggzone-loader');

	elgg.action('gianna/settings', {
		data: data,
		success: function(json) {
			$('.ez-result').removeClass('elggzone-loader');
			
			if (is_tinyMCE_active) {
				var i, t = tinyMCE.editors;
				for (i in t){
					if (t.hasOwnProperty(i)){
						t[i].remove();
					}
				}
				elgg.tinymce.init();
			}
		}
	});
	e.preventDefault();
};
elgg.register_hook_handler('init', 'system', ez.options.panel.init);
