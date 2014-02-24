<?php
/**
 * Walled Garden layout
 *
 * @uses $vars['content'] Main content
 * @uses $vars['class']   CSS classes
 * @uses $vars['id']      CSS id
 */

$class = elgg_extract('class', $vars, 'elgg-walledgarden-single');
echo elgg_view_module('walled', '', $vars['content'], array(
	'class' => $class,
	'id' => elgg_extract('id', $vars, ''),
	'header' => ' ',
	'footer' => ' ',
));

if (elgg_get_context() == 'main') {

	$class = 'elgg-layout elgg-layout-one-column clearfix';
	if (isset($vars['class'])) {
		$class = "$class {$vars['class']}";
	}
	$mod_params = array('class' => 'elgg-module-index');
	
	?>
	
	<div class="<?php echo $class; ?>">
		<div class="elgg-main elgg-body">
			<div class="ez-content">
			<?php
			if (!elgg_is_logged_in()) {
				$top_box .= elgg_view('core/account/login_box');
			}
			echo elgg_view('page/elements/logo');
			echo elgg_view_module('featured',  '', $top_box, $mod_params);
			?>
			</div>
			
<!--			<div class="ez-content">
			<?php
			//$title = elgg_echo("gianna:custom:title"); 
			//$text = elgg_echo("gianna:custom:text");
			//$info = elgg_echo("gianna:info"); 
			//$module = elgg_view_module('aside', $info, $text);
			
			//echo elgg_view_module('featured', '', $module, $mod_params);
			?>
			</div>-->
			
		</div>
	</div>


<?php

}
