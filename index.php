<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Tugas 3 EAI - Kelompok 3</title>

	<!-- Bootstrap core CSS -->
	<!-- <link href="./css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.0/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-E+ZoPrD9N70Q8SUyx+eufEe3KkDtuORRKqt8koXJ9Uxjm4d37YeaU517lm63QRjM" crossorigin="anonymous">

	<!-- Custom styles for this template -->
	<style>
	body {
		padding-top: 54px;
	}
	@media (min-width: 992px) {
		body {
			padding-top: 56px;
		}
	}
</style>
</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">US Weather Data</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="function1.php">Zip Code</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="function1.php">City Names</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mt-5">Welcome to US Weather </h1>
				<p class="lead">developed by Ibad Rahadian Saladdin, Ihsan Alfarabi, and Widiarto Adiyoso</p>
			</div>
			<?php
			require_once('nusoap/lib/nusoap.php');
			$client = new nusoap_client('https://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php');

			// Bagian untuk memanggil fungsi LatLonListZipCode
			// Parameter yang diberikan merupakan Zip Code dari New York
			// Return value dari fungsi yang dipanggil adalah daftar latitude dan longitude dari New York
			function latLonListZipCode($client, $zip_code_list)
			{
				return $client->call('LatLonListZipCode', array("zipCodeList"=>$zip_code_list));
			}
			print_r(latLonListZipCode($client, "10001"));

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
				return $xml_mapped;
			}
			print_r(latLonListCityNames($client, 1));
			
			?>
		</div>
	</div>

	<!-- Bootstrap core JavaScript -->
	<script src="./js/jquery/jquery.min.js"></script>
	<script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>
