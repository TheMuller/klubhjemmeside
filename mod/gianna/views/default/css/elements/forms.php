<?php
/**
 * CSS form/input elements
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	Form Elements
*************************************** */
fieldset > div {
    padding: 5px;
	margin-bottom: 15px;
}
fieldset > div:last-child {
	margin-bottom: 0;
}
.elgg-form-alt > fieldset > .elgg-foot {
	border-top: 1px solid #CCCCCC;
	padding: 10px 0;
}
textarea {
	height: 200px;
}
input, textarea {
	font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	font-size: 100%;
	border: 1px solid #B2B2B2;
	background: #F2F2F2;
	color: #666666;
	padding: 5px;
	width: 100%;

	border-radius: 3px;
	
	-webkit-box-sizing:	border-box;
	-moz-box-sizing: 	border-box;
	box-sizing: 		border-box;
}
input[type=text]:focus,
input[type=password]:focus,
textarea:focus {
	border: solid 1px #B2B2B2;
	background: #E5E5E5
	color:#333333;
}
.elgg-longtext-control {
	float: right;
	margin-left: 14px;
	font-size: 80%;
	cursor: pointer;
}
.elgg-input-access {
	margin:5px 0 0 0;
}
input[type="checkbox"],
input[type="radio"] {
	margin:0 3px 0 0;
	padding:0;
	border:none;
	width:auto;
}
.elgg-input-checkboxes.elgg-horizontal li,
.elgg-input-radios.elgg-horizontal li {
	display: inline;
	padding-right: 10px;
}


/* ***************************************
	FRIENDS PICKER
*************************************** */
.friends-picker-main-wrapper {
	margin-bottom: 15px;
}
.friends-picker-container h3 {
	font-size:4em !important;
	text-align: left;
	margin:10px 0 20px !important;
	color:#999 !important;
	background: none !important;
	padding:0 !important;
}
.friends-picker .friends-picker-container .panel ul {
	text-align: left;
	margin: 0;
	padding:0;
}
.friends-picker-wrapper {
	margin: 0;
	padding:0;
	position: relative;
	width: 730px;
}
.friends-picker {
	position: relative;
	overflow: hidden;
	margin: 0;
	padding:0;
	width: 730px;
	height: auto;
	background-color: #DEDEDE;

	border-radius: 8px;
}
.friendspicker-savebuttons {
	background: #FFFFFF;
	margin:0 10px 10px;
	
	border-radius: 8px;	
}
.friends-picker .friends-picker-container { /* long container used to house end-to-end panels. Width is calculated in JS  */
	position: relative;
	left: 0;
	top: 0;
	width: 100%;
	list-style-type: none;
}
.friends-picker .friends-picker-container .panel {
	float:left;
	height: 100%;
	position: relative;
	width: 730px;
	margin: 0;
	padding:0;
}
.friends-picker .friends-picker-container .panel .wrapper {
	margin: 0;
	padding:4px 10px 10px 10px;
	min-height: 230px;
}
.friends-picker-navigation {
	margin: 0 0 10px;
	padding:0 0 10px;
	border-bottom:1px solid #CCCCCC;
}
.friends-picker-navigation ul {
	list-style: none;
	padding-left: 0;
}
.friends-picker-navigation ul li {
	float: left;
	margin:0;
	background: #FFFFFF;
}
.friends-picker-navigation a {
	font-weight: bold;
	text-align: center;
	background: #FFFFFF;
	color: #999999;
	text-decoration: none;
	display: block;
	padding: 0;
	width:20px;

	border-radius: 4px;
}
.tabHasContent {
	background: #FFFFFF;
	color: #333333 !important;
}
.friends-picker-navigation li a:hover {
	background: #333333;
	color: #FFFFFF !important;
}
.friends-picker-navigation li a.current {
	background: #08A7E7;
	color:white !important;
}
.friends-picker-navigation-l, .friends-picker-navigation-r {
	position: absolute;
	top: 46px;
	text-indent: -9000em;
}
.friends-picker-navigation-l a, .friends-picker-navigation-r a {
	display: block;
	height: 40px;
	width: 40px;
}
.friends-picker-navigation-l {
	right: 48px;
	z-index:1;
}
.friends-picker-navigation-r {
	right: 0;
	z-index:1;
}
.friends-picker-navigation-l {
	background: url("<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png") no-repeat left top;
}
.friends-picker-navigation-r {
	background: url("<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png") no-repeat -60px top;
}
.friends-picker-navigation-l:hover {
	background: url("<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png") no-repeat left -44px;
}
.friends-picker-navigation-r:hover {
	background: url("<?php echo elgg_get_site_url(); ?>_graphics/friendspicker.png") no-repeat -60px -44px;
}
.friendspicker-savebuttons .elgg-button-submit,
.friendspicker-savebuttons .elgg-button-cancel {
	margin:5px 20px 5px 5px;
}
.friendspicker-members-table {
	background: #DEDEDE;

	border-radius: 8px;
	
	margin:10px 0 0;
	padding:10px 10px 0;
}

