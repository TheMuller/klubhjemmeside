<?php
/**
 * Members navigation
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
$user= get_entity($_SESSION['user']->guid);
if($user){
	if($user->isAdmin()){
		$tabs['unvalidated'] =  array(
				'title' => elgg_echo('admin:users:unvalidated'),
				'url' => "members/unvalidated",
				'selected' => $vars['selected'] == 'unvalidated',
					);

	}
}
echo elgg_view('navigation/tabs', array('tabs' => $tabs));
