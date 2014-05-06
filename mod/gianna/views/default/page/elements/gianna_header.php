<?php
/**
 * Gianna page header
 * Display Gianna logo when needed
 */

$plugin = elgg_get_plugin_from_id('gianna');

if (($plugin->gianna_index == 'gianna' && elgg_get_context() == 'main') || elgg_get_context() == 'forgotpassword') {
	echo elgg_view('page/elements/logo', array('class' => 'logo-context'));
} else {
	echo elgg_view('page/elements/logo');
}

echo elgg_view_menu('site');