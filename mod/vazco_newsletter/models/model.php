<?php //ł ?><?php
class vazco_newsletter{//this  was set automatically, you might need to change it
	//methods invoked by actions
	public function subscribeAll($group = 'general'){
		$users = get_entities('user','',0,'',9999999999);
		foreach($users as $user){
			vazco_newsletter::subscribe($user);
		}
		return true;
	}
	//methods invoked by actions unsubscribeall
	public function unsubscribeAll($group = 'general'){
		$users = get_entities('user','',0,'',9999999999);		
		foreach($users as $user){
			vazco_newsletter::unsubscribe($user);
		}
		return true;
	}
	//method invoked by action subscribe
	function subscribe($entity){
		if($entity instanceof ElggUser){
			return $entity->setMetaData('isSubscribedNewsletter',true);
		}else{
			register_error(elgg_echo('vazco_newsletter:notanuser'));
			return false;
		}
	}

	//method invoked by action unsubscribe
	function unsubscribe($entity){
		if($entity instanceof ElggUser){
			return $entity->setMetaData('isSubscribedNewsletter',false);
		}else{
			register_error(elgg_echo('vazco_newsletter:notanuser'));
			return false;
		}
	}

	//method invoked by action send
	function send($entity){
		//vazco_newsletter::publications_send();
		//return vazco_newsletter::publication2queue(2831);
		//return vazco_newsletter::publication2queue(2634);
		//return vazco_newsletter::messages_send(2);
		vazco_newsletter::publications_send();
		return true;
	}

	//method invoked by action testsend
	function testsend($entity,$newsletter=null){
		global $CONFIG;
		
		system_message('triggered test send for '.$entity->getURL());
		
		if($newsletter)
		{
			system_message('test send for newsletter');
			return vazco_newsletter::sendMessage($entity->guid,$newsletter->guid);
		}
		else
		{
			system_message('test send solo');
			//notify_user($to, $from, $subject, $message, array $params = NULL, $methods_override = "");
			return notify_user($entity->guid,$CONFIG->site->guid,'Test subject','Test message.');
		}
	}
	
	//get entities of subscribed users
	function getSubscribedEntities()
	{
		$options = array(
			'type' => 'user',
			'metadata_names' => 'isSubscribedNewsletter',
			'metadata_values' => true,	
			'limit' => 9999999999,
		);
		return elgg_get_entities_from_metadata($options);
	}
	
	function getQueue($queue_name='not_sent')
	{
		global $CONFIG;
		$access = elgg_set_ignore_access(true);
		//$data_array_ser = get_plugin_setting('queue_'.$queue_name, 'vazco_newsletter');
		$data_array_ser = file_get_contents($CONFIG->pluginspath.'vazco_newsletter/queue_'.$queue_name.'.txt');
		
		if($data_array_ser===null)//if no metadata
		{
			$data_array = array();	
		}
		else
		{
			$data_array = unserialize($data_array_ser);
			if(!is_array($data_array))
				$data_array = array();
		}
		elgg_set_ignore_access($access);
		return $data_array;
	}
	
	function setQueue($data_array,$queue_name='not_sent')
	{
		global $CONFIG;
		if(is_array($data_array))
		{
			$access = elgg_set_ignore_access(true);
			$data_array_ser = serialize($data_array);	
			/*if (!set_plugin_setting('queue_'.$queue_name, $data_array_ser, 'vazco_newsletter')){
				return false;
			}*/
			if (!file_put_contents($CONFIG->pluginspath.'vazco_newsletter/queue_'.$queue_name.'.txt', $data_array_ser)){
				return false;
			}
			
			//$data_array_ser2 = get_plugin_setting('queue_'.$queue_name, 'vazco_newsletter');
			elgg_set_ignore_access($access);
			return true;
		}
		return false;
	}
	
	function queuePop($queue_name)
	{
		$data_array = vazco_newsletter::getQueue($queue_name);
		$element = array_shift($data_array);//pop first element
		vazco_newsletter::setQueue($data_array,$queue_name);
		return $element;
	}
	
