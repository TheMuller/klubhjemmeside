<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'phpexcel_init');

function phpexcel_init() {

    if (elgg_is_admin_logged_in())
    {
       // elgg_register_menu_item('page', array('name' => 'excel_admin', 'href' => 'admin/users/addtogroup', 'text' => elgg_echo('excel'), 'context' => 'admin', 'section' => 'administer'));
    }
    elgg_register_admin_menu_item('administer', 'addtogroup', 'users');
 }


