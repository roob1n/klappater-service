@extends('layouts.master')


@section('content')
	
	<div class="col-sm-8">

		<h1>Event bearbeiten</h1>

		<form action="/admin/events" method="POST" accept-charset="utf-8">
		
		{{ csrf_field() }}

		<input name="_method" type="hidden" value="PUT">

		@include('layouts.errors')

		<div class="form-group">
			<label for="name">Event-Name:</label>
			<input type="text" class="form-control" name="name" id="name" required="required" value="{{ $event->name}}">
		</div>


		<div class="form-group">
			<label for="spotify_playlist_id">Spotify-Playlist-ID:</label>
			<input type="text" class="form-control" name="spotify_playlist_id" id="spotify_playlist_id" required="required" value="{{ $event->spotify_playlist_id}}">
		</div>
		
		<div class="form-group">
			<label for="start">Start:</label>
			<input class="form-control" type="datetime-local" id="start" name="start" value="{{ $event->start->format('Y-m-d\Th:i') }}" required="required">
		</div>

		<div class="form-group">
			<label for="end">Ende:</label>
			<input class="form-control" type="datetime-local" id="end" name="end" value="{{ $event->end->format('Y-m-d\Th:i') }}" required="required">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Event speichern</button>

			<a href="/admin/location" class="btn btn-secondary">Abbrechen</a>
		</div>

	</form>

	</div>

@endsection


@section('sidebar')

	@include('admin.layouts.sidebar')

@endsection