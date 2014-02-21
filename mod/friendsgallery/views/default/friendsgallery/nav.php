<?php
/**
 * Friends Gallery navigation
 */

$owner = elgg_get_page_owner_entity();

$tabs = array(
	'friends' => array(
		'title' => elgg_echo('friends'),
		'url' => 'friends/' . $owner->username,
		'selected' => $vars['selected'] == 'friends',
	),
	'friendsof' => array(
		'title' => elgg_echo('friends:of'),
		'url' => 'friendsof/' . $owner->username,
		'selected' => $vars['selected'] == 'friendsof',
	),
	'friendsgallery' => array(
		'title' => elgg_echo('friends:gallery'),
		'url' => 'friendsgallery/' . $owner->username,
		'selected' => $vars['selected'] == 'friendsgallery',
	),
);

echo elgg_view('navigation/tabs', array('tabs' => $tabs));
