<?php
/**
 *
 * Gianna settings
 * 
 */

$plugin = elgg_get_plugin_from_id('gianna');

	if (!isset($plugin->gianna_index)) { $plugin->gianna_index = 'gianna'; }
	if (!isset($plugin->background)) { $plugin->background = ''; }
	if (!isset($plugin->show_custom)) { $plugin->show_custom = 'no'; }
	if (!isset($plugin->show_favicon)) { $plugin->show_favicon = 'yes'; }
	if (!isset($plugin->show_friends)) { $plugin->show_friends = 'no'; }
	if (!isset($plugin->show_icon)) { $plugin->show_icon = 'yes'; }
	if (!isset($plugin->show_logo)) { $plugin->show_logo = 'yes'; }
	if (!isset($plugin->show_menu)) { $plugin->show_menu = 'yes'; }
	if (!isset($plugin->show_latest_groups)) { $plugin->show_latest_groups = 'no'; }	
	if (!isset($plugin->show_latest_members)) { $plugin->show_latest_members = 'no'; }
	if (!isset($plugin->show_reg_text)) { $plugin->show_reg_text = 'no'; }
	if (!isset($plugin->show_tagcloud)) { $plugin->show_tagcloud = 'no'; }
	if (!isset($plugin->show_thewire)) { $plugin->show_thewire = 'no'; }
	
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
			),
			array(
				'text' => elgg_echo('elggzone:tab:sidebar'),
				'href' => '#tab-sidebar',
			)
		)
	));
	
	// TAB GENERAL
	echo '<div id="tab-general">';

		echo "<div class=\"label\">" . elgg_echo('gianna:header:general') . "</div>";		
		echo "<div>" . elgg_echo('gianna:info:background') . "</div>";

		$img_url = "../../mod/gianna/graphics/backgrounds";
		$backgrounds = scandir($img_url);
		$selected = $plugin->background;
		$selected = explode(",", $selected);
		
		echo '<div>';
		echo elgg_echo('gianna:label:background');
		echo '<select id="select-context" class="elgg-input-select" multiple="multiple">';
        foreach ($backgrounds as $background) {
			if ($background != "." && $background != "..") {
				if (in_array($background, $selected)) {
					echo "<option selected=\"selected\" value=\"{$background}\">" . $background . "</option>";
				} else {
					echo "<option value=\"{$background}\">" . $background . "</option>";
				}
			}
        }
		echo '</select>';
		echo '</div>';
		echo "<div class=\"no\" id=\"target\"></div>";
		
		echo "<div>" . elgg_echo('gianna:info:registration') . "</div>";
				
		echo '<div class="item">';
		echo elgg_echo('gianna:label:show_reg_text');
		echo elgg_view('input/dropdown', array(
			'name' => 'params[show_reg_text]',
			'options_values' => array(
				'no' => elgg_echo('option:no'),
				'file' => elgg_echo('gianna:option:file'),
				'field' => elgg_echo('gianna:option:field')
			),
			'value' => $plugin->show_reg_text,
		));
		echo '</div>';
		
		echo '<div>';
		echo elgg_echo('gianna:label:text:reg');
		echo elgg_view('input/longtext', array(
			'name' => "params[reg_text]",
			'value' => $plugin->reg_text,
		));
		echo "</div>";
		
		echo '<div class="item">';
		echo elgg_echo('gianna:label:thewire');
		echo elgg_view('input/dropdown', array(
			'name' => 'params[show_thewire]',
			'options_values' => array(
				'no' => elgg_echo('option:no'),
				'yes' => elgg_echo('option:yes')
				),
			'value' => $plugin->show_thewire,
		));
		echo '</div>';
		
		echo "<div>" . elgg_echo('gianna:info:logo') . "</div>";
		
		echo '<div class="item">';
		echo elgg_echo('gianna:label:logo');
		echo elgg_view('input/dropdown', array(
			'name' => 'params[show_logo]',
			'options_values' => array(
				'no' => elgg_echo('option:no'),
				'yes' => elgg_echo('option:yes')
				),
			'value' => $plugin->show_logo,
		));
		echo '</div>';
		
		echo '<div class="item">';
		echo elgg_echo('gianna:label:favicon');
		echo elgg_view('input/dropdown', array(
			'name' => 'params[show_favicon]',
			'options_values' => array(
				'no' => elgg_echo('option:no'),
				'yes' => elgg_echo('option:yes')
				),
			'value' => $plugin->show_favicon,
		));
		echo '</div>';
		
		echo elgg_view('input/submit', array('value' => elgg_echo("save")));
		
	echo '</div>';
	
	// TAB FRONTPAGE
	echo '<div id="tab-frontpage">';
	
		echo "<div class=\"label\">" . elgg_echo('gianna:header:frontpage') . "</div>";

		echo "<div>" . elgg_echo('gianna:info:index') . $status . "</div>";
		echo "<div>" . elgg_echo('gianna:info:index:two') . "</div>";
			
		echo '<div class="item">';
		echo elgg_echo('gianna:label:index');
		echo elgg_view('input/dropdown', array(
			'name' => 'params[gianna_index]',
			'options_values' => array(
				'dashboard' => elgg_echo('gianna:option:activity'),
				'gianna' => elgg_echo('gianna:option:gianna')
			),
			'value' => $plugin->gianna_index,
		));
		echo '</div>';
		
		echo elgg_view('input/submit', array('value' => elgg_echo("save")));
		
	echo '</div>';

	// TAB SIDEBAR
	echo '<div id="tab-sidebar">';
	
		echo "<div class=\"label\">" . elgg_echo('gianna:header:sidebar') . "</div>";
		echo "<div>" . elgg_echo('gianna:info:modules') . "</div>";
		
		$options = array('show_icon', 'show_menu', 'show_latest_members', 'show_latest_groups', 'show_custom', 'show_tagcloud', 'show_friends');
		foreach ($options as $dropdown) {
			echo '<div class="item">';
			echo elgg_view('input/dropdown', array(
				'name' => "params[$dropdown]",
				'options_values' => array(
					'no' => elgg_echo('option:no'),
					'yes' => elgg_echo('option:yes')
				),
				'value' => $plugin->$dropdown,
			));
			echo ' ' . elgg_echo("gianna:label:$dropdown");
			echo '</div>';
		}
		
		echo elgg_view('input/submit', array('value' => elgg_echo("save")));
		
	echo '</div>';
		
echo "</div>"; // #elggzone-tabs

echo "<div class=\"ez-result\"></div>";
	