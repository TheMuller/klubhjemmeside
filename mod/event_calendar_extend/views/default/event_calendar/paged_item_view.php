<?php
$event = $vars['event'];
$time_bit = '';
if (is_numeric($event->start_time)) {
	$time_bit = event_calendar_convert_time($event->start_time);
}
$date_bit = event_calendar_get_formatted_date($event->start_date);
if (event_calendar_has_personal_event($event->guid,elgg_get_logged_in_user_guid())) {
	$calendar_bit = 'checked = "checked"';
} else {
	$calendar_bit = '';
}
$info = '<tr>';
$info .=
	'<td class="event_calendar_paged_date">'
		.$date_bit
		//.'<br>TS='.$event->end_date
		.'<br>ends: <span style="font-size:75%;">'.strftime('%d/%m',$event->end_date).'</span>'
	//	.'<br>'.strftime('%d/%m/%Y',$event->start_date).''
	.'</td>'
	;
$info .= '<td class="event_calendar_paged_time">'.$time_bit.'</td>';
$soldouttext = elgg_echo('event_calendar:ticket:soldout')."&nbsp;";
for($i = 1; $i <=5; $i++)				//:DC:
{
    $spots_var = 'ticket_option_spots_' . $i;
    $ticket_spots = $event->$spots_var;
    if($ticket_spots >0){$soldouttext='';break;}
}

    
$info .= '<td class="event_calendar_paged_title"><a href="'.$event->getUrl().'">'.$soldouttext.$event->title.'</a></td>';
$info .= '<td class="event_calendar_paged_venue">'.$event->venue.'</td>';
/**
if ($vars['personal_manage']!='no'){
	$info .= '<td class="event_calendar_paged_calendar">
	<input class="event_calendar_paged_checkbox" id="event_calendar_paged_checkbox_'
	.$event->guid.'" '.$calendar_bit.' type="checkbox" /></td>'
	;
}
**/
$info .= '</tr>';
echo $info;
?>