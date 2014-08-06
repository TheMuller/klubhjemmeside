<?php
/**
 * Elgg Agora Classifieds plugin
 * @package agora
 */

elgg_load_library('elgg:agora');

$plugin = elgg_get_plugin_from_id('agora');

// set categories
$categories = elgg_view('input/text', array('name' => 'params[categories]', 'value' => $plugin->categories));
$categories .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:categories:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:categories'), $categories);

// set default currency
$defaultcurrency = $plugin->default_currency;
if(empty($defaultcurrency)){
        $defaultdateformat = '€';
}        
// get currency list
$CurrOptions = get_agora_currency_list();   
$currency = elgg_view('input/dropdown', array('name' => 'params[default_currency]', 'value' => $defaultcurrency, 'options_values' => $CurrOptions));
$currency .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:defaultcurrency:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:defaultcurrency'), $currency);

// set who can post classifieds
$agora_uploaders = $plugin->agora_uploaders;
if(empty($agora_uploaders)){
        $agora_uploaders = 'allmembers';
}    
$agora_potential_uploaders = array(
    "admins" => elgg_echo('agora:settings:uploaders:admins'),
    "allmembers" => elgg_echo('agora:settings:uploaders:allmembers'),
); 

$uploaders = elgg_view('input/dropdown', array('name' => 'params[agora_uploaders]', 'value' => $agora_uploaders, 'options_values' => $agora_potential_uploaders));
$uploaders .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:uploaders:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:uploaders'), $uploaders);

// terms of use
$terms_of_use = elgg_view('input/longtext', array('name' => 'params[terms_of_use]', 'value' => $plugin->terms_of_use));
$terms_of_use .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:terms_of_use:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:terms_of_use'), $terms_of_use);

// set if members can send private message to seller
$send_message = $plugin->send_message;
if(empty($send_message)){
        $send_message = 'yes';
}    
$potential_send_message = array(
    "no" => elgg_echo('agora:settings:no'),
    "yes" => elgg_echo('agora:settings:yes'),
); 
$send_message_output = elgg_view('input/dropdown', array('name' => 'params[send_message]', 'value' => $send_message, 'options_values' => $potential_send_message));
$send_message_output .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:send_message:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:send_message'), $send_message_output);

// set users to notify for each transaction
$users_to_notify = elgg_view('input/text', array('name' => 'params[users_to_notify]', 'value' => $plugin->users_to_notify));
$users_to_notify .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:users_to_notify:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:users_to_notify'), $users_to_notify);

echo elgg_view('input/submit', array('value' => elgg_echo("save")));
