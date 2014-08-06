<?php

/**
 *  Options Panel CSS
 */

?>

/* ***************************************
	SETTINGS
*****************************************/
.disabled{
	color: red;
}
.panel-header {
	padding-bottom: 10px;
    margin-bottom: 4px;
    font-size: 18px;
}
.panel-line {
	height:1px;
    width: 100%;
	background:#CCC;
	border-bottom:1px solid #FFF;
	overflow:hidden;
}
.settings-optionspanel{
    min-height: 260px;
    padding: 20px 0 0;
}
.settings-optionspanel .elgg-markdown h1 {
	font-size: 1.2em;
	margin: 1em 0 0;
}
.settings-optionspanel .label{
	font-size: 1.2em;
    font-weight: bold;
}
.settings-optionspanel .elgg-input-dropdown{
	float: right;
}
.settings-optionspanel .elgg-input-text {
	margin: 2px 0 15px 0;
	padding: 7px 5px;
}
.elggzone-holder{
	background-color: #EEEEEE;
	border: 2px solid #FFFFFF;
	margin: 20px;
	
	color: #333333;
	padding:30px;
}
.elggzone-content {
	background-color: #333;
	border: 1px solid #444;
	margin-top: 15px;
	width: 100%;
}
.elggzone-content .item {
	border-bottom: 1px solid #C0C0C0;
	padding: 10px 0;
}
.elggzone-content .elgg-button {
	font-size: 14px;
	font-weight: normal;
	text-decoration: none;
    float: left;

	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;

	width: auto;
	padding: 6px 10px;
	cursor: pointer;
}
/* ***************************************
	TABS
*****************************************/
.elggzone-loader {
	display: block;
	background: transparent url(<?php echo elgg_get_site_url(); ?>mod/handheld/graphics/loader.gif) no-repeat 0 0;
	width: 31px;
	height: 31px;
}
.ez-result {
	display: inline-block;
    float: left;
    margin-left: 20px;
}
#elggzone-tabs .ui-tabs-nav {
    margin-bottom: 20px;
	border-bottom: 1px solid #ccc;
	display: table;
	width: 100%;    
}
#elggzone-tabs .ui-tabs-nav li {
	float: left;
	border: 1px solid #CCCCCC;
	border-bottom-width: 0;
	margin: 0 2px 0 0;    
    background: #dedede;
    background-image: linear-gradient(to bottom, #FFFFFF, #dedede);
    
    -webkit-border-radius: 3px 3px 0 0;
	-moz-border-radius: 3px 3px 0 0;
	border-radius: 3px 3px 0 0;
}
#elggzone-tabs .ui-tabs-nav a {
	text-decoration: none;
	display: block;
	padding: 6px 20px 2px;
	text-align: center;
	height: 23px;
	color: #777;
}
#elggzone-tabs .ui-tabs-nav a:hover {
	background: #EEEEEE;
	color: #333;
}
#elggzone-tabs .ui-tabs-nav .ui-tabs-selected {
	border-color: #CCCCCC;
	background: #FFFFFF;

}
#elggzone-tabs .ui-tabs-nav .ui-tabs-selected a {
	color: #333;
	position: relative;
	top: 2px;
    
	background: #EEEEEE;
    background-image: linear-gradient(to bottom, #FFFFFF, #EEEEEE);
}
#elggzone-tabs .ui-tabs-hide {
	display: none !important;
}
#elggzone-tabs .ui-tabs-panel {
	display: block;
}
#elggzone-tabs .ui-tabs-panel > div {
	display: block;
    margin: 0 0 15px;
}

