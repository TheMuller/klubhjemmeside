<?php 
/**
 * Group entity view
 * 
 * @package ElggGroups
 */
    
$group = $vars['entity'];
    if($group->group_paid_flag =='yes'){
        $user = elgg_get_logged_in_user_entity ();
        if(!($user  instanceof  ElggUser) or $user->isAdmin() )return;//
        $last_dates = unserialize($user->last_dates);
        if($last_dates){
            $last_date = $last_dates[$group->guid];
            if($last_date and $last_date !=''){
                echo elgg_echo("paidgroup:membership:lastdate",array($last_date));
                
            }
        }
    }
