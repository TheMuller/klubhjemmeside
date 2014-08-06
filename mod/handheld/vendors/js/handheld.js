if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
    $(".elgg-page").click(function(){
        //we just need to attach a click event listener to provoke iPhone/iPod/iPad's hover event
    });
}
// prevents links from apps from opening in mobile safari
if (window.navigator.standalone) {
	var local = document.domain;
	$('a').click(function() {
		var a = $(this).attr('href');
		if ( a.match('http://' + local) || a.match('http://www.' + local) ){
			event.preventDefault();
			document.location.href = a;
		}
	});
}

var jPanelMenu = {};
$(function() {

	jPanelMenu = $.jPanelMenu({
		menu: '.elgg-sidebar',
		trigger: '.elgg-open',
		openPosition: '260px',

    	//duration: 300,
		animated: false,
		keyboardShortcuts: {
			code: 77, /* m key */
			open: false,
			close: false
    	}
	});
	jPanelMenu.on();
	
});

