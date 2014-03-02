<?php
/**
 * View a single page
 *
 * @package ElggPages
 */


$page_guid = get_input('guid');
$page = get_entity($page_guid);

if (!$page) {
	forward();
}

//we use this to stop showing the owner block!
set_page_owner($page_guid);

$title = $page->title;

elgg_push_breadcrumb($title);


$content = elgg_view_entity($page, array('full_view' => true));
if($page->parent_guid){
	$parent = get_entity($page->parent_guid);
}
if (elgg_get_logged_in_user_guid() == $page->getOwnerGuid() && !$parent->parent_guid) {
	$url = "info_pages/add/$page->guid";
	elgg_register_menu_item('title', array(
			'name' => 'subpage',
			'href' => $url,
			'text' => elgg_echo('info_pages:newchild'),
			'link_class' => 'elgg-button elgg-button-action',
	));
}

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('info_pages/sidebar'),
));

echo elgg_view_page($title, $body, 'default', array('entity'=>$page));




