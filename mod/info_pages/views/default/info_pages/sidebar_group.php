<?php
/**
 * Pages sidebar
 */
 $group = elgg_get_page_owner_entity();
 $url = elgg_get_site_url() . "info_pages/add/{$group->getGUID()}";
 

 
$body = elgg_list_entities_from_relationship(array(
	'relationship' => 'info pages',
	'relationship_guid' => $vars['entity']->guid,
	'list_type' => 'gallery',
	));


$body .= elgg_view_menu('info_pages', array('sort_by'=> 'priority'));
if($vars['entity']->canEdit()){
 $body .= elgg_view('output/url', array(
	'href' => $url,
	'text' => elgg_echo('Create Page'),
	'is_trusted' => true,
));}
echo elgg_view_module('aside', elgg_echo('Info Pages'), $body);
