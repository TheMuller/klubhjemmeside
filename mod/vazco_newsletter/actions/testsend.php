<?php //ł ?><?php

	// must be logged in
	//action_gatekeeper();
	//must be admin
	//admin_gatekeeper();
	
	// must have security token, don't remove for better security 
	action_gatekeeper();
	
	// get parameters that were posted
	$guid = get_input('guid');
	$entity = get_entity($guid);
	$newsletter_guid = get_input('newsletter');
	$newsletter = get_entity($newsletter_guid);
	
	// perform action on entity
	if (!vazco_newsletter::testsend($entity,$newsletter)) {
		register_error(elgg_echo('vazco_newsletter:testsend:failure'));
		forward($_SERVER['HTTP_REFERER']);
	}

	// we had success so forward the user somewhere and display success message
	system_message(elgg_echo('vazco_newsletter:testsend:success'));
	forward($_SERVER['HTTP_REFERER']);
?>