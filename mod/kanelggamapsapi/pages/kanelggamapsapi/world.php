<?php
/**
 * Elgg kanelggamapsapi plugin
 * @package KanelggaMapsApi 
 */

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
$clustering = get_map_gm_clustering();
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

elgg_push_breadcrumb(elgg_echo('kanelggamapsapi:all'), 'kanelggamapsapi');
$title = elgg_echo('kanelggamapsapi:all');

$indextable = '';
$users = array();
if (check_if_membersmap_gm_enabled()) {
	$options1 = array('type' => 'user', 'full_view' => false);
	$options1['limit'] =0;
	$options1['metadata_name_value_pairs'] = array(array('name' => 'location', 'value' => '', 'operand' => '!='));
	$users = elgg_get_entities_from_metadata($options1);
	$indextable .= '<div style="margin: 0 15px 0 0;"><input type="checkbox" name="chbx_user" id="chbx_user" checked="checked"><label for="chbx_user">'.elgg_echo('kanelggamapsapi:members').'</label></div>';
}

$groups = array();
if (check_if_groupsmap_gm_enabled()) {
	$options2 = array('type' => 'group', 'full_view' => false);
	$options2['limit'] = 0;
	$options2['metadata_name_value_pairs'] = array(array('name' => 'grouplocation', 'value' => '', 'operand' => '!='));
	$groups = elgg_get_entities_from_metadata($options2);
	$indextable .= '<div style="margin: 0 15px 0 0;"><input type="checkbox" name="chbx_group" id="chbx_group" checked="checked"><label for="chbx_group">'.elgg_echo('kanelggamapsapi:groups').'</label></div>';
}

$ads = array();
if (check_if_agora_gm_enabled()) {
	$options3 = array(
		'type' => 'object',
		'subtype' => 'agora',
		'limit' => 0,
		'full_view' => false,
		'view_toggle_type' => false 
	);
	$options3['metadata_name_value_pairs'] = array(array('name' => 'location', 'value' => '', 'operand' => '!='));
	$ads = elgg_get_entities_from_metadata($options3);
	$indextable .= '<div style="margin: 0 15px 0 0;"><input type="checkbox" name="chbx_agora" id="chbx_agora" checked="checked"><label for="chbx_agora">'.elgg_echo('kanelggamapsapi:agora').'</label></div>';	
}
 
$subtotal = array_merge($users, $groups);
$total = array_merge($subtotal, $ads);

$content = elgg_view('kanelggamapsapi/global', array(
	'user'=>$total,
	'mapwidth'=>$mapwidth,
	'mapheight'=>$mapheight,
	'defaultlocation'=>$defaultlocation,
	'defaultzoom'=>$mapzoom,
	'defaultcoords'=>$defaultcoords,
	'clustering'=>$clustering,
	'clustering_zoom'=>$clustering_zoom
	)
);


if (!$clustering)    {
	$side_vars = array('indextable'=>$indextable);
}
else    {
	$side_vars = array();
}
    
$params = array(
	'content' => $content,
	'sidebar' => elgg_view('kanelggamapsapi/sidebar', $side_vars),
	'title' => $title,
	'filter_override' => elgg_view('kanelggamapsapi/nav', array('selected' => $vars['page'])),
);

$body = elgg_view_layout('content', $params);


echo elgg_view_page($title, $body);

// release variables
unset($users);
unset($groups);
unset($ads);
unset($subtotal);
unset($total);





