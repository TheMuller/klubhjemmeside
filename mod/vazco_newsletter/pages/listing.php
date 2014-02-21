<?php //ł ?><?php
	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
	//admin_gatekeeper(); // should listing of all entities be private?
	set_context('newsletter');
	set_page_owner(get_loggedin_userid());
	
	
	//listing with the followin parameters:
	//$owner_guid = 0, $limit = 10, $fullview = false, $viewtypetoggle = false, $pagination = true
	/*$entities = list_entities("object", "newsletter", 0, 0, false,false,false);
	if (!$entities){
		$entities = "<div class='contentWrapper'>".elgg_echo('vazco_newsletter:nodata')."</div>";
	}*/
	
	$filter = get_input('filter',null);
	
	$options = array(
		'type' => 'object',
		'subtype' => 'newsletter',	
	);
	
	//set title
	$title = elgg_echo("vazco_newsletter:all");
	
	if($filter!==null)
	{
		switch($filter)
		{
			case 'not_sent':
				$options['metadata_name_value_pairs'] = array('name'=>'isSent', 'value' => true, 'operand' => '<>');
				$title = elgg_echo("vazco_newsletter:not_sent");
				break;
			case 'sent':
				$options['metadata_name_value_pairs'] = array('name'=>'isSent', 'value' => true, 'operand' => '=');
				$title = elgg_echo("vazco_newsletter:sent");
				break;
		}
	}
	
	$body = elgg_view_title($title);
	
	$entities = elgg_get_entities_from_metadata($options);
	
	if($entities)
		$entities = elgg_view_entity_list($entities, count($entities), 0, 20, false, false, true);
	else
		$entities = elgg_view('page_elements/contentwrapper',array('body'=>elgg_echo('vazco_newsletter:nonewsletters')));
	

	$body .= $entities;
	$body = elgg_view_layout('admin_panel', '', $body, ' ');
	
	// Finally draw the page
	page_draw($title, $body);

?>