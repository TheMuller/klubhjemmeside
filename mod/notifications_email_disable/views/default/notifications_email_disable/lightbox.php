<?php
  elgg_load_js('lightbox');
  elgg_load_css('lightbox');
  
  $url = elgg_get_site_url() . 'ajax/view/notifications_email_disable/acknowledge';
?>

<script>
$(document).ready( function() {
  $.fancybox({
	'href' : '<?php echo $url; ?>',
	'type' : 'ajax',
	'hideOnContentClick' : false,
	'transitionIn'	:	'elastic',
	'transitionOut'	:	'elastic',
	'speedIn'		:	600,
	'speedOut'		:	200,
	'padding'		:	40,
	'modal'			:	true
  });
});
</script>
