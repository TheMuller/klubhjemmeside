<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'usermessage_init');

function usermessage_init() {
	elgg_register_plugin_hook_handler('output:before', 'page', 'elgg_views_add_user_message');
	$base_dir = elgg_get_plugins_path() . 'usermessage/actions/';
	elgg_register_action("usermessage/response", $base_dir . 'usermessage/response.php');	
	elgg_register_page_handler('usermessage', 'usermessage_page_handler');
	elgg_register_event_handler('login', 'user', 'usermessage_login_redirect');
 }
function usermessage_page_handler($segments){
	$key = get_input('key');
unset($_SESSION['user_message'][$key]);
}

function create_user_message($type,$key,$params) {

	if($params['when']=='nextlogin'){
		$user = get_user_by_username($params['username']);
		$anotedata = serialize(array($key => $params));
		$user->annotate('user_message',$anotedata, ACCESS_PUBLIC);
	}else {
		
		$_SESSION['user_message'][$key] =$params;
	}
	return 5;	
}

function elgg_views_add_user_message($hook, $type, $value, $params) {
	$request_uri_path = parse_url($_SERVER['REQUEST_URI']);
	$sessiondatalist = $_SESSION['user_message'];
	if($sessiondatalist and count($sessiondatalist)) {
		foreach($sessiondatalist as $key=>$sessiondata ) {
			if($sessiondata['where'] != '') {
			if(strpos($request_uri_path['path'],$sessiondata['where']) === false )continue;
			}
			if($sessiondata['when'] == 'expired')continue;
			$msg = $sessiondata['msg'];
			$content .="<div  class='elgg-state-notice' style='position:relative;' id='universal_user_message_".$key."'>";
			$content .="<span class='elgg-icon elgg-icon-delete' style='position:absolute;right:0px;' onclick=\"closeusermessage('".$key."');\"></span>";
			
			if($sessiondata['is_form'] == true) {
				$content .= "<form id='universal_user_message_form_".$key."'>".elgg_view($msg);
				$content .="<input type='submit' value='Submit' onclick=\"submit_user_message_form('".$key."');return false;\" class='elgg-button elgg-button-submit' />";
				$content .="</form>";
			}else {
				$content .= $msg;
			}
			$content .="<hr></div>";
			if($sessiondata['when'] == 'thispage')$_SESSION['user_message'][$key]['when'] = 'expired';
		}
		
	$body = <<<___HTML
		<script type="text/javascript">
		function closeusermessage(key){
			var div = document.getElementById('universal_user_message_'+key);
			div.style.display = 'none';
			elgg.get('/usermessage/remove?key='+key);
		}
		function submit_user_message_form(key){
			closeusermessage(key);
			var data = $('#universal_user_message_form_'+key).serialize();
			data = data +'&__elgg_ts='+elgg.security.token.__elgg_ts +'&__elgg_token='+elgg.security.token.__elgg_token;
			elgg.action('usermessage/response?key='+key,{
				data: data,
				success: function(key) {						
					//closeusermessage(key);
					}	
			});			
		}
		</script>
		$content
___HTML;
	$value['body'] = $body . $value['body'];
	return $value;
	}	
}

function usermessage_login_redirect($event, $type, $user) {
	$annotations = $user->getAnnotations('user_message');
	//if($annotations and $annotations[0] and !empty($annotations[0])){
	foreach($annotations as $annotation){	
		//system_message($annotation->value );
		$param = unserialize($annotation->value);
		if(isset($_SESSION['user_message'])) {
		
			 $_SESSION['user_message'] = array_merge($_SESSION['user_message'],$param);
		}else {			
			$_SESSION['user_message'] = $param;
		}
		
		$annotation->delete();
	}
	//$annotations = $user->getAnnotations('user_message');
	//system_message("annot count= ".count($annotations));
	
} 