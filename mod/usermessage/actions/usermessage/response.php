<?php

$key = get_input('key');
//system_message($key);
$params = $_SESSION['user_message'][$key];
if($params == null ) system_message("param is null");
else {
	unset($_SESSION['user_message'][$key]);
//	system_message($params['msg']);
	action($params['msg']);
	
}

?>