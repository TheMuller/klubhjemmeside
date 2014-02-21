<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();

$showlogo = elgg_get_plugin_setting('showlogo', 'handheld');

if ($showlogo == 'yes'){

?>

<a href="<?php echo $site_url; ?>"><div class="elgg-logo"></div></a>

<?php } else { ?>

<h1>
	<a class="elgg-heading-site" href="<?php echo $site_url; ?>">
		<?php echo $site_name; ?>
	</a>
</h1>

<?php

}