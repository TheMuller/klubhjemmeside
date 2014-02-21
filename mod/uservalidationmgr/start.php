<?php
/**
 * Email user validation plugin.
 * Non-admin accounts are invalid until their email address is confirmed.
 *
 * @package Elgg.Core.Plugin
 * @subpackage uservalidationmgr
 */

elgg_register_event_handler('init', 'system', 'uservalidationmgr_init');

function uservalidationmgr_init() {

    $action_path = dirname(__FILE__) . '/actions';

    // Register page handler to validate users
    // This doesn't need to be an action because security is handled by the validation codes.
    elgg_register_page_handler('uservalidationmgr', 'uservalidationmgr_page_handler');
    elgg_register_action('uservalidationmgr/changeplugin', "$action_path/changeplugin.php", 'admin');
    elgg_register_action("uservalidationmgr/settings/save", elgg_get_plugins_path() . 'uservalidationmgr/actions/' . 'uservalidationmgr/settings/save.php');
    $validator_admin_guid=elgg_get_plugin_setting('validator_admin_guid','uservalidationmgr');
    if(!$validator_admin_guid or $validator_admin_guid ==''){
        
        $site = elgg_get_site_entity();
        elgg_set_plugin_setting('validator_admin_guid',$site->guid,'uservalidationmgr');
    }
}


/**
 * Checks sent passed validation code and user guids and validates the user.
 *
 * @param array $page
 * @return bool
 */
function uservalidationmgr_page_handler($page) {

    if (isset($page[0]) && $page[0] == 'manage') {
        admin_gatekeeper();

        $content .=  "Validate Users<br>".elgg_view_form('uservalidationbyadmin/bulk_action', array(
                                                                                                            'id' => 'uservalidationbyadmin-form',
                                                                                                            'action' => 'action/uservalidationbyadmin/bulk_action'
                                                                                                            ));
        
        $body = elgg_view_layout('content', array('content' => $content,'sidebar' => $sidebar,'title' => $title ,'filter' => '',));

        echo elgg_view_page($title, $body);

    }
    else {
		register_error(elgg_echo('email:confirm:fail'));
        forward('');
        //echo "sachin    ";
	}
	// forward to front page
	
}

