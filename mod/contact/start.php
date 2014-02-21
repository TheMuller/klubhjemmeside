<?php

function contactform_init() 
{
	global $CONFIG;
	add_menu(elgg_echo('contactform:menu'), $CONFIG->wwwroot . "mod/contactform");
}
		
register_elgg_event_handler('init','system','contactform_init');
?>
