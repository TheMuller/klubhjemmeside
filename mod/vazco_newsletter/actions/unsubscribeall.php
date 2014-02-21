<?php //ł ?><?php


	//must be admin
	admin_gatekeeper();
	
	// must have security token, don't remove for better security 
	action_gatekeeper();
	
	// get parameters that were posted
	$guid = get_input('guid');
	$entity = get_entity($guid);
	
	// perform action on entity
	if (!vazco_newsletter::unsubscribeall($entity)) {
		register_error(elgg_echo('vazco_newsletter:unsubscribeall:failure'));
		forward($_SERVER['HTTP_REFERER']);
	}

	// we had success so forward the user somewhere and display success message
	system_message(elgg_echo('vazco_newsletter:unsubscribeall:success'));
	forward($_SERVER['HTTP_REFERER']);
?>