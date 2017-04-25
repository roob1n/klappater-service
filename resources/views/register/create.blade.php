@extends('layouts.master')


@section('content')
<div class="col-sm-8">
  	
	<form action="register" method="POST" accept-charset="utf-8">
		
		{{ csrf_field() }}

		@include('layouts.errors')

		<div class="form-group">
			<label for="first_name">Vorname:</label>
			<input type="text" class="form-control" name="first_name" id="first_name" required="required">
		</div>


		<div class="form-group">
			<label for="last_name">Nachname:</label>
			<input type="text" class="form-control" name="last_name" id="last_name" required="required">
		</div>

		<div class="form-group">
			<label for="email">E-Mail:</label>
			<input type="email" class="form-control" name="email" id="email" required="required">
		</div>

		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" name="password" id="password" required="required">
		</div>

		<div class="form-group">
			<label for="password_confirmation">Password: <small>Bestätigung</small></label>
			<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required="required">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Registrieren</button>
		</div>
		

	</form>

</div>

@endsection