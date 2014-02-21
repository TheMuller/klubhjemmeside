<?php

$english = array(
	'email_disable' => "Email Disable",
	'notifications_email_disable' => "Disable Email Widget",
	'email_disable:widget:description' => "Disable email notifications for users with invalid addresses",
	'notifiactions_email_disable:instructions' => "Enter email addresses one per line and click submit.  Email notifications will be turned off for these users.  The users will be notified of the change on their next login, and a site message will be sent (if possible)",
	'notifications_email_disable:empty' => "You haven't entered any emails",
	'notifications_email_disable:disabled:notice' => "Your email notifications have been disabled as the email address on your account appears invalid.<br>  Please update your email address on your settings page.  Once a valid address is entered you can re-enable email notifications.",
	'notifications_email_disable:invalid:emails' => "Some emails entered were not found in the system.  They have been left in the widget.  All emails that were found have had notifications disabled.",
	'notifications_email_disable:generic:error' => "An unknown error has occurred, notifications have not been disabled.",
	'notifications_email_disable:action:success' => "All affected users were found and email notifications disabled.",
	'notifications_email_disable:subject' => "Email notifications have been disabled",
	'notifications_email_disable:settingslink' => "Take me to my email settings",
	'notifications_email_disable:acknowledge' => "I understand",
	
	// settings
	'notifications_email_disable:setting:system_message' => "Notify affected users by system message (single transient message on next pageload)",
	'notifications_email_disable:setting:site_notification' => "Notify affected users by site notification (internal email-like message)",
	'notifications_email_disable:setting:lightbox' => "Notify affected users by lightbox popup - occurs on every pageload until the user indicates that they have acknowledged the notice",
);
					
add_translation("en",$english);
