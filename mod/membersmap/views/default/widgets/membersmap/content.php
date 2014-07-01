<?php
/**
 * Show map based on search of all members
 *
 * @package MembersMap
 */

if(elgg_is_active_plugin("kanelggamapsapi")){
	// load kanelgga maps api libraries
	elgg_load_library('elgg:kanelggamapsapi');  
	elgg_load_library('elgg:kanelggamapsapigeocoder'); 

	$u = elgg_get_page_owner_entity();

	if ($u->location && $u->getLatitude() && $u->getLongitude())  {
		$location = $u->getLatitude().','.$u->getLongitude();
	}
	else    {
		$location = CUSTOM_DEFAULT_COORDS; 

		// Retrieve map default location
		$defaultlocation = get_map_default_location();
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
				$location = $placemarks[0]->getPoint()->getLatitude().','.$placemarks[0]->getPoint()->getLongitude();
			} 
		}
	}

	$zoom = isset($vars['entity']->zoom) ? $vars['entity']->zoom : get_map_zoom();

	echo elgg_view('membersmap/map',array(
			'location'=>$location, 
			'zoom' => $zoom
		)
	);
}
else
{
	register_error(elgg_echo("membersmap:settings:kanelggamapsapi:notenabled"));
}	

