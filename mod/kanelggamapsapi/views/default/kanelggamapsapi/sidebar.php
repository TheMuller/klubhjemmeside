<?php
/**
 * Search for content in this group
 *
 * @uses vars['entity'] ElggGroup
 */

if(elgg_is_active_plugin("kanelggamapsapi")){
	// load kanelgga maps api libraries
	elgg_load_library('elgg:kanelggamapsapi');  
	
	$indextable = $vars['indextable'];

	$sidebar = '';

	$sidebar .= '<div class="elgg-module  elgg-module-aside">';
	$sidebar .= '<div class="elgg-head"><h3>'.elgg_echo("kanelggamapsapi:search").'</h3></div>';
	$sidebar .= '<div class="elgg-body">';
	$sidebar .= '<input class="elgg-input-text elgg-autofocus" id="address" type="text" value="" placeholder="'.elgg_echo("kanelggamapsapi:search:location").'">';
	$sidebar .= '<input class="elgg-input-text" id="radius" type="text" value="" placeholder="'.get_unit_of_measurement_string('kanelggamapsapi').'">';
	$sidebar .= '<label class="mtm float-alt"><input id="showradius" type="checkbox" value="show" >'.elgg_echo("kanelggamapsapi:search:showradius").'</label><br />';
	$sidebar .= '<input type="submit" class="elgg-button elgg-button-submit" value="'.elgg_echo("kanelggamapsapi:search:submit").'" onclick="codeAddress()">';
	$sidebar .= '</div>';
	$sidebar .= '</div>';

	if ($user = elgg_get_logged_in_user_entity())   {
		if (!empty($user->location))    {
			$sidebar .= '<div class="elgg-module  elgg-module-aside">';
			$sidebar .= '<div class="elgg-head"><h3>'.elgg_echo("kanelggamapsapi:searchnearby").'</h3></div>';
			$sidebar .= '<div class="elgg-body">';
			$sidebar .= '<small>'.elgg_echo("kanelggamapsapi:mylocationsis").'<i>'.$user->location.'</i></small>';
			$sidebar .= '<input class="elgg-input-text" id="radiusmyloc" type="text" value="" placeholder="'.get_unit_of_measurement_string('kanelggamapsapi').'">';
			$sidebar .= '<label class="mtm float-alt"><input id="showradiusloc" type="checkbox" value="show" >'.elgg_echo("kanelggamapsapi:search:showradius").'</label>';
			$sidebar .= '<input type="submit" class="elgg-button elgg-button-submit" value="'.elgg_echo("kanelggamapsapi:search:submit").'" onclick="codeAddress(\''.$user->location.'\')">';
			$sidebar .= '</div>';
			$sidebar .= '</div>';
		}
	}
	
	if ($indextable)	{
		$sidebar .= '<div class="elgg-head"><h3>'.elgg_echo("kanelggamapsapi:showhideentities").'</h3></div>';
		$sidebar .= '<div class="elgg-body">';		
		$sidebar .= '<div class="elgg-module  elgg-module-aside">';
		$sidebar .= $indextable;
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
	register_error(elgg_echo("kanelggamapsapi:settings:kanelggamapsapi:notenabled"));
	forward(REFERER);
}	
