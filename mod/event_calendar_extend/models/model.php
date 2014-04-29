<?php
    // This function converts an array holding the form key values to a string.
    // The generated string represents the message to be signed by the MAC.
    function createMessage($formKeyValues) {
        $string = "";
        if (is_array($formKeyValues)) {
            sort($formKeyValues); // Sort the posted values by alphanumeric
            foreach ($formKeyValues as $key => $value) {
                if ($key != "MAC") { // Don't include the MAC in the calculation of the MAC.
                    if (strlen($string) > 0) $string .= "&";
                    $string .= "$key=$value"; // create string representation
                }
            }
            return $string;
            
        } else {
            return "An array must be used as input!";
        }
    }
    
    // This function converts from a hexadecimal representation to a string representation.
    function hextostr($hex) {
        $string = "";
        foreach (explode("\n", trim(chunk_split($hex, 2))) as $h) {
            $string .= chr(hexdec($h));
        }
        
        return $string;
    }

    // This function calculates the MAC for an array holding the form key values.
    // The $logfile is optional.
    function calculateMac($formKeyValues, $HmacKey, $logfile = null) {
        // Create the message to be signed.
        if (is_array($formKeyValues)) {
            $messageToBeSigned = createMessage($formKeyValues);
            // Calculate the MAC.
            $MAC = hash_hmac("sha256", $messageToBeSigned, hextostr($HmacKey));
            
            // Following is only relevant if you wan't to log the calculated MAC to a log file.
            if ($logfile) {
                $fp = fopen($logfile, 'a') or exit("Can't open $logfile!");
                fwrite($fp, "messageToBeSigned: " . $messageToBeSigned . PHP_EOL
                       . " HmacKey: " . $HmacKey . PHP_EOL . " generated MAC: " . $MAC . PHP_EOL);
                if (isset($formKeyValues["MAC"]) && $formKeyValues["MAC"] != "")
                    fwrite($fp, " posted MAC:    " . $formKeyValues["MAC"] . PHP_EOL);
            }
            
            return $MAC;
            
        } else {
            die("Form key values must be given as an array");
        }
    }
