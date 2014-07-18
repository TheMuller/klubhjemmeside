<style>
/* table {
	border-bottom: none;
} */

/* visited link */
a:visited {
    color: blue;
}

</style>

<?php
/*Checklist plugin*/

admin_gatekeeper();
include(elgg_get_plugins_path().'checklist/config.php');

foreach($thearray as $key => $cat){

	$content .= "<div style='border:1px solid;background-color: #DADADA;border-radius:5px;'><b><u>".elgg_echo('checklist:'.$key)."</u></b>";
	foreach($cat as $plugin => $values){
	$content .= "<table style='border:1px solid black;width:709px;margin-left:200px;border-bottom: none;'>";
		$count2= count($cat);
		$content .= "<tr><td rowspan='4' width='120px'><b>".elgg_echo('checklist:'.$plugin)."</b><br></td></tr>";
		$content .= "<tr><td  width='80px'><b>".elgg_echo('checklist:info')."</b><br></td><td>".elgg_echo('checklist:'.$plugin.':help')."<br></td></tr>";
		$content .= "<tr><td width='80px'><b>".elgg_echo('checklist:setting')."</b><br></td><td><a color='red' href='".elgg_get_site_url().$values['setting']."'>".$plugin." Setting</a><br></td></tr>";
		$content .= "<tr><td width='80px'><b>".elgg_echo('checklist:help')."</b><br></td><td><a href='".elgg_get_site_url().$values['help']."'>".$plugin." Help</a><br></td></tr>";
	$content .= "</tr>";
	}	
	$content .= "</table></div><br>";
}

?>