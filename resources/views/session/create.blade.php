@extends('layouts.master')


@section('content')
<div class="col-sm-8">
  	
	<form action="login" method="POST" accept-charset="utf-8">
		
		{{ csrf_field() }}

		@include('layouts.errors')

		<div class="form-group">
			<label for="email">E-Mail:</label>
			<input type="email" class="form-control" name="email" id="email" required="required">
		</div>

		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" name="password" id="password" required="required">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Login</button>
		</div>
		

	</form>

</div>

@endsection