<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

$interest_guid = elgg_extract('interest_guid', $vars, FALSE);
?>

<div class="elgg-foot">
<?php
	echo elgg_view('input/hidden', array('name' => 'interest_guid', 'value' => $interest_guid));
    echo elgg_view('input/submit', array('value' => elgg_echo('agora:interest:reject')));
?>
</div>
