<?php
/**
 * Elgg user display
 *
 * @uses $vars['entity'] ElggUser entity
 * @uses $vars['size']   Size of the icon
 */


if($vars['admin_view']   == true){
$user = $vars['entity'];
    echo $user->name;
        
}else{
    include elgg_get_root_path() ."views/default/user/default.php";
}
