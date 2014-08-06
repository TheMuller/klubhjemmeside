<?php
/*
 *
 * Handheld CSS
 *
 * @package handheld
 * @author Per Jensen - Elggzone
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright Copyright (c) 2013, Per Jensen
 *
 * @link http://www.perjensen-online.dk/
 *
 */
?>

/* ***************************************
	Typography
*************************************** */
body {
	margin: 0;
	font-size: 90%;
	line-height: 1.4em;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
}
a {
	color: #152129;
}
a:hover,
a.selected {
    color: #5A8AAA; 
	text-decoration: none;
}
.elgg-heading-site, .elgg-heading-site:hover {
    position:absolute; 
    line-height: 60px;
    font-weight:normal;
    font-style:normal;    
	font-size: 1.2em;
    left: 10px;
    width: auto;
}
.elgg-logo {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/logo.png) no-repeat 0 0;
    display: block;
	position: relative;
    z-index: 2;
    float: left;
	margin-left: 10px;
    top: 15px;
    height: 44px;
    width: 160px;
}
code {
	font-family: Monaco, "Courier New", Courier, monospace;
	font-size: 12px;
    display:block;
	background: #F5FBFF;
    border: 1px solid #D1D7DB;
    border-left: 20px solid #DDE7ED;
	color: #000000;
	overflow:auto;
    padding: 15px;

	overflow-x: auto; /* Use horizontal scroller if needed; for Firefox 2, not needed in Firefox 3 */

	white-space: pre-wrap;
	word-wrap: break-word; /* IE 5.5-7 */	
}
pre {
	font-family: Monaco, "Courier New", Courier, monospace;
	font-size: 12px;
	background: #F5FBFF;
    border: 1px solid #D1D7DB;
	color:#000000;
	overflow:auto;

	overflow-x: auto; /* Use horizontal scroller if needed; for Firefox 2, not needed in Firefox 3 */

	white-space: pre-wrap;
	word-wrap: break-word; /* IE 5.5-7 */	
}
pre {
	padding: 15px;
}
blockquote {
	font-family: Georgia, Times, "Times New Roman", serif;
	line-height: 1.4em;
	padding: 15px 30px 15px 60px;
    font-style: italic;
    position: relative;
}
blockquote:before {
    display: block;
    content: "\201C";
    font-size: 80px;
    position: absolute;
    left: 14px;
    top: 32px;
    color: #C9D9E3;
}
h1, h2, h3, h4, h5, h6 {
	color: #152129;
}
.elgg-heading-main,
.elgg-heading-basic {
	color: #152129;
}
/* **************************
	BUTTONS
************************** */
.elgg-button {
	display: inline-block;
	outline: none;
	text-align: center;
	text-decoration: none;
	font: 14px/100% Arial, Helvetica, sans-serif;
    color: #FFF;
	padding: 8px 28px 9px;
    
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	cursor: pointer;    
    
    -webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
a.elgg-button {
	padding: 10px 28px 11px;
}
.elgg-button:hover {
    color: #FFF;
	text-decoration: none;
}
.elgg-button:active {
	position: relative;
}

/* **************************
	SUBMIT
************************** */
.elgg-button,
.elgg-search input[type=submit],
.elgg-button-submit,
.elgg-button-submit:active,
.elgg-button-submit:focus {
    border: 1px solid #4F7A97;    
	background: none;
    
	background-color: #6C96B2; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#84A7BE), to(#6C96B2));
	background-image: -webkit-linear-gradient(top, #84A7BE, #6C96B2); 
	background-image:    -moz-linear-gradient(top, #84A7BE, #6C96B2);
	background-image:     -ms-linear-gradient(top, #84A7BE, #6C96B2);
	background-image:      -o-linear-gradient(top, #84A7BE, #6C96B2);
    
    -webkit-box-shadow: inset 0 1px 0 #B2C8D6;
    -moz-box-shadow: inset 0 1px 0 #B2C8D6;
    box-shadow: inset 0 1px 0 #B2C8D6;
}
.elgg-button:hover,
.elgg-search input[type=submit]:hover,
.elgg-button-submit:hover {
    background: none;

	background-color: #7DA2BB; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#98B5C8), to(#7DA2BB));
	background-image: -webkit-linear-gradient(top, #98B5C8, #7DA2BB); 
	background-image:    -moz-linear-gradient(top, #98B5C8, #7DA2BB);
	background-image:     -ms-linear-gradient(top, #98B5C8, #7DA2BB);
	background-image:      -o-linear-gradient(top, #98B5C8, #7DA2BB);
}
.elgg-button-submit.elgg-state-disabled {
    border: 1px solid #D1D7DB;
	cursor: default;
	color: #CCC;
    text-shadow: none;
    background: -moz-linear-gradient(100% 100% 90deg, #EEE, #FFF) repeat scroll 0 0 transparent;
    box-shadow: inset 0 1px 0 #FFFFFF;
}
/* **************************
	CANCEL
************************** */
.elgg-button-cancel,
.elgg-button-cancel:active,
.elgg-button-cancel:focus {
    border: 1px solid #AD6704;
    background: none;
        
	background-color: #F89406; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FBB450), to(#F89406));
	background-image: -webkit-linear-gradient(top, #FBB450, #F89406); 
	background-image:    -moz-linear-gradient(top, #FBB450, #F89406);
	background-image:     -ms-linear-gradient(top, #FBB450, #F89406);
	background-image:      -o-linear-gradient(top, #FBB450, #F89406);
       
    -webkit-box-shadow: inset 0 1px 0 #FBCC89;
    -moz-box-shadow: inset 0 1px 0 #FBCC89;
    box-shadow: inset 0 1px 0 #FBCC89;
}
.elgg-button-cancel:hover {
    background: none;
        
	background-color: #F9A837; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FBCC89), to(#F9A837));
	background-image: -webkit-linear-gradient(top, #FBCC89, #F9A837); 
	background-image:    -moz-linear-gradient(top, #FBCC89, #F9A837);
	background-image:     -ms-linear-gradient(top, #FBCC89, #F9A837);
	background-image:      -o-linear-gradient(top, #FBCC89, #F9A837);
}
/* **************************
	DELETE
************************** */
.elgg-button-delete,
.elgg-button-delete:active,
.elgg-button-delete:focus {
    border: 1px solid #802420;
    background: none;
        
	background-color: #bd362f;    
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ee5f5b), to(#bd362f));
	background-image: -webkit-linear-gradient(top, #ee5f5b, #bd362f); 
	background-image:    -moz-linear-gradient(top, #ee5f5b, #bd362f);
	background-image:     -ms-linear-gradient(top, #ee5f5b, #bd362f);
	background-image:      -o-linear-gradient(top, #ee5f5b, #bd362f);
    
    -webkit-box-shadow: inset 0 1px 0 #F38F8B;
    -moz-box-shadow: inset 0 1px 0 #F38F8B;
    box-shadow: inset 0 1px 0 #F38F8B;
}
.elgg-button-delete:hover {
    background: none;
        
	background-color: #DE3732; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#E87774), to(#DE3732));
	background-image: -webkit-linear-gradient(top, #E87774, #DE3732); 
	background-image:    -moz-linear-gradient(top, #E87774, #DE3732);
	background-image:     -ms-linear-gradient(top, #E87774, #DE3732);
	background-image:      -o-linear-gradient(top, #E87774, #DE3732);
}
/* **************************
	ACTION
************************** */
a.elgg-button-action,
a.elgg-button-action:hover,
a.elgg-button-action:active,
a.elgg-button-action:focus {
	background: none;
    background-image: none;
	border: none;
	padding: 3px 0;
    margin-left: 10px;
	font-weight: bold;
	text-decoration: none;
	text-shadow: none;
	cursor: pointer;
	
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
a.elgg-button-action {
	color: #4690D6;
}
a.elgg-button-action:hover,
a.elgg-button-action:active {
    color: #5A8AAA;
}
#profile-owner-block a.elgg-button-action {
	margin-left: 0;
}
.messages-buttonbank .elgg-button {
	background: none;
	border: none;
	text-shadow: none;
	color: #4690D6;
        
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
.messages-buttonbank .elgg-button:hover {
	color: #555555;
}
/* **************************
	CUSTOM INDEX
************************** */
.custom-index {
	padding: 10px;
}
.elgg-col-1of2 {
	width: 100%;
}
.prl {
	padding-right: 0;
}
/***** MISC ******/
.elgg-river-attachments,
.elgg-river-message,
.elgg-river-content {
	border-left: none;
    padding-left: 0;
}
#friends_collections_accordian li h2 {
	color: #152129;
	width: auto;
    padding: 7px 16px 8px;
    border: 1px solid #D1D7DB;
    
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
.elgg-list,
.elgg-list-river {
	border-top: 1px solid #D1D7DB;
}
.elgg-list > li,
.elgg-list-river > li,
.elgg-main > .elgg-head {
	border-bottom: 1px solid #D1D7DB;
}
.elgg-item .elgg-content {
	margin: 10px 0;
}
.elgg-tagcloud {
	margin-bottom: 2px;
}
.small a,
.small span {	
	vertical-align: top;
}
.elgg-content .elgg-icon {
	margin: 0 6px 0 0;
}
.elgg-item .elgg-content .elgg-icon {
	vertical-align: top;
}
.small .elgg-icon-tag {
	margin: 0 6px 0 0;
}
.elgg-tags > li {
	margin-right: 6px;
}
.elgg-tags li .elgg-icon-tag {
	margin: 0;
}
.embed-wrapper {
	width: auto;
	margin: 0;
}
.elgg-col-2of3 {
	width: auto;
    height: auto;
}
.elgg-likes {
	width: auto;
}
#dashboard-info {
	border: 1px solid #D1D7DB;
	margin: 0 0 15px;
}
.elgg-gallery > li {
	margin: 10px;
}
/***** COMPONENTS ******/
#notificationstable {
	margin-top: 10px;
}
#notificationstable td {
	padding: 5px 0;
	border-top: 1px solid #D1D7DB;
}
.elgg-table {
	border-top: 1px solid #D1D7DB;
}
.elgg-table td, .elgg-table th {
	border: 1px solid #D1D7DB;
}
.elgg-table-alt {
	width: 100%;
	border-top: 1px solid #D1D7DB;
}
.elgg-table-alt td, .elgg-table-alt th {
	padding: 6px 4px 6px 4px;
	border-bottom: 1px solid #D1D7DB;
}
/***** IMG ******/
.elgg-photo {
	max-width: 97%;
    border: 1px solid #D1D7DB;
}
.file-photo {
	margin-top: 15px;
}
.elgg-output img {
	height: auto;
}
.elgg-image-block {
	padding: 10px 0;
}
.elgg-image-block .elgg-image {
	margin-right: 10px;
}
.tidypics-heading {
	color: #152129;
}
.tidypics-heading:hover {
    color: #5A8AAA !important;
}
.tidypics-gallery-widget > li {
	width: auto;
    margin: 5px 10px;
}
/***** FORMS ******/
.elgg-river-item form {
	background-color: #F5F7F8;
    border: 1px solid #D1D7DB;
	padding: 10px;
	
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
    
    -webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
input, textarea {
	border: 1px solid #D1D7DB;
	color: #666;
}
input[type=text]:focus, textarea:focus {
	border: solid 1px #B8C2C8;
	background: #EBEFF1;
	color:#333;
}
.elgg-form-register,
.elgg-form-user-requestnewpassword {
	max-width: 450px;
    margin: 0 auto;
}
/***** COMMENTS ******/
.elgg-river-comments-tab {
	display: block;
	background-color: transparent;
	padding: 1px 0;
}
.elgg-river-comments li {
	background: #F5F7F8;
    border: 1px solid #D1D7DB;
	padding: 0 10px;
        
	-webkit-box-shadow: inset 0 0 0 1px #FFFFFF;
    -moz-box-shadow: inset 0 0 0 1px #FFFFFF;
    box-shadow: inset 0 0 0 1px #FFFFFF;
}
.elgg-river-comments li:first-child {
	-webkit-border-radius: 3px 3px 0 0;
	-moz-border-radius: 3px 3px 0 0;
	border-radius: 3px 3px 0 0;
}
.elgg-river-comments li:last-child {
	-webkit-border-radius: 0 0 3px 3px;
	-moz-border-radius: 0 0 3px 3px;
	border-radius: 0 0 3px 3px;
}
.elgg-river-comments .elgg-menu-item-delete {
    border: none;
	padding: 0;
        
	-webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
}
.elgg-river-responses .elgg-list {
	border: none;
}
.elgg-river-responses .elgg-form{
	float: left;
    width: 100%;
    height: auto;
}
.elgg-river-responses .elgg-form .elgg-input-text {
	margin-bottom: 5px;
    margin-right: 10px;
}
.elgg-river-responses .elgg-form .elgg-button {
    margin-left: 0;
}
/* **************************
	GRADIENT
************************** */
.elgg-tabs,
.elgg-menu-filter,
.elgg-module-group > .elgg-head,
.elgg-module-widget > .elgg-head,
.elgg-module-featured > .elgg-head,
.elgg-pagination a, .elgg-pagination span,
#friends_collections_accordian li h2 {
    display: block;
        
	background-color: #EBEFF1; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFFFFF), to(#EBEFF1));
	background-image: -webkit-linear-gradient(top, #FFFFFF, #EBEFF1); 
	background-image:    -moz-linear-gradient(top, #FFFFFF, #EBEFF1);
	background-image:     -ms-linear-gradient(top, #FFFFFF, #EBEFF1);
	background-image:      -o-linear-gradient(top, #FFFFFF, #EBEFF1);
    
    -webkit-box-shadow: inset 0 1px 0 #FFFFFF;
    -moz-box-shadow: inset 0 1px 0 #FFFFFF;
    box-shadow: inset 0 1px 0 #FFFFFF;    
}
.elgg-tabs a:hover,
.elgg-tabs li a:hover,
.elgg-tabs .elgg-state-selected,
.elgg-menu-filter > li > a:hover,
.elgg-menu-filter > .elgg-state-selected,
.elgg-pagination a:hover, .elgg-pagination .elgg-state-selected span,
#friends_collections_accordian li h2:hover {
	background-color: #FFFFFF; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#EEEEEE), to(#FFFFFF));
	background-image: -webkit-linear-gradient(top, #EEEEEE, #FFFFFF); 
	background-image:    -moz-linear-gradient(top, #EEEEEE, #FFFFFF);
	background-image:     -ms-linear-gradient(top, #EEEEEE, #FFFFFF);
	background-image:      -o-linear-gradient(top, #EEEEEE, #FFFFFF);
}
/* **************************
	GROUPS
************************** */
@media (max-width: 640px) {
    .groups-profile-fields {
        float: left;
        padding-left: 0;
    }
}
.groups-profile .elgg-image {
	background: #F5F7F8;
    border: 1px solid #D1D7DB;
	padding: 15px;
    margin-right: 15px;
        
	-webkit-box-shadow: inset 0 0 0 1px #FFFFFF;
    -moz-box-shadow: inset 0 0 0 1px #FFFFFF;
    box-shadow: inset 0 0 0 1px #FFFFFF;
    
    -webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
.groups-stats {
	background: transparent;
	padding: 0;	
    margin-bottom: 10px;
}
.groups-profile-fields .odd,
.groups-profile-fields .even {
	background: transparent;
	padding: 0;
	margin-bottom: 10;
}
#groups-tools > li {
	width: auto;
	float: none;
	margin: 0 0 10px;
}
#groups-tools > li:nth-child(odd) {
	margin-right: 0;
}
.groups-profile-icon img {
    width: 200px;
    height: auto;
}
.elgg-module-group > .elgg-body {
	padding: 15px;
}
/* ***************************************
	ICONS
*************************************** */
.elgg-icon-logout {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/logout.png) no-repeat;
    background-position: 0 0;
	width: 16px;
	height: 17px;
}
.elgg-icon-hover-menu:hover {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/avatar_menu_arrows.png) no-repeat;
    background-position: right bottom;
    width: 100%;
    height: 100%;
}
.elgg-icon-hover-menu {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/avatar_menu_arrows.png) no-repeat;
    background-position: right bottom;
    width: 100%;
    height: 100%;
}
.elgg-icon-nav-btn {
	background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/nav-btn.png) no-repeat;
    background-position: left top;
	width: 44px;
	height: 29px;
}
/* ***************************************
	NAVIGATION
*************************************** */
.elgg-page-topbar {
	display: block;
	position: relative;
    left: 0;
    top: 0;
    width: 100%;
	height: 38px;
    z-index: 100;
    
	background-color: #406D90; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#578CB5), to(#406D90));
	background-image: -webkit-linear-gradient(top, #578CB5, #406D90); 
	background-image:    -moz-linear-gradient(top, #578CB5, #406D90);
	background-image:     -ms-linear-gradient(top, #578CB5, #406D90);
	background-image:      -o-linear-gradient(top, #578CB5, #406D90);
    
    border-bottom: 1px solid #192A37;

    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
}
.elgg-page-topbar > .elgg-inner {
	width: auto;
	margin: 0;
	padding: 0 10px;
}
.elgg-menu-topbar > li > a {
    font-size: 110%;
	color: #eee;
	text-shadow: 0 1px 1px rgba(0,0,0,.5);
	height: auto;    
    padding-top: 0;
}
.elgg-menu-topbar > li > a:hover {
	color: #FFF;
}
.elgg-menu-topbar-alt {
	position: relative;
	right 0;
    top: 8px;
}
.elgg-menu-topbar-alt li.elgg-state-selected > a {
	background-color: transparent;
	color: #FFF;
}
.elgg-menu-topbar-alt > li > a {
	margin: 0 0 0 15px;
}
.elgg-menu-topbar-default > li > a {
	margin: 0 25px 0 0;
}
.elgg-menu-extras,
.elgg-menu-page {
	padding: 0;
    margin: 0 0 15px 0;
	background-color: transparent;    
	border: none;
    
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
.elgg-menu-extras li{
	margin-right: 8px;
}
.elgg-menu-footer-alt,
.elgg-menu-footer-default {
    display: block;
    float: none;
    text-align: center;
}
.elgg-menu-longtext .elgg-menu-item-tinymce-toggler a {
	display: none;
}
.elgg-menu-entity {
	vertical-align: right;
    float: right;    
	height: auto;
}
.elgg-menu-entity li {
	color: #9DB7CD;
	vertical-align: right;
    float: right;    
}
.elgg-menu-river li a,
.elgg-menu-entity li a {
	color: #9DB7CD;
}
.elgg-menu-river li a:hover,
.elgg-menu-entity li a:hover {
    color: #5A8AAA;
}
.elgg-menu-site{
	border: none;
}
.elgg-menu-site li{
	display: none;
}
.elgg-menu-site-default {
    position: absolute; 
    top:50%; 
    height: 24px; 
    margin-top: -4px;
    right: 3px;
}
.elgg-page-header .elgg-menu-site-default select {
    position:absolute; 
    top: 50%; 
    height: 24px; 
    margin-top: -20px;
    right: 3px;
}
.elgg-menu-hover {
	width: 200px;
}
.elgg-breadcrumbs {
	color: #99B9D1;
	font-size: 100%;
    font-weight: normal;
	line-height: 1.4em;
    background: #EAF1F6;
    padding: 10px;
}
.elgg-main .elgg-breadcrumbs {
	margin: -14px -10px 5px -10px;
}
.elgg-breadcrumbs > li > a {
	color: #6193B9;
}
.elgg-breadcrumbs > li > a:hover {
	color: #99B9D1;
    text-decoration: none;
}
.elgg-breadcrumbs > li:after {
	color: #6193B9;
}
.elgg-tabs {
	text-align: center;    
	margin-bottom: 10px;
	width: auto; 
    border: 1px solid #D1D7DB;
    
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
.elgg-tabs li {
	float: none;
    background: transparent;
    display: inline-block;
    vertical-align: top;
    margin: 0;
    border: none;
    padding: 0;
    
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
}
.elgg-tabs li a {
    background: none;
    padding: 7px 16px 8px 16px;
}
.elgg-tabs li:first-child a {
    border-left-width: 1px;
}
.elgg-tabs a {
	color: #4690D6;
    display: block;
    margin: 0 auto;
    padding: 7px 16px 8px 16px;
    text-align: center;
    text-decoration: none;
    width: auto;
    height: auto;

    border-color: #D1D7DB;
    border-style: solid;
    border-width: 0 1px 0 0;
}
.elgg-tabs a:hover,
.elgg-tabs li a:hover {
    color: #6C96B2;
}
.elgg-tabs .elgg-state-selected a {
	top: 0;
    color: #6C96B2;
    background: transparent;
}
.elgg-menu-filter {
	text-align: center;    
	margin-bottom: 10px;
	width: auto;
    border: 1px solid #D1D7DB;
    
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
.elgg-menu-filter > li {
	float: none;
    display: inline-block;
    vertical-align: top;
    border: none;
    background: none;
    margin: 0;
    padding: 0;
    
    -webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
}
.elgg-menu-filter > li:first-child a {
    border-left-width: 1px;
}
.elgg-menu-filter > li:hover {
	background: #dedede;
}
.elgg-menu-filter > li > a {
	color: #4690D6;
	display: block;
	background: transparent;
    margin: 0 auto;
    padding: 7px 16px 8px;
    text-align: center;
    text-decoration: none;
    width: auto;
    height: auto;

    border-color: #D1D7DB;
    border-style: solid;
    border-width: 0 1px 0 0;
}
.elgg-menu-filter > li > a:hover {
    color: #6C96B2;
}
.elgg-menu-filter > .elgg-state-selected > a {
    color: #6C96B2;
    top: 0;
	background: transparent;
}
.elgg-pagination {
	margin: 20px 0;
	display: block;
	text-align: center;
}
.elgg-pagination li {
	margin: 0;
    display: inline-block;
    vertical-align: top;
}
.elgg-pagination li:first-child a,
.elgg-pagination li:first-child span{
    -webkit-border-radius: 3px 0 0 3px;
    -moz-border-radius: 3px 0 0 3px;
    border-radius: 3px 0 0 3px;
    
    border-left-width: 1px;
}
.elgg-pagination li:last-child a,
.elgg-pagination li:last-child span {
    -webkit-border-radius: 0 3px 3px 0;
    -moz-border-radius: 0 3px 3px 0;
    border-radius: 0 3px 3px 0;    
}
.elgg-pagination a, .elgg-pagination span {
    margin: 0 auto;
    padding: 7px 16px 8px;
    text-align: center;
    text-decoration: none;
    width: auto;
    
    border-color: #D1D7DB;
    
    border-style: solid;
    border-width: 1px 1px 1px 0;  
  
    -webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
}
.elgg-pagination a:hover {
    color: #6C96B2;
}
.elgg-pagination .elgg-state-selected span {
	border-color: #CCCCCC;
    color: #6C96B2;
}
.elgg-pagination .elgg-state-disabled span {
	color: #CCCCCC;
	border-color: #CCCCCC;
}
.elgg-menu-widget > li {
	top: 7px;
}
.elgg-menu-widget > .elgg-menu-item-collapse {
	padding-top: 1px;
}
.elgg-menu-widget > .elgg-menu-item-delete {
	right: 15px;
}
.elgg-menu-widget > .elgg-menu-item-settings {
	right: 40px;
}
.elgg-menu-owner-block li a {
	display: block;
	background-color: transparent;
	margin: 5px 0;
	padding: 0;
}
.elgg-menu-owner-block li a:hover {
	background-color: transparent;
    color: #5A8AAA;
}
.elgg-menu-owner-block li.elgg-state-selected > a {
	background-color: transparent;
    color: #5A8AAA;
}
.profile-action-menu li a {
	padding-left: 0;
}
.profile-admin-menu-wrapper a {
	display: block;
	background-color: transparent;
	margin: 5px 0;
	padding: 0;
}
.profile-admin-menu-wrapper {
	background-color: transparent;
}
.profile-admin-menu-wrapper li a {
	background-color: transparent;
	color: red;
	margin-bottom: 0;
}
.profile-admin-menu-wrapper a:hover {
	color: black;
}
/* ***************************************
	HOVER MENU
*************************************** */
.elgg-menu-hover {
	padding: 10px;
	border: 1px solid #999;
	
	-webkit-border-radius: 0 3px 3px 3px;
	-moz-border-radius: 0 3px 3px 3px;
	border-radius: 0 3px 3px 3px;

	-webkit-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
	-moz-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
	box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
}
.elgg-menu-hover > li {
	border-bottom: 1px solid #D1D7DB;
}
.elgg-menu-hover > li a{
	padding: 6px 10px 6px 10px;
}
.elgg-menu-hover a:hover {
	background: #5C8FB6;
    color: #FFF;
}
/* ***************************************
	Modules
*************************************** */
.elgg-module {
	padding: 0;
    margin: 0 0 15px 0;
	background: none;
	border: none;
    
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
.elgg-module > .elgg-head * {
	color: #152129;
}
.elgg-module-index {
	padding: 10px;
	max-width: 450px;
    margin: 0 auto;
}
.elgg-module-index > .elgg-head > h3{
	padding: 20px 0;
	text-align: center;    
}
.elgg-module-popup {
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
}
.elgg-module-info > .elgg-head {
	background: none;
	padding: 5px 0;
	margin-bottom: 10px;
    border-bottom: 1px solid #D1D7DB;
}
.elgg-module-group > .elgg-head,
.elgg-module-widget > .elgg-head,
.elgg-module-featured > .elgg-head {
	height: auto;
    padding: 8px 10px 8px;
    margin-bottom: 0;
    border: 1px solid #D1D7DB;
    
	-webkit-border-radius: 3px 3px 0 0;
	-moz-border-radius: 3px 3px 0 0;
	border-radius: 3px 3px 0 0;
}
.elgg-module-group > .elgg-body,
.elgg-module-widget > .elgg-body,
.elgg-module-featured > .elgg-body {
    border-right: 1px solid #D1D7DB;
    border-bottom: 1px solid #D1D7DB;
    border-left: 1px solid #D1D7DB;
    
	-webkit-border-radius: 0 0 3px 3px;
	-moz-border-radius: 0 0 3px 3px;
	border-radius: 0 0 3px 3px;    
}
.elgg-module-featured > .elgg-head * {
	color: #152129;
}
.elgg-module-featured > .elgg-body {
	padding: 15px;
}
.elgg-module-highlight:hover {
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
/* **************************
	PROFILE
************************** */
.profile .elgg-inner {
	border: none;
}
#profile-owner-block {
	background: #F5F7F8;
    border: 1px solid #D1D7DB;
	width: auto;
    
	-webkit-box-shadow: inset 0 0 0 1px #FFFFFF;
    -moz-box-shadow: inset 0 0 0 1px #FFFFFF;
    box-shadow: inset 0 0 0 1px #FFFFFF;
    
    -webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
#profile-details {
	padding: 0 0 15px 15px;
}
@media (max-width: 640px) {
    #profile-details {
        display: block;
        float: left;
        padding: 15px 0;
    }
}
.profile .elgg-inner {
	margin: 0;
}
#profile-details .odd,
#profile-details .even,
.profile-aboutme-title {
	background-color: transparent;
	padding: 2px 0;
}
.profile-aboutme-contents {
	padding: 2px 0 0 0;
}
/* **************************
	WIDGETS
************************** */
.elgg-col-2of3,
#elgg-widget-col-1,
#elgg-widget-col-2,
#elgg-widget-col-3 {
    width: 100%;
    min-height: 0 !important;
}
.elgg-module-widget {
	background-color: transparent;
	padding: 0 0;
	margin: 0 0 15px;
	position: relative;
}
.elgg-module-widget:hover {
	background-color: transparent;
}
.elgg-module-widget > .elgg-head h3 {
	color: #152129;
	text-align: bottom;
	padding: 0 45px 0 24px;
}
.elgg-module-widget > .elgg-body {
	width: auto;
	background-color: transparent;
	border-top: transparent;    
	overflow: hidden;
}
.elgg-widget-edit {
	width: auto;
	padding: 15px;
	border-bottom: 1px solid #D1D7DB;
	background-color: #f9f9f9;
}
a.elgg-widget-collapse-button {
	padding-left: 10px;
	color: #152129;
}
a.elgg-widget-collapse-button:hover,
a.elgg-widget-collapsed:hover {
	color: #5A8AAA;
}
.elgg-widgets-add-panel {
	background: #DDE7ED;
	border: 1px solid #3C5E74;
}
.elgg-widgets-add-panel li {
	width: 194px;
	background-color: #DDE7ED;
	border: 1px solid #3C5E74;
}
.elgg-widgets-add-panel .elgg-state-available {
	color: #FFF;
	background-color: #5C8FB6;
	cursor: pointer;
}
.elgg-widgets-add-panel .elgg-state-available:hover {
	background-color: #8BADC3;
}
.elgg-widgets-add-panel .elgg-state-unavailable {
	color: #6C96B2;
}
/* ***************************************
	LAYOUT
*************************************** */
.elgg-page-default {
	width: auto;
	min-width: 0;
}
.elgg-page-default .elgg-page-header > .elgg-inner {
	width: auto;
	margin: 0 auto;
	height: 70px;
}
.elgg-page-default .elgg-page-body > .elgg-inner {
	width: auto;
	margin: 0 auto;
}
.elgg-page-default .elgg-page-footer > .elgg-inner {
	width: auto;
	margin: 0 auto;
	padding: 5px 10px;
}
.elgg-page-header {
	position: relative;
    height: 70px;
    margin: 0;
    background: #5C8FB6;
    
}
.elgg-layout-one-sidebar {
	background: #FFF;
	width: 100%;
    float: left;
}
.elgg-layout-two-sidebar {
	background: #FFF;
}
.elgg-layout-one-column {
	background: #FFF;
	width: auto;
	padding: 10px 0;
}
.elgg-main {
	margin: 0;
	padding: 20px 10px;
}
/***** SYSTEM MESSAGES ******/
.elgg-message {
	color: white;
	font-weight: bold;
	display: block;
	padding: 10px;
	cursor: pointer;
	opacity: 0.9;	
    text-align: center;
    
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
}
.elgg-state-success {
	background: #659765;
}
.elgg-state-error {
	background: #FF0000;
}
.elgg-state-notice {
	background: #659765;
}
.elgg-system-messages {
	position: fixed;
	top: 0;
	right: 0;
    width: 100%;
	max-width: 100%;
	z-index: 99999;
}
.elgg-system-messages li {
	margin-top: 0;
}

/***** PAGE FOOTER ******/
.elgg-page-footer {
	position: relative;
    padding-bottom:20px;
}
/***** FRIENDSPICKER OFF ******/
.friends-picker-container h3 {
	font-size: 1.2em !important;
}
/* ***************************************
	TWITTER
*************************************** */
#twitter_widget {
	margin: 0;
}
#twitter_widget li {
	padding: 0 0 10px 0;
	border: none;
    border-bottom: 1px solid #D1D7DB;
}
#twitter_widget li span {
	color: #000;
	background: none;
}
#twitter_widget li > a {
	color: #666;
	font-size: 85%;
	font-style: italic;
	line-height: 1.2em;
}
#twitter_widget li > a:hover {
    color: #5A8AAA; 
}

/* ***************************************
	SIDEBAR
*************************************** */
.elgg-sidebar {
	display: none;
	position: static;
	float: none;
    margin: 0;
}
.elgg-sidebar-alt {
	display: none;
}
#jPanelMenu-menu {
	color: #406D90;
    background: #1E3444;
    border-right: #000;
	padding: 0 10px 40px;
   
    -webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
#jPanelMenu-menu .elgg-button {
    width: 100%;
    
    -webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
#jPanelMenu-menu .elgg-image-block {
	background: transparent;
    border: none;
    
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
#jPanelMenu-menu .elgg-menu-groups-my-status li a,
#jPanelMenu-menu .elgg-menu-page li a,
#jPanelMenu-menu .elgg-menu-owner-block li a {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

	display: block;
    margin: 0 0 5px 0;
	padding: 0.5em 5%;
	text-decoration: none;
    text-shadow: 0 1px 1px #111F29;
	color: #6193B9;
    
	background-color: #182B38; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#1E3444), to(#182B38));
	background-image: -webkit-linear-gradient(top, #1E3444, #182B38); 
	background-image:    -moz-linear-gradient(top, #1E3444, #182B38);
	background-image:     -ms-linear-gradient(top, #1E3444, #182B38);
	background-image:      -o-linear-gradient(top, #1E3444, #182B38);
    
    border-top:1px solid #2B4B61;
	border-bottom:1px solid #0D171F;
    
    -webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
#jPanelMenu-menu .elgg-menu-groups-my-status li.elgg-state-selected > a, #jPanelMenu-menu .elgg-menu-groups-my-status li a:hover,
#jPanelMenu-menu .elgg-menu-page li.elgg-state-selected > a, #jPanelMenu-menu .elgg-menu-page li a:hover,
#jPanelMenu-menu .elgg-menu-owner-block li.elgg-state-selected > a, #jPanelMenu-menu .elgg-menu-owner-block li a:hover {
	color: #99B9D1;
    
	background-color: #20384A; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#2A485E), to(#20384A));
	background-image: -webkit-linear-gradient(top, #2A485E, #20384A); 
	background-image:    -moz-linear-gradient(top, #2A485E, #20384A);
	background-image:     -ms-linear-gradient(top, #2A485E, #20384A);
	background-image:      -o-linear-gradient(top, #2A485E, #20384A);
}
#jPanelMenu-menu .elgg-module-aside .elgg-head {
	border-bottom: 1px solid #111F29;
    padding: 0 0 5px 0;
    margin-bottom: 0;
    background: none;
}
#jPanelMenu-menu .elgg-module-featured {
	border: none;
}
#jPanelMenu-menu .elgg-module-featured > .elgg-body {
    border: none;
    padding: 10px 0;
}
#jPanelMenu-menu .elgg-module > .elgg-head h3 span {
    text-shadow: 0 1px 1px #111F29;
	color: #6193B9;
}
#jPanelMenu-menu .elgg-module-featured > .elgg-head {
    padding: 0 0 5px 0;
	border: none;
	border-bottom: 1px solid #111F29;
    background: none;
    
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;  
}
#jPanelMenu-menu .elgg-module-aside > .elgg-body {
	border-top: 1px solid #2D4D65;
	padding-top: 5px;
}
#jPanelMenu-menu a {
	color: #6193B9;
}
#jPanelMenu-menu a:hover,
#jPanelMenu-menu a.selected {
	color: #99B9D1;
}
#jPanelMenu-menu .elgg-subtext {
	color: #406D90;
}
#jPanelMenu-menu .elgg-list {
	border-top: none;
}
#jPanelMenu-menu .elgg-list > li {
	border-bottom: 1px solid #2D4D65;
}
#jPanelMenu-menu h1, #jPanelMenu-menu h2, #jPanelMenu-menu h3, #jPanelMenu-menu h4, #jPanelMenu-menu h5, #jPanelMenu-menu h6,
#jPanelMenu-menu h1 a, #jPanelMenu-menu h2 a, #jPanelMenu-menu h3 a, #jPanelMenu-menu h4 a, #jPanelMenu-menu h5 a, #jPanelMenu-menu h6 a{
	font-weight: bold;
    text-shadow: 0 1px 1px #000;
	color: #4F87B1;
}
.elgg-topbar-dark {
	width: 260px;
	height: 38px;
    margin-bottom: 20px;
    margin-left: -10px;
    
	background-color: #1E3444; 
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#325772), to(#1E3444));
	background-image: -webkit-linear-gradient(top, #325772, #1E3444); 
	background-image:    -moz-linear-gradient(top, #325772, #1E3444);
	background-image:     -ms-linear-gradient(top, #325772, #1E3444);
	background-image:      -o-linear-gradient(top, #325772, #1E3444);
    
    border-bottom: 1px solid #000;

    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
}
.elgg-open {
	position: relative;
    margin-left: 0;
    top: 5px;
}
#elgg-button-open {
    padding: 0;
}
#jPanelMenu-menu .elgg-topbar-avatar {
	padding: 10px 0 0 10px;
}
#jPanelMenu-menu .elgg-topbar-avatar span {
    margin-left: 10px;
    vertical-align: top;
}
#jPanelMenu-menu .elgg-search-header {    
    margin: 0 0 15px 0;
	height: auto;
	position: relative;
}
#jPanelMenu-menu input[type="text"] {
    background: #223B4C url("<?php echo elgg_get_site_url(); ?>mod/handheld/graphics/search.png") no-repeat 12px 7px;
    border: 0 none;
	color: #6193B9;
    width: 240px;
    padding: 7px 15px 6px 33px;
        
    text-shadow: 0 1px 1px #000;
    font-size: 100%;
	font-weight: bold;
    margin-bottom: 10px;
    
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    
    -webkit-box-shadow: 0 1px 0 rgba(179, 203, 221, 0.2), 0 1px 3px rgba(0, 0, 0, 0.4) inset;
    -moz-box-shadow: 0 1px 0 rgba(179, 203, 221, 0.2), 0 1px 3px rgba(0, 0, 0, 0.4) inset;
    box-shadow: 0 1px 0 rgba(179, 203, 221, 0.2), 0 1px 3px rgba(0, 0, 0, 0.4) inset;
}
#jPanelMenu-menu input[type="text"]:focus {
    background-color: #2A485E;
	color: #99B9D1;
    border: 0 none;
	outline: none; 
}
.elgg-search input[type=submit] {
	color: #FFF;
	font: 14px/100% Arial, Helvetica, sans-serif;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	display: block;
    padding: 8px 28px 9px;
    
    -webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
/* ***************************************
	RETINA DISPLAYS
*****************************************/
@media 
only screen and (-webkit-min-device-pixel-ratio: 2), 
only screen and (min-resolution: 192dpi) {
    #jPanelMenu-menu input[type="text"] {
        background: url("<?php echo elgg_get_site_url(); ?>mod/handheld/graphics/icons/blue/search@2x.png") no-repeat;
    	background-size: 12px 12px;
        background-position: 10px 9px;
    }
    p.visit_twitter a {
        width: 16px;
        height: 16px;
        padding: 0 0 0 24px;
        background:url(<?php echo elgg_get_site_url(); ?>mod/handheld/graphics/icons/blue/twitter@2x.png) left no-repeat;
        background-size: contain;
        background-position: 0 0;
    }
    .elgg-icon-nav-btn {
        width: 44px;
        height: 29px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/nav-btn@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;
    }
    .elgg-logo {
    	background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/logo@2x.png) no-repeat;
    	background-size: 160px 44px;
        background-position: 0 0;
    }
    .elgg-icon-arrow-left {
        width: 16px;
        height: 16px;
        margin: 5px 6px 0;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/arrow_left@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;
    }
    .elgg-icon-arrow-right {
        width: 16px;
        height: 16px;
        margin: 5px 6px 0;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/arrow_right@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;
    }
    .elgg-icon-push-pin-alt {
        width: 16px;
        height: 16px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/pin@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;
    }
    .elgg-icon-grid,
    .elgg-icon-grid:hover{
        width: 16px;
        height: 16px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/grid@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;
    }
    .elgg-icon-list {
        width: 16px;
        height: 16px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/list@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;
    }
    .elgg-icon-tag,
    .elgg-icon-tag:hover {
        width: 16px;
        height: 16px;
        padding-top: 2px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/tag@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;
    }
    .elgg-icon-rss {
        width: 16px;
        height: 16px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/rss@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;        
    }
    .elgg-icon-settings {
        width: 25px;
        height: 25px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/settings@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;   
    }
    .elgg-icon-settings-alt,
    .elgg-icon-settings-alt:hover {
        width: 16px;
        height: 16px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/edit@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;   
    }
    .elgg-icon-delete-alt,
    .elgg-icon-delete-alt:hover,
    .friends_collections_controls .elgg-icon-delete,
    .friends_collections_controls .elgg-icon-delete:hover  {
        width: 16px;
        height: 16px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/circle_remove@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;   
    }
    .elgg-icon-logout {
        width: 24px;
        height: 25px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/logout@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;   
    }
    .elgg-icon-speech-bubble,
    .elgg-icon-speech-bubble:hover {
        width: 18px;
        height: 14px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/chat@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;   
    }
    .elgg-icon-thumbs-up,
    .elgg-icon-thumbs-up:hover {
        width: 16px;
        height: 14px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/thumbs_up@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;   
    }
    .elgg-icon-delete,
    .elgg-icon-delete:hover {
        width: 14px;
        height: 14px;
        background: transparent url(<?php echo elgg_get_site_url();?>mod/handheld/graphics/icons/blue/delete@2x.png) no-repeat;
        background-size: contain;
        background-position: 0 0;   
    }
}
