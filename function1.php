<?php

require_once 'client.php';

// Bagian untuk memanggil fungsi LatLonListZipCode
// Parameter yang diberikan merupakan Zip Code dari New York
// Return value dari fungsi yang dipanggil adalah daftar latitude dan longitude dari New York
function latLonListZipCode($client, $zip_code_list)
{
	$result = $client->call('LatLonListZipCode', array("zipCodeList"=>$zip_code_list));
	return strip_tags(json_encode($result));
}

if (isset($_GET['q'])) {
	echo latLonListZipCode($client, $_GET['q']);
}
