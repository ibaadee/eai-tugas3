<?php

// Menyiapkan nusoap dan membuat koneksi dengan server 
require_once('nusoap/lib/nusoap.php');
$client = new nusoap_client('https://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php');