/* ***************************************
	AUTOCOMPLETE
*************************************** */
<?php //autocomplete will expand to fullscreen without max-width ?>
.ui-autocomplete {
	position: absolute;
	cursor: default;
}
.elgg-autocomplete-item .elgg-body {
	max-width: 600px;
}
.ui-autocomplete {
	background-color: #FFFFFF;
	border: 1px solid #CCCCCC;
	overflow: hidden;

	border-radius: 5px;
}
.ui-autocomplete .ui-menu-item {
	padding: 0px 4px;

	border-radius: 5px;
}
.ui-autocomplete .ui-menu-item:hover {
	background-color: #EEEEEE;
}
.ui-autocomplete a:hover {
	text-decoration: none;
	color: #08A7E7;
}

/* ***************************************
	USER PICKER
*************************************** */
.elgg-user-picker-list li:first-child {
	border-top: 1px dotted #CCCCCC;
	margin-top: 5px;
}
.elgg-user-picker-list > li {
	border-bottom: 1px dotted #CCCCCC;
}

/* ***************************************
      DATE PICKER
**************************************** */
.ui-datepicker {
	display: none;

	margin-top: 3px;
	width: 208px;
	background-color: #FFFFFF;
	border: 1px solid #0054A7;

	border-radius: 6px;
	overflow: hidden;

	box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
}
.ui-datepicker-inline {
	box-shadow: none;
}

.ui-datepicker-header {
	position: relative;
	background: #08A7E7;
	color: #FFFFFF;
	padding: 2px 0;
	border-bottom: 1px solid #0054A7;
}
.ui-datepicker-header a {
	color: #FFFFFF;
}
.ui-datepicker-prev, .ui-datepicker-next {
	position: absolute;
	top: 5px;
	cursor: pointer;
}
.ui-datepicker-prev {
	left: 6px;
}
.ui-datepicker-next {
	right: 6px;
}
.ui-datepicker-title {
	line-height: 1.8em;
	margin: 0 30px;
	text-align: center;
	font-weight: bold;
}
.ui-datepicker-calendar {
	margin: 4px;
}
.ui-datepicker th {
	color: #0054A7;
	border: none;
	font-weight: bold;
	padding: 5px 6px;
	text-align: center;
}
.ui-datepicker td {
	padding: 1px;
}
.ui-datepicker td span, .ui-datepicker td a {
	display: block;
	padding: 2px;
	line-height: 1.2em;
	text-align: right;
	text-decoration: none;
}
.ui-datepicker-calendar .ui-state-default {
	border: 1px solid #CCCCCC;
	color: #08A7E7;
	background: #fafafa;
}
.ui-datepicker-calendar .ui-state-hover {
	border: 1px solid #AAAAAA;
	color: #0054A7;
	background: #EEEEEE;
}
.ui-datepicker-calendar .ui-state-active,
.ui-datepicker-calendar .ui-state-active.ui-state-hover {
	font-weight: bold;
	border: 1px solid #0054A7;
	color: #0054A7;
	background: #E4ECF5;
}
