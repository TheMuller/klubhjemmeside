/* ***************************************
	Modules
*************************************** */
.elgg-module {
	margin-bottom: 20px;
    background-color: #FFFFFF;
}
.elgg-module .elgg-head {
	padding: 10px;
	margin-bottom: 10px;
}
.elgg-module > .elgg-head * {
	color: #000000;
}
.elgg-module-info .elgg-head {
    border-bottom: 4px solid #222222;
}
.elgg-module .elgg-gallery {
	padding: 20px 0;
}
.elgg-module .elgg-list-river {
	border-top: none;
}
.elgg-module .elgg-list-river > li:last-child {
	border-bottom: none;
}

/* Popup */
.elgg-module-popup {
	background-color: #FFFFFF;
	border: 1px solid #CCCCCC;
	
	z-index: 9999;
	margin-bottom: 0;
	padding: 10px;

	border-radius: 3px;

	box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
}
.elgg-module-popup > .elgg-head {
	margin-bottom: 5px;
}
.elgg-module-popup > .elgg-head * {
	color: #0054A7;
}

/* Dropdown */
.elgg-module-dropdown {
	background-color:#FFFFFF;
	border:5px solid #CCCCCC;

	border-radius: 5px 0 5px 5px;
	
	display:none;
	
	width: 210px;
	padding: 12px;
	margin-right: 0px;
	z-index:100;

	box-shadow: 0 3px 3px rgba(0, 0, 0, 0.45);
	
	position:absolute;
	right: 0px;
	top: 100%;
}
/* ***************************************
	SIDEBAR MODULES
*************************************** */
.elgg-sidebar .elgg-module .elgg-gallery {
	padding: 0;
}
.elgg-sidebar .elgg-module {
	margin: 0;
	border-bottom: 1px solid #E5E5E5; /* Fallback */
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
	background: #FFFFFF;
}
.elgg-sidebar .elgg-module .elgg-head {
	padding: 20px;
	margin: 0;
	background: #F5F5F5;
	border-bottom: 1px solid #E5E5E5; /* Fallback */
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);

	box-shadow: inset 0 0 1px #FFFFFF;
}
.elgg-sidebar .elgg-module > .elgg-body {
	padding: 20px;
	border-top: 1px solid #FFF;
    background-color: #FFFFFF;    
}
.elgg-sidebar .elgg-module .elgg-list {
	margin: 0;
}
.elgg-sidebar .elgg-module-latest-groups > .elgg-body {
	padding: 10px 20px 20px 20px;
	border-top: 1px solid #FFF;
}
.elgg-sidebar .elgg-module-menu > .elgg-body {
	padding: 15px 20px;
}

/* ***************************************
	Widgets
*************************************** */
.elgg-widgets {
	float: right;
	min-height: 30px;
}
.elgg-widget-add-control {
	text-align: right;
	margin: 5px 0 15px;
}
.elgg-widgets-add-panel {
	padding: 10px;
	margin: 0 5px 15px;
	background: #DEDEDE;
	border: 1px solid #CCCCCC;
}
.elgg-widgets-add-panel li {
	float: left;
	margin: 2px 10px;
	width: 200px;
	padding: 4px;
	background-color: #CCCCCC;
	border: 1px solid #B0B0B0;
	font-weight: bold;
}
.elgg-widgets-add-panel li a {
	display: block;
}
.elgg-widgets-add-panel .elgg-state-available {
	color: #333333;
	cursor: pointer;
}
.elgg-widgets-add-panel .elgg-state-available:hover {
	background-color: #BCBCBC;
}
.elgg-widgets-add-panel .elgg-state-unavailable {
	color: #888;
}
.elgg-module-group,
.elgg-module-widget {
	margin: 0 5px 15px;
	position: relative;
	border: 1px solid #E5E5E5; /* Fallback */	
	border: 1px solid rgba(0, 0, 0, 0.1);
	background: #FFFFFF;
}
.elgg-module-group {
	margin: 0 0 15px;
}
.elgg-module-group .elgg-head,
.elgg-module-widget .elgg-head {
	padding: 20px;
	margin: 0;
	background: #F5F5F5;
	border-bottom: 1px solid #E5E5E5; /* Fallback */
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);

	box-shadow: inset 0 0 1px #FFFFFF;
}
.elgg-module-widget > .elgg-head:hover {
	background-color: #EEEEEE;
}
.elgg-module-widget > .elgg-head h3 {
	float: left;
	padding: 0 45px 0 16px;
}
.elgg-module-group > .elgg-body,
.elgg-module-widget > .elgg-body {
	padding: 10px 20px 20px;
	border-top: 1px solid #FFF;
}
.elgg-module-widget > .elgg-body {
	overflow: hidden;
}
.elgg-module-widget.elgg-state-draggable .elgg-widget-handle {
	cursor: move;
}
a.elgg-widget-collapse-button {
	color: #c5c5c5;
}
a.elgg-widget-collapse-button:hover,
a.elgg-widget-collapsed:hover {
	color: #9d9d9d;
	text-decoration: none;
}
a.elgg-widget-collapse-button:before {
	content: "\25BC";
}
a.elgg-widget-collapsed:before {
	content: "\25BA";
}
.elgg-widget-edit {
	display: none;
	width: 96%;
	padding: 20px;
	border-bottom: 1px solid #DEDEDE;
	background-color: #F9F9F9;
}
.elgg-widget-content {
	padding: 0;
}
.elgg-widget-placeholder {
	border: 1px dashed #DEDEDE;
	margin-bottom: 15px;
}