<?php
/**
 * Elgg Agora Classifieds plugin
 * @package agora
 */

elgg_load_library('elgg:agora');

$plugin = elgg_get_plugin_from_id('agora');

// paypal account
$paypal_account = elgg_view('input/text', array('name' => 'params[paypal_account]', 'value' => $plugin->paypal_account));
$paypal_account .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:paypal_account:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:paypal_account'), $paypal_account);

// set if use paypal sandbox
$usesandbox = $plugin->usesandbox;
if(empty($usesandbox)){
        $usesandbox = 'no';
}    
$potential_usesandbox = array(
    "no" => elgg_echo('agora:settings:no'),
    "yes" => elgg_echo('agora:settings:yes'),
); 
$usesandbox = elgg_view('input/dropdown', array('name' => 'params[usesandbox]', 'value' => $usesandbox, 'options_values' => $potential_usesandbox));
$usesandbox .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:sandbox:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:sandbox'), $usesandbox);


echo elgg_view('input/submit', array('value' => elgg_echo("save")));
