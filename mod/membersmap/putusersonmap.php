<?php
/**
 * Elgg membersmap helper functions
 *
 * @package MembersMap
 */

// Get engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

admin_gatekeeper();

if(elgg_is_active_plugin("kanelggamapsapi")){
	elgg_load_library('elgg:kanelggamapsapi');  
	elgg_load_library('elgg:kanelggamapsapigeocoder'); 

	$options = array('type' => 'user', 'full_view' => false, 'limit' => 0);
	$users = elgg_get_entities($options);

	foreach ($users as $u)  {

		if (!isset($u->location) || !$u->location) {
			echo '<p>'.$u->username.': not location set';
		}
		else    {
			// function below is required when users saved location before enable members map plugin
			if (!$u->getLatitude() || !$u->getLongitude())  {
				sleep(1);
				$vars['value'] = $u->location;
				if (is_array($vars['value'])) {
						$vars['value'] = implode(', ', $vars['value']);
						$location = elgg_view('output/tag', $vars);
						//echo elgg_view('output/tag', $vars);
				}	
				else
				{
					$location = $u->location;
				}
				$location = strip_tags($location);
				
				$ccc = save_object_coords($location, $u, 'kanelggamapsapi');
				if ($ccc) echo '<p>'.$u->username.': geolocation DONE</p>';
				else {
					echo '<p>'.$u->username.': geolocation failed, '.$location.'</p>';
				}
				
				// keeps it flowing to the browser
				flush();
				// 50000 microseconds keeps things flowing in safari, IE, firefox, etc
				usleep(50000);				
			}
			else  {
				echo '<p>'.$u->username.': is OK</p>';
			}
		}	

	}

	echo "Geolocation finished for all users";
}
else
{
	register_error(elgg_echo("membersmap:settings:kanelggamapsapi:notenabled"));
	forward(REFERER);
}	
