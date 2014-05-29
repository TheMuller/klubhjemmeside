<?php
/*Access manager plugin*/

$site = elgg_get_site_entity();

if($site->site_admin_guid == ''){

	$site->site_admin_guid = elgg_get_logged_in_user_guid();
}

?>