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
    //$CurrUser=elgg_get_logged_in_user_entity();
    $CurrUserGUID=elgg_get_logged_in_user_guid ();
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
    //	'event_calendar:prev_to' => "Previous Ticket Orders:",
    //$PrevTO='<b>Previous Ticket Orders:</b><br><br>';
    $PrevTO='<div style="margin-bottom:-60px;display:block;"><h2>'.elgg_echo('event_calendar:prev_to').'</h2></div>';
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
    //````````````````````````````````````````
    //:DC:
    echo"<style>
    C0{width:200px;border:dotted red    0px;display:block;float:left;font-size:16px;}
	/**/	C1{width:200px;border:dotted orange 0px;display:block;float:left;text-align:left;margin-left:15px;padding-top:5px;}
    C2{width:85px;border:dotted red     0px;display:block;float:left;text-align:right;}
    C3{width:40px;border:dotted red     0px;display:block;float:left;}
    C4{width:016px;border:dotted red    0px;display:block;float:left;}
	/**/	C5{width:132px;border:dotted blue   0px;display:block;float:left;text-align:right;}
    C6{width:200px;border:dotted red    0px;float:left;}
    C7{width:200px;border:dotted red    0px;display:block;float:right;text-align:right;}
    C8{width:300px;float:left;text-align:left;}
    C9{width:325px;float:right;text-align:right;display:block;margin-bottom:20px;}
    CZ{width:001px;height:0px;clear:both;display:block;}
    </style>
    ";
    //````````````````````````````````````````
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
		//if(elgg_is_admin_logged_in()){
            for($i=1;$i<=5;$i++)
            {
                $vTYP='ticket_type_'	.$i;
                $vAMT='ticket_amount_'	.$i;
                $vSPO='ticket_spots_'	.$i;
            
                $xTYP=$vEO->$vTYP;
                $xAMT=$vEO->$vAMT;
                $xSPO=$vEO->$vSPO;
                $xTOT=$xAMT*$xSPO;
                if($xTYP and  $vEO->status =='accepted')
                {
                    $grand_total_spot[$vTYP] += $xSPO;
                }
               if($xTYP and  $vEO->status =='awaitingapproval')
                {
                    $grand_total_w4_admin_spot[$vTYP] += $xSPO;
                }
   				
            }
		//}
        
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
			for($i=1;$i<=5;$i++)
			{
				$vTYP='ticket_type_'	.$i;
				$vAMT='ticket_amount_'	.$i;
				$vSPO='ticket_spots_'	.$i;
				$xTYP=$vEO->$vTYP;
				$xAMT=$vEO->$vAMT;
				$xSPO=$vEO->$vSPO;
				$xTOT=$xAMT*$xSPO;
				if($xTYP)
				{
					if(!$vEO_CTRS[$xTYP])
						$vEO_CTRS[$xTYP]=0;
					$vEO_CTRS[$xTYP]=$vEO_CTRS[$xTYP]+$xSPO;
					$OrderDetails[$vEO->guid].='<!--br clear="all"-->'
                    .'<div><C1> <b>'.$xTYP.': </b></C1>'
                    .'<C2>'.number_format($xAMT,2,',','.').'&nbsp;DKK</C2>'
                    .'<C3>&nbsp;x&nbsp;'.$xSPO.'</C3>'
                    //.' &nbsp; &nbsp; Σ'.$vEO_CTRZ[1].'Σ&nbsp;&nbsp; '
                    .'<C4>=</C4>'
                    .'<C5>'.number_format($xTOT,2,',','.').' DKK</C5>'
                    .'<CZ></CZ></div>'
                    ;
				}//if($xTYP){
			}//for($i=1;$i<=5;$i++)
			//````````````````````````````````````````
		}
	}
	//````````````````````````````````````````
	//	::	PREVIOUS TICKET ORDERS	::
    echo"
    <style>
    .ZZZZ-elgg-button-delete {
	color: #bbb;
        text-decoration: none;
	border: 1px solid #333;
        background: #555 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
text-shadow: 1px 1px 0px black;
}
.elgg-button-delete-2 {
height:11px;
	Zfont-size:12px;
	vertical-align:text-top;
color: #bbb;
	text-decoration: none;
border: 1px solid #333;
background: #555 url(".elgg_get_site_url()."_graphics/button_graduation.png) repeat-x left 10px;
	text-shadow: 1px 1px 0px black;
}
.elgg-button-delete-2A {
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
color: #FFF;
Zbackground: yellow;
	text-decoration: none;
}
</style>
";
//````````````````````````````````````````
//		..._extend/	select_tickets.php
foreach($OrderZ as $kEO=>$vEO)
{	//:DC:
    //````````````````````````````````````````
    $body.=	$PrevTO
    .'<div style="border-top:dotted #CCC 1px;height:0px;clear:both;margin-bottom:-1px;margin-top:65px;padding-top:5px;"></div>'
    .''
    .'<C0><b>'.elgg_echo('event_calendar:prev_to_1').'</b> '.$kEO.'&nbsp; </C0>'
    .'<i><C4>&nbsp;</C4><C5>'.number_format($OrderTotal[$kEO],2,',','.').'&nbsp;DKK&nbsp;</C5>'
    //:DC:	'awaitingpayment' language text!
    //````````````````````````````````````````
    .'<C7>'.elgg_echo($OrderStatus[$kEO]).'</C7>'
    .'<C6>'.$OrderCreated[$kEO].'</C6>'
    //.' ` AGED='.$OrderAge[$kEO]
    .''
    .'</i>'
    ;
    $PrevTO='';
	$payment='';$decline='';
    //:DC: REJECT
    if($OrderStatus[$kEO]=='awaitingapproval'
       || $OrderStatus[$kEO]=='awaitingpayment'
       || $OrderStatus[$kEO]=='processing'	)
    {
		//:DC: USER CANCEL (~=REJECT)
		//http://localhost/_atensci.us_kenneth/action/event_calendar/order/decline?order_guid=67&event_guid=60&__elgg_ts=1353533144&__elgg_token=85921df560ef601b4c33abb02ca1d2ed
		//http://localhost/_atensci.us_kenneth/action/event_calendar/order/decline?order_guid=67&event_guid=60&__elgg_ts=1353504656&__elgg_token=cb57e5bac315fbcbbd52b61d5d7de660
		//http://ensci.us/kenneth/action/event_calendar/order/decline?order_guid=83&event_guid=71&__elgg_ts=1353533718&__elgg_token=992e39254f4abf32b87532604228d50b
		$body.='<div '.'style="width:400px;float:right;text-align:right;margin-top:-12px;">'
        .'&nbsp;';
        $decline = elgg_view(
                   'output/confirmlink',
                   array(
                         'class'   => "elgg-button elgg-button-delete",	//:DC:	-2
                         'style'  => "width:65px;text-align:center;margin-bottom:5px;",
                         'href'    => 'action/event_calendar/order/decline'
                         .'?order_guid='.$kEO
                         .'&event_guid='.$event->guid,
                         'confirm' => elgg_echo('event_calendar:request:remove:check'),
                         //'text'    => elgg_echo('event_calendar:review_requests:reject'),
                         //````````````````````````````````````````
                         //		..._extend/	select_tickets.php
                         //:DC:	'cancel' language text!
                         'text'    => elgg_echo('event_calendar:cancel_ticket').' '.$vEO->ticket_type_5,
                         //'title'   => elgg_echo('event_calendar:review_requests:reject:title'),
                         'title'   => elgg_echo('event_calendar:cancel_ticket_title'.$vEO->ticket_type_5).')'
                         //:DC:	'cancel'
                         //````````````````````````````````````````
                         //event_calendar:cancel_ticket_title
                         //Cancel all your tickets on this Order (Type
                         //event_calendar:cancel_ticket
                         )
                   );
        if($OrderStatus[$kEO]=='awaitingpayment')
        {
          $payment =  elgg_view(
                   'output/url',
                   array(
                         'class'   => "elgg-button elgg-button-delete",	//:DC:	-2
                         'style'  => "width:125px;text-align:center;margin-right:10px;",
                         'href'    => elgg_add_action_tokens_to_url(elgg_get_site_url() . 'action/event_calendar/payment_retry'
                                                                    .'?order_guid='.$kEO),
                         'text'    => elgg_echo('event_calendar:ticket:reorder'),
                         
                         )
                    );
        }
        $body.='</div>';
		
    }//if(	$event->status == 'awaitingpayment')
    //````````````````````````````````````````
    $body.='<CZ></CZ>';
    //Ticket order 97 (button: cancel)
    //+		Ticket A	2	x	30,25 =		60,50
    //+		TYPE		CTR	x	EACH  =		LINETOT
    $body.='<div style="width:100%;float:left;text-align:left;">'.$OrderDetails[$kEO];
	$body.= '<div style="float:right;">'.$payment.$decline.'</div></div>';
}//foreach($OrderZ as $kEO=>$vEO)
//````````````````````````````````````````
//	::	SELECT TICKETS TO ORDER	::
$body.='<br>';
$body.='<div style="margin-top:55px;padding-top:15px;border-top:1px solid #CCCCCC;"><h2>'.elgg_echo('event_calendar:ticket:list').':</h2><br><CZ></CZ>';//:DC:
$spots_counter = 0;
$doublecheckCTR=0;

