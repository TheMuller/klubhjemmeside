<?php
/**
 * All groups listing page navigation
 *
 * @uses $vars['selected'] Name of the tab that has been selected
 */

$tabs = array(
	'newest' => array(
		'text' => elgg_echo('groups:newest'),
		'href' => 'groups/all?filter=newest&list_type=gallery',
		'priority' => 200,
	),
	'popular' => array(
		'text' => elgg_echo('groups:popular'),
		'href' => 'groups/all?filter=popular&list_type=gallery',
		'priority' => 300,
	),
	'discussion' => array(
		'text' => elgg_echo('groups:latestdiscussion'),
		'href' => 'groups/all?filter=discussion&list_type=gallery',
		'priority' => 400,
	),
	'inactive' => array(
		'text' => elgg_echo('paidgroup:inactive'),
		'href' => 'groups/all?filter=inactive&list_type=gallery',
		'priority' => 500,
	),
);

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	if ($vars['selected'] == $name) {
		$tab['selected'] = true;
	}

	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
