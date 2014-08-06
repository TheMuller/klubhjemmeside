<script type="text/javascript" >

$(function() {
	
	// Create dropdown
	$("<select />").appendTo("ul.elgg-menu-site");

	$("<option />", {
		 "selected": "selected",
		 "value"   : "",
		 "text"    : "<?php echo elgg_echo('handheld:navigation'); ?>"
	}).appendTo("ul.elgg-menu-site select");
	
	$("ul.elgg-menu-site a").each(function() {
		var el = $(this);
		$("<option />", {
		   "value"   : el.attr("href"),
		   "text"    : el.text()
		}).appendTo("ul.elgg-menu-site select");
	});

	$("ul.elgg-menu-site select").change(function() {
		window.location = $(this).find("option:selected").val();
	});
	$(this).find("option:selected").text();
});

</script>

<?php
/**
 * Elgg page header 
 * In the default theme, the header lives between the topbar and main content area.
 */

// link back to main site.
echo elgg_view('page/elements/header_logo', $vars);

// insert site-wide navigation
if (elgg_is_logged_in()) {
	echo elgg_view_menu('site');
}
