<?php

/*
 * Satheesh PM, BARC Mumbai
 * www.satheesh.anushaktinagar.net
 */


elgg_register_event_handler('init', 'system', 'sitecron_init');

function sitecron_init(){
elgg_extend_view('css/admin', 'sitecron/admin');

elgg_register_plugin_hook_handler('cron', 'daily', 'sitecron_drop_unvalidated_cron');
elgg_register_plugin_hook_handler('cron', 'hourly', 'sitecron_login_reminder_cron');

}

function sitecron_drop_unvalidated_cron($hook, $entity_type, $returnvalue, $params) {
    if (elgg_get_plugin_setting('validation', 'sitecron') == "yes"){
        global $CONFIG;
        if (!function_exists('uservalidationbyemail_get_unvalidated_users_sql_where')) {
        return;
        }
        $drop_time = elgg_get_plugin_setting('droptime', 'sitecron');
        $time_created = strtotime($drop_time);

        elgg_set_ignore_access(true);
        access_show_hidden_entities(true);

        $wheres = uservalidationbyemail_get_unvalidated_users_sql_where();
        $wheres[] = "e.time_created < $time_created";

        $options = array(
                'type' => 'user',
                'wheres' => $wheres,
                'limit' => 25,
        );

        $entities = elgg_get_entities($options);
        $siteaddress = elgg_get_site_url();
        $sitename = elgg_get_site_entity()->name;
        $site = get_entity($CONFIG->site_guid);
        $from = $site->email;

        foreach ($entities as $entity) {
                $name = $entity->name;
                $email = $entity->email;
                $message = sprintf(elgg_echo('sitecron:delete_message'), $name, $sitename, $sitename, $siteaddress);
                elgg_send_email($from, $email, elgg_echo('sitecron:delete_message:subject'), $message);
                $entity->delete();
                }
        access_show_hidden_entities(false);
        elgg_set_ignore_access(false);
        if ($entities){
        $result = elgg_echo("sitecron:sitecron_drop_unvalidated_cron_result_true");
        }else{
        $result = elgg_echo("sitecron:sitecron_drop_unvalidated_cron_result_false");
        }
        return $returnvalue.$result;
}
}

function sitecron_login_reminder_cron($hook, $entity_type, $returnvalue, $params) {

if (elgg_get_plugin_setting('reminder', 'sitecron') == "yes"){
global $CONFIG;
elgg_set_ignore_access(true);
$counter = elgg_get_plugin_setting('counter', 'sitecron');
$db_prefix = elgg_get_config('dbprefix');
$joins = array("JOIN {$db_prefix}users_entity u on e.guid = u.guid");
$login_time = elgg_get_plugin_setting('logintime', 'sitecron');
$time = strtotime($login_time);

$options = array(
	'types' => 'user',
	'limit' => 10,
	'full_view' => false,
	'pagination' => true,
	'joins' => $joins,
	'wheres' => "u.last_login < {$time}",
	'offset' => $counter,

        );

$entities = elgg_get_entities_from_metadata($options); 

if($entities){
$counter = $counter + 10;
elgg_set_plugin_setting('counter', $counter, 'sitecron');
}else{
elgg_set_plugin_setting('counter', '0', 'sitecron');
elgg_set_plugin_setting('reminder', 'no', 'sitecron');
}

$siteaddress = elgg_get_site_url();
$sitename = elgg_get_site_entity()->name;
$site = get_entity($CONFIG->site_guid);
$from = $site->email;

foreach ($entities as $entity) {
                $name = $entity->name;
                $email = $entity->email;
                $login = $entity->last_login;
if ($login == 0 ){
$login = elgg_echo('sitecron:notloggedin');
}else{
$login = date("dS F Y. h:i:s A", $login);
}
if ($email){
$message = sprintf(elgg_echo('sitecron:login_message'), $name, $login, $sitename, $siteaddress);
elgg_send_email($from, $email, elgg_echo('sitecron:login_message:subject'), $message);
$result .= $name." : ".$login."<br />";
}
}
elgg_set_ignore_access(false);
        $result .= elgg_echo("sitecron:sitecron_login_reminder_cron_true");
        return $returnvalue.$result;
}
        $result = elgg_echo("sitecron:sitecron_login_reminder_cron_false");
        return $returnvalue.$result;
}
