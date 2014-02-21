<?php
// Load Elgg engine
include_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// make sure only logged in users can see this page, if configured
$loginreq=elgg_get_plugin_setting('loginreq','contactform');
if( $loginreq == "yes" ) { gatekeeper(); }

// set the title
$title = elgg_echo('contactform:title');

// start building the main column of the page
$area1 = elgg_view_title($title);

// Add the form to this section
$area1 .= elgg_view("contactform/contactform");

// layout the page
$body = elgg_view('contactform/contactform', array('content' => $area1));

// draw the page
echo elgg_view_page($title, $body);
?>
