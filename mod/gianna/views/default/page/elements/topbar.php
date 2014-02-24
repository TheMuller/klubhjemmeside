<?php

/**
 * Elgg responsive topbar
 * 
 */

?>

<?php echo elgg_view_menu('navbar', array('sort_by' => 'priority')); ?>
<?php echo elgg_view_menu('topbar', array('sort_by' => 'priority', array('elgg-menu-hz'))); ?>

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
            <?php echo elgg_view_menu('topbar', array('sort_by' => 'priority', array('elgg-menu-hz'))); ?>
        </ul><!-- /.elgg-nav-collapse -->
    </div><!-- /.elgg-navbar-inner -->
</div><!-- /.elgg-navbar -->

