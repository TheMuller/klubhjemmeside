<?php 
$user_guid = $vars['user_guid'];
$display = "";
$num_notifications = $vars['num_notifications'];
if ($num_messages == 0) 
	$display = "style=\"display:none\"";
?>
<span class="elgg-icon elgg-icon-live_notifications"></span>
<span class="messages-new" id="count_unread_notifications" <?php echo $display ?>>
	<?php echo $num_notifications ?>
</span>
<div id="live_notifications">				  	
    <div id="live_notifications_loader"></div>
    <div id="live_notifications_result"></div>
    <div id="live_notifications_see_more">
    	<a href="<?php echo $vars['url'] ?>pg/live_notifications/all"><?php echo elgg_echo('live_notifications:see_all'); ?></a>
    </div>
 </div>