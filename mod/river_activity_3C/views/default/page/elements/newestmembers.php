<?php 
	/*
	 * 3 Column River Acitivity
	 *
	 * @package ElggRiverDash
	 * Full Creadit goes to ELGG Core Team for creating a beautiful social networking script
	 *
         * Modified by Satheesh PM, BARC, Mumbai, India..
         * http://satheesh.anushaktinagar.net
         *
	 * @author ColdTrick IT Solutions
	 * @copyright Coldtrick IT Solutions 2009
	 * @link http://www.coldtrick.com/
	 * @version 1.0
         *
         */

?>

    <?php
    $title = elgg_echo('river_activity_3C:newestmembers');
    $num = (int) elgg_get_plugin_setting('num_new', 'river_activity_3C');
    $box_view = elgg_get_plugin_setting('view_riverbox', 'river_activity_3C');

    $river_body = elgg_list_entities_from_metadata(array(
	//'metadata_names' => 'icontime',
	'types' => 'user',
	'limit' => $num,
	'full_view' => false,
	'pagination' => false,
	'list_type' => 'gallery',
	'gallery_class' => 'elgg-gallery-users',
	'size' => 'tiny',
        ));

    $river_body .= '<p style="text-align:right; margin:3px 3px;"><a href="'.$vars["url"].'members"><b>'.elgg_echo('river_activity_3C:viewmore').'</b></a></p>';
    echo elgg_view_module($box_view, $title, $river_body);
    ?>
    
