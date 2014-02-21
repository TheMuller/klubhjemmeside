<?php //ł ?><?php 
	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
	gatekeeper();
	set_context('newsletter');
	$entity_guid = get_input('guid',0);//from page handler
	if($entity_guid){
		$entity = get_entity($entity_guid);
		$title = elgg_echo('vazco_newsletter:edit');
	}else{
		$title = elgg_echo('vazco_newsletter:add');
	}
	
	//TODO setting page owner automatically - you might want to change that
	if($entity){
		set_page_owner($entity->container_guid);
	}
	else{
		set_page_owner(get_loggedin_userid());
	}
	
	//call a view that will call a template form for editting/adding with customized array of inputs
	$body = elgg_view('vazco_newsletter/edit',array('guid'=>$entity_guid));
	
	page_draw($title,elgg_view_layout("admin_panel", '', elgg_view_title($title) . $body, ' '));	
	
?>