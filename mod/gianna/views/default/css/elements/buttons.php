<?php
/**
 * CSS buttons
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* **************************
	BUTTONS
************************** */
.elgg-button {
	font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	color: #FFFFFF;
	width: auto;
	padding: 6px 10px;
	cursor: pointer;
    border: none;
    background: #333333;

	border-radius:	3px;
}
.elgg-button:hover,
.elgg-button-action:focus {
	background: #666666;
	text-decoration: none;
	color: #FFFFFF;
}
.elgg-button-submit.elgg-state-disabled {
	color: #DEDEDE;
	background: #DEDEDE;
	cursor: default;
}
.elgg-button-cancel {
	background: #FAA51A;
}
.elgg-button-cancel:hover {
	background-color: #E38F07;
}
.elgg-button-delete {
	background: #FF3300;
}
.elgg-button-delete:hover {
	background-color: #D63006;
}
