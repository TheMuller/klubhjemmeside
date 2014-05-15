<?php
/**
 * Gianna page header
 * Display Gianna logo when needed
 */

echo elgg_view_menu('navbar', array('sort_by' => 'priority'));
?>

<div class="elgg-navbar">
    <div class="elgg-navbar-inner">
        <div class="divider-vertical"></div>
        <a class="elgg-button-nav" rel="toggle" href=".elgg-nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </a>
        <ul class="elgg-nav-collapse">
            <?php echo elgg_view_menu('site'); ?>
        </ul><!-- /.elgg-nav-collapse -->
    </div><!-- /.elgg-navbar-inner -->
</div><!-- /.elgg-navbar -->

<?php

$plugin = elgg_get_plugin_from_id('gianna');

if (($plugin->gianna_index == 'gianna' && elgg_get_context() == 'main') || elgg_get_context() == 'forgotpassword') {
	echo elgg_view('page/elements/logo', array('class' => 'logo-context'));
} else {
	echo elgg_view('page/elements/logo');
}

echo elgg_view_menu('site');
?>