//Returns the currency set by the admin
//THIS IS OVERRIDEDED
// returns the event or FALSE
function event_calendar_extend_set_event_from_form($event_guid, $group_guid) {
	$event_calendar_times = elgg_get_plugin_setting('times', 'event_calendar');
	$event_calendar_region_display = elgg_get_plugin_setting('region_display', 'event_calendar');
	$event_calendar_type_display = elgg_get_plugin_setting('type_display', 'event_calendar');
	$event_calendar_hide_end = elgg_get_plugin_setting('hide_end', 'event_calendar');
	$event_calendar_more_required = elgg_get_plugin_setting('more_required', 'event_calendar');
	$event_calendar_personal_manage = elgg_get_plugin_setting('personal_manage', 'event_calendar');
	if ($event_calendar_more_required == 'yes') {
		$required_fields = array('title', 'venue', 'start_date',
		'brief_description', 'fees', 'contact', 'organiser',
		'tags');
		if ($event_calendar_times != 'no') {
			$required_fields[] = 'start_time';
			if ($event_calendar_hide_end != 'yes') {
				$required_fields[] = 'end_time';
			}
		}
		if ($event_calendar_region_display == 'yes') {
			$required_fields[] = 'region';
		}
		if ($event_calendar_type_display == 'yes') {
			$required_fields[] = 'event_type';
		}
	} else {
		$required_fields = array('title', 'venue', 'start_date');
	}
	if ($event_guid) {
		$event = get_entity($event_guid);
		if (!elgg_instanceof($event, 'object', 'event_calendar')) {
			// do nothing because this is a bad event guid
			return FALSE;
		}
	} else {
		$user_guid = elgg_get_logged_in_user_guid();
		$event = new ElggObject();
		$event->subtype = 'event_calendar';
		$event->owner_guid = $user_guid;
		if ($group_guid) {
			$event->container_guid = $group_guid;
		} else {
			$event->container_guid = $event->owner_guid;
		}
	}
	$event->access_id = get_input('access_id');
	$event->title = get_input('title');
	$event->description = get_input('description');
	$event->venue = get_input('venue');
	// convert start date from current server time to GMT
	$start_date = get_input('start_date');
	$start_date_text = date("Y-m-d", $start_date);
	$event->start_date = strtotime($start_date_text . " " . date_default_timezone_get());
	$end_date = trim(get_input('end_date', ''));
	if ($end_date) {
		$end_date_text = date("Y-m-d", $end_date);
		$event->end_date = strtotime($end_date_text . " " . date_default_timezone_get());
	} else {
		$event->end_date = '';
	}
	if ($event_calendar_times != 'no') {
		$st = get_input('start_time', '');
		if (is_numeric($st)) {
			$event->start_time = $st;
		} else {
			$event->start_time = '';
		}
		$et = get_input('end_time', '');
		if (is_numeric($et)) {
			$event->end_time = $et;
		} else {
			$event->end_time = '';
		}
		if (is_numeric($event->start_time)) {
			// Set start date to the Unix start time, if set.
			// This allows sorting by date *and* time.
			$event->start_date += $event->start_time * 60;
		}
	}
	if ($event_calendar_spots_display == 'yes') {
		$event->spots = trim(get_input('spots'));
	}
	if ($event_calendar_region_display == 'yes') {
		$event->region = get_input('region');
	}
	if ($event_calendar_type_display == 'yes') {
		$event->event_type = get_input('event_type');
	}
	if ($event_calendar_personal_manage == 'by_event') {
		$event->personal_manage = get_input('personal_manage');
	}
	$event->contact = get_input('contact');
	$event->organiser = get_input('organiser');
	$event->tags = string_to_tag_array(get_input('tags'));
	$event->long_description = get_input('long_description');
    $event->ticket_option_user_maxspots = get_input('ticket_option_user_maxspots');
	$event->real_end_time = event_calendar_get_end_time($event);
	//Add the ticket types
	//limited to 5
	for ($i = 1; $i <= 5; $i++) {
		//					//
		$type_var      	  =           'ticket_option_type_'      . $i;
		$amount_var       =           'ticket_option_amount_'    . $i;
		$spots_var        =           'ticket_option_spots_'     . $i;
		$spots_max_var    =           'ticket_option_spots_max_' . $i;
		//					//
		$ticket_type      = get_input('ticket_option_type_'      . $i);
		$ticket_amount    = get_input('ticket_option_amount_'    . $i);
		$ticket_spots     = get_input('ticket_option_spots_'     . $i);
		$ticket_max_spots = get_input('ticket_option_spots_max_' . $i);
		//					//		
		if ($ticket_type)
		$event->$type_var   = $ticket_type;
		if ($ticket_amount){
			//	:DC:	START
			//	:DC:	EURO FMT::	1.234,56	$ticket_amount
			//	:DC:	convert to numeric
			$AMTL=strlen($ticket_amount);
			$AMTX=str_split($ticket_amount);
			$AMT2='';
			foreach($AMTX as $kX=>$vX)
			{
				if(is_numeric($vX))
				$AMT2.=$vX;
				else
				if($vX==',')
				$AMT2.='.';
			}
			//	:DC:	store converted numeric AMT
			//	:DC:	END
			$ticket_amount=$AMT2;
			//
			$event->$amount_var = $ticket_amount;
		}
		//					//
		//if($ticket_spots)
		$event->$spots_var      = $ticket_spots;
		$event->$spots_max_var  = $ticket_max_spots;
		//					//
	}//for ($i = 1; $i <= 5; $i++)
	foreach ($required_fields as $fn) {
		if (!trim($event->$fn)) {
			return FALSE;
			break;
		}
	}
	if ($event->save()) {
		if ($group_guid && (elgg_get_plugin_setting('autogroup', 'event_calendar') == 'yes')) {
			event_calendar_add_personal_events_from_group($event->guid, $group_guid);
		}
		if (elgg_get_plugin_setting('add_users', 'event_calendar') == 'yes') {
			if (function_exists('autocomplete_member_to_user')) {
				$addusers = get_input('adduser', array());
				foreach ($addusers as $adduser) {
					if ($adduser) {
						$user = autocomplete_member_to_user($adduser);
						$user_id = $user->guid;
						event_calendar_add_personal_event($event->guid, $user_id);
						if (elgg_get_plugin_setting('add_users_notify', 'event_calendar') == 'yes') {
							notify_user($user_id, $CONFIG->site->guid, elgg_echo('event_calendar:add_users_notify:subject'), sprintf(
							elgg_echo('event_calendar:add_users_notify:body'), $user->name, $event->title, $event->getURL()
							)
							);
						}
					}
				}
			}
		}
	}
	return $event;
}
function event_calendar_extend_get_page_content_display_users($event_guid)
{
	//echo"<h2>@ 2 X event_calendar_get_page_content_display_users::($event_guid)::</h2><hr>";//:DC:
	elgg_load_js('elgg.event_calendar');
	$event = get_entity($event_guid);
	if (!elgg_instanceof($event, 'object', 'event_calendar')) {
		$content = elgg_echo('event_calendar:error_nosuchevent');
		$title = elgg_echo('event_calendar:generic_error_title');
	} else {
		event_calendar_handle_menu($event_guid);
		$title = elgg_echo('event_calendar:users_for_event_title', array(htmlspecialchars($event->title)));
		$event_container = get_entity($event->container_guid);
		if (elgg_instanceof($event_container, 'group')) {
			elgg_push_context('groups');
			elgg_set_page_owner_guid($event->container_guid);
			elgg_push_breadcrumb(elgg_echo('event_calendar:group_breadcrumb'), 'event_calendar/group/' . $event->container_guid);
		} else {
			elgg_push_breadcrumb(elgg_echo('event_calendar:show_events_title'), 'event_calendar/list');
		}
		elgg_push_breadcrumb($event->title,$event->getURL());//:DC:FIX/PATCH-BACK;)
		elgg_push_breadcrumb(elgg_echo('event_calendar:users_for_event_breadcrumb'));
		$limit = 12;
		$offset = get_input('offset', 0);
		//echo"<h2>BEFORE event_calendar_get_users_for_event()::</h2><hr>";//:DC:
		//$users = event_calendar_get_users_for_event($event_guid,$limit,$offset,false);
		//echo"<h2>AFTER event_calendar_get_users_for_events()::",count($users),"</h2><hr>";//:DC:
		$options = array('types' => 'object',
		'subtype' => 'ticket_order',
		'metadata_name_value_pairs' => array(
		array('name' => 'event_guid', 'value' => $event->guid, 'operand' => '='),
		array('name' => 'status', 'value' => 'accepted', 'operand' => '='),
		),
		'full_view' => false,
		'limit' => $limit,
		'offset' => $offset
		);
        $tkts = elgg_get_entities_from_metadata($options);
        
        foreach($tkts as $tkt){
            $user = elgg_get_entities_from_relationship(array('relationship' => $tkt->guid, 'relationship_guid' => $event->event_guid,'inverse_relationship' => TRUE,));
            if(!in_array($user[0]->guid,$user_guids))$user_guids[]=$user[0]->guid;
               
        }
        foreach($user_guids as$uguid){
            $users[]= get_entity($uguid);
        }
		//echo"<h2>BEFORE elgg_view_entity_list()::</h2><hr>";//:DC:
		//echo"<h2>BYPASS.......	elgg_extend_view('user/default','event_calendar/calendar_toggle')::</h2><hr>";//:DC:
		//elgg_extend_view('user/default','event_calendar/calendar_toggle');//:DC:
		//echo"<h2>BEFORE elgg_view_entity_list()::</h2><hr>";//:DC:

		$content = elgg_view_entity_list($users,$options);//:DC:EVT-CAL-FULL
		//echo"<h2>AFTER elgg_view_entity_list()::",count($content),"</h2><hr>";//:DC:
		//??$content=elgg_view_entity_list($users,$options,0,$limit,true,false,true);//:DC:EVT-CAL-FULL//:DC:
		//echo"<h2>AFTER elgg_view_entity_list()::==> (",count($content),") </h2><hr>";//:DC:
		if ($event->canedit()) {
			$sidebar = elgg_view('output/url', array('is_action' => TRUE, 'href' => 'action/event_calendar/attending/export?event_guid=' . $event_guid, 'text' => elgg_echo('event_calendar:excel')));
		}
	}
	$params = array('title' => $title, 'content' => $content, 'filter' => '', 'sidebar' => $sidebar);
	$body = elgg_view_layout("content", $params);
	return elgg_view_page($title, $body);
}

