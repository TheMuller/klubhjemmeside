<script>
	function EuroCurrency(number)		//:DC: Euro Currency Number Format
	{
		var numberStr = parseFloat(number).toFixed(2).toString();
		var numFormatDec = numberStr.slice(-2); /*decimal 00*/
		numberStr = numberStr.substring(0, numberStr.length-3); /*cut last 3 strings*/
		var numFormat = new Array;
		while (numberStr.length > 3) {	
			numFormat.unshift(numberStr.slice(-3));
			numberStr = numberStr.substring(0, numberStr.length-3);
		}
		numFormat.unshift(numberStr);
		return numFormat.join('.')+','+numFormatDec; /*format 000.000.000,00 */
	}

	function doublecheck(){
		//clear any html we put in ealier
		document.getElementById("confirm_order").innerHTML = '<br>';
		var theForm = document.forms["tickets"];
		var total=0;
        var totalspot=0;
		var freectr=0;
		for($i = 1; $i <=5; $i++){
			//
			var type = theForm.elements["ticket_option_type_"+$i];
			var amount = theForm.elements["ticket_option_amount_"+$i];
			var spots = $("#ticket_option_spots_"+$i+" option:selected").text();
            if(type  && spots > 0){
                totalspot = totalspot+ parseInt(spots);
            }
			//:DC: Euro Currency Number Format - START
			if(type && amount && spots > 0)		//:DC:
			{
				if(!amount.value)
					amount.value=0;
				var subtotal = amount.value*spots;
				//if(subtotal>0)
				{
					total = total+subtotal;
					document.getElementById("confirm_order").innerHTML += '' +
						'&nbsp;&nbsp;&nbsp;&nbsp; <b>' 	+ 
						type.value 						+ 
						': </b>'						+ 
						EuroCurrency(amount.value) 		+ 
						'&nbsp;x&nbsp; ' 				+ 
						spots 							+ 
						'&nbsp;=&nbsp;'					+ 
						EuroCurrency(subtotal) 			+
						' DKK<br>'						+
						''
					;
				}
			}//:DC: Euro Currency Number Format - END
		}
        if(totalspot > usertotalleft){
			document.getElementById("confirm_order").innerHTML += '' +	//:DC:
            '<br><b><?php echo elgg_echo('event_calendar:ticket:usertotalleft');?>'+usertotalleft+'</b><br><br>';
            $("#submitConfirm").hide();
        }
		else if(total>0){
			document.getElementById("confirm_order").innerHTML += '' +	//:DC:
				'&nbsp;&nbsp;&nbsp;&nbsp;<b>Total: </b>' + 
				EuroCurrency(total) 						+ 
				' DKK<br><br>';
            $("#submitConfirm").show();
		}else{
			document.getElementById("confirm_order").innerHTML += '' +	//:DC:
				'<br><b>Nothing to Pay !</b><br><br>';
			$("#submitConfirm").show();
		}
	}
	function formSubmit()
	{
		document.forms["tickets"].submit();
	}
</script>
<?php

/**
 * Elgg event_calendar object view
 * 
 * @package event_calendar
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Kevin Jardine <kevin@radagast.biz>
 * @copyright Radagast Solutions 2008
 * @link http://radagast.biz/
 * 
 */

$event = $vars['entity'];
$full = elgg_extract('full_view', $vars, FALSE);

