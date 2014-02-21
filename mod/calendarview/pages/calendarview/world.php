<?php
/**
 * @package ElggCalendarView
 * Show all calendar 
 */

elgg_load_library('elgg:calendarview');
elgg_load_library('elgg:event_calendar');

global $CONFIG;
if (!isset($CONFIG)) {
	$CONFIG = new stdClass;
}

// set the default timezone to use
date_default_timezone_set('UTC');

// Get navigation variables
$date = get_input('date');
$year = get_input('year');
$month = get_input('month');
// if year is empty, set year to current year:
if($year == '') $year = date('Y');
// if month is empty, set month to current month:
if($month == '') $month = date('n');

// set breadcrumb
elgg_push_breadcrumb(elgg_echo('calendarview'));
// set title
$title = elgg_echo('calendarview:all');

if (elgg_is_logged_in()) { 
// insert add event button
    elgg_register_menu_item('title', array(
            'name' => 'add',
            'text' => elgg_echo('event_calendar:add'),
            'href' => "event_calendar/add",
            'link_class' => 'elgg-button elgg-button-action',
    ));
}

// build navigation form
$content = '<div id="nav">';
$content .= '<form action="'.$CONFIG->url.'calendarview/all/'.'" method="post">';
$content .= '<input class="cal" type="text" name="year" size="4" maxlength="4" value="'.$year.'">';
$content .= '<select class="cal" name="month">';
// build selection (months):
$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
for($i = 1; $i <= 12; $i++) {
  $content .= '<option value="' . $i . '"';
  if($i == $month) $content .= ' selected';
  $content .= '>' . $months[$i-1] . "</option>\n";
}
$content .= '</select>';
$content .= '<input class="cal" type="submit" value="'.elgg_echo('calendarview:go').'">';
$content .= '</form>';
$content .= '</div>';
// build navigation form end

// start calendar
$offset = 1;  // start with Sunday  
$cal = new CALENDAR($year, $month);
$cal->offset = $offset;
$cal->weekNumbers = $weeks;
$cal->tFontSize = 20;
$cal->hFontSize = 14;
$cal->dFontSize = 13;

// load list of events with start date and end date
$options1 = array(
        'type' => 'object',
        'subtype' => 'event_calendar',
        'limit' => 0,
         'metadata_name_value_pairs' => array(
            array('name' => 'end_date',
               'value' => mktime(0, 0, 0, $month, 1, $year),
               'operand' => '>='), 
            array('name' => 'start_date',
               'value' => mktime(0, 0, 0, $month, date('t', mktime(0, 0, 0, $month, 1, $year)), $year),
               'operand' => '<='),             
        ),
        'metadata_name_value_pairs_operator' => 'AND',
);
$eventlist1 = elgg_get_entities_from_metadata($options1);

// load list of events with only start date
$options2 = array(
        'type' => 'object',
        'subtype' => 'event_calendar',
        'limit' => 0,
         'metadata_name_value_pairs' => array(
            array('name' => 'start_date',
               'value' => mktime(0, 0, 0, $month, 1, $year),
               'operand' => '>='), 
            array('name' => 'start_date',
               'value' => mktime(0, 0, 0, $month, date('t', mktime(0, 0, 0, $month, 1, $year)), $year),
               'operand' => '<='),    
            array('name' => 'end_date',
               'value' => '',
               'operand' => '='),                 
        ),
        'metadata_name_value_pairs_operator' => 'AND',
);
$eventlist2 = elgg_get_entities_from_metadata($options2);

// merge events
$all_entities = array_merge($eventlist1, $eventlist2);
        
foreach ($all_entities as $v) {
    $event = get_entity($v['guid']);
    
    // get start and end day
    $edaystart = date('j', $event->start_date);
    $edayend = date('j', $event->end_date);
    
    // check if only start day
    if (empty($edayend)) $edayend = $edaystart; 
    
    // bakalia.... add one day to events start and end to show right dates
    //$edaystart = $edaystart +1;
    //$edayend = $edayend +1; 
    
    // check if start day belongs to previous month and if yes set it to 1
    if ($event->start_date < mktime(0, 0, 0, $month, 1, $year)) $edaystart = 1 ;
    
    // check if end day belongs to next month and if yes set it to last day of month
    if ($event->end_date > mktime(0, 0, 0, $month, date('t', mktime(0, 0, 0, $month, 1, $year)), $year)) $edayend = date('t', mktime(0, 0, 0, $month, 1, $year)) ;
    
    //build site url
    $elink = $CONFIG->url.'event_calendar/view/'.$v['guid'];
    
    //build on mouse over message
    $omo = '';
    if (!empty($event->start_time)) $omo .= elgg_echo('calendarview:starttime').': '.$event->start_time;
    if (!empty($event->venue)) {
        if (empty($omo)) $omo .= elgg_echo('calendarview:venue').': '.$event->venue;
        else $omo .= ', '.elgg_echo('calendarview:venue').': '.$event->venue;
    }
    if (empty($omo)) $omo = $event->title;
   
    // add to calendar
    $cal->viewEvent($edaystart, $edayend, "#f4f9fd", $event->title, $elink, $omo);
}

$content .= '<br/>';
$content .= $cal->create();

$sidebar = '';

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
));

echo elgg_view_page($title, $body);
