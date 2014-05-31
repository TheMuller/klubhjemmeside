<?php
/**
*  Event calendar plugin
*
* @package event_calendar
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
* @author Kevin Jardine <kevin@radagast.biz>
* @copyright Radagast Solutions 2008-2011
* @link http://radagast.biz/
*/
elgg_register_event_handler('init', 'system', 'event_calendar_extend_init');
function event_calendar_extend_init() {
	elgg_register_library('elgg:event_calendar_extend', elgg_get_plugins_path() . 'event_calendar_extend/models/model.php');
	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('event_calendar', 'event_calendar_extend_page_handler');
	// entity menu
	elgg_unregister_plugin_hook_handler('register', 'menu:entity', 'event_calendar_entity_menu_setup');
	elgg_register_plugin_hook_handler  ('register', 'menu:entity', 'event_calendar_extend_entity_menu_setup');

    elgg_extend_view("css/elgg", "event_calendar_extend/css");

	// register actions
//	$action_path = elgg_get_plugins_path().'event_calendar       /actions/event_calendar';	//checked!!		
	$action_path = elgg_get_plugins_path().'event_calendar_extend/actions/event_calendar';
	elgg_register_action("event_calendar/edit"						, "$action_path/edit.php");
	elgg_register_action("event_calendar/payment/"					, "$action_path/payment_gateway.php");
	elgg_register_action("event_calendar/order/accept"				, "$action_path/accept_order.php");		
	elgg_register_action("event_calendar/order/decline"				, "$action_path/decline_order.php");	
	////
	
	
	elgg_register_action("event_calendar/select_tickets"			, "$action_path/payment_gateway.php");
	elgg_register_action("event_calendar/select_tickets/no_payment"	, "$action_path/order_no_payment.php");
	elgg_register_action("event_calendar/attending/export"			, "$action_path/attending_export.php");
	elgg_register_action("event_calendar/attending"					, "$action_path/attending.php");
    
    elgg_register_action("event_calendar/payment_retry"			, "$action_path/payment_gateway_retry.php");
	//
	register_plugin_hook('permissions_check', 'all', 'event_calendar_permissions');
	//register this to 
}
include(elgg_get_plugins_path() . 'event_calendar_extend/models/model.php');

/**
* Dispatches event calendar pages.
*
* URLs take form -->
*                       	                                   1            2              3                4       &pastevents			<<
*  Site event calendar:		event_calendar/list/               <start_date>/<display_mode>/<filter_context>/<region>
*  Group event calendar:  	event_calendar/group/<group_guid>/ <start_date>/<display_mode>/<filter_context>/<region>
*
*  Single event:       		event_calendar/view/<event_guid>/<title>
*  New event:        		event_calendar/add
*  Edit event:       		event_calendar/edit/<event_guid>
*  Add group event:   		event_calendar/add/<group_guid>
*  Review requests:			event_calendar/review_requests/<event_guid>
*  Event subscribers:		event_calendar/display_users/<event_guid>
*  One user's calendar:		event_calendar/owner/<username>/   <start_date>/<display_mode>/<filter_context>/<region>
*	
* Title is ignored
*	
* @param array $page
* @return NULL
*/

