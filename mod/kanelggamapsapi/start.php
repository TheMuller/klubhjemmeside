<?php
/**
 * Elgg kanelggamapsapi plugin
 * @package KanelggaMapsApi 
 */

elgg_register_event_handler('init', 'system', 'kanelggamapsapi_init');

/**
 * kanelggamapsapi plugin initialization functions.
 */
function kanelggamapsapi_init() {  
	define('CUSTOM_DEFAULT_COORDS', '49.037868,14.941406');	// set coords of Europe in case default location is not set
	define('CUSTOM_DEFAULT_LOCATION', 'Europe');	// set default location in case default location is not set
	define('CUSTOM_DEFAULT_ZOOM', 10);	// set default zoom in case is not set
	define('CUSTOM_CLUSTER_ZOOM', 7);	// set cluster zoom that define when markers grouping ends
		
    // register a library of helper functions
    elgg_register_library('elgg:kanelggamapsapi', elgg_get_plugins_path() . 'kanelggamapsapi/lib/kanelggamapsapi.php');
    elgg_register_library('elgg:kanelggamapsapigeocoder', elgg_get_plugins_path() . 'kanelggamapsapi/lib/Geocoder.php');
    
    // Extend CSS
    elgg_extend_view('css/elgg', 'kanelggamapsapi/css');    
       
    // register extra js files
    $mapkey = trim(elgg_get_plugin_setting('google_api_key', 'kanelggamapsapi'));
    elgg_register_js('kmpbasicjs', '/mod/kanelggamapsapi/assets/kanelggamapsapi.js');
    elgg_register_js('kmpplaceholderjs', '/mod/kanelggamapsapi/assets/jquery.placeholder.js');
    elgg_register_js('kmpgmap1', 'https://maps.googleapis.com/maps/api/js?sensor=false&amp;key=' . $mapkey);
    elgg_register_js('kmpgmap2', 'https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places&amp;key=' . $mapkey);    
    elgg_register_js('kmpgmap3', 'https://maps.google.com/maps/api/js?sensor=false&libraries=geometry&amp;key=' . $mapkey);
    elgg_register_js('kmpgmap4', 'http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js');
    elgg_register_js('kmpomsjs', '/mod/kanelggamapsapi/assets/oms.min.js');

    // Global map: add if enabled in settings and any of map plugins are enabled
	if (check_if_global_map_enabled())	{
		$item = new ElggMenuItem('kanelggamapsapi', elgg_echo('kanelggamapsapi:menu'), 'globalmap/all');
		elgg_register_menu_item('site', $item); 
	}
	
	// Add admin menu item
	elgg_register_admin_menu_item('configure', 'kanelggamapsapi', 'settings'); 	
	
    // Register a page handler, so we can have nice URLs
    elgg_register_page_handler('globalmap', 'kanelggamapsapi_page_handler');	
    
    // Register actions admin
    $action_path = elgg_get_plugins_path() . 'kanelggamapsapi/actions';
    elgg_register_action('kanelggamapsapi/admin/general_options', "$action_path/admin/settings.php", 'admin');
    elgg_register_action('kanelggamapsapi/admin/global_options', "$action_path/admin/settings.php", 'admin');   
}

// Check if global map is enable and if any of available plugins are enabled 
function check_if_global_map_enabled() {
    $maponmenu = trim(elgg_get_plugin_setting('maponmenu', 'kanelggamapsapi'));

    if ($maponmenu == 'yes' && (elgg_is_active_plugin('membersmap') || elgg_is_active_plugin('groupsmap') || elgg_is_active_plugin('agora'))) {
		return true;
    }
    
    return false;
}

/**
 *  Dispatches membersmap pages.
 *
 * @param array $page
 * @return bool
 */

function kanelggamapsapi_page_handler($page) {
	$base = elgg_get_plugins_path() . 'kanelggamapsapi/pages/kanelggamapsapi';

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	$vars = array();
	$vars['page'] = $page[0];

	//if ($page[0] == 'search') {
	//	$vars['search_type'] = $page[1];
	//	require_once "$base/search.php";
	//} else {
		require_once "$base/world.php";
	//}
	return true;
}
