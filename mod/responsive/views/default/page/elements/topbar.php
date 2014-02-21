<?php

/**
 * Elgg responsive topbar
 * 
 */

?>

<?php echo elgg_view_menu('topbar', array('sort_by' => 'priority', array('elgg-menu-hz'))); ?>

<div class="elgg-navbar">
    <div class="elgg-navbar-inner">
        <a class="elgg-button-nav" rel="toggle" href=".elgg-nav-collapse"><?php echo elgg_echo('responsive:navigation'); ?></a>
        <div class="divider-vertical"></div>
        <ul class="elgg-nav-collapse">   
            <?php echo elgg_view_menu('site'); ?>
            <?php echo elgg_view_menu('topbar', array('sort_by' => 'priority', array('elgg-menu-hz'))); ?>
            <ul><li><?php echo elgg_view('search/search_box', array('class' => 'elgg-search-header')); ?></li></ul>
        </ul><!-- /.elgg-nav-collapse -->
    </div><!-- /.elgg-navbar-inner -->
</div><!-- /.elgg-navbar -->

