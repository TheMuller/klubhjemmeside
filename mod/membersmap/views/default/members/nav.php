<?php
/**
 * Show map based on search of all members
 *
 * @package MembersMap
 */

$tabs = array(
	'newest' => array(
		'title' => elgg_echo('members:label:newest'),
		'url' => "members/newest",
		'selected' => $vars['selected'] == 'newest',
	),
	'popular' => array(
		'title' => elgg_echo('members:label:popular'),
		'url' => "members/popular",
		'selected' => $vars['selected'] == 'popular',
	),
	'online' => array(
		'title' => elgg_echo('members:label:online'),
		'url' => "members/online",
		'selected' => $vars['selected'] == 'online',
	),
);
		
if(elgg_is_active_plugin("kanelggamapsapi")){

	if (check_if_add_tab_on_entity_page('membersmap'))	{
		$tabs = array(
			'newest' => array(
				'title' => elgg_echo('members:label:newest'),
				'url' => "members/newest",
				'selected' => $vars['selected'] == 'newest',
			),
			'popular' => array(
				'title' => elgg_echo('members:label:popular'),
				'url' => "members/popular",
				'selected' => $vars['selected'] == 'popular',
			),
			'online' => array(
				'title' => elgg_echo('members:label:online'),
				'url' => "members/online",
				'selected' => $vars['selected'] == 'online',
			),
			'membersmap' => array(
				'title' => elgg_echo('membersmap'),
				'url' => "membersmap/all",
				'selected' => $vars['selected'] == 'map',
			),	
		);
	}
}

echo elgg_view('navigation/tabs', array('tabs' => $tabs));
