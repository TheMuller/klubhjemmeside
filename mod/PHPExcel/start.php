<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'phpexcel_init');

function phpexcel_init() {

    if (elgg_is_admin_logged_in())
    {
        elgg_register_menu_item('page', array('name' => 'excel_admin', 'href' => 'admin/PHPExcel/settings', 'text' => elgg_echo('excel'), 'context' => 'admin', 'section' => 'administer'));
    }
 }


