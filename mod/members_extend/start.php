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
	elgg_register_action("member/download"						, "$action_path/download.php");
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
	echo "hdsj".$base;
	///////
	echo "$user";
$mypost= elgg_get_site_url()."members/upload";
	$mypost = elgg_add_action_tokens_to_url($mypost);
	$file = elgg_view('input/file', array(
	
      'name' => "upload",
      'is_trusted' => true
   ));
   $file .= elgg_view('input/submit', array(
  
	'value' => 'Upload Now'
	));
	echo elgg_view('input/form', array(
	'body' => $file,
	'enctype' => 'multipart/form-data',
	'action' => 'members/upload'
	));
	/////////
	
		require_once "$base/upload.php";
	} else {
	 
   
		require_once "$base/index.php";
	}
	return true;
}
