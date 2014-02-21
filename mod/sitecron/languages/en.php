<?php

/*
 * Satheesh PM, BARC Mumbai
 * www.satheesh.anushaktinagar.net
 */



$english = array(
 
'sitecron:yes' => 'Yes',
'sitecron:no' => 'No',
'sitecron:7days' => '7 Days Ago', 
'sitecron:15days' => '15 Days Ago',
'sitecron:1month' => '1 Month Ago',
'sitecron:2month' => '2 Months Ago',
'sitecron:3month' => '3 Months Ago',
'sitecron:30year' => 'Never Logged In',
'sitecron:notloggedin' => 'Never Logged in before',
'sitecron:info' => 'Just enabling this plugin will not work. You must setup a cron job in your site control panel for daily and hourly. You can use <b>wget yoursite.com/cron/daily</b> or <b>wget yoursite.com/cron/hourly</b> in the command field',
'sitecron:dropvalidation' => 'Cron to delete Unvalidated Users (Cron Period : daily)',
'sitecron:validation' => 'Run a daily cron to delete unvalidated users',
'sitecron:droptime' => 'Delete Unvalidated members who have registered in the site',
'sitecron:loginreminder' => 'Cron to send Login Reminder (Cron Period : hourly)',
'sitecron:reminder' => 'Run a hourly cron to send Login Reminder to Members',
'sitecron:remindertime' => 'Send Login Reminder to Members whos last login was on',
'sitecron:counter' => 'Offset Counter (Intial value should be Zero)',
'sitecron:sitecron_drop_unvalidated_cron_result_true' =>'Unvalidated Members of site were deleted',
'sitecron:sitecron_drop_unvalidated_cron_result_false' =>'There are no Unvalidated Members to delete',
'sitecron:sitecron_login_reminder_cron_true' =>'Login reminders send to above members',
'sitecron:sitecron_login_reminder_cron_false' =>'No members to send Login Reminder. Or Reminder setting is Off',


'sitecron:login_message:subject' => 'We Missed You',
'sitecron:login_message' => "

Dear %s,

Once you were very active here and has contributed a lot to this site. Now a days you are not online, yes we could understand you may be busy. We missed your posts, comments and valuable suggestions.

Your last login was on %s and there are lots of changes there after.. Once again we love to see you active in this Site with your strong views and opinions in various discussions and comments.. Also we love to read your feedback about the site.

Thanking You
Administrator
%s
%s

(Please do not reply to this email.)
",

'sitecron:delete_message:subject' => 'Your Account Deleted',
'sitecron:delete_message' => "

Dear %s,

This is a automated message to inform you that your account in %s associated with this email ID has been deleted because you have not activated your account for the last 15 days since the registration.

You are free to register for an account in the Site again

After Registration Please remember to activate your account by clicking the link we will send to you to your registered email ID

Thank You
Administrator
%s
%s

(Please do not reply to this email.)",
);
					
add_translation("en", $english);





