<?php
	/***
	 * event_calendar_ical - ical import/export for event_calendar in Elgg
	 * Heavily based on the 1.7 plugin by Julien Crestin
	 * http://community.elgg.org/plugins/796431/0.5/ical-importexport-events
	 * 
	***/

 require_once 'lib/hooks.php';

function ec_ical_init() {
  // Register Libraries
  elgg_register_library('event_calendar_ical:utilities', elgg_get_plugins_path() . 'event_calendar_ical/vendors/iCalUtilityFunctions.class.php');
  elgg_register_library('event_calendar_ical:creator', elgg_get_plugins_path() . 'event_calendar_ical/vendors/iCalcreator.class.php');
  
  // Register actions
  elgg_register_action("event_calendar_ical/import", elgg_get_plugins_path() . "event_calendar_ical/actions/event_calendar_ical/import.php");
  elgg_register_action('event_calendar_ical/export', elgg_get_plugins_path() . "event_calendar_ical/actions/event_calendar_ical/export.php");
  
  elgg_register_plugin_hook_handler('register', 'menu:extras', 'ec_ical_extras_menu');
  elgg_register_plugin_hook_handler('register', 'menu:entity', 'ec_ical_entity_menu');
  elgg_register_plugin_hook_handler('route', 'event_calendar', 'ec_ical_event_calendar_router');
}

register_elgg_event_handler('init','system','ec_ical_init');
