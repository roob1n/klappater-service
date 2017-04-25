@extends('layouts.master')


@section('content')
	
	<div class="col-sm-8">

		<h1>Events</h1>

			<div class="taskbar">
				<a href="/admin/events/create" class="btn btn-secondary">
					<i class="fa fa-plus-square" aria-hidden="true"></i><span>Erstellen</span>
				</a>
			</div>

			<hr>

		@if(!$currentEvents && !$upcomingEvents && !$pastEvents)

			<p>Es sind noch keine Events vorhanden</p>

		@else

		<div class="events">

				<h2 class="events__heading">Laufende Events</h2>

				@include('admin.events.layouts.event-list', ['events' => $currentEvents])


				<hr>

				<h2 class="events__heading">Bevorstehende Events</h2>

				@include('admin.events.layouts.event-list', ['events' => $upcomingEvents])

				<hr>

				<h2 class="events__heading">Vergangene Events</h2>

				@include('admin.events.layouts.event-list', ['events' => $pastEvents])

			</div>
		@endif

	</div>

@endsection


@section('sidebar')

	@include('admin.layouts.sidebar')

@endsection