//:DC:
function event_calendar_view_orders($event_guid)
{
	elgg_load_js('elgg.event_calendar');
	$event = get_entity($event_guid);
	if (!elgg_instanceof($event, 'object', 'event_calendar'))
	{
		$content = elgg_echo('event_calendar:error_nosuchevent');
		$title = elgg_echo('event_calendar:generic_error_title');
	}
	else
	{
		event_calendar_handle_menu($event_guid);
		$title = elgg_echo('event_calendar:view_orders', array(htmlspecialchars($event->title)));
		$event_container = get_entity($event->container_guid);
		if (elgg_instanceof($event_container, 'group')) {
			elgg_push_context('groups');
			elgg_set_page_owner_guid($event->container_guid);
			elgg_push_breadcrumb(elgg_echo('event_calendar:group_breadcrumb'), 'event_calendar/group/' . $event->container_guid);
		} else {
			elgg_push_breadcrumb(elgg_echo('event_calendar:show_events_title'), 'event_calendar/list');
		}
		elgg_push_breadcrumb($event->title, $event->getURL());
		elgg_push_breadcrumb(elgg_echo('event_calendar:view_orders', array(htmlspecialchars($event->title))));
		$limit = 10;
		$offset = get_input('offset', 0);
		$options = array('types' => 'object',
			'subtype' => 'ticket_order',						//views/default/object/ticket_order.php
			'metadata_name_value_pairs' => array(
				array('name' => 'event_guid', 'value' => $event->guid, 'operand' => '='),
				array('name' => 'status', 'value' => 'declined', 'operand' => '!='),
				),
			'full_view' => false,
			'limit' => $limit,
			'offset' => $offset
			);
		elgg_extend_view('user/default','event_calendar/calendar_toggle');
		$content = elgg_list_entities_from_metadata($options);	//views/default/object/ticket_order.php
		if ($event->canedit()) {
			$sidebar = elgg_view('output/url', array('is_action' => TRUE, 'href' => 'action/event_calendar/attending/export?event_guid=' . $event_guid, 'text' => elgg_echo('event_calendar:excel')));
		}
	}
	$params = array('title' => $title, 'content' => $content, 'filter' => '', 'sidebar' => $sidebar);
	$body = elgg_view_layout("content", $params);
	return elgg_view_page($title, $body);
}
////////////////////////
function compare_tickets($ticketa, $ticketb){
    $orderby = $_SESSION['ectktorderby'];
	if($orderby == 'attendee'){
		$owner1 = get_entity($ticketa->owner_guid);
	$owner2 = get_entity($ticketb->owner_guid);
	return strcmp($owner1->name,$owner2->name);
	}elseif($orderby == 'eventname'){
		$eventa = get_entity($ticketa->event_guid);
	$eventb = get_entity($ticketb->event_guid);
	//echo $eventa."/".$eventb;
	return strcmp($eventa->title,$eventb->title);
	}elseif($orderby == 'amount'){
		if($ticketa->total > $ticketb->total)
			return 1;
		elseif($ticketa->total < $ticketb->total)
			return -1;
		elseif($ticketa->total == $ticketb->total)
			return 0;
	}
}
function event_calendar_get_tickets(array $options = array(),$func='elgg_get_entities'){
    $countopt = $options['count'];
    $limitopt = $options['limit'];
    $offsetopt = $options['offset'];
	$orderby = get_input('orderby','');
     if(!$_SESSION['ectkts']){
        $options['count'] = false;$options['limit'] = 1000;$options['offset'] =0;
        $redo=true;
        $_SESSION['status_filter'] ='all';
        $_SESSION['ectkts'] = $options['func']($options);
    }
	$status_filter = get_input('status','');
	$amount_filter = get_input('amount','');
	$orderid_filter = get_input('orderid','');
	
    if(($status_filter!='' ) and ($_SESSION['status_filter'] != $status_filter)  ){//condition 1
        $_SESSION['status_filter'] = $status_filter; $redo=true;
    }
    if(($amount_filter!='' ) and ($_SESSION['amount_filter'] != $amount_filter)  ){//condition 2
        $_SESSION['amount_filter'] = $amount_filter;$redo=true;
    }
	if(($_SESSION['orderid_filter'] != $orderid_filter)  ){//condition 2
        $_SESSION['orderid_filter'] = $orderid_filter;$redo=true;
    }
    $events_filter = get_input('events','');
    if(($_SESSION['events_filter'] != $events_filter)  ){//condition 2
        $_SESSION['events_filter'] = $events_filter;$redo=true;
    }
	$attendee_filter = get_input('attendee','');
    if(($_SESSION['attendee_filter'] != $attendee_filter)  ){//condition 2
        $_SESSION['attendee_filter'] = $attendee_filter;$redo=true;
    }
    
	if($redo){
        $_SESSION['ectktsASC'] = $_SESSION['ectkts'];

        if($_SESSION['status_filter']!='all'){
            foreach ($_SESSION['ectktsASC'] as $key=>$ticket){
                if($ticket->status !=$status_filter){
                    unset($_SESSION['ectktsASC'][$key]);
                }
            }
        }
	
        if($_SESSION['amount_filter']>0){
                foreach ($_SESSION['ectktsASC'] as $key=>$ticket){
                    if($ticket->total  <$amount_filter){
                        unset($_SESSION['ectktsASC'][$key]);
                    }
                }
        }
		if($_SESSION['orderid_filter'] !=''){
            foreach ($_SESSION['ectktsASC'] as $key=>$ticket){
                if(stripos(strval($ticket->guid),$_SESSION['orderid_filter'])  === FALSE) {
                    unset($_SESSION['ectktsASC'][$key]);
                }
            }
        }
        if($_SESSION['events_filter'] !=''){
            foreach ($_SESSION['ectktsASC'] as $key=>$ticket){
                $event = get_entity($ticket->event_guid);
                if(stripos($event->title,$_SESSION['events_filter'])    === FALSE){
                    unset($_SESSION['ectktsASC'][$key]);
                }
            }
        }
		if($_SESSION['attendee_filter'] !=''){
            foreach ($_SESSION['ectktsASC'] as $key=>$ticket){
                $owner = get_entity($ticket->owner_guid);
                if(stripos($owner->name,$_SESSION['attendee_filter'])    === FALSE){
                    unset($_SESSION['ectktsASC'][$key]);
                }
            }
        }
    }
	
	if(($redo) or ($_SESSION['ectktorderby'] !=$orderby)){
		if($_SESSION['ectktorderby'] !=$orderby){
			$_SESSION['ectktorderby'] = $orderby;
		} 
		usort($_SESSION['ectktsASC'],'compare_tickets');
	}

    $sorting = get_input('sorting','ASC');
   if($countopt) {
        return count($_SESSION['ectktsASC']);
    }
    else {
        if($sorting == 'DESC') {
            $count = count($_SESSION['ectktsASC']);
            if($count > ($offsetopt+$limitopt)){ $offsetopt = $count-$offsetopt- $limitopt;}
            else {$limitopt=$count-$offsetopt;$offsetopt=0;}
            return array_reverse(array_slice($_SESSION['ectktsASC'],$offsetopt,$limitopt));
        }else
	        return array_slice($_SESSION['ectktsASC'],$offsetopt,$limitopt);
        }

}
////////////////////////////
function event_calendar_view_all_orders($event_guid)
{
?>
<style type="text/css">
.elgg-list > li {
    border-bottom: none;
}
.table_order_list {
    display:table;
    border-collapse: collapse;
}
.table_order_item {
display: table-row;
    border-collapse: collapse;
}

.table_order_list .table_order_item:nth-child(even){
    background-color:#ffffff  ;
}
.table_order_list .table_order_item:nth-child(odd){
    background-color:#e5e5e5;
}
.me_div_as_th
{
	background-color:gray;
	font-size:16px;
	font-weight:bold;
	display:table-row;
	border: 1px solid #000000;
}
</style>
<script>
function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
    separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}

