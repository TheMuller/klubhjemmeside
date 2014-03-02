<?php
/**
 * INFO Pages function library
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $page
 * @return array
 */
function info_pages_prepare_form_vars($page = null, $parent_guid = 0) {

	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $page,
		'parent_guid' => $parent_guid,
		'menu_show' => '',
		
		'metadescription' => '',
		'metakeywords' => '',
		'path' => '',
	);

	if ($page) {
		foreach (array_keys($values) as $field) {
			if (isset($page->$field)) {
				$values[$field] = $page->$field;
			}
		}
	}

	if (elgg_is_sticky_form('page')) {
		$sticky_values = elgg_get_sticky_values('page');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('page');

	return $values;
}

/**
 * Recurses the page tree and adds the breadcrumbs for all ancestors
 *
 * @param ElggObject $page Page entity
 */
function info_pages_prepare_parent_breadcrumbs($page) {
	if ($page && $page->parent_guid) {
		$parents = array();
		$parent = get_entity($page->parent_guid);
		while ($parent) {
			array_push($parents, $parent);
			$parent = get_entity($parent->parent_guid);
		}
		while ($parents) {
			$parent = array_pop($parents);
			elgg_push_breadcrumb($parent->title, $parent->getURL());
		}
	}
}

/**
 * Register the navigation menu
 * 
 * @param ElggEntity $container Container entity for the pages
 */
function info_pages_register_navigation_tree($container) {
	if (!$container) {
		return;
	}

	$top_pages = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'page_top',
		'container_guid' => $container->getGUID(),
		'limit' => 0,
	));

	foreach ($top_pages as $page) {
		elgg_register_menu_item('pages_nav', array(
			'name' => $page->getGUID(),
			'text' => $page->title,
			'href' => $page->getURL(),
		));

		$stack = array();
		array_push($stack, $page);
		while (count($stack) > 0) {
			$parent = array_pop($stack);
			$children = elgg_get_entities_from_metadata(array(
				'type' => 'object',
				'subtype' => 'page',
				'metadata_name' => 'parent_guid',
				'metadata_value' => $parent->getGUID(),
				'limit' => 0,
			));
			
			foreach ($children as $child) {
				elgg_register_menu_item('pages_nav', array(
					'name' => $child->getGUID(),
					'text' => $child->title,
					'href' => $child->getURL(),
					'parent_name' => $parent->getGUID(),
				));
				array_push($stack, $child);
			}
		}
	}
}

/* Find the next available order number
*/
function info_pages_find_next_orderno($parent_guid){
	if(!$parent_guid){
		$pages = elgg_get_entities_from_metadata(array(
			'types' => 'object',
			'subtypes' => 'info_page',
			'full_view' => false,
			'order_by_metadata' =>	array('name' => 'orderno', 'direction' => ASC, 'as' => integer)
		));
		
		$last = end($pages);
		
		return $last->orderno +1;
	} else {
		$pages = elgg_get_entities_from_metadata(array(
			'types' => 'object',
			'subtypes' => 'info_page',
			'full_view' => false,
			'metadata_name_value_pairs' => array('name' => 'parent_guid','value' => $parent_guid,  'operand' => '='),			
			'order_by_metadata' =>	array('name' => 'sub_orderno', 'direction' => ASC, 'as' => integer)
		));
		
		$last = end($pages);
				

		return $last->sub_orderno +1;
	}
}

/* Find the page that will be moved - SINGLE OR PARENT PAGES ONLY
*/
function info_pages_change_order($page_guid, $direction){
	$page = get_entity($page_guid);
	
	if($page->parent_guid){
		return info_pages_change_sub_order($page_guid, $direction);
	}
	
	$page_above = elgg_get_entities_from_metadata(array(
		'types' => 'object',
		'subtypes' => 'info_page',
		'metadata_name_value_pairs' => array('name' => 'orderno','value' => $page->orderno -1,  'operand' => '='),
	));
	
	$page_below = elgg_get_entities_from_metadata(array(
		'types' => 'object',
		'subtypes' => 'info_page',
		'metadata_name_value_pairs' => array('name' => 'orderno','value' => $page->orderno +1,  'operand' => '='),
	));
	
	
		if($direction == 'up'){
			
			if(count($page_above) > 0){
				$above = get_entity($page_above[0]->guid);	
			
				//move the above page to the order of the page
				$above->orderno = $page->orderno;
				$above->save();
				
				
				//and now move this page up one
				$page->orderno = $page->orderno -1;
				$page->save();
		
				return true;
			}
	
		} elseif($direction == 'down'){
			
			if(count($page_below) > 0){
				$below = get_entity($page_below[0]->guid);	
				//move the above page to the order of the page
				$below->orderno = $page->orderno;
				$below->save();
				//and now move this page up one
				$page->orderno = $page->orderno +1;
				$page->save();
	
				
				return true;
			}
			
		} else {
			return false;
		}
	
}
/* Change the position of a sub page */

function info_pages_change_sub_order($page_guid, $direction){
	$page = get_entity($page_guid);
	
	$page_above = elgg_get_entities_from_metadata(array(
		'types' => 'object',
		'subtypes' => 'info_page',
		
		'metadata_name_value_pairs' => array( array('name' => 'sub_orderno', 'value' => $page->sub_orderno -1, 'operand' => '='),  array('name' => 'parent_guid', 'value' => $page->parent_guid, 'operand' => '=')),
		'metadata_name_value_pairs_operator' => 'AND',

	));
	
	$page_below = elgg_get_entities_from_metadata(array(
		'types' => 'object',
		'subtypes' => 'info_page',

		'metadata_name_value_pairs' => array( array('name' => 'sub_orderno', 'value' => $page->sub_orderno +1, 'operand' => '='),  array('name' => 'parent_guid', 'value' => $page->parent_guid, 'operand' => '=')),
		'metadata_name_value_pairs_operator' => 'AND',	
		
	));
	
	
	if($page_above || $page_below){
		if($direction == 'up'){
			
			$above = get_entity($page_above[0]->guid);	
		
			//move the above page to the order of the page
			$above->sub_orderno = $page->sub_orderno;
			$above->save();
			
			
			//and now move this page up one
			$page->sub_orderno = $page->sub_orderno -1;
			$page->save();
	
			return true;
		} elseif($direction == 'down'){
			
			$below = get_entity($page_below[0]->guid);	
			//move the above page to the order of the page
			$below->sub_orderno = $page->sub_orderno;
			$below->save();
			//and now move this page up one
			$page->sub_orderno = $page->sub_orderno +1;
			$page->save();
			
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}