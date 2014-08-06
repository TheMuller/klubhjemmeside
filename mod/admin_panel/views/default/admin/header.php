<?php
/**
 * Elgg admin header
 */
 
$admin_title = elgg_get_site_entity()->name . ' ' . elgg_echo('admin');
$viewer = elgg_get_logged_in_user_entity();

$admin = elgg_view('output/url', array(
	'href' => false,
	'text' => elgg_view('output/img', array(
		'src' => $viewer->getIconURL('topbar'),
		'alt' => $viewer->name,
		'title' => elgg_echo('admin:loggedin', array(elgg_get_logged_in_user_entity()->name)),
		'class' => 'elgg-border-plain elgg-transition',
	)),
	'is_trusted' => true,
));

$view_site = elgg_view('output/url', array(
	'href' => elgg_get_site_url(),
	'text' => false,
	'title' => elgg_echo('admin:view_site'),
	'class' => 'fa fa-home fa-2x',
	'is_trusted' => true,
));
$logout = elgg_view('output/url', array(
	'href' => 'action/logout',
	'text' => false,
	'title' => elgg_echo('logout'),
	'class' => 'fa fa-sign-out fa-2x',
	'is_trusted' => true,
));

?>

<h1 class="elgg-heading-site">
	<a href="<?php echo elgg_get_site_url(); ?>admin">
		<?php echo $admin_title; ?>
	</a>
</h1>
<ul class="elgg-menu-user">
	<li><?php echo $admin; ?></li>
	<li><?php echo $view_site; ?></li>
	<li><?php echo $logout; ?></li>
	<li class="elgg-menu-button">
		<a rel="toggle" href=".elgg-admin-nav-collapse" title="<?php echo elgg_echo('menu'); ?>">
			<i class="fa fa-bars fa-2x"></i>
		</a>
	</li>
</ul>