for($i = 1; $i <=5; $i++)				//:DC:
{
    $type_var = 'ticket_option_type_' . $i;
    $ticket_type = $event->$type_var;
    $user_total_spots +=$vEO_CTRS[$ticket_type];
}
$tktleft = $event->ticket_option_user_maxspots;

if($user_total_spots >0) {
    $body .='<C2 style="color:red;width:300px;">'.elgg_echo('event_calendar:ticket:usertotalspot')."&nbsp;".$user_total_spots.'</C2>';
    $tktleft = $tktleft - $user_total_spots;
    if($tktleft >0){
        $body .='<C2 style="color:red;width:300px;">'.elgg_echo('event_calendar:ticket:usertotalleft').$tktleft.'</C2>';
    }else{
     $body .='<C2 style="color:red;width:300px;">'.elgg_echo('event_calendar:ticket:usertotalconsumed').'&nbsp;</C2>';
    }
    $body .='<br clear="all">';
}
$body .= "<script>var usertotalleft = ".$tktleft.";</script>";
$body.="";
if(elgg_is_admin_logged_in()){
	$body.="<ul class='me_ul_as_table'><li id='table_header' class ='me_div_as_th' style='width:100%; color:white;'><div class ='me_div_as_td' style='width:160px;'>".elgg_echo('event_calendar:ticket:menu:type')."</div><div class ='me_div_as_td' style='width:80px;'>".elgg_echo('event_calendar:ticket:menu:price')."</div><div class ='me_div_as_td' style='width:120px;'>".elgg_echo('event_calendar:ticket:menu:select')."</div><div class ='me_div_as_td' >".elgg_echo('event_calendar:ticket:menu:meximum_spot')."</div><div class ='me_div_as_td' >".elgg_echo('event_calendar:ticket:menu:total_tickets')."</div><div class ='me_div_as_td' >".elgg_echo('event_calendar:ticket:menu:sold_tickets')."</div><div class ='me_div_as_td' >".elgg_echo('event_calendar:ticket:menu:left_tickets')."</div></li>";
}else{
	$body.="<ul class='me_ul_as_table'><li id='table_header' class ='me_div_as_th' style='width:100%; color:white;'><div class ='me_div_as_td' style='width:200px;'>".elgg_echo('event_calendar:ticket:menu:type')."</div><div class ='me_div_as_td' style='width:100px;'>".elgg_echo('event_calendar:ticket:menu:price')."</div><div class ='me_div_as_td' style='width:150px;'>".elgg_echo('event_calendar:ticket:menu:select')."</div><div class ='me_div_as_td' >".elgg_echo('event_calendar:ticket:menu:meximum_spot')."</div><div class ='me_div_as_td' >".elgg_echo('event_calendar:ticket:menu:sold_tickets')."</div><div class ='me_div_as_td' style='width:100px;'>".elgg_echo('event_calendar:ticket:menu:left_tickets')."</div></li>";
}

