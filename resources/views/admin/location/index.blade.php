@extends('layouts.master')


@section('content')
	
	<div class="col-sm-8">

		<h1>Location</h1>

		@if(! $location)

			<div class="taskbar">
				<a href="/admin/location/create" class="btn btn-secondary">
					<i class="fa fa-plus-square" aria-hidden="true"></i><span>Erstellen</span>
				</a>
			</div>

			<hr>

			<div class="alert alert-warning">
				Du hast noch keine Location erfasst. Das ist nötig, um die Applikation zu nutzen. <a href="/admin/location/create">Klick hier</a> um eine Location zu erfassen!
			</div>


		@else

			<div class="taskbar">
				<a href="/admin/location/edit" class="btn btn-secondary">
					<i class="fa fa-pencil-square" aria-hidden="true"></i><span>Bearbeiten</span>
				</a>
			</div>

			<hr>

			<h3>Location-Name: {{ $location->name }}</h3>

			<p>Spotify-Account-ID: {{ $location->spotify_account_id}}</p>

			<p>Anzahl Events: {{count($location->events)}}</p>

		@endif

	</div>

@endsection


@section('sidebar')

	@include('admin.layouts.sidebar')

@endsection