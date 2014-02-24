<?php
/**
 * Optionspanel wrapper
 */

echo "<div class=\"elggzone-options-panel\">";
	echo "<div class=\"elggzone-holder\">";
		echo "<div class=\"panel-header\">" . elgg_echo('elggzone:panel') . "</div>";
		echo "<div class=\"panel-line\"></div>";
		echo elgg_view_form('gianna/admin/settings', array('class' => 'settings-optionspanel', 'name' => 'ez-options-panel'));
	echo "</div>";
echo "</div>";
