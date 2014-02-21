<?php
class WeatherItem
{
	protected $xml;
	
	public function __construct($xml)
	{
		$this->xml = $xml;
	}

	public function display($temperatureFormat)
	{
		if($temperatureFormat == "Fahrenheit")
		{
			$lowTemperature = $this->getXMLValue("tempMinF");
			$hiTemperature = $this->getXMLValue("tempMaxF");
		}
		else
			{
				$lowTemperature = $this->getXMLValue("tempMinC");
				$hiTemperature = $this->getXMLValue("tempMaxC");
			}
			
		$date = new DateTime($this->getXMLValue('date'));
		$image = $this->getXMLValue('weatherIconUrl');
		$description = $this->getXMLValue('weatherDesc');

		echo '<span class="filler"></span>';
		echo '<div class="weatherIcon">';
		echo $this->formatDate($date) . '<br/>';
		echo '<img title="' . $description . '" src="' . $image . '"/><br/>';
		echo elgg_echo('worldweatheronline:widget:Min') . $this->formatTemperature($lowTemperature, $temperatureFormat) . '<br/>';
		echo elgg_echo('worldweatheronline:widget:Max') . $this->formatTemperature($hiTemperature, $temperatureFormat) . '<br/>';
		echo '</div>';
	}


	protected function getXMLValue($field)
	{
		return $this->xml->$field;
	}
	
	protected function formatDate($date)
	{
		$name = $date->format('l');
		return elgg_echo('worldweatheronline:widget:' . $name);
	}

	protected function formatTemperature($value, $temperatureFormat)
	{
		$indicator = elgg_echo('worldweatheronline:widget:Short' . $temperatureFormat);
		return $value . '&deg;' . $indicator;
	}
}