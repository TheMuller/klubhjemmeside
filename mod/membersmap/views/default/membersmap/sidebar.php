<?php
/**
 * Search for content in this group
 *
 * @uses vars['entity'] ElggGroup
 */

if(elgg_is_active_plugin("kanelggamapsapi")){
	// load kanelgga maps api libraries
	elgg_load_library('elgg:kanelggamapsapi');  

	$sidebar = '';

	$sidebar .= '<div class="elgg-module  elgg-module-aside">';
	$sidebar .= '<div class="elgg-head"><h3>'.elgg_echo("membersmap:search").'</h3></div>';
	$sidebar .= '<div class="elgg-body">';
	$sidebar .= '<input class="elgg-input-text elgg-autofocus" id="address" type="text" value="" placeholder="'.elgg_echo("membersmap:search:location").'">';
	$sidebar .= '<input class="elgg-input-text" id="radius" type="text" value="" placeholder="'.get_unit_of_measurement_string().'">';
	$sidebar .= '<label class="mtm float-alt"><input id="showradius" type="checkbox" value="show" >'.elgg_echo("membersmap:search:showradius").'</label><br />';
	$sidebar .= '<input type="submit" class="elgg-button elgg-button-submit" value="'.elgg_echo("membersmap:search:submit").'" onclick="codeAddress()">';
	$sidebar .= '</div>';
	$sidebar .= '</div>';

	if ($user = elgg_get_logged_in_user_entity())   {
		if (!empty($user->location))    {
			$sidebar .= '<div class="elgg-module  elgg-module-aside">';
			$sidebar .= '<div class="elgg-head"><h3>'.elgg_echo("membersmap:searchnearby").'</h3></div>';
			$sidebar .= '<div class="elgg-body">';
			$sidebar .= '<small>'.elgg_echo("membersmap:mylocationsis").'<i>'.$user->location.'</i></small>';
			$sidebar .= '<input class="elgg-input-text" id="radiusmyloc" type="text" value="" placeholder="'.get_unit_of_measurement_string().'">';
			$sidebar .= '<label class="mtm float-alt"><input id="showradiusloc" type="checkbox" value="show" >'.elgg_echo("membersmap:search:showradius").'</label>';
			$sidebar .= '<input type="submit" class="elgg-button elgg-button-submit" value="'.elgg_echo("membersmap:search:submit").'" onclick="codeAddress(\''.$user->location.'\')">';
			$sidebar .= '</div>';
			$sidebar .= '</div>';
		}
	}

	if (get_search_by_name('membersmap'))  {
		$sidebar .= '<div class="elgg-module  elgg-module-aside">';
		$sidebar .= '<div class="elgg-head"><h3>'.elgg_echo("membersmap:searchbyname").'</h3></div>';
		$sidebar .= '<div class="elgg-body">';
		$sidebar .= '<form method="get" action="'.elgg_get_site_url() .'membersmap/search/name" class="elgg-form elgg-form-members-name-search">';
		$sidebar .= '<input class="elgg-input-text" name="name" type="text" value="'.sanitize_string(get_input('name')).'" placeholder="'.elgg_echo("membersmap:search:name").'">';
		$sidebar .= '<input class="elgg-input-text" name="radius" type="text" value="'.sanitize_string(get_input('radius')).'" placeholder="'.get_unit_of_measurement_string().'">';
		$sidebar .= '<input type="submit" class="elgg-button elgg-button-submit" value="'.elgg_echo("membersmap:search:submit").'">';
		$sidebar .= '</form>';
		$sidebar .= '</div>';
		$sidebar .= '</div>';
	}

	$sidebar .= '<script>';
	$sidebar .= ' $.fn.hide = function() { return this; };';
	$sidebar .= ' $(function() {';
	$sidebar .= '  $(\'input, textarea\').placeholder();';
	$sidebar .= ' });';
	$sidebar .= '</script>';

	echo $sidebar;
}
else
{
	register_error(elgg_echo("membersmap:settings:kanelggamapsapi:notenabled"));
	forward(REFERER);
}	
