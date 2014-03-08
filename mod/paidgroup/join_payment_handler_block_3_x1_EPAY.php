<?php

include('../../engine/start.php');


$Group_paid_price=$_GET['p'];
$CurrUser= get_entity($_GET['u']);
    $group_guid = $_GET['g'];
$order_id = $_GET['o'];
$ia = elgg_set_ignore_access(true);
$group=get_entity($group_guid);

/*
    if($group->group_period_type =='duration'){
        $GRPS = $group->group_paid_price * $group->group_paid_LockedPeriod;
    }elseif($group->group_price_type == 'fixed'){
        $GRPS = $group->group_paid_price;
    }else{
        $end_date = strtotime($group->group_paid_MembershipEnd);
        $daystopay = ceil(($end_date-time())/(24*60*60));
        $GRPS = $group->group_paid_price * $daystopay;
    }
    if($Group_paid_price - $GRPS ) > 100){
        //there is some fraud happening now.
    }
*/
    $last_dates = unserialize($CurrUser->last_dates);
    $last_orders = unserialize($CurrUser->last_orders);
    
if($_POST['status']){
        ini_set('log_errors', true);
        ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');
        error_log("group_guid=".$group_guid);
        error_log($last_orders[$group_guid]."-order_id-".$order_id);
        error_log("status=".$_POST['status']);
        if($_POST['status'] !='ACCEPTED'){
            exit(0);
        }
}
if($last_orders[$group_guid] ==$order_id){
        if($_POST['status']){
            error_log("orderid already processed");
            exit(0);
        }else{
            system_message("orderid processed");
            forward($group->getURL());
        }
        
}else{
        //exit(0);
    $last_orders[$group_guid] =$order_id;
    
        
    if (!$last_dates[$group_guid] || $last_dates[$group_guid] ==''){
        $last_dates[$group_guid] = date('Y-m-d H:i');
    }

    
    if($group->group_period_type =='duration'){
        $cmd= "+".$group->group_paid_LockedPeriod." month";
        $last_dates[$group_guid] = date('Y-m-d H:i',strtotime($cmd,strtotime($last_dates[$group_guid])));
    }else{
        $last_dates[$group_guid] = $group->group_paid_MembershipEnd;
    }
    

                  
    //$last_dates = unserialize($CurrUser->last_dates);
   // system_message($last_dates[$group_guid] );
    notify_user($CurrUser->getGUID(), $group->getOwnerGUID(),elgg_echo('paidgroup:invoice:email:subject'), elgg_echo('paidgroup:invoice:email:body',array($CurrUser->name,$group->name)));                  
    if($group->isMember($user)){
         forward(elgg_get_site_url().'groups/profile/'.$group->guid);
    }else{
        $join = false;
        if ($group->isPublicMembership() || $group->canEdit($CurrUser->guid)) {
            // anyone can join public groups and admins can join any group
            $join = true;
        } else {
            if (check_entity_relationship($group->guid, 'invited', $CurrUser->guid)) {
                // user has invite to closed group
                $join = true;
            }
        }
        
        if ($join) {
            if (groups_join_group($group, $CurrUser)) {
                system_message(elgg_echo("groups:joined"));
            } else {
                register_error(elgg_echo("groups:cantjoin"));
            }
        } else {
            add_entity_relationship($CurrUser->guid, 'membership_request', $group->guid);
            system_message(elgg_echo("groups:joinrequestmade"));
        }
if(!$_POST['status']){
        forward($group->getURL());
}
    }
$CurrUser->last_orders = serialize($last_orders);
    $CurrUser->last_dates = serialize($last_dates);
if($_POST['status']){
 
        error_log("filial");

}
}
elgg_set_ignore_access($ia);

    
//``````````````````````````````````````````````````````````````````````````````````````````````````
//	... ~>
/**
▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌▌
**/
?>