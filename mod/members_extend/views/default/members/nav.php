<?php
/**
 * Members navigation
 */
 	$myurl= elgg_get_site_url()."action/member/download";
	$myurl = elgg_add_action_tokens_to_url($myurl);

$tabs = array(
	'newest' => array(
		'text' => elgg_echo('members:label:newest'),
		'href' => "members/newest",
		'selected' => $vars['selected'] == 'newest',
	),
	'popular' => array(
		'text' => elgg_echo('members:label:popular'),
		'href' => "members/popular",
		'selected' => $vars['selected'] == 'popular',
	),
	'online' => array(
		'text' => elgg_echo('members:label:online'),
		'href' => "members/online",
		'selected' => $vars['selected'] == 'online',
	),
	

);
$user= get_entity($_SESSION['user']->guid);
if($user){
	if($user->isAdmin()){
		$tabs = array(
		'newest' => array(
		'text' => elgg_echo('members:label:newest'),
		'href' => "members/newest",
		'selected' => $vars['selected'] == 'newest',
	),
	'popular' => array(
		'text' => elgg_echo('members:label:popular'),
		'href' => "members/popular",
		'selected' => $vars['selected'] == 'popular',
	),
	'online' => array(
		'text' => elgg_echo('members:label:online'),
		'href' => "members/online",
		'selected' => $vars['selected'] == 'online',
	),
	'unvalidated' =>  array(
				'text' => elgg_echo('admin:users:unvalidated'),
				'href' => "members/unvalidated",
				'selected' => $vars['selected'] == 'unvalidated',
	),
	'xlupload' => array(
            'text' => elgg_echo('XL Upload'),
            'href' => "members/upload",
            'priority' =>1000
    ),
	'xldownload' => array(
            'text' => elgg_echo('XL Download'),
            'href' => $myurl,
            'priority' =>1000
    ),
		);

	}
}
    
foreach($tabs as $name => $tab){
    $tab["name"] = $name;
    elgg_register_menu_item("projecttabs", $tab);
	
}
echo elgg_view_menu('projecttabs', array("sort_by" => "priority", "style" => "padding:0;",'class' => 'elgg-menu-filter',));
echo $user;