<?php
/**
* Groups plugin settings
**/
  
    //$validator = $vars['entity']->validator; ignore setting and take actual values
    $pluginemail = elgg_get_plugin_from_id('uservalidationbyemail');
    $pluginadmin = elgg_get_plugin_from_id('uservalidationbyadmin');
    
    $validator = 'none';
    $options = array("No User validation" => 'none',);
    if($pluginemail){
        $options["User validation by email"] = 'email';
    }
    if($pluginadmin){
        $options["User validation by admin"] = 'admin';
        
    }
    

    if($pluginemail and $pluginemail->isActive()){
        $validator = 'email';
    }elseif($pluginadmin and $pluginadmin->isActive()){
        $validator = 'admin';
    }else {
        $validator = 'none';
    }
    
    echo elgg_view("input/radio", array(
                                        "name" => 'params[validator]',
                                        "value" => $validator,
                                        'options' => $options,
                                        ));
    
    $validator_admin_guid = $vars['entity']->validator_admin_guid;
   

    echo "<div style='border:1px solid;'>";
    echo "<br><label>Use My email id in the confirmation email (".elgg_get_logged_in_user_entity()->email." )</label>";
    echo elgg_echo("<input type='hidden' name='params[makemevalidator]' value='0'/>");
    if($validator_admin_guid == elgg_get_logged_in_user_guid()){

        echo elgg_echo("<input type='checkbox' name='params[makemevalidator]' value='1' checked/><br>");
        
    }else{
        echo elgg_echo("<input type='checkbox' name='params[makemevalidator]' value='1' />");
        
         $site = elgg_get_site_entity();
        if($validator_admin_guid == $site->guid){
            echo "<br>At present the Site email ID is used (".$site->email." )";
        }else{
            $validator_admin = get_entity($validator_admin_guid);
            if($validator_admin instanceof ELGGUser) echo "At present ".$validator_admin->name."'s email ID is used i.e ".$validator_admin->email;
        }
    }


////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<br><br>Please note that the setting of emailID will only work if you make this code change<br>
File: uservalidationbyadmin/actions/validate.php<br>
Line: 38 &nbsp&nbsp&nbsp<label style='color:red;'> $result = notify_user($user->guid, $site->guid, $subject, $body, NULL, 'email');";</label><br>

Replace this line with following 2 lines <br><label style='color:blue;'>
$validator_admin = get_entity(elgg_get_plugin_setting('validator_admin_guid','uservalidationmgr'));<br>
elgg_send_email($validator_admin->email, $user->email, $subject, $body);</label><br>
In case walled garden has been enabled, do the same changes in<br>
File: uservalidationbyadmin/start.php<br>
Line: 184<br><br>
</div>