<?php //ł ?><?php
$english = array(
	//these translations where set automatically, you might need to change them a bit:
	
	//general
	'vazco_newsletter' => 'Newsletter',
	'vazco_newsletter:menu:title'=>'newsletter', 
	'vazco_newsletter:edit'=>'Edit newsletter',
	'vazco_newsletter_edit:noreqfield'=>'You have to fill in the required field: %s', 
	'vazco_newsletter_edit:notnumeric' => 'This field has to be numeric: %s',
	"vazco_newsletter:all" => 'All newsletters',   //used in title in listing
	"vazco_newsletter:userlisting" => 'My newsletter listing',   //used in title in userlisting
	'vazco_newsletter:delete_link' => "Delete this newsletter",
	'vazco_newsletter:nodata' => 'No data',
	'vazco_newsletter:yes' => 'Yes',
	'vazco_newsletter:no' => 'No',
	'vazco_newsletter:issent' => 'Is sent',
	'vazco_newsletter:register' => ' Subscribe to our newsletter',
	'vazco_newsletter:date_ts' => 'Send date',
	'vazco_newsletter:issent' => 'Was sent',
	'vazco_newsletter:subscribeall' => 'Subscribe all',
	'vazco_newsletter:unsubscribeall' => 'Unsubscribe all',
	'vazco_newsletter:sheduled_at' => 'Scheduled at:',
	'vazco_newsletter:issent:false' => 'Not yet sent',
	'vazco_newsletter:issent:true' => 'Already sent',
	'vazco_newsletter:test_send' => 'Test send',
	'vazco_newsletter:newsletter' => 'Newsletter',
	//entity fields
	'vazco_newsletter:title'=>'Title', 
	'vazco_newsletter:body'=>'Body of the message',
	'vazco_newsletter:date' => 'Publish date', 
	'vazco_newsletter:body:hint'=>'You can use special chars in your template:<br/><br/>
		{$message_body} - the context of the message<br/>
		{$message_title} - the title of the message<br/>
		{$message_sender} - the name of the sender of the message<br/>
		{$message_receiver} - the name of the receiver of the message<br/>
		{$optout} - the opt-out link for the message',
	'vazco_newsletter:description' => 'Description',
	'vazco_newsletter:tags'=>'Tags', 
	//'vazco_newsletter:optout' => 'If you want to resign from newsletter "%s", please go to <a href="%s">this link</a>',
	//'vazco_newsletter:optout' => 'If you want to resign from newsletter "%s", please go to <a href="%s">this link</a>',
	
	//actions and communicates
	'vazco_newsletter:delete_response' => 'This newsletter has been deleted',
	'vazco_newsletter:error_delete' => "This newsletter does not exist or you do not have the right to delete it",
	'vazco_newsletter:error_rights' => "This listing doesnt exist or you dont have rights to access it",
	'vazco_newsletter:deleted' => 'newsletter was successfully deleted',
	'vazco_newsletter:notdeleted' => 'newsletter couldn\'t be deleted',
	'vazco_newsletter_edit:saved' => 'Your newsletter was successfully saved',
	'vazco_newsletter_edit:notsaved' => 'Your newsletter couldn\'t be saved',
	'vazco_newsletter:error_nosuchentity' => 'There is no such entity',
	'vazco_newsletter:nogroupwithid' => 'No group with given ID',
	'vazco_newsletter:error_nosuchentity' => "This newsletter doesnt exist",
	'vazco_newsletter:error_nosuchentity' => 'No such entity',
	//vazco_newsletter river
	'vazco_newsletter:river:created' => "%s added",
	'vazco_newsletter:river:edited' => "%s edited",
	'vazco_newsletter:edit' => "Edit newsletter",
	'vazco_newsletter:view' => "View newsletter",
	'vazco_newsletter:add' => "Add newsletter",
	'vazco_newsletter:listing' => "Newsletters",
	
	//menu elements
	'vazco_newsletter:page:message_queue:not_sent' => 'Messages in queue',
	'vazco_newsletter:page:message_queue:sent' => 'Messages sent',
	'vazco_newsletter:page:message_queue:error' => 'Messages errors',
	'vazco_newsletter:listing_notsent' => 'View new newsletters',
	'vazco_newsletter:listing_sent' => 'View sent newsletters',

	'vazco_newsletter:emptyqueue' => 'No elements to display',
	'vazco_newsletter:nonewsletters' => 'No newsletters to display',
	'vazco_newsletter:nosubscribers' => 'No subscribed users',

	//page titles
	'vazco_newsletter:not_sent' => 'Not sent newsletters',
	'vazco_newsletter:sent' => 'Sent newsletters',
	'vazco_newsletter:message_queue:not_sent' => 'Messages in queue',
	'vazco_newsletter:message_queue:sent' => 'Messages sent',
	'vazco_newsletter:message_queue:error' => 'Messages errors',

	'vazco_tools:transtoggle' => 'Show all translations',
	'vazco_tools:image:delete' => 'Change or delete image',
	'vazco_tools:deleted' => 'Deleted succesfully',
	'vazco_tools:saved' => 'Saved succesfully',
	

	//plugin pages
	'vazco_newsletter:page:subscribers:title' => 'Subscribers',
	'vazco_newsletter:page:message_queue:title' => 'Message queue',

	//settings
	'vazco_newsletter:settings:subscription' => 'Subscribe to the newsletter: ',

	//plugin action reports
	'vazco_newsletter:subscribe:success'	=> 'subscribe was successful',
	'vazco_newsletter:subscribe:failure'	=> 'There was a problem while performing subscribe',
	'vazco_newsletter:unsubscribe:success'	=> 'unsubscribe was successful',
	'vazco_newsletter:unsubscribe:failure'	=> 'There was a problem while performing unsubscribe',
	'vazco_newsletter:send:success'	=> 'send was successful',
	'vazco_newsletter:send:failure'	=> 'There was a problem while performing send',
	'vazco_newsletter:subscribeall:success'	=> 'subscribeall was successful',
	'vazco_newsletter:subscribeall:failure'	=> 'There was a problem while performing subscribeall',
	'vazco_newsletter:unsubscribeall:success'	=> 'Unsubscribeall was successful',
	'vazco_newsletter:unsubscribeall:failure'	=> 'There was a problem while performing unsubscribeall',
	'vazco_newsletter:testsend:success'	=> 'testsend was successful',
	'vazco_newsletter:testsend:failure'	=> 'There was a problem while performing testsend',
	'vazco_newsletter:issent:hint' => 'Accepted values are 0 and 1',


	//all translations to this point where set automatically, you might need to change them a bit
);

add_translation("en",$english);
?>