//====================================================================================================
function event_calendar_extend_page_handler($page)
{
//====================================================================================================
	//if($page[0]=='pastevents')
	{
	/**
	echo"<h2>K @ event_calendar_page_handler()::</h2><hr>";	//:DC:++PAST EVENTS
	echo"<hr>";
		echo"<pre>";
		echo"<h2>";
		print_r($page);
		echo"</pre>";
		echo"</h2>";
	echo"<h2>END:: K @ event_calendar_page_handler()::</h2><hr>";//:DC:
		echo"<hr>";
	//exit();
	**/
	}
//====================================================================================================
	elgg_load_library('elgg:event_calendar');
	//````````````````````````````````````````````````````````````````````````````````````````````````````
    if(elgg_is_admin_logged_in()) {
        $url = "event_calendar/view_all_orders";
        $item = new ElggMenuItem('events_calendar:allorders', elgg_echo('event_calendar:view_all_orders'), $url);
        //$item->setPriority(2);
        elgg_register_menu_item('page', $item);
    }
	$page_type = $page[0];
	if(!$page_type||$page_type=='')
		$page_type='list';
	//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
	switch ($page_type)
	{
		case 'touchorders' :

			$TicketOrders = elgg_get_entities(array('types' => 'object','subtype' => 'ticket_order','limit' => 0,));
			foreach($TicketOrders as $ticket_order)
				$ticket_order->access_id = 2;
			echo "DONE THANX";
			
		break;
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
	case 'pastevents':		//:DC: ++PAST EVENTS
		//echo"<h2>K @ :PAST-EVENTS:</h2><hr>";
		$pastevents='pastevents';
		$filter_mode=$pastevents;
		if (isset($page[1]))
			$GroupGuid=$page[1];
		echo event_calendar_get_page_content_list(
			$page_type,
			0,
			$start_date,
			$display_mode,
			$filter_mode,
			$region,
			$pastevents
			);
		//echo"<br>:PASTEVENTS:END:";
		break;
        case 'upcoming':		//:DC: ++PAST EVENTS
            //echo"<h2>K @ :PAST-EVENTS:</h2><hr>";
          
            $filter_mode="upcoming";
            if (isset($page[1]))
                $GroupGuid=$page[1];
            echo event_calendar_get_page_content_list(
                                                      $page_type,
                                                      0,
                                                      $start_date,
                                                      $display_mode,
                                                      $filter_mode,
                                                      $region,
                                                      $pastevents
                                                      );
            //echo"<br>:PASTEVENTS:END:";
            break;
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
	case 'list':
        $filter_mode = 'upcoming';
		if (isset($page[1])) {
			$start_date = $page[1];
			if (isset($page[2])) {
				$display_mode = $page[2];
				if (isset($page[3])) {
					$filter_mode = $page[3];
					if (isset($page[4])) {
						$region = $page[4];
					} else {
						$region = '';
					}
				} else {
					$filter_mode = 'upcoming';
				}
			} else {
				$display_mode = '';
                
			}
		} else {
			$start_date = 0;
		}
           
		echo event_calendar_get_page_content_list(
			$page_type,0,
			$start_date,
			$display_mode,
			$filter_mode,
			$region,
			'0'
			);
		break;
	//````````````````````````````````````````````````````````````````````````````````````````````````````	
	case 'group':
////////////////////////////////////////
/**
echo"<h2>GRP @ event_calendar_page_handler()::</h2><hr>";	//:DC:++PAST EVENTS
	echo"<hr>";
		echo"<pre>";
		echo"<h2>";
		print_r($page);
		echo"</pre>";
		echo"</h2>";
**/
////////////////////////////////////////
/**
if(		group_gatekeeper()	)
	echo"<h2>:: GRP @ group_gatekeeper()	OK !	::</h2><hr>";//:DC:
else
	echo"<h2>:: GRP @ group_gatekeeper()	ERROR ?	::</h2><hr>";//:DC:
echo"<hr>#1 (",$page[1],")<hr>";
//exit();
**/
////////////////////////////////////////
		if (isset($page[1]))
		{
			$group_guid = $page[1];
            $display_mode = '';
            $filter_mode = '';
            $region = '';
			if (isset($page[2])) {
				$start_date = $page[2];
				if (isset($page[3])) {
					$display_mode = $page[3];
					if (isset($page[4])) {
						$filter_mode = $page[4];
						if (isset($page[5])) {
							$region = $page[5];
						} else {
							$region = '';
						}
					} else {
						$filter_mode = '';
					}
				} else {
					$display_mode = '';
				}
			} else {
				$start_date = '';
			}
		} else {
			$group_guid = 0;
		}
		echo event_calendar_get_page_content_list(		//:DC: ++PAST EVENTS
			$page_type,$group_guid,
			$start_date,
			$display_mode,
			$filter_mode,
			$region,
			$pastevents='0'
			);
		break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
//````````````````````````````````````````````````````````````````````````````````````````````````````	
		case 'view':
			echo event_calendar_extend_get_page_content_view($page[1]);
			break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
	case 'display_users'://:DC:
		//echo"<h2>@ case 'display_users'://:DC:(",$page[1],")::</h2><hr>";//:DC:
			echo event_calendar_extend_get_page_content_display_users($page[1]);
			break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
		case 'view_orders':
			echo event_calendar_view_orders($page[1]);
			break;
        case 'view_all_orders':
			echo event_calendar_view_all_orders();
			break;
//````````````````````````````````````````````````````````````````````````````````````````````````````
	case 'manage_users':
		echo event_calendar_get_page_content_manage_users($page[1]);
		break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
	case 'add':
		if (isset($page[1])) {
			group_gatekeeper();
			$group_guid = $page[1];
		} else {
			gatekeeper();
			$group_guid = 0;
		}
		echo event_calendar_get_page_content_edit($page_type,$group_guid);
		break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
	case 'edit':
		gatekeeper();
		echo event_calendar_get_page_content_edit($page_type, $page[1]);
		break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
	case 'owner':
		if (isset($page[1])) {
			$username = $page[1];
			$user = get_user_by_username($username);
			$user_guid = $user->guid;

			if (isset($page[2])) {
				$start_date = $page[2];
				if (isset($page[3])) {
					$display_mode = $page[3];
					if (isset($page[4])) {
						$filter_mode = $page[4];
						if (isset($page[5])) {
							$region = $page[5];
						} else {
							$region = '';
						}
					} else {
						$filter_mode = '';
					}
				} else {
					$display_mode = '';
				}
			} else {
				$start_date = '';
			}
		} else {
			$group_guid = 0;
		}
		echo event_calendar_get_page_content_list($page_type,$user_guid,$start_date,$display_mode,$filter_mode,$region);
		break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
	case 'review_requests':
		gatekeeper();
		echo event_calendar_get_page_content_review_requests($page[1]);
		break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
		case 'payment':
			gatekeeper();
			echo event_calendar_get_page_content_payment($page);
			break;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
	default:
		return FALSE;
	}
//````````````````````````````````````````````````````````````````````````````````````````````````````	
	return TRUE;
//````````````````````````````````````````````````````````````````````````````````````````````````````	
//echo'<h2>';
//var_dump(debug_backtrace());
//echo'</h2>';
}//function event_calendar_extend_page_handler($page)



