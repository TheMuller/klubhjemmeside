<?php
/*
 *
 * Handheld settings
 *
 * @package handheld
 * @author Per Jensen - Elggzone
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright Copyright (c) 2013, Per Jensen
 *
 * @link http://www.perjensen-online.dk/
 *
 */

	$plugin = elgg_get_plugin_from_id('handheld');

	if (!isset($plugin->active_theme)) {
		$plugin->active_theme = 'default';
	}
	if (!isset($plugin->show_thewire)) {
		$plugin->show_thewire = 'no';
	}
	if (!isset($plugin->header_color)) {
		$plugin->header_color = '';
	}
	if (!isset($plugin->showlogo)) {
		$plugin->showlogo = 'no';
	}
	if (!isset($plugin->teaserstring)) {
		$plugin->teaserstring = 'lang';
	}
	if (!isset($plugin->teaseroutput)) {
		$plugin->teaseroutput = $teaseroutput;
	}

echo "<div id=\"elggzone-tabs\">";	
	echo elgg_view('navigation/tabs', array(
		'tabs' => array(
			array(
				'text' => elgg_echo('elggzone:tab:general'),
				'href' => '#tab-general',
			),
			array(
				'text' => elgg_echo('elggzone:tab:frontpage'),
				'href' => '#tab-frontpage',
			)
		)
	));
	
	// TAB GENERAL
	echo '<div id="tab-general">';
	
		echo "<div class=\"label\">" . elgg_echo('handheld:header:general') . "</div>";

		echo '<div class="item">';
		echo elgg_echo('handheld:label:theme');
		echo elgg_view('input/dropdown', array(
			'name' => 'params[active_theme]',
			'options_values' => array(
				'default' => elgg_echo('handheld:option:default'),
				'blue' => elgg_echo('handheld:option:blue')
				),
			'value' => $plugin->active_theme,
		));
		echo '</div>';
			
		echo '<div class="item">';
		echo elgg_echo('handheld:label:thewire');
		echo elgg_view('input/dropdown', array(
			'name' => 'params[show_thewire]',
			'options_values' => array(
				'no' => elgg_echo('option:no'),
				'yes' => elgg_echo('option:yes')
				),
			'value' => $plugin->show_thewire,
		));
		echo '</div>';
		
		echo "<div>" . elgg_echo('handheld:info:logo') . "</div>";
		
		echo '<div class="item">';
		echo elgg_echo('handheld:label:logo');
		echo ' ';
		echo elgg_view('input/dropdown', array(
			'name' => 'params[showlogo]',
			'options_values' => array(
				'no' => elgg_echo('option:no'),
				'yes' => elgg_echo('option:yes')
				),
			'value' => $plugin->showlogo,
		));
		echo '</div>';
		
		echo elgg_view('input/submit', array('value' => elgg_echo("save")));
		
	echo '</div>';
	
	// TAB FRONTPAGE
	echo '<div id="tab-frontpage">';
	
		echo "<div class=\"label\">" . elgg_echo('handheld:header:frontpage') . "</div>";
	
		echo '<div class="item">';
		echo elgg_echo('handheld:label:teaser');
		echo elgg_view('input/dropdown', array(
			'name' => 'params[teaserstring]',
			'options_values' => array(
				'lang' => elgg_echo('handheld:option:lang'),
				'field' => elgg_echo('handheld:option:field'),
				'none' => elgg_echo('handheld:option:none')
				),
			'value' => $plugin->teaserstring,
		));
		echo '</div>';
				
		echo '<div>';
			echo elgg_echo('handheld:label:textfield');
			echo elgg_view('input/text',array('name' => 'params[teaseroutput]','value' => $plugin->teaseroutput));
		echo '</div>';
		
		echo elgg_view('input/submit', array('value' => elgg_echo("save")));
		
	echo '</div>';
		
echo "</div>"; // #elggzone-tabs

echo "<div class=\"ez-result\"></div>";
	