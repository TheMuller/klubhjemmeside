
elgg.provide('elgg.email_disable');

elgg.email_disable.init = function() {
  
  $(".notifications-email-disable").live('click', function(e) {
	e.preventDefault();
	
	elgg.action('notifications_email_disable/acknowledge', {});
	
	$.fancybox.close();
  });

}

elgg.register_hook_handler('init', 'system', elgg.email_disable.init);