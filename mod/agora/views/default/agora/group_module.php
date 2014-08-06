<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

$group = elgg_get_page_owner_entity();

if ($group->agora_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "agora/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'agora',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
);
$content = elgg_list_entities($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('agora:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "agora/add/$group->guid",
	'text' => elgg_echo('agora:add'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('agora:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
