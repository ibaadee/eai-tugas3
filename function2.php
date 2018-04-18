<?php

require_once 'client.php';

// Bagian untuk memanggil fungsi LatLonListCityNames
// Parameter yang diberikan merupakan tingkat kota yang terdapat di US
// Return value dari fungsi yang dipanggil adalah daftar latitude, longitude, dan nama kota pada level tertentu
function latLonListCityNames($client, $display_level)
{
	$response = $client->call('LatLonListCityNames', array("displayLevel"=>$display_level));
	$xml = new SimpleXMLElement($response);

	$xml_arr = array();
	foreach($xml->children() as $child)
	{
		$xml_arr[$child->getName()] = sprintf("%s", $child); 
	}

	$xml_mapped = array_combine(explode(" ", $xml_arr['latLonList']), explode("|", $xml_arr['cityNameList']));
	$xml_encoded = json_encode($xml_mapped);
	return $xml_encoded;
}

if (isset($_GET['q'])) {
	echo latLonListCityNames($client, $_GET['q']);
}
