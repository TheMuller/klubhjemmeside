<?php //ł ?><?php
	$settings = $vars['entity']; 

	// set default value if user hasn't set it yet
	$param1 = $settings->param1;
	if (!isset($param1)){
		$param1 = 10;
	}
	//make sure the boolean parameter always has value
	if (!isset($param2)){
		$param2 = 'no';
	}
?>
<div>
	<?php 
		echo elgg_echo('vazco_newsletter:settings:param1'); 
		
		echo elgg_view('input/pulldown', array(
				'internalname' => 'params[param1]',
				'options_values' => array(	'10' => '10',
											'20' => '20',
											'30' => '30',
											'50' => '50',
											'100' => '100',
										),
				'value' => $param
			));
	?>
</div>
<div>
	<span><?php echo elgg_echo('vazco_newsletter:settings:param2'); ?></span>
	<select name="params[param2]">
        <option value="yes" <?php if ($settings->param2 == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
        <option value="no" <?php if ($settings->param2 == 'no') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
    </select> 
</div>
<div>
	<span><?php echo elgg_echo('vazco_newsletter:settings:param3'); ?></span>
	<?php echo elgg_view('input/text', array('internalname' => 'params[param3]','class' => ' ', 'value' => $settings->param3)); ?>
</div>