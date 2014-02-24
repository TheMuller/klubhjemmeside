<?php
/**
 * Text module
 *
 */

$plugin = elgg_get_plugin_from_id('gianna');
$site = elgg_get_site_entity();

$title = elgg_echo('gianna:register', array($site->name));

if ($plugin->show_reg_text == 'file') { 
	$text = elgg_echo('gianna:register:text');
} else {
	$text = $plugin->reg_text;	
}
echo elgg_view_module('aside ez-info-module', $title, $text);
