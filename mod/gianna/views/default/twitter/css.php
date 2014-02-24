<?php 
/**
 * Elgg Twitter CSS
 * 
 * @package ElggTwitter
 */    
?>


#twitter_widget li {
	list-style-type:none;
	margin: 0 0 5px 0;
	padding-bottom: 5px;
	border-bottom: 1px solid #CCCCCC;
}
#twitter_widget li span {
	padding: 5px 0;
	display: block;
}
p.visit_twitter a {
	background:url(<?php echo elgg_get_site_url(); ?>mod/twitter/graphics/twitter16px.png) left no-repeat;
	padding: 0 0 0 20px;
	margin: 0;
}
.elgg-widget-instance-twitter input[type=text] {
	width: auto;
    margin-bottom: 10px;
}
.visit_twitter {
	padding-top: 0 2px 5px 0;
	margin: 0;
}
#twitter_widget li > a {
	display: block;
}
#twitter_widget li span a {
	display: inline !important;
}