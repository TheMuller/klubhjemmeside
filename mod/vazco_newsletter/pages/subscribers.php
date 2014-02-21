<?php //ł ?><?php

	// include the Elgg engine
	include_once dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php"; 

	// maybe logged in users only?
	//gatekeeper();
	
	// maybe admin only?
	//admin_gatekeeper();
	
	// get any input
	//$guid = get_input('guid');
	
	// if username or owner_guid was not set as input variable, we need to set page owner
	// Get the current page's owner
	$page_owner = page_owner_entity();
	if (!$page_owner) {
		$page_owner_guid = get_loggedin_userid();
		if ($page_owner_guid){
			set_page_owner($page_owner_guid);
		}
	}	
	$title = elgg_echo('vazco_newsletter:page:subscribers:title');
	
	/*$options = array(
		'type' => 'user',
		'metadata_names' => 'isSubscribedNewsletter',
		'metadata_values' => true,	
	);
	$entities = elgg_get_entities_from_metadata($options);*/
	$entities = vazco_newsletter::getSubscribedEntities();
	
	$options = array(
			'type' => 'user',
			'metadata_name' => 'isSubscribedNewsletter',
			'metadata_value' => true,	
			'limit' => 10,
			'full_view' => false,
	);
	$contentBody = elgg_list_entities_from_metadata($options);
	if (!$contentBody)
		$contentBody = elgg_echo('vazco_newsletter:nosubscribers');
		
	//$contentBody .= '<hr/><a href="'.elgg_add_action_tokens_to_url($CONFIG->wwwroot.'action/newsletter/subscribe?guid='.get_loggedin_userid()).'">Subcribe me</a>';
	//$contentBody .= ' <a href="'.elgg_add_action_tokens_to_url($CONFIG->wwwroot.'action/newsletter/unsubscribe?guid='.get_loggedin_userid()).'">Unsubcribe me</a>';
		
	// create content for main column
	$content = elgg_view_title($title);
	//wrap content in contentWrapper
	$content .= elgg_view('page_elements/contentwrapper', array('body' => $contentBody, 'subclass' => null));
	
	// layout the sidebar and main column using the default sidebar
	$body = elgg_view_layout('admin_panel', '', $content, ' ');

	// create the complete html page and send to browser
	page_draw($title, $body);
?>