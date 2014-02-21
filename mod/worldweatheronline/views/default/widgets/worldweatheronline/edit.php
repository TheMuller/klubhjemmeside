<p> 
<?php 
	echo elgg_echo('worldweatheronline:widget:location');
    echo elgg_view('input/text', array(
    									'name' => 'params[location]', 
                                        'value' => $vars['entity']->location
    									)); 
?>
</p>

<p>
<?php
	echo elgg_echo('worldweatheronline:widget:temperature_format');
    echo elgg_view('input/dropdown',array(
											'name' => 'params[temperatureFormat]', 
											'options_values' => array(
																		'Fahrenheit' => elgg_echo('worldweatheronline:widget:Fahrenheit'),
																		'Celsius' => elgg_echo('worldweatheronline:widget:Celsius')
																		),
											'value' => $vars['entity']->temperatureFormat
    										));
?>
</p>

<p>
<?php
	echo elgg_echo('worldweatheronline:widget:number_of_days');
    echo elgg_view('input/dropdown',array(
											'name' => 'params[numberOfDays]', 
											'options_values' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5),
											'value' => $vars['entity']->numberOfDays
											));
?>
</p>