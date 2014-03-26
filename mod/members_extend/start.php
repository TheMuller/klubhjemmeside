<?php
/**
 * Members plugin intialization
 */

elgg_register_event_handler('init', 'system', 'members_extend_init');


/**
 * Initialize page handler and site menu item
 */
function members_extend_init() {
	elgg_register_page_handler('members', 'members_extend_page_handler');
	$action_path = elgg_get_plugins_path().'members_extend/actions/member_extend';
//elgg_register_action("member/upload", "$action_path/upload.php");
	elgg_register_action("member/download", "$action_path/download.php");
	elgg_register_action("member/approve", "$action_path/approve.php");
	elgg_register_action("member/delete", "$action_path/delete.php");
	elgg_register_action("members/selected_groups", "$action_path/selected_groups.php");
}

/**
 * Members page handler
 *
 * @param array $page url segments
 * @return bool
 */
function members_extend_page_handler($page) {
include elgg_get_plugins_path().members_extend/actions/member_extend/download.php;
	$base = elgg_get_plugins_path() . 'members_extend/pages/members';

	if (!isset($page[0])) {
		$page[0] = 'newest';
	}

	$vars = array();
	$vars['page'] = $page[0];

	if ($page[0] == 'search') {
		$vars['search_type'] = $page[1];
		require_once "$base/search.php";
	} elseif( $page[0] == 'newuser') {
		require_once "$base/new.php";
	}elseif( $page[0] == 'upload') {

		require_once "$base/upload.php";
	} else {
	 
   
		require_once "$base/index.php";
	}
	return true;
}
