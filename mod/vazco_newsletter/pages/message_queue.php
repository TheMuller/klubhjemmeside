<?php //ł ?><?php

	// include the Elgg engine
	include_once dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php"; 

	// maybe logged in users only?
	//gatekeeper();
	
	// maybe admin only?
	admin_gatekeeper();
	
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

	
	$filter = get_input('filter',null);
	
	$messages = array();
	
	//set title
	$title = elgg_echo('vazco_newsletter:page:message_queue:title');
	
	if($filter!==null)
	{
		switch($filter)
		{
			case 'not_sent':
				//$messages_ser = get_plugin_setting('queue_not_sent','vazco_newsletter');
				
				$messages = vazco_newsletter::getQueue('not_sent');
				$title = elgg_echo("vazco_newsletter:message_queue:not_sent");
				break;
			case 'sent':
				//$messages_ser = get_plugin_setting('queue_sent','vazco_newsletter');
				$messages = vazco_newsletter::getQueue('sent');
				$title = elgg_echo("vazco_newsletter:message_queue:sent");
				break;
			case 'error':
				//$messages_ser = get_plugin_setting('queue_error','vazco_newsletter');
				$messages = vazco_newsletter::getQueue('error');
				$title = elgg_echo("vazco_newsletter:message_queue:error");
				break;
		}
	}
	
	//$messages = vazco_newsletter::getQueue('not_sent');
	
	if($messages)
	{
		$contentBody='<ul>';
		foreach($messages as $i => $row)
		{
			$user = get_entity($row[0]);
			$newsletter = get_entity($row[1]);
			$contentBody .= '<li>['.$i.'] user <strong>'.($user->name).'</strong> should receive <strong>'.($newsletter->name).'</strong> newsletter</li>';						
		}
		$contentBody.='</ul>';	
	}
	else
		$contentBody = elgg_echo('vazco_newsletter:emptyqueue');
		
	// create content for main column
	$content = elgg_view_title($title);
	//wrap content in contentWrapper
	$content .= elgg_view('page_elements/contentwrapper', array('body' => $contentBody, 'subclass' => null));
	
	// layout the sidebar and main column using the default sidebar
	$body = elgg_view_layout('admin_panel', '', $content, ' ');

	// create the complete html page and send to browser
	page_draw($title, $body);
?>