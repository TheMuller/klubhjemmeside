<?php 
	$widget = $vars["entity"];
	
	$rss_count = sanitise_int($widget->rss_count, false);
	if(empty($rss_count)){
		$rss_count = 4;
	}
	
	$yesno_options = array(
		"yes" => elgg_echo("option:yes"),
		"no" => elgg_echo("option:no")
	);
	
	$post_date_options = array(
		"friendly" => elgg_echo("widgets:rss:settings:post_date:option:friendly"),
		"date" => elgg_echo("widgets:rss:settings:post_date:option:date"),
		"no" => elgg_echo("option:no")
	);
?>
<div>
	<?php echo elgg_echo("widgets:rss:settings:rssfeed");?><br /> 
	<?php echo elgg_view("input/text", array("name" => "params[rssfeed]", "value" => $widget->rssfeed)); ?>
</div>

<div>
	<?php 
		echo elgg_echo("widgets:rss:settings:rss_count") . " "; 
		echo elgg_view("input/dropdown", array("name" => "params[rss_count]", "options" => range(1,10), "value" => $rss_count));
	?>
</div>

<div>
	<?php 	
		echo elgg_echo("widgets:rss:settings:show_feed_title") . " "; 
		echo elgg_view("input/dropdown", array("name" => "params[show_feed_title]", "options_values" => array_reverse($yesno_options), "value" => $widget->show_feed_title));
	?>
</div>

<div>
	<?php 
		echo elgg_echo("widgets:rss:settings:excerpt") . " "; 
		echo elgg_view("input/dropdown", array("name" => "params[excerpt]", "options_values" => $yesno_options, "value" => $widget->excerpt));
	?>
</div>

<div>
	<?php 
		echo elgg_echo("widgets:rss:settings:show_item_icon") . " "; 
		echo elgg_view("input/dropdown", array("name" => "params[show_item_icon]", "options_values" => array_reverse($yesno_options), "value" => $widget->show_item_icon));
	?>
</div>

<div>
	<?php 
		echo elgg_echo("widgets:rss:settings:post_date") . " "; 
		echo elgg_view("input/dropdown", array("name" => "params[post_date]", "options_values" => $post_date_options, "value" => $widget->post_date));
	?>
</div>
	