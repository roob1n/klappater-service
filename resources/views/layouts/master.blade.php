<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Robin Schmid">
	
	<title>KLAPPATER</title>
	
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	<script href="{{ asset('js/app.js') }}"></script>

</head>

<body>

@include('layouts.nav')

@include('layouts.header')


<div class="container">

    <div class="row">
	


		@yield('content')
	


		@section('sidebar')
			
			@include('layouts.sidebar')
		
		@show

	</div>

</div>

@include('layouts.footer')
	
</body>

</html>