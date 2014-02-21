<?php

echo '<br>';
echo '<h3>' . elgg_echo('event_calendar_ical:import:settings') . '</h3>';
echo '<br>';


// export which calendar
echo elgg_echo('event_calendar_ical:import:type') . ' ';

$options_values = array();

if (event_calendar_can_add()) {
  $options_values[0] = elgg_echo('event_calendar_ical:site');
}


$groups = elgg_get_logged_in_user_entity()->getGroups('', false);
  
if ($groups) {
  foreach ($groups as $group) {
	if (event_calendar_can_add($group->guid)) {
	  $options_values[$group->guid] = elgg_echo('group') . ': ' . $group->name;
    }
  }
}


echo elgg_view('input/dropdown', array(
	'name' => 'container_guid',
	'value' => $vars['group_guid'],
	'options_values' => $options_values
));


echo '<br><br>';

echo elgg_echo('event_calendar_ical:file:upload') . '<br>';
echo elgg_view('input/file', array('name' => 'ical_file'));

echo '<br><br>';

echo elgg_echo('event_calendar_ical:import:access') . ' ';
echo elgg_view('input/access', array('name' => 'access_id'));

echo '<br><br>';

echo elgg_view('input/submit', array('value' => elgg_echo('event_calendar_ical:import')));
