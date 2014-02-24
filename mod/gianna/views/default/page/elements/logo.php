<?php 
/**
 * Logo module
 *
 */

$plugin = elgg_get_plugin_from_id('gianna');

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
$logo_url = $site_url . "mod/gianna/graphics/logo-index.png";

$class = elgg_extract('class', $vars, '');

if ($plugin->show_logo == 'yes'){

?>

<div class='index-logo <?php echo $class; ?>'><a href="<?php echo $site_url; ?>"><img src="<?php echo $logo_url; ?>" alt="<?php echo $site_name; ?>" /></a></div>

<?php } else { ?>

<div class='index-logo index-logo-text <?php echo $class; ?>'>
    <h1><a href="<?php echo $site_url; ?>"><?php echo $site_name; ?></a></h1>
    <h2><?php echo $site_desc; ?></h2>
</div>

<?php

}
