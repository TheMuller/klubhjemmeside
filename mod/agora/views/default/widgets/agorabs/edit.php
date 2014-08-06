<?php
/**
 * Elgg agora Classifieds plugin
 * @package Agora
 */

$num_display = $vars['entity']->num_display;
if($num_display == ''){
	$num_display = '5';
} 
?>

<p>
	<?php echo elgg_echo("agora:widget:num_display_items"); ?>:
	<select name="params[num_display]">
		<option value="1" <?php echo ($num_display == 1?"SELECTED":""); ?>>1</option>
		<option value="2" <?php echo ($num_display == 2?"SELECTED":""); ?>>2</option>
		<option value="3" <?php echo ($num_display == 3?"SELECTED":""); ?>>3</option>
		<option value="4" <?php echo ($num_display == 4?"SELECTED":""); ?>>4</option>
		<option value="5" <?php echo ($num_display == 5?"SELECTED":""); ?>>5</option>
		<option value="6" <?php echo ($num_display == 6?"SELECTED":""); ?>>6</option>
		<option value="7" <?php echo ($num_display == 7?"SELECTED":""); ?>>7</option>
		<option value="8" <?php echo ($num_display == 8?"SELECTED":""); ?>>8</option>
		<option value="9" <?php echo ($num_display == 9?"SELECTED":""); ?>>9</option>
		<option value="10" <?php echo ($num_display == 10?"SELECTED":""); ?>>10</option>
	</select>
</p>