	function queuePush($element,$queue_name)
	{
		$data_array = vazco_newsletter::getQueue($queue_name);
		$data_array[] = $element;//push onto the end
		return vazco_newsletter::setQueue($data_array,$queue_name);
	}
	
	//get elements from publication and insert to queue_not_sent 
	function publication2queue($newsletter_guid)
	{
		$newsletter = get_entity($newsletter_guid);
		if($newsletter)
		{
			$entities = vazco_newsletter::getSubscribedEntities();
			$data_array_old = vazco_newsletter::getQueue('not_sent');
			$data_array_new = array();
			foreach($entities as $entity)
			{
				$entity_guid = $entity->guid;
				$data_array_new[] = array($entity_guid,$newsletter_guid);
			}
			$data_array = array_merge($data_array_old, $data_array_new);

			return vazco_newsletter::setQueue($data_array,'not_sent');
		}
		return false;
	}
	
	//send instantly selected newsletter to selected user
	function sendMessage($receiver_guid,$newsletter_guid)
	{
		global $CONFIG;
		
		$newsletter = get_entity($newsletter_guid);
		$receiver = get_entity($receiver_guid);
		
		if($newsletter && $receiver)
		{		
			$message_body = $newsletter->body;
			$message_title = $newsletter->name;
			
			$message_body = str_replace ( '{$message_title}', $message_title, $message_body);
			$message_body = str_replace ( '{$message_sender}', $CONFIG->site->name, $message_body);
			$message_body = str_replace ( '{$date}', date("Y m d",time()), $message_body);
			
			$optOutLink = "{$CONFIG->wwwroot}action/newsletter/unsubscribe?guid=".$receiver->guid;
			$optOutLink = elgg_add_action_tokens_to_url($optOutLink);
			//$optOutLink = sprintf(elgg_echo('vazco_newsletter:optout'),$CONFIG->site->name,$optOutLink);
			$message_body = str_replace ( '{$optout}', $optOutLink, $message_body);				
			$message_body = str_replace ( '{$message_receiver}', $receiver->name, $message_body);
			
			$_REQUEST['_wrapper_off'] = 1;
			return notify_user($receiver_guid,$CONFIG->site->guid,$message_title,$message_body,null, 'email');
		}
		return false;
	}

	//send new publications
	function publications_send(){
		$time = time();
		//system_message('prepare publications send on '.$time);
		$options = array(
			'type' => 'object',
			'subtype' => 'newsletter',
			'metadata_name_value_pairs' => array(
				array('name'=>'isSent', 'value' => true, 'operand' => '<>', 'case_sensitive' => false),
				//array('name'=>'date_ts', 'value' => $time+10*3600+25*60, 'operand' => '<=', 'case_sensitive' => false)
				array('name'=>'date_ts', 'value' => $time, 'operand' => '<=', 'case_sensitive' => false)
				),
			'limit' => 999999999,
		);
		$publications = elgg_get_entities_from_metadata($options);
		
		foreach($publications as $publication)
		{
			//system_message('ready to send publication: '.$publication->name);
			$access = elgg_set_ignore_access(true);
			if(vazco_newsletter::publication2queue($publication->guid))
				$publication->isSent = true;
			elgg_set_ignore_access($access);
		}
	}

	//send part of messages from queue
	function messages_send($count = 5){
		for($i=0;$i<$count;$i++)
		{
			$element = vazco_newsletter::queuePop('not_sent');
			if($element!==null)
			{
				$result = vazco_newsletter::sendMessage($element[0],$element[1]);
				if($result)
					vazco_newsletter::queuePush($element,'sent');
				else
					vazco_newsletter::queuePush($element,'error');
			}
		}
		return true;
	}

	

