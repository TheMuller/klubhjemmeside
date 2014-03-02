<?php
/**
 * Load next page of a listing through ajax when a button clicked
 *
 * @package ElggInfiniteScroll
 */
?>

elgg.provide('elgg.infinite_scroll');

elgg.infinite_scroll.load_next = function(event, direction) {
	var $bottom = $(this).parent();
	elgg.infinite_scroll.bottom = $bottom;
	
	$bottom.addClass('elgg-infinite-scroll-ajax-loading')
		.find('.elgg-button').css('visibility', 'hidden');
	
	var $list = $bottom.siblings('.elgg-list, .elgg-gallery');

	var $params = elgg.parse_str(elgg.parse_url(location.href).query);
	$params = $.extend($params, {
		path: elgg.parse_url(location.href).path,
		items_type: $list.hasClass('elgg-list-entity') ? 'entity' :
					$list.hasClass('elgg-gallery') ? 'entity' :
					$list.hasClass('elgg-list-river') ? 'river' :
					$list.hasClass('elgg-list-annotation') ? 'annotation' : false,
		offset: $list.children().length + (parseInt($params.offset) || 0)
	});
	
	var url = "/ajax/view/infinite_scroll/list?" + $.param($params);
	elgg.get(url, elgg.infinite_scroll.append);
	return false;
}

elgg.infinite_scroll.append = function(data) {
	var $bottom = elgg.infinite_scroll.bottom;
	$bottom.removeClass('elgg-infinite-scroll-ajax-loading');
	var $list = $bottom.siblings('.elgg-list, .elgg-gallery');
	
	var more = false;
	if (data) {
		$list.append($(data).children());
		if ($(data).children().length == $list.data('elgg-infinite-scroll-limit')) {
			$bottom.find('.elgg-button').css('visibility', 'visible');
			more = true;
		}
	}
	if (!more) {
		$bottom.html(elgg.echo('infinite_scroll:list_end'));
	}
	$bottom.find('.elgg-button').trigger('append', data);
}

elgg.infinite_scroll.init = function() {
	
	// Select all paginated .elgg-list  or elgg-gallery and not into widget
	$list = $('.elgg-pagination').siblings('.elgg-list, .elgg-gallery').filter(':not(.elgg-module *)')
	
	// Hide pagination
	.siblings('.elgg-pagination').hide().end()
	
	// Set limit as HTML5 data attribute
	.each(function(){
		$(this).data('elgg-infinite-scroll-limit', $(this).children().length);
	})
	
	// Add load more button at the final of the list
	.after(
		$('<div class="elgg-infinite-scroll-bottom"></div>')
		.append(
			$('<?php
				echo elgg_view('output/url', array(
					'text' => elgg_echo('infinite_scroll:load_more'),
					'href' => '',
					'class' => 'elgg-button',
				)); 
			?>').click(elgg.infinite_scroll.load_next)
		)
	);
	
};

elgg.register_hook_handler('init', 'system', elgg.infinite_scroll.init);
