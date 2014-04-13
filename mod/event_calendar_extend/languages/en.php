<?php

	$english = array(

//view all order
    'event_calendar:orderid' => 'OrderID',
    'event_calendar:eventtitle' => 'Event',
    'event_calendar:attendee' => 'Attendee',
    'event_calendar:amount' => 'Amount',
    'awaitingapproval' =>'Awaiting Approval',
    'event_calendar:pagelimit' => 'Records per page',
	'event_calendar:status' => 'Status',
//````````````````````````````````````````
//			..._extend/	en.php
//:DC:	language texts!
	'event_calendar:ticketsmax' => 'You have bought tickets to the Max. Limit, You cannot buy more !',
	'event_calendar:widget_created' => "Created on: ",
	'event_calendar:prev_to' => "Previous Ticket Orders: ",
	'event_calendar:prev_to_1' => 'Ticket Order: ',
	'event_calendar:ticket:list' => 'Select Tickets to Order',
	'event_calendar:cancel_ticket' => 'Cancel',
	'event_calendar:cancel_ticket_title' => 'Cancel all your tickets on this Order (Type ',
	'event_calendar:show_past' => 'Past Events ',
    'event_calendar:show_upcoming' => 'Upcoming Events ',
    'event_calendar:show_regular' => 'Regular Events ',
	'event_calendar:listing_title:all' => "All events",
	'event_calendar:listing_title:open' => "Open events",
	'event_calendar:listing_title:mine' => "My calendar",
	'event_calendar:listing_title:friends' => "Friends' calendars",
    'event_calendar:listing_title:upcoming' => "Upcoming events",
    'event_calendar:listing_title:regular' => "Regular events",
    'event_calendar:ticket:reorder' => 'Continue',
//:DC:	:END:
//`

	'event_calendar:make_request_title:payment' => 'Pay <b>%s %s</b> for this event',
	'event_calendar:request:awaiting_approval' => 'Awaiting approval',
	'event_calendar:request:closedfuture'=> 'Closed for future requests',
	'event_calendar:excel' => 'Download as excel spreadsheet',
	'event_calendar:settings:payment:merchantnumber' => 'ePay mechant number',
	'event_calendar:settings:payment:md5secret' => 'MD5 secret key',
	
	'event_calendar:payment:accepted' => 'Payment accepted!',
    'event_calendar:payment:accepted_detail' => '<p>Your payment was accepted</p><p><b>Order Ref: </b>%s</p><p><b>Transaction ID: </b> %s </p>',
                     
	'event_calendar:payment:declined' => 'Payment declined!',
	'event_calendar:payment:declined_detail' => 'Sorry, the payment was not accepted',		
	
	'event_calendar:settings:currency:title' => "Currency for fees to be shown in (eg. USD, DKK, GBP..)",
		
	'event_calendar:personal_manage:closedfuture_no_list'=> 'closed for future (delete waiting list)',
	'event_calendar:personal_manage:closedfuture_keep_list'=> 'closed for future (keep waiting list)',
	
	'event_calendar:returnto' => 'Return to event',
	
	
	'event_calendar:denied:subject' => 'Sorry, the event you you requested is now closed for futher requests',
	'event_calendar:denied:message' => 'The event "%s" has now closed for further requests.',
	
	'event_calendar:event:status' => 'Event status',
	'event_calendar:event:status:closed' => 'closed',
	'event_calendar:event:status:closedfuture_keep_list' => 'Closed for future requests',
	'event_calendar:event:status:closedfuture_no_list' => 'Closed for future requests',
	'event_calendar:event:status:open' => 'open',
	'event_calendar:event:status:private' => 'private',
	
    'event_calendar:ticket:usertotalspot' =>'Tickets You already bought:',
    'event_calendar:ticket:usermaxspot' =>'Max. spots per user:',
    'event_calendar:ticket:usertotalleft' =>' Max. spots you can buy:',
    'event_calendar:ticket:usertotalconsumed' =>'You can not buy more',
	'event_calendar:ticket:type' => 'Type',
	'event_calendar:ticket:amount' => 'Cost (DKK)',
	'event_calendar:ticket:spots' => 'Spots',
	'event_calendar:ticket:spots:max' => 'Max. spots',
	'event_calendar:ticket:spots:sold' => 'Sold',
	'event_calendar:ticket:spots:left' => 'left',
	'event_calendar:ticket:spots:total' => 'Total',
	'event_calendar:ticket:list' => 'Select tickets',
	'event_calendar:ticket:buynow' => 'Buy now!',
	'event_calendar:ticket:problem' => 'There was a problem processing these tickets. Please try again.',
	'event_calendar:ticket:soldout' => ' <b>Sold out!</b>',
	'event_calendar:tickets:allsoldout' => 'All tickets sold',
	'event_calendar:ticket:notfree' => 'This event is not free, you have to choose one of the tickets for sale.',
	'event_calendar:ticket:free:closed:success' => 'Success! Your free order now has to be accepted, you will recieve a confirmation message soon',
	'event_calendar:ticket:free:open:success' => 'Success! Your free order has been accepted!',
	'event_calendar:make_request_title:free' => 'This event is free - request a ticket',
	
	'awaitingpayment' => 'Awaiting Payment',
	'processing' => 'Processing',
	'accepted' => 'Accepted',
	
	'event_calendar:doublecheck' => 'Are you sure?',
	'event_calendar:review_order_menu_title' => 'See orders',
	
	'event_calendar:view_orders' => 'Orders placed for %s',
    'event_calendar:view_all_orders' => 'All Orders',
	'event_calendar:order:created:subject' => 'Order confirmation: Your order for the activity \'%s\' has been registered.',
	'event_calendar:order:created:message' => 'We hereby confirm to have recieved your ticketorder for <b>%s</b>
<p>Order id: %s</p>
<p>Transfer id: %s</p>
<p>Employee ID: %s</p>
<p>Date: %s</p>
<p>Venue: %s</p>

<p><b>The ticket(-s) contain</b></p>  %s
<p>Total: %s</p>',

	'event_calendar:order:accepted:subject' => 'Ticket confirmation: Your ticketorder for \'%s\' has been accepted.',
	'event_calendar:order:accepted:message' => 'We confirm that the tickets for <b>%s</b> are reserved for you
<p>Order id: %s</p>
<p>Transfer id: %s</p>
<p>Employee ID: %s</p>
<p>Date: %s</p>
<p>Venue: %s</p>

<p><b>The ticket(s) contain</b></p>  %s
<p>Total: %s</p>',

	'event_calendar:order:declined:subject' => 'Your order for \'%s\' has been declined.',
	'event_calendar:order:declined:message' => 'The order your placed for <b>%s</b> with order id %s has been declined. Your payment will be canceled, and all your credit card infos will be deleted. ',

	'event_calendar:order:free:created:subject' => 'Order confirmation: Your order for the activity \'%s\' has been registered.',
	'event_calendar:order:free:created:message' => '<p>We hereby confirm to have recieved your ticketorder (%s) for <b>%s</b>.</p> <br/>',

	'event_calendar:attendees:export:header' => "OrderID \t Name \t Username \t Email \t Phone\t",

	);
					
	add_translation("en",$english);

?>