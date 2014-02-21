// Text character limiter, not to break layout when sub-text is to long

$(document).ready(function() {
	$('.elgg-gallery-friends .elgg-body .elgg-subtext').each(function(){
		if ($(this).text().length > 27) {
			$(this).text($(this).text().substring(0, 28) + "...");
		}
	});
});