function on_select_limit(limit){
    window.location =  updateQueryStringParameter(window.location.href,'limit',limit);
}
function on_select_sorting(field,sorting){
     var newurl =  updateQueryStringParameter(window.location.href,'orderby',field);
	 if(sorting !=''){
		newurl =  updateQueryStringParameter(newurl,'sorting',sorting);
	 }
	 window.location = newurl;
}
function on_select_status(status){
    window.location =  updateQueryStringParameter(window.location.href,'status',status); //aj1
}
function on_select_amount(amount){
    window.location =  updateQueryStringParameter(window.location.href,'amount',amount); //aj1
}
function on_select_orderid(orderid,e){
     if (typeof e == 'undefined' && window.event) { e = window.event; }
        if (e.keyCode == 13)
        {
			window.location =  updateQueryStringParameter(window.location.href,'orderid',orderid);
			document.getElementById('btnSearch').click();
        }
}
function on_select_events(events,e){
     if (typeof e == 'undefined' && window.event) { e = window.event; }
        if (e.keyCode == 13)
        {
			window.location =  updateQueryStringParameter(window.location.href,'events',events);
			document.getElementById('btnSearch').click();
		}
}
function on_select_attendee(attendee,e){
     if (typeof e == 'undefined' && window.event) { e = window.event; }
        if (e.keyCode == 13)
        {
			window.location =  updateQueryStringParameter(window.location.href,'attendee',attendee);
			document.getElementById('btnSearch').click();
		}
}
function on_select_order(order){
    window.location =  updateQueryStringParameter(window.location.href,'orderby',order);
}
</script>
<?php
    global $CONFIG;
    elgg_load_js('elgg.event_calendar');
    elgg_push_breadcrumb(elgg_echo('event_calendar:show_events_title'), 'event_calendar/list');
    $title = elgg_echo('event_calendar:view_all_orders' );

 		$limit = get_input('limit', 10);
		$offset = get_input('offset', 0);
    
    
		$options = array('types' => 'object',
                         'subtype' => 'ticket_order',	
                         'metadata_name_value_pairs' => array( array('name' => 'status', 'value' => 'declined', 'operand' => '!='),),
                         'full_view' => false,
                         'table_view' => true,
                         'limit' => $limit,
                         'offset' => $offset,
                         'list_class'=> 'table_order_list',
                         'item_class' =>'table_order_item'
                         );


	$orderid_arr = get_input('orderid',0);	
    $orderby = get_input('orderby', '');
	$sorting = get_input('sorting','');
	
    elgg_extend_view('user/default','event_calendar/calendar_toggle');
    $limits = array('10','15','20','30','50','70','100');
	$content .= elgg_echo('event_calendar:pagelimit').
                elgg_view('input/dropdown',array( 'name' => 'limit','value'=>$limit,'options'=>array_combine($limits, $limits)  ,'onchange'=>'on_select_limit(this.value)'));
    
    $content .=  "<div style='display: table-row;clear:both;'>";
    $text1 = "border:1px solid;display: table-cell;vertical-align:middle;text-align:center;'>";
    $text2 = $text1."<a href='#' onclick='on_select_order(\"";
	$status_value = array('all','accepted','awaitingapproval','processing'); //aj1
	//$amount_disp = array('>=10','>=50','>=70','>=100','>=120','>=150','>=200','>=250','>=300','>=400','>=500'); //aj1
	$amount_value = array('0','10','50','70','100','120','150','200','250','300','400','500','1000','2000','5000'); //aj1
	
	$sorting_path = elgg_get_site_url()."mod/event_calendar_extend/graphics/";
    $content .=  "<li id='table_header' class ='me_div_as_th' style='display:table-header-group;' ><div  style='width:150px;".$text1.elgg_echo('event_calendar:orderid')."<img src='{$sorting_path}trans.png' style='height:20px; width:20px;'> ".
	elgg_echo('').
                elgg_view("input/text", array('name' => 'name','value' => $orderid_arr, 'onkeypress'=>'on_select_orderid(this.value,event)',))."</div>";
				
				
    $sorting_path = elgg_get_site_url()."mod/event_calendar_extend/graphics/";
	
	if($orderby == 'eventname'){
	$opacity = 1;
		 if ($sorting == 'DESC'){

        $sorting_path = "<img src='{$sorting_path}sort_down_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
		$newsorting='ASC';
		//$orderby='event';
    }else{

        $sorting_path = "<img src='{$sorting_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
		$newsorting='DESC';

    }
	}else{
	$opacity =0.3;
	        $sorting_path = "<img src='{$sorting_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
		$newsorting='DESC';
	}
    	 
    
    $events_filter = get_input('events',$_SESSION['events_filter']);
    $content .=  "<div style='width:200px;".$text1.elgg_echo('event_calendar:eventtitle')."&nbsp;&nbsp;".
	elgg_echo('').
                elgg_view('output/url',array( 'name'=> 'event','text' => $sorting_path,'href' => "event_calendar/view_all_orders"
                                                      ."?orderby=eventname"
                                                      ."&sorting="
                                                      .$newsorting,
                                                      'is_action' => TRUE,
													  )).
													  elgg_echo('').
                elgg_view("input/text", array('name' => 'event','value' => $events_filter, 'onkeypress'=>'on_select_events(this.value,event)',)).
	"</div>";

	$orderby_path = elgg_get_site_url()."mod/event_calendar_extend/graphics/";
	 
     
	 if (($orderby == '') or ($orderby == 'attendee')){
	 $opacity = 1;
	 if ($sorting == 'DESC'){
        $orderby_path = "<img src='{$orderby_path}sort_down_green.png' height='20px' width='20px' style='opacity:$opacity;'></img>";
		$newsorting='ASC';

    }else{
        $orderby_path = "<img src='{$orderby_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
		$newsorting='DESC';
		}
	}else{
		$opacity =0.3;
	        $orderby_path = "<img src='{$orderby_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
		$newsorting='DESC';
	}
	$attendee_filter = get_input('attendee',$_SESSION['attendee_filter']);
    $content .=  "<div style='width:140px;".$text1.elgg_echo('event_calendar:attendee').
