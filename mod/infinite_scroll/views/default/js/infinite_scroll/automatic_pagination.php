<?php
/**
 * Load next page of a listing through ajax automatically
 *
 * @package ElggInfiniteScroll
 */
?>

elgg.require('elgg.infinite_scroll');
elgg.provide('elgg.infinite_scroll.automatic_pagination');

elgg.infinite_scroll.automatic_pagination.add_waypoint = function() {
	$(this).unbind('append');
	$(this).waypoint(elgg.infinite_scroll.automatic_pagination.remove_waypoint, {
		offset: '100%',
	});
	
};

elgg.infinite_scroll.automatic_pagination.remove_waypoint = function() {
	$(this).waypoint('destroy');
	$(this).click();
	$(this).bind('append', elgg.infinite_scroll.automatic_pagination.add_waypoint);
};

elgg.infinite_scroll.automatic_pagination.init = function() {
	$('.elgg-infinite-scroll-bottom .elgg-button').waypoint(
		elgg.infinite_scroll.automatic_pagination.remove_waypoint, {
			offset: '100%',
		}
	);
};

elgg.register_hook_handler('init', 'system', elgg.infinite_scroll.automatic_pagination.init);
