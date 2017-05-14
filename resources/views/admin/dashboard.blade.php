@extends('layouts.master')



@section('content')
	
	<div class="col-sm-8">

		<h1>Dashboard</h1>

		@if(!Auth::user()->location_id)
		<div class="alert alert-warning">
			Du hast noch keine Location erfasst. Das ist nötig, um die Applikation zu nutzen. <a href="/admin/location/create">Klick hier</a> um eine Location zu erfassen!
		</div>
		@endif

		<p>Willkommen zurück, {{ auth()->user()->first_name . "!"}}

	</div>

@endsection



@section('sidebar')

	@include('admin.layouts.sidebar')

@endsection