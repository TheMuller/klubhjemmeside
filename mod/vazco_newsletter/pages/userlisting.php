<?php //ł ?><?php
	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
	
	set_context('newsletter');
	$user_guid = get_input('guid', get_loggedin_userid());
	if(	
		(
			$user_guid != get_loggedin_userid() 
			&& !isadminloggedin() 
		)
	){
		register_error(elgg_echo('vazco_newsletter:error_rights'));//if no writes to view listing
		forward($_SERVER['HTTP_REFERER']);
	}
	$user = get_entity($user_guid);
	if (!$user){
		register_error(elgg_echo('vazco_newsletter:error_rights'));//if no writes to view listing
		forward($_SERVER['HTTP_REFERER']);
	}
	
	//set title
	$title = sprintf(elgg_echo("vazco_newsletter:userlisting"),$user->name);
	$body = elgg_view_title($title);
	set_page_owner($user_guid);	
	//listing with the following parameters:
	//$owner_guid = $user_guid, $limit = 10, $fullview = false, $viewtypetoggle = false, $pagination = true
	$entities = list_entities("object", "newsletter", $user_guid, 10, false,false,true);
	if (!$entities){
		$entities = "<div class='contentWrapper'>".elgg_echo('vazco_newsletter:nodata')."</div>";
	}
	$body .= $entities;
	$body = elgg_view_layout('admin_panel', '', $body, ' ');
	
	// Finally draw the page
	page_draw($title, $body);

?>