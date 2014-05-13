<?php ?>


.elgg-menu-topbar .elgg-child-menu {
	
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
    left: -1px;
    position: absolute;
	z-index: 10000;//sachin very imp

}
.elgg-menu-topbar .elgg-child-menu a {
 	background-color: Gainsboro ;
    color: #555555;
    height: 20px;
    padding: 3px 9px 0;
    white-space: nowrap;
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

.elgg-menu-topbar .elgg-child-menu a:hover {
	text-decoration: none;
	background: blue;
	color: white;
}
