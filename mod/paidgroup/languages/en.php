<?php
/**
 * PaidGroup languages
 *
 * @package ElggPaidGroup
 */

$english = array(
'groups:paid' => "Paid Group",
                 'groups:groups:access:style' => "Site Access Level",
                 'groups_currency' => "Currency",
                 'groups_merchant_number' => " DIBS merchant number",
                 'groups_md5secret' => "DIBS md5 secret",
                 'paidgroup:membership:lastdate' => "Your membership will expire on %s",
                 'paidgroup:membership:warning' =>  "This is a Paid Group",
                 'paidgroup:membership:expired:warning'=> "Your membership is expired",
                 'paidgroup:membership:leave:confirm' => "Are you sure you want to leave the group? You will need to pay for the group membership, if you want to rejoin the group again",

                 'paidgroup:field:group_paid_flag'=> "Should it be a Paid membership?",
                 'paidgroup:field:group_period_type'=> "Type of period",
                 'paidgroup:field:group_paid_LockedPeriod'=> "Membership period in months",
                 'paidgroup:field:group_paid_MembershipStart'=> "Membership start date",
                 'paidgroup:field:group_paid_MembershipEnd'=> "Membership end date",
                 'paidgroup:field:group_paid_price'=> "Membership price",

                 'paidgroup:field:group_period_type:value:duration'=> "Months period",
                 'paidgroup:field:group_period_type:value:dates'=> "Dates",
                 'paidgroup:field:group_price_type:value:dailyprice'=> "Daily Price",
                 'paidgroup:field:group_price_type:value:fixedprice'=> "Fixed Price",
                 'paidgroup:field:warning_activemember'=> "There are %s active members. Any change in price will not impact them. However changes in dates will be informed to the members via email.",

//Email : membership will expire
                 'paidgroup:membership:will:expire:email:subject'=> "Your membership will expire soon",
                 'paidgroup:lock:membership:will:expire:email:body' => "Hi %s,
Your membership with %s group is going to expire on %s.",
                 'paidgroup:date:membership:will:expire:email:body' => "Hi %s,
Your membership with %s group is going to expire on %s.",
//Email :  membership is expired
                 'paidgroup:membership:expired:email:subject'=> "Your membership is expired",
                 'paidgroup:membership:expired:email:body' => "Hi %s,
Your membership with %s group has expired today.",
//Email:  membership is expired                 
                 'paidgroup:datechanged:email:subject'=> "Date changed",
                 'paidgroup:datechanged:email:body' => "Hi %s,
There is a change in the schedule of  %s group.
Now the start date is %s, and end date is %s.",

//Email:  Payment Received
                 'paidgroup:invoice:email:subject'=> "Payment received",
                 'paidgroup:invoice:email:body' => "Hi %s,
We have received a payment for %s group.
Thank you very much, Hope you will enjoy this membership.",
                 
);

add_translation("en", $english);