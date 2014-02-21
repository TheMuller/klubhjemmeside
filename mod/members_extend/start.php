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
}

/**
 * Members page handler
 *
 * @param array $page url segments
 * @return bool
 */
function members_extend_page_handler($page) {
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
	} else {
		require_once "$base/index.php";
	}
	return true;
}
