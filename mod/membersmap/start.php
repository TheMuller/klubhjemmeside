<?php
/**
 * Elgg membersmap plugin
 *
 * @package MembersMap 
 */

elgg_register_event_handler('init', 'system', 'membersmap_init');

/**
 * MembersMap plugin initialization functions.
 */
function membersmap_init() {  
    // load kanelgga maps api libraries if it's enabled. If not, it will not be working
    if(elgg_is_active_plugin("kanelggamapsapi")){
		elgg_load_library('elgg:kanelggamapsapi');  
		elgg_load_library('elgg:kanelggamapsapigeocoder'); 
	}
    
       
    // Site navigation: add if enabled in settings
    if(elgg_is_active_plugin("kanelggamapsapi")){
		if (check_if_map_menu_item('membersmap'))	{
			$item = new ElggMenuItem('membersmap', elgg_echo('membersmap:menu'), 'membersmap/all');
			elgg_register_menu_item('site', $item); 
		}
    }
    
    // Extend CSS
    elgg_extend_view('css/elgg', 'membersmap/css');

    // extend group main page 
    elgg_extend_view('groups/tool_latest', 'membersmap/group_module');
    
    // add the group members maps tool option
    add_group_tool_option('membersmap', elgg_echo('mambersmap:group:enablemaps'), true);    

    // Register a page handler, so we can have nice URLs
    elgg_register_page_handler('membersmap', 'membersmap_page_handler');

    // Register actions
    //$action_path = elgg_get_plugins_path() . 'membersmap/actions';
    //elgg_unregister_action('profile/edit');
    //elgg_register_action("profile/edit", "$action_path/edit.php");
    
    // Register widget
    elgg_register_widget_type('membersmap',elgg_echo("membersmap:wg:title"),elgg_echo("membersmap:wg:detail"));
    
	// Register a handler for create members
	elgg_register_event_handler('create', 'user', 'membersmap_geolocation');   
	// Register a handler for update members
	elgg_register_event_handler('profileupdate', 'user', 'membersmap_geolocation');		 
      
}

/**
 *  Dispatches membersmap pages.
 *
 * @param array $page
 * @return bool
 */

function membersmap_page_handler($page) {
	$base = elgg_get_plugins_path() . 'membersmap/pages/membersmap';

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	$vars = array();
	$vars['page'] = $page[0];

	if ($page[0] == 'search') {
		$vars['search_type'] = $page[1];
		require_once "$base/search.php";
	} else {
		require_once "$base/world.php";
	}
	return true;
}

/**
 * Geolocate User based on location field
 */
function membersmap_geolocation($event, $object_type, $object) {
	$location = $object->location;
	if ($location) {
		$ccc = save_object_coords($location, $object, 'kanelggamapsapi');
	}	
	//register_error(elgg_echo('skata'));
	
	return true;
}



