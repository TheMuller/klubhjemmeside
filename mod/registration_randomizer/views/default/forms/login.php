<?php
/**
 * Elgg login form
 *
 * @package Elgg
 * @subpackage Core
 */
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

<div class="elgg-foot" style="margin-bottom:0px;padding-bottom:0px">
	<label class="mtm float-alt">
		<input type="checkbox" name="persistent" value="true" />
		<?php echo elgg_echo('user:persistent'); ?>
	</label>
	
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('login'))); ?>
	
	<?php 
	if (isset($vars['returntoreferer'])) {
		echo elgg_view('input/hidden', array('name' => 'returntoreferer', 'value' => 'true'));
	}
	?>

	<ul class="elgg-menu mtm">
		<li><a class="forgot_link" href="<?php echo elgg_get_site_url(); ?>forgotpassword">
			<?php echo elgg_echo('user:password:lost'); ?>
		</a></li>
	<?php
		if (elgg_get_config('allow_registration')) {
			echo '<li style="margin-top:15px;font-weight:bold;padding-left:5px;">';
			echo elgg_view('output/url', array(
				'href' => '/register',
				'text' => elgg_echo('register'),
				'class' => 'registration_link'
			));
			echo '</li>';
		}
	?>

	</ul>
</div>
