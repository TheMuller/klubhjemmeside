<?php
    include('../../engine/start.php');
gatekeeper();
    $GRPN=$_REQUEST['GroupGuid'];
    $USRI=elgg_get_logged_in_user_guid();

    $ia = elgg_set_ignore_access(true);
    $group=get_entity($GRPN);
    elgg_set_ignore_access($ia);
    if($group->group_period_type =='duration'){
            $GRPS = $group->group_paid_price * $group->group_paid_LockedPeriod;
        //echo $group->group_paid_LockedPeriod;
    }elseif($group->group_price_type == 'fixed'){
        $GRPS = $group->group_paid_price;
    }else{
            $end_date = strtotime($group->group_paid_MembershipEnd);
            $daystopay = ceil(($end_date-time())/(24*60*60));
            $GRPS = $group->group_paid_price * $daystopay;
    }


	//``````````````````````````````````````````````````````````````````````````````````````````````````
	$groups_merchant_number = elgg_get_plugin_setting('groups_merchant_number', 'paidgroup');
	
	$amount = $GRPS*100;
	$groups_currency = elgg_get_plugin_setting('groups_currency', 'paidgroup');
	$secret = elgg_get_plugin_setting('groups_md5secret', 'paidgroup');
	//$url = 'https://sat1.dibspayment.com/dibspaymentwindow/entrypoint';
     $url = elgg_get_site_url().'mod/paidgroup/epayaccept.php';
	$xAccept='join_payment_handler_block_3_x1_EPAY.php';
	$params = array
	(
        "merchant" => $groups_merchant_number,
		'amount' => $amount,
		'currency' => $groups_currency,
		'orderid' => time(),
		'acceptReturnUrl'   => elgg_get_site_url().'mod/paidgroup/'.$xAccept		.'?p='.$GRPS.'&g='.$GRPN.'&u='.$USRI,

		'groupid' => $GRPN
	);
	$params['hash'] = md5(implode("",array_values($params)).$secret);

	$query = http_build_query($params)."\n";
	forward($url.'?'.$query);

////////////////////////////////////////////////////////////////////////////////////////////////////
?>