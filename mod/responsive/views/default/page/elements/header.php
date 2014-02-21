<?php
/**
 * Elgg page header
 * In the default theme, the header lives between the topbar and main content area.
 */

if (!elgg_is_logged_in()) {
?>

<div class="elgg-navbar">
    <div class="elgg-navbar-inner">
        <a class="elgg-button-nav" rel="toggle" href=".elgg-nav-collapse"><?php echo elgg_echo('responsive:navigation'); ?></a>
        <div class="divider-vertical"></div>
        <ul class="elgg-nav-collapse">   
            <?php echo elgg_view_menu('site'); ?>
            <ul><li><?php echo elgg_view('search/search_box', array('class' => 'elgg-search-header')); ?></li></ul>
        </ul><!-- /.elgg-nav-collapse -->
    </div><!-- /.elgg-navbar-inner -->
</div><!-- /.elgg-navbar -->

<?php

}

// link back to main site.
echo elgg_view('page/elements/header_logo', $vars);

// drop-down login
echo elgg_view('core/account/login_dropdown');

// insert site-wide navigation
echo elgg_view_menu('site');