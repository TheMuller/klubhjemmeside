<?php
/**
 * Navigation
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	PAGINATION
*************************************** */
.elgg-pagination {
	margin: 20px 0 10px;
	display: block;
	width: auto;
	text-align: center;	
	background: #F5F5F5;
	border: 1px solid #DCDCDC; /* Fallback */
    border: 1px solid rgba(0, 0, 0, 0.1);
	
	box-shadow: inset 0 0 1px #FFFFFF;
}
.elgg-pagination li {
    display: inline-block;
	border-bottom: 0;
}
.elgg-pagination li:first-child a {
    border-left-width: 1px;
}
.elgg-pagination a, 
.elgg-pagination span {
	text-decoration: none;
	display: block;
	padding: 8px 15px 5px;
	text-align: center;
	height: 24px;
	color: #000000;
	border-color: #DCDCDC; /* Fallback */
    border-color: rgba(0, 0, 0, 0.1);
    border-style: solid;
    border-width: 0 1px 0 0;
}
.elgg-pagination a:hover {
	background: #FFFFFF;
	color: #555555;
}
.elgg-pagination .elgg-state-disabled span {
	color: #CCCCCC;
	border-color: #CCCCCC;
}
.elgg-pagination .elgg-state-selected span {
	color: #555555;
	background: #FFFFFF;
}

/* ***************************************
	TABS
*************************************** */
.elgg-tabs {
	margin-bottom: 10px;
	display: block;
	width: auto;
	text-align: center;	
	background: #F5F5F5;
	border: 1px solid #DCDCDC; /* Fallback */	
    border: 1px solid rgba(0, 0, 0, 0.1);
	
	box-shadow: inset 0 0 1px #FFFFFF;
}
.elgg-tabs li {
    display: inline-block;
	border-bottom: 0;
}
.elgg-tabs li:first-child a {
    border-left-width: 1px;
}
.elgg-tabs > li:hover {
	background: #FFFFFF;
}
.elgg-tabs a {
	text-decoration: none;
	display: block;
	padding: 8px 15px 5px;
	text-align: center;
	height: 24px;
	color: #000000;
	border-color: #DCDCDC; /* Fallback */
    border-color: rgba(0, 0, 0, 0.1);
    border-style: solid;
    border-width: 0 1px 0 0;
}
.elgg-tabs a:hover {
	background: #FFFFFF;
	color: #555555;
}
.elgg-tabs .elgg-state-selected:hover {
	background: #FFFFFF;
}
.elgg-tabs .elgg-state-selected a {
	color: #555555;
	position: relative;
	background: #FFFFFF;
}

/* ***************************************
	BREADCRUMBS
*************************************** */
.elgg-breadcrumbs {
	font-style: italic;
	line-height: 1.2em;
	color: #000000;
    font-size: 11px; 
}
.elgg-breadcrumbs > li {
	display: inline-block;
}
.elgg-breadcrumbs > li:after {
	content: "\003E";
	padding: 0 4px;
	font-weight: normal;
}
.elgg-breadcrumbs > li > a {
	font-style: normal;
	display: inline-block;
	color: #404040;
    font-size: 11px;
}
.elgg-breadcrumbs > li > a:hover {
	text-decoration: underline;
}

.elgg-main .elgg-breadcrumbs {
	position: relative;
	margin: -20px 0 5px 0;
    padding: 15px 0;
}