//````````````````````````````````````````

for($i = 1; $i <=5; $i++)				//:DC:
{
$body.="<li class='me_li_as_tr'>";
    $type_var = 'ticket_option_type_' . $i;
    $amount_var = 'ticket_option_amount_' . $i;
    $spots_var = 'ticket_option_spots_' . $i;
    $spots_max_var = 'ticket_option_spots_max_' . $i;
    $ticket_type = $event->$type_var;
    $ticket_amount = $event->$amount_var;
    $ticket_spots = $event->$spots_var;
    $ticket_max_spots = $event->$spots_max_var;
    //echo"<br>TYP($ticket_type) + AMT($ticket_amount)";
    if($ticket_type)//&& $ticket_amount)
    {
        //http://localhost/_atensci.us_kenneth/action/event_calendar/attending/export?event_guid=60&__elgg_ts=1353712317&__elgg_token=269fa1f38562e6c02dfbc2c6257d0cfc
        elgg_extend_view('user/default','event_calendar/calendar_toggle');
        $content = elgg_list_entities_from_metadata($options);	//views/default/object/ticket_order.php
        //$body .= '<p> ['.$i.'] ==> ' . $ticket_type . ': ';	//:DC:
        //````````````````````````````````````````
        //	::SOLD OUT::
        if($ticket_spots==0)
        {
            //$body .= elgg_echo('event_calendar:ticket:soldout');
            $ticket_amount_X=number_format($ticket_amount,2,',','.');
            
            $body .= elgg_view('input/hidden', array('name'=>$spots_var,'value'=>0));
            $body .= ''
            .'<div class=me_div_as_td><b>'.$ticket_type.':</b></div><div class=me_div_as_td>'.$ticket_amount_X.'</div><div class=me_div_as_td style="color:red;">'.elgg_echo('event_calendar:ticket:soldout').'</div><div class=me_div_as_td>&nbsp;'.$ticket_max_spots.'</div>';
			 $sold_spot = $grand_total_spot['ticket_type_' . $i];
            if(elgg_is_admin_logged_in()){
                        $total_spot = $ticket_spots + $sold_spot+$grand_total_w4_admin_spot['ticket_type_' . $i];
                        $body.='<div class=me_div_as_td>&nbsp;'.$total_spot.'</div>';
                    }
			$body .= '<div class=me_div_as_td>&nbsp;'.$sold_spot.'</div><div class=me_div_as_td>&nbsp;&nbsp;'.$ticket_spots.'</div>';
        }//if($ticket_spots==0)
        //````````````````````````````````````````
        //	::OVER LIMIT::
        else
			if($vEO_CTRS[$ticket_type]>=$ticket_max_spots)
			{
				//$body .= '<span style="color:red;">'
                //.' # ('.$vEO_CTRS[$ticket_type].') => '
                //.' @ '.$ticket_type.') '
                //.'You have bought '
                //.$vEO_CTRS[$ticket_type]
                //.' Tickets at or over Limit of '
                //.$ticket_max_spots.'</span> '
                //;//:DC:
				//$body .= '<br clear="all">'
				//	.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ticket_type.': Over Limit';
                $ticket_amount_X=number_format($ticket_amount,2,',','.');
                /**/	$body.=''
                .'<div class=me_div_as_td><b>'.$ticket_type.': </b></div>'
                .'<div class=me_div_as_td>'.$ticket_amount_X.'</div>'
                .'<div class=me_div_as_td><span style="color:red;"> &nbsp; &nbsp; '
                .elgg_echo('event_calendar:ticketsmax')//You have bought tickets to the Max. Limit, You cannot buy more.'
                .'</span></div><div class=me_div_as_td>&nbsp;'.$ticket_max_spots.'</div>';
                 $sold_spot = $grand_total_spot['ticket_type_' . $i];
               	 if(elgg_is_admin_logged_in()){
                        $total_spot = $ticket_spots + $sold_spot+$grand_total_w4_admin_spot['ticket_type_' . $i];
                        $body.='<div class=me_div_as_td>&nbsp;'.$total_spot.'</div>';
				}
				$body .='<div class=me_div_as_td>&nbsp;'.$sold_spot.'</div><div class=me_div_as_td>&nbsp;&nbsp;'.$ticket_spots.'</div>';
				//$body.='<!--div style="width:8%;float:left;text-align:left;"-->';
				//$body.='&nbsp;<span style="color:red;">'
				//	.$vEO_CTRS[$ticket_type]
				//	.' / '.$ticket_max_spots.'</span>'
				//	;
			}//if($vEO_CTRZ[$i]>=$ticket_max_spots)
        //````````````````````````````````````````
        //	::SELECT TICKETS::
        /**
         .'<C1> <b>'.$xTYP.': </b></C1>'
         .'<C2>'.number_format($xAMT,2,',','.').'</C2>'
         .'<C3>&nbsp;x&nbsp;'.$xSPO.'</C3>'
         //.' &nbsp; &nbsp; Σ'.$vEO_CTRZ[1].'Σ&nbsp;&nbsp; '
         .'<C4>=</C4>'
         .'<C5>'.number_format($xTOT,2,',','.').' DKK</C5>'
         .'<CZ></CZ>'
         **/
			else
                if($ticket_spots > 0)
                {	//:DC:	BUY!
                    $ticket_amount_X=number_format($ticket_amount,2,',','.');	//:DC:
                    $body.='<div class=me_div_as_td><b>'.$ticket_type.': </b></div>';
                    $body.='<div class=me_div_as_td>'.$ticket_amount_X.'</div>'	//:DC:	&nbsp;&nbsp;DKK
					//.' + '.$vEO_CTRS[$ticket_type]
					//.' + '.$ticket_max_spots
					.'<!--C4>&nbsp;</C4-->'
					;
                    //
                    $vEO_CTRS_Max=$ticket_max_spots;
                    if($vEO_CTRS[$ticket_type]>0)
                        $vEO_CTRS_Max=$ticket_max_spots - $vEO_CTRS[$ticket_type];
                    if($vEO_CTRS_Max > $ticket_spots)
                        $vEO_CTRS_Max=$ticket_spots;
                    //$body.='<div class=me_div_as_td>&nbsp;x&nbsp;</div>';
                    $body.='<div class=me_div_as_td><style>select{width:55px;}</style>&nbsp;x&nbsp;';
					if($tktleft >0){
					$body.= elgg_view(
                               'input/dropdown_tickets',
                               array(
                                     'name'=>$spots_var,
                                     'id'=> $spots_var,
                                     'options' => range( 0, $vEO_CTRS_Max ),
                                     'size'=> 1
                                     )
                               );
							   }else {$body.= $vEO_CTRS_Max;}
                    $body.='</div><div class=me_div_as_td>&nbsp;'.$ticket_max_spots.'</div>';
                    $sold_spot = $grand_total_spot['ticket_type_' . $i];
                    if(elgg_is_admin_logged_in()){
                        $total_spot = $ticket_spots + $sold_spot+$grand_total_w4_admin_spot['ticket_type_' . $i];
                        $body.='<div class=me_div_as_td>&nbsp;'.$total_spot.'</div>';
						
                    }	
                    $body.=		'<div class=me_div_as_td>&nbsp;'.$sold_spot.'</div><div class=me_div_as_td>&nbsp;&nbsp;'.$ticket_spots.'</div><br clear="all">';
                    
                    
                    $doublecheckCTR++;
                }//if($ticket_spots > 0)
        $body .= elgg_view('input/hidden', array('name'=>$type_var,   'value'=>$ticket_type));
        $body .= elgg_view('input/hidden', array('name'=>$amount_var, 'value'=>$ticket_amount));
    }//
    $spots_counter = $spots_counter + $ticket_spots;
	$body.="</li>";
}//	for($i = 1; $i <=5; $i++){			//:DC:
$body.="</ul>";

    

