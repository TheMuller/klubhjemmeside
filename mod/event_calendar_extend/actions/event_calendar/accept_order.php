<?php
elgg_load_library('elgg:event_calendar');
$event_guid = get_input('event_guid',0);
$order_guid = get_input('order_guid',0);
$event = get_entity($event_guid);
$order = get_entity($order_guid);
//Change the users order status to decline
$order->status = 'accepted';
//add to users calendar
event_calendar_add_personal_event($event_guid,$order->getOwnerGUID());
$itemised = '';
	for($i = 1; $i <=5; $i++){		
		$type_var = 'ticket_type_' . $i;
		$amount_var = 'ticket_amount_' . $i;
		$spots_var = 'ticket_spots_' . $i;
		if($order->$type_var){
			$itemised.=
				'<p><b>'
				.$order->$type_var.'</b> (DKK'
				.number_format($order->$amount_var,2,',','.')
				.') x '
				.$order->$spots_var
				.' = DKK '
				.number_format($order->$amount_var,2,',','.')
				.'</p>';
		}
	}
$user = get_entity($order->getOwnerGUID());
//Send notification to user
if($event->save())
{
	notify_user(
		$order->getOwnerGUID(),
		$event,
		elgg_echo('event_calendar:order:accepted:subject',
		array(htmlspecialchars($event->title))),
		elgg_echo(
			'event_calendar:order:accepted:message',
			array(
				htmlspecialchars($event->title), 
				htmlspecialchars($order->guid),	
				htmlspecialchars($order->txnid),
				htmlspecialchars($user->username),
				date("d-m-Y", time()),
				htmlspecialchars($event->venue),
				$itemised,
				number_format($order->total,2,',','.')
				//	:DC: €URO AMT FMT
			)
		),
		NULL,
		array('site', 'email')	 
	);	
	forward(REFERER);
}
?>