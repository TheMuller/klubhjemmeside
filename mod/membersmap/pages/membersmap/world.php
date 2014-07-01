<?php
/**
 * Map of all members
 *
 * @package MembersMap
 */


if(elgg_is_active_plugin("kanelggamapsapi")){
	elgg_load_library('elgg:kanelggamapsapi');  
	elgg_load_library('elgg:kanelggamapsapigeocoder'); 

	if (not_permit_public_access())	{
		gatekeeper();
	}

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

	if (check_if_add_tab_on_entity_page('membersmap'))	{
		elgg_push_breadcrumb(elgg_echo('members'), "members");
	}

	elgg_push_breadcrumb(elgg_echo('membersmap'), "membersmap/all");
	$title = elgg_echo('membersmap:all');
	$options = array('type' => 'user', 'full_view' => false);
	switch ($vars['page']) {
		case 'friends':
				gatekeeper();	// desable login to non logged-in members
				elgg_push_breadcrumb(elgg_echo('membersmap:label:friends'));
				$title = elgg_echo('membersmap:map').': '.elgg_echo('membersmap:label:friends');
				$options['relationship'] = 'friend';
				$options['relationship_guid'] = elgg_get_logged_in_user_guid();
				$options['types'] = 'user';	
				$options['inverse_relationship'] = false;
				$options['limit'] = 0;
				$users = elgg_get_entities_from_relationship($options);
				break;
		case 'online':
				gatekeeper();	// desable login to non logged-in members
				elgg_push_breadcrumb(elgg_echo('membersmap:label:online'));
				$title = elgg_echo('membersmap:map').': '.elgg_echo('membersmap:label:online');
				$users = get_online_users_map();
				break;
		case 'group':
				$group = elgg_get_page_owner_entity();
				elgg_push_breadcrumb(elgg_echo('membersmap:membersof', array($group->name)));
				$title = elgg_echo('membersmap:map').': '.elgg_echo(elgg_echo('membersmap:membersof', array($group->name)));
				$options = array('type' => 'user', 'full_view' => false);
				$options['relationship'] = 'member';
				$options['relationship_guid'] = $group->guid;
				$options['types'] = 'user';		
				$options['inverse_relationship'] = true;
				$options['limit'] = 0;
				$users = elgg_get_entities_from_relationship($options);
				break;        
		default:
				$title = elgg_echo('membersmap:map').': '.elgg_echo('membersmap:allmembers');
				$options['types'] = 'user';		
				$options['limit'] = 0;
				$options['metadata_name_value_pairs'] = array(array('name' => 'location', 'value' => '', 'operand' => '!='));
				$users = elgg_get_entities_from_metadata($options);
				break;
	}
	 
	$content = elgg_view('membersmap/allusers', array(
		'user'=>$users,
		'mapwidth'=>$mapwidth,
		'mapheight'=>$mapheight,
		'defaultlocation'=>$defaultlocation,
		'defaultzoom'=>$mapzoom,
		'defaultcoords'=>$defaultcoords,
		'clustering'=>$clustering,
		'clustering_zoom'=>$clustering_zoom
		)
	);

	$params = array(
		'content' => $content,
		'sidebar' => elgg_view('membersmap/sidebar'),
		'title' => $title,
		'filter_override' => elgg_view('membersmap/nav', array('selected' => $vars['page'])),
	);

	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}
else
{
	register_error(elgg_echo("membersmap:settings:kanelggamapsapi:notenabled"));
	forward(REFERER);
}

// release variables
unset($users);