	//method which sets field values for edit
	static function reviewEditFormArray($entity = null, $container_guid = null){
		$newEntity = ($entity == null);
		if ($newEntity){
			$date = $entity->date;
		}else{
			$date = date('M d, Y',strtotime(date("Y-m-d",time())." +1 day"));
		}
		$fieldArray = array(
			/*
			 * Additional metadata:
			 * - queue_not_sent
			 * - queue_sent
			 * - queue_error
			 * - isSent
			 * - date_ts
			 * */
		
			array(
				'name' => 'owner_guid',
				'type' => 'hidden',
				'active' => $newEntity, //set owner only when new entity is created
				'value' => get_loggedin_userid(),
				'fixed' => get_loggedin_userid(),
			),
/*			array(
				'name' => 'container_guid',
				'type' => 'hidden',
				'active' => $newEntity,
				'value' => $container_guid),*/
			array(
				'name' => 'access_id',
				'type' => 'hidden',
				'value'=> ACCESS_PUBLIC
			),
			array(
				'name' => 'name',
				'type' => 'text',
				'multilang' => false,
				'required' => true,
				'title' => elgg_echo('vazco_newsletter:title'),//this  was set automatically, you might need to change it
			),
			array(
				'name' => 'isSent',
				'type' => 'text',
				'multilang' => false,
				'required' => false,
				//'value' => 1,
				//'checked' => $entity->isSent,
				'title' => elgg_echo('vazco_newsletter:issent'),//this  was set automatically, you might need to change it
				'hint' => elgg_echo('vazco_newsletter:issent:hint'),
			),
			array(
				'name' => 'body',
				'type' => 'html',
				'multilang' => false,
				'required' => true,
				'title' => elgg_echo('vazco_newsletter:body'),//this  was set automatically, you might need to change it
				//'subtitle' => elgg_echo('vazco_newsletter:body:hint'),
				'help' => elgg_echo('vazco_newsletter:body:hint'),
			),
			array(
				'name' => 'date',
				'type' => 'calendar',
				'required' => true,
				'value' => $date,
				'title' => elgg_echo('vazco_newsletter:date'),
			),
			array(
				'name' => 'isSent',
				'type' => 'hidden',
				'required' => true,
				'active' => $newEntity,
				'value' => 0,
			),
			/*
			array(
				'name' => 'tags',
				'type' => 'tags',
				'required' => false,
				'title' => elgg_echo('vazco_newsletter:tags'),//this  was set automatically, you might need to change it
			),
			*/
			/*
			array(
				'name' => 'image',
				'type' => 'file',
				'image' => true,
				'required' => $newEntity,
				'sizes' => array(
					array(
						"name"	=> "large",
						"width"	=> 200,
						"height"=> 200,
						"enlarge"=> false,
					),
					array(
						"name"	=> "medium",
						"width"	=> 100,
						"height"=> 100,
						"enlarge"=> false,
					),
					array(
						"name"	=> "small",
						"width"	=> 40,
						"height"=> 40,
						"enlarge"=> false,
					),
					array(
						"name"	=> "tiny",
						"width"	=> 25,
						"height"=> 25,
						"enlarge"=> false,
					),
				),
				'title' => elgg_echo('vazco_advertisement:image_label'),
			),
			array(
				'name' => 'thumbs',
				'type' => 'file',
				'multi' => true,
				'limit' => 10,
				'image'=> true,
				'required' => false,
				'sizes'	=> array(
					array(
						"name"		=> "tiny",
						"width"		=> 25,
						"height"	=> 25,
						"enlarge"	=> true,
					),
					array(
						"name"		=> "small",
						"width"		=> 40,
						"height"	=> 40,
						"enlarge"	=> true,
					),
					array(
						"name"		=> "medium",
						"width"		=> 100,
						"height"	=> 100,
						"enlarge"	=> false,
					),
					array(
						"name"		=> "big",
						"width"		=> 300,
						"height"	=> 300,
						"enlarge"	=> false,
					),
					array(
						"name"		=> "large",
						"width"		=> 600,
						"height"	=> 600,
						"enlarge"	=> false,
					),
				),
				
				'title' => elgg_echo('vazco_newsletter:thumb_image'),
			),
			*/
			);
		return $fieldArray;
    }
}
?>