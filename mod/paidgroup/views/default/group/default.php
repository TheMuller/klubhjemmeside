

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
	$group_path =  elgg_get_site_url()."groups/profile/".$group->getGUID()."/".$group->name;
	echo elgg_view("output/url", array(
                                       "href" => $group_path,
                                       "text" => elgg_echo($group->name),
                                       "style" =>"color:grey;",
                                       ));
	
    $url = elgg_get_site_url() . "action/groups/join?group_guid={$group->getGUID()}";
    $url = elgg_add_action_tokens_to_url($url);
	$user = elgg_get_logged_in_user_entity();

	$showjoinbutton = true;
    if($group->isMember($user)){
		$showjoinbutton = false;
        if($group->group_paid_flag =='yes'   ){
            if($last_dates and ($group->group_paid_flag =='yes')){
                $last_date = $last_dates[$group->guid];
                if(!$last_date or $last_date ==''){
                    $showjoinbutton = true;
                }
            }
        }
    }
	if($showjoinbutton == true){
			echo elgg_view("output/url", array(
                                       "href" => $url,
                                       "text" => elgg_echo('Join'),
                                       "is_trusted" => true,
                                       "class" => "joinButton",
                                       "style" =>"float:right;height:13px;",
                                       ));
	}
    echo "</div>";
    echo "<div class='group-gallery-item-img'>";
    echo    elgg_view('output/img', array(
                                          'src' => $group->getIconURL('large'),
                                          'width' => "225px",
                                          'height' => "150px",
                                          ));
    echo "<p>".$group->briefdescription."</p>";
    echo "</div>";
	
    echo "<div class='group-gallery-item-footer'>";
	echo "<ul class='elgg-menu elgg-menu-hz' style='line-height: fixed;'>";
    //$membercount =  $group->getMembers(0, 0, TRUE);
    $membercount =  group_get_getActiveMembers($group)."&nbsp;member";
    echo "&nbsp;&nbsp;&nbsp;<li class='tooltip1' data-tooltip1='".$membercount."' style='width:60px;float: right;'>";
    echo "<span>".$membercount."</span>";
    $membership = $group->membership;
    echo "</li >";
    if ($membership == ACCESS_PUBLIC) {
		$accessstring =  elgg_echo("open");
        $accesslongstring = "Aproval is not needed";
	} else {
		 $accessstring =  elgg_echo("closed");
        $accesslongstring = "Need Aproval";
	}
    echo "<li class='tooltip' data-tooltip='$accesslongstring' style='float:left;width:40px;'>";
    echo "<span>".$accessstring."</span>";
    echo "</li>";

    echo "</ul >";
    if($group->group_paid_flag =='yes'   ){
        
        if($group->group_period_type =='duration'){
            $GRPS = $group->group_paid_price * $group->group_paid_LockedPeriod;
            if($GRPS <=0)$GRPS=0;
            echo "<div style='clear:both;'>".$GRPS." DKK for ".$group->group_paid_LockedPeriod." month";
            if($group->group_paid_LockedPeriod >1) echo "s";
            echo "</div></div>";
        }else{
            if($group->group_price_type == 'fixed'){
                $GRPS = $group->group_paid_price;
            }else{
                $end_date = strtotime($group->group_paid_MembershipEnd);
                $daystopay = ceil(($end_date-time())/(24*60*60));
                $GRPS = $group->group_paid_price * $daystopay;
            }
            if($GRPS <=0)$GRPS=0;
            echo "<div style='clear:both;'>".$GRPS." DKK till ".$group->group_paid_MembershipEnd."</div></div>";
        }
    }

    
    

}else{
    include elgg_get_plugins_path() ."groups/views/default/group/default.php";
}
?>
