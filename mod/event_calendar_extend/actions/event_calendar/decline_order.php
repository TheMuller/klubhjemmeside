<?php
////////////////////////////////////////////////////////////////////////////////
//mod/event_calendar_extend/actions/event_calendar/decline_order.php
////////////////////////////////////////////////////////////////////////////////
elgg_load_library('elgg:event_calendar');
$event_guid = get_input('event_guid',0);
$order_guid = get_input('order_guid',0);
$event = get_entity($event_guid);
$order = get_entity($order_guid);
////////////////////////////////////////////////////////////////////////////////
//Change the users order status to decline
$order->status = 'declined';
	//increase spots
	for($i = 1; $i <=5; $i++)
		{
			$spots_var = 'ticket_spots_' . $i;
			$ticket_spots = $order->$spots_var;
			if($ticket_spots)
				{
					event_calendar_increase_spots($event_guid, $i, $ticket_spots);
				}
		}
////////////////////////////////////////////////////////////////////////////////
if($event->save())
	{
		//``````````````````````````````````````````````````````````````````````````````
		//Remove Calendar entry
		if (elgg_instanceof($event,'object','event_calendar'))
			{
				$user_guid=$order->getOwnerGUID();
				event_calendar_remove_personal_event($event_guid,$user_guid);
				system_message(elgg_echo('event_calendar:remove_from_my_calendar_response'));
			}
		//``````````````````````````````````````````````````````````````````````````````
		//Send notification to user
		notify_user	($order->getOwnerGUID(),
			$event,
			elgg_echo('event_calendar:order:declined:subject', array(htmlspecialchars($event->title))),
			elgg_echo('event_calendar:order:declined:message', array(htmlspecialchars($event->title),htmlspecialchars($order->guid))),
			NULL,
			array('site', 'email')	
		);
		forward(REFERER);
	}
////////////////////////////////////////////////////////////////////////////////
?>