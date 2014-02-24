<?php
/**
 * Menu module
 *
 */


$title = elgg_echo('gianna:owner:menu');

$body = elgg_view_menu('owner_block', array(
	'entity' => elgg_get_page_owner_entity(),
));

echo elgg_view('page/components/module', array(
	'title' => $title,
	'body' => $body,
	'class' => 'elgg-module-menu',
));
