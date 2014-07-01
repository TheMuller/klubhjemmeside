<?php
/**
 * Elgg kanelggamapsapi plugin
 * @package KanelggaMapsApi 
 */

$tab = get_input('tab', 'general_options');

echo elgg_view('navigation/tabs', array(
	'tabs' => array(
		array(
			'text' => elgg_echo('kanelggamapsapi:settings:tabs:general_options'),
			'href' => '/admin/settings/kanelggamapsapi?tab=general_options',
			'selected' => ($tab == 'general_options'),
		),	
		array(
			'text' => elgg_echo('kanelggamapsapi:settings:tabs:global_options'),
			'href' => '/admin/settings/kanelggamapsapi?tab=global_options',
			'selected' => ($tab == 'global_options'),
		),
	)
));

switch ($tab) {
	case 'global_options':
		echo elgg_view('admin/settings/kanelggamapsapi/global_options');
		break;

	default:
	case 'general_options':
		echo elgg_view('admin/settings/kanelggamapsapi/general_options');
		break;
}
