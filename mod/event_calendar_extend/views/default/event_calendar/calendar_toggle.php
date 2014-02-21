<?php
$event=$vars['event_calendar_event'];
$user=$vars['entity'];
$container = get_entity($event->container_guid);
//echo"<h2>DUMP \$VARS::</h2><hr><pre>";//:DC:
//echo"<hr>";
//var_dump($event->container_guid);
//echo"<hr>";
//var_dump($event->owner);
//echo"print_r(\$VARS)::<hr>";
//print_r($event);
//print_r($vars);
//echo"</pre><hr>";
//echo"<h2>AFTER \$container = get_entity CONTAINER	(",$event->container_guid	,")::</h2><hr>";
//echo"<h2>AFTER \$container = get_entity OWNER		(",$event->owner_guid		,")::</h2><hr>";
//:DC:
if (event_calendar_has_personal_event($event->guid, $user->guid))
{
	$label = elgg_echo('event_calendar:remove_from_the_calendar_button');
}
else
{
	$label = elgg_echo('event_calendar:add_to_the_calendar');
}
if($container)
{
if($container->canEdit())
{
	$button = elgg_view('input/button',array(
	'id'=>'event_calendar_user_data_'.$event->guid.'_'.$user->guid,
	'class' => "event-calendar-personal-calendar-toggle",
	'value' => $label,
	));
	echo 
		'<div class="event-calendar-personal-calendar-toggle-wrapper">'
		.'<hr>'
	//	.'	HERE?	'
		.'<hr>'
		.$button
		.'<div>'
	;
}
}
?>