<?php
/**
 * Dispatches a bulk action to real action.
 *
 * @package Elgg.Core.Plugin
 * @subpackage uservalidationbyadmin
 */

    admin_gatekeeper();
    $pluginemail = elgg_get_plugin_from_id('uservalidationbyemail');
    $pluginadmin = elgg_get_plugin_from_id('uservalidationbyadmin');
    
    if(!$pluginadmin->isActive()){
        $pluginemail->deactivate();
        $pluginadmin->activate();
    }else{
        $pluginadmin->deactivate();
        $pluginemail->activate();
    }
    
    forward(REFERRER);