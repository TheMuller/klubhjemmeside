<?php 
	
$plugin = $vars["entity"];


// add tab on elgg members page
$customtab = $plugin->customtab;
if(empty($customtab)){
        $customtab = 'yes';
}   
$potential_memberstab = array(
    "no" => elgg_echo('membersmap:settings:no'),
    "yes" => elgg_echo('membersmap:settings:yes'),
); 

$memberstabfield = elgg_view('input/dropdown', array('name' => 'params[customtab]', 'value' => $customtab, 'options_values' => $potential_memberstab));
$memberstabfield .= "<span class='elgg-subtext'>" . elgg_echo('membersmap:settings:memberstab:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('membersmap:settings:memberstab'), $memberstabfield);

// add menu item on elgg site menu
$maponmenu = $plugin->maponmenu;
if(empty($maponmenu)){
        $maponmenu = 'yes';
}    
$potential_maponmenu = array(
    "no" => elgg_echo('membersmap:settings:no'),
    "yes" => elgg_echo('membersmap:settings:yes'),
); 

$maponmenufield = elgg_view('input/dropdown', array('name' => 'params[maponmenu]', 'value' => $maponmenu, 'options_values' => $potential_maponmenu));
$maponmenufield .= "<span class='elgg-subtext'>" . elgg_echo('membersmap:settings:maponmenu:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('membersmap:settings:maponmenu'), $maponmenufield);

// set if show 'search by name' form
$searchbyname = $plugin->searchbyname;
if(empty($searchbyname)){
        $searchbyname = 'yes';
}    
$potential_searchbyname = array(
    "no" => elgg_echo('membersmap:settings:no'),
    "yes" => elgg_echo('membersmap:settings:yes'),
); 

$searchbynamefield = elgg_view('input/dropdown', array('name' => 'params[searchbyname]', 'value' => $searchbyname, 'options_values' => $potential_searchbyname));
$searchbynamefield .= "<span class='elgg-subtext'>" . elgg_echo('membersmap:settings:searchbyname:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('membersmap:settings:searchbyname'), $searchbynamefield);


// set default icon
$markericon = $plugin->markericon;
if(empty($markericon)){
        $markericon = 'smiley';
}    
$potential_icon = array(
    "blue-light" => elgg_echo('membersmap:settings:markericon:blue-light'),
    "blue" => elgg_echo('membersmap:settings:markericon:blue'),
    "green" => elgg_echo('membersmap:settings:markericon:green'),
    "grey" => elgg_echo('membersmap:settings:markericon:grey'),
    "orange" => elgg_echo('membersmap:settings:markericon:orange'),
    "pink" => elgg_echo('membersmap:settings:markericon:pink'),
    "purple-light" => elgg_echo('membersmap:settings:markericon:purple-light'),
    "purple" => elgg_echo('membersmap:settings:markericon:purple'),
    "red" => elgg_echo('membersmap:settings:markericon:red'),
    "yellow" => elgg_echo('membersmap:settings:markericon:yellow'),
); 

$map_icon = elgg_view('input/dropdown', array('name' => 'params[markericon]', 'value' => $markericon, 'options_values' => $potential_icon));
$map_icon .= "<span class='elgg-subtext'>" . elgg_echo('membersmap:settings:markericon:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('membersmap:settings:markericon'), $map_icon);


// batch convert geolocation	
$batchlink = elgg_view('output/url', array(
	'href' => "mod/membersmap/putusersonmap.php",
	'text' => elgg_echo('membersmap:settings:batchusers:start'),
	'class' => "elgg-button-action",
	'target' => "_blank",
	'style' => "padding: 3px;",
));
$batchlink .= "<div style='float:right;'>" . elgg_echo('membersmap:settings:batchusers:note') ."</div>";			
echo elgg_view_module("inline", elgg_echo('membersmap:settings:batchusers'),"<div class='elgg-text'>".$batchlink."</div>");
