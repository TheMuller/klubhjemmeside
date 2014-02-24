<?php
/**
 * Displays the default shortcut icon
 */

$plugin = elgg_get_plugin_from_id('gianna');

if ($plugin->show_favicon == 'yes'){
	
?>

<link rel="SHORTCUT ICON" href="<?php echo elgg_get_site_url(); ?>mod/gianna/graphics/favicon.ico" />

<?php

}