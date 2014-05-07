<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//EPAY GATEWAY
////////////////////////////////////////////////////////////////////////////////////////////////////
elgg_load_library('elgg:event_calendar');
$event_guid = get_input('guid',0);
$user_guid = elgg_get_logged_in_user_guid();
$event = get_entity($event_guid);
////////////////////////////////////////////////////////////////////////////////////////////////////
if (elgg_instanceof($event,'object','event_calendar'))
{
	//@todo... listen out for tickets selected and the quantity. Work out the overrall ammount and put something in the description. Perhaps we should also log the ammount of tickets? If so, we should create an order object which stores this information. 
	//thefore orderid would now be simply the guid of the new order object. the subtype should be ticket_order.
	$ticket_order = new ElggObject();
	$ticket_order->subtype = 'ticket_order';
	$ticket_order->access_id = 2;
	$ticket_order->title = 'Ticket Order: %s'; //grab in the guid later
	$order_total = 0;
	$free_tickets =0 ;
	for($i = 1; $i <=5; $i++)		//:DC:	EURO AMNT FMT		
	{								//1.234,75 | Total: 2.469,50
		$ticket_type = get_input('ticket_option_type_' . $i);
		$ticket_amount = get_input('ticket_option_amount_' . $i);
		if(!$ticket_amount||$ticket_amount==0)
			$free_tickets = 1 ;
		$ticket_spots = get_input('ticket_option_spots_' . $i);
		$ticket_subtotal = $ticket_amount * $ticket_spots;
		$type_var = 'ticket_type_' . $i;
		$amount_var = 'ticket_amount_' . $i;
		$spots_var = 'ticket_spots_' . $i;
		$subtotal_var = 'ticket_subtotal' . $i;
		if($ticket_spots)
		{
			$ticket_order->$type_var = $ticket_type;
			$ticket_order->$amount_var = $ticket_amount;
			$ticket_order->$spots_var = $ticket_spots;
			$ticket_order->$subtotal_var = $ticket_subtotal;
		}
		$order_total = $order_total + $ticket_subtotal;
	}//for($i = 1; $i <=5; $i++)
	////////////////////////////////////////////////////////////////////////////////////////////////////
	if( $free_tickets = 0 && ($order_total == 0 || !$order_total) )
	{
		register_error(elgg_echo('event_calendar:ticket:problem'));
		forward(REFERER);
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
	//if($order_total&&$order_total!=0)
	{
		////										//:DC: create ticket; even $0 <- free tickets
		$ticket_order->total = $order_total;
		$ticket_order->save();
		//add to users calendar
		add_entity_relationship($user_guid, $ticket_order->getGUID(), $event_guid);
		event_calendar_add_personal_event($event_guid,$user_guid);
		//``````````````````````````````````````````````````````````````````````````
		$ticket_order->status = 'awaitingpayment';
		//``````````````````````````````````````````````````````````````````````````
		if($order_total==0)							//:DC: force ticket order = accepted
			{										//:DC: and add user<->calendar
			$ticket_order->status = 'accepted';
			}										//:DC: force ticket order = accepted
		$ticket_order->event_guid = $event_guid;
		//``````````````````````````````````````````````````````````````````````````
		if($ticket_order->save())
		{
			////////////////////////////////////////////////////////////////////////////////////////////////////
			if($order_total!=0)
			{										//:DC: e-pay gateway if > $0
				////////////////////////////////////////////////////////////////////////////////////////////////////
				//$merchantnumber = elgg_get_plugin_setting('merchantnumber', 'event_calendar');
				$merchantnumber = elgg_get_plugin_setting('merchantnumber', 'event_calendar');
				$amount = $order_total*100;
				$currency = elgg_get_plugin_setting('currency', 'event_calendar');
				$windowstate = 3;
				$orderid = $event_guid . $user_guid;
				$secret = elgg_get_plugin_setting('md5secret', 'event_calendar');
				////////////////////////////////////////////////////////////////////////////////////////////////////
				//$url = 'https://ssl.ditonlinebetalingssystem.dk/integration/ewindow/Default.aspx';
                
				$params = array
				(
	/*************************************************************************************
	::	PHP GUIDE EPAY RELAY-SCRIPT	::
	1st pg relay.php          setup payment form thru relay-script w/ std set test parms
	2nd pg accept.php         setup payment receipt page w/info of payment made
	3rd pg callback.php       called by ePay when payment made; Tip! Change $email var @callback.php-> receive email @payment made
	*************************************************************************************/
				'merchantnumber' => $merchantnumber,									//
				'amount' => $amount,													//
				'currency' => $currency,												//
				'orderid' => $ticket_order->getGUID(),									//
				//http://test.klubhjemmeside.dk/event_calendar/payment/accept?			//
				'accepturl'   => elgg_get_site_url() .'event_calendar/payment/accept',	//		
				'callbackurl' => elgg_get_site_url() .'event_calendar/payment/callback',//		
				'cancelurl'   => elgg_get_site_url() .'event_calendar/payment/decline',	//		
				'description' => 'Order'												//
				);
				////////////////////////////////////////////////////////////////////////////////////////////////////
				$params['hash'] = md5(implode("", array_values($params)) . $secret);
				$query = http_build_query($params) . "\n";
				add_entity_relationship($user_guid, $ticket_order->getGUID(), $event_guid); 	
				//forward($url . '?' . $query); sachin
				////////////////////////////////////////////////////////////////////////////////////////////////////
                
                
                // Put the DIBS payment window URL here or your own test URL.
                $dibsPostUrl = 'https://sat1.dibspayment.com/dibspaymentwindow/entrypoint'; // Change this if you wan't to post to DIBS.
                $dibsPostUrl = elgg_get_site_url().'mod/event_calendar_extend/epayaccept.php';
                // Build an array holding the values which should be posted.
                $formKeyValues = array(
                                       // Put your merchant ID here.
                                       "merchant" => '90181861',
                                       // Put the amount here.
                                       "amount" => $amount,
                                       // Put the currency number here.
                                       "currency" => $currency,
                                       // Put an order ID here.
                                       "orderid" => $ticket_order->getGUID(),
                                       // Put an accept or return URL here. You should try to use a secure site (https).
                                       "acceptReturnUrl" => elgg_get_site_url() .'event_calendar/payment/accept',
                                       );
                $ecal_payment_mode = elgg_get_plugin_setting('ecal_payment_mode', 'event_calendar');
                if($ecal_payment_mode == '1'){ //local test
					$dibsPostUrl = elgg_get_site_url().'mod/event_calendar_extend/epayaccept.php';
				}else{
					$dibsPostUrl = 'https://sat1.dibspayment.com/dibspaymentwindow/entrypoint'; // Change this if you wan't to post to DIBS. 
					if($ecal_payment_mode == '2') $formKeyValues['test'] ="1";   //DIBS Test
					}
                $query = http_build_query($formKeyValues) . "\n";
                forward($dibsPostUrl . '?' . $query);

			}//if(&&$order_total!=0)
		////////////////////////////////////////////////////////////////////////////////////////////////////
		}//if($ticket_order->save())
		else
		{
			register_error(elgg_echo('event_calendar:ticket:problem'));
		}//else::if($ticket_order->save())
		////////////////////////////////////////////////////////////////////////////////////////////////////
	}//if($order_total == 0 || !$order_total)
}//if (elgg_instanceof($event,'object','event_calendar'))
//forward(REFERER);
////////////////////////////////////////////////////////////////////////////////////////////////////
?>