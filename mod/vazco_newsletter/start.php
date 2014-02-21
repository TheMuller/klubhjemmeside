<?php //ł ?><?php
/*******************************************************************************
 * vazco_newsletter
 *
 * @author vazco, Elggdev
 * @copyright Elggdev
 * @licence per-site commercial licence: http://elggdev.com/pg/license
 ******************************************************************************/
/********************************************
 * VAZCO_TOOLS (don't modify this code)
 *******************************************/
	//register handler for this plugin's tools library
	register_elgg_event_handler('init', 'tools', 'vazco_newsletter_tools_init',701156511); //should be generated as 99999999999 - time()
	
	if (!function_exists('vazco_init_tools')){
		function vazco_init_tools($plugin = null, $time = null){
			//register handler that will invoke tools library in case it was not yet invoked
			if (!$_REQUEST['__toolshandler']){
				$_REQUEST['__toolshandler'] = 1;
				trigger_elgg_event('init','tools');
			}
		}
	}

	function vazco_newsletter_tools_init(){
		if (!$_REQUEST['__toolson']){
			$_REQUEST['__toolson'] = 1;
			require_once(dirname(__FILE__).'/models/tools.php');
		}
	}
	
/********************************************
 * END OF VAZCO_TOOLS
 *******************************************/
 
	function vazco_newsletter_init(){
		vazco_init_tools();
		global $CONFIG;

		elgg_extend_view('css','vazco_newsletter/vazco_tools/css');

		define('TOOLS_TRANSLATIONS','en,sv,de,fr,pl');

		require_once(dirname(__FILE__)."/models/model.php");
		
		elgg_extend_view('css','vazco_newsletter/css');
		elgg_extend_view('css','vazco_newsletter/vazco_tools/css');
		
		elgg_extend_view('input/captcha', 'vazco_newsletter/subscribe/register',10);
	
		//add_menu(elgg_echo('vazco_newsletter:menu:title'), $CONFIG->wwwroot . "pg/newsletter/listing");

		register_page_handler('newsletter','vazco_newsletter_page_handler');
		register_entity_url_handler('vazco_newsletter_url','object', 'newsletter');

		register_action('newsletter/subscribe', false, $CONFIG->pluginspath.'/vazco_newsletter/actions/subscribe.php');
		register_action('newsletter/unsubscribe', false, $CONFIG->pluginspath.'/vazco_newsletter/actions/unsubscribe.php');
		register_action('newsletter/send', false, $CONFIG->pluginspath.'/vazco_newsletter/actions/send.php');
		register_action('newsletter/subscribeall', false, $CONFIG->pluginspath.'/vazco_newsletter/actions/subscribeall.php');
		register_action('newsletter/testsend', false, $CONFIG->pluginspath.'/vazco_newsletter/actions/testsend.php');
		register_action('newsletter/edit', false, $CONFIG->pluginspath.'/vazco_newsletter/actions/edit.php');
		register_action('newsletter/delete', false, $CONFIG->pluginspath.'/vazco_newsletter/actions/delete.php');
		register_action('newsletter/unsubscribeall', false, $CONFIG->pluginspath.'/vazco_newsletter/actions/unsubscribeall.php');


		register_elgg_event_handler('pagesetup','system','vazco_newsletter_pagesetup');
		
		
		register_plugin_hook('vazco_tools:icon:default','object','get_default_vazco_newsletter_icon');
		register_plugin_hook('entity:icon:url','object','get_default_vazco_newsletter_icon_url');

		//register entity for search mechanisms
		//register_entity_type('object','newsletter');
		
		register_plugin_hook("cron", "hourly", "vazco_newsletter_cron_publication_hook");//process new publication
		register_plugin_hook("cron", "fiveminute", "vazco_newsletter_cron_queue_hook");//process message queue

		//weryfikacja poprawnego utworzenia obiektu
		register_elgg_event_handler('create','object','vazco_newsletter_create_event_handler',400);
		register_elgg_event_handler('update','object','vazco_newsletter_create_event_handler',400);
		
		register_plugin_hook('plugin:usersetting', 'user', "vazco_newsletter_usersettings_changed");
		register_elgg_event_handler('create', 'user', 'vazco_newsletter_create_user', 502);
		
		//search hook that allows to search in metadata
		//register_plugin_hook('search', 'object:golfterrain','vazco_golfterrains_search_hook');

		return true;
	}
	
	//check registration setting
	function vazco_newsletter_create_user($event, $object_type, $object){
		if($object && $object instanceof ElggUser)
		{
			$newsletter_setting = get_input('newsletter',false);
			if($newsletter_setting)
			{
				return vazco_newsletter::subscribe($object);
			}
		}
		return true;
	}
	
	
	//process new publication
	function vazco_newsletter_cron_publication_hook($hook, $entity_type, $returnvalue, $params){
		vazco_newsletter::publications_send();
		//system_message('OK sentPublications() on '.date("Y/m/d H:i:s"));
	}
	
	//process message queue
	function vazco_newsletter_cron_queue_hook($hook, $entity_type, $returnvalue, $params){
		//vazco_newsletter::sendPartOfMessages();
		vazco_newsletter::messages_send();
		//system_message('OK Part of messages sent on '.date("Y/m/d H:i:s"));
	}
	
	//user setting changed
	function vazco_newsletter_usersettings_changed($hook, $entity_type, $returnvalue, $params){
		$user = $params['user'];
		$plugin = $params['plugin'];
		$name = $params['name'];
		$value = $params['value'];
		if($plugin == 'vazco_newsletter' && $name=='isSubscribedNewsletter')
		{
			if($value==true)
				return vazco_newsletter::subscribe($user);
			else
				return vazco_newsletter::unsubscribe($user);
			//return $user->setMetaData($name,$value);
		}
	}
	
	function vazco_newsletter_create_event_handler($event, $object_type, $object)
	{
		if($object && $object->getSubtype()=='newsletter')
		{
			$date = $object->getMetaData('date');
			$date_ts = strtotime($date);
			$time = time();
			if($date_ts===false)// || $date_ts<$time
			{
				system_message(elgg_echo('vazco_newsletter:wrong_date_setting_default'));
				$object->setMetaData('date',date('M d, Y',strtotime(date("Y-m-d",$time)." +1 day")));
				$date_ts = $time + 24*3600;
			}
			system_message($date_ts.' '.date("Y/m/d H:i:s",$date_ts));
			$object->setMetaData('date_ts',$date_ts);
		}
		return true;
	}
	
	/*
	function vazco_golfterrains_search_hook($hook, $entity_type, $returnvalue, $params){
		$fields = array('title', 'description');
		$metadata_fields = array('title__en');
		method incomplete - metadata_fields are not served. fields currently can contain only description and title 
		return vazco_tools::search($fields, $metadata_fields, $params);
	}*/

		function get_default_vazco_newsletter_icon_url($hook, $entity_type, $returnvalue, $params){			$entity = $params['entity'];
			global $CONFIG;
			if($entity->getSubtype()=='newsletter')
				return "{$CONFIG->wwwroot}mod/vazco_newsletter/graphics/default_icon.png";
			else
				return $return_value;
		}



	function vazco_newsletter_url($entity){
		global $CONFIG;
		return $CONFIG->wwwroot."pg/newsletter/view/".$entity->guid;
	}
	function vazco_newsletter_page_handler($page){
		global $CONFIG;
		
		switch ($page[0]){
			case 'subscribers':
				include $CONFIG->pluginspath . 'vazco_newsletter/pages/subscribers.php';
				break;
			case 'message_queue':
				if(isset($page[1]))
				{
					switch($page[1])
					{
						case 'not_sent':
						case 'sent':
						case 'error':
							set_input('filter',$page[1]);
							break;
					}
				}
				include $CONFIG->pluginspath . 'vazco_newsletter/pages/message_queue.php';
				break;
			case 'listing':
				if(isset($page[1]))
				{
					switch($page[1])
					{
						case 'not_sent':
						case 'sent':
							set_input('filter',$page[1]);
							break;
					}
				}
				include $CONFIG->pluginspath . 'vazco_newsletter/pages/listing.php';
				break;
			case 'userlisting':
				set_input('guid',$page[1]);
				include $CONFIG->pluginspath . 'vazco_newsletter/pages/userlisting.php';
				break;
			case 'grouplisting':
				set_input('guid',$page[1]);//group guid
				include $CONFIG->pluginspath . 'vazco_newsletter/pages/grouplisting.php';
				break;
			case 'new':
				set_input('guid',$page[1]);
				include $CONFIG->pluginspath . 'vazco_newsletter/pages/edit.php';
				break;
			case 'edit':
				set_input('guid',$page[1]);
				include $CONFIG->pluginspath . 'vazco_newsletter/pages/edit.php';
				break;
			case 'view':
				set_input('guid',$page[1]);
				include $CONFIG->pluginspath . 'vazco_newsletter/pages/fullview.php';
				break;
		}
		return true;
	}


	function vazco_newsletter_pagesetup(){
		global $CONFIG;

		$context = get_context();
		if ($context == 'newsletter'){
			//add_submenu_item(elgg_echo('vazco_newsletter:userlisting'),$CONFIG->wwwroot."pg/newsletter/userlisting/".get_loggedin_userid());
			add_submenu_item(elgg_echo('vazco_newsletter:add'),$CONFIG->wwwroot."pg/newsletter/new/", '01vazco_newsletter');
			$guid = get_input('guid');
			$entity = get_entity($guid);
			$action="{$CONFIG->wwwroot}action/newsletter/subscribeall";			
			add_submenu_item(elgg_echo('vazco_newsletter:subscribeall'),elgg_add_action_tokens_to_url ($action), '55vazco_newsletter', true);
			$action="{$CONFIG->wwwroot}action/newsletter/unsubscribeall";
			add_submenu_item(elgg_echo('vazco_newsletter:unsubscribeall'),elgg_add_action_tokens_to_url ($action), '55vazco_newsletter', true);
			if ($entity && $entity->getSubtype() == 'newsletter')//if entity from get input has the desired subtype
			{
				add_submenu_item(elgg_echo('vazco_newsletter:view'),$CONFIG->wwwroot."pg/newsletter/view/".$guid,'00vazco_newsletter');
				if($entity->canEdit())
				{
					add_submenu_item(elgg_echo('vazco_newsletter:edit'),$CONFIG->wwwroot."pg/newsletter/edit/".$guid,'00vazco_newsletter');
					$action="{$CONFIG->wwwroot}action/newsletter/delete?guid=".$guid;
					add_submenu_item(elgg_echo('vazco_newsletter:delete_link'),elgg_add_action_tokens_to_url ($action), '00vazco_newsletter', true);
				}
			}
			if (isadminloggedin()){
				add_submenu_item(elgg_echo('vazco_newsletter:listing'),$CONFIG->wwwroot."pg/newsletter/listing");
				add_submenu_item(elgg_echo('vazco_newsletter:listing_notsent'),$CONFIG->wwwroot."pg/newsletter/listing/not_sent");
				add_submenu_item(elgg_echo('vazco_newsletter:listing_sent'),$CONFIG->wwwroot."pg/newsletter/listing/sent");
			}
			add_submenu_item(elgg_echo('vazco_newsletter:page:subscribers:title'), $CONFIG->wwwroot . 'pg/newsletter/subscribers/');
			//add_submenu_item(elgg_echo('vazco_newsletter:page:message_queue:title'), $CONFIG->wwwroot . 'pg/newsletter/message_queue/');
			add_submenu_item(elgg_echo('vazco_newsletter:page:message_queue:not_sent'), $CONFIG->wwwroot . 'pg/newsletter/message_queue/not_sent','02vazco_newsletter');
			add_submenu_item(elgg_echo('vazco_newsletter:page:message_queue:sent'), $CONFIG->wwwroot . 'pg/newsletter/message_queue/sent','02vazco_newsletter');
			add_submenu_item(elgg_echo('vazco_newsletter:page:message_queue:error'), $CONFIG->wwwroot . 'pg/newsletter/message_queue/error','02vazco_newsletter');
			
			$newsletterGuid = get_input('guid');
			add_submenu_item('Test send', elgg_add_action_tokens_to_url($CONFIG->wwwroot.'action/newsletter/testsend?guid='.get_loggedin_userid().'&newsletter='.$newsletterGuid),'03vazco_newsletter');
			add_submenu_item('Send action', elgg_add_action_tokens_to_url($CONFIG->wwwroot.'action/newsletter/send?guid='.get_loggedin_userid()),'03vazco_newsletter');
			add_submenu_item('Subcribe me',elgg_add_action_tokens_to_url($CONFIG->wwwroot.'action/newsletter/subscribe?guid='.get_loggedin_userid()),'03vazco_newsletter');
			add_submenu_item('Unsubscribe me',elgg_add_action_tokens_to_url($CONFIG->wwwroot.'action/newsletter/unsubscribe?guid='.get_loggedin_userid()),'03vazco_newsletter');
	
		}elseif($context == 'admin'){
			add_submenu_item(elgg_echo('vazco_newsletter:listing'),$CONFIG->wwwroot."pg/newsletter/listing");
		}
	}




	
	register_elgg_event_handler('init', 'system', 'vazco_newsletter_init');
?>