<?php
/**
 * Elgg login form
 *
 * @package Elgg
 * @subpackage Core
 */
$plugin = elgg_get_plugin_from_id('gianna');
?>

<div>
	<label><?php echo elgg_echo('loginusername'); ?></label>
	<?php echo elgg_view('input/text', array(
		'name' => 'username',
		'class' => 'elgg-autofocus',
		));
	?>
</div>
<div>
	<label><?php echo elgg_echo('password'); ?></label>
	<?php echo elgg_view('input/password', array('name' => 'password')); ?>
</div>

<?php echo elgg_view('login/extend', $vars); ?>

<div class="elgg-foot">
	<label class="mtm float">
		<input type="checkbox" name="persistent" value="true" />
		<?php echo elgg_echo('user:persistent'); ?>
	</label>
	
	<div><?php echo elgg_view('input/submit', array('value' => elgg_echo('gianna:signin:button'))); ?></div>
	
	<?php 
	if (isset($vars['returntoreferer'])) {
		echo elgg_view('input/hidden', array('name' => 'returntoreferer', 'value' => 'true'));
	}
	?>
	<ul class="elgg-menu elgg-menu-general mtm">
		<li><span>&bull;</span><a class="forgot_link" href="<?php echo elgg_get_site_url(); ?>forgotpassword">
			<?php echo elgg_echo('user:password:lost'); ?>
		</a></li>
		<?php
			if (elgg_get_config('allow_registration') && $plugin->gianna_index != 'gianna') {
				echo '<li><a class="registration_link" href="' . elgg_get_site_url() . 'register">' . elgg_echo('register') . '</a></li>';
			}
		?>
	</ul>

</div>