elgg_echo('').
                elgg_view('output/url',array('name'=> 'attendee', 'text' => $orderby_path,
				'href' => "event_calendar/view_all_orders"
                                                      ."?orderby=attendee"
                                                      ."&sorting="
                                                      .$newsorting,
                                                      'is_action' => TRUE,
													  )).elgg_echo('').
                elgg_view("input/text", array('id' => 'search_attendee','name' => 'attendee','value' => $attendee_filter, 'onkeypress'=>'on_select_attendee(this.value,event)',)).
	"</div>";
    
    $status_filter = get_input('status',$_SESSION['status_filter']);
	$amount_filter = get_input('amount',$_SESSION['amount_filter']);
    
	$amount_path = elgg_get_site_url()."mod/event_calendar_extend/graphics/";
	 if (($orderby == '') or ($orderby == 'amount')){
		$opacity = 1;
		if ($sorting == 'DESC'){
			$amount_path = "<img src='{$amount_path}sort_down_green.png' height='20px' width='20px' style='opacity:$opacity;'></img>";
			$newsorting='ASC';
		}else{
			$amount_path = "<img src='{$amount_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
			$newsorting='DESC';
		}
	}else{
		$opacity =0.3;
	    $amount_path = "<img src='{$amount_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
		$newsorting='DESC';
	}
	
    $content .=  "<div style='width:100px;".$text1.elgg_echo('event_calendar:amount').
	elgg_echo('').
                elgg_view('output/url',array('name'=> 'amount', 'text' => $amount_path,
				'href' => "event_calendar/view_all_orders"
                                                      ."?orderby=amount"
                                                      ."&sorting="
                                                      .$newsorting,
                                                      'is_action' => TRUE,
													  )).elgg_echo('').
                elgg_view('input/dropdown',array( 'name' => 'amount','style'=>'width:100px','value'=>$amount_filter,'options'=>array_combine($amount_value, $amount_value),'onchange'=>'on_select_amount(this.value)',))."</div>";

	$sorting_path = elgg_get_site_url()."mod/event_calendar_extend/graphics/";
    $content .=  "<div style='width:130px;".$text1.elgg_echo('event_calendar:status')."<img src='{$sorting_path}trans.png' style='height:20px; width:20px;'>".
	elgg_echo('').
                elgg_view('input/dropdown',array( 'name' => 'status_value','value'=>$status_filter,'options'=>array_combine($status_value, $status_value)  ,'onchange'=>'on_select_status(this.value)',))."</div>";
    $content .=  "</li>";

        $options['func'] = "elgg_get_entities_from_metadata";
        $content .= elgg_list_entities($options,'event_calendar_get_tickets','elgg_view_entity_list');    
    
    $params = array('title' => $title, 'content' => $content, 'filter' => '', 'sidebar' => $sidebar);
	$body = elgg_view_layout("content", $params);