$body.='<div style="clear:both;">';
if($tktleft >0){
$body .= elgg_view('input/hidden', array('name'=>'guid', 'value'=>$event->getGUID()));

$doublecheck = '<div id="confirm_order"></div>';
$doublecheck .= elgg_view(
                          'input/submit'
                          ,array(
                                 'name'=>'submit',
                                 'id'=>'submitConfirm',
                                 'value'=>elgg_echo('event_calendar:ticket:buynow'),
                                 'onClick'=>'formSubmit()'
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
	$body .= '<br><br></div>';
}
    
}//$tktleft >0
//$body .= elgg_view('input/submit', array('name'=>'submit','value'=>elgg_echo('event_calendar:ticket:buynow'), ));

echo $body;

?>
<style type="text/css">
.me_ul_as_table {
	//display:table;
	border-collapse: collapse;
	border-spacing: 0;
	width:100%;
	margin:0px;padding:0px;
}
.me_li_as_tr {
	display: table-row;
}
.me_ul_as_table .me_li_as_tr:nth-child(even){
    background-color:#ffffff  ;
}
.me_ul_as_table .me_li_as_tr:nth-child(odd){
    background-color:#e5e5e5;
}
.me_div_as_td
{
	display:table-cell;
    text-align:center;
	border: 1px solid #000000;
    vertical-align: middle;
}
.me_div_as_th
{
	background-color:gray;
	font-size:16px;
	font-weight:bold;
	display:table-row;
    //text-align:center;
	border: 1px solid #000000;
   // vertical-align: middle;
}
</style>