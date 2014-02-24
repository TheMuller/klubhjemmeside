<?php
/**
 * Latest Groups
 *
 */

elgg_push_context('widgets');

$title = elgg_view('output/url', array(
	'href' => "/groups/all",
	'text' => elgg_echo('gianna:latest:groups'),
	'is_trusted' => true,
));

$num = (int) elgg_get_plugin_setting('num_groups', 'gianna');

$options = array(
	'type' => 'group', 
	'full_view' => FALSE,
	'pagination' => FALSE,
	'limit' => $num,
);
$groups = elgg_list_entities($options);

elgg_pop_context();

if ($groups) {
	echo elgg_view_module('latest-groups', $title, $groups);
} else {
	$groups = elgg_echo('gianna:groups:none');
	echo elgg_view_module('aside', $title, $groups);
}
