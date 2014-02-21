<?php
global $CONFIG;

$user = get_loggedin_user();

?>

<p>
	<label style="font-weight: normal;"><?php echo elgg_echo('vazco_newsletter:settings:subscription'); ?></label>
	<?php 
		echo elgg_view('input/pulldown',array('internalname'=>'params[isSubscribedNewsletter]',
											  'options_values' => array(
																		true => elgg_echo('vazco_newsletter:yes'),		
																		false => elgg_echo('vazco_newsletter:no'),		
																		),
											  'value' => $user->isSubscribedNewsletter
											));
	?>
</p>

