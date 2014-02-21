<?php
$key = $vars['entity']->apiKey;
?>

<div>
	<?php echo elgg_echo('worldweatheronline:plugin_settings:apiKey'); ?>
	
	<?php
		echo elgg_view('input/text', array('name' => 'params[apiKey]','value' => $key));
	?>
</div>