$body .= <<<___HTML
	<script  type="text/javascript">
	$(document).ready(function() {
    if($(".table_order_list").length){
        $(".table_order_list").prepend($("#table_header"));
        $('#table_header').show();
    }
});
</script>
___HTML;
	
	return elgg_view_page($title, $body);
}
    
function event_calendar_extend_handle_menu($event_guid) {
	$event = get_entity($event_guid);
	$event_calendar_personal_manage = elgg_get_plugin_setting('personal_manage', 'event_calendar');
	//if ((($event_calendar_personal_manage == 'by_event') && ($event->personal_manage == 'closed' || $event->personal_manage == 'closedfuture_keep_list')) 
		//|| (($event_calendar_personal_manage == 'closed') || ($event_calendar_personal_manage == 'no'))) {
//:DC::
		$url =  "event_calendar/view_orders/$event_guid";
		$item = new ElggMenuItem('event-calendar-0review_requests', elgg_echo('event_calendar:review_order_menu_title'), $url);
		$item->setSection('event_calendar');
		elgg_register_menu_item('page', $item);
		//add_submenu_item(elgg_echo('event_calendar:review_requests_title'), $CONFIG->wwwroot . "pg/event_calendar/review_requests/".$event_id, '0eventcalendaradmin');
	//}
	$event_calendar_add_users = elgg_get_plugin_setting('add_users', 'event_calendar');
	if ($event_calendar_add_users == 'yes') {
		$url =  "event_calendar/manage_users/$event_guid";
		$item = new ElggMenuItem('event-calendar-1manage_users', elgg_echo('event_calendar:manage_users:breadcrumb'), $url);
		$item->setSection('event_calendar');
		elgg_register_menu_item('page', $item);
	}
}

