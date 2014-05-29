<?php
/*Access manager plugin*/
$actions = get_input('selected_objects');
$plugin_id = get_input('plugin_id');
$plugin = elgg_get_plugin_from_id($plugin_id);
$plugin->setSetting('selected_objects',serialize($actions));
$plugin->setSetting('super_admin_guid',get_input('super_admin_guid'));

?>