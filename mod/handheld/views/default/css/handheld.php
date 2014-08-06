<?php
/*
 *
 * Handheld CSS
 *
 * This is where you can adjust css in your theme that needs to be overridden by handheld.
 *
 *
 */
?>

html {
    font-size: 100%;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
}
body { 
    -webkit-touch-callout: none; 
    -webkit-text-size-adjust: none; 
    -webkit-user-select: none; 
    -webkit-highlight: none; 
    -webkit-tap-highlight-color: rgba(0,0,0,0); 
}
select {
	font-size: 90%;
}
.elgg-menu-footer .elgg-menu-item-usersettings, .elgg-menu-footer .elgg-menu-item-logout {
	display: none;
}
.elgg-layout-error {
	padding-top: 20px;
	margin-top: 0;
}
.elgg-box-error {
	padding: 20px;
	color: #B94A48;
	background-color: #F8E8E8;
	border: 1px solid #E5B7B5;
	border-radius: 5px;
}
/* ***************************************
	IPHONE PORTRAIT
*************************************** */
@media screen and (max-width: 320px)  { 
    .elgg-menu-topbar-alt {
        display: none !important;
    }
    .elgg-menu-footer .elgg-menu-item-usersettings, .elgg-menu-footer .elgg-menu-item-logout {
        display: inline-block;
    }
}

/* Add your css below */
