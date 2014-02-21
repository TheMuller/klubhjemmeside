<?php
/**
* Elgg text input
* Displays a text input field
*
* @package Elgg
* @subpackage Core
*
* @uses $vars['class'] Additional CSS class
**/
if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-text {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-text";
}
////////////////////////////////////////////////////////////////////////////////////////////////////
for($i = 1; $i <=5; $i++){
	//:DC:
	$type_var = 'ticket_option_type_' . $i;
	$amount_var = 'ticket_option_amount_' . $i;
	$spots_var = 'ticket_option_spots_' . $i;
	$spots_max_var = 'ticket_option_spots_max_' . $i;
	$type_value = $vars['entity']->$type_var;
	$amount_value = $vars['entity']->$amount_var;
	$spots_value = $vars['entity']->$spots_var;
	$spots_max_value = $vars['entity']->$spots_max_var;
	?>	
	<div class="ticket_option">
		<!--TYPE--><label><?php echo elgg_echo('event_calendar:ticket:type');?></label>
			<input type="text" class="ticket_option_type" 
			name="ticket_option_type_<?php echo $i; ?>" value="<?php echo $type_value; ?>"
			/>
		<!--COST--><label>
		<?php
		////////////////////////////////////////////////////////////////////////////////
		$CurrOptions=array(	//:DC:
		'DKK'=>'DKK',
		/**	'Europe EUR Euro'=>' EUR € ',
		'USD United States Dollar'=>' USD $ ',
		'Pound Sterling GBP Pound Sterling'=>' GBP £',
		'Australia AUD Australian Dollar'=>' AUD $ ',
		'Japan JPY Japanese '=>' Yen ¥ ',
		'Canada CAD Canadian Dollar'=>' CAD $ ',
		'Dominican Republic DOP Dominican Peso'=>' DOP $ ',
		'Fiji FJD Fijian Dollar'=>' FJD $ ',
		'Hong Kong HKD Hong Kong Dollar'=>' HKD $ ',
		'India INR Indian Rupee'=>' INR <strike>R</strike>s ',
		'New Zealand NZD New Zealand Dollar'=>' NZ $ ',
		'Poland PLN Polish zloty'=>' PLN zl ',
		'South Africa ZAR South African Rand'=>' ZAR R ',
		'Zimbabwe ZWL Zimbabwean Dollar'=>' ZWL $ ',	**/
		);
		if(!$event_calendar_currency)	//:DC:
			$event_calendar_currency='DKK';//:DC: ?DEFAULT?
		$event_calendar_currency = elgg_get_plugin_setting('currency', 'event_calendar');	//:DC:
		$CurrOptionsText=$CurrOptions[$event_calendar_currency];	//:DC:
		?>
		<?php
			//echo elgg_echo('event_calendar:ticket:amount');	//:DC:
			echo elgg_echo('Cost ');	//:DC:
			echo trim($CurrOptionsText);	//:DC:
			echo elgg_echo(' ');	//:DC:
			?></label>
		<!--AMNT-->
			<?php
			$AmtDisp=$amount_value;	//:DC:
			if(!$AmtDisp||$AmtDisp<=0)//:DC:DBG:TST
				$AmtDisp='';//:DC:DBG:TST
			else
			{
			//$AmtDisp=$amount_value+1500;//:DC:DBG:TST
			$AmtDisp=number_format($AmtDisp,2,',','.');	//:DC:
			}
			?>
		<!----><input type="text" class="ticket_option_amount" 
			name="ticket_option_amount_<?php echo $i; ?>" value="<?php echo $AmtDisp; ?>"
			/>
		<!--SPOT--><label><?php echo elgg_echo('event_calendar:ticket:spots');?></label>
			<input type="text" class="ticket_option_spots" 
			name="ticket_option_spots_<?php echo $i; ?>" value="<?php echo $spots_value; ?>"
			/>
		<!--SMAX--><label><?php echo elgg_echo('event_calendar:ticket:spots:max');?></label>
			<input type="text" class="ticket_option_spots_max" 
			name="ticket_option_spots_max_<?php echo $i; ?>" value="<?php echo $spots_max_value; ?>"
			/>
	</div>
	<?php
}
////////////////////////////////////////////////////////////////////////////////////////////////////
?>