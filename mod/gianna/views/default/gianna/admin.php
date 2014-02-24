<?php
/**
 *
 * Options Panel CSS
 *
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
.settings-optionspanel .elgg-input-text,
.settings-optionspanel .elgg-input-dropdown{
	float: right;
}
.settings-optionspanel .elgg-input-text {
    margin-bottom: 15px;
}
.elggzone-holder{
	background-color: #EEEEEE;
	border: 2px solid #FFFFFF;
	margin: 20px;
	
	color: #333333;
	padding:30px;
}
.elggzone-options-panel {
	background-color: #333;
	border: 1px solid #444;
	margin-top: 15px;
	width: 100%;
}
.elggzone-options-panel .item {
	border-bottom: 1px solid #C0C0C0;
	padding: 10px 0;
}
.elggzone-options-panel .elgg-button {
	font-size: 14px;
	font-weight: normal;
	text-decoration: none;
    float: left;

	border-radius: 3px;

	width: auto;
	padding: 6px 10px;
	cursor: pointer;
}
.settings-optionspanel .no {
	border: 1px solid #CCC;
	background: none;
}
.settings-optionspanel .active {
	border: 1px solid #B4C25C;
	background: #F5F7E9;
}
.settings-optionspanel #target {
	padding: 10px;
    height: auto;
}
/* ***************************************
	TABS
*****************************************/
.ez-background {
	position: absolute;
    right: 120px;
    bottom: 7px;
}
.elggzone-loader {
	display: block;
	background: transparent url(<?php echo elgg_get_site_url(); ?>mod/gianna/graphics/loader.gif) no-repeat 0 0;
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
/* ***************************************
	MULTISELECT
*****************************************/
.ui-multiselect {
	padding:2px 0 2px 4px;
	text-align:left;
    float: right;
    width: 200px !important;
    background: transparent;
    border: 1px solid #CCC;
}
.ui-multiselect-menu {
	border: 1px solid #dddddd;
	background: #eeeeee;
	color: #333333;
	display:none;
	padding: 3px;
	position:absolute;
	z-index:10000;
	text-align: left;
}
.ui-multiselect-menu .ui-multiselect-checkboxes {
	position:relative /* fixes bug in IE6/7 */;
	overflow-y:scroll
}
.ui-multiselect-menu .ui-multiselect-checkboxes label {
	cursor:default;
	display:block;
	border:1px solid transparent;
	padding:3px 1px;
}
.ui-multiselect-menu .ui-multiselect-checkboxes label input {
	position:relative;
	top: 2px;
    margin-right: 10px;
}
.ui-multiselect-menu .ui-multiselect-checkboxes li {
	clear:both;
	font-size:0.9em;
	padding-right:3px;
}
.ui-multiselect-menu .ui-multiselect-checkboxes li label:hover {
	background: #DCDCDC;
    cursor: pointer;
}
* html .ui-multiselect-checkboxes label {
	border:none;
}
.ui-multiselect-menu .ui-widget-content a {
	color: #333333;
}
.ui-multiselect-menu .ui-widget-header {	
	color: #FFF;
	border: 1px solid #999;
    height: 16px;
    padding: 5px;
	background: #3399FF;
}
.ui-multiselect-menu .ui-multiselect-header ul li {
	float:left;
	padding:0 10px 0 0;
}
.ui-multiselect-menu .ui-multiselect-header ul li a {
	color: #FFF;
}
.ui-multiselect > span.ui-icon {
	width: 0; 
	height: 0; 
	border-left: 4px solid transparent;
	border-right: 4px solid transparent;	
	border-top: 4px solid #000; 
    margin: 5px 1px 0 0;
	float: right; 
}
