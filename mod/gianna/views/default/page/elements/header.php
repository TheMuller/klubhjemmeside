<?php
/**
 * Elgg page header
 * In the default theme, the header lives between the topbar and main content area.
 */

if (!elgg_is_logged_in()){
	echo elgg_view('page/elements/logo', array('class' => 'logo-context'));
}

if (elgg_is_logged_in()){
	echo elgg_view_menu('site');
}
