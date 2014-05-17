<?php ?>

.elgg-menu-topbar > li > a{
    padding-bottom: 12px;
}

.elgg-menu-topbar .elgg-child-menu {
    width: 195px;
    border-right: 1px solid #999999;
    border-left: 1px solid #999999;
    border-bottom: 1px solid #999999;
    
    -webkit-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
	-moz-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
	box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
    
	-webkit-border-radius: 0 0 4px 4px;
	-moz-border-radius: 0 0 4px 4px;
	border-radius: 0 0 4px 4px;

	min-width: 100%;
    top: 32px;
    left: -10px;
    position: absolute;
	z-index: 10000;//sachin very imp

}
.elgg-menu-topbar .elgg-child-menu a {
    color: #666666;
    font-weight: none;
    padding: 8px 13px 0px 12px;
    height: 30px;
    white-space: nowrap;
}
.elgg-menu-topbar .elgg-child-menu a:hover {
    text-decoration: none;
    background: none repeat scroll 0% 0% #009900;
    color: #FFF;
}

.elgg-menu-topbar > li > ul {     
	display: none;
	background-color: white;
}
.elgg-menu-topbar > li:hover > ul {
	display: block;
}


.elgg-menu-topbar .elgg-child-menu > li:last-child > a {   
    -webkit-border-radius: 0 0 4px 4px;
	-moz-border-radius: 0 0 4px 4px;
	border-radius: 0 0 4px 4px;   
}