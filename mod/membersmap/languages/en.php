<?php
/**
 * Elgg membersmap plugin language pack
 * @package MembersMap
 */

$language = array(

    //Menu items and titles
    'membersmap' => "Map of Members",
    'membersmap:menu' => "Map of Members",
    'membersmap:all' => "Map of Members",
    'membersmap:allmembers' => "All Members",
    'membersmap:membersof' => "Members of %s",
    'membersmap:map' => "Map",
    
    //tabs
    'membersmap:label:all' => "All Members",
    'membersmap:label:friends' => "My Friends",
    'membersmap:label:online' => "Online Members",
    
    //search 
    'membersmap:search' => "Search members by location",
    'membersmap:search:location' => "location",
    'membersmap:search:radius' => "radius (meters)",
    'membersmap:search:radius:meters' => "radius (meters)",
    'membersmap:search:radius:km' => "radius (km)",
    'membersmap:search:radius:miles' => "radius (miles)",
    'membersmap:search:meters' => "meters",
    'membersmap:search:km' => "km",
    'membersmap:search:miles' => "miles",    
    'membersmap:search:showradius' => "Show search area",
    'membersmap:search:submit' => "Search",
    'membersmap:searchnearby' => "Search nearby members",
    'membersmap:mylocationsis' => "My location is: ",
    'membersmap:searchbyname' => "Search members by name",
    'membersmap:search:name' => "name",
    'membersmap:search:searchname' => "Member search for %s and nearby",
    'membersmap:search:usernotfound' => "Members not found",
    'membersmap:search:usersfound' => "Members found",
    'membersmap:search:around' => "Members nearby on members found",
 
    //groups
    'mambersmap:group' => "Group Members on Map",
    'mambersmap:group:none' => "No members on this group",
    'mambersmap:group:enablemaps' => "Enable Map of Members",
    
    //js alerts
    'membersmap:map:1' => "Please enter a valid default location on admin section",
    'membersmap:map:2' => "No valid search address",
    'membersmap:map:3' => "Geocode was not successful for the following reason",
    
    // settings
    'membersmap:settings:markericon' => 'Marker Icon', 
    'membersmap:settings:markericon:blue-light' => 'Blue light', 
    'membersmap:settings:markericon:blue' => 'Blue', 
    'membersmap:settings:markericon:green' => 'Green', 
    'membersmap:settings:markericon:grey' => 'Grey', 
    'membersmap:settings:markericon:orange' => 'Orange', 
    'membersmap:settings:markericon:pink' => 'Pink', 
    'membersmap:settings:markericon:purple-light' => 'Purple light', 
    'membersmap:settings:markericon:purple' => 'Purple', 
    'membersmap:settings:markericon:red' => 'Red', 
    'membersmap:settings:markericon:yellow' => 'Yellow', 
    'membersmap:settings:markericon:note' => 'Select the color of marker for members on map', 
    'membersmap:settings:searchbyname' => 'Search members by name', 
    'membersmap:settings:searchbyname:no' => 'No', 
    'membersmap:settings:searchbyname:yes' => 'Yes', 
    'membersmap:settings:searchbyname:note' => 'Select if display "Search members by name" form (sidebar). ',  
    'membersmap:settings:memberstab' => 'Add "Map of Members" tab on Elgg Members Page', 
    'membersmap:settings:memberstab:note' => 'Select if you want to add a "Map of Members" tab on Elgg Members Page (domain/members).<br /><strong>Important</strong>: You have to put Membersmap plugin after Members plugin in Administration/Configure/Plugins',    
    'membersmap:settings:maponmenu' => 'Add "Map of Members" item on site menu', 
    'membersmap:settings:maponmenu:note' => 'Select if you want to add a "Map of Members" item on site menu. ',      
    'membersmap:settings:no' => 'No', 
    'membersmap:settings:yes' => 'Yes',
    'membersmap:settings:batchusers' => 'Batch Users Geolocation',
    'membersmap:settings:batchusers:start' => 'Start Geolocation',
    'membersmap:settings:batchusers:note' => 'If you have already members on your Elgg site, click on this button for converting users location to coordinates.<br />You have to do it <strong>just once</strong> before you start using this plugin.',
    'membersmap:settings:kanelggamapsapi:notenabled' => 'Kanellga Maps Api is not enabled. Map of members cannot be displayed',
    
    // widget
    'membersmap:wg:title' => 'Location Map', 
    'membersmap:wg:detail' => 'Show your location on map', 
    'membersmap:zoom' => 'Zoom', 
);

add_translation("en", $language);
