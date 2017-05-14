@extends('layouts.master')


@section('content')
	
	<div class="col-sm-8">

		<h1>Codes für {{ $event->name }} erstellen</h1>

		<form action="/admin/events/{{ $event->id }}/codes" method="POST" accept-charset="utf-8">
		
		{{ csrf_field() }}

		@include('layouts.errors')

		<div class="form-group">
			<label for="num_of_codes">Anzahl Codes:</label>
			<input type="number" class="form-control" name="num_of_codes" id="num_of_codes" min="1" max="100" value="1" required="required">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Codes erstellen</button>
		</div>

	</form>

	</div>

@endsection


@section('sidebar')

	@include('admin.layouts.sidebar')

@endsection