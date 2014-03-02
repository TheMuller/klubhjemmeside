<?php
/**
 * Create or edit a page
 *
 * @package ElggPages
 */

elgg_load_library('elgg:info_pages');

$variables = elgg_get_config('info_pages');
$input = array();
foreach ($variables as $name => $type) {
	$input[$name] = get_input($name);
	if ($name == 'title') {
		$input[$name] = strip_tags($input[$name]);
	}
	if ($type == 'tags') {
		$input[$name] = string_to_tag_array($input[$name]);
	}
	if ($name == 'path'){
		$input[$name] = str_replace(' ', '-', $input[$name]);
	}
}

// Get guids
$page_guid = (int)get_input('page_guid');
$container_guid = (int)get_input('container_guid');
$parent_guid = (int)get_input('parent_guid');

elgg_make_sticky_form('info_page');

if (!$input['title']) {
	register_error(elgg_echo('info_pages:error:no_title'));
	forward(REFERER);
}

if ($page_guid) {
	$page = get_entity($page_guid);
	if (!$page || !$page->canEdit()) {
		register_error(elgg_echo('info_pages:error:no_save'));
		forward(REFERER);
	}
	$new_page = false;
	if(!$parent_guid || $parent_guid == 0){
		$page->sub_orderno = NULL;
		$page->orderno = info_pages_find_next_orderno();
		$page->parent_guid = NULL;
	}
} else {
	$page = new ElggObject();
	$page->subtype = 'info_page';
	$new_page = true;
	if(!$parent_guid || $parent_guid == 0){
		$page->orderno = info_pages_find_next_orderno();
	} else {
		$page->sub_orderno = info_pages_find_next_orderno($parent_guid);
	}
}

if (sizeof($input) > 0) {
	foreach ($input as $name => $value) {
		$page->$name = $value;
	}
}

// need to add check to make sure user can write to container
$page->container_guid = $container_guid;

if ($parent_guid && $parent_guid != 0) {
	$page->parent_guid = $parent_guid;
}

//show in menu?
$page->menu_show = get_input('menu_show');

if ($page->save()) {

	elgg_clear_sticky_form('info_page');

	system_message(elgg_echo('info_pages:saved'));


	forward($page->getURL());
} else {
	register_error(elgg_echo('info_pages:error:no_save'));
	forward(REFERER);
}
