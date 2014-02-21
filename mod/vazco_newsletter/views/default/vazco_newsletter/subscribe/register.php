<?php

$cond1 = strpos($_SERVER['REQUEST_URI'],'account/register.php')!==false;
$cond2 = strpos($_SERVER['REQUEST_URI'],'pg/register')!==false;

if ($cond1 || $cond2)
{
	echo elgg_view('input/checkboxes' , array('internalname' => 'newsletter', 'options' => array(elgg_echo('vazco_newsletter:register') => '1'),'value'=>1));
}
?>