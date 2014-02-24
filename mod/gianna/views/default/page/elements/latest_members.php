<?php
/**
 * Latest Members module
 *
 */

elgg_push_context('widgets');

$title = elgg_view('output/url', array(
	'href' => "/members",
	'text' => elgg_echo('gianna:latest:members'),
	'is_trusted' => true,
));

$num = (int) elgg_get_plugin_setting('num_members', 'gianna');

$options = array(
	'type' => 'user', 
	'full_view' => false,
	'pagination' => FALSE,
	'limit' => $num,
	'list_type' => 'gallery'
);
$content = elgg_list_entities($options);

elgg_pop_context();

echo elgg_view_module('featured', $title, $content);
