<?php
/**
 * Settings save
 */

$plugin = elgg_get_plugin_from_id('gianna');

$params = get_input('params');
foreach ($params as $k => $v) {
	if (!$plugin->setSetting($k, $v)) {
		register_error(elgg_echo('plugins:settings:save:fail', array('gianna')));
		forward(REFERER);
	}
}

foreach ($params as $name => $value) {
	$plugin->setSetting($name, $value);
}

$json = array('success' => TRUE, 'message' => '');
echo json_encode($json);
