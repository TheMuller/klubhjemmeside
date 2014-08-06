<?php
/**
 * Members search page
 * @package MembersMap
 */

if(elgg_is_active_plugin("kanelggamapsapi")){
	elgg_load_library('elgg:kanelggamapsapi');  
	elgg_load_library('elgg:kanelggamapsapigeocoder'); 

	if (not_permit_public_access())	{
		gatekeeper();
	}

	$name = sanitize_string(get_input('name'));
	$radius = sanitize_string(get_input('radius'));

	if (check_if_add_tab_on_entity_page('membersmap'))	{
		elgg_push_breadcrumb(elgg_echo('members'), "members");
	}
	elgg_push_breadcrumb(elgg_echo('membersmap'), "membersmap/all");
	elgg_push_breadcrumb(elgg_echo('membersmap:searchbyname'));
	$title = elgg_echo('membersmap:search:searchname', array($name));

	// Retrieve map width 
	$mapwidth = get_map_width();
	// Retrieve map height
	$mapheight = get_map_height();
	// Retrieve map default location
	$defaultlocation = get_map_default_location();
	// Retrieve map zoom
	$mapzoom = get_map_zoom();
	// Retrieve cluster feature
	$clustering = get_map_clustering();
	$clustering_zoom = CUSTOM_CLUSTER_ZOOM;

	// get coords of default location
	$defaultcoords = CUSTOM_DEFAULT_COORDS; // set coords of Europe in case default location is not set
	$mapkey = trim(elgg_get_plugin_setting('google_api_key', 'kanelggamapsapi'));
	$geocoder = new Geocoder($mapkey);
	if ($defaultlocation) {
		try {
			$placemarks = $geocoder->lookup($defaultlocation);
		}
		catch (Exception $ex) {
			system_message($ex->getMessage());
			//exit;
		}   

		if (count($placemarks) > 0) { 
			$defaultcoords = $placemarks[0]->getPoint()->getLatitude().','.$placemarks[0]->getPoint()->getLongitude();
		} 
	}

	$db_prefix = elgg_get_config('dbprefix');
	$params1 = array(
		'type' => 'user', 
		'full_view' => false,
		'limit' => 0,
		'joins' => array("JOIN {$db_prefix}users_entity u ON e.guid=u.guid"),
		'wheres' => array("(u.name LIKE \"%{$name}%\" OR u.username LIKE \"%{$name}%\")"),
	);

	$usersfound = array();
	$usersfound = elgg_get_entities($params1);

	if (empty($usersfound)) {
		$content = elgg_echo('membersmap:search:usernotfound');
	}
	else    {
		$params2 = array(
			'type' => 'user', 
			'full_view' => false,
			'limit' => 0,
			'joins' => array("JOIN {$db_prefix}users_entity u ON e.guid=u.guid"),
			'wheres' => array("(u.name NOT LIKE \"%{$name}%\" AND u.username NOT LIKE \"%{$name}%\")"),
		);
		$params2['metadata_name_value_pairs'] = array(array('name' => 'location', 'value' => '', 'operand' => '!='));
		$users = elgg_get_entities_from_metadata($params2);    
		
		$content = elgg_view('membersmap/searchname', array(
			'usersfound'=>$usersfound,
			'user'=>$users,
			'mapwidth'=>$mapwidth,
			'mapheight'=>$mapheight,
			'defaultlocation'=>$defaultlocation,
			'defaultzoom'=>$mapzoom,
			'radius'=>$radius,
			'name'=>$name,
			'defaultcoords'=>$defaultcoords,
			'clustering'=>$clustering,
			'clustering_zoom'=>$clustering_zoom
			)
		);
	}

	$params = array(
		'title' => $title,
		'content' => $content,
		'sidebar' => elgg_view('membersmap/sidebar'),
	);

	$body = elgg_view_layout('one_sidebar', $params);

	echo elgg_view_page($title, $body);
}
else
{
	register_error(elgg_echo("membersmap:settings:kanelggamapsapi:notenabled"));
	forward(REFERER);
}

// release variables
unset($users);
unset($usersfound);
