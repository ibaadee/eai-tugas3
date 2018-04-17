<?php
require_once('nusoap/lib/nusoap.php');
$client = new nusoap_client('https://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php');

$response1 = $client->call('LatLonListZipCode', array("zipCodeList"=>"10001"));
echo "<pre>";
print_r($response1);
echo "</pre>";

$response2 = $client->call('LatLonListCityNames', array("displayLevel"=>1));
echo "<pre>";
print_r($response2);
echo "</pre>";
?>