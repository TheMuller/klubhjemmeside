<?php
/**
 * Blogs
 *
 * @package Blog
 *
 * @todo
 * - Either drop support for "publish date" or duplicate more entity getter
 * functions to work with a non-standard time_created.
 * - Pingbacks
 * - Notifications
 * - River entry for posts saved as drafts and later published
 */

    elgg_register_event_handler('init', 'system', 'private_pages_init');

function private_pages_init() {

    elgg_register_page_handler('members', 'private_members_page_handler');

    elgg_register_page_handler('members_extend', 'private_members_extend_page_handler');

    elgg_register_page_handler('profile', 'private_profile_page_handler');

    elgg_register_page_handler('groups', 'private_groups_page_handler');

    //elgg_unregister_page_handler('file');
    //elgg_register_page_handler('file', 'private_pages_page_handler');

}


// K - Replacing the members page handler
function private_members_page_handler($page) {

    // K - only admins can see the members list
    gatekeeper();

	$base = elgg_get_plugins_path() . 'members/pages/members';

	if (!isset($page[0])) {
		$page[0] = 'newest';
	}

	$vars = array();
	$vars['page'] = $page[0];

	if ($page[0] == 'search') {
		$vars['search_type'] = $page[1];
		require_once "$base/search.php";
	} else {
		require_once "$base/index.php";
	}
	return true;
}

// K - Replacing the members extend page handler
function private_members_extend_page_handler($page) {
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

// Replacing the profile page handler
function private_profile_page_handler($page) {

    // K - only logged in can see the profile
    gatekeeper();

	if (isset($page[0])) {
		$username = $page[0];
		$user = get_user_by_username($username);
		elgg_set_page_owner_guid($user->guid);
	} elseif (elgg_is_logged_in()) {
		forward(elgg_get_logged_in_user_entity()->getURL());
	}

	// short circuit if invalid or banned username
	if (!$user || ($user->isBanned() && !elgg_is_admin_logged_in())) {
		register_error(elgg_echo('profile:notfound'));
		forward();
	}

	$action = NULL;
	if (isset($page[1])) {
		$action = $page[1];
	}

	if ($action == 'edit') {
		// use the core profile edit page
		$base_dir = elgg_get_root_path();
		require "{$base_dir}pages/profile/edit.php";
		return true;
	}

	// main profile page
	$params = array(
		'content' => elgg_view('profile/wrapper'),
		'num_columns' => 3,
	);
	$content = elgg_view_layout('widgets', $params);

	$body = elgg_view_layout('one_column', array('content' => $content));
	echo elgg_view_page($user->name, $body);
	return true;
}


// Replacing the group page handler
function private_groups_page_handler($page) {

    // K - only logged in can see the group list
    gatekeeper();

	// forward old profile urls
	if (is_numeric($page[0])) {
		$group = get_entity($page[0]);
		if (elgg_instanceof($group, 'group', '', 'ElggGroup')) {
			system_message(elgg_echo('changebookmark'));
			forward($group->getURL());
		}
	}

	elgg_load_library('elgg:groups');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('groups'), "groups/all");

	switch ($page[0]) {
		case 'all':
			groups_handle_all_page();
			break;
		case 'search':
			groups_search_page();
			break;
		case 'owner':
			groups_handle_owned_page();
			break;
		case 'member':
			set_input('username', $page[1]);
			groups_handle_mine_page();
			break;
		case 'invitations':
			set_input('username', $page[1]);
			groups_handle_invitations_page();
			break;
		case 'add':
			groups_handle_edit_page('add');
			break;
		case 'edit':
			groups_handle_edit_page('edit', $page[1]);
			break;
		case 'profile':
			groups_handle_profile_page($page[1]);
			break;
		case 'activity':
			groups_handle_activity_page($page[1]);
			break;
		case 'members':
			groups_handle_members_page($page[1]);
			break;
		case 'invite':
			groups_handle_invite_page($page[1]);
			break;
		case 'requests':
			groups_handle_requests_page($page[1]);
			break;
		default:
			return false;
	}
	return true;
}
