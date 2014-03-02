<?php
/**
 * Remove a page
 *
 * CANNOT Delete if has subpage
 *
 */

$guid = get_input('guid');
$page = get_entity($guid);
if ($page) {
	if ($page->canEdit()) {
		$container = get_entity($page->container_guid);

		$subpages = elgg_get_entities_from_metadata(array(
			'types' => 'object',
			'subtypes' => 'info_page',
	
			'metadata_name_value_pairs' => array( array('name' => 'parent_guid', 'value' => $page->guid, 'operand' => '=')),
		));
		
		
		if(!$subpages){
			if ($page->delete()) {
				system_message(elgg_echo('info_pages:delete:success'));
				forward('info_pages');
			} 
		} else {
			register_error(elgg_echo('info_pages:delete:failure:subpages'));
			forward(REFERER);
		}
	}
}

register_error(elgg_echo('info_pages:delete:failure'));
forward(REFERER);
