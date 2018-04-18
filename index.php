<html lang="en">
<head>
	<!-- Metadata halaman web -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Tugas 3 EAI: NOAA SOAP - Kelompok 3">
	<meta name="author" content="Ibad Rahadian Saladdin, Ihsan Alfarabi, and Widiarto Adiyoso">

	<!-- Memberi title halaman web -->
	<title>Tugas 3 EAI - Kelompok 3</title>

	<!-- Bootswatch core CSS -->
	<!-- Menyiapkan CSS Bootstrap untuk halaman web ini -->
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	
	<!-- DataTables core CSS -->
	<!-- Menyiapkan CSS DataTables untuk halaman web ini -->
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

	<!-- Custom styles for this template -->
	<!-- Menyiapkan custom styling untuk halaman web ini -->
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
	<!-- Berisi implementasi Navigation Bar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">NOAA National Weather Service</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tutorial/rest.php">Tutorial REST
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tutorial/client.php">Tutorial SOAP - Client
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tutorial/server.php">Tutorial SOAP - Server
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<!-- Berisi implementasi Card Container Function 1 dan 2 -->
	<div class="container">
		<div class="jumbotron text-center" style="margin-top: 32">
			<h1 class="display-3">Welcome To NOAA National Weather Service</h1>
			<p class="lead">This is a National Oceanic and Atmospheric Administration's National Weather Service</p>
			<hr class="my-4">
			<p>© 2018 Ibad Rahadian Saladdin, Ihsan Alfarabi, and Widiarto Adiyoso</p>
		</div>
		<div class="row">
		
			<!-- Card Container Function 1 -->
			<div class="col-md-12">
				<div class="card border-primary mb-3">
					<h3 class="card-header">Function 1</h3>
					<div class="card-body">
						<h4 class="card-title">LatLonListZipCode</h4>
						<p class="card-text">Returns a list of latitude and longitude pairs with each pair corresponding to an input of zip code in USA.</p>
						<div class="form-group">
						
							<!-- Input field untuk memasukkan zip code yang terdapat di USA -->
							<label for="zip-code">Zip Code</label>
							<input class="form-control" id="zip-code" aria-describedby="zip-code-help" placeholder="Enter US zip code" type="text">
						
						</div>
						<button id="button-zip-code" class="btn btn-primary">Submit</button>
					</div>
					<div class="card-body">
						<p id="p-zip-code"></p>
					</div>
				</div>
			</div>
			
			<!-- Card Container Function 2 -->
			<div class="col-md-12">
				<div class="card border-primary mb-3">
					<h3 class="card-header">Function 2</h3>
					<div class="card-body">
						<h4 class="card-title">LatLonListCityNames</h4>
						<p class="card-text">Returns a list of latitude and longitude pairs paired with the city names they correspond to an input of the display level of cities in USA.</p>
						<div class="form-group">
						
							<!-- Berisi daftar tingkat kota di USA -->
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
	<!-- Menyiapkan JQuery dan Boostrap -->
	<script src="./js/jquery/jquery.min.js"></script>
	<script src="./js/bootstrap.bundle.min.js"></script>

	<!-- DataTables JavaScript -->
	<!-- Menyiapkan JS DataTables -->
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>

	<!-- Custom JavaScript -->
	<!-- AJAX untuk mengolah Function 1 dan 2 -->
	<!-- Diintegrasikan dengan Card Container Function 1 dan 2 untuk memberikan dynamic output -->
	<script type="text/javascript">
		$(document).ready(function(){
		  /**
		   * Trigger button AJAX untuk Function 1
		   *
		   * @param {HTML Tag} button - ID dari button HTML Tag yang mengaktifkan fungsi AJAX.
		   * @param {HTML Tag Value} input - Nilai dari tag input yang akan diolah.
		   */
			$("#button-zip-code").click(function(){
				let zipCode = $('#zip-code').val();
			  /**
			   * Melakukan pemanggilan AJAX pada file function1.php dengan method GET.
			   * Pemanggilan AJAX menghasilkan string berdasarkan zip code yang dimasukkan.
			   * Jika string yang di-parse menjadi JSON object bertipe object, maka ini mengindikasikan
			   * 	bahwa terjadi error dari input yang dimasukkan.
			   * Jika tidak, hasil tersebut dimasukkan ke dalam tag HTML yang digunakan untuk menampilkan
			   * 	hasil dari pemanggilan AJAX.
			   *
			   * @param {String} q - Parameter AJAX GET dalam bentuk Zip Code dari input tag sebelumnya.
			   * @return {String} data - Hasil dari pemanggilan AJAX berupa string.
			   * @return {String} status - Status keberhasilan pemanggilan ajax.
			   */
				$.get("function1.php", { q: zipCode }, function(data, status){
					let parsed = JSON.parse(data);
					let resultTag = $('#p-zip-code');
					let defaultClass = 'text-center';
					if(typeof parsed === 'object') {
						resultTag.removeClass().addClass(defaultClass + ' text-danger');
						resultTag.text(parsed['detail']);
					} else {
						resultTag.removeClass().addClass(defaultClass + ' text-primary');
						resultTag.text("Latitude,Longitude: " + parsed);
					}
					// resultTag.show();
				});
			});
			
		  /**
		   * Trigger button AJAX untuk Function 2
		   *
		   * @param {HTML Tag} button - ID dari button HTML Tag yang mengaktifkan fungsi AJAX.
		   * @param {HTML Tag Value} select - Nilai dari tag select yang akan diolah.
		   */
			$("#button-display-level").click(function(){
				let displayLevel = $('#display-level').val();
			  /**
			   * Melakukan pemanggilan AJAX pada file function2.php dengan method GET.
			   * Pemanggilan AJAX menghasilkan string berdasarkan display level yang dipilih.
			   * Hasil dari pemanggilan AJAX kemudian di-populate ke dalam table menggunakan
			   * 	plugin DataTables.
			   *
			   * @param {String} q - Parameter AJAX GET dalam bentuk Display Level dari select tag sebelumnya.
			   * @return {int} data - Hasil dari pemanggilan AJAX berupa integer.
			   * @return {String} status - Status keberhasilan pemanggilan ajax.
			   */
				$.get("function2.php", { q: displayLevel }, function(dataAjax, status){
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
