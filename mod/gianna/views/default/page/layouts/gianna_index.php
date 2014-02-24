<?php
/**
 *
 * Index layout
 *
 */

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
			$top_box .= $vars['login'];
		}
		echo elgg_view('page/elements/logo');
		echo elgg_view_module('featured',  '', $top_box, $mod_params);
		?>
		</div>
	</div>
</div>
