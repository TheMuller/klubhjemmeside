<?php
/**
 * Elgg kanelggamapsapi plugin
 * @package KanelggaMapsApi 
 */

$plugin = elgg_get_plugin_from_id('kanelggamapsapi');

$potential_yesno = array(
    "no" => elgg_echo('kanelggamapsapi:settings:no'),
    "yes" => elgg_echo('kanelggamapsapi:settings:yes'),
); 

// enable global search map
$maponmenu = $plugin->maponmenu;
if(empty($maponmenu)){
        $maponmenu = 'no';
}    
$maponmenufield = elgg_view('input/dropdown', array('name' => 'params[maponmenu]', 'value' => $maponmenu, 'options_values' => $potential_yesno));
$maponmenufield .= "<span class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:maponmenu:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:maponmenu'), $maponmenufield);    

// entities selection for global map
if(elgg_is_active_plugin("membersmap") || elgg_is_active_plugin("groupsmap") || elgg_is_active_plugin("agora")){
	$gm_entities = '';
	if(elgg_is_active_plugin("membersmap")) {
		$gm_membersmap = $plugin->gm_membersmap;
		if(empty($gm_membersmap)){
				$gm_membersmap = 'yes';
		}    

		$gm_entities .= '<div style="display:block; width:100%; margin: 5px 0;">';
		$gm_entities .= "<span class=''><strong>" . elgg_echo('kanelggamapsapi:settings:membersmap') . "</strong>: </span>";
		$gm_entities .= elgg_view('input/dropdown', array('name' => 'params[gm_membersmap]', 'value' => $gm_membersmap, 'options_values' => $potential_yesno));
		$gm_entities .= "<span class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:membersmap:note') . "</span>";
		$gm_entities .= '</div>';
	}
	
	if(elgg_is_active_plugin("groupsmap")) {
		$gm_groupsmap = $plugin->gm_groupsmap;
		if(empty($gm_groupsmap)){
				$gm_groupsmap = 'yes';
		}    

		$gm_entities .= '<div style="display:block; width:100%; margin: 5px 0;">';
		$gm_entities .= "<span class=''><strong>" . elgg_echo('kanelggamapsapi:settings:groupsmap') . "</strong>: </span>";
		$gm_entities .= elgg_view('input/dropdown', array('name' => 'params[gm_groupsmap]', 'value' => $gm_groupsmap, 'options_values' => $potential_yesno));
		$gm_entities .= "<span class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:groupsmap:note') . "</span>";
		$gm_entities .= '</div>';
	}
	
	if(elgg_is_active_plugin("agora")) {
		$gm_agora = $plugin->gm_agora;
		if(empty($gm_agora)){
				$gm_agora = 'yes';
		}    

		$gm_entities .= '<div style="display:block; width:100%; margin: 5px 0;">';
		$gm_entities .= "<span class=''><strong>" . elgg_echo('kanelggamapsapi:settings:agora') . "</strong>: </span>";
		$gm_entities .= elgg_view('input/dropdown', array('name' => 'params[gm_agora]', 'value' => $gm_agora, 'options_values' => $potential_yesno));
		$gm_entities .= "<span class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:agora:note') . "</span>";
		$gm_entities .= '</div>';
	}
	
	echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:entities'), $gm_entities);  
}
else
	echo '<div class="display:block; width:100%; margin: 5px 0;"><h4>' . elgg_echo('kanelggamapsapi:settings:entities:notenabled') . '</h4></div>';

// set if use map cluster or no
$gm_cluster = $plugin->gm_cluster;
if(empty($gm_cluster)){
        $gm_cluster = 'no';
}    
$potential_cluster = array(
    "no" => elgg_echo('kanelggamapsapi:settings:no'),
    "yes" => elgg_echo('kanelggamapsapi:settings:yes'),
); 

$clusterfield = elgg_view('input/dropdown', array('name' => 'params[gm_cluster]', 'value' => $gm_cluster, 'options_values' => $potential_cluster));
$clusterfield .= "<span class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:gm_cluster:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:gm_cluster'), $clusterfield);

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

