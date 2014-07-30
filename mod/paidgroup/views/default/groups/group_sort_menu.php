<?php
/**
 * All groups listing page navigation
 *
 * @uses $vars['selected'] Name of the tab that has been selected
 */
$group_tools_plugin = elgg_get_plugin_from_id('group_tools');
$tabs = array();
$tab1 = array(
	'newest' => array(
		'text' => elgg_echo('groups:newest'),
		'href' => 'groups/all?filter=newest',
		'priority' => 200,
	),
	'popular' => array(
		'text' => elgg_echo('groups:popular'),
		'href' => 'groups/all?filter=popular',
		'priority' => 300,
	),
	'discussion' => array(
		'text' => elgg_echo('groups:latestdiscussion'),
		'href' => 'groups/all?filter=discussion',
		'priority' => 400,
	),
	'inactive' => array(
		'text' => elgg_echo('paidgroup:inactive'),
		'href' => 'groups/all?filter=inactive',
		'priority' => 500,
	),
);
	$tab2 = array(
		"open" => array(
			"text" => elgg_echo("group_tools:groups:sorting:open"),
			"href" => "groups/all?filter=open",
			"priority" => 500,
		),
		"closed" => array(
			"text" => elgg_echo("group_tools:groups:sorting:closed"),
			"href" => "groups/all?filter=closed",
			"priority" => 600,
		),
		"alpha" => array(
			"text" => elgg_echo("group_tools:groups:sorting:alphabetical"),
			"href" => "groups/all?filter=alpha",
			"priority" => 700,
		),
		"ordered" => array(
			"text" => elgg_echo("group_tools:groups:sorting:ordered"),
			"href" => "groups/all?filter=ordered",
			"priority" => 800,
		),
		"suggested" => array(
			"text" => elgg_echo("group_tools:groups:sorting:suggested"),
			"href" => "groups/suggested",
			"priority" => 900,
		),
);

/* 	if($group_tools_plugin->IsActive()) {$tabs = array_merge($tab1,$tab2);}
	else {$tabs = $tab1;} */
	
	if($group_tools_plugin->IsActive()){
		$tabs = array_merge($tab1,$tab2);
		foreach ($tabs as $name => $tab) {
			$show_tab = false;
			$show_tab_setting = elgg_get_plugin_setting("group_listing_" . $name . "_available", "group_tools");
			if($name == "ordered"){
				if($show_tab_setting == "1"){
					$show_tab = true;
				}
			} elseif($show_tab_setting !== "0"){
				$show_tab = true;
			}
			
			if($show_tab){
				$tab["name"] = $name;
				
				if($vars["selected"] == $name){
					$tab["selected"] = true;
				}
			
				elgg_register_menu_item("filter", $tab);
			}
		}
	}else{
		$tabs = $tab1;
		foreach ($tabs as $name => $tab) {
			$tab['name'] = $name;

			if ($vars['selected'] == $name) {
				$tab['selected'] = true;
			}

			elgg_register_menu_item('filter', $tab);
		}
	}


echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
