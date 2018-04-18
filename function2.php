<?php

require_once 'client.php';

/**
* Bagian untuk memanggil fungsi LatLonListCityNames.
* Hasil pemanggilan fungsi dijadikan SimpleXMLElement menghasilkan
* 	object daftar latitude longitude dan kota beserta negara bagiannya
*	yang kemudian dimasukkan ke dalam array.
* Array tersebut dimasukkan lagi ke dalam array yang kemudian dipetakan
*	menjadi associative array pasangan latitude longitude dengan kota
*	beserta negar bagiannya.
* Array pemetaan tersebut kemudian diencode menjadi string JSON untuk
*	diproses lebih lanjut.
*
* @param {nusoap_client} client - Client nusoap yang sedang diconsume.
* @param {String} display_level - Tingkat kota yang terdapat di US.
* @return {String} list_lan_lon_out - Daftar latitude, longitude, nama kota, dan negara bagiannya pada level tertentu.
*/
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

// Menerima request GET untuk AJAX
if (isset($_GET['q'])) {
	echo latLonListCityNames($client, $_GET['q']);
}
