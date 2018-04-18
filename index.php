<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Tugas 3 EAI - Kelompok 3</title>

	<!-- Bootswatch core CSS -->
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<!-- DataTables core CSS -->
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

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
			<a class="navbar-brand" href="#">NOAA National Weather Service</a>
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
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="jumbotron text-center" style="margin-top: 32">
			<h1 class="display-3">Welcome To NOAA National Weather Service</h1>
			<p class="lead">This is a National Oceanic and Atmospheric Administration's National Weather Service</p>
			<hr class="my-4">
			<p>developed by Ibad Rahadian Saladdin, Ihsan Alfarabi, and Widiarto Adiyoso</p>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="card border-primary mb-3">
					<h3 class="card-header">Function 1</h3>
					<div class="card-body">
						<h4 class="card-title">LatLonListZipCode</h4>
						<p class="card-text">Returns a list of latitude and longitude pairs with each pair corresponding to an input zip code.</p>
						<div class="form-group">
							<label for="zip-code">Zip Code</label>
							<input class="form-control" id="zip-code" aria-describedby="zip-code-help" placeholder="Enter US zip code" type="text">
						</div>
						<button id="button-zip-code" class="btn btn-primary">Submit</button>
					</div>
					<div class="card-body">
						<p id="span-zip-code" style="display: none;"></p>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="card border-primary mb-3">
					<h3 class="card-header">Function 2</h3>
					<div class="card-body">
						<h4 class="card-title">LatLonListCityNames</h4>
						<p class="card-text">Returns a list of latitude and longitude pairs paired with the city names they correspond to.</p>
						<div class="form-group">
							<label for="display-level">Display Level</label>
							<select class="custom-select" id="display-level" aria-describedby="display-level-help">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						</div>
						<button id="button-display-level" class="btn btn-primary">Submit</button>
					</div>
					<div class="card-body">
						<table class="table table-hover" id="displayLevelTable">
						</table>
					</div>
				</div>			
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript -->
	<script src="./js/jquery/jquery.min.js"></script>
	<script src="./js/bootstrap.bundle.min.js"></script>

	<!-- DataTables JavaScript -->
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>

	<!-- Custom JavaScript -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#button-zip-code").click(function(){
				let zipCode = $('#zip-code').val();
				$.get("function1.php",{ q: zipCode }, function(data, status){
					let parsed = JSON.parse(data);
					let resultTag = $('#span-zip-code');
					let defaultClass = 'text-center';
					if(typeof parsed === 'object') {
						resultTag.removeClass().addClass(defaultClass + ' text-danger');
						resultTag.text(parsed['detail']);
					} else {
						resultTag.removeClass().addClass(defaultClass + ' text-primary');
						resultTag.text("Latitude,Longitude: " + parsed);
					}
					resultTag.show();
				});
			});
			$("#button-display-level").click(function(){
				let displayLevel = $('#display-level').val();
				$.get("function2.php",{ q: displayLevel }, function(dataAjax, status){
					let data = JSON.parse(dataAjax);
					if ($.fn.DataTable.isDataTable('#displayLevelTable')) {
						$('#displayLevelTable').DataTable().clear().destroy();
					}
					$('#displayLevelTable').DataTable({
						"columns": [{
							"data": "latlon",
							"title": "Latitude,Longitude"
						},{
							"data": "citystate",
							"title": "City,State"
						}],
						"initComplete": function() {
							this.api().rows.add(JSON.stringify(data).slice(2, -2).split('","').map((c)=>({
								"latlon": c.split('":"')[0],
								"citystate": c.split('":"')[1]
							}))).draw();
						}
					});
				});
			});
		});
	</script>
</body>
</html>
