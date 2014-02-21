<?php
function worldweatheronline_init() 
{
	// Register the required classes
	elgg_register_classes(elgg_get_plugins_path() . 'worldweatheronline/classes/');
	
	//Register the dashboard widget
	elgg_register_widget_type('worldweatheronline', elgg_echo("worldweatheronline:widget:name"), elgg_echo("worldweatheronline:widget:description"), 'profile,dashboard,groups,index', TRUE);
	
	//Register CSS
	elgg_register_css('worldweatheronline_css', 'mod/worldweatheronline/css/style.css');
}

elgg_register_event_handler('init', 'system', 'worldweatheronline_init');