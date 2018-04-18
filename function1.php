<?php

require_once 'client.php';

/**
* Bagian untuk memanggil fungsi LatLonListZipCode
*
* @param {nusoap_client} client - Client nusoap yang sedang diconsume.
* @param {String} zip_code_list - Parameter yang diberikan merupakan Zip Code di Amerika Serikat.
* @return {String} lat_lon - Latitude dan longitude dari Zip Code yang diberikan.
*/
function latLonListZipCode($client, $zip_code_list)
{
	$result = $client->call('LatLonListZipCode', array("zipCodeList"=>$zip_code_list));
	return strip_tags(json_encode($result));
}

// Menerima request GET untuk AJAX
if (isset($_GET['q'])) {
	echo latLonListZipCode($client, $_GET['q']);
}
