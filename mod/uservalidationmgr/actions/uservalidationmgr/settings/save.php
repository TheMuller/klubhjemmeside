<?php
    $params = get_input('params');
$plugin_id = get_input('plugin_id');
$plugin = elgg_get_plugin_from_id($plugin_id);

if (!($plugin instanceof ElggPlugin)) {
	register_error(elgg_echo('plugins:settings:save:fail', array($plugin_id)));
	forward(REFERER);
}

$plugin_name = $plugin->getManifest()->getName();




system_message(elgg_echo('plugins:settings:save:ok', array($plugin_name)));
    
    $validator = $params["validator"];
    $pluginemail = elgg_get_plugin_from_id('uservalidationbyemail');
    $pluginadmin = elgg_get_plugin_from_id('uservalidationbyadmin');


    if($validator =='email'){
            if($pluginadmin)$pluginadmin->deactivate();
            if($pluginemail)$pluginemail->activate();
        
    }elseif($validator =='admin' ){
            if($pluginemail)$pluginemail->deactivate();
            if($pluginadmin)$pluginadmin->activate();
      
    }else{
        if($pluginemail)$pluginemail->deactivate();
        if($pluginadmin) $pluginadmin->deactivate();
    }

    $makemevalidator = $params["makemevalidator"];

    $validator_admin_guid = $plugin->getSetting("validator_admin_guid");
    
    
    if(($makemevalidator == 1) and ($validator_admin_guid != elgg_get_logged_in_user_guid())){
        $plugin->setSetting("validator_admin_guid",elgg_get_logged_in_user_guid());
        
    }elseif (($makemevalidator == 0) and($validator_admin_guid == elgg_get_logged_in_user_guid())){
        
        $site = elgg_get_site_entity();
        $plugin->setSetting("validator_admin_guid",$site->guid);
    }
forward(REFERER);