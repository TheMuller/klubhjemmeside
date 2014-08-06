<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');

// set the default timezone to use
date_default_timezone_set('UTC');

$interest_guid = get_input('interest_guid');
if (!$interest_guid) {	// if not interest guid
	$errmsg = elgg_echo('agora:set_accepted:interest_guid_missing');
}

// set ignore access for loading all entries
$ia = elgg_get_ignore_access();
elgg_set_ignore_access(true);

$interest = get_entity($interest_guid);
if (!elgg_instanceof($interest, 'object', 'agorainterest')) {	// if not agora interest entity
	$errmsg = elgg_echo('agora:set_accepted:interest_entity_missing');
}

// get classified entity
$classfd = get_entity($interest->int_ad_guid);
if (!elgg_instanceof($classfd, 'object', 'agora')) {	// if not agora interest entity
	$errmsg = elgg_echo('agora:set_accepted:agora_entity_missing');
}

//get buyer entity
$buyer_profil = get_user($interest->int_buyer_guid);
if (!elgg_instanceof($buyer_profil, 'user')) {	// if not user entity
	$errmsg = elgg_echo('agora:set_accepted:user_entity_missing');
}

if ($errmsg)	{
	register_error($errmsg);
}
else
{
	if ($classfd->canEdit())	{
		$classfdsale = new ElggObject;
		$classfdsale->subtype = "agorasales";
		$classfdsale->access_id = 0;
		$classfdsale->save();

		$transaction_date = date('Y-m-d H:i:s');
		
		// set object metadata
		$classfdsale->container_guid = $classfd->owner_guid;
		$classfdsale->owner_guid = $buyer_profil->guid;
		$classfdsale->txn_vguid = $classfd->guid;
		$classfdsale->txn_buyer_guid = $buyer_profil->guid;
		$classfdsale->txn_date = $transaction_date;
		$classfdsale->txn_id = 'Offline-'.$classfd->guid.'-'.$interest->int_buyer_guid;
		
		if ($classfdsale->save()) {
			$interest->int_status = AGORA_INTEREST_ACCEPTED;
			if ($interest->save()) {
				system_message(elgg_echo('agora:set_accepted:success'));
			}
			else {
				register_error(elgg_echo('agora:set_accepted:failed'));
			}		
			
			// reduce available inits
			$available_units = $classfd->howmany;
			if ($available_units && is_numeric($available_units)) {
				$classfd->howmany = $available_units - 1;
				$classfd->save();
			}	
			
			// notify seller
			$subject = elgg_echo('agora:paypal:sellersubject').' '.$buyer_profil->username;
			$message = '';
			$message .= '<p>'.elgg_echo('agora:paypal:accepteddate').': '.$transaction_date.'</p>';
			$message .= '<p>'.elgg_echo('agora:add:title').': <a href="'.elgg_get_site_url().'agora/view/'.$classfd->guid.'">'.$classfd->title.'</a></p>';
			$message .= '<p>'.elgg_echo('agora:buyerprofil').': <a href="'.elgg_get_site_url().'profile/'.$buyer_profil->username.'">'.$buyer_profil->username.'</a></p>';           
			notify_user($classfd->owner_guid, $buyer_profil->guid, $subject, $message);
			
		    // notify buyer
			$subject = elgg_echo('agora:paypal:buyersubject').' '.$classfd->title;
			$message = '';
			$message .= '<p>'.elgg_echo('agora:paypal:buyerbody').'</p>';
			$message .= '<p>'.elgg_echo('agora:paypal:title').': <a href="'.elgg_get_site_url().'agora/view/'.$classfd->guid.'">'.$classfd->title.'</a></p>';
			notify_user($buyer_profil->guid, $classfd->owner_guid, $subject, $message);         
			
			// notify users from settings
			$users_to_notify = elgg_get_plugin_setting('users_to_notify','agora');
			$fields = explode(",", $users_to_notify);
			foreach ($fields as $val){
				$user_to_notify = get_user_by_username(trim($val));
				
				if($user_to_notify){
					notify_user($user_to_notify->guid, $classfd->owner_guid, $subject, $message);  
				}
			}	
			
		} else {
			$errmsg = elgg_echo('agora:ipn:error5');
		}	
	}
	else  {
		register_error(elgg_echo("agora:set_rejected:novalidaccess"));
	}

}

// restore ignore access
elgg_set_ignore_access($ia);

forward(REFERER);
