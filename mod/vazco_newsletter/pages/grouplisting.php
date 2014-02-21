<?php //ł ?><?php
	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
	
	set_context('newsletter');
	$group_guid = get_input('guid',0);
	$group = get_entity($group_guid);
	if ($group){
		set_page_owner($group->guid);
	}else{
		//group don't exist
		register_error(elgg_echo('vazco_newsletter:nogroupwithid'));
		forward($_SERVER['HTTP_REFERER']);
	}
	
	//set title
	$title = elgg_echo("vazco_newsletter:grouplisting");
	$body = elgg_view_title($title);
	
	//listing with the following parameters:
	//$owner_guid = 0 (all owners), $limit = 10, $fullview = false, $viewtypetoggle = false, $pagination = true
	$entities = elgg_list_entities(array(
		'type'=>'object', 
		'subtype'=>'newsletter',
		'limit'=>10,
		'container_guids'=>array($group_guid),
		'full_view'=>false)
	);
	if (!$entities){
		$entities = "<div class='contentWrapper'>".elgg_echo('vazco_newsletter:nodata')."</div>";
	}
	$body .= $entities;
	$body = elgg_view_layout('admin_panel', '', $body, '');
	
	// Finally draw the page
	page_draw($title, $body);

?>