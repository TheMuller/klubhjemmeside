<?php
//EPAY GATEWAY

elgg_load_library('elgg:event_calendar');

$event_guid = get_input('guid',0);
$user_guid = elgg_get_logged_in_user_guid();
$event = get_entity($event_guid);
if (elgg_instanceof($event,'object','event_calendar')) {
	
		//@todo... listen out for tickets selected and the quantity. 
		//Work out the overrall ammount and put something in the description. 
		//Perhaps we should also log the ammount of tickets? 
		//If so, we should create an order object which stores this information. 

		//Thefore orderid would now be simply the guid of the new order object. 
		//the subtype should be ticket_order.

		$ticket_order = new ElggObject();
		$ticket_order->subtype = 'ticket_order';
		$ticket_order->title = 'Ticket Order: %s'; //grab in the guid later
		
		
		if($event->ticket_option_type_1 || $event->ticket_option_type_2 || $event->ticket_option_type_3 || $event->ticket_option_type_4 || $event->ticket_option_type_5){
			register_error(elgg_echo('event_calendar:ticket:notfree'));
		}
		
		//this is a free event
		$ticket_order->total = 0;
		$ticket_order->status = 'awaitingapproval';
		$ticket_order->event_guid = $event_guid;
		$guid = $ticket_order->save();
		if($guid){	
			
			if($event->personal_manage == 'closed'){
				//send them a message
				notify_user	($user_guid,
					$event,
					elgg_echo('event_calendar:order:free:created:subject', array(htmlspecialchars($event->title))),
					elgg_echo('event_calendar:order:free:created:message', array(htmlspecialchars($guid),htmlspecialchars($event->title), $itemised, )),
					NULL,
					array('site', 'email')	
				);
				
				system_message(elgg_echo('event_calendar:ticket:free:closed:success'));
				
			} elseif($event->personal_manage == 'open') {
				//Change the users order status to decline
				$ticket_order->status = 'accepted';
				
				//add to users calendar
				event_calendar_add_personal_event($event_guid,$user_guid);
				
					notify_user	($user_guid,
								$event,
								elgg_echo('event_calendar:order:accepted:subject', array(htmlspecialchars($event->title))),
								elgg_echo('event_calendar:order:accepted:message', array(htmlspecialchars($event->title),htmlspecialchars($guid))),
								NULL,
								array('site', 'email')	 
								);	
					
				
				system_message(elgg_echo('event_calendar:ticket:free:open:success'));
				
			}
	
			forward(REFERER);
	
		/*if (event_calendar_send_event_request($event,$user_guid)) {
			system_message(elgg_echo('event_calendar:payment:success'));
		} else {
			register_error(elgg_echo('event_calendar:payment:error'));
		}
		*/
		} else {
			register_error(elgg_echo('event_calendar:ticket:problem'));
		}
}

//forward(REFERER);
