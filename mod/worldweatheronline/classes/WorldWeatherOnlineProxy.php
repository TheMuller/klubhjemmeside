<?php
class WorldWeatherOnlineProxy
{
	protected $key;
	
	public function __construct($apiKey)
	{
		$this->key = $apiKey;
	}
	
	protected function createRequestUrl($location, $numDays)
	{
		$addressPattern = "http://free.worldweatheronline.com/feed/weather.ashx?q=%s&num_of_days=%s&key=%s";
		return sprintf($addressPattern, urlencode($location), $numDays, $this->key);
	} 
	
	public function getItems($location, $numDays)
	{
		$address = $this->createRequestUrl($location, $numDays);		
		$xml_string = file_get_contents($address, FALSE);
		$xml = new SimplexmlElement($xml_string);

		$items = array();
		foreach($xml->weather as $itemXML)
		{
			$items[] = new WeatherItem($itemXML);
		}
		return $items;
	}
}