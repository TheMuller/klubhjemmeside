<?php
/**
* Elgg event_calendar object view
* 
* @package event_calendar
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
* @author Kevin Jardine <kevin@radagast.biz>
* @copyright Radagast Solutions 2008
* @link http://radagast.biz/
* 
**/
$event = $vars['entity'];
//:DC:
//print_r($event);
/**
$CREA=$event->time_created;
$TIME=time();
$TM24=time()-86400;
$DIFF=$TIME-$CREA;
$DIFH=$DIFF/86400;
echo"<pre><hr>";
echo
	 "TICKETS GUID#"	.$event->guid
	." OWNER:"	.$event->owner_guid
	." CONT:"	.$event->container_guid
	." <br>"
	." C:"		.$CREA
	." <br>"
	." @:"		.$TIME
	." <br>"
	." H:"		.$TM24
	." <br>"
	." D:"		.$DIFF
	." <br>"
	." H:"		.$DIFH
	;
echo"<hr>:EOF:EVENT</pre>";
**/
/**
	if order is too old ($DIFF>86400) =>
	'action/event_calendar/order/decline?order_guid='
		.$event->guid.'&event_guid=' . $event->event_guid,
**/
//:DC:
$full = elgg_extract('full_view', $vars, FALSE);
if ($full)
{
	$body = elgg_view('event_calendar/strapline',$vars);
	$event_items = event_calendar_get_formatted_full_items($event);
	$body .= '<br />';
	
	foreach($event_items as $item) {
		$value = $item->value;
		if (!empty($value)) {
				
			//This function controls the alternating class
			$even_odd = ( 'odd' != $even_odd ) ? 'odd' : 'even';
			$body .= "<p class=\"{$even_odd}\"><b>";
			$body .= $item->title.':</b> ';
			$body .= $item->value;
			$body .= "</p>";
		}
	}
	//closed|open status	-->	select_tickets ?	//:DC:	
	$body .= '<p><b>' . elgg_echo('event_calendar:event:status') . ':</b> ' 
		. elgg_echo('event_calendar:event:status:' . $event->personal_manage) . '</p>'; 
	////$body .= '<p><b>' . elgg_echo('event_calendar:ticket:list') . ': </b></p>';
	$body .= elgg_view_form('event_calendar/select_tickets', null,array('entity'=>$event));
	$metadata = elgg_view_menu('entity', array(
		'entity' => $event,
		'handler' => 'event_calendar',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
	
	$tags = elgg_view('output/tags', array('tags' => $event->tags));
	
	$params = array(
		'entity' => $event,
		'metadata' => $metadata,
		'tags' => $tags,
		'title' => false,
	);
	$list_body = elgg_view('object/elements/summary', $params);
	echo $list_body;
	echo $body;
	if ($event->long_description) {
		echo '<p>'.$event->long_description.'</p>';
	} else {
		echo '<p>'.$event->description.'</p>';
	}
	if (elgg_get_plugin_setting('add_to_group_calendar', 'event_calendar') == 'yes') {
		echo elgg_view('event_calendar/forms/add_to_group',array('event' => $event));
	}
}//if ($full)
else
{
	
	$icon = elgg_view_entity_icon(get_entity($event->owner_guid), 'small');
	
	$extras = array($time_bit);
	if ($event->description) {
		$extras[] = $event->description;
	}
	
	if ($event_calendar_venue_view = elgg_get_plugin_setting('venue_view', 'event_calendar') == 'yes') {
		$extras[] = $event->venue;
	}

	//list the tickets that have been bought - 
	//perhaps this should show up in a light box
	for($i=1;$i<=5;$i++)	//:DC: €URO AMT FMT
	{
		$type_var = 'ticket_type_' . $i;
		$amount_var = 'ticket_amount_' . $i;
		$spots_var = 'ticket_spots_' . $i;
		$subtotal_var = 'ticket_subtotal' . $i;
		$ticket_type = $event->$type_var;
		$ticket_amount = $event->$amount_var;
		$ticket_spots = $event->$spots_var;
		$ticket_subtotal = $event->$subtotal_var;
		if($ticket_spots)
		{
			$body.='<p><b>'.$ticket_type.':</b>&nbsp;';
			$body.=number_format($ticket_amount,2,',','.');		//:DC:
			$body.='&nbsp;x&nbsp;'
				.$ticket_spots
				.'&nbsp;=&nbsp;'
				//.$ticket_subtotal.'</p>'						//:DC:
				.number_format($ticket_subtotal,2,',','.')		//:DC:
				.' DKK'
				;
			$body.=elgg_view('input/hidden',array('name'=>$type_var,'value'=>$ticket_type));
			$body.=elgg_view('input/hidden',array('name'=>$amount_var,'value'=>$ticket_amount));
		}
	}//for($i=1;$i<=5;$i++)


	echo elgg_view_module('popup', str_replace('%s', $event->getGUID(),  $event->title), $body, array(
														'id' => 'info'.$event->guid,
														'class' => 'ticket_info hidden',
													));
	
	if(
		$event->status == 'processing'
	||	$event->status == 'awaitingpayment'
	||	$event->status == 'awaitingapproval'
	)
	{
        $menu_button1 = elgg_view('output/confirmlink',
                                  array(
                                        'class' => "elgg-icon elgg-icon-delete-alt",
                                        'href' => 'action/event_calendar/order/decline?order_guid='
                                        .$event->guid.'&event_guid=' . $event->event_guid,
                                        'confirm' => elgg_echo('event_calendar:request:remove:check'),
                                       // 'text' => elgg_echo('event_calendar:review_requests:reject'),
                                        'title' => elgg_echo('event_calendar:review_requests:reject:title'),
                                        ));
        if($event->status != 'awaitingpayment')
        $menu_button2 = elgg_view('output/url', array(
                                                      'text' => "",
                                                      'title' => elgg_echo('event_calendar:review_requests:accept:title'),
                                                      'href' => "action/event_calendar/order/accept"
                                                      ."?order_guid="
                                                      .$event->guid
                                                      ."&event_guid="
                                                      .$event->event_guid
                                                      ,
                                                      'class' => "elgg-icon elgg-icon-checkmark",
                                                      'is_action' => TRUE,
                                                      ));
		$menu.='';
		$menu.='<div style="border:dotted red 0px;width:40%;float:right;text-align:right;">&nbsp;&nbsp;';
		$user=elgg_get_logged_in_user_entity();
		$menu.='&nbsp;&nbsp;';
		//if(	$event->status == 'awaitingpayment')
		{
		//:DC: REJECT
        $menu.=$menu_button1;
		$menu.='&nbsp;&nbsp;';
		}//	if(	$event->status == 'awaitingpayment')
		//:DC: ACCEPT
		$menu.=$menu_button2;
		$menu.='</div>';
	}
	
	$tags = elgg_view('output/tags', array('tags' => $event->tags));
	$title =             elgg_view('output/url', array(
                                                       'href' => '#info'.$event->guid,
                                                       'rel' => 'popup',
                                                       'text' => str_replace('%s', $event->getGUID(),  $event->title)
                                                       ));

    if(elgg_extract('table_view', $vars, FALSE)){
        $owner = get_entity($event->owner_guid);
        $tiny_icon = elgg_view_entity_icon($owner, 'tiny');
        $the_event = get_entity($event->event_guid);  //sachin it seems $event it actually a order ;)
        
       // echo "<div style='display: table-row;clear:both;'>";
        $text1 = "border:1px solid;display: table-cell;vertical-align:middle;text-align:center'>";
        echo "<div style='width:150px;".$text1.$title."</div>";
        if ($the_event InstanceOf ElggEntity){
        echo "<div style='width:200px;".$text1."<a href='".$the_event->getURL()."'>".$the_event->title."</a></div>";}
        else{echo "<div style='width:200px;".$text1."</div>";}
        echo "<div style='width:140px;".$text1.$tiny_icon.$owner->name."</div>";
        echo "<div style='width:100px;".$text1.number_format($event->total,2,',','.')."</div>";
        echo "<div style='width:130px;".$text1.elgg_echo($event->status).$menu_button1.$menu_button2."</div>";
       // echo "</div>";
    }else{
    $user = elgg_get_entities_from_relationship(array('relationship' => $event->guid, 'relationship_guid' => $event->event_guid,'inverse_relationship' => TRUE,));
	$params = array(
			'entity' => $event,
			'title' => $title."<br>".$user[0]->name ,
			'subtitle' => '<b>DKK:</b> ' 
		//		Ticket Order: 67 (TITLE-LINK)
		//		DKK: 123,40 | 11 hours ago | Awaiting Payment 
			.number_format($event->total,2,',','.')		//:DC:
			//	.$event->total 
				. ' | ' . elgg_get_friendly_time($event->time_created) 
				. ' | ' . elgg_echo($event->status) . $menu,
		);
	$list_body = elgg_view('object/elements/summary', $params);
	
	echo elgg_view_image_block($icon, $list_body);
    }
    
}//ELSE::if ($full)



?>