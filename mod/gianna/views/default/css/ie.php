/**
 * CSS for IE8 and above
 */

/* ie8 does not like shrink wrapping this div with inline-block */
.elgg-avatar {
	display: block;
}
.elgg-menu-footer > li,
.elgg-menu-footer > li > a {
	display: inline;
}
/* Gianna */
.elgg-menu-site > li:hover > ul {
    top: 40px;
}
.file-photo .elgg-photo,
.tidypics-photo-wrapper .elgg-photo {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/gianna/graphics/explorer/bg-005.png) repeat top left;
}
.elgg-menu-site {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/gianna/graphics/explorer/bg-01.png) repeat top left;
}
.gianna-navigation {	
	background: url(<?php echo elgg_get_site_url();?>mod/gianna/graphics/explorer/bg-015.png) repeat top left;
}
.ez-info-module,
.elgg-module-index,
.elgg-module-request,
.elgg-module-register,
.gianna-index .custom-index .elgg-module,
.gianna-index .elgg-inner .elgg-layout-one-sidebar {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/gianna/graphics/explorer/bg-01.png) repeat top left;
}
