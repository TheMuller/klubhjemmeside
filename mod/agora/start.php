<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_register_event_handler('init', 'system', 'agora_init');

/**
 * Agora plugin initialization functions.
 */
function agora_init() {
	define('AGORA_CUSTOM_DEFAULT_COORDS', '49.037868,14.941406');	// set coords of Europe in case default location is not set
	define('AGORA_CUSTOM_DEFAULT_LOCATION', 'Europe');	// set default location in case default location is not set
	define('AGORA_CUSTOM_DEFAULT_ZOOM', 10);	// set default zoom in case is not set
	define('AGORA_CUSTOM_CLUSTER_ZOOM', 7);	// set cluster zoom that define when markers grouping ends
	define('AGORA_INTEREST_INTEREST', 'INTEREST');	// define initial interest
	define('AGORA_INTEREST_ACCEPTED', 'ACCEPTED');	// define interest as accepted
	define('AGORA_INTEREST_REJECTED', 'REJECTED');	// define interest as rejected
		
    // register a library of helper functions
    elgg_register_library('elgg:agora', elgg_get_plugins_path() . 'agora/lib/agora.php');
    elgg_register_library('elgg:agora:ipnlistener', elgg_get_plugins_path() . 'agora/lib/ipnlistener.php');
    
    // load kanelgga maps api libraries if it's enabled. If not, it will not be working
    if (elgg_is_active_plugin("kanelggamapsapi")){
		elgg_load_library('elgg:kanelggamapsapi');  
		elgg_load_library('elgg:kanelggamapsapigeocoder'); 
	}    

    // Register subtype
    run_function_once('agora_manager_run_once_subtypes');
                
    // Register entity_type for search
    elgg_register_entity_type('object', Agora::SUBTYPE);
    
    // Site navigation
    $item = new ElggMenuItem('agora', elgg_echo('agora:menu'), 'agora/all');
    elgg_register_menu_item('site', $item); 
    
	// Add admin menu item
	elgg_register_admin_menu_item('configure', 'agora', 'settings');    
    
    // Extend CSS
    elgg_extend_view('css/elgg', 'agora/css');
    
    // Extend js
    elgg_extend_view("js/elgg", "agora/js/site"); // tooltips
    elgg_register_js('paypal', '/mod/agora/assets/paypal-button.min');  // paypal button  

    // Register a page handler, so we can have nice URLs
    elgg_register_page_handler('agora', 'agora_page_handler');
    
    // Register a URL handler for agora
    elgg_register_entity_url_handler('object', 'agora', 'agora_url');
    
    // Register menu item to an ownerblock
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'agora_owner_block_menu');

    // Register actions
    $action_path = elgg_get_plugins_path() . 'agora/actions';
    elgg_register_action('agora/add', "$action_path/add.php");    
    elgg_register_action('agora/delete', "$action_path/del.php");
    elgg_register_action('agora/be_interested', "$action_path/be_interested.php");
    elgg_register_action('agora/set_accepted', "$action_path/set_accepted.php");
    elgg_register_action('agora/set_rejected', "$action_path/set_rejected.php");
    
    // Register actions admin
    elgg_register_action('agora/admin/general_options', "$action_path/admin/settings.php", 'admin');
    elgg_register_action('agora/admin/paypal_options', "$action_path/admin/settings.php", 'admin');
    elgg_register_action('agora/admin/map_options', "$action_path/admin/settings.php", 'admin');
    
    // extend group main page 
    elgg_extend_view('groups/tool_latest', 'agora/group_module');
    
    // add the group agora tool option
    add_group_tool_option('agora', elgg_echo('agora:group:enableagora'), true);   
    
    // Add agora widget for displaying available ads
	//elgg_register_widget_type('agora', elgg_echo('agora:widget'), elgg_echo('agora:widget:description'));
	elgg_register_widget_type('agora', elgg_echo('agora:widget'), elgg_echo('agora:widget:description'), 'profile,groups');
    // Add agora widget for displaying bought and sold items
	elgg_register_widget_type('agorabs',	elgg_echo('agora:widget:boughtandsold'),	elgg_echo('agora:widget:description'), 'profile');	
}

/**
 *  Dispatches agora pages.
 *
 * @param array $page
 * @return bool
 */

function agora_page_handler($page) {
    elgg_push_breadcrumb(elgg_echo('agora'), 'agora/all');
    
	if (!isset($page[0])) {
		$page[0] = 'all';
	}    
	$vars = array();
	$vars['page'] = $page[0];	

    $base = elgg_get_plugins_path() . 'agora/pages/agora';

    switch ($page[0]) {
        case "ipn":
            include "$base/ipn.php";
            break;
        
        case "all":
			agora_register_toggle();
			set_input('category', $page[1]);
            include "$base/all.php";
            break;  
            
        case "map":
			set_input('category', $page[1]);
			include "$base/map.php";
            break; 
            
        case "owner":
			agora_register_toggle();
            include "$base/owner.php";
            break;

        case "friends":
			agora_register_toggle();
            include "$base/friends.php";
            break;

        case "view":
            set_input('guid', $page[1]);
            include "$base/view.php";
            break;

        case "add":
            gatekeeper();
            include "$base/add.php";
            break;

        case "edit":
            gatekeeper();
            set_input('guid', $page[1]);
            include "$base/edit.php";
            break;

        case "group":
            group_gatekeeper();
            agora_register_toggle();
            include "$base/owner.php";
            break;

        default:
            include "$base/all.php";
            return false;
    }

    elgg_pop_context();
    return true;
}

/**
 * Populates the ->getUrl() method for agora objects
 */
function agora_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "agora/view/" . $entity->getGUID() . "/" . $title;
}

/**
 * Add a menu item to an ownerblock
 * 
 */
function agora_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = "agora/owner/{$params['entity']->username}";
        $item = new ElggMenuItem('agora', elgg_echo('agora'), $url);
        $return[] = $item;
    } else {
        if ($params['entity']->agora_enable != 'no') {
            $url = "agora/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('agora', elgg_echo('agora:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}

/**
 * Adds a toggle to extra menu for switching between list and gallery views
 */
function agora_register_toggle() {
	$url = elgg_http_remove_url_query_element(current_page_url(), 'list_type');

	if (get_input('list_type', 'list') == 'list') {
		$list_type = "gallery";
		$icon = elgg_view_icon('grid');
	} else {
		$list_type = "list";
		$icon = elgg_view_icon('list');
	}

	if (substr_count($url, '?')) {
		$url .= "&list_type=" . $list_type;
	} else {
		$url .= "?list_type=" . $list_type;
	}

	elgg_register_menu_item('extras', array(
		'name' => 'agora_list',
		'text' => $icon,
		'href' => $url,
		'title' => elgg_echo("agora:list:$list_type"),
		'priority' => 1000,
	));
}
