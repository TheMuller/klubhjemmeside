<?php
/**
 * Elgg kanelggamapsapi plugin
 * @package KanelggaMapsApi 
 */

$plugin = elgg_get_plugin_from_id('kanelggamapsapi');

$params = get_input('params');
foreach ($params as $k => $v) {
	if (!$plugin->setSetting($k, $v)) {
		register_error(elgg_echo('plugins:settings:save:fail', array('kanelggamapsapi')));
		forward(REFERER);
	}
}


system_message(elgg_echo('kanelggamapsapi:settings:save:ok'));
forward(REFERER);