if ($full) {
	$body = elgg_view('event_calendar/strapline',$vars);
	$event_items = event_calendar_get_formatted_full_items($event);
	$body .= '<br />';
	
	foreach($event_items as $item) {
		$value = $item->value;
		if (!empty($value)) {
				
			//This function controls the alternating class
			$even_odd = ( 'odd' != $even_odd ) ? 'odd' : 'even';
			$body .= "<p class=\"{$even_odd}\"><b>";
			$body .= $item->title.':</b> ';
			$body .= $item->value;
			$body .= "</p>";
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	/**
	$personal_manage_options=array(
	event_calendar:
	personal_manage:open=>						'open',						$$
	personal_manage:closed=>					'closed',					$$
	personal_manage:closedfuture_keep_list=>	'closedfuture_keep_list',	..
	personal_manage:closedfuture_no_list=>		'closedfuture_no_list',		..
	personal_manage:private=>					'private',					$$
	);
	**/
	////////////////////////////////////////////////////////////////////////////////
	//closed/open status
	$body .= '<p><b>' . elgg_echo('event_calendar:event:status') . ':</b> ' . elgg_echo('event_calendar:event:status:' . $event->personal_manage) . '</p>'; 
	if(		// TICKETS **
		(
			  1==1
			||$event->personal_manage=='open'
			||$event->personal_manage=='closed'
			||$event->personal_manage=='private'
		)
		&&
		(
			  $event->ticket_option_type_1
			||$event->ticket_option_type_2
			||$event->ticket_option_type_3
			||$event->ticket_option_type_4
			||$event->ticket_option_type_5
		)
	)
	{
		////$body .= '<p><b>' . elgg_echo('event_calendar:ticket:list') . ':</b></p>';
//$body .= '<hr size=7 color=blue noshade>';	//:DC:?	
		$body .= elgg_view_form('event_calendar/select_tickets', array('name'=>'tickets'),array('entity'=>$event));
//$body .= '<hr size=6 color=blue noshade>';	//:DC:?	
	}//::open,closed,priv & type 1,2,3,4,5
	elseif
	(
		  $event->personal_manage=='closedfuture_keep_list'
		||$event->personal_manage=='closedfuture_no_list'
	)
	{
		$body .= elgg_view('output/url', array(
			'href' => false,
			'class' => 'elgg-button elgg-button-submit',
			'text' =>  elgg_echo('event_calendar:request:closedfuture'),
		));
	}//personal_manage:closed.future keep,no list
	else
	{
		$body .= elgg_view('output/url', array(
			'href' =>elgg_add_action_tokens_to_url("action/event_calendar/select_tickets/no_payment?guid={$event->guid}"),
			'class'=>'elgg-button elgg-button-submit',
			'text'=>
			//'[::closure::else::] <br>'
			//.' E_P_M=> ('.$event->personal_manage.') <br>'
			//.' T_O_Y>= ('.$event->ticket_option_type_1.') '
			//.'<hr>'
			elgg_echo('event_calendar:make_request_title:free'),
		));
	}//closure::else::open,closed,priv & type 1,2,3,4,5
	////////////////////////////////////////////////////////////////////////////////
	 
	$metadata = elgg_view_menu('entity', array(
		'entity' => $event,
		'handler' => 'event_calendar',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
	
	$tags = elgg_view('output/tags', array('tags' => $event->tags));
	
	$params = array(
		'entity' => $event,
		'metadata' => $metadata,
		'tags' => $tags,
		'title' => false,
	);
	$list_body = elgg_view('object/elements/summary', $params);
	echo $list_body;
	echo $body;
	if ($event->long_description) {
		echo '<p>'.$event->long_description.'</p>';
	} else {
		echo '<p>'.$event->description.'</p>';
	}
	if (elgg_get_plugin_setting('add_to_group_calendar', 'event_calendar') == 'yes') {
		echo elgg_view('event_calendar/forms/add_to_group',array('event' => $event));
	}
} else {
	
	$time_bit = event_calendar_get_formatted_time($event);
	$icon = '<img src="'.elgg_view("icon/object/event_calendar/small").'" />';
	$extras = array($time_bit);
	if ($event->description) {
		$extras[] = $event->description;
	}
	
	if ($event_calendar_venue_view = elgg_get_plugin_setting('venue_view', 'event_calendar') == 'yes') {
		$extras[] = $event->venue;
	}
	if ($extras) {
		$info = "<p>".implode("<br />",$extras)."</p>";
	} else {
		$info = '';
	}
	
	if (elgg_in_context('widgets')) {
		$metadata = '';
	} else {
		$metadata = elgg_view_menu('entity', array(
			'entity' => $event,
			'handler' => 'event_calendar',
			'sort_by' => 'priority',
			'class' => 'elgg-menu-hz',
		));
	}
	
	$tags = elgg_view('output/tags', array('tags' => $event->tags));
	
	$params = array(
		'entity' => $event,
		'metadata' => $metadata,
		'subtitle' => $info,
		'tags' => $tags,
	);
    $soldouttext = elgg_echo('event_calendar:ticket:soldout')."&nbsp;";
    for($i = 1; $i <=5; $i++)				//:DC:
    {
        $spots_var = 'ticket_option_spots_' . $i;
        $ticket_spots = $event->$spots_var;
        if($ticket_spots >0){$soldouttext='';break;}
    }
    if($soldouttext !='')
        $params['title'] = "<a href='".$event->getURL()."'>".$soldouttext.$event->title."</a>";
        
	$list_body = elgg_view('object/elements/summary', $params);
	
	echo elgg_view_image_block($icon, $list_body);
}

?>