<?php //ł ?><?php
	// Load Elgg engine
	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

	// Define context
	set_context('newsletter'); //set automatically
	global $CONFIG;

	$entity_guid = get_input('guid',0);
	$entity = get_entity($entity_guid);
	if (!$entity) {
		register_error('vazco_newsletter:error_nosuchentity');
		forward($_SERVER['HTTP_REFERER']);
	}
	//set page owner
	if ($entity->container_guid){
		set_page_owner($entity->container_guid);
	}else{
		set_page_owner(get_loggedin_userid());
	}

	$title = elgg_translate($entity,'name');
	$body = elgg_view_title($title);
	$body .= elgg_view_entity($entity,true);

	page_draw($title,elgg_view_layout("admin_panel", '', $body));
?>