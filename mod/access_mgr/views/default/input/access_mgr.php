<script type='text/javascript'>

window.onload = function() {
    var d = document.getElementsByClassName('elgg-foot')[0];
    d.parentNode.appendChild(d);
    
}	
</script>

<?php
/**
 * Provide a way to manage pages
 *
 * @package Elgg
 * @subpackage Core
 */
 $group = $vars['entity'];
    if($group instanceof ElggGroup){
		$member_allow =	$group->member_allow;
	}else{
	  $member_allow = 'no';
	  }
echo "<div id='GROUPPAID' style='background:#DDF;'><br>
<div><b>".elgg_echo("Members can Add/Edit content?")."<br /></b>";
echo elgg_view("input/radio", array(
                                          "name" => 'member_allow',
                                          "value" => $member_allow,
                                          "onchange"=>"(this.value);return true;",
                                          'options' => array(
                                                             elgg_echo('groups:yes') => 'yes',
                                                             elgg_echo('groups:no') => 'no',
                                                             ),
                                          ))."</div></div>";
										  
?>


