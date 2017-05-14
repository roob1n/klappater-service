<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>ACTIVATION CODE für {{ $event->name }}</title>

	<link rel="stylesheet" href="{{ asset('css/code.css') }}">

	<script type="text/javascript" src="{{ asset('js/code.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/qrcode.js') }}"></script>

</head>

<body>

	<h1>Code für {{ $event->name }}</h1>

	<p>Diesen Code eingeben:</p>

	<h2>{{ $code->code }}</h2><br />

	<p>oder QR-Code scannen:</p>

	<div id="qrcode"></div>

	<a href="{{ $app->make('url')->to('/check-in/'.$code->code) }}">Check-in mit Code {{ $code->code }}</a>

	<script type="text/javascript">
		var qrcode = new QRCode(document.getElementById("qrcode"), {
			width : 1000,
			height : 1000
		});

		function makeCode () {		
			qrcode.makeCode("{{ $app->make('url')->to('/check-in/'.$code->code) }}");
		}

		makeCode();

		console.log("na immerhin kann man noch logen...");
	</script>
	
</body>

</html>