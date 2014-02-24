<?php 
/**
 * Group entity view
 * 
 * @package ElggGroups
 */
$group = $vars['entity'];
if($vars['paid_view']   == true){
    echo "<div class='group-gallery-item-header'>";
    echo "&nbsp&nbsp";
    echo $group->name;
    echo "</div>";    

    echo "<div style='float:right;width:70px;'>";
    $url = elgg_get_site_url() . "action/groups/join?group_guid={$group->getGUID()}";
    $url = elgg_add_action_tokens_to_url($url);
    echo elgg_view("output/url", array(
                                       "href" => $url,
                                       "text" => elgg_echo('Join'),
                                       "is_trusted" => true,
                                       "class" => "elgg-button elgg-button-submit",
                                       "style" =>"float:right;",
                                       ));
    echo "<div >Members</div>";
    echo "<div >".$group->getMembers(0, 0, TRUE)."</div>";
    echo "<div >";
    $membership = $group->membership;
	if ($membership == ACCESS_PUBLIC) {
		echo elgg_echo("open");
	} else {
		echo elgg_echo("closed");
	}
    echo "</div>";
    
    echo "</div>";
    
    echo "<div class='group-gallery-item-img'>";
    echo    elgg_view('output/img', array(
                                          'src' => $group->getIconURL('large'),
                                          'width' => "150px",
                                          'height' => "150px",
                                          ));
    echo "<p>".$group->briefdescription."</p>";
    echo "</div>";
    
    
  
    echo "<div class='group-gallery-item-footer'>";
    if($group->group_paid_flag =='yes'   ){
        echo "&nbsp&nbsp";
        if($group->group_period_type =='duration'){
            $GRPS = $group->group_paid_price * $group->group_paid_LockedPeriod;
            if($GRPS <=0)$GRPS=0;
            echo $GRPS." DKK for ".$group->group_paid_LockedPeriod." month";
            if($group->group_paid_LockedPeriod >1) echo "s";
        }else{
            if($group->group_price_type == 'fixed'){
                $GRPS = $group->group_paid_price;
            }else{
                $end_date = strtotime($group->group_paid_MembershipEnd);
                $daystopay = ceil(($end_date-time())/(24*60*60));
                $GRPS = $group->group_paid_price * $daystopay;
            }
            if($GRPS <=0)$GRPS=0;
            echo $GRPS." DKK till ".$group->group_paid_MembershipEnd;
        }
    }
    echo "</div >";

}else{
    include elgg_get_plugins_path() ."groups/views/default/group/default.php";
}