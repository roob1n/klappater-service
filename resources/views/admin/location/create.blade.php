@extends('layouts.master')


@section('content')
	
	<div class="col-sm-8">

		<h1>Location erstellen</h1>

		<form action="/admin/location" method="POST" accept-charset="utf-8">
		
		{{ csrf_field() }}

		@include('layouts.errors')

		<div class="form-group">
			<label for="name">Location-Name:</label>
			<input type="text" class="form-control" name="name" id="name" required="required">
		</div>


		<div class="form-group">
			<label for="spotify_account_id">Spotify-Account-ID:</label>
			<input type="text" class="form-control" name="spotify_account_id" id="spotify_account_id" required="required">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Location erstellen</button>
		</div>

	</form>

	</div>

@endsection


@section('sidebar')

	@include('admin.layouts.sidebar')

@endsection