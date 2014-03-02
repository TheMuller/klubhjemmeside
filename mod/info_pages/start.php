<?php
/**
 * Elgg Pages
 *
 * @package ElggPages
 */

elgg_register_event_handler('init', 'system', 'info_pages_init');

/**
 * Initialize the pages plugin.
 *
 */
function info_pages_init() {

	// register a library of helper functions
	elgg_register_library('elgg:info_pages', elgg_get_plugins_path() . 'info_pages/lib/info_pages.php');

	$item = new ElggMenuItem('pages', elgg_echo('info_pages'), 'info_pages');
	elgg_register_menu_item('site', $item);

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('info_pages', 'info_pages_page_handler');
	
	
	// HANDLE THE BROWSERPATH
	elgg_register_page_handler('ip', 'ip_page_handler');

	// Register a url handler
	elgg_register_entity_url_handler('object', 'info_page', 'info_pages_url');

	// Register some actions
	$action_base = elgg_get_plugins_path() . 'info_pages/actions/info_pages';
	elgg_register_action("info_pages/edit", "$action_base/edit.php");
	elgg_register_action("info_pages/move", "$action_base/move.php");
	elgg_register_action("info_pages/delete", "$action_base/delete.php");

	// Extend the main css view
	elgg_extend_view('css/elgg', 'info_pages/css');

	//add metatags to the page
	elgg_extend_view('page/elements/head', 'info_pages/metatags');

	// Register entity type for search
	elgg_register_entity_type('object', 'info_page');

	// Language short codes must be of the form "pages:key"
	// where key is the array key below
	elgg_set_config('info_pages', array(
		'title' => 'text',
		'description' => 'longtext',
		'menu_show' => 'checkbox',
		'access_id' => 'access',
		'metadescription' => 'plaintext',
		'metakeywords' => 'text',
		'path'=>'text',
	));

	// entity menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'info_pages_entity_menu_setup');
	
	//sidebar menu
	elgg_register_plugin_hook_handler('register', 'menu:info_pages', 'info_pages_sidebar_menu_setup');

}

/**
 * Dispatcher for pages.
 * URLs take the form of
 *  All pages or index:        info_pages/all | pages
 *  View page:        info_pages/view/<guid>/<title>
 *  New page:         info_pages/add/<guid> (container: user, group, parent)
 *  Edit page:        info_pages/edit/<guid>
 *
 * Title is ignored
 *
 * @param array $page
 * @return bool
 */
function info_pages_page_handler($page) {

	elgg_load_library('elgg:info_pages');
	
	// add the jquery treeview files for navigation
	elgg_load_js('jquery-treeview');
	elgg_load_css('jquery-treeview');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('info_pages'), 'info_pages/all');

	$base_dir = elgg_get_plugins_path() . 'info_pages/pages/info_pages';

	$page_type = $page[0];
	switch ($page_type) {
		case 'owner':
			include "$base_dir/owner.php";
			break;
		case 'friends':
			include "$base_dir/friends.php";
			break;
		case 'view':
			set_input('guid', $page[1]);
			include "$base_dir/view.php";
			break;
		case 'add':
			set_input('guid', $page[1]);
			include "$base_dir/new.php";
			break;
		case 'edit':
			set_input('guid', $page[1]);
			include "$base_dir/edit.php";
			break;
		case 'group':
			include "$base_dir/owner.php";
			break;
		case 'history':
			set_input('guid', $page[1]);
			include "$base_dir/history.php";
			break;
		case 'revision':
			set_input('id', $page[1]);
			include "$base_dir/revision.php";
			break;
		case 'all':
			include "$base_dir/index.php";
			break;
		default:
			include "$base_dir/index.php";
			return true;
	}
	return true;
}
/**
 * Friendly urls for the pages
 * url/ip/<path>
 *
 * @param array $page
 * @return bool
 */
function ip_page_handler($page) {
	
	elgg_load_library('elgg:info_pages');
	

	elgg_push_breadcrumb(elgg_echo('info_pages'), 'info_pages/all');

	$base_dir = elgg_get_plugins_path() . 'info_pages/pages/info_pages';
	
	$path = implode('/', $page);
	
	$entities = elgg_get_entities_from_metadata(array(  'metadata_names'=> array('path'), 
														'metadata_values' => array($path)
											));
	if(!$entities){
		forward('/info_pages');
}
	set_input('guid', $entities[0]->getGuid());
	include "$base_dir/view.php";

	return true;
}
/**
 * Override the page url
 * 
 * @param ElggObject $entity Page object
 * @return string
 */
