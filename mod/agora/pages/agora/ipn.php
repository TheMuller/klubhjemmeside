<?php
/**
 * Elgg Agora Classifieds plugin
 * @package agora
 */

// Get engine
//require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php"); //obs

elgg_load_library('elgg:agora');
elgg_load_library('elgg:agora:ipnlistener');

// intantiate the IPN listener
$listener = new IpnListener();

// tell IPN listener to check if use sandbox paypal account
$usesandbox = trim(elgg_get_plugin_setting('usesandbox', 'agora'));
if ($usesandbox === 'yes')   {
    $listener->use_sandbox = true;
}
else {
    $listener->use_sandbox = false;
}


$errmsg = '';   // stores errors from fraud checks
//
// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    $errmsg = $e->getMessage();
    exit(0);
}

if ($verified) {
    
    // 1. Make sure the payment status is "Completed" 
    if ($_POST['payment_status'] != 'Completed') { 
        // simply ignore any IPN that is not completed
        $errmsg = elgg_echo('agora:ipn:error1');
        //exit(0); 
    } 
        
    if ($_POST['item_number'])  {
        $pieces = explode("-", $_POST['item_number']);
        $classfd_guid = $pieces[0];     // ad guid
        $buyer_guid = $pieces[1];        // buyer guid
        $classfd_owner_guid = $pieces[2];        // ad owner guid
        
        // get buyer user settings
        $buyer_profil = get_user($buyer_guid);
        if ($buyer_profil)  {
            // login for retrieving entities and saving purchase
            login(get_entity($buyer_guid)); 

            //get ad entity
            $classfd = get_entity($classfd_guid);
            
            // 2. Make sure seller email matches your primary account email.
            /*
            // check who can post for retrieving paypal account
            $whocanpost = trim(elgg_get_plugin_setting('voucher_uploaders', 'vouchers'));
            if ($whocanpost === 'allmembers')   {
                $vowner = get_user($classfds->owner_guid);
                $paypal_acount = $vowner->email;
            }
            else if ($whocanpost === 'admins')   {
                $paypal_acount = trim(elgg_get_plugin_setting('paypal_account', 'vouchers'));
            } 
            if ($_POST['receiver_email'] != 'YOUR PRIMARY PAYPAL EMAIL') {
                $errmsg .= "'receiver_email' does not match: ";
                $errmsg .= $_POST['receiver_email']."\n";
            } */

            // 3. Make sure the amount(s) paid match
            if ($_POST['mc_gross'] != $classfd->price) {
                $errmsg .= elgg_echo('agora:ipn:error2');
                $errmsg .= $_POST['mc_gross']."\n";
            }      

            // 4. Make sure the currency code matches
            if ($_POST['mc_currency'] != $classfd->currency) {
                $errmsg .= elgg_echo('agora:ipn:error3');
                $errmsg .= $_POST['mc_currency']."\n";
            }  

            // 5. Ensure the transaction is not a duplicate / this user hasn't buy this ad again
            $options = array(
                    'type' => 'object',
                    'subtype' => 'agorasales',
                    'limit' => 0,
                    'metadata_name_value_pairs' => array(
                        array('name' => 'txn_vguid','value' => $classfd_guid, 'operand' => '='),
                        array('name' => 'txn_buyer_guid', 'value' => $buyer_guid, 'operand' => '='),
                    ),
                    'metadata_name_value_pairs_operator' => 'AND',
            );
            $getbuyers = elgg_get_entities_from_metadata($options);
            if ($getbuyers) { 
                $errmsg .= elgg_echo('agora:ipn:error4');
            }        


            if (!empty($errmsg)) {
                // send message to ad owner
                $email_body = "\n$errmsg\n\n";
                $email_body .= $listener->getTextReport();
                notify_user($classfd_owner_guid, $classfd_owner_guid, elgg_echo('agora:ipn:title'), $email_body);
            } else {
                $classfdsale = new ElggObject;
                $classfdsale->subtype = "agorasales";
                $classfdsale->access_id = 0;
                $classfdsale->save();

                // set object metadata
                $classfdsale->container_guid = $classfd_owner_guid;
                $classfdsale->owner_guid = $buyer_guid;
                $classfdsale->txn_vguid = $classfd_guid;
                $classfdsale->txn_buyer_guid = $buyer_guid;
                $classfdsale->txn_date = $_POST['payment_date'];
                $classfdsale->txn_id = $_POST['txn_id'];

                if ($classfdsale->save()) {
					// reduce available inits
					$available_units = $classfd->howmany;
					if ($available_units && is_numeric($available_units)) {
						$classfd->howmany = $available_units - 1;
						$classfd->save();
					}
					
                    // notify seller
                    $subject = elgg_echo('agora:paypal:sellersubject').' '.$buyer_profil->username;
                    $message = '';
                    $message .= '<p>'.elgg_echo('agora:paypal:buyeremail').': '.$_POST['payer_email'].'</p>';
                    $message .= '<p>'.elgg_echo('agora:paypal:country').': '.$_POST['address_country_code'].'</p>';
                    $message .= '<p>'.elgg_echo('agora:paypal:firstname').': '.$_POST['first_name'].'</p>';
                    $message .= '<p>'.elgg_echo('agora:paypal:lastname').': '.$_POST['last_name'].'</p>';
                    $message .= '<p>'.elgg_echo('agora:paypal:mccurrency').': '.$_POST['mc_currency'].'</p>';
                    $message .= '<p>'.elgg_echo('agora:paypal:mcgross').': '.$_POST['mc_gross'].'</p>';
                    $message .= '<p>'.elgg_echo('agora:paypal:paymentdate').': '.$_POST['payment_date'].'</p>';
                    $message .= '<p>'.elgg_echo('agora:paypal:paymentstatus').': '.$_POST['payment_status'].'</p>';
                    $message .= '<p>'.elgg_echo('agora:add:title').': <a href="'.elgg_get_site_url().'agora/view/'.$classfd->guid.'">'.$_POST['item_name'].'</a></p>';
                    $message .= '<p>'.elgg_echo('agora:buyerprofil').': <a href="'.elgg_get_site_url().'profile/'.$buyer_profil->username.'">'.$buyer_profil->username.'</a></p>';           
                    notify_user($classfd_owner_guid, $buyer_guid, $subject, $message);
                    
                   // notify buyer
                    $subject = elgg_echo('agora:paypal:buyersubject').' '.$classfd->title;
                    $message = '';
                    $message .= '<p>'.elgg_echo('agora:paypal:buyerbody').'</p>';
                    $message .= '<p>'.elgg_echo('agora:paypal:title').': <a href="'.elgg_get_site_url().'agora/view/'.$classfd->guid.'">'.$_POST['item_name'].'</a></p>';
                    notify_user($buyer_guid, $classfd_owner_guid, $subject, $message);         
                    
                    // notify users from settings
                    $users_to_notify = elgg_get_plugin_setting('users_to_notify','agora');
					$fields = explode(",", $users_to_notify);
					foreach ($fields as $val){
						$user_to_notify = get_user_by_username(trim($val));
						
						if($user_to_notify){
							notify_user($user_to_notify->guid, $classfd_owner_guid, $subject, $message);  
						}
					}					
                } else {
                    $errmsg = elgg_echo('agora:ipn:error5');
                }
            }            

            logout();  // logout user
            
        }   // end of get_user($buyer_guid)
        else    {
            $errmsg = elgg_echo('agora:ipn:error6');
        }        
    }
    else    {
        $errmsg = elgg_echo('agora:ipn:error7');
    }
    
    if (!empty($errmsg)) {
        // send message to ad owner
        $email_body = "\n$errmsg\n\n";
        $email_body .= $listener->getTextReport();
        notify_user($classfd_owner_guid, $classfd_owner_guid, elgg_echo('agora:ipn:title'), $email_body);
    }
} else {
    // manually investigate the invalid IPN
    //$email_body = $listener->getTextReport();
    //notify_user($classfd_owner_guid, $classfd_owner_guid, elgg_echo('agora:ipn:title'), $email_body);
    exit(0);
}












