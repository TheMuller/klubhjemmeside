<?php 
/**
 * Group entity view
 * 
 * @package ElggGroups
 */
$entity = $vars['entity'];
if(elgg_get_context() =='groups'){
    
    $group_guid = elgg_get_page_owner_guid();
    $group = get_entity($group_guid);
    if($group->canEdit($entity->guid))return;

    $last_dates = unserialize($entity->last_dates);
    
    $last_date = $last_dates[$group_guid];
    if(!$last_date or $last_date ==''){
        echo "<div style='float:right;'>".elgg_echo('inactive')."</div>";
    }
    //echo $group->guid;
}