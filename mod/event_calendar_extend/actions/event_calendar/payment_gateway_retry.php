<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//EPAY GATEWAY
////////////////////////////////////////////////////////////////////////////////////////////////////
elgg_load_library('elgg:event_calendar');
//$event_guid = get_input('guid',0);
$ticket_guid = get_input('order_guid',0);
$user_guid = elgg_get_logged_in_user_guid();
//$event = get_entity($event_guid);
$ticket_order = get_entity($ticket_guid);
////////////////////////////////////////////////////////////////////////////////////////////////////

			////////////////////////////////////////////////////////////////////////////////////////////////////
			if($ticket_order->total!=0)
			{										//:DC: e-pay gateway if > $0
				////////////////////////////////////////////////////////////////////////////////////////////////////
				//$merchantnumber = elgg_get_plugin_setting('merchantnumber', 'event_calendar');
				$merchantnumber = elgg_get_plugin_setting('merchantnumber', 'event_calendar');
				$amount = $ticket_order->total*100;
				$currency = elgg_get_plugin_setting('currency', 'event_calendar');
				$windowstate = 3;
				
				$secret = elgg_get_plugin_setting('md5secret', 'event_calendar');
				////////////////////////////////////////////////////////////////////////////////////////////////////
				$url = 'https://ssl.ditonlinebetalingssystem.dk/integration/ewindow/Default.aspx';
				$params = array
				(
	/*************************************************************************************
	::	PHP GUIDE EPAY RELAY-SCRIPT	::
	1st pg relay.php          setup payment form thru relay-script w/ std set test parms
	2nd pg accept.php         setup payment receipt page w/info of payment made
	3rd pg callback.php       called by ePay when payment made; Tip! Change $email var @callback.php-> receive email @payment made
	*************************************************************************************/
				'merchantnumber' => $merchantnumber,									//
				'amount' => $amount,							
				'currency' => $currency,												//
				'orderid' => $ticket_order->getGUID(),									//
				//http://test.klubhjemmeside.dk/event_calendar/payment/accept?			//
				'accepturl'   => elgg_get_site_url() .'event_calendar/payment/accept',	//		
				'callbackurl' => elgg_get_site_url() .'event_calendar/payment/callback',//		
				'cancelurl'   => elgg_get_site_url() .'event_calendar/payment/decline',	//		
				'description' => 'Order'												//
				);
				////////////////////////////////////////////////////////////////////////////////////////////////////
				//$params['hash'] = md5(implode("", array_values($params)) . $secret);
				//$query = http_build_query($params) . "\n";
				//add_entity_relationship($user_guid, $ticket_order->getGUID(), $event_guid);
				//forward($url . '?' . $query);
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
                
                $query = http_build_query($formKeyValues) . "\n";
                forward($dibsPostUrl . '?' . $query);

			}//if(&&$order_total!=0)

//forward(REFERER);
?>