function event_calendar_extend_get_page_content_view($event_guid) {
	// add personal calendar button and links
	elgg_push_context('event_calendar:view');
	$event = get_entity($event_guid);
	if (!elgg_instanceof($event, 'object', 'event_calendar')) {
		$content = elgg_echo('event_calendar:error_nosuchevent');
		$title = elgg_echo('event_calendar:generic_error_title');
	} else {
		$title = htmlspecialchars($event->title);
		$event_container = get_entity($event->container_guid);
		if (elgg_instanceof($event_container, 'group')) {
			if ($event_container->canEdit()) {
//:DC::
				event_calendar_extend_handle_menu($event_guid);
			}
			elgg_push_breadcrumb(elgg_echo('event_calendar:group_breadcrumb'), 'event_calendar/group/' . $event->container_guid);
		} else {
			if ($event->canEdit()) {
//:DC::
				event_calendar_extend_handle_menu($event_guid);
			}
			elgg_push_breadcrumb(elgg_echo('event_calendar:show_events_title'), 'event_calendar/list');
		}
		elgg_push_breadcrumb($event->title);
		$content = elgg_view_entity($event, array('full_view' => true));
		//check to see if comment are on - TODO - add this feature to all events
		if ($event->comments_on != 'Off') {
			$content .= elgg_view_comments($event);
		}
	}
	$params = array('title' => $title, 'content' => $content, 'filter' => '');
	$body = elgg_view_layout("content", $params);
	return elgg_view_page($title, $body);
}
/* OVERIDE FOR EVENT STATUS CHECK
*/
// returns open, closed or private for the given event and user
function event_calendar_extend_personal_can_manage($event, $user_id) {
	$status = 'private';
	$event_calendar_personal_manage = elgg_get_plugin_setting('personal_manage', 'event_calendar');
	if (!$event_calendar_personal_manage
			|| $event_calendar_personal_manage == 'open'
			|| $event_calendar_personal_manage == 'yes'
			|| (($event_calendar_personal_manage == 'by_event' && (!$event->personal_manage || ($event->personal_manage == 'open'))))) {
		$status = 'open';
	} else {
		// in this case only admins or event owners can manage events on their personal calendars
		if ($event && ($event->owner_guid == $user_id)) {
			$status = 'open';
		} else if (($event_calendar_personal_manage == 'closed')
				|| ($event_calendar_personal_manage == 'no')
				|| (($event_calendar_personal_manage == 'by_event') && $event->personal_manage == 'closed')) {
			$status = 'closed';
		}
	}
	return $status;
}
function event_calendar_currency() {
	return elgg_get_plugin_setting('currency', 'event_calendar');
}
function epay_check_hash() {
	/*$params = $_GET;
	$var = "";
	array_shift($params);
	array_shift($params);
	foreach ($params as $key => $value) {
		if ($key != "MAC") {
			$var .= $value;
		}
	}
	$genstamp = md5($var . elgg_get_plugin_setting('md5secret', 'event_calendar'));
	if ($genstamp != $_GET["hash"]) {
		return false;
	} else {
		return true;
	}*/
    /*
	foreach($_REQUEST as $key => $value) {
		if ($key != "MAC") {
			$a_REQUEST[$key]= $value;
		}
	}
	$HmacKey = '254c504c4e376c7379792a4265397c4929353562494b5e6c427c71215630556836366d7776583862523330676a74785e522a304f52613b7450403f6b577a7950';
	//schin $MAC = calculateMac($_POST, $HmacKey, $logfile);
	//echo 'localy calculated MAC is '.$MAC."\n";
	if ($MAC != $_POST["MAC"]) {
		//echo "MAC IS not MATCHING";
		return false;
	} else {
		//echo "MAC IS MATCHING";
		return true;
	}*/
	
}
function event_calendar_payment_success($event, $user_guid, $orderid) {
	//add request to event because payment has been verified
	//check to see if event is open, closed etc
	$cal_status = event_calendar_extend_personal_can_manage($event, $user_guid);
	if ($cal_status == 'open') {
		event_calendar_add_personal_event($event->getGuid(), $user_guid);
	}
	//remove relationship because we dont need it anymore
	remove_entity_relationship($event->guid, $orderid, $user_guid);
	$order = get_entity($orderid);
	//remove those tickets from sale
	//deduct the spots	
	for ($i = 1; $i <= 5; $i++) {
		$spots_var = 'ticket_spots_' . $i;
		$ticket_spots = $order->$spots_var;
		elgg_set_context('event_update_spots');
		event_calendar_decrease_spots($event->getGUID(), $i, $ticket_spots);
	}
	//set to accepted if open
	if ($event->personal_manage == 'open') {
		$order->status = 'accepted';
	} else {
		$order->status = 'processing';
	}
	//set the transaction id
	$order->txnid = get_input('transaction');
	$order->save();
	$itemised = '';
	for ($i = 1; $i <= 5; $i++) {
		$type_var = 'ticket_type_' . $i;
		$amount_var = 'ticket_amount_' . $i;
		$spots_var = 'ticket_spots_' . $i;
		//``````````````````````````````````````````````````````````````````````````````````````````````````
		if($order->$type_var)				//:DC:
		{
			//``````````````````````````````````````````````````````````````````````````````````````````````````
			$itemised.=
				'<p><b>'
				.$order->$type_var
				.'--> </b> (DKK &nbsp;&nbsp; '
				.number_format($order->$amount_var,2,',','.')	//:DC:
				.') x &nbsp; '
				.$order->$spots_var.' = DKK '
				.number_format(($order->$amount_var*$order->$spots_var),2,',','.') //:DC:
				."</p>\r\n"
			;
		}
	}
	$user = get_entity($order->getOwnerGUID());//sachin
	
	if($order->status=='processing')
	{
		notify_user(
			$order->getOwnerGUID(),
			$event,
			elgg_echo(
				'event_calendar:order:created:subject',
				array(htmlspecialchars($event->title))
				),
			elgg_echo(
				'event_calendar:order:created:message',
				array(
					htmlspecialchars($event->title),			// 1
					htmlspecialchars($order->guid),				// 2
					htmlspecialchars($order->txnid),			// 3
					htmlspecialchars($user->username),			// 4
					date("d-m-Y", time()),						// 5
					htmlspecialchars($event->venue),			// 6
					$itemised,									// 7
					htmlspecialchars(							// 8
						number_format($order->total,2,',','.')	//		:DC:EURO FMT$
					)
				)
			),
			NULL,
			array('site', 'email')
		);
	}else{/**	> You have now recieved the tickets for		//:DC:
				> NEW A 
				> Order id: 77 
				> Transfer id:
				> 12877839 Username: kenneth 
				> Date: 23-10-2012 
				> Venue: NEW A
				> The ticket(s) contain  A:
				> (DKK  1234.75)  x  2  =  DKK kr.
				> 1234.75  Total: 2469.5			**/
		notify_user(
		$order->getOwnerGUID()
		,$event
		,elgg_echo('event_calendar:order:accepted:subject'
		,array(
		htmlspecialchars($event->title))
		)
		,elgg_echo('event_calendar:order:accepted:message'
		,array(
		htmlspecialchars($event->title)
		,htmlspecialchars($order->guid)
		,htmlspecialchars($order->txnid)
		,htmlspecialchars($user->username)
		,date("d-m-Y",time())
		,htmlspecialchars($event->venue)
		,$itemised
		,htmlspecialchars(number_format($order->total,2,',','.'))	//:DC:
		)
		)
		,NULL
		,array('site','email')
		);
	}//if ($order->status == 'processing') {
	return true;
}
function event_calendar_get_page_content_payment($page) {

//sachin print_r( $_POST);
	if ($page[1] == 'accept') {
		$orderid = get_input('orderid');
		$user_guid = elgg_get_logged_in_user_guid();
		$ammount = get_input('amount');
		$currency = get_input('currency');
		$hash = get_input('MAC');
		$event = elgg_get_entities_from_relationship(array('relationship' => $orderid, 'relationship_guid' => $user_guid));
		if (epay_check_hash() && $event) {
			$success = true;
		} else {
			$success = true;//sachin
		}
	} else {
		$success = false;
	}
	$event_guid = str_replace($user_guid, '', $orderid);
	//$event = get_entity($event_guid);
	elgg_register_menu_item('title', array(
	'name' => 'returnto',
	'text' => elgg_echo('event_calendar:returnto'),
	'href' => $event[0]->getUrl(),
	'link_class' => 'elgg-button elgg-button-action',
	'is_action' => false,
	));
	if ($success) {
		if (event_calendar_payment_success($event[0], $user_guid, $orderid)) {
			$title = elgg_echo("event_calendar:payment:accepted");
            $content = elgg_echo('event_calendar:payment:accepted_detail',
                                 array($orderid ,get_input('transaction'))
                                 );
		}
	} else {
		$title = elgg_echo("event_calendar:payment:declined");
		$content = 'Sorry, the payment was not accepted';
	}
	$params = array('title' => $title,
	'filter' => '',
	'content' => $content
	);
	$body = elgg_view_layout("content", $params);
	return elgg_view_page($title, $body);
}
function event_calendar_get_orders($event_guid, $limit, $offset) {
	$options = array('types' => 'object',
	'subtype' => 'ticket_order',
	'metadata_name_value_pairs' => array(
	array('name' => 'event_guid', 'value' => $event_guid, 'operand' => '='),
	array('name' => 'status', 'value' => 'declined', 'operand' => '!='),
	),
	'limit' => $limit,
	'offset' => $offset
	);
	return elgg_get_entities_from_metadata($options);
}
function event_calendar_get_accepted_orders($event_guid, $limit, $offset) {
	$options = array('types' => 'object',
	'subtype' => 'ticket_order',
	'metadata_name_value_pairs' => array(
	array('name' => 'event_guid', 'value' => $event_guid, 'operand' => '='),
	array('name' => 'status', 'value' => 'accepted', 'operand' => '='),
	),
	'limit' => $limit,
	'offset' => $offset
	);
	return elgg_get_entities_from_metadata($options);
}
function event_calendar_decrease_spots($event_guid, $ticket_no, $amount) {
	$event = get_entity($event_guid);
	$spots_var = 'ticket_option_spots_' . $ticket_no;
	$event->$spots_var = $event->$spots_var - $amount;
	return $event->save();
}
function event_calendar_increase_spots($event_guid, $ticket_no, $amount) {
	$event = get_entity($event_guid);
	$spots_var = 'ticket_option_spots_' . $ticket_no;
	$event->$spots_var = $event->$spots_var + $amount;
	return $event->save();
}