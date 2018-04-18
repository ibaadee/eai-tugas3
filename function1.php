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
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="function1.php">Zip Code
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="function2.php">City Names</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mt-5">LatLonListZipCode</h1>
				<p class="lead">Complete with pre-defined file paths and responsive navigation!</p>
				<ul class="list-unstyled">
					<li>Bootstrap 4.0.0</li>
					<li>jQuery 3.3.0</li>
				</ul>
				<?php
					require_once('nusoap/lib/nusoap.php');
					$client = new nusoap_client('https://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php');
					
					echo "<b>Zipcode Number</b> ".$_GET['zipcode'];

					// Bagian untuk memanggil fungsi LatLonListZipCode
					// Parameter yang diberikan merupakan Zip Code dari New York
					// Return value dari fungsi yang dipanggil adalah daftar latitude dan longitude dari New York
					$response1 = $client->call('LatLonListZipCode', array("zipCodeList"=>$_GET['zipcode']));
					echo "<pre><b>Logitude, Latitude </b>";
					print_r($response1);
					echo "</pre>";
				?>
			</div>

		</div>
	</div>

	<!-- Bootstrap core JavaScript -->
	<script src="./js/jquery/jquery.min.js"></script>
	<script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>
