

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
    echo "<li class='tooltip' data-tooltip='".$membercount." members' style='width:10px;'>";
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

}else{
    include elgg_get_plugins_path() ."groups/views/default/group/default.php";
}
?>
<style>
/* tooltip basic link styles */
  .tooltip:link,
  .tooltip:visited {
    position:relative;
    text-decoration:underline;
  }
  .tooltip:hover {
    text-decoration:none; /* remove underline on tooltip text */
  }

  /* tooltip body text */
  .tooltip:hover:before {
    display:block;
    background:#eee;
    background:-webkit-gradient(linear, 0 0, 0 100%, from(rgba(255,205,205,0.9)), to(rgba(228,230,230,0.9)));
    background:-moz-linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    background:-o-linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    background:linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    content:attr(data-tooltip); /* this link attribute contains tooltip text */
    position:absolute;
    font-size:0.9em;
    color:rgba(51,51,51,0.9);
    bottom:20px;/* ensure link text is visible under tooltip */
    right:0px;  /* align both tooltip and link right edges */
    width:11em;  /* a reasonable width to wrap tooltip text */
    text-align:center;
    padding:4px;
    border:2px solid rgba(204,153,153,0.9);
    -webkit-border-radius:6px;
       -moz-border-radius:6px;
        -ms-border-radius:6px;
         -o-border-radius:6px;
            border-radius:6px;
    -webkit-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
       -moz-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
        -ms-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
         -o-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
            box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
  }

  /* styles shared by both triangles */
  .tooltip:hover span:before,
  .tooltip:hover span:after {
    content:"";
    position:absolute;
    border-style:solid;
  }
  /* outer triangle: for border */
  .tooltip:hover span:before {
    bottom:5px; /* value = tooltip:hover:before (border-width*2)+1 */
    right:10px; /* controls horizontal position */
    border-width:16px 16px 0; /* top, right-left, bottom */
    border-color:rgba(204,153,153,0.9) transparent; /* top/bottom, right-left (lazy becasue bottom is 0) */
  }

  /* inner triangle: for fill */
  .tooltip:hover span:after {
    bottom:8px; /* value = tooltip:before (border-width*2) */
    right:12px; /* above 'right' value + 2 */
    border-width:14px 14px 0; /* 2 less than above */
    border-color:rgba(225,238,238,0.95) transparent; /* tweak opacity by eye/eyedropper to obscure outer triangle colour */
  }

</style>