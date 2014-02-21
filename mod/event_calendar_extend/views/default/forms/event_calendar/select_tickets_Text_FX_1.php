<?php
$event=$vars['entity'];
/* We should move this to a form
*/
/**
$CREA=$event->time_created;	//:DC:
$TIME=time();
$TM24=time()-86400;
$DIFF=$TIME-$CREA;
$DIFH=$DIFF/86400;
echo '<hr size=3 color=red noshade><h2>::select_tickets.php::</h2><hr size=3 color=red noshade>';
echo"<pre><hr>";
echo
	"TICKET? "	.$event->guid
	." OWNR: "	.$event->owner_guid
	." CONT: "	.$event->container_guid
	." <br>"
	." C: "		.$CREA
	." <br>"
	." @: "		.$TIME
	." <br>"
	." H: "		.$TM24
	." <br>"
	." D: "		.$DIFF
	." <br>"
	." H: "		.$DIFH
	;
echo"<hr></pre>";
**/
$CurrUser=elgg_get_logged_in_user_entity();
$CurrUserGUID=$CurrUser->getGUID();
$limit = 999;
$offset = 0;
$options = array('types' => 'object',
'subtype' => 'ticket_order',
'metadata_name_value_pairs' => array(
array('name' => 'event_guid', 'value' => $event->guid, 'operand' => '='),
array('name' => 'status', 'value' => 'declined', 'operand' => '!='),
),
'full_view' => false,
'limit' => $limit,
'offset' => $offset
);
$EventOrders = elgg_get_entities_from_metadata($options);
//echo '<pre><h2>$EventOrders</h2>';	//:DC:
//print_r($EventOrders);
/**
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
````````````````````````````````````````````````````````````````````````````````````````````````````
....................................................................................................
	if(
		$event->status == 'processing'
	||	$event->status == 'awaitingpayment'
	||	$event->status == 'awaitingapproval'
	)
		//:DC: REJECT
		$menu .= elgg_view('output/confirmlink',
				array(
				'class' => "elgg-button elgg-button-delete",
				'href' => 'action/event_calendar/order/decline?order_guid='
					.$event->guid.'&event_guid=' . $event->event_guid,
				'confirm' => elgg_echo('event_calendar:request:remove:check'),
				'text' => elgg_echo('event_calendar:review_requests:reject'),
				'title' => elgg_echo('event_calendar:review_requests:reject:title'),
			));
		$menu .= '&nbsp;&nbsp;';		
**/
$body.='';
$PrevTO='<b>Previous Ticket Orders:</b><br>';
echo"
<style>
.elgg-button-delete-2 {
	height:13px;
	font-size:12px;
	vertical-align:top;
	color: #FFF;
	text-decoration: none;
	border: 1px solid blue;
	background:red;
	text-shadow: 1px 1px 0px black;
}
.elgg-button-delete-2:hover {
	color: #444;
	background: yellow;
	text-decoration: none;
}
</style>
";
$vEO_CTRS=array();
$vEO_CTRZ=array();
$TIME=time();
$TM24=time()-86400;
//$OrderKey=array();
//$OrderCurrency=array();
$OrderZ=array();
$OrderTitle=array();
$OrderTotal=array();
$OrderSubTotal=array();
$OrderCreated=array();
$OrderStatus=array();
$OrderAge=array();
$OrderDetails=array();
$TicketTypeCtr=array();
/**
USER		 ORDER#            CRNC $ORDER   CREATED       STATUS
Admin Dhrup  Ticket Order: 67  DKK: 123,40 |  2 days ago | Awaiting Payment  Reject  Accept
Admin Dhrup	 Ticket Order: 65  DKK: 370,20 | 26 days ago | Awaiting Payment  Reject  Accept
Admin Dhrup	 Ticket Order: 64  DKK: 127,13 | 27 days ago | Awaiting Payment  Reject  Accept
**/
foreach($EventOrders as $kEO=>$vEO)
{
	/**
						echo"\n<hr>($kEO) "
							,'GDO (',$vEO->guid,') '
							,'TYP (',$ticket_type,') '
							,'OWN (',$vEO->owner_guid,') '
							,'CRE (',$vEO->time_updated,') '
							,'STT (',$vEO->status,') <br> ` ` ` ` '
							,'T#1 (',$vEO->ticket_spots_1,' _x_ ',$vEO->ticket_type_1,' '
							,'T#2  ',$vEO->ticket_spots_2,' _x_ ',$vEO->ticket_type_2,' '
							,'T#3  ',$vEO->ticket_spots_3,' _x_ ',$vEO->ticket_type_3,' '
							,'T#4  ',$vEO->ticket_spots_4,' _x_ ',$vEO->ticket_type_4,' '
							,'T#5  ',$vEO->ticket_spots_5,' _x_ ',$vEO->ticket_type_5,') '
							;
						**/
	//echo"<pre>USER($CurrUserGUID/",$vEO->owner_guid,")<br>EventOrders # $kEO::=><br>";
	//print_r($vEO);
	//echo"</pre>";
	//````````````````````````````````````````
	if($vEO->owner_guid==$CurrUserGUID)
	{
		$OrderZ[$vEO->guid]=true;
		$CREA=strftime("%Y-%m-%d %H:%I",$vEO->time_updated);
		$DIFF=$TIME-$vEO->time_updated;
		$DIFH=$DIFF/86400;//days
		$OrderTitle[$vEO->guid]=$vEO->name;
		//$OrderCreated[$vEO->guid]=$vEO->time_updated;
		$OrderCreated[$vEO->guid]=
		elgg_get_friendly_time($vEO->time_created);
		$OrderStatus[$vEO->guid]=$vEO->status;
		//$OrderAge[$vEO->guid]=$DIFH;
		$OrderTotal[$vEO->guid]=$vEO->total;
		//Ticket order 97 (button: cancel)
		//+		Ticket A	2	x	30,25 =		60,50 
		//+		TYPE		CTR	x	EACH  =		LINETOT
		//:DC:
		$type_var = 'ticket_type_' . $i;
		$amount_var = 'ticket_amount_' . $i;
		$spots_var = 'ticket_spots_' . $i;
		//	.$order->$type_var.'</b> (DKK'.$order->$amount_var.') x'
		//	.$order->$spots_var.' = DKK'
		//	.$order->$amount_var
		//````````````````````````````````````````
		$OrderDetails[$vEO->guid]='';
		//````````````````````````````````````````
		if($vEO->ticket_type_1)	{
			if(!$vEO_CTRS[$vEO->ticket_type_1])
			$vEO_CTRS[$vEO->ticket_type_1]=0;
			$vEO_CTRS[$vEO->ticket_type_1]=$vEO_CTRS[$vEO->ticket_type_1]+$vEO->ticket_spots_1;
			$vEO_CTRZ[1]+=$vEO->ticket_spots_1;
			$OrderDetails[$vEO->guid].=''
			.' &nbsp;&nbsp;&nbsp;&nbsp;'.$vEO->ticket_type_1
			.': DKK.'.$vEO->ticket_amount_1
			.' x '.$vEO->ticket_spots_1
			.' Σ '.$vEO_CTRZ[1]
			.' = '.number_format(($vEO->ticket_amount_1*$vEO->ticket_spots_1),2,',','.')
			.'<br>'
			;}
		//````````````````````````````````````````
		if($vEO->ticket_type_2)	{
			if(!$vEO_CTRS[$vEO->ticket_type_2])
			$vEO_CTRS[$vEO->ticket_type_2]=0;
			$vEO_CTRS[$vEO->ticket_type_2]=$vEO_CTRS[$vEO->ticket_type_2]+$vEO->ticket_spots_2;
			$vEO_CTRZ[2]+=$vEO->ticket_spots_2;
			$OrderDetails[$vEO->guid].=''
			.' &nbsp;&nbsp;&nbsp;&nbsp;'.$vEO->ticket_type_2
			.': DKK.'.$vEO->ticket_amount_2
			.' x '.$vEO->ticket_spots_2
			.' = '.number_format(($vEO->ticket_amount_2*$vEO->ticket_spots_2),2,',','.')
			.'<br>'
			;}
		//````````````````````````````````````````
		if($vEO->ticket_type_3)	{
			if(!$vEO_CTRS[$vEO->ticket_type_3])
			$vEO_CTRS[$vEO->ticket_type_3]=0;
			$vEO_CTRS[$vEO->ticket_type_3]=$vEO_CTRS[$vEO->ticket_type_3]+$vEO->ticket_spots_3;
			$vEO_CTRZ[3]+=$vEO->ticket_spots_3;
			$OrderDetails[$vEO->guid].=''
			.' &nbsp;&nbsp;&nbsp;&nbsp;'.$vEO->ticket_type_3
			.': DKK.'.$vEO->ticket_amount_3
			.' x '.$vEO->ticket_spots_3
			.' = '.number_format(($vEO->ticket_amount_3*$vEO->ticket_spots_3),2,',','.')
			.'<br>'
			;}
		//````````````````````````````````````````
		if($vEO->ticket_type_4)	{
			if(!$vEO_CTRS[$vEO->ticket_type_4])
			$vEO_CTRS[$vEO->ticket_type_4]=0;
			$vEO_CTRZ[4]+=$vEO->ticket_spots_4;
			$vEO_CTRS[$vEO->ticket_type_4]=$vEO_CTRS[$vEO->ticket_type_4]+$vEO->ticket_spots_4;
			$OrderDetails[$vEO->guid].=''
			.' &nbsp;&nbsp;&nbsp;&nbsp;'.$vEO->ticket_type_4
			.': DKK.'.$vEO->ticket_amount_4
			.' x '.$vEO->ticket_spots_4
			.' = '.number_format(($vEO->ticket_amount_4*$vEO->ticket_spots_4),2,',','.')
			.'<br>'
			;}
		//````````````````````````````````````````
		if($vEO->ticket_type_5)	{
			if(!$vEO_CTRS[$vEO->ticket_type_5])
			$vEO_CTRS[$vEO->ticket_type_5]=0;
			$vEO_CTRZ[5]+=$vEO->ticket_spots_5;
			$vEO_CTRS[$vEO->ticket_type_5]=$vEO_CTRS[$vEO->ticket_type_5]+$vEO->ticket_spots_5;
			$OrderDetails[$vEO->guid].='<br>'
			.' &nbsp;&nbsp;&nbsp;&nbsp;'.$vEO->ticket_type_5
			.': DKK.'.$vEO->ticket_amount_5
			.' x '.$vEO->ticket_spots_5
			.' = '.number_format(($vEO->ticket_amount_5*$vEO->ticket_spots_5),2,',','.')
			.'<br>'
			;}
		//````````````````````````````````````````
		//echo"<pre>";
		//echo"</pre>";
		//if($vEO->ticket_spots_1>0&&$vEO->ticket_spots_1!='0')
		//{
		//$body.=$PrevTO;
		//$body.='<i>&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;&nbsp;'
		//	.elgg_echo($vEO->status).': &nbsp; </i>';
		//$PrevTO='';
		/**$body.=
									''
									.'G# '.$vEO->guid.' x '
									.''.$vEO->ticket_spots_1.' x '
									.''.$vEO->ticket_type_1
									.' '.$CREA
									.' '.$DIFX
									.'</span>'
								;
								if(
									$vEO->status == 'processing'
								||	$vEO->status == 'awaitingpayment'
								||	$vEO->status == 'awaitingapproval'
								)//:DC: USER CANCEL (==REJECT)
								$body.='&nbsp;&nbsp;'.elgg_view(
									'output/confirmlink',
									array(
									'class'   => "elgg-button elgg-button-delete-2",
									'href'    => 'action/event_calendar/order/decline'
										.'?order_guid='.$event->guid
										.'&event_guid='.$event->event_guid,
									'confirm' => elgg_echo('event_calendar:request:remove:check'),
									//'text'    => elgg_echo('event_calendar:review_requests:reject'),
									'text'    => elgg_echo('Cancel').' '.$vEO->ticket_type_1,
									//'title'   => elgg_echo('event_calendar:review_requests:reject:title'),
									'title'   => elgg_echo('Cancel all your tickets on this Order (Type '.$vEO->ticket_type_1).')',
									)
								);
								$body.='<br>';**/
		//}
		/**if($vEO->ticket_spots_2>0&&$vEO->ticket_spots_1!='0'){
								$vEO_CTRS[$vEO->ticket_type_2]+=$vEO->ticket_spots_2;
							$body.=$PrevTO;
							$body.='<i>&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;&nbsp;'
								.elgg_echo($vEO->status).': &nbsp; </i>';
							$PrevTO='';
								$body.=
									''
									.'G# '.$vEO->guid.' x '
									.''.$vEO->ticket_spots_2.' x '
									.''.$vEO->ticket_type_2
								.' '.$CREA
								.' '.$DIFX
									.'</span>'
								;
								if(
									$vEO->status == 'processing'
								||	$vEO->status == 'awaitingpayment'
								||	$vEO->status == 'awaitingapproval'
								)//:DC: USER CANCEL (==REJECT)
								$body.='&nbsp;&nbsp;'.elgg_view(
									'output/confirmlink',
									array(
									'class'   => "elgg-button elgg-button-delete-2",
									'href'    => 'action/event_calendar/order/decline'
										.'?order_guid='.$event->guid
										.'&event_guid='.$event->event_guid,
									'confirm' => elgg_echo('event_calendar:request:remove:check'),
									//'text'    => elgg_echo('event_calendar:review_requests:reject'),
									'text'    => elgg_echo('Cancel').' '.$vEO->ticket_type_2,
									//'title'   => elgg_echo('event_calendar:review_requests:reject:title'),
									'title'   => elgg_echo('Cancel all your tickets on this Order (Type '.$vEO->ticket_type_2).')',
									)
								);
								$body.='<br>';
							}**/
		/**if($vEO->ticket_spots_3>0&&$vEO->ticket_spots_1!='0'){
								$vEO_CTRS[$vEO->ticket_type_3]+=$vEO->ticket_spots_3;
							$body.=$PrevTO;
							$body.='<i>&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;&nbsp;'
								.elgg_echo($vEO->status).': &nbsp; </i>';
							$PrevTO='';
								$body.=
									''
									.'G# '.$vEO->guid.' x '
									.''.$vEO->ticket_spots_3.' x '
									.''.$vEO->ticket_type_3
								.' '.$CREA
								.' '.$DIFX
									.'</span>'
								;
								if(
									$vEO->status == 'processing'
								||	$vEO->status == 'awaitingpayment'
								||	$vEO->status == 'awaitingapproval'
								)//:DC: USER CANCEL (==REJECT)
								$body.='&nbsp;&nbsp;'.elgg_view(
									'output/confirmlink',
									array(
									'class'   => "elgg-button elgg-button-delete-2",
									'href'    => 'action/event_calendar/order/decline'
										.'?order_guid='.$event->guid
										.'&event_guid='.$event->event_guid,
									'confirm' => elgg_echo('event_calendar:request:remove:check'),
									//'text'    => elgg_echo('event_calendar:review_requests:reject'),
									'text'    => elgg_echo('Cancel').' '.$vEO->ticket_type_3,
									//'title'   => elgg_echo('event_calendar:review_requests:reject:title'),
									'title'   => elgg_echo('Cancel all your tickets on this Order (Type '.$vEO->ticket_type_3).')',
									)
								);
								$body.='<br>';
							}**/
		/**if($vEO->ticket_spots_4>0&&$vEO->ticket_spots_1!='0'){
								$vEO_CTRS[$vEO->ticket_type_4]+=$vEO->ticket_spots_4;
							$body.=$PrevTO;
							$body.='<i>&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;&nbsp;'
								.elgg_echo($vEO->status).': &nbsp; </i>';
							$PrevTO='';
								$body.=
									''
									.'G# '.$vEO->guid.' x '
									.''.$vEO->ticket_spots_4.' x '
									.''.$vEO->ticket_type_4
								.' '.$CREA
								.' '.$DIFX
									.'</span>'
								;
								if(
									$vEO->status == 'processing'
								||	$vEO->status == 'awaitingpayment'
								||	$vEO->status == 'awaitingapproval'
								)//:DC: USER CANCEL (==REJECT)
								$body.='&nbsp;&nbsp;'.elgg_view(
									'output/confirmlink',
									array(
									'class'   => "elgg-button elgg-button-delete-2",
									'href'    => 'action/event_calendar/order/decline'
										.'?order_guid='.$event->guid
										.'&event_guid='.$event->event_guid,
									'confirm' => elgg_echo('event_calendar:request:remove:check'),
									//'text'    => elgg_echo('event_calendar:review_requests:reject'),
									'text'    => elgg_echo('Cancel').' '.$vEO->ticket_type_4,
									//'title'   => elgg_echo('event_calendar:review_requests:reject:title'),
									'title'   => elgg_echo('Cancel all your tickets on this Order (Type '.$vEO->ticket_type_4).')',
									)
								);
								$body.='<br>';
							}**/
		/**if($vEO->ticket_spots_5>0&&$vEO->ticket_spots_1!='0'){
								$vEO_CTRS[$vEO->ticket_type_5]+=$vEO->ticket_spots_5;
							$body.=$PrevTO;
							$body.='<i>&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;&nbsp;'
								.elgg_echo($vEO->status).': &nbsp; </i>';
							$PrevTO='';
								$body.=
									''
									.'G# '.$vEO->guid.' x '
									.''.$vEO->ticket_spots_5.' x '
									.''.$vEO->ticket_type_5
								.' '.$CREA
								.' '.$DIFX
									.'</span>'
								;
								if(
									$vEO->status == 'processing'
								||	$vEO->status == 'awaitingpayment'
								||	$vEO->status == 'awaitingapproval'
								)//:DC: USER CANCEL (==REJECT)
								$body.='&nbsp;&nbsp;'.elgg_view(
									'output/confirmlink',
									array(
									'class'   => "elgg-button elgg-button-delete-2",
									'href'    => 'action/event_calendar/order/decline'
										.'?order_guid='.$event->guid
										.'&event_guid='.$event->event_guid,
									'confirm' => elgg_echo('event_calendar:request:remove:check'),
									//'text'    => elgg_echo('event_calendar:review_requests:reject'),
									'text'    => elgg_echo('Cancel').' '.$vEO->ticket_type_5,
									//'title'   => elgg_echo('event_calendar:review_requests:reject:title'),
									'title'   => elgg_echo('Cancel all your tickets on this Order (Type '.$vEO->ticket_type_5).')',
									)
								);
								$body.='<br>';
							}**/
	}
}
//````````````````````````````````````````
//echo '<br><br>:END:$EventOrders<hr size7 color=blue noshade>print_r($vEO_CTRS):=>';
//print_r($vEO_CTRS);
//echo '<hr size7 color=blue noshade>';
//print_r($EventOrders);
//echo '</pre>';
//````````````````````````````````````````
foreach($OrderZ as $kEO=>$vEO)
{	//:DC:
	$body.=	$PrevTO
	.'<span '
	.'style="border-top:dotted #BBB 1px;">'
	.'<br>'
	.'Ticket Order: '.$kEO
	.' <b>DKK:</b> '.number_format($OrderTotal[$kEO],2,',','.')
	.' | '.$OrderCreated[$kEO]
	.' | '.$OrderStatus[$kEO]
	//	.' ` AGED='.$OrderAge[$kEO]
	.''
	.'</span>'
	;
	$PrevTO='';
	//:DC: USER CANCEL (~=REJECT)
	//http://localhost/_atensci.us_kenneth/action/event_calendar/order/decline?order_guid=67&event_guid=60&__elgg_ts=1353533144&__elgg_token=85921df560ef601b4c33abb02ca1d2ed
	//http://localhost/_atensci.us_kenneth/action/event_calendar/order/decline?order_guid=67&event_guid=60&__elgg_ts=1353504656&__elgg_token=cb57e5bac315fbcbbd52b61d5d7de660
	//http://ensci.us/kenneth/action/event_calendar/order/decline?order_guid=83&event_guid=71&__elgg_ts=1353533718&__elgg_token=992e39254f4abf32b87532604228d50b
	$body.='<div '
	.'style="width:40%;float:right;clear:both;text-align:right;border-top:dotted #BBB 1px;">'
	.'&nbsp;&nbsp;'		
	.elgg_view(
	'output/confirmlink',
	array(
	'class'   => "elgg-button elgg-button-delete",
	'href'    => 'action/event_calendar/order/decline'
	.'?order_guid='.$kEO
	.'&event_guid='.$event->guid,
	'confirm' => elgg_echo('event_calendar:request:remove:check'),
	//'text'    => elgg_echo('event_calendar:review_requests:reject'),
	'text'    => elgg_echo('Cancel').' '.$vEO->ticket_type_5,
	//'title'   => elgg_echo('event_calendar:review_requests:reject:title'),
	'title'   => elgg_echo('Cancel all your tickets on this Order (Type '.$vEO->ticket_type_5).')'
	)
	)
	.'</div>'
	;
	$body.='<br>';
	//Ticket order 97 (button: cancel)
	//+		Ticket A	2	x	30,25 =		60,50 
	//+		TYPE		CTR	x	EACH  =		LINETOT
	$body.=$OrderDetails[$kEO];
}
//````````````````````````````````````````
$body.='<br>';
$body .= '<p><b>' . elgg_echo('event_calendar:ticket:list') . ':</b>';//:DC:
$spots_counter = 0;
$doublecheckCTR=0;
//````````````````````````````````````````
for($i = 1; $i <=5; $i++)				//:DC:
{
	$type_var = 'ticket_option_type_' . $i;
	$amount_var = 'ticket_option_amount_' . $i;
	$spots_var = 'ticket_option_spots_' . $i;
	$spots_max_var = 'ticket_option_spots_max_' . $i;
	$ticket_type = $event->$type_var;
	$ticket_amount = $event->$amount_var;
	$ticket_spots = $event->$spots_var;
	$ticket_max_spots = $event->$spots_max_var;
	if($ticket_type && $ticket_amount)
	{
		elgg_extend_view('user/default','event_calendar/calendar_toggle');
		$content = elgg_list_entities_from_metadata($options);	//views/default/object/ticket_order.php
		//$body .= '<p> ['.$i.'] ==> ' . $ticket_type . ': ';	//:DC:
		//````````````````````````````````````````
		if($vEO_CTRZ[$i]>=$ticket_max_spots)
		{
			//$body .= '<span style="color:red;">'
			//.' # ('.$vEO_CTRS[$ticket_type].') => '
			//.' @ '.$ticket_type.') '
			//.'You have bought '
			//.$vEO_CTRS[$ticket_type]
			//.' Tickets at or over Limit of '
			//.$ticket_max_spots.'</span> '
			//;//:DC:
		}
		//````````````````````````````````````````
		else
		if($ticket_spots > 0)
		{
			//$ticket_amount=$ticket_amount+1500;//:DC:DBG:TST
			$ticket_amount_X=number_format($ticket_amount,2,',','.');	//:DC:
			$body .= '<br clear="all"><div><div style="width:35%;float:left">'
			.$ticket_type.': '
			;
			$body .= ''
			.' # ('.$vEO_CTRS[$ticket_type].' Σ =>	 '.$ticket_max_spots.') => '
			.' @ '.$ticket_type.') '
			;//:DC:
			$body .= '<b>DKK</b> ' . $ticket_amount_X.' &nbsp;&nbsp; ';	//:DC:
			//
			$vEO_CTRS_Max=$ticket_max_spots;
			if($vEO_CTRS[$ticket_type]>0)
			$vEO_CTRS_Max=$ticket_max_spots - $vEO_CTRS[$ticket_type];
			$body .= '<div style="width:35%;float:right;">
				<style>select{width:55px;}</style>'
			.elgg_view(
			'input/dropdown_tickets',
			array(
			'name'=>$spots_var, 
			'id'=> $spots_var, 
			'options' => range( 0, $vEO_CTRS_Max ),
			'size'=> 1
			)
			);
			//if($vEO_CTRS[$ticket_type]>0)		
			//$body.='<br>&nbsp;&nbsp;&nbsp;&nbsp;You have bought '
			//.$vEO_CTRS[$ticket_type].' Tickets before'
			//;//:DC:
			$body.='</div>';
			$body.='</div>';
			$body.='</div>';
			$doublecheckCTR++;
		}//if($ticket_spots > 0)
		else
		{
			$body .= elgg_echo('event_calendar:ticket:soldout');
			$body .= elgg_view('input/hidden', array('name'=>$spots_var,'value'=>0));
		}//ELSE::if($ticket_spots > 0)
		$body .= elgg_view('input/hidden', array('name'=>$type_var, 'value'=>$ticket_type));
		$body .= elgg_view('input/hidden', array('name'=>$amount_var, 'value'=>$ticket_amount));
	}//
	$spots_counter = $spots_counter + $ticket_spots;
}//	for($i = 1; $i <=5; $i++){			//:DC:
$body.='<div style="clear:both;">';
$body .= elgg_view('input/hidden', array('name'=>'guid', 'value'=>$event->getGUID()));
$doublecheck = '<div id="confirm_order"></div>';
$doublecheck .= elgg_view(
'input/submit'
,array(
'name'=>'submit','value'=>elgg_echo('event_calendar:ticket:buynow'),'onClick'=>'formSubmit()'
)
);
$body.='</div>';
echo elgg_view_module(
'popup',
elgg_echo('event_calendar:doublecheck'),
$doublecheck,
array(
'id' => 'confirm',
'class' => 'event_calendar ticketreview hidden',
)
);
////$doublecheckCTR=0;//:DC:?DBG!
if($doublecheckCTR>0){
	if($spots_counter > 0){
		$body .= '<br>'.elgg_view('output/url', array(
		'href' => '#confirm',
		'rel' => 'popup',
		'class' => 'elgg-button elgg-button-submit',
		'text' => elgg_echo('event_calendar:ticket:buynow'),
		'onClick' => 'doublecheck()',
		))
		.'<br><br>';
	}else{
		$body .= "<br>";	
		$body .= elgg_view('input/submit', array(
		'href' => '#confirm',
		'rel' => 'popup',
		'class' => 'elgg-button',
		'value' => elgg_echo('event_calendar:tickets:allsoldout'),
		'disabled' => 'disabled'
		));
	}
}
else{
	$body .= '<br><br>';
}
//$body .= elgg_view('input/submit', array('name'=>'submit','value'=>elgg_echo('event_calendar:ticket:buynow'), ));
echo $body;
?>