/* ***************************************
	TOPBAR MENU
*************************************** */
.elgg-menu-topbar,
.elgg-menu-navbar {
	float: left;
}
.elgg-menu-topbar {
	padding-top: 8px;
}
.elgg-menu-topbar > li,
.elgg-menu-navbar > li {
	float: left;
}
.elgg-menu-topbar > li > a,
.elgg-menu-navbar > li > a {
	padding-top: 2px;
	color: #FFFFFF;
	margin: 1px 25px 0 0;
}
.elgg-menu-topbar > li > a:hover {
	color: #B4B4B4;
	text-decoration: none;
}
.elgg-menu-topbar-alt {
	float: right;
}
.elgg-menu-topbar-alt > li > a {
	margin: 1px 0 0 25px;
}
.elgg-menu-navbar > li > a.elgg-topbar-logo {
	position: relative;
	z-index: 9002;
	margin-top: 4px;
	width: auto;
	height: 29px;
}
.elgg-menu-navbar > li > a.elgg-topbar-logo {
	font-family: "Arial Black", "Arial Bold", Gadget, sans-serif;
	font-size: 1.6em;
	line-height: 1.3em;
	text-decoration: none;
}
.elgg-menu-topbar > li > a.elgg-topbar-avatar {
	padding-top: 3px;
	width: 18px;
	height: 18px;
}
/* ***************************************
	SITE MENU
*************************************** */
.gianna-header .elgg-menu-navbar > li > a.elgg-topbar-logo {
    display: none;
}
.elgg-menu-site {
	font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	float: left;
	position: relative;
	top: 46px;
    left: 15px;
	z-index: 1;
	background: rgba(0, 0, 0, 0.1);
	border: 1px solid rgba(0, 0, 0, 0.2);
	
	box-shadow: inset 0 0 1px rgba(255, 255, 255, 0.6);
}
.elgg-menu-site > li {
	float: left;
}
.elgg-menu-site > li > a {
	padding: 10px 25px;	
	color: #FFFFFF;
}
.elgg-menu-site > li > a:hover {
	text-decoration: none;
}
.elgg-menu-site > .elgg-state-selected > a,
.elgg-menu-site > li:hover > a {
	background-color: #009900;
	color: #FFFFFF;
}
.elgg-menu-site > li > ul {
    position: absolute;
    opacity: 0;
    visibility: hidden;
    background-color: #FFFFFF;
	border: 1px solid #999999;
    text-align: left;
    top: 35px;
    left: 50%;
    //margin-left: -90px;
    width: 180px;

	-webkit-transform: translateZ(0);	
	-webkit-transition: all .3s .1s;
	-moz-transition: 	all .3s .1s;
	-o-transition: 		all .3s .1s;
	transition: 		all .3s .1s;

	box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.25);
}
.elgg-menu-site > li:hover > ul {
    opacity: 1;
    top: 45px;
    visibility: visible;
}
.elgg-menu-site > li > ul:before{
    content: '';
    display: block;
    border-color: transparent transparent rgb(250,250,250) transparent;
    border-style: solid;
    border-width: 10px;
    position: absolute;
    top: -16px;
    left: 20%;
    margin-left: -10px;
}
.elgg-menu-site-more li {
	min-width: 180px;
}
.elgg-menu-site-more > li > a {
	background-color: #FFFFFF;
	color: #000000;

	box-shadow: none;
}
.elgg-menu-site-more > li.elgg-state-selected > a,
.elgg-menu-site-more > li > a:hover {
	background-color: #009900;
	color: #FFFFFF;
}
.elgg-more {
	width: 182px;
}
.elgg-more > a:after {
	content: "\bb";
	margin-left: 6px;
}
/* ***************************************
	TITLE
*************************************** */
.elgg-menu-title {
	float: right;
}
.elgg-menu-title > li {
	display: inline-block;
	margin-left: 4px;
}
/* ***************************************
	FILTER MENU
*************************************** */
.elgg-menu-filter {
	margin-bottom: 10px;
	display: block;
	width: auto;
	text-align: center;	
	background: #F5F5F5;
	border: 1px solid #DCDCDC; /* Fallback */	
    border: 1px solid rgba(0, 0, 0, 0.1);
	
	box-shadow: inset 0 0 1px #FFFFFF;
}
.elgg-menu-filter > li {
    display: inline-block;
	border-bottom: 0;
}
.elgg-menu-filter li:first-child a {
    border-left-width: 1px;
}
.elgg-menu-filter > li:hover {
	background: #FFFFFF;
}
.elgg-menu-filter > li > a {
	text-decoration: none;
	display: block;
	padding: 8px 15px 5px;
	text-align: center;
	height: 24px;
	color: #000000;
	border-color: #DCDCDC; /* Fallback */
    border-color: rgba(0, 0, 0, 0.1);
    border-style: solid;
    border-width: 0 1px 0 0;
}
.elgg-menu-filter > li > a:hover {
	background: #FFFFFF;
	color: #555555;
}
.elgg-menu-filter > .elgg-state-selected > a {
	color: #555555;
	position: relative;
	background: #FFFFFF;
}
/* ***************************************
	PAGE MENU
*************************************** */
.elgg-menu-page {
	border-bottom: 1px solid #DCDCDC; /* Fallback */
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.elgg-sidebar .elgg-menu-page {
	padding: 20px;
}
.elgg-menu-page a {
    display: block;
    padding: 5px 0;
}
.elgg-menu-page li.elgg-state-selected > a {
	color: #555555;
}
.elgg-menu-page .elgg-child-menu {
	display: none;
	margin-left: 15px;
}
.elgg-menu-page .elgg-menu-closed:before, .elgg-menu-opened:before {
	display: inline-block;
	padding-right: 4px;
}
.elgg-menu-page .elgg-menu-closed:before {
	content: "\002B";
}
.elgg-menu-page .elgg-menu-opened:before {
	content: "\002D";
}
/* ***************************************
	HOVER MENU
*************************************** */
.elgg-menu-hover {
	display: none;
	position: absolute;
	z-index: 10000;
	padding: 10px;
	overflow: hidden;

	min-width: 165px;
	max-width: 250px;
	border: solid 1px;
	border: 1px solid #999999;
	background-color: #FFFFFF;

	border-radius: 0 3px 3px 3px;

	box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
}
.elgg-menu-hover > li {
	border-bottom: 1px solid #DDDDDD;
}
.elgg-menu-hover > li:last-child {
	border-bottom: none;
}
.elgg-menu-hover .elgg-heading-basic {
	display: block;
}
.elgg-menu-hover a {
	padding: 6px 10px;
	font-size: 92%;
}
.elgg-menu-hover a:hover {
	background: #EEEEEE;
	text-decoration: none;
}
.elgg-menu-hover-admin a {
	color: red;
}
.elgg-menu-hover-admin a:hover {
	color: #FFFFFF;
	background-color: red;
}
/* ***************************************
	SITE FOOTER
*************************************** */
.elgg-menu-footer > li,
.elgg-menu-footer > li > a {
	display: inline-block;
	color: rgba(0, 0, 0, 0.3);
}
.elgg-menu-footer > li:after {
	content: "\2022";
	padding: 0 6px;
}
.elgg-menu-footer-default {
	float: right;
}
.elgg-menu-footer-alt {
	float: left;
}
/* ***************************************
	GENERAL MENU
*************************************** */
.elgg-menu-general > li,
.elgg-menu-general > li > a {
	display: inline-block;
	color: #999999;
}
.elgg-menu-general > li:after {
	content: "\007C";
	padding: 0 4px;
}
.elgg-form-login .elgg-menu-general > li:after {
	content: "";
	padding: 0;
}
/* ***************************************
	ENTITY AND ANNOTATION
*************************************** */
<?php // height depends on line height/font size ?>
.elgg-menu-entity, elgg-menu-annotation {
	float: right;
	margin-left: 15px;
	font-size: 90%;
	color: #AAAAAA;
	line-height: 18px;
	height: 18px;
}
.elgg-menu-entity > li, .elgg-menu-annotation > li {
	margin-left: 15px;
}
.elgg-menu-entity > li > a, .elgg-menu-annotation > li > a {
	color: #AAAAAA;
}
<?php // need to override .elgg-menu-hz ?>
.elgg-menu-entity > li > a, .elgg-menu-annotation > li > a {
	display: block;
}
.elgg-menu-entity > li > span, .elgg-menu-annotation > li > span {
	vertical-align: baseline;
}
/* ***************************************
	OWNER BLOCK
*************************************** */
.elgg-menu-owner-block li a {
    display: block;
    padding: 5px 0;
}
.elgg-menu-owner-block li.elgg-state-selected > a {
	color: #555555;
}
/* ***************************************
	LONGTEXT
*************************************** */
.elgg-menu-longtext {
	float: right;
}
/* ***************************************
	RIVER
*************************************** */
.elgg-menu-river {
	float: right;
	margin-left: 15px;
	font-size: 90%;
	color: #AAAAAA;
	line-height: 16px;
	height: 16px;
}
.elgg-menu-river > li {
	display: inline-block;
	margin-left: 5px;
}
.elgg-menu-river > li > a {
	color: #AAAAAA;
	height: 16px;
}
<?php // need to override .elgg-menu-hz ?>
.elgg-menu-river > li > a {
	display: block;
}
.elgg-menu-river > li > span {
	vertical-align: baseline;
}
/* ***************************************
	SIDEBAR EXTRAS (rss, bookmark, etc)
*************************************** */
.elgg-menu-extras {
	padding: 20px;
	border-bottom: 1px solid #DCDCDC; /* Fallback */
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.elgg-menu-extras li {
	margin-right: 5px;
}
/* ***************************************
	WIDGET MENU
*************************************** */
.elgg-menu-widget > li {
	position: absolute;
	top: 20px;
	display: inline-block;
	width: 18px;
	height: 18px;
	padding: 0;
}
.elgg-menu-widget > .elgg-menu-item-collapse {
	left: 10px;
	margin-top: -2px;
}
.elgg-menu-widget > .elgg-menu-item-delete {
	right: 10px;
}
.elgg-menu-widget > .elgg-menu-item-settings {
	right: 32px;
}
