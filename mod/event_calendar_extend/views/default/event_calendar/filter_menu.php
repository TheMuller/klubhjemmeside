<?php
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
//	X @ FILTER_MENU.PHP
// generate a list of filter tabs
$group_guid = $vars['group_guid'];
$filter_context = $vars['filter'];
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
$url_start_EVTCAL="event_calendar";
if ($group_guid)
	$url_start_EVTCAL.='/'.$group_guid;
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌	//:DC: ++PAST EVENTS	▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
if ($group_guid)
{
	$url_start = "event_calendar/group/{$group_guid}/{$vars['start_date']}/{$vars['mode']}";
} else {
	$url_start = "event_calendar/list/{$vars['start_date']}/{$vars['mode']}";
}
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
$url_start=str_replace('//','/',$url_start);
$url_start=str_replace('all/all','all',$url_start);
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
$tabs = array(
	'all' => array(
		'text' => elgg_echo('event_calendar:show_all'),
		'href' => "$url_start/all",
		'selected' => ($filter_context == 'all'),
		'priority' => 200,	),
	'mine' => array(
		'text' => elgg_echo('event_calendar:show_mine'),
		'href' => "$url_start/mine",
		'selected' => ($filter_context == 'mine'),
		'priority' => 300,	),
	'friend' => array(
		'text' => elgg_echo('event_calendar:show_friends'),
		'href' =>  "$url_start/friends",
		'selected' => ($filter_context == 'friends'),
		'priority' => 400,	),
//````````````````````````````````````````
//			..._extend/	filter_menu.php
//:DC:	language texts!
	'past' => array(				//:DC:	▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌		
		'text' => elgg_echo('event_calendar:show_past'),	
		'href' =>  "$url_start_EVTCAL/pastevents",
		'selected' => ($filter_context == 'pastevents'),
		'priority' => 500,	),		//:DC:	▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
);
//:DC:	:END:
//````````````````````````````````````````

//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
//$tab_rendered = array();
/**
$event_calendar_spots_display = elgg_get_plugin_setting('spots_display','event_calendar');
if($event_calendar_spots_display == "yes"){
	$tabs['open'] = array(
		'text' => elgg_echo('event_calendar:show_open'),
		'href' => "$url_start/open",'selected' => ($filter_context == 'open'),'priority' => 100,	);
}else{
	$tab_rendered['open'] = '';
}
**/
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
foreach ($tabs as $name => $tab) {
	if ($tab['selected']) {
		$state_selected = ' class="elgg-state-selected"';
	} else {
		$state_selected = '';
	}
	$tab_rendered[$name] = '<li'.$state_selected.'><a href="'.elgg_normalize_url($tab['href']).'">'.$tab['text'].'</a></li>';
	elgg_register_menu_item('filter', $tab);
}
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
//echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));

//$text_bit = '<li class="event-calendar-filter-menu-show-only">'.elgg_echo('event_calendar:show_only').'</li>';
//$text_bit
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
//	{$tab_rendered['open']}
$menu = <<<__MENU
<ul class="elgg-menu elgg-menu-filter elgg-menu-hz elgg-menu-filter-default">
	{$tab_rendered['all']}
	{$tab_rendered['mine']}
	{$tab_rendered['friend']}
	{$tab_rendered['past']}
</ul>
__MENU;
echo $menu;
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
$event_calendar_region_display = elgg_get_plugin_setting('region_display', 'event_calendar');
if ($event_calendar_region_display == 'yes') {
	elgg_load_js("elgg.event_calendar");
	$url_start .= "/$filter_context";
	echo elgg_view('event_calendar/region_select',array('url_start'=>$url_start,'region'=>$vars['region']));
}
//▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
?>