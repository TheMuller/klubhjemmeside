<?php
/**
 * Walled garden page shell
 *
 * Used for the walled garden index page
 */

// render content before head so that JavaScript and CSS can be loaded. See #4032
$topbar = elgg_view('page/elements/topbar', $vars);
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$gianna_header = elgg_view('page/elements/gianna_header', $vars);
$header = elgg_view('page/elements/header', $vars);
$body = elgg_view('page/elements/body', $vars);
$navigation = elgg_view('page/elements/navigation', $vars);
$footer = elgg_view('page/elements/footer', $vars);

// Set the content type
header("Content-type: text/html; charset=UTF-8");

$lang = get_current_language();

$selected = array('main', 'register', 'forgotpassword');
$context = elgg_get_context();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang; ?>" lang="<?php echo $lang; ?>">
<head>
<?php echo elgg_view('page/elements/head', $vars); ?>
</head>
<body>
<div class="elgg-page elgg-page-default">
	<div class="elgg-page-messages">
		<?php echo $messages; ?>
	</div>
	
	<?php if (elgg_is_logged_in()){ ?>
	<div class="elgg-page-topbar">
		<div class="elgg-inner">
			<?php echo $topbar; ?>
		</div>
	</div>
	<?php } ?>
	<?php if (!elgg_is_logged_in() && in_array($context, $selected)){ ?>
		<div class="gianna-header">
			<div class="elgg-inner">
				<?php echo $gianna_header; ?>
			</div>
		</div>	
		<div class="gianna-index">
			<div class="elgg-inner">
				<?php echo $body; ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="elgg-page-header">
			<div class="elgg-inner">
				<?php echo $header; ?>
			</div>
		</div>	
		<div class="elgg-page-body">
			<div class="elgg-inner">
				<?php echo $body; ?>
			</div>
		</div>
	<?php } ?>
	<?php if (!elgg_is_logged_in()){ ?>
		<div class="gianna-navigation">
			<div class="elgg-inner">
				<?php echo $navigation; ?>
			</div>
		</div>
	<?php } ?>
	<div class="elgg-page-footer">
		<div class="elgg-inner">
			<?php echo $footer; ?>
		</div>
	</div>
</div>
<?php echo elgg_view('page/elements/foot'); ?>
</body>
</html>