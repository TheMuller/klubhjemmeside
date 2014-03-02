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
    $url = elgg_get_site_url() . "action/groups/join?group_guid={$group->getGUID()}";
    $url = elgg_add_action_tokens_to_url($url);
    echo elgg_view("output/url", array(
                                       "href" => $url,
                                       "text" => elgg_echo('Join'),
                                       "is_trusted" => true,
                                       "class" => "joinButton",
                                       "style" =>"float:right;height:13px;",
                                       ));
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
    
    echo "<ul class='elgg-menu elgg-menu-hz elgg-menu-title'>";
    $membercount =  $group->getMembers(0, 0, TRUE);
    echo "<li style='width:10px;' title='".$membercount." members'>";
    echo $membercount;
    $membership = $group->membership;
    echo "</li >";
    if ($membership == ACCESS_PUBLIC) {
		$accessstring =  elgg_echo("open");
        $accesslongstring = "Aproval is not needed";
	} else {
		 $accessstring =  elgg_echo("closed");
        $accesslongstring = "Need Aproval";
	}
    echo "<li  style='float:left;width:40px;'title='".$accesslongstring."'>";
    echo $accessstring;
    echo "</li>";

    echo "</ul >";

}else{
    include elgg_get_plugins_path() ."groups/views/default/group/default.php";
}