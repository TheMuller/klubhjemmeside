<?php //ł ?><?php
	$entity = $vars['entity'];

	$icon = $entity->getIcon('small');
	//dumpdie($icon);
	$icon = "<a href='{$vars['entity']->getURL()}'><img src='{$icon}'></a>";
	$title = elgg_translate($entity,'name');
	$newsletter_body = elgg_translate($entity,'body');
	$isSent = $entity->isSent;
	$date = $entity->date;
	$date_ts = $entity->date_ts;
	
	$info ='<div><a href="'.$entity->getUrl().'">'.$title.'</a></div>';
	//$info .= '<div>'.$newsletter_body.'</div>';
	$info .= '<div class="date"><span>'.elgg_echo('vazco_newsletter:sheduled_at').'</span> '.date("Y/m/d",$date_ts).'</div>';
	$info .= '<div class="isSent">'.elgg_echo($isSent==true?'vazco_newsletter:issent:true':'vazco_newsletter:issent:false').
	' <a href="'.elgg_add_action_tokens_to_url($CONFIG->wwwroot.'action/newsletter/testsend?guid='
	.get_loggedin_userid()).'&newsletter='.$entity->guid.'">'.elgg_echo('vazco_newsletter:test_send').'</a></div>';

	echo elgg_view_listing($icon, $info);	
?>