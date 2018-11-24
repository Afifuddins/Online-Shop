<!DOCTYPE html>
<html>
<head>
	<title>About us</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.map') }}"></script>
</head>
<style type="text/css">
	footer{
		padding-top: 50%;
		background-color: transparent;
	}
	#Team{
		padding-bottom: 20%;
	}
</style>
<body>
	<div class="container" id="Team">
		<h1 align="center">Our Team</h1>
		<div class="row" id="raw" align="center">
			<div class="col-md-4"> 
				<h3>Alam</h3>
				<img src="{{ asset('img/alam.png') }}" class="rounded-circle" alt="bla" width="200" height="150">
				
				<p>Kami Team yang hebat</p>
			</div>
			<div class="col-md-4" >
				<h3>Afif</h3>
				<img src="{{ asset('img/yeah.png') }}" class="rounded-circle" alt="bla" width="200" height="150">
				<p>Kami Team yang hebat</p>
			</div>
			<div class="col-md-4" >
				<h3>Rauza</h3>
				<img src="{{ asset('img/kojay.png') }}" class="rounded-circle" alt="bla" width="200" height="150">
				<p>Kami Team yang hebat</p>
			</div>
		</div>
	</div>
	<footer class="card-footer">
		<center>
		<a class="fa fa-copyright" href="logo"> Copy right by: RAF</a>
	<p>2018</p>
	</center>
	</footer>
</body>
</html>