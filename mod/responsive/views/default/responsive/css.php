<?php

/**
 * Responsive css
 */

?>

/* ***************************************
	FIX
*****************************************/
.groups-profile-icon img {
    width: 100%;
    height: auto;
}
/*** FRIENDSPICKER ***/
.friends-picker-container h3 {
    font-size: 1.4em !important;
    margin-bottom: 5px;
}
.friends-picker-wrapper {
    width: 100%;
}
.friendspicker-savebuttons {
	background: transparent;
	margin: 10px 10px 10px 0;
}
.friends-picker-container .panel {
	height: 100%;
	width: auto;
    display: block;
	margin: 0;
	padding:0;
    border-bottom: 1px solid #CCC;
}
.tidypics-river-list > li {
	*float: left;
}
/* ***************************************
	RESPONSIVE
*****************************************/
html {
    font-size: 100%;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
}
.clearfix {
  *zoom: 1;
}
/*** NAVBAR ***/
.elgg-navbar {
    *position: relative;
    *z-index: 2;
    overflow: visible;
}
.divider-vertical {
	float: left;
    height: 40px;
    width: 1px;
    margin: 0;
    overflow: hidden;
    background-color: #575D63;
    border-right: 1px solid #232527;
}
.elgg-navbar .elgg-navbar-inner {
	*min-width: 100%;
    min-height: 40px;     
    background-color: #232527;
    background-image: -moz-linear-gradient(top, #3D4145, #2B2E31);
    background-image: -ms-linear-gradient(top, #3D4145, #2B2E31);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#3D4145), to(#2B2E31));
    background-image: -webkit-linear-gradient(top, #3D4145, #2B2E31);
    background-image: -o-linear-gradient(top, #3D4145, #2B2E31);
    background-image: linear-gradient(top, #3D4145, #2B2E31);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3D4145', endColorstr='#2B2E31', GradientType=0);
    border-bottom: 1px solid #000;

    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
}
.elgg-button-nav {
    display: none;
    font-size: 13px;
    line-height: 8px;
    color: #EBEFF1;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.75);      
    float: left;
    padding: 15px 15px;
    margin-left: 10px;
}
@media (max-width: 1018px)  {
    .elgg-page-default {
        width: 100%;
        min-width: 0;
    }
    .elgg-main {
        padding: 10px 20px;
    }
    #login-dropdown {
        margin-right: 20px;
    }
    .elgg-search-header {
     	right: 20px;
    }
    .elgg-heading-site {
        margin-left: 20px;
    }
    .elgg-menu-site-default {
        left: 10px;
    }
    .elgg-page-topbar > .elgg-inner {
        width: auto;
        padding: 0;
    }
    .elgg-page-default .elgg-page-header > .elgg-inner {
        width: auto;
    }
    .elgg-page-default .elgg-page-body > .elgg-inner {
    	width: auto;
    }
    .elgg-page-default .elgg-page-footer > .elgg-inner {
        width: auto;
        margin: 0 20px;
    }
    .elgg-page-footer {
        width: auto;
    }
    .elgg-layout-one-sidebar .elgg-main {
        width: auto;
    }
    .elgg-layout-two-sidebar .elgg-main {
        width: auto;
    }
    .elgg-layout-one-sidebar {
        background: none;
    }
    .elgg-layout-two-sidebar {
        background: none;
    }
    .elgg-sidebar {
        margin-right: 10px;
    }
    .elgg-sidebar-alt {
        display: none;
    }
    .elgg-main .elgg-output img {
        max-width: 100%;
        height: auto;
    } 
    .file-photo .elgg-photo {
		max-width: 98%;
    }
    .tidypics-photo {
    	max-width: 97%;
    }
    .elgg-image-block {
        padding: 10px 0;
    } 
    .groups-profile-icon img {
        width: 100%;
        height: auto;
    }
}
@media (min-width: 980px) {
    .elgg-navbar {
        display: none;
    }
    .elgg-nav-collapse {
		display: block !important;
	}
}
@media (max-width: 979px) {
    .elgg-page-default .elgg-page-header > .elgg-inner {
    	height: auto;
        min-height: 90px;
    }
    .elgg-page-header > .elgg-inner > .elgg-menu-site,
    .elgg-page-topbar .elgg-search,
    .elgg-page-header .elgg-search {
    	display: none;
    }
    .elgg-page-topbar {
    	display: inline;
        min-height: 40px;
        border-bottom: none;
    }
	.elgg-menu-topbar > li > a.elgg-topbar-logo {
    	padding: 0;
    }
	#dashboard-info {
    	margin-left: 0;
        margin-right: 0;    
    }
    .profile .elgg-inner {
        margin: 0;
    }
    .elgg-river-responses .elgg-form{
        padding-bottom: 5px;
        height: auto;
    }
    .elgg-river-responses input[type=submit] {
        margin-left: 0;
        margin-top: 4px;
    }
    .elgg-river-responses input[type=text] {
        width: 100%;
    }
    .elgg-menu-topbar {
        display: none;
    } 
    .elgg-nav-collapse .elgg-search-header {
    	display: inline;
        float: none;
        position: static;
    }
    .elgg-search input[type=text] {
    	color: #FFF;
        border: 1px solid #535C61;
        background-position: 6px -934px;
    }
    .elgg-search input[type=text]:focus, .elgg-search input[type=text]:active {
        background-color: #6E7A80;
        border: 1px solid #535C61;
        background-position: 6px -916px;
        color: #000;
    }
    .elgg-search input[type=submit] {
        display: none;
    }
    #login-dropdown {
        top: 75px;
    }
    .elgg-heading-site, .elgg-heading-site:hover {
        line-height: 1.84em;
    }
    #groups-tools > li {
        width: 100%;
        float: none;
        margin-bottom: 20px;
    }
    #groups-tools > li:nth-child(odd) {
        margin-right: 0;
    }
    #groups-tools > li:last-child {
        margin-bottom: 0;
    }

    /***** IE ******/
    #groups-tools > .odd {
        margin-right: 0;
    }
    /***** CUSTOM INDEX ******/
    .elgg-col-1of2 {
        width: 100%;
    }
    .prl {
        padding-right: 0;
    }
    /***** WIDGETS ******/
    .elgg-col-2of3,
    #elgg-widget-col-1,
    #elgg-widget-col-2,
    #elgg-widget-col-3 {
        width: 100%;
        min-height: 0 !important;
    }
    .elgg-module-widget {
        margin: 0 0 15px;
    }
     /***** NAVIGATION ******/
    .elgg-navbar {
        position: relative;
        display: block;
    }
    .elgg-nav-collapse {
        background: #000;
        clear: both;
		display: none;
        padding: 10px 0 10px;
        position: absolute;
        top: 41px;
        *left: 0;
        width: 100%;
        z-index: 10000;
    }
    .elgg-button-nav {
        cursor: pointer;
        display: block;
    }
    .elgg-button-nav:hover {
        color: #FFF;
        text-decoration: none;
    }
    .elgg-nav-collapse ul {
        background: inherit;
        display: block;
        position: static;
        width: auto;
        height: auto;
    }
    .elgg-nav-collapse ul li {
        float: none;
        margin: 1px 10px 0;
    }
    .elgg-nav-collapse li {
        background: #3c4347;
        clear: both;
        float: none;
        padding: 6px 0 6px 20px;
        margin: 0 10px;
    }
    .elgg-nav-collapse ul li ul li {
        margin-left: 0;
        margin-right: 0;
    }
    .elgg-nav-collapse li:hover {
        background: #252a2d;
    }
    .elgg-nav-collapse li ul {
    	display: block;
		background: #000;
    }
    .elgg-nav-collapse a:hover {
        background: none repeat scroll 0 0 #F8F8F8;
    }
    .elgg-nav-collapse a, .elgg-nav-collapse ul a {
        color: #EBEFF1;
        display: block;
        font: inherit;
        padding: 0;
    }
    .elgg-nav-collapse a:hover, .elgg-nav-collapse ul a:hover {
        background: none repeat scroll 0 0 transparent;
        color: #FFF;
    }
    .elgg-nav-collapse .elgg-more {
    	padding-bottom: 0 !important;
    }    
    .elgg-nav-collapse .elgg-more:hover {
    	background: #3c4347;
    }    
    .elgg-nav-collapse .elgg-state-selected {
        background-color: #252a2d;
    }
    .elgg-menu-site-more,
    .elgg-menu-site-more > li > a,
    .elgg-menu-site-default > li > a,
    .elgg-menu-site-default > .elgg-state-selected > a,
	.elgg-menu-site-default > li:hover > a {
    	color: #FFF;
        background-color: transparent;
        border: none;
        
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
    
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }
    .elgg-menu-topbar-alt,
    .elgg-menu-topbar {
        float: none;
        padding: 0;
    }
    .elgg-menu-topbar > li > a {
        margin-left: 0;
    }
    .elgg-menu-topbar .elgg-icon {
		margin-right: 8px;    
    }
    .elgg-icon-hover-menu:hover {
        background: transparent url(<?php echo elgg_get_site_url();?>mod/responsive/graphics/avatar_menu_arrows.png) no-repeat;
        background-position: right bottom;
        width: 100%;
        height: 100%;
    }
    .elgg-icon-hover-menu {
        background: transparent url(<?php echo elgg_get_site_url();?>mod/responsive/graphics/avatar_menu_arrows.png) no-repeat;
        background-position: right bottom;
        width: 100%;
        height: 100%;
    }
    /*** WALLED ***/
    .elgg-body-walledgarden {
    	margin: 0 auto;
        width: auto;
    }
    .elgg-heading-walledgarden br {
    	display: none;
    }
    .elgg-menu-walled-garden {
    	margin: 10px 0;
    }
    .elgg-module-walledgarden .elgg-col .elgg-inner {
    	margin: 0;
    }
    .elgg-walledgarden-double > .elgg-head,
    .elgg-walledgarden-double > .elgg-body,
    .elgg-walledgarden-double > .elgg-foot,
    .elgg-walledgarden-single > .elgg-head,
    .elgg-walledgarden-single > .elgg-body,
    .elgg-walledgarden-single > .elgg-foot {
        background: rgba(83, 110, 141, .2);
    }
}
@media (max-width: 767px) {
    .elgg-river-attachments,
    .elgg-river-message,
    .elgg-river-content {
        font-size: 100%;
    }
    .navbar .elgg-search input[type=text] {
        border: 1px solid #393939;
    }
    .embed-wrapper {
        width: auto;
        margin: 0;
    }
    .elgg-module-register {
        width: 100%;
        border-left: none;
        margin-left: 0;
        padding-left: 0;
    }
    .elgg-form-account {
        width: 100%;
    }
    .elgg-layout-one-sidebar {
        width: 100%;
        float: left;
    }
    .elgg-layout-two-sidebar {
        width: 100%;
        float: left;
    }
    .elgg-sidebar {
        background: rgba(83, 110, 141, .2);
        width: 100%;
        float: left;
        padding: 0 20px;
        margin: 0 0 10px 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .elgg-sidebar .elgg-module,
    .elgg-sidebar .elgg-search,
    .elgg-sidebar .elgg-menu-page,
    .elgg-sidebar .elgg-menu-extras {
         margin: 10px 0;
    }
    .elgg-sidebar .elgg-module {
        width: 100%;
        
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    /*** SUB MENUES ***/
    .elgg-menu-page a,
    .elgg-menu-owner-block li a {
        display: block;
        
		border-bottom: 1px solid #D1D7DB;
        padding: 10px;
		margin: 0 0 1px 0;
        
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        
        background-color: #fbfbfb;
        background-image: -moz-linear-gradient(top, #ffffff, #EBEFF1);
        background-image: -ms-linear-gradient(top, #ffffff, #EBEFF1);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#EBEFF1));
        background-image: -webkit-linear-gradient(top, #ffffff, #EBEFF1);
        background-image: -o-linear-gradient(top, #ffffff, #EBEFF1);
        background-image: linear-gradient(top, #ffffff, #EBEFF1);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#EBEFF1', GradientType=0);
        
        -webkit-box-shadow: inset 0 1px 0 #ffffff;
        -moz-box-shadow: inset 0 1px 0 #ffffff;
        box-shadow: inset 0 1px 0 #ffffff;
    }
    .elgg-menu-page a:hover,
    .elgg-menu-owner-block li a:hover {
        background: -moz-linear-gradient(100% 100% 90deg, #FFFFFF, #FAFAFA) repeat scroll 0 0 transparent;
        box-shadow: inset 1px 0 0 #FFFFFF;
        color: #0088CC;
        text-decoration: none;
    }
    .elgg-menu-page li.elgg-state-selected > a,
    .elgg-menu-owner-block li.elgg-state-selected > a {
        background: -moz-linear-gradient(100% 100% 90deg, #FFFFFF, #FAFAFA) repeat scroll 0 0 transparent;
        box-shadow: inset 1px 0 0 #FFFFFF;
        color: #555555;
    }
    .elgg-menu-entity {
    	margin-left: 0;
        vertical-align: right;  
        height: auto;
    }
    .elgg-menu-entity li {
        vertical-align: right; 
    }
    .elgg-menu-footer-alt,
    .elgg-menu-footer-default {
    	display: block;
        float: none;
        text-align: center;
    }
    .elgg-page-footer .float-alt {
        float: none;
        text-align: center;
    }
    .tidypics-photo-item + .tidypics-photo-item {
    	margin-left: 0;
        margin-right: 7px;
    }
}
@media (max-width: 640px) {
    .groups-profile-fields {
        float: left;
        padding-left: 0;
    }
    .groups-profile-fields .odd,
    .groups-profile-fields .even {
        padding: 0;
    }
    #profile-owner-block {
    	border-right: none;
        width: auto;
    }
    #profile-details {
        display: block;
        float: left;
    }
}
@media (max-width: 480px)  {
    .elgg-main {
        padding: 10px;
    }
    #login-dropdown {
        margin-right: 10px;
    }
    .elgg-heading-site {
        margin-left: 10px;
    }
    .elgg-heading-site, .elgg-heading-site:hover {
    	line-height: 2.14em;
		font-size: 1.8em;
    }
    .elgg-page-default .elgg-page-footer > .elgg-inner {
        margin: 0 10px;
    }
    .elgg-sidebar {
        padding: 0 10px;
    }
    .elgg-likes {
        width: auto;
    }
    #notificationstable td.namefield {
        width: 20%;
    } 
    .tinymce-toggle-editor {
        display: none !important;
    }
    td.mceToolbar {
        display: none;
    }
    .elgg-page-footer > .elgg-inner {
        margin: 0 10px;    
    }
    .file-photo .elgg-photo {
		max-width: 97%;
    }
}
@media (max-width: 330px)  {
    #login-dropdown {
        display: none;
    }
}
