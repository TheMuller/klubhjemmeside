<?php
/**
 * Elgg login box
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['module'] The module name. Default: aside
 */

$site = elgg_get_site_entity();
$module = elgg_extract('module', $vars, 'aside');

$login_url = elgg_get_site_url();
if (elgg_get_config('https_login')) {
	$login_url = str_replace("http:", "https:", $login_url);
}

$title = elgg_echo('gianna:signin', array($site->name));
$body = elgg_view_form('login', array('action' => "{$login_url}action/login"));

echo elgg_view_module($module, $title, $body);