//````````````````````````````````````````````````````````````````````````````````````````````````````	
/**
* Add particular event calendar links/info to entity menu
*/
function event_calendar_extend_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}
	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'event_calendar') {
		return $return;
	}
	$user_guid = elgg_get_logged_in_user_guid();
	if ($user_guid) {
		$calendar_status = event_calendar_extend_personal_can_manage($entity, $user_guid);
		if ($calendar_status == 'open')
		{
			/**
			if (event_calendar_has_personal_event($entity->guid, $user_guid))
			{
				$options = array(
				'name' => 'personal_calendar',
				'text' => elgg_echo('event_calendar:remove_from_the_calendar_menu_text'),
				'title' => elgg_echo('event_calendar:remove_from_my_calendar'),
				'href' => elgg_add_action_tokens_to_url("action/event_calendar/remove_personal?guid={$entity->guid}"),
				'priority' => 150,
				);
				$return[] = ElggMenuItem::factory($options);
			}
			else
			{
				if (!event_calendar_is_full($entity->guid) && !event_calendar_has_collision($entity->guid, $user_guid)) {
					//if the event has a feee then show a payment button
					/* if($entity->fees > 0){
					$options = array(
					'name' => 'event_calendar:make_request_title',
					'text' => sprintf(elgg_echo('event_calendar:make_request_title:payment'), $entity->fees, event_calendar_currency()),
					'title' => sprintf(elgg_echo('event_calendar:make_request_title:payment'), $entity->fees, event_calendar_currency()),
					'href' => elgg_add_action_tokens_to_url("action/event_calendar/payment?guid={$entity->guid}"),
					'priority' => 150,
					);
					$return[] = ElggMenuItem::factory($options);
					} else {
					if (!$entity->fees || $entity->fees <= 0) {
						$options = array(
						'name' => 'personal_calendar',
						'text' => elgg_echo('event_calendar:add_to_the_calendar_menu_text'),
						'title' => elgg_echo('event_calendar:add_to_my_calendar'),
						'href' => elgg_add_action_tokens_to_url("action/event_calendar/add_personal?guid={$entity->guid}"),
						'priority' => 150,
						);
						$return[] = ElggMenuItem::factory($options);
					}
				}
			}**/
		} else if ($calendar_status == 'closed') {
			if (!event_calendar_has_personal_event($entity->guid, $user_guid) && !check_entity_relationship($user_guid, 'event_calendar_request', $entity->guid)) {
				//if the event has a fee then show a payment button
				/* if($entity->fees > 0){
				$options = array(
				'name' => 'event_calendar:make_request_title',
				'text' => sprintf(elgg_echo('event_calendar:make_request_title:payment'), $entity->fees, event_calendar_currency()),
				'title' => sprintf(elgg_echo('event_calendar:make_request_title:payment'), $entity->fees, event_calendar_currency()),
				'href' => elgg_add_action_tokens_to_url("action/event_calendar/payment?guid={$entity->guid}"),
				'priority' => 150,
				);
				$return[] = ElggMenuItem::factory($options);
				} else { */
				if (!$entity->fees || $entity->fees <= 0) {
					$options = array(
					'name' => 'personal_calendar',
					'text' => elgg_echo('event_calendar:make_request_title'),
					'title' => elgg_echo('event_calendar:make_request_title'),
					'href' => elgg_add_action_tokens_to_url("action/event_calendar/request_personal_calendar?guid={$entity->guid}"),
					'priority' => 150,
					);
					$return[] = ElggMenuItem::factory($options);
				}
			} elseif (check_entity_relationship($user_guid, 'event_calendar_request', $entity->guid)) {
				$options = array(
				'name' => 'event_calendar:request:awaiting_approval',
				'text' => elgg_echo('event_calendar:request:awaiting_approval'),
				'title' => elgg_echo('event_calendar:request:awaiting_approval'),
				'href' => '#',
				'priority' => 150,
				);
				$return[] = ElggMenuItem::factory($options);
			}
		} elseif (!check_entity_relationship($user_guid, 'event_calendar_request', $entity->guid) && ($entity->personal_manage == 'closedfuture_no_list' || $entity->personal_manage == 'closedfuture_keep_list')) {
			$options = array(
			'name' => 'event_calendar:request:closedfuture',
			'text' => elgg_echo('event_calendar:request:closedfuture'),
			'title' => elgg_echo('event_calendar:request:closedfuture'),
			'href' => '#',
			'priority' => 150,
			);
			$return[] = ElggMenuItem::factory($options);
		}
	}
	$count = event_calendar_get_users_for_event($entity->guid, 0, 0, true);
	if ($count == 1) {
		$calendar_text = elgg_echo('event_calendar:personal_event_calendars_link_one');
	} else {
		$calendar_text = elgg_echo('event_calendar:personal_event_calendars_link', array($count));
	}
	$options = array(
	'name' => 'calendar_listing',
	'text' => $calendar_text,
	'title' => elgg_echo('event_calendar:users_for_event_menu_title'),
	'href' => "event_calendar/display_users/{$entity->guid}",
	'priority' => 150,
	);
	$return[] = ElggMenuItem::factory($options);
	/* if (elgg_is_admin_logged_in() && (elgg_get_plugin_setting('allow_featured', 'event_calendar') == 'yes')) {
	if ($event->featured) {
	add_submenu_item(elgg_echo('event_calendar:unfeature'), $CONFIG->url . "action/event_calendar/unfeature?event_id=".$event_id.'&'.event_calendar_security_fields(), 'eventcalendaractions');
	} else {
	add_submenu_item(elgg_echo('event_calendar:feature'), $CONFIG->url . "action/event_calendar/feature?event_id=".$event_id.'&'.event_calendar_security_fields(), 'eventcalendaractions');
	}
	} */
	return $return;
}
function event_calendar_permissions($hook_name, $entity_type, $return_value, $parameters) {
	if (elgg_get_context() == "event_update_spots") {
		return true;
	}
	return null;
}
?>