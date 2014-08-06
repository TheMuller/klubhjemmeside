<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');
elgg_load_js('lightbox');
elgg_load_css('lightbox');

$classifd_guid = get_input('guid');
$agora = get_entity($classifd_guid);

if (!elgg_instanceof($agora, 'object', 'agora') || !$agora->canEdit()) {
	register_error(elgg_echo('agora:unknown_classifd'));
	forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('agora:edit');
elgg_push_breadcrumb($title);

if (check_if_admin_terms_classifieds())	
	$form_vars = array('name' => 'agoraForm', 'js' => 'onsubmit="acceptTerms();return false;"', 'enctype' => 'multipart/form-data');
else
	$form_vars = array('name' => 'agoraForm', 'enctype' => 'multipart/form-data');
		    
$vars = agora_prepare_form_vars($agora);
$content = elgg_view_form('agora/add', $form_vars, $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
