<?php
/**
 * Elgg Agora Classifieds plugin
 * @package agora
 */

$plugin = elgg_get_plugin_from_id('agora');

$params = get_input('params');
foreach ($params as $k => $v) {
	if (!$plugin->setSetting($k, $v)) {
		register_error(elgg_echo('plugins:settings:save:fail', array('agora')));
		forward(REFERER);
	}
}


system_message(elgg_echo('agora:settings:save:ok'));
forward(REFERER);
