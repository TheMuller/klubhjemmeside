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
	$content .= "<table border='1' style='border:1px solid black;width:710px;margin-left:50px;'>";
		$count2= count($cat);
		$content .= "<tr><td width='120px'><b>".elgg_echo('checklist:'.$plugin)."</b><br></td><td rowspan='2' width='590px'>".elgg_echo('checklist:'.$plugin.':help')."</td></tr>";
		$content .= "<tr><td width='80px'><br><a color='red' href='".elgg_get_site_url().$values['setting']."'>".elgg_echo('checklist:setting')."</a><br></td></tr>";
		$content .= "<tr><td><br></td><td><b>".elgg_echo('checklist:help')."</b><br><a href='http://klubhjemmeside.dk/".$values['help']."'>".$plugin."</a><br></td></tr>";
	}
	$content .= "</table></div><br>";
}

?>