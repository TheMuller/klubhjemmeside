<?php
/**
 * Elgg Profile CSS
 * 
 * @package Profile
 */
?>
/* ***************************************
	Profile
*************************************** */
.profile {
	float: left;
	margin-bottom: 15px;
}
.profile .elgg-inner {
	margin: 0 10px;
}
#profile-details {
	padding: 20px;
	background: #F5F5F5;
	border: 1px solid #DCDCDC; /* Fallback */	
    border: 1px solid rgba(0, 0, 0, 0.1);

	box-shadow: inset 0 0 1px #FFFFFF;
}
#profile-details .wire-status {
	padding: 10px 0;
}
#profile-details .elgg-border-plain {
	border-color: #DCDCDC; /* Fallback */
    border-color: rgba(0, 0, 0, 0.1);
    border-style: solid;
    border-width: 1px 0;
}
/*** ownerblock ***/
#profile-owner-block {
	width: 200px;
	float: left;
	margin-right: 20px;
}
#profile-owner-block .large {
	margin-bottom: 10px;
}
#profile-owner-block a.elgg-button-action {
	margin-bottom: 4px;
	display: table;
}
.profile-content-menu a {
	display: block;
	padding: 5px 0;
}
.profile-content-menu a:hover {
	text-decoration: none;
}
.profile-admin-menu {
	display: none;
}
.profile-admin-menu-wrapper a {
	display: block;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 0;
}
.profile-admin-menu-wrapper li a {
	color: red;
	margin-bottom: 0;
}
.profile-admin-menu-wrapper a:hover {
	color: #000000;
}
/*** profile details ***/
#profile-details .odd {
	margin: 0 0 10px;
}
#profile-details .even {
	margin: 0 0 10px;
}
.profile-aboutme-title {
	margin: 0;
}
.profile-aboutme-contents {
	padding: 2px 0 0 0;
}
.profile-banned-user {
	border: 2px solid red;
	padding: 4px 0;
}
