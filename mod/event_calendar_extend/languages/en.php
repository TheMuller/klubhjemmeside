<?php

	$english = array(

//view all order
    'event_calendar:orderid' => 'OrderID',
    'event_calendar:eventtitle' => 'Event',
    'event_calendar:attendee' => 'Attendee',
    'event_calendar:amount' => 'Amount',
    'awaitingapproval' =>'Awaiting Approval',
    'event_calendar:pagelimit' => 'Events per page',
	'event_calendar:status' => 'Status',
//````````````````````````````````````````
//			..._extend/	en.php
//:DC:	language texts!
	'event_calendar:ticketsmax' => 'You have bought tickets to the Max. Limit. You cannot buy more!',
	'event_calendar:widget_created' => "Created on: ",
	'event_calendar:prev_to' => "Previous Ticket Orders: ",
	'event_calendar:prev_to_1' => 'Ticket Order: ',
	'event_calendar:ticket:list' => 'Select Tickets you want to buy',
	'event_calendar:cancel_ticket' => 'Cancel',
	'event_calendar:cancel_ticket_title' => 'Cancel all your tickets on this Order (Type ',
	'event_calendar:show_past' => 'Past Events ',
    'event_calendar:show_upcoming' => 'Events ',
    'event_calendar:show_regular' => 'Regular offers',
	'event_calendar:listing_title:all' => "All events",
	'event_calendar:listing_title:open' => "Free events",
	'event_calendar:listing_title:mine' => "My calendar",
	'event_calendar:listing_title:friends' => "Colleagues' calendars",
    'event_calendar:listing_title:upcoming' => "Upcoming events",
    'event_calendar:listing_title:regular' => "Regular offers",
    'event_calendar:ticket:reorder' => 'Continue payment',
//:DC:	:END:
//`

	'event_calendar:make_request_title:payment' => 'Pay <b>%s %s</b> for this event',
	'event_calendar:request:awaiting_approval' => 'Awaiting approval',
	'event_calendar:request:closedfuture'=> 'Closed for future requests',
	'event_calendar:excel' => 'Download as excel spreadsheet',
	'event_calendar:settings:payment:merchantnumber' => 'ePay mechant number',
	'event_calendar:settings:payment:md5secret' => 'MD5 secret key',
	
	'event_calendar:payment:accepted' => 'Your payment is accepted',
    'event_calendar:payment:accepted_detail' => '<p>Your payment was accepted</p><p><b>Order Ref: </b>%s</p><p><b>Transaction ID: </b> %s </p>',
	'event_calendar:payment:accepted:mailsent' => '<p>Your payment is accepted, and a confirmation mail is send to your mailaddress!</p>',
                     
	'event_calendar:payment:declined' => 'Payment declined!',
	'event_calendar:payment:declined_detail' => 'Sorry, the payment was not accepted',		
	
	'event_calendar:settings:currency:title' => "Currency for fees to be shown in (eg. USD, DKK, GBP..)",
		
	'event_calendar:personal_manage:closedfuture_no_list'=> 'Closed for future (delete waiting list)',
	'event_calendar:personal_manage:closedfuture_keep_list'=> 'Closed for future (keep waiting list)',
	
	'event_calendar:returnto' => 'Return to event',
	
	
	'event_calendar:denied:subject' => 'Sorry, you are not attending the event',
	'event_calendar:denied:message' => 'The event "%s" has now closed for requests, and you are not attending the activity. We hope, you are able to participate next time.',
	
	'event_calendar:event:status' => 'Status for particitating',
	'event_calendar:event:status:closed' => 'Your request has to be approved by administrator',
	'event_calendar:event:status:closedfuture_keep_list' => 'Closed for future requests',
	'event_calendar:event:status:closedfuture_no_list' => 'Closed for future requests',
	'event_calendar:event:status:open' => 'Open requesting (your request needs no approval from administrator)',
	'event_calendar:event:status:private' => 'Private event',
	'event_calendar:ticket:menu:type' => 'Type',
	'event_calendar:ticket:menu:price' => 'Price',
	'event_calendar:ticket:menu:select' => 'Select',
	'event_calendar:ticket:menu:left_tickets' => 'Tickets <br>Left',
	'event_calendar:ticket:menu:meximum_spot' => 'Maximum <br>pr. member',
	'event_calendar:ticket:menu:sold_tickets' => 'Sold',
	'event_calendar:ticket:menu:total_tickets' => 'Total <br>tickets',
	
    'event_calendar:ticket:usertotalspot' =>'No. of tickets you have bought:',
    'event_calendar:ticket:usermaxspot' =>'Max. Limit per member:',
    'event_calendar:ticket:usertotalleft' =>'Tickets you still can buy:',
    'event_calendar:ticket:usertotalconsumed' =>'You can not buy more',
	'event_calendar:ticket:type' => 'Ticket:',
	'event_calendar:ticket:amount' => 'Cost (DKK):',
	'event_calendar:ticket:spots' => 'Tickets for sale',
	'event_calendar:ticket:spots:max' => 'Max. tickets pr. member:',
	'event_calendar:ticket:spots:sold' => 'Sold:',
	'event_calendar:ticket:spots:left' => 'left',
	'event_calendar:ticket:spots:total' => 'Total:',
	'event_calendar:ticket:list' => 'Select tickets',
	'event_calendar:ticket:buynow' => 'Buy now..',
	'event_calendar:ticket:problem' => 'There was a problem processing these tickets. Please try again.',
	'event_calendar:ticket:soldout' => ' <b>Sold out!</b>',
	'event_calendar:tickets:allsoldout' => 'All tickets are sold',
	'event_calendar:ticket:notfree' => 'This event is not free, you have to choose one of the tickets for sale.',
	'event_calendar:ticket:free:closed:success' => 'Success! Your free order now has to be accepted, you will recieve a confirmation message soon',
	'event_calendar:ticket:free:open:success' => 'Success! Your free order has been accepted!',
	'event_calendar:make_request_title:free' => 'This event is free - request a ticket',
	
	'awaitingpayment' => 'Awaiting Payment',
	'processing' => 'Waiting for administrator',
	'accepted' => 'Your ticket is accepted',
	
	'event_calendar:doublecheck' => 'Please approve your order?',
	'event_calendar:review_order_menu_title' => 'Event orders',
	
	'event_calendar:view_orders' => 'Orders placed for %s',
    'event_calendar:view_all_orders' => 'All Orders',
	'event_calendar:order:created:subject' => 'Order confirmation: Your order for the activity \'%s\' has been registered.',
	'event_calendar:order:created:message' => 'We hereby confirm to have recieved your ticketorder for <b>%s</b>
<p>Order id: %s</p>
<p>Transfer id: %s</p>
<p>Member ID: %s</p>
<p>Date: %s</p>
<p>Venue: %s</p>

<p><b>The ticket(-s) contain</b></p>  %s

<p>Total: %s</p>',

	'event_calendar:order:accepted:subject' => 'Ticket confirmation: Your ticketorder for \'%s\' has been accepted.',
	'event_calendar:order:accepted:message' => 'We confirm that the tickets for <b>%s</b> are reserved for you
<p>Order id: %s</p>
<p>Transfer id: %s</p>
<p>Member ID: %s</p>
<p>Date: %s</p>
<p>Venue: %s</p>

<p><b>The ticket(s) contain</b></p>  %s
<p>Total: %s</p>',

	'event_calendar:order:declined:subject' => 'Your order for \'%s\' has been declined.',
	'event_calendar:order:declined:message' => 'The order your placed for <b>%s</b> with order id %s has been declined. Your payment will be canceled, and all your credit card infos will be deleted. ',

	'event_calendar:order:free:created:subject' => 'Order confirmation: Your order for the activity \'%s\' has been registered.',
	'event_calendar:order:free:created:message' => '<p>We hereby confirm to have recieved your ticketorder (%s) for <b>%s</b>.</p> <br/>',

	'event_calendar:attendees:export:header' => "OrderID \t Name \t MemberID \t Email \t Phone\t",

	);
					
	add_translation("en",$english);

?>