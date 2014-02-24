<?php
/**
 * Navigation
 *
 */
 
$site = elgg_get_site_entity();
$register = elgg_echo('gianna:register:front', array($site->name));
$index = elgg_echo('gianna:register:back');

?>


<ul class="elgg-menu-navigation">
	<?php
	if (elgg_get_config('allow_registration') && (elgg_get_context() == 'main' || elgg_get_context() == 'front')) {
		echo '<li><a class="elgg-button elgg-button-register" href="' . elgg_get_site_url() . 'register">' . elgg_echo('gianna:signup') . '</a></li>';

	?>
	<li class="signup"><h2><?php echo $register; ?></h2></li>
	<?php } else { ?>
	<?php

		echo '<li><a class="elgg-button elgg-button-register" href="' . elgg_get_site_url() . '">' . elgg_echo('gianna:index') . '</a></li>';

	?>
	<li class="signup"><h2><?php echo $index; ?></h2></li>
	<?php } ?>	
</ul>

