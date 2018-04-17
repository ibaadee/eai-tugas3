<?php
require_once('nusoap/lib/nusoap.php');
$client = new nusoap_client('https://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php');

// Bagian untuk memanggil fungsi LatLonListZipCode
// Parameter yang diberikan merupakan Zip Code dari New York
// Return value dari fungsi yang dipanggil adalah daftar latitude dan longitude dari New York
$response1 = $client->call('LatLonListZipCode', array("zipCodeList"=>"10001"));
echo "<pre>";
print_r($response1);
echo "</pre>";

// Bagian untuk memanggil fungsi LatLonListCityNames
// Parameter yang diberikan merupakan tingkat kota yang terdapat di US
// Return value dari fungsi yang dipanggil adalah daftar latitude, longitude, dan nama kota pada level tertentu
$response2 = $client->call('LatLonListCityNames', array("displayLevel"=>1));
echo "<pre>";
print_r($response2);
echo "</pre>";
?>