function info_pages_url($entity) {
	$title = elgg_get_friendly_title($entity->title);
	if(isset($entity->path) && $entity->path != null){
		return "ip/$entity->path";
	} else {
		return "info_pages/view/$entity->guid/$title";
	}
	
}



/**
 * Add links/info to entity menu particular to pages plugin
 */
function info_pages_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'info_pages') {
		return $return;
	}

	// remove delete if not owner or admin
	if (!elgg_is_admin_logged_in() && elgg_get_logged_in_user_guid() != $entity->getOwnerGuid()) {
		foreach ($return as $index => $item) {
			if ($item->getName() == 'delete') {
				unset($return[$index]);
			}
		}
	}
	if(elgg_is_admin_logged_in()){
		if($entity->orderno > 1 || $entity->sub_orderno > 1 || $entity->sub_sub_orderno > 1){
			$options = array(
				'name' => 'orderup',
				'text' => elgg_echo('info_pages:order:up'),
				'href' => elgg_add_action_tokens_to_url('action/info_pages/move?page_guid=' . $entity->guid . '&direction=up'),
				'priority' => 150,
			);
			$return[] = ElggMenuItem::factory($options);
		}
		$final_page = (info_pages_find_next_orderno($entity->parent_guid) -1);

		if(($entity->orderno ? $entity->orderno : $entity->sub_orderno) < $final_page){
		
			$options = array(
				'name' => 'orderdown',
				'text' => elgg_echo('info_pages:order:down'),
				'href' => elgg_add_action_tokens_to_url('action/info_pages/move?page_guid=' . $entity->guid . '&direction=down'),
				'priority' => 150,
			);
			$return[] = ElggMenuItem::factory($options);
		}
		
	}

	return $return;
}
/**
 * The sidebar menu. 
 * ONLY shows pages that are marked to
 * Gets the order as set in the index page
 * If a subpage then shows the parent page
 */
function info_pages_sidebar_menu_setup($hook, $type, $return, $params) {
	
	
	$pages = elgg_get_entities_from_metadata(array(
		'types' => 'object',
		'subtypes' => 'info_page',
	));
	
	foreach($pages as $page){
		
		//check for subpages
		$subpages = elgg_get_entities_from_metadata(array(
			'types' => 'object',
			'subtypes' => 'info_page',
	
			'metadata_name_value_pairs' => array( array('name' => 'parent_guid', 'value' => $page->guid, 'operand' => '='), array('name' => 'menu_show', 'value' => 'on', 'operand' => '=')),
			'metadata_name_value_pairs_operator' => 'AND',	
		));
		
		foreach($subpages as $subpage){
			$subsubpages[] = elgg_get_entities_from_metadata(array(
			'types' => 'object',
			'subtypes' => 'info_page',
	
			'metadata_name_value_pairs' => array( array('name' => 'parent_guid', 'value' => $subpage->guid, 'operand' => '='), array('name' => 'menu_show', 'value' => 'on', 'operand' => '=')),
			'metadata_name_value_pairs_operator' => 'AND',	
		));
		}
		
		
		if(($page->menu_show == 'on') || ($subpages) || ($subsubpages)){
			$parent = get_entity($page->parent_guid);
			//do we have a parent of parent?
			try {
				$parentofparent = get_entity($parent->parent_guid);
			} catch (Exception $e){
			}
			$options = array(
				'name' => $page->title,
				'text' => $page->title,
				'href' => $page->getUrl(),
				'priority' => $page->orderno != 0 ? $page->orderno : ($page->sub_orderno /100) + ($parent->orderno ? $parent->orderno : ($parent->sub_orderno / 100) + $parentofparent->orderno),
				'class' => $page->parent_guid ? $parentofparent ? 'sub_subpage'  : 'subpage' : '',
			);


			$return[] = ElggMenuItem::factory($options);
		} else {
			elgg_unregister_menu_item('info_pages', $page->title);
		}
	}
	
		return $return;
}

