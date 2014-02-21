<?php
/**
* Elgg event calendar widget
*
* @package event_calendar
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
* @author Kevin Jardine <kevin@radagast.biz>
* @copyright Radagast Solutions 2008
* @link http://radagast.biz/
*
*/
// Load event calendar model
elgg_load_library('elgg:event_calendar');
//the number of events to display
$NumWidgetEvents = (int) $vars['entity']->num_display;
if (!$NumWidgetEvents)
	$NumWidgetEvents = 5;
// Get the events
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
//echo "<div><pre>";echo"** EvtCAL-Widget **";
//echo "<br>Contxt=:> ",elgg_get_context(),"";
//echo "<br>Owner =:> ",elgg_get_page_owner_guid(),"";
//echo "<br>Logged=:> ",elgg_get_logged_in_user_guid(),"";
//echo "<br>MaxEvt=:> ",$NumWidgetEvents,"";
$CurrOwner=elgg_get_page_owner_guid();
if($CurrOwner!=1)
	;//echo "<br>::USER::";
if($CurrOwner==1)
	;//echo "<br>::INDX::";
//echo "</pre></div>";
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
if($CurrOwner!=1)		//:DC:Widget@User DashBoard
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
{
	$events = event_calendar_get_personal_events_for_user(
		$CurrOwner,
		$NumWidgetEvents
	);
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
	// Display events for User DashBoard
	if (is_array($events) && sizeof($events) > 0) {
		echo "<div id=\"widget_calendar\">";
		foreach($events as $event)
		{
			echo elgg_view("object/event_calendar",array('entity' => $event));
		}
		echo "</div>";
	}
}
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
else
if($CurrOwner==1)		//:DC:Widget@IndexPage
{
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
	//$start_date = 0;
	//set_input('EVTCAL_WidgetMode','Y');
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
	echo "<div id=\"widget_calendar\">";

	//	````````````````````````````````````````````````````````````````````````````````
/**	function event_calendar_get_events_between(
	$start_date,
	$end_date,
	$is_count,
	$limit=10,
	$offset=0,
	$container_guid=0,
	$region='-',
	$order_by=''
	)
	//latest created date
	//latest upcoming event date
	if ($order_by == "") $order_by = "e.time_created desc";
	if ($order_by == "") $order_by = "v.string asc";
**/
	$Sort='v.string asc';		//
	$Sort='e.time_created desc';//
	//							//event dates
	$TSstt=time();				//@ now
	$TSend=time()+(365*86400);	//+1 year
		$count  = event_calendar_get_events_between(
			$TSstt,$TSend,true, $NumWidgetEvents, 0, 0, '-',$order_by=$Sort);
		$events = event_calendar_get_events_between(
			$TSstt,$TSend,false,$NumWidgetEvents, 0, 0, '-',$order_by=$Sort);

//````````````````````````````````````````
//			..._standard/	content.php
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
	// Display events for Index Page
	if (is_array($events) && sizeof($events) > 0) {
		echo "<div id=\"widget_calendar\">";
		foreach($events as $event)
		{
			echo elgg_view("object/event_calendar",array('entity' => $event));
			echo '<span style="
				display:block;margin-top:-5px;border:dotted blue 0px;
				width:200px;font-size:75%;text-align:right;
				"> '.elgg_echo('event_calendar:widget_created')
				.strftime('%d/%m/%Y',$event->time_created).'</span>';
		}
		echo "</div>";
	}
//:DC:	:END:
//````````````````````````````````````````

	echo "</div>";
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
}
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
?>