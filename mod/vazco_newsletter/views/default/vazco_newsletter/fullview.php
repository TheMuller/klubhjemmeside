<?php //ł ?><?php
//show full view of a newsletter
	global $CONFIG;
	$entity = $vars['entity'];
	$title = elgg_translate($entity,'name');
	$newsletter_body = elgg_translate($entity,'body');
	$date = $entity->date;
	$date_ts = $entity->date_ts;
	$icon = $entity->getIcon('small');
	$isSent = $entity->isSent;
	$testsend = ' <a href="'.elgg_add_action_tokens_to_url($CONFIG->wwwroot.'action/newsletter/testsend?guid='
	.get_loggedin_userid()).'&newsletter='.$entity->guid.'">'.elgg_echo('vazco_newsletter:test_send').'</a>';
?>
<div class='contentWrapper testsend'>
	<?php echo $testsend;?>
</div>
<div class="contentWrapper output_form" >
	<div class='image'>
		<img src="<?php echo $icon;?>" title="<?php echo $title;?>"/>
	</div>
	<div class="date">
		<div class="field_header"><?php echo elgg_echo('vazco_newsletter:date');?>:</div>
		<?php echo $date;?>
	</div>
	<?php /*
	<div class="date">
		<div class="field_header"><?php echo elgg_echo('vazco_newsletter:date_ts');?>:</div>
		<?php echo date('d m Y',$date_ts);?>
	</div>
	*/?>
	<div class="isSent">
		<div class="field_header"><?php echo elgg_echo('vazco_newsletter:issent');?>:</div>
		<?php echo ($isSent==true?'TRUE':'FALSE');?>
	</div>

	<div class="description">
		<div class="field_header"><?php echo elgg_echo('vazco_newsletter:body');?>:</div>
		<div><?php echo $newsletter_body;?></div>
	</div>
</div>