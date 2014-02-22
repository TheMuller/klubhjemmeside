<script type='text/javascript'>

window.onload = function() {
    var d = document.getElementsByClassName('elgg-foot')[0];
    d.parentNode.appendChild(d);
    
}	
</script>



<div>
<label>
<?php echo elgg_echo('groups:visibility'); ?><br />
<?php echo elgg_view('input/access', array(
                                           'name' => 'vis',
                                           'value' =>  $access,
                                           'options_values' => $access_options,
                                           ));
    ?>
</label>
</div>

<!--	////////////////////////////////////////////////////////////////////////////////////////////////////	-->
<?php
    $group = $vars['entity'];
    if($group instanceof ElggGroup){
	$group_paid_flag			=	$group->group_paid_flag;
	$group_paid_price			=	$group->group_paid_price;
	$group_paid_LockedPeriod	=	$group->group_paid_LockedPeriod;
	$group_paid_MembershipStart	=	$group->group_paid_MembershipStart;
	$group_paid_MembershipEnd	=	$group->group_paid_MembershipEnd;
    $group_period_type          =   $group->group_period_type;
    $group_price_type           =   $group->group_price_type;
        if($group_period_type == 'duration')$price_info = ' for one month';
        else if($group_price_type == 'daily')$price_info = '  for one day.';
        else $price_info = 'fixed';
    }else{
      $group_paid_flag = 'no';
      $group_period_type = 'duration';
      $group_price_type = 'daily';
      $price_info = ' for one month';
    }
    ?>
<!--	////////////////////////////////////////////////////////////////////////////////////////////////////	-->
<!--	START::PAID$ Groups	////////////////////////////////////////////////////////////////////////////////////////////////////	-->
<?php	//:DC:
    ?>
<br>
<div id='GROUPPAID' style='background:#DDF;'>
<br>
<div>
<b><?php echo elgg_echo("paidgroup:field:group_paid_flag"); ?><br /></b>
<?php echo elgg_view("input/radio", array(
                                          "name" => 'group_paid_flag',
                                          "value" => $group_paid_flag,
                                          "onchange"=>" onpaidgrp_change(this.value);return true;",
                                          'options' => array(
                                                             elgg_echo('groups:yes') => 'yes',
                                                             elgg_echo('groups:no') => 'no',
                                                             ),
                                          ));
	?>

</div>

<!--	////////////////////////////////////////////////////////////////////////////////////////////////////	-->


<div id='paymentdetail' style='
<?php	if($group_paid_flag =='no') echo "display:none;"?>'>
<div>

<b><?php echo elgg_echo("paidgroup:field:group_period_type"); ?><br /></b>

<?php
    echo elgg_view("input/radio", array(
                                          "name" => 'group_period_type',
                                          "value" => $group_period_type,
                                          "onchange"=>" onpaidgrptype_change(this.value);return true;",
                                          'options' => array(
                                                             elgg_echo('paidgroup:field:group_period_type:value:duration') => 'duration',
                                                             elgg_echo('paidgroup:field:group_period_type:value:dates') => 'dates',
                                                             
                                                             ),
                                          ));
	?>
</label>
</div><br>

<div style="width:225px;
<?php	if($group_period_type !='duration') echo "display:none;"?>" id = 'group_paid_LockedPeriod'">
<label>
<?php echo elgg_echo("paidgroup:field:group_paid_LockedPeriod"); ?><br />
<?php
	unset($x);
	for($i=1;$i<=12;$i++)
    $x[$i]=$i;
    echo elgg_view('input/dropdown', array(
                                           'name' => 'group_paid_LockedPeriod',
                                           
                                           'value' => $group_paid_LockedPeriod,
                                           'options_values' => $x,
                                           )
                   );
	?>
</label>
</div>
<!--	////////////////////////////////////////////////////////////////////////////////////////////////////	-->
<?php	//:DC:
    ?>
<div style="width:205px;
<?php	if($group_period_type =='duration') echo "display:none;"?>" id = 'group_paid_MembershipDates'>

<?php echo elgg_view("input/radio", array(
                                          "name" => 'group_price_type',
                                          "id" => 'group_price_type',
                                          "value" => $group_price_type,
                                          "onchange"=>" onpricetype_change(this.value);return true;",
                                          'options' => array(
                                                             elgg_echo('paidgroup:field:group_price_type:value:dailyprice') => 'daily',
                                                             elgg_echo('paidgroup:field:group_price_type:value:fixedprice') => 'fixed',

                                                       ),
                                    ));
?>
<label>
<?php echo elgg_echo("paidgroup:field:group_paid_MembershipStart"); ?><br />
<?php echo elgg_view("input/date", array(
                                             "name" => 'group_paid_MembershipStart',
                                             
                                             "value" => $group_paid_MembershipStart,
                                             )
                     );
	?>
</label>

<label>
<?php echo elgg_echo("paidgroup:field:group_paid_MembershipEnd"); ?><br />
<?php echo elgg_view("input/date", array(
                                             "name" => 'group_paid_MembershipEnd',
                                             "value" => $group_paid_MembershipEnd,
                                             )
                     );
	?>
</label>
</div>
<!--	////////////////////////////////////////////////////////////////////////////////////////////////////	-->

<div style="width:400px;">
<label>
<?php echo elgg_echo("paidgroup:field:group_paid_price")."</label>";
    echo elgg_view("input/text", array(
                                       "name" => 'group_paid_price',
                                       "value" => $group_paid_price,
                                       "style" =>"width:100px;",
                                       )
                   );
    echo " ".elgg_get_plugin_setting('groups_currency', 'paidgroup');
    echo "  <b id = 'price_info'>". $price_info."</b>";
    

    
    ?>

</div>
<div style="width:600px;">
<?php
    $_active_member_count =0;
    if($group instanceof ElggGroup){
    $members =  $group->getMembers (0,0,false);
    foreach($members as $member){
        $last_dates = unserialize($member->last_dates);
        $last_date = $last_dates[$group->guid];
        if($last_date and $last_date !='')$_active_member_count++;
    }
    if($_active_member_count >1){
        echo "<br>".elgg_echo('paidgroup:field:warning_activemember',array($_active_member_count));
    }
    }
    ?>
</div>
<!--	////////////////////////////////////////////////////////////////////////////////////////////////////	-->
<br><br>
</div>
</div>
<br>

<!--	END::PAID$ Groups	////////////////////////////////////////////////////////////////////////////////////////////////////	-->
<script type='text/javascript'>
var last_price_type =' for one day.';
function onpaidgrp_change(value)
{
    var paymenttypediv = document.getElementById('paymentdetail');
    if(value == 'yes'){
        paymenttypediv.style.display = 'block';
    }else{
        paymenttypediv.style.display = 'none';
    }
    return;
    
}

function onpaidgrptype_change(value)
{
   
    var theentityL = document.getElementById('group_paid_LockedPeriod');
    var theentityD = document.getElementById('group_paid_MembershipDates');
     var theentityP = document.getElementById('price_info');
    
    if(value == 'duration'){
        theentityL.style.display = 'block';
        theentityD.style.display = 'none';
        theentityP.firstChild.data =' for one month.';
    }else{
        theentityL.style.display = 'none';
        theentityD.style.display = 'block';
        
        theentityP.firstChild.data =last_price_type;
    }
    return;
    
}
function onpricetype_change(value)
{
    var theentityP = document.getElementById('price_info');
    
    if(value == 'fixed'){
        last_price_type = 'fixed';
    }else{
        last_price_type = ' for one day.'
    }
    theentityP.firstChild.data =last_price_type;
    return;
    
}
</script>


