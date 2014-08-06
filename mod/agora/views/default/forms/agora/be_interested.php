<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

$recipient_guid = elgg_extract('recipient_guid', $vars, 0);
$subject = elgg_extract('subject', $vars, '');
$body = elgg_extract('body', $vars, '');
$classified_guid = elgg_extract('classified_guid', $vars, '');

?>


<div>
	<label><?php echo elgg_echo("messages:message"); ?>:</label>
	<?php echo elgg_view("input/plaintext", array(
		'name' => 'body',
		'value' => $body,
		'class' => 'beinterested'
	));
	?>
</div>
<div class="elgg-foot">
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('messages:send'))); ?>
</div>

<div>
	<?php echo elgg_view('input/hidden', array('name' => 'subject','value' => $subject,));?>
	<?php echo elgg_view('input/hidden', array('name' => 'recipient_guid','value' => $recipient_guid,));?>
	<?php echo elgg_view('input/hidden', array('name' => 'classified_guid','value' => $classified_guid,));